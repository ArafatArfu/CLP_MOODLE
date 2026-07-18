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

namespace theme_clp\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Renderers to align Moodle's HTML with the CLP theme.
 *
 * @package    theme_clp
 * @copyright  2024 CLP
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_classic\output\core_renderer {

    /**
     * Returns the image URL for use in the theme.
     *
     * @param string $image The image name.
     * @param string $component The component name.
     * @return string The URL.
     */
    public function clp_image_url($image, $component = 'theme_clp') {
        global $CFG;
        return $CFG->wwwroot . '/theme/clp/assets/images/' . $image;
    }

    /**
     * Returns the slider image URL.
     *
     * @return string The URL.
     */
    public function clp_slider_image() {
        return $this->clp_image_url('slider/homeSlider/clc_slider1.jpg');
    }
}
