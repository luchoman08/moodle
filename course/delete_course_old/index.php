<?php
	/**
	 * 
	 * @author Hernán Darío Arango C. <hernan.arango@yahoo.com>
	 **/
	require('../../config.php');

	global $USER;

	require_login();
	//creamos los encabezados de la tabla	
    $table = new html_table();
    $table->classes = array('logtable','generaltable');
    $table->head = array(
        "Codigo",
        "Nombre Curso",
        "Cedula",
        "Nombre",
        "Fecha de Creación",
        //"Tamaño",
        "Opción"

    );
    $table->data = array();			
	$anio=date('Y');
	$mesydia=date('m-d');
	//mostramos los cursos menores a un año del año actual
	$anio=$anio-1;
	$fecha=$anio."-".$mesydia;
	$aniotimestamp=strtotime($fecha);
	$sql="SELECT 
		  mdl_course.id,
		  mdl_course.shortname as codigocurso,
		  mdl_course.fullname, 
		  mdl_user.username as cedula, 
		  (mdl_user.firstname || ' ' || mdl_user.lastname) as nombreprofesor,
		  to_timestamp(mdl_course.timecreated) as fechacreacion
		FROM 
		  public.mdl_user, 
		  public.mdl_role_assignments, 
		  public.mdl_context, 
		  public.mdl_course
		WHERE 
		  mdl_role_assignments.userid = mdl_user.id AND
		  mdl_role_assignments.contextid = mdl_context.id AND
		  mdl_context.instanceid = mdl_course.id And mdl_user.id='$USER->id' AND mdl_role_assignments.roleid='3' and mdl_course.timecreated<='$aniotimestamp' and mdl_course.id!='1'";
	
	/*$sql="select mdl_course.id,
		 mdl_course.shortname as codigocurso,
		 mdl_course.fullname, 
		 mdl_user.username as cedula, 
		 (mdl_user.firstname || ' ' || mdl_user.lastname) as nombreprofesor,
		 to_timestamp(mdl_course.timecreated) as fechacreacion,
		  total.tamaniocurso
		FROM 
		  public.mdl_user
		INNER JOIN public.mdl_role_assignments
		ON mdl_user.id = mdl_role_assignments.userid

		INNER JOIN public.mdl_context
		ON mdl_role_assignments.contextid = mdl_context.id

		INNER JOIN public.mdl_course
		ON mdl_course.id = mdl_context.instanceid


		INNER JOIN (SELECT 
			  mdl_course.id,
			  sum(mdl_files.filesize) as tamaniocurso
			  
			FROM 
			  public.mdl_course, 
			  public.mdl_files, 
			  public.mdl_context, 
			  public.mdl_course_modules
			WHERE 
			  mdl_course.id = mdl_course_modules.course AND
			  mdl_context.id = mdl_files.contextid AND
			  mdl_context.instanceid = mdl_course_modules.id group by mdl_course.id
			  ) as total ON mdl_course.id = total.id
		 AND mdl_user.id='$USER->id' And mdl_role_assignments.roleid='3' and mdl_course.timecreated<='$aniotimestamp' and mdl_course.id!='1'";*/
  
	$result=$DB->get_records_sql($sql);
	
	//global $CFG;
	foreach ($result as $key => $obj) {
		$row=array();
		$row[]=$obj->codigocurso;
		$row[]="<a href='$CFG->wwwroot/course/view.php?id=$obj->id'>".$obj->fullname."</a>";
		$row[]=$obj->cedula;
		$row[]=$obj->nombreprofesor;
		$row[]=$obj->fechacreacion;
		//$row[]=format_tamanio($obj->tamaniocurso)."MB";
		$row[]="<a class='btn btn-default' href='#' onclick='eliminar($obj->id)'>Eliminar</a>";
		$table->data[] = $row;
	}
	
	$PAGE->set_title('Cursos Antiguos');
	$PAGE->set_heading(" ");
	$PAGE->navbar->add("Cursos Antiguos");
	echo $OUTPUT->header();
	$PAGE->requires->js('/course/delete_course_old/css/style.css');
	
	echo "<div id='myModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	  <div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
		<h3 id='myModalLabel'>¡Atención!</h3>
	  </div>
	  <div class='modal-body'>
		<div id='info-teacher-course'></div>

	  </div>
	  <div class='modal-footer'>
	<button id='eliminar' class='btn btn-primary'>Borrar</button>		
	<button class='btn btn-default' data-dismiss='modal' aria-hidden='true'>Cancelar</button>
		
	  </div>
	</div>";
	echo html_writer::table($table);
	//toca añadir a jquery externamente para que no genere problemas
	echo "<script
			  src='https://code.jquery.com/jquery-3.2.1.min.js'
			  integrity='sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4='
			  crossorigin='anonymous'></script>";
	$PAGE->requires->js('/course/delete_course_old/js/modal.js');
	echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>";
	echo $OUTPUT->footer();
	
	
