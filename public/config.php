<?php
// Moodle configuration for CLP theme project

unset($CFG);
global $CFG;
$CFG = new stdClass();

// Database settings
$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = '127.0.0.1';
$CFG->dbname    = 'moodle_db';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'Admin@12345';
$CFG->prefix    = '';
$CFG->dboptions = array (
    'dbpersist' => 0,
    'dbport' => '3306',
    'dbsocket' => false,
    'dbcollation' => 'utf8mb4_unicode_ci',
);

// Path settings
$CFG->wwwroot   = 'http://moodle-clp.local';
$CFG->dataroot  = 'C:\\xampp\\Moodle_clp_data';
$CFG->admin     = 'admin';

// Security and performance
$CFG->passwordsaltmain = 'random_salt_here_change_this';
$CFG->sessionhandlerclass = '\\core\\session\\handler';
$CFG->sessionhandlergroup = '\\core\\session\\handler';

// Debug settings (disable in production)
$CFG->debug = (E_ALL | E_STRICT);
$CFG->debugdisplay = 1;
$CFG->debugdeveloper = 1;

// Theme settings
// NOTE: No hardcoded $CFG->theme here. Setting it forces that theme and locks
// the admin "Themes" page ("The theme cannot be changed because it is set to
// Boost in config.php"). The active theme is instead chosen in the UI and
// stored in the mdl_config 'theme' row.

// Other settings
$CFG->sitename = 'CLP Moodle';
$CFG->release = '5.2.1+';

// File paths
$CFG->dirroot = __DIR__;

require_once(__DIR__ . '/lib/setup.php');
