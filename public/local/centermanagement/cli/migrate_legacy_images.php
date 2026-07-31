<?php
// CLI migration from legacy clp-admin uploads to Moodle File API.
// Usage:
//   php local/centermanagement/cli/migrate_legacy_images.php --dry-run
//   php local/centermanagement/cli/migrate_legacy_images.php --execute

define('CLI_SCRIPT', true);
require(__DIR__ . '/../../../../config.php');

global $DB, $CFG;

$legacyRoot = $CFG->dataroot . '/clp_legacy_uploads';
if (!file_exists($legacyRoot)) {
    $legacyRoot = __DIR__ . '/../../../../clp-admin/uploads/centermanagement';
}

$options = [
    'dry-run' => false,
    'execute' => false,
    'report' => false,
];

$args = $_SERVER['argv'] ?? [];
for ($i = 1; $i < count($args); $i++) {
    $arg = $args[$i];
    if ($arg === '--dry-run') {
        $options['dry-run'] = true;
    } elseif ($arg === '--execute') {
        $options['execute'] = true;
    } elseif ($arg === '--report') {
        $options['report'] = true;
    } elseif ($arg === '--legacy-dir' && isset($args[$i + 1])) {
        $legacyRoot = rtrim($args[$i + 1], '/\\');
        $i++;
    }
}

if (!$options['dry-run'] && !$options['execute']) {
    echo "Usage: php migrate_legacy_images.php --dry-run\n";
    echo "       php migrate_legacy_images.php --execute\n";
    exit(1);
}

if (!is_dir($legacyRoot)) {
    echo "Legacy directory not found: {$legacyRoot}\n";
    exit(1);
}

$context = \context_system::instance();
$fs = get_file_storage();

$report = [
    'scanned' => 0,
    'imported' => 0,
    'skipped' => 0,
    'errors' => [],
];

$mappings = [
    'banner_images' => 'banner_images',
    'plaque_images' => 'plaque_images',
    'school_photos' => 'school_photos',
];

foreach ($mappings as $legacyDir => $filearea) {
    $dir = $legacyRoot . '/' . $legacyDir;
    if (!is_dir($dir)) {
        continue;
    }

    $records = $DB->get_records('local_centermanagement_' . $legacyDir);
    foreach ($records as $record) {
        $report['scanned']++;
        $filename = $record->filename;
        $filepath = $dir . '/' . $filename;

        if (!file_exists($filepath)) {
            $report['errors'][] = "[MISSING] Center {$record->center_id} / {$filearea} / {$filename}";
            $report['skipped']++;
            continue;
        }

        $existing = $fs->get_area_files($context->id, 'local_centermanagement', $filearea, $record->center_id, 'id', false);
        $duplicate = false;
        foreach ($existing as $f) {
            if ($f->get_filename() === $filename) {
                $duplicate = true;
                break;
            }
        }

        if ($duplicate) {
            $report['skipped']++;
            continue;
        }

        if ($options['dry-run']) {
            $report['imported']++;
            echo "[DRY-RUN] Would import: {$filepath} -> component=local_centermanagement filearea={$filearea} itemid={$record->center_id}\n";
            continue;
        }

        if ($options['execute']) {
            try {
                $filerecord = [
                    'contextid' => $context->id,
                    'component' => 'local_centermanagement',
                    'filearea' => $filearea,
                    'itemid' => (int)$record->center_id,
                    'filepath' => '/',
                    'filename' => $filename,
                    'timecreated' => time(),
                    'timemodified' => time(),
                ];
                $fs->create_file_from_pathname($filerecord, $filepath);
                $report['imported']++;
                echo "[IMPORTED] {$filepath}\n";
            } catch (Exception $e) {
                $report['errors'][] = "[ERROR] Center {$record->center_id} / {$filearea} / {$filename}: " . $e->getMessage();
                $report['skipped']++;
            }
        }
    }
}

echo "\n=== Migration Report ===\n";
echo "Scanned:  {$report['scanned']}\n";
echo "Imported: {$report['imported']}\n";
echo "Skipped:  {$report['skipped']}\n";
if (!empty($report['errors'])) {
    echo "Errors:\n";
    foreach ($report['errors'] as $err) {
        echo "  - {$err}\n";
    }
}
echo "=======================\n";

if ($options['report'] && $options['execute']) {
    $reportPath = $CFG->dataroot . '/migration_report_' . date('Ymd_His') . '.log';
    file_put_contents($reportPath, print_r($report, true));
    echo "Report saved to: {$reportPath}\n";
}
