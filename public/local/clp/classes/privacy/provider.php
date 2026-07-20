<?php
// Privacy provider for local_clp.
namespace local_clp\privacy;

defined('MOODLE_INTERNAL') || die();

use core_privacy\local\metadata\collection;
use core_privacy\local\request\writer;

/**
 * Privacy provider for local_clp.
 */
class provider implements \core_privacy\local\metadata\provider,
                         \core_privacy\local\request\core_userlist_provider,
                         \core_privacy\local\request\plugin\provider {

    /**
     * Describe the stored data.
     *
     * @param collection $collection
     * @return collection
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_database_table(
            'clp_clc_participants',
            [
                'program' => 'privacy:metadata:clp_clc_participants:program',
                'name' => 'privacy:metadata:clp_clc_participants:name',
                'father_name' => 'privacy:metadata:clp_clc_participants:father_name',
                'mother_name' => 'privacy:metadata:clp_clc_participants:mother_name',
                'district' => 'privacy:metadata:clp_clc_participants:district',
                'division' => 'privacy:metadata:clp_clc_participants:division',
                'upazila' => 'privacy:metadata:clp_clc_participants:upazila',
                'mobile' => 'privacy:metadata:clp_clc_participants:mobile',
                'email' => 'privacy:metadata:clp_clc_participants:email',
                'gender' => 'privacy:metadata:clp_clc_participants:gender',
                'school' => 'privacy:metadata:clp_clc_participants:school',
                'month' => 'privacy:metadata:clp_clc_participants:month',
                'timecreated' => 'privacy:metadata:clp_clc_participants:timecreated',
            ],
            'privacy:metadata:clp_clc_participants'
        );

        return $collection;
    }

    /**
     * Get the list of users who have data in this plugin.
     *
     * @param string $userid The user ID.
     * @return array
     */
    public static function get_users_in_context(\context $context): array {
        global $DB;

        $users = [];
        $params = ['contextid' => $context->id];

        return $users;
    }
}
