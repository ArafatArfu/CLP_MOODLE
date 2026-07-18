<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This file is part of Moodle - http://moodle.org/
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * CLP About Us page.
 *
 * @package    theme_clp
 * @copyright  2024 CLP
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/filelib.php');

redirect_if_major_upgrade_required();

$context = context_system::instance();

$PAGE->set_context($context);
$PAGE->set_url('/about.php');
$PAGE->set_pagelayout('aboutus');
$PAGE->set_title('About Us | ' . $SITE->fullname);
$PAGE->set_heading($SITE->fullname);

echo $OUTPUT->header();
echo $OUTPUT->footer();
