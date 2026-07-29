<?php
require_once(__DIR__ . '/config.php');

use local_centermanagement\local\center_repository;

if (!function_exists('clp_get_string')) {
    function clp_get_string(string $identifier, string $component): string {
        try {
            $result = get_string($identifier, $component);
            if ($result === '[' . $identifier . ']') {
                return ucwords(str_replace('_', ' ', $identifier));
            }
            return $result;
        } catch (\Throwable $e) {
            return ucwords(str_replace('_', ' ', $identifier));
        }
    }
}

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/school-details.php');
$PAGE->set_title(clp_get_string('schoolinfo', 'local_centermanagement'));
$PAGE->set_heading(clp_get_string('schoolinfo', 'local_centermanagement'));
$PAGE->requires->css(new moodle_url('/local/centermanagement/styles.css'));

$schoolInfoId = required_param('schoolInfo', PARAM_INT);

try {
    $center = center_repository::get_center_by_id($schoolInfoId);
} catch (\dml_exception $e) {
    $center = null;
}

if (!$center) {
    print_error('recordnotfound', 'local_centermanagement');
}

$clp_text = function ($value) {
    return nl2br(htmlspecialchars((string) $value, ENT_QUOTES));
};

$institutionName = $center ? (string) ($center->center_name ?? '') : '';
$centerTypeLabel = '';
if ($center) {
    $ct = strtolower((string) ($center->center_type ?? 'clc'));
    if ($ct === 'scr') {
        $centerTypeLabel = clp_get_string('centertypescr', 'local_centermanagement');
    } elseif ($ct === 'clc_scr') {
        $centerTypeLabel = clp_get_string('centertypeclcscr', 'local_centermanagement');
    } elseif ($ct === 'other') {
        $centerTypeLabel = clp_get_string('centertypeother', 'local_centermanagement');
    } else {
        $centerTypeLabel = clp_get_string('centertypeclc', 'local_centermanagement');
    }
}
$mailingAddress = $center ? (string) ($center->mailing_address ?? '') : '';
$history = $center ? (string) ($center->history_of_center ?? '') : '';
$description = $center ? (string) ($center->description_of_center ?? '') : '';
$contactPerson = $center ? (string) ($center->contact_person_details ?? '') : '';
$accomplishment = $center ? (string) ($center->accomplishment ?? '') : '';
$currentStatus = $center ? (string) ($center->current_status ?? '') : '';
$currentStatusLabel = $currentStatus === 'non_supported' ? clp_get_string('nonsupported', 'local_centermanagement') : clp_get_string('supported', 'local_centermanagement');
$globalClassroom = $center ? (string) ($center->global_classroom ?? '') : '';
$schoolGrading = $center ? strtoupper((string) ($center->school_grading ?? '')) : '';
$clcGraduate = $center ? (string) ($center->clc_graduate_students ?? '') : '';
$scrBenefited = $center ? (string) ($center->scr_benefited_students ?? '') : '';
$hardware = $center ? (string) ($center->hardware_status ?? '') : '';
$lastVisit = $center ? (int) ($center->last_visit_date ?? 0) : 0;

$programClpPi = $center ? (string) ($center->program_clp_pi_english_club ?? 'no') : 'no';
$programEglEng = $center ? (string) ($center->program_egl_english ?? 'no') : 'no';
$programEglMath = $center ? (string) ($center->program_egl_math ?? 'no') : 'no';
$programCsaw = $center ? (string) ($center->program_csaw ?? 'no') : 'no';

$startDate = '';
if ($center && !empty($center->start_date)) {
    $startDate = userdate($center->start_date, clp_get_string('strftimedate', 'langconfig'));
}
$lastVisitDate = '';
if ($lastVisit) {
    $lastVisitDate = date('d F Y, h:i A', $lastVisit);
}

