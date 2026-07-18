<?php
define("CLI_SCRIPT", true);
require_once(__DIR__ . "/config.php");
require_once($CFG->dirroot . "/lib/setup.php");
$theme = theme_config::load("clp");
$ref = new ReflectionMethod($theme, "get_scss_property");
$ref->setAccessible(true);
list($paths, $scssfn) = $ref->invoke($theme);
$src = is_object($scssfn) ? $scssfn($theme) : file_get_contents($scssfn);
$c = new core_scss();
$c->setImportPaths($paths);
$c->append_raw_scss($src);
try {
    $out = $c->to_css();
    echo "core_scss COMPILE OK len=" . strlen($out) . "\n";
} catch (\Exception $e) {
    echo "core_scss COMPILE ERR: " . $e->getMessage() . "\n";
}

