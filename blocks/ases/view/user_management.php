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
 * General Reports
 *
 * @author     Iader E. García Gómez
 * @package    block_ases
 * @copyright  2016 Iader E. García <iadergg@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Standard GPL and phpdocs
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../managers/instance_management/instance_lib.php');
require_once('../managers/user_management/user_lib.php');

global $PAGE;

include("../classes/output/user_management_page.php");
include("../classes/output/renderer.php");


// Variables for setup the page.
$title = "Gestionar Roles";
$pagetitle = $title;
$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('instanceid', PARAM_INT);

require_login($courseid, false);

$contextcourse = context_course::instance($courseid);
$contextblock =  context_block::instance($blockid);
$url = new moodle_url("/blocks/ases/view/user_management.php", array('courseid' => $courseid, 'instanceid' => $blockid));

//se culta si la instancia ya está registrada
if(!consult_instance($blockid)){
    header("Location: instanceconfiguration.php?courseid=$courseid&instanceid=$blockid");
}

//obtiene las personas asociadas al curso.
$courseusers = get_course_usersby_id($courseid);

$table_courseuseres='';
$table_courseuseres.='<option value=""> ---------------------------------------</option>';
foreach ($courseusers as $courseuser) {
    $table_courseuseres.='<option value="'.$courseuser->codigo.'">'.$courseuser->codigo.' - '.$courseuser->nombre.' '.$courseuser->apellido.'</option>';
}




//Crea una clase con la información que se llevará al template.
$data = 'data';    
$data = new stdClass;
$data->table = $table_courseuseres;

//configuracion de la navegación
$coursenode = $PAGE->navigation->find($courseid, navigation_node::TYPE_COURSE);
$node = $coursenode->add('Gestion de roles del bloque',$url);
$node->make_active();

// Setup page
$PAGE->set_context($contextcourse);
$PAGE->set_context($contextblock);
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);

$PAGE->requires->css('/blocks/ases/style/styles_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/bootstrap_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/bootstrap_pilos.min.css', true);
$PAGE->requires->css('/blocks/ases/style/round-about_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/sweetalert.css', true);
$PAGE->requires->css('/blocks/ases/style/forms_pilos.css', true);
$PAGE->requires->css('/blocks/ases/style/add_fields.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.foundation.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.foundation.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.jqueryui.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/dataTables.jqueryui.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables.min.css', true);
$PAGE->requires->css('/blocks/ases/js/DataTables-1.10.12/css/jquery.dataTables_themeroller.css', true);
$PAGE->requires->css('/blocks/ases/js/select2/css/select2.css', true);


// $PAGE->requires->js('/blocks/ases/js/main.js', true);
// //$PAGE->requires->js('/blocks/ases/js/checkrole.js', true);
// $PAGE->requires->js('/blocks/ases/js/jquery.validate.min.js', true);
// $PAGE->requires->js('/blocks/ases/js/npm.js', true);
// $PAGE->requires->js('/blocks/ases/js/role_management.js', true);



$output = $PAGE->get_renderer('block_ases');
$index_page = new \block_ases\output\user_management_page($data);

echo $output->header();

echo $output->render($index_page);
echo $output->footer();