$bannerImages = [];
if ($center) {
    foreach (center_repository::get_banner_images($center->id) as $banner) {
        $bannerImages[] = ['filename' => $banner->filename, 'alt_text' => $banner->alt_text ?? ''];
    }
}

$sponsors = [];
if ($center) {
    foreach (center_repository::get_sponsors($center->id) as $s) {
        $sponsors[] = $s;
    }
}

$plaqueImages = [];
if ($center) {
    foreach (center_repository::get_plaque_images($center->id) as $plaque) {
        $plaqueImages[] = ['filename' => $plaque->filename, 'alt_text' => $plaque->alt_text ?? ''];
    }
}

$schoolPhotos = [];
if ($center) {
    foreach (center_repository::get_school_photos($center->id) as $photo) {
        $schoolPhotos[] = ['filename' => $photo->filename, 'alt_text' => $photo->alt_text ?? ''];
    }
}

function center_pluginfile_url($filename, $filearea, $itemid) {
    $filename = rawurlencode($filename);
    if ($filearea === 'banner_images' || $filearea === 'plaque_images' || $filearea === 'school_photos') {
        return '/clp-admin/uploads/centermanagement/' . $filearea . '/' . $filename;
    }
    $context = \context_system::instance();
    return (string) \moodle_url::make_pluginfile_url(
        $context->id,
        'local_centermanagement',
        $filearea,
        $itemid,
        '/',
        $filename
    );
}

function render_slider(array $images, int $itemid, string $filearea): string {
    if (empty($images)) {
        return '<div class="sd-slider" data-simpleslider="true"><div class="sd-slide is-empty"><img src="/theme/clp/assets/images/placeholder.jpg" alt="' . clp_get_string('noplaceholder', 'local_centermanagement') . '"></div></div>';
    }
    $slides = '';
    $dots = '';
    foreach ($images as $idx => $img) {
        $filename = is_array($img) ? ($img['filename'] ?? '') : $img;
        $altText = is_array($img) ? ($img['alt_text'] ?? '') : '';
        $url = htmlspecialchars(center_pluginfile_url($filename, $filearea, $itemid), ENT_QUOTES);
        $alt = $altText !== '' ? htmlspecialchars($altText, ENT_QUOTES) : 'Banner ' . ($idx + 1);
        $active = $idx === 0 ? ' is-active' : '';
        $slide = '<div class="sd-slide' . $active . '"><img src="' . $url . '" alt="' . $alt . '" loading="' . ($idx === 0 ? 'eager' : 'lazy') . '"></div>';
        $dots .= '<button class="sd-dot' . $active . '" aria-label="Slide ' . ($idx + 1) . '" data-index="' . $idx . '"></button>';
        $slides .= $slide;
    }
    return '<div class="sd-slider" data-simpleslider="true">'
        . '<div class="sd-slides">' . $slides . '</div>'
        . '<button class="sd-prev" aria-label="Previous">&#10094;</button>'
        . '<button class="sd-next" aria-label="Next">&#10095;</button>'
        . '<div class="sd-dots">' . $dots . '</div>'
        . '</div>';
}

function render_gallery(array $images, int $itemid, string $filearea, string $idprefix): string {
    if (empty($images)) {
        return '<p class="text-muted">' . clp_get_string('noimages', 'local_centermanagement') . '</p>';
    }
    $html = '<div class="sd-gallery" id="' . $idprefix . '">';
    foreach ($images as $idx => $img) {
        $filename = is_array($img) ? ($img['filename'] ?? '') : $img;
        $altText = is_array($img) ? ($img['alt_text'] ?? '') : '';
        $url = htmlspecialchars(center_pluginfile_url($filename, $filearea, $itemid), ENT_QUOTES);
        $alt = $altText !== '' ? htmlspecialchars($altText, ENT_QUOTES) : 'Image ' . ($idx + 1);
        $html .= '<a href="' . $url . '" class="sd-gallery-item" data-lightbox="' . $idprefix . '" data-title="' . $alt . '">'
            . '<img src="' . $url . '" alt="' . $alt . '" loading="lazy">'
            . '</a>';
    }
    $html .= '</div>';
    return $html;
}

