<?php
namespace local_centermanagement\output;

use local_centermanagement\local\center_repository;

defined('MOODLE_INTERNAL') || die();

class renderer extends \plugin_renderer_base {

    public function render_center_list($filters, $sort, $page, $perpage) {
        $data = center_repository::get_centers($filters, $perpage, ($page - 1) * $perpage, $sort);
        $total = $data['total'];
        $centers = $data['centers'];

        $output = '';

        $addurl = new \moodle_url('/local/centermanagement/add.php');
        $output .= html_writer::link($addurl, get_string('addcenter', 'local_centermanagement'), ['class' => 'btn btn-primary mb-3']);

        $output .= html_writer::start_tag('form', ['method' => 'get', 'action' => (new \moodle_url('/local/centermanagement/index.php'))->out(), 'class' => 'form-inline mb-3']);
        $output .= html_writer::empty_tag('input', ['type' => 'text', 'name' => 'search', 'value' => s($filters['search'] ?? ''), 'class' => 'form-control mr-2', 'placeholder' => get_string('searchbyname', 'local_centermanagement')]);
        $output .= html_writer::start_tag('select', ['name' => 'center_type', 'class' => 'form-control mr-2']);
        $output .= html_writer::tag('option', get_string('filterbytype', 'local_centermanagement'), ['value' => '']);
        $output .= html_writer::tag('option', get_string('clc', 'local_centermanagement'), ['value' => 'clc', 'selected' => ($filters['center_type'] ?? '') === 'clc' ? 'selected' : '']);
        $output .= html_writer::tag('option', get_string('scr', 'local_centermanagement'), ['value' => 'scr', 'selected' => ($filters['center_type'] ?? '') === 'scr' ? 'selected' : '']);
        $output .= html_writer::tag('option', get_string('centertypeclcscr', 'local_centermanagement'), ['value' => 'clc_scr', 'selected' => ($filters['center_type'] ?? '') === 'clc_scr' ? 'selected' : '']);
        $output .= html_writer::tag('option', get_string('centertypeother', 'local_centermanagement'), ['value' => 'other', 'selected' => ($filters['center_type'] ?? '') === 'other' ? 'selected' : '']);
        $output .= html_writer::end_tag('select');
        $output .= html_writer::start_tag('select', ['name' => 'status', 'class' => 'form-control mr-2']);
        $output .= html_writer::tag('option', get_string('filterbystatus', 'local_centermanagement'), ['value' => '']);
        $output .= html_writer::tag('option', get_string('statusactive', 'local_centermanagement'), ['value' => '1', 'selected' => ($filters['status'] ?? '') === '1' ? 'selected' : '']);
        $output .= html_writer::tag('option', get_string('statusinactive', 'local_centermanagement'), ['value' => '0', 'selected' => ($filters['status'] ?? '') === '0' ? 'selected' : '']);
        $output .= html_writer::end_tag('select');
        $output .= html_writer::empty_tag('input', ['type' => 'submit', 'value' => get_string('search'), 'class' => 'btn btn-primary mr-2']);
        $output .= html_writer::link(new \moodle_url('/local/centermanagement/index.php'), get_string('reset'), ['class' => 'btn btn-secondary']);
        $output .= html_writer::end_tag('form');

        $output .= html_writer::start_tag('table', ['class' => 'table table-bordered table-striped']);
        $output .= html_writer::start_tag('thead');
        $output .= html_writer::start_tag('tr');
        $output .= html_writer::tag('th', get_string('sl', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('centername', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('division', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('district', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('upazila', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('startdate', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('centertype', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('sponsor', 'local_centermanagement'));
        $output .= html_writer::tag('th', get_string('actions', 'local_centermanagement'));
        $output .= html_writer::end_tag('tr');
        $output .= html_writer::end_tag('thead');

        $output .= html_writer::start_tag('tbody');
        if (empty($centers)) {
            $output .= html_writer::tag('tr', html_writer::tag('td', get_string('nocentersfound', 'local_centermanagement'), ['colspan' => '9', 'class' => 'text-center']));
        } else {
            $sl = ($page - 1) * $perpage + 1;
            foreach ($centers as $center) {
                $viewurl = new \moodle_url('/local/centermanagement/view.php', ['id' => $center->id]);
                $editurl = new \moodle_url('/local/centermanagement/edit.php', ['id' => $center->id]);
                $deleteurl = new \moodle_url('/local/centermanagement/delete.php', ['id' => $center->id]);

                $actions = '';
                if (\local_centermanagement\local\center_manager::can_view_centers()) {
                    $actions .= html_writer::link($viewurl, get_string('view'), ['class' => 'btn btn-sm btn-primary mr-1']);
                }
                if (\local_centermanagement\local\center_manager::can_edit_center()) {
                    $actions .= html_writer::link($editurl, get_string('edit'), ['class' => 'btn btn-sm btn-secondary mr-1']);
                }
                if (\local_centermanagement\local\center_manager::can_manage_centers()) {
                    if ($center->status) {
                        $unpublishurl = new \moodle_url('/local/centermanagement/index.php', ['action' => 'unpublish', 'id' => $center->id, 'sesskey' => sesskey()]);
                        $actions .= html_writer::link($unpublishurl, get_string('unpublish', 'local_centermanagement'), ['class' => 'btn btn-sm btn-warning mr-1']);
                    } else {
                        $publishurl = new \moodle_url('/local/centermanagement/index.php', ['action' => 'publish', 'id' => $center->id, 'sesskey' => sesskey()]);
                        $actions .= html_writer::link($publishurl, get_string('publish', 'local_centermanagement'), ['class' => 'btn btn-sm btn-success mr-1']);
                    }
                    $duplicateurl = new \moodle_url('/local/centermanagement/index.php', ['action' => 'duplicate', 'id' => $center->id, 'sesskey' => sesskey()]);
                    $actions .= html_writer::link($duplicateurl, get_string('duplicatecenter', 'local_centermanagement'), ['class' => 'btn btn-sm btn-info mr-1']);
                }
                if (\local_centermanagement\local\center_manager::can_delete_center()) {
                    $deleteurl = new \moodle_url('/local/centermanagement/delete.php', ['id' => $center->id]);
                    $actions .= html_writer::link($deleteurl, get_string('delete'), ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("' . get_string('deleteconfirmmsg', 'local_centermanagement') . '")']);
                }

                $type = strtolower($center->center_type ?? 'clc');
                $typelabel = $type == 'scr' ? get_string('centertypescr', 'local_centermanagement') : ($type == 'clc_scr' ? get_string('centertypeclcscr', 'local_centermanagement') : ($type == 'other' ? get_string('centertypeother', 'local_centermanagement') : get_string('centertypeclc', 'local_centermanagement')));

                $startdate = '';
                if (!empty($center->start_date)) {
                    $startdate = userdate($center->start_date, get_string('strftimedate', 'langconfig'));
                }

                $output .= html_writer::start_tag('tr');
                $output .= html_writer::tag('td', $sl);
                $output .= html_writer::tag('td', s($center->center_name ?? ''));
                $output .= html_writer::tag('td', s($center->division ?? ''));
                $output .= html_writer::tag('td', s($center->district ?? ''));
                $output .= html_writer::tag('td', s($center->upazila ?? ''));
                $output .= html_writer::tag('td', $startdate);
                $output .= html_writer::tag('td', s($typelabel));
                $output .= html_writer::tag('td', s($center->sponsor_name ?? ''));
                $output .= html_writer::tag('td', $actions);
                $output .= html_writer::end_tag('tr');
                $sl++;
            }
        }
        $output .= html_writer::end_tag('tbody');
        $output .= html_writer::end_tag('table');

        if ($total > $perpage) {
            $output .= html_writer::start_tag('nav');
            $output .= html_writer::start_tag('ul', ['class' => 'pagination']);
            $prevpage = max(1, $page - 1);
            $nextpage = $page + 1;
            $prevurl = new \moodle_url('/local/centermanagement/index.php', array_merge($_GET, ['page' => $prevpage]));
            $nexturl = new \moodle_url('/local/centermanagement/index.php', array_merge($_GET, ['page' => $nextpage]));

            $output .= html_writer::tag('li', html_writer::link($prevurl, get_string('previous'), ['class' => 'page-link']), ['class' => 'page-item' . ($page <= 1 ? ' disabled' : '')]);
            $output .= html_writer::tag('li', html_writer::link($nexturl, get_string('next'), ['class' => 'page-link']), ['class' => 'page-item' . ($page * $perpage >= $total ? ' disabled' : '')]);
            $output .= html_writer::end_tag('ul');
            $output .= html_writer::end_tag('nav');
        }

        return $output;
    }
}
