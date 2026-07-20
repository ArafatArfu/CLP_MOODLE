<?php
// Redirect to the CLC dashboard.
require_once(__DIR__ . '/../../config.php');
redirect(new moodle_url('/local/clp/dashboard.php', ['program' => 'clc']));
