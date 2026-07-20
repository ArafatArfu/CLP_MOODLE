<?php
defined('MOODLE_INTERNAL') || die();

function xmldb_local_centermanagement_upgrade($oldversion) {
    global $DB, $OUTPUT;

    $dbman = $DB->get_manager();

    if ($oldversion < 2026072001) {

        $table = new xmldb_table('local_centermanagement_centers');
        $field = new xmldb_field('center_name');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('school_name');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, '');
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('center_type');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, 'clc');
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('usermodified');
        if (!$dbman->field_exists($table, $field)) {
            $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
            $dbman->add_field($table, $field);
        }

        upgrade_plugin_savepoint(true, 2026072001, 'local', 'centermanagement');
    }

    return true;
}
