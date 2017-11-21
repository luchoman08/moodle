<?php
	/**
	 * Este script permite detectar fraudes en los cuestionarios de moodle, funciona detectando cuando un usuario se conecta
	 * desde diferentes ip al contestar el quiz, y muestra un listado a los profesores con los usuario fraudulentos
	 * @author Hernán Darío Arango C. <hernan.arango@correounivalle.edu.co>
	 **/
	require('../../config.php');
	require_once($CFG->dirroot.'/course/lib.php');
	require_once($CFG->dirroot.'/report/log/locallib.php');
	require_once($CFG->libdir.'/adminlib.php');



	$idQuiz   = optional_param('quiz', 0, PARAM_INT);
	//$idquiz   = optional_param('cmid', 0, PARAM_INT);


	//echo "sdsdsdsdsd";


	if ($idQuiz) {
			if (!$cm = get_coursemodule_from_id('quiz', $idQuiz)) {
				print_error('invalidcoursemodule');
			}
			if (!$course = $DB->get_record('course', array('id' => $cm->course))) {
				print_error('coursemisconf');
			}
		}

	///se necesita estar logueado y el contexto
	require_login($course, false, $cm);

	$PAGE->set_url('/mod/quiz/fraudes.php', array('course'=>$idQuiz));


    $params = array();
    //codigo sin transformar
	$params['idquiz'] = $idQuiz;
	$add = "order by u.username DESC, l.id ASC";

 $query="SELECT  l.id, l.userid, l.timecreated,TO_CHAR(TO_TIMESTAMP(l.timecreated), 'DD/MM/YYYY HH24:MI:SS') as fecha,  u.username, (u.firstname ||' '|| u.lastname) as nombre_completo,l.ip, l.action,l.eventname FROM {user} u INNER JOIN  {logstore_standard_log} as l ON l.userid=u.id and l.contextinstanceid= :idquiz where l.userid=u.id and l.eventname like '%quiz%'";

    //SELECT l.id, l.url, l.userid, l.time,TO_CHAR(TO_TIMESTAMP(l.time), 'DD/MM/YYYY HH24:MI:SS') as fecha, u.username, (u.firstname ||' '|| u.lastname) as nombre_completo,l.ip, l.action,l.module FROM mdl_user u INNER JOIN mdl_log as l ON l.userid=u.id where l.userid=u.id and l.module='quiz' and l.action='attempt' or l.action='continue attempt' or l.action='close attempt' and l.cmid='2' order by u.username DESC
	$logs=$DB->get_records_sql("$query $add",$params);

	//creamos los encabezados de la tabla
    $table = new html_table();
    $table->classes = array('logtable','generaltable');
    $table->align = array('right', 'left', 'left');
    $table->head = array(
        "Codigo",
        get_string('fullnameuser'),
        get_string('ip_address'),
        "Hora Inicial",
        "Hora Final"


    );
    $table->data = array();



			//nombre del usuario que cometio fraude
			$nombreUsuarioFraude="";
			foreach($logs as $obj)
			{
				$ip=$obj->ip;
				$user=$obj->username;
				$listaIp = array();
				$listaIp[]=$obj;
				//si el usuario cometio fraude no seguimos analizando mas casos sobre el ya que es sospechoso
				if($nombreUsuarioFraude!=$user)
				{
					//comparamos al usuario con todas sus otras ip
					foreach($logs as $lista)
					{

						//se comparan los datos de un mismo usuario

						if($user==$lista->username)
						{
							//se comparan las ip
							if($ip!=$lista->ip)
							{
								//echo "<br>".$ip."!=".$lista->ip;
								if(verificarIpRepetida($listaIp,$lista->ip)==true)
								{
									$listaIp[]=$lista;
									$nombreUsuarioFraude=$user;

								}

							}
						}
					}
				}
				//si es mas de una ip la guardamos ya que si solo es una ip sería la ip inicial
				if (count($listaIp) > 1)
				{
					mostrarEnTabla($listaIp,$table,$logs,$idQuiz);
				}



			}

	/**
	 * verificarIpRepedida se encarga de mirar si la ip del usuario que se esta evaluando ya ha sido evaluada si es asi retorna true si no false
	 * @param object $listaIp contiene los objetos de la consulta que han arrojado ip diferentes (fraudulentas)
	 * @param int $ipActual ip que se esta evaluando en ese momento
	 * @return boolean retorna true si la ip no se encuentra en la lista y false en caso contrario
	 **/
	function verificarIpRepetida($listaIp,$ipActual){


		$aux=true;
		foreach	($listaIp as $lista){

			if($lista->ip==$ipActual){
				$aux=false;
				break;
			}

		}

		return $aux;


	}

	/**
	 *mostrarEnTabla se encarga de mostrar en la tabla los resultados de las ip fraudulentas
	 * @param object $listaIp contiene los objetos de la consulta que han arrojado ip diferentes (fraudulentas)
	 * @param object $table de la clase html_table() de moodle que permite crear una tabla en html
	 * @param object $logs objeto que contiene la consulta inicial que se realiza a la bd
	 * @param $idquiz identificador del quiz en la tabla mdl_log
	 **/
	function mostrarEnTabla($listaIp,$table,$logs,$idQuiz){
		foreach($listaIp as $lista){
			$row = array();
			//guardamos los datos del usuario en el array
			$row[]=$lista->username;
			$row[]=$lista->nombre_completo;
			$row[]=$lista->ip;
			$row[]=$lista->fecha;
			//miramos la hora de cierre
			$row[]=horaCierreQuiz($logs,$idQuiz,$lista->userid,$lista->ip,$lista->url,$lista->id,$lista->time,$lista->fecha);
			$table->data[] = $row;
		}
	}

	/**
	 * horaCierreQuiz se encarga de calcular la hora de cierre cuando un usuario contesta un quiz, si no cerro el quiz se aproxima a el ultimo tiempo que realizo un intento
	 * @param object $logs objeto que contiene la consulta inicial que se realiza a la bd
	 * @param $idquiz identificador del quiz en la tabla mdl_log
	 * @param $userid identificador del usuario
	 * @param $ip ip que se esta evaluando en el momento
	 * @param $url indica el intento del quiz
	 * @param $idLog identificador del log en la tabla mdl_log
	 * @param $fecha fecha que se esta evaluando en el momento, esta en formato similar a 453366442 no es timestamp,
	 * @param $fechaFormato la misma fecha anterior pero con formato humano
	 **/
	function horaCierreQuiz($logs,$idquiz,$userid,$ip,$url,$idLog,$fecha,$fechaFormato){


		//echo $query="SELECT action,TO_CHAR(TO_TIMESTAMP(l.time), 'DD/MM/YYYY HH24:MI:SS') as fecha FROM {log} as l WHERE l.id > $idLog and l.ip='$ip' and l.cmid='$idquiz' and l.userid='$userid' and l.url='$url' and l.action='close attempt'";

		//fecha maxima, fecha con la que inicio
		$maxFecha=$fecha;
		//cuando no cierra
		$fechaFinal=$fechaFormato;
		foreach($logs as $lista)
		{

			//comparamos que id > idactual y url==url ip==ip y userid==userid
			if($lista->id > $idLog && $lista->url==$url && $lista->ip==$ip && $lista->userid==$userid ){

				//si encuentra close attempt paramos y retornamos la fecha
				if($lista->action == 'close attempt'){
					$fechaFinal=$lista->fecha;
					break;
				}
				else{
						//calculamos el mayor de las fechas de los attempt ya que no cierra el quiz
						if($maxFecha < $lista->time){
							$maxFecha=$lista->time;
							$fechaFinal=$lista->fecha;
						}
				}
			}
		}

		return $fechaFinal;


	}


	$PAGE->set_title('Posibles Duplicaciones');
	$PAGE->set_heading(" ");
	$PAGE->navbar->add("Quiz, Posibles Publicaciones");
	echo $OUTPUT->header();
	echo html_writer::table($table);
	echo $OUTPUT->footer();
