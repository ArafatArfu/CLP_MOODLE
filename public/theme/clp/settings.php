<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

if (!class_exists('theme_clp_admin_settingspage_tabs', false) && class_exists('admin_settingpage', false)) {
    /**
     * CLP theme settings page rendered with tabs.
     *
     * @package    theme_clp
     * @copyright  2024 CLP
     * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
     */
    class theme_clp_admin_settingspage_tabs extends admin_settingpage {

        /** @var array List of tab pages. */
        protected $tabs = array();

        /**
         * Add a tab page to this settings page.
         *
         * @param admin_settingpage $tab The page to add as a tab.
         */
        public function add_tab(admin_settingpage $tab) {
            foreach ($tab->settings as $setting) {
                $this->settings->{$setting->name} = $setting;
            }
            $this->tabs[] = $tab;
            return true;
        }

        /**
         * Add a tab page to this settings page.
         *
         * @param admin_settingpage $tab The page to add as a tab.
         */
        public function add($tab) {
            return $this->add_tab($tab);
        }

        /**
         * Get the list of tabs.
         *
         * @return array
         */
        public function get_tabs() {
            return $this->tabs;
        }

        /**
         * Output the settings page with a tab navigation.
         *
         * @return string
         */
        public function output_html() {
            global $OUTPUT;

            $activetab = optional_param('activetab', '', PARAM_TEXT);
            $context = array('tabs' => array());
            $havesetactive = false;

            foreach ($this->get_tabs() as $tab) {
                $active = false;

                if (empty($activetab) && !$havesetactive) {
                    $active = true;
                    $havesetactive = true;
                } else if ($activetab === $tab->name) {
                    $active = true;
                }

                $context['tabs'][] = array(
                    'name' => $tab->name,
                    'displayname' => $tab->visiblename,
                    'html' => $tab->output_html(),
                    'active' => $active,
                );
            }

            if (empty($context['tabs'])) {
                return '';
            }

            return $OUTPUT->render_from_template('theme_clp/admin_setting_tabs', $context);
        }
    }
}

if ($ADMIN->fulltree) {
    $settings = new theme_clp_admin_settingspage_tabs('themesettingclp', get_string('clp', 'theme_clp'));

    $page = new admin_settingpage('theme_clp_general', get_string('generalsettings', 'theme_clp'));

    // Preset.
    $name = 'theme_clp/preset';
    $title = get_string('preset', 'theme_clp');
    $description = get_string('preset_desc', 'theme_clp');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_clp', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }

    $choices['default.scss'] = 'Default preset';
    $choices['plain.scss'] = 'Plain preset';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Brand color.
    $name = 'theme_clp/brandcolor';
    $title = get_string('brandcolor', 'theme_clp');
    $description = get_string('brandcolor_desc', 'theme_clp');
    $default = '#006b4f';

    $previewconfig = null;
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    $page->add($setting);

    // Raw SCSS to include.
    $name = 'theme_clp/scss';
    $title = get_string('rawscss', 'theme_clp');
    $description = get_string('rawscss_desc', 'theme_clp');
    $default = '';

    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    $settings->add_tab($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_clp_advanced', get_string('advancedsettings', 'theme_clp'));

    // SCSS before content.
    $name = 'theme_clp/scsspre';
    $title = get_string('scsspre', 'theme_clp');
    $description = get_string('scsspre_desc', 'theme_clp');
    $default = '';

    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $page->add($setting);

    $settings->add_tab($page);
}
