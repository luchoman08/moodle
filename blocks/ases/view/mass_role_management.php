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

/**
 * Ases block
 *
 * @author     John Lourido
 * @package    block_ases
 * @copyright  2017 John Lourido <jhonkrave@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Standard GPL and phpdocs
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../managers/query.php');
include('../lib.php');
global $PAGE;
require_once('../managers/instance_management/instance_lib.php');

include("../classes/output/mass_role_management.php");
include("../classes/output/renderer.php");

// Set up the page.
$title = get_string('pluginname', 'block_ases');
$pagetitle = $title;
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('instanceid', PARAM_INT);

require_login($courseid, false);

$contextcourse = context_course::instance($courseid);
$contextblock =  context_block::instance($blockid);

$url = new moodle_url("/blocks/ases/view/mass_role_management.php",array('courseid' => $courseid, 'instanceid' => $blockid));
//$url =  $CFG->wwwroot."/blocks/ases/view/index.php?courseid=".$courseid."&instanceid=".$blockid;

//Configuracion de la navegacion
$coursenode = $PAGE->navigation->find($courseid, navigation_node::TYPE_COURSE);
$blocknode = navigation_node::create('Roles y Seguimientos',$url, null, 'block', $blockid);
$coursenode->add_node($blocknode);
$blocknode->make_active();

//se culta si la instancia ya está registrada
if(!consult_instance($blockid)){
    header("Location: instanceconfiguration.php?courseid=$courseid&instanceid=$blockid");
}


$PAGE->requires->css('/blocks/ases/style/styles_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/bootstrap_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/bootstrap_pilos.min.css', true);
$PAGE->requires->css('/blocks/ases/style/sweetalert.css', true);
$PAGE->requires->css('/blocks/ases/style/round-about_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/forms_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/add_fields.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.foundation.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.foundation.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.jqueryui.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.jqueryui.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables_themeroller.css', true);

$PAGE->requires->js('/blocks/ases/js/jquery-2.0.2.min.js', true);
$PAGE->requires->js('/blocks/ases/js/checkrole.js', true);


$PAGE->set_url($url);
$PAGE->set_title($title);

$PAGE->set_heading($title);

$output = $PAGE->get_renderer('block_ases');
$index_page = new \block_ases\output\mass_role_management('Some text');

// if(true){
//     $url = new moodle_url("/blocks/ases/view/instanceconfiguration.php",array('courseid' => $courseid, 'instanceid' => $blockid));
//     $PAGE->set_url($url);
//     $output = $PAGE->get_renderer('block_ases');
//     $index_page = new \block_ases\output\instanceconfiguration_page('Some text');
// }

//echo $output->standard_head_html(); 
echo $output->header();

echo $output->render($index_page);
echo $output->footer();