<?php
// Upgrade script for local_clp.

defined('MOODLE_INTERNAL') || die();

/**
 * Build the CLC participants table definition and create it if missing.
 *
 * @param xmldb_manager $dbman
 */
function local_clp_create_participants_table($dbman): void {
    $table = new xmldb_table('clp_clc_participants');

    $table->add_field('id', XMLDB_TYPE_INTEGER, 10, null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
    $table->add_field('program', XMLDB_TYPE_CHAR, 30, null, XMLDB_NOTNULL, null, 'clc');
    $table->add_field('name', XMLDB_TYPE_CHAR, 200, null, XMLDB_NOTNULL);
    $table->add_field('father_name', XMLDB_TYPE_CHAR, 200, null, XMLDB_NOTNULL);
    $table->add_field('mother_name', XMLDB_TYPE_CHAR, 200, null, XMLDB_NOTNULL);
    $table->add_field('district', XMLDB_TYPE_CHAR, 100, null, XMLDB_NOTNULL);
    $table->add_field('division', XMLDB_TYPE_CHAR, 100, null, XMLDB_NOTNULL);
    $table->add_field('upazila', XMLDB_TYPE_CHAR, 100, null, XMLDB_NOTNULL);
    $table->add_field('mobile', XMLDB_TYPE_CHAR, 30, null, XMLDB_NOTNULL);
    $table->add_field('email', XMLDB_TYPE_CHAR, 254, null, XMLDB_NOTNULL);
    $table->add_field('gender', XMLDB_TYPE_CHAR, 20, null, XMLDB_NOTNULL);
    $table->add_field('school', XMLDB_TYPE_CHAR, 200, null, XMLDB_NOTNULL);
    $table->add_field('month', XMLDB_TYPE_INTEGER, 2, null, XMLDB_NOTNULL, null, 0);
    $table->add_field('timecreated', XMLDB_TYPE_INTEGER, 10, null, XMLDB_NOTNULL, null, 0);

    $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
    $table->add_index('programidx', XMLDB_INDEX_NOTUNIQUE, ['program']);

    if (!$dbman->table_exists($table)) {
        $dbman->create_table($table);
    }
}

/**
 * Generate and insert demo participants for CLC.
 *
 * @param int $count
 */
function local_clp_seed_participants(int $count): void {
    global $DB;

    $divisions = [
        'Dhaka' => ['Dhaka' => ['Savar', 'Keraniganj', 'Dhamrai'], 'Gazipur' => ['Gazipur Sadar', 'Kaliakair'], 'Narsingdi' => ['Narsingdi Sadar', 'Madhabdi']],
        'Chittagong' => ['Chittagong' => ['Hathazari', 'Patiya'], "Cox's Bazar" => ["Cox's Bazar Sadar", 'Teknaf'], 'Comilla' => ['Comilla Sadar', 'Laksam']],
        'Khulna' => ['Khulna' => ['Khulna Sadar', 'Dumuria'], 'Jessore' => ['Jessore Sadar', 'Chaugachha'], 'Satkhira' => ['Satkhira Sadar', 'Kalaroa']],
        'Rajshahi' => ['Rajshahi' => ['Rajshahi Sadar', 'Puthia'], 'Bogra' => ['Bogra Sadar', 'Shibganj'], 'Pabna' => ['Pabna Sadar', 'Ishwardi']],
        'Barisal' => ['Barisal' => ['Barisal Sadar', 'Babuganj'], 'Patuakhali' => ['Patuakhali Sadar', 'Kuakata']],
        'Sylhet' => ['Sylhet' => ['Sylhet Sadar', 'Golapganj'], 'Moulvibazar' => ['Moulvibazar Sadar', 'Sreemangal']],
        'Rangpur' => ['Rangpur' => ['Rangpur Sadar', 'Badarganj'], 'Dinajpur' => ['Dinajpur Sadar', 'Pirganj']],
        'Mymensingh' => ['Mymensingh' => ['Mymensingh Sadar', 'Trishal'], 'Jamalpur' => ['Jamalpur Sadar', 'Sarishabari']],
    ];

    $male = ['Arif', 'Rakib', 'Tanvir', 'Siam', 'Imran', 'Farhan', 'Nayeem', 'Rifat', 'Saiful', 'Mahmud', 'Jahid', 'Tariq'];
    $female = ['Ayesha', 'Fatima', 'Sumaiya', 'Nusrat', 'Sabrina', 'Rumpa', 'Lamisa', 'Tania', 'Mahmuda', 'Salma', 'Riya', 'Anika'];
    $surnames = ['Rahman', 'Hossain', 'Ahmed', 'Khan', 'Islam', 'Mia', 'Sheikh', 'Sarkar', 'Das', 'Paul', 'Chowdhury', 'Akter'];
    $schools = ['Govt. High School', 'Model School', 'Ideal School', 'Rural Primary School', 'Central School', 'Pioneer School', 'Shahid School', 'Udayan School'];

    $divisionnames = array_keys($divisions);

    for ($i = 1; $i <= $count; $i++) {
        $gender = $i % 3 === 0 ? 'Female' : 'Male';
        $firstpool = $gender === 'Female' ? $female : $male;
        $firstname = $firstpool[array_rand($firstpool)];
        $lastname = $surnames[array_rand($surnames)];

        $division = $divisionnames[array_rand($divisionnames)];
        $districts = array_keys($divisions[$division]);
        $district = $districts[array_rand($districts)];
        $upazilas = $divisions[$division][$district];
        $upazila = $upazilas[array_rand($upazilas)];

        $mobile = '01' . (array_rand([7 => 1, 8 => 1, 9 => 1])) . rand(10000000, 99999999);
        $email = strtolower($firstname) . '.' . strtolower($lastname) . $i . '@example.org';
        $school = $schools[array_rand($schools)];

        $record = (object)[
            'program' => 'clc',
            'name' => $firstname . ' ' . $lastname,
            'father_name' => $male[array_rand($male)] . ' ' . $lastname,
            'mother_name' => $female[array_rand($female)] . ' ' . $lastname,
            'district' => $district,
            'division' => $division,
            'upazila' => $upazila,
            'mobile' => $mobile,
            'email' => $email,
            'gender' => $gender,
            'school' => $school,
            'timecreated' => time() - rand(0, 86400 * 120),
        ];

        $DB->insert_record('clp_clc_participants', $record, false);
    }
}

/**
 * Local plugin upgrade task.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_clp_upgrade($oldversion) {
    global $DB;

    if ($oldversion < 2026071900) {
        $dbman = $DB->get_manager();
        local_clp_create_participants_table($dbman);

        if (!$DB->record_exists('clp_clc_participants', [])) {
            local_clp_seed_participants(120);
        }

        upgrade_plugin_savepoint(true, 2026071900, 'local', 'clp');
    }

    return true;
}
