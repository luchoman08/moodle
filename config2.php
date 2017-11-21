<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'moodle32';
$CFG->dbuser    = 'moodle32';
$CFG->dbpass    = 'd1nt3vm00dl3';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 5432,
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://192.168.117.40/moodle32A';
$CFG->dataroot  = '/vhosts/campus/moodledata32';
$CFG->admin     = 'admin';
//$CFG->directorypermissions = 0777;
//$CFG->jUIversion = 'ui-1.11.4';
$CFG->bloquePersonalizado = true;
require_once(__DIR__ . '/lib/setup.php');
//Tratando de resolver problema con jquery

$CFG->cachejs = false;
$CFG->yuicomboloading = false;
$CFG->yuiloglevel = 'debug';
//$CFG->debug = 32767;
// There is no php closing tag in this file,


// it is intentional because it prevents trailing whitespace problems!
