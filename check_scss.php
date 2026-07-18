<?php
define("CLI_SCRIPT", true);
require_once(__DIR__ . "/config.php");
require_once($CFG->dirroot . "/lib/setup.php");
$theme = theme_config::load("clp");
$ref = new ReflectionMethod($theme, "get_css_content_from_scss");
$ref->setAccessible(true);
$css = $ref->invoke($theme, false);
echo ($css === false) ? "SCSS FAILED\n" : "SCSS OK len=" . strlen($css) . "\n";
