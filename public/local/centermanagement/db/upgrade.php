<?php
defined('MOODLE_INTERNAL') || die();

function xmldb_local_centermanagement_upgrade($oldversion) {
    global $DB, $OUTPUT;

    $dbman = $DB->get_manager();

    if ($oldversion < 2026072801) {

        $table = new xmldb_table('local_centermanagement_centers');
        $field = new xmldb_field('center_category');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '20', null, XMLDB_NOTNULL, null, '');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('mailing_address');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('history_of_center');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('description_of_center');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('contact_person_details');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('accomplishment');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('current_status');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '20', null, XMLDB_NOTNULL, null, '');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('hm_teacher_name');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('hm_phone_number');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '50', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('hm_email');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('clc_teacher_name');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('clc_teacher_email');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('clc_teacher_phone');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '50', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('scr_teacher_name');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('scr_teacher_email');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('scr_teacher_phone');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '50', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('global_classroom');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, '');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('program_clp_pi_english_club');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, 'no');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('program_egl_english');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, 'no');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('program_egl_math');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, 'no');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('program_csaw');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, 'no');
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('school_grading');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '5', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('clc_graduate_students');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('scr_benefited_students');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('hardware_status');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('last_visit_date');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', null, null, null, null);
            $dbman->add_field($table, $field);
        }
        upgrade_plugin_savepoint(true, 2026072801, 'local', 'centermanagement');
    }

    if ($oldversion < 2026072802) {
        $table = new xmldb_table('local_centermanagement_sponsors');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $table->add_field('center_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('school_info_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, '0');
            $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');
            $table->add_field('country', XMLDB_TYPE_CHAR, '100', null, null, null, null);
            $table->add_field('address', XMLDB_TYPE_TEXT, null, null, null, null, null);
            $table->add_field('email', XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $table->add_field('phone', XMLDB_TYPE_CHAR, '50', null, null, null, null);
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
            $table->add_index('idx_centermanagement_sponsor_center', XMLDB_INDEX_NOTUNIQUE, array('center_id'));
            $dbman->create_table($table);
        }
        upgrade_plugin_savepoint(true, 2026072802, 'local', 'centermanagement');
    }

    if ($oldversion < 2026072803) {
        $table = new xmldb_table('local_centermanagement_banner_images');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $table->add_field('center_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('filename', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');
            $table->add_field('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
            $table->add_index('idx_centermanagement_banner_center', XMLDB_INDEX_NOTUNIQUE, array('center_id'));
            $dbman->create_table($table);
        }
        upgrade_plugin_savepoint(true, 2026072803, 'local', 'centermanagement');
    }

    if ($oldversion < 2026072804) {
        $table = new xmldb_table('local_centermanagement_plaque_gallery');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $table->add_field('center_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('filename', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');
            $table->add_field('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
            $table->add_index('idx_centermanagement_plaque_center', XMLDB_INDEX_NOTUNIQUE, array('center_id'));
            $dbman->create_table($table);
        }
        $table = new xmldb_table('local_centermanagement_school_photo_gallery');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $table->add_field('center_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('filename', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');
            $table->add_field('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
            $table->add_index('idx_centermanagement_school_photo_center', XMLDB_INDEX_NOTUNIQUE, array('center_id'));
            $dbman->create_table($table);
        }
        $table = new xmldb_table('local_centermanagement_centers');
        $index = new xmldb_index('idx_centermanagement_center_type', XMLDB_INDEX_NOTUNIQUE, array('center_type'));
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        $index = new xmldb_index('idx_centermanagement_upazila', XMLDB_INDEX_NOTUNIQUE, array('upazila'));
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        upgrade_plugin_savepoint(true, 2026072804, 'local', 'centermanagement');
    }

    if ($oldversion < 2026072805) {
        $table = new xmldb_table('local_centermanagement_centers');
        $field = new xmldb_field('sponsor_name');
        if ($dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->change_field_type($table, $field);
        }
        $field = new xmldb_field('address');
        if ($dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_TEXT, null, null, null, null, null);
            $dbman->change_field_type($table, $field);
        }
        upgrade_plugin_savepoint(true, 2026072805, 'local', 'centermanagement');
    }

    if ($oldversion < 2026072806) {
        $table = new xmldb_table('local_centermanagement_sponsors');
        $field = new xmldb_field('sortorder');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $dbman->add_field($table, $field);
        }
        $table = new xmldb_table('local_centermanagement_banner_images');
        $field = new xmldb_field('sortorder');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $dbman->add_field($table, $field);
        }
        $table = new xmldb_table('local_centermanagement_plaque_gallery');
        $field = new xmldb_field('sortorder');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $dbman->add_field($table, $field);
        }
        $table = new xmldb_table('local_centermanagement_school_photo_gallery');
        $field = new xmldb_field('sortorder');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
            $dbman->add_field($table, $field);
        }
        upgrade_plugin_savepoint(true, 2026072806, 'local', 'centermanagement');
    }

    if ($oldversion < 2026073001) {
        upgrade_plugin_savepoint(true, 2026073001, 'local', 'centermanagement');
    }

    return true;
}
