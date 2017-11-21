<?php 

require_once(dirname(__FILE__).'/../../../config.php');

function xmldb_block_ases_upgrade($oldversion = 0) {
    global $DB;
    $dbman = $DB->get_manager();

    $result = true;

    /// Add a new column newcol to the mdl_myqtype_options
    if ($result && $oldversion < 201709200638) {
        
        // Define field id_semestre to be added to talentospilos_monitor_estud.
        $table = new xmldb_table('talentospilos_monitor_estud');
        $field = new xmldb_field('id_semestre', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id_instancia');

        // Conditionally launch add field id_semestre.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define key semester_fk (foreign) to be added to talentospilos_monitor_estud.
        //$table = new xmldb_table('talentospilos_monitor_estud');
        //$key = new xmldb_key('semester_fk', XMLDB_KEY_FOREIGN, array('id_semestre'), 'talentospilos_semestre', array('id'));

        // Launch add key mon_est_pk1.
        //$dbman->add_key($table, $key);


         // Define key mon_est_un (unique) to be added to talentospilos_monitor_estud.
        $table = new xmldb_table('talentospilos_monitor_estud');
        $key = new xmldb_key('unique_key_1', XMLDB_KEY_UNIQUE, array('id_monitor', 'id_estudiante', 'id_instancia', 'id_semestre'));

        // Launch add key mon_est_un.
        $dbman->add_key($table, $key);

        // Define key mon_est_un (unique) to be dropped form talentospilos_monitor_estud.
        $table = new xmldb_table('talentospilos_monitor_estud');
        $key = new xmldb_key('mon_est_un', XMLDB_KEY_UNIQUE, array('id_monitor', 'id_estudiante', 'id_instancia'));

        // Launch drop key mon_est_un.
        $dbman->drop_key($table, $key);


        // Ases savepoint reached.
        upgrade_block_savepoint(true, 201709211100, 'ases');
    }
    return $result;
}

?>

