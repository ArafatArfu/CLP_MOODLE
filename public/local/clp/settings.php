<?php
// Admin settings for the local_clp CLC page.

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_clp', get_string('pluginname', 'local_clp'));

    $settings->add(new admin_setting_heading(
        'local_clp/programcontentsettings',
        get_string('clcdescription', 'local_clp'),
        ''
    ));

    $setting = new admin_setting_configtextarea(
        'local_clp/clc_description',
        get_string('clcdescription', 'local_clp'),
        '',
        'Computer Literacy Program Volunteers for the Underprivileged (CLP) has spent 21 years building and running '
            . 'Computer Literacy Centers (CLCs) to develop a model for computer literacy of underprivileged youth in rural Bangladesh.'
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    $setting = new admin_setting_configtext(
        'local_clp/clc_centers',
        get_string('clccenters', 'local_clp'),
        '',
        322,
        PARAM_INT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    $setting = new admin_setting_configtext(
        'local_clp/clc_smart_classrooms',
        get_string('clcsmartclassrooms', 'local_clp'),
        '',
        190,
        PARAM_INT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    $settings->add(new admin_setting_heading(
        'local_clp/dashboardlink',
        get_string('managedashboard', 'local_clp'),
        html_writer::link(
            new moodle_url('/local/clp/dashboard.php', ['program' => 'clc']),
            get_string('viewlive', 'local_clp'),
            ['class' => 'btn btn-primary']
        )
    ));

    $ADMIN->add('localplugins', $settings);
}
