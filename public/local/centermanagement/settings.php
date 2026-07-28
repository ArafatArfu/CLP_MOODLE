<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new admin_settingpage('local_centermanagement_settings', get_string('pluginname', 'local_centermanagement'));
    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_heading('local_centermanagement_info', get_string('pluginname', 'local_centermanagement'), get_string('pluginname', 'local_centermanagement')));
}
