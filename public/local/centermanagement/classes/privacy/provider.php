<?php
namespace local_centermanagement\privacy;

use core_privacy\local\metadata\provider as provider_base;
use core_privacy\local\metadata\collection;

defined('MOODLE_INTERNAL') || die();

class provider implements provider_base {

    public static function get_metadata(collection $collection) : collection {
        $collection->add_database_table(
            'local_centermanagement_centers',
            [
                'id' => 'privacy:metadata:local_centermanagement_centers:id',
                'center_code' => 'privacy:metadata:local_centermanagement_centers:center_code',
                'center_name' => 'privacy:metadata:local_centermanagement_centers:center_name',
                'school_name' => 'privacy:metadata:local_centermanagement_centers:school_name',
                'center_type' => 'privacy:metadata:local_centermanagement_centers:center_type',
                'division_id' => 'privacy:metadata:local_centermanagement_centers:division_id',
                'district_id' => 'privacy:metadata:local_centermanagement_centers:district_id',
                'upazila_id' => 'privacy:metadata:local_centermanagement_centers:upazila_id',
                'address' => 'privacy:metadata:local_centermanagement_centers:address',
                'contact_person' => 'privacy:metadata:local_centermanagement_centers:contact_person',
                'contact_number' => 'privacy:metadata:local_centermanagement_centers:contact_number',
                'email' => 'privacy:metadata:local_centermanagement_centers:email',
                'establishment_date' => 'privacy:metadata:local_centermanagement_centers:establishment_date',
                'start_date' => 'privacy:metadata:local_centermanagement_centers:start_date',
                'support' => 'privacy:metadata:local_centermanagement_centers:support',
                'sponsor_name' => 'privacy:metadata:local_centermanagement_centers:sponsor_name',
                'devices_count' => 'privacy:metadata:local_centermanagement_centers:devices_count',
                'students_count' => 'privacy:metadata:local_centermanagement_centers:students_count',
                'status' => 'privacy:metadata:local_centermanagement_centers:status',
                'image' => 'privacy:metadata:local_centermanagement_centers:image',
                'description' => 'privacy:metadata:local_centermanagement_centers:description',
                'timecreated' => 'privacy:metadata:local_centermanagement_centers:timecreated',
                'timemodified' => 'privacy:metadata:local_centermanagement_centers:timemodified',
                'usermodified' => 'privacy:metadata:local_centermanagement_centers:usermodified',
            ],
            'privacy:metadata:local_centermanagement_centers'
        );

        return $collection;
    }
}