function program_table_row(string $label, string $value, bool $isBadge = false): string {
    $val = $isBadge ? '<span class="badge badge-secondary">' . $value . '</span>' : $value;
    return '<tr><th>' . $label . '</th><td>' . $val . '</td></tr>';
}

$programs = [
    ['program' => clp_get_string('programclppienglishclub', 'local_centermanagement'), 'status' => $programClpPi],
    ['program' => clp_get_string('programeglenglish', 'local_centermanagement'), 'status' => $programEglEng],
    ['program' => clp_get_string('programeglmath', 'local_centermanagement'), 'status' => $programEglMath],
    ['program' => clp_get_string('programcsaw', 'local_centermanagement'), 'status' => $programCsaw],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>CLP | <?php echo $center ? htmlspecialchars($institutionName, ENT_QUOTES) : clp_get_string('schoolinfo', 'local_centermanagement'); ?></title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <link rel="stylesheet" href="/local/centermanagement/styles.css">
</head>
<body>
<?php
$navContext = [
    'output' => $OUTPUT,
    'config' => [
        'wwwroot' => '',
        'homeurl' => '/',
    ],
];
echo $OUTPUT->render_from_template('theme_clp/navbar', $navContext);
?>

<section class="sd-page">
    <div class="sd-container">
        <div class="sd-card sd-hero-card">
            <div class="sd-hero-banner">
                <?php echo render_slider($bannerImages, $center->id, 'banner_image'); ?>
            </div>
            <div class="sd-hero-content">
                <h1 class="sd-school-title"><?php echo htmlspecialchars($institutionName, ENT_QUOTES); ?></h1>
                <div class="sd-school-meta">
                    <?php if ($centerTypeLabel): ?>
                    <span class="sd-badge sd-badge-type"><?php echo htmlspecialchars($centerTypeLabel, ENT_QUOTES); ?></span>
                    <?php endif; ?>
                    <?php if ($startDate): ?>
                    <span class="sd-meta-item">
                        <span class="material-icons">event</span>
                        <?php echo $startDate; ?>
                    </span>
                    <?php endif; ?>
                    <?php if ($currentStatusLabel): ?>
                    <span class="sd-badge sd-badge-status sd-badge-<?php echo $currentStatus === 'supported' ? 'success' : 'secondary'; ?>">
                        <?php echo $currentStatusLabel; ?>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="sd-location">
                    <?php echo htmlspecialchars(($center->division ?? '') . ($center->division && $center->district ? ', ' : '') . ($center->district ?? '') . ($center->district && $center->upazila ? ', ' : '') . ($center->upazila ?? ''), ENT_QUOTES); ?>
                </div>
            </div>
        </div>

        <div class="sd-grid">
            <div class="sd-main-col">
                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">mail</span>
                        <h2><?php echo clp_get_string('mailingaddress', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($mailingAddress): ?>
                            <?php echo format_text($mailingAddress, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">history</span>
                        <h2><?php echo clp_get_string('historyofthecenter', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($history): ?>
                            <?php echo format_text($history, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">description</span>
                        <h2><?php echo clp_get_string('descriptionofthecenter', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($description): ?>
                            <?php echo format_text($description, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">contact_page</span>
                        <h2><?php echo clp_get_string('contactpersonwithphoneemail', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($contactPerson): ?>
                            <?php echo format_text($contactPerson, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">emoji_events</span>
                        <h2><?php echo clp_get_string('accomplishment', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($accomplishment): ?>
                            <?php echo format_text($accomplishment, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">groups</span>
                        <h2><?php echo clp_get_string('sponsors', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <?php if (!empty($sponsors)): ?>
                            <div class="sd-sponsors-grid">
                                <?php foreach ($sponsors as $sponsor):
                                    $name = trim((string)($sponsor->name ?? ''));
                                    if ($name === '') continue;
                                    $fields = [];
                                    if (trim((string)($sponsor->country ?? '')) !== '') {
                                        $fields[] = '<p class="sd-sponsor-field"><span class="material-icons">public</span>' . htmlspecialchars(trim($sponsor->country), ENT_QUOTES) . '</p>';
                                    }
                                    if (trim((string)($sponsor->address ?? '')) !== '') {
                                        $fields[] = '<p class="sd-sponsor-field"><span class="material-icons">location_on</span>' . htmlspecialchars(trim($sponsor->address), ENT_QUOTES) . '</p>';
                                    }
                                    if (trim((string)($sponsor->email ?? '')) !== '') {
                                        $fields[] = '<p class="sd-sponsor-field"><span class="material-icons">email</span><a href="mailto:' . htmlspecialchars(trim($sponsor->email), ENT_QUOTES) . '">' . htmlspecialchars(trim($sponsor->email), ENT_QUOTES) . '</a></p>';
                                    }
                                    if (trim((string)($sponsor->phone ?? '')) !== '') {
                                        $fields[] = '<p class="sd-sponsor-field"><span class="material-icons">phone</span><a href="tel:' . htmlspecialchars(trim($sponsor->phone), ENT_QUOTES) . '">' . htmlspecialchars(trim($sponsor->phone), ENT_QUOTES) . '</a></p>';
                                    }
                                ?>
                                <div class="sd-sponsor-card">
                                    <h3 class="sd-sponsor-name"><?php echo htmlspecialchars($name, ENT_QUOTES); ?></h3>
                                    <?php echo implode('', $fields); ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">school</span>
                        <h2><?php echo clp_get_string('clcgraduatestudents', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($clcGraduate): ?>
                            <?php echo format_text($clcGraduate, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">volunteer_activism</span>
                        <h2><?php echo clp_get_string('scrbenefitedstudents', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($scrBenefited): ?>
                            <?php echo format_text($scrBenefited, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">computer</span>
                        <h2><?php echo clp_get_string('hardwarestatus', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body sd-rich-text">
                        <?php if ($hardware): ?>
                            <?php echo format_text($hardware, FORMAT_HTML); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">calendar_today</span>
                        <h2><?php echo clp_get_string('lastvisitdate', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <?php if ($lastVisitDate): ?>
                            <p><?php echo htmlspecialchars($lastVisitDate, ENT_QUOTES); ?></p>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('nodataprovided', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">photo_library</span>
                        <h2><?php echo clp_get_string('plaque', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <?php if (!empty($plaqueImages)): ?>
                            <?php echo render_gallery($plaqueImages, $center->id, 'plaque_image', 'plaque-gallery'); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('noimages', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card">
                    <div class="sd-card-header">
                        <span class="material-icons">photo_camera</span>
                        <h2><?php echo clp_get_string('schoolphotos', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <?php if (!empty($schoolPhotos)): ?>
                            <?php echo render_gallery($schoolPhotos, $center->id, 'school_photo', 'school-photo-gallery'); ?>
                        <?php else: ?>
                            <p class="sd-empty-state"><?php echo clp_get_string('noimages', 'local_centermanagement'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="sd-sidebar">
                <div class="sd-card sd-info-card">
                    <div class="sd-card-header">
                        <span class="material-icons">info</span>
                        <h2><?php echo clp_get_string('currentstatus', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <span class="sd-badge sd-badge-status sd-badge-<?php echo $currentStatus === 'supported' ? 'success' : 'secondary'; ?>">
                            <?php echo $currentStatusLabel; ?>
                        </span>
                    </div>
                </div>

                <div class="sd-card sd-info-card">
                    <div class="sd-card-header">
                        <span class="material-icons">contact_phone</span>
                        <h2><?php echo clp_get_string('contactinformation', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <div class="sd-contact-block">
                            <h3><?php echo clp_get_string('hm', 'local_centermanagement'); ?></h3>
                            <?php if ($center->hm_teacher_name): ?>
                            <p><?php echo htmlspecialchars($center->hm_teacher_name, ENT_QUOTES); ?></p>
                            <?php else: ?>
                            <p class="sd-empty-field"><?php echo clp_get_string('notprovided', 'local_centermanagement'); ?></p>
                            <?php endif; ?>
                            <?php if ($center->hm_phone_number): ?>
                            <p><a href="tel:<?php echo htmlspecialchars($center->hm_phone_number, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->hm_phone_number, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                            <?php if ($center->hm_email): ?>
                            <p><a href="mailto:<?php echo htmlspecialchars($center->hm_email, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->hm_email, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                        </div>

                        <div class="sd-contact-block">
                            <h3><?php echo clp_get_string('clc', 'local_centermanagement'); ?></h3>
                            <?php if ($center->clc_teacher_name): ?>
                            <p><?php echo htmlspecialchars($center->clc_teacher_name, ENT_QUOTES); ?></p>
                            <?php else: ?>
                            <p class="sd-empty-field"><?php echo clp_get_string('notprovided', 'local_centermanagement'); ?></p>
                            <?php endif; ?>
                            <?php if ($center->clc_teacher_email): ?>
                            <p><a href="mailto:<?php echo htmlspecialchars($center->clc_teacher_email, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->clc_teacher_email, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                            <?php if ($center->clc_teacher_phone): ?>
                            <p><a href="tel:<?php echo htmlspecialchars($center->clc_teacher_phone, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->clc_teacher_phone, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                        </div>

                        <div class="sd-contact-block">
                            <h3><?php echo clp_get_string('scr', 'local_centermanagement'); ?></h3>
                            <?php if ($center->scr_teacher_name): ?>
                            <p><?php echo htmlspecialchars($center->scr_teacher_name, ENT_QUOTES); ?></p>
                            <?php else: ?>
                            <p class="sd-empty-field"><?php echo clp_get_string('notprovided', 'local_centermanagement'); ?></p>
                            <?php endif; ?>
                            <?php if ($center->scr_teacher_email): ?>
                            <p><a href="mailto:<?php echo htmlspecialchars($center->scr_teacher_email, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->scr_teacher_email, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                            <?php if ($center->scr_teacher_phone): ?>
                            <p><a href="tel:<?php echo htmlspecialchars($center->scr_teacher_phone, ENT_QUOTES); ?>"><?php echo htmlspecialchars($center->scr_teacher_phone, ENT_QUOTES); ?></a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="sd-card sd-info-card">
                    <div class="sd-card-header">
                        <span class="material-icons">public</span>
                        <h2><?php echo clp_get_string('globalclassroom', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <span class="sd-badge sd-badge-<?php echo $globalClassroom === 'yes' ? 'success' : 'secondary'; ?>">
                            <?php echo $globalClassroom === 'yes' ? clp_get_string('yes', 'local_centermanagement') : clp_get_string('no', 'local_centermanagement'); ?>
                        </span>
                    </div>
                </div>

                <div class="sd-card sd-info-card">
                    <div class="sd-card-header">
                        <span class="material-icons">stars</span>
                        <h2><?php echo clp_get_string('schoolgrading', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <?php if ($schoolGrading): ?>
                        <span class="sd-grade-badge sd-grade-<?php echo strtolower($schoolGrading); ?>">
                            <?php echo htmlspecialchars($schoolGrading, ENT_QUOTES); ?>
                        </span>
                        <?php else: ?>
                        <span class="sd-grade-badge sd-grade-na">N/A</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sd-card sd-info-card">
                    <div class="sd-card-header">
                        <span class="material-icons">assignment</span>
                        <h2><?php echo clp_get_string('otherprograms', 'local_centermanagement'); ?></h2>
                    </div>
                    <div class="sd-card-body">
                        <table class="sd-programs-table">
                            <thead>
                                <tr>
                                    <th><?php echo clp_get_string('otherprograms', 'local_centermanagement'); ?></th>
                                    <th><?php echo clp_get_string('status', 'local_centermanagement'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($programs as $prog): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($prog['program'], ENT_QUOTES); ?></td>
                                    <td>
                                        <span class="sd-badge sd-badge-<?php echo $prog['status'] === 'yes' ? 'success' : 'secondary'; ?>">
                                            <?php echo $prog['status'] === 'yes' ? clp_get_string('yes', 'local_centermanagement') : clp_get_string('no', 'local_centermanagement'); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="donate-popup" id="donate-popup">
    <div class="close-donate theme-btn"><span class="fa fa-close"></span></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area">
                <div class="section-title center"><h2>Donate</h2></div>
                <div class="row">
                    <div class="col-sm-12" style="text-align:center; color:black">
                        <p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>
                        <p>Tax ID # 46-0646134</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="clp-footer">
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Resources</h3>
                <ul class="footer-list-menu">
                    <li><a href="evaluation-report.php">INDEPENDENT EVALUATION REPORT</a></li>
                    <li><a href="formative-reports.php">FORMATIVE REPORT</a></li>
                    <li><a href="annual-report.php">ANNUAL REPORT</a></li>
                    <li><a href="magazines.php">MAGAZINES</a></li>
                    <li><a href="brochure.php">BROCHURE</a></li>
                </ul>
                <h3 class="footer-title">Contact Info</h3>
                <a style="color:black;" href="tel:+7329728362">(732) 972-8362</a> <br/>
                <a style="color:black;" href="mailto:clp@clpweb.org">clp@clpweb.org</a>
                <h3 class="footer-title">Mailing Address</h3>
                <p class="address">Computer Literacy Program (CLP)<br>6 Tharp Lane <br/> Marlboro, NJ 07746, USA</p>
            </div>
            <div class="col-sm-4 col-xs-12" style="height: 520px;">
                <h3 class="footer-title">CLP Mission</h3>
                <p style="line-height: 20px;">Empowering underprivileged youths through computer literacy training and technology-aided education.</p>
                <h3 class="footer-title">Follow Us</h3>
                <div class="row">
                    <div class="footer-social">
                        <a target="_blank" href="https://facebook.com/CLPUSAA" class="fa fa-facebook social-fb"></a>
                        <a target="_blank" href="https://www.instagram.com/clp_usa/" class="fa fa-instagram social-instagram"></a>
                        <a target="_blank" href="https://twitter.com/clp_usa" class="fa fa-twitter social-twitter"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A" class="fa fa-youtube social-youtube"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/" class="fa fa-linkedin social-linkedin"></a>
                    </div>
                </div>
                <h3 class="footer-title">Legal Info</h3>
                <ul class="footer-list-menu">
                    <li>IRS ID: <strong>46-0646134</strong></li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-list-menu">
                    <li><a href="donation-online.php">DONATE ONLINE</a></li>
                    <li><a href="donation-mail.php">DONATE BY MAIL</a></li>
                    <li><a href="donation-amazon.php">DONATE BY AMAZON-SMILE</a></li>
                    <li><a href="sponsor-clc.php">SPONSOR A CLC</a></li>
                    <li><a href="sponsor-scr.php">SPONSOR A SCR</a></li>
                    <li><a href="sponsor-tokai.php">SPONSOR A TOKAI(টোকাই)-CLC</a></li>
                    <li><a href="sponsor-computer.php">SPONSOR A COMPUTER</a></li>
                    <li><a href="volunteer.php">BE A VOLUNTEER</a></li>
                    <li><a href="contact-us.php">CONTACT US</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background-color: #232121;">
                <p class="text-center" style="color: #FFF; padding: 5px;">Copyright &copy; CLP, 2026</p>
            </div>
        </div>
    </section>
</footer>

<script>
(function() {
    var sliders = document.querySelectorAll('.sd-slider');
    sliders.forEach(function(slider) {
        var slides = slider.querySelectorAll('.sd-slide');
        var dots = slider.querySelectorAll('.sd-dot');
        var prev = slider.querySelector('.sd-prev');
        var next = slider.querySelector('.sd-next');
        var current = 0;
        var timer = null;

        function show(index) {
            if (index >= slides.length) index = 0;
            if (index < 0) index = slides.length - 1;
            current = index;
            slides.forEach(function(s, i) { s.classList.toggle('is-active', i === current); });
            dots.forEach(function(d, i) { d.classList.toggle('is-active', i === current); });
        }

        function nextSlide() { show(current + 1); }
        function prevSlide() { show(current - 1); }

        function startAuto() { timer = setInterval(nextSlide, 4000); }
        function stopAuto() { clearInterval(timer); }

        if (next) next.addEventListener('click', function() { stopAuto(); nextSlide(); startAuto(); });
        if (prev) prev.addEventListener('click', function() { stopAuto(); prevSlide(); startAuto(); });
        dots.forEach(function(d) {
            d.addEventListener('click', function() { stopAuto(); show(parseInt(d.getAttribute('data-index'), 10)); startAuto(); });
        });
        slider.addEventListener('mouseenter', stopAuto);
        slider.addEventListener('mouseleave', startAuto);

        var touchStartX = 0;
        slider.addEventListener('touchstart', function(e) { touchStartX = e.touches[0].clientX; }, {passive: true});
        slider.addEventListener('touchend', function(e) {
            var diff = e.changedTouches[0].clientX - touchStartX;
            if (Math.abs(diff) > 50) {
                stopAuto();
                if (diff > 0) prevSlide(); else nextSlide();
                startAuto();
            }
        }, {passive: true});

        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') { stopAuto(); prevSlide(); startAuto(); }
            if (e.key === 'ArrowRight') { stopAuto(); nextSlide(); startAuto(); }
        });

        if (slides.length > 1) startAuto();
    });
})();

document.addEventListener('DOMContentLoaded', function() {
    var lightboxOverlay = document.createElement('div');
    lightboxOverlay.className = 'sd-lightbox';
    lightboxOverlay.innerHTML = '<span class="sd-lightbox-close">&times;</span><img class="sd-lightbox-img" src="" alt=""><div class="sd-lightbox-caption"></div>';
    document.body.appendChild(lightboxOverlay);

    var lbImg = lightboxOverlay.querySelector('.sd-lightbox-img');
    var lbCaption = lightboxOverlay.querySelector('.sd-lightbox-caption');
    var lbClose = lightboxOverlay.querySelector('.sd-lightbox-close');

    function openLightbox(url, title) {
        lbImg.src = url;
        lbCaption.textContent = title || '';
        lightboxOverlay.style.display = 'flex';
    }
    function closeLightbox() {
        lightboxOverlay.style.display = 'none';
        lbImg.src = '';
    }

    lbClose.addEventListener('click', closeLightbox);
    lightboxOverlay.addEventListener('click', function(e) { if (e.target === lightboxOverlay) closeLightbox(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeLightbox(); });

    document.querySelectorAll('[data-lightbox]').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            openLightbox(el.getAttribute('href'), el.getAttribute('data-title') || '');
        });
    });
});
</script>
<script src="/theme/clp/assets/js/jquery.min.js"></script>
<script src="/theme/clp/assets/js/jquery.js"></script>
<script src="/theme/clp/assets/js/menu.js"></script>
<script src="/theme/clp/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/theme/clp/assets/js/SmoothScroll.js"></script>
<script src="/theme/clp/assets/js/bootstrap.min.js"></script>
<script src="/theme/clp/assets/js/owl.carousel.min.js"></script>
<script src="/theme/clp/assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
