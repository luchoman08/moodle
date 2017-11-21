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
// Get the HTML for the settings bits.

/**
 * Moodle's crisp theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_crisp
 * @copyright 2014 dualcube {@link http://dualcube.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//require_once($CFG->dirroot.'/calendar/lib.php');
$html = theme_crisp_get_html_for_settings($OUTPUT, $PAGE);
global $DB, $USER;
if (right_to_left()) {
    $regionbsid = 'region-bs-main-and-post';
} else {
    $regionbsid = 'region-bs-main-and-pre';
}
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
?>
<?php require('header.php'); ?>    

<div id="show-admin">
	<a class="admin-sets" href="#">
		<span></span>
	</a>
	<div class="adminset">  
	<?php if ($hassidepre) { ?>
		<?php echo $OUTPUT->blocks_for_region('side-pre') ?>
	<?php 
}
?>
	</div>
</div>
	
<div id="page-content" class="row-fluid">
	<div class="row-fluid">
		<section id="region-main" class="span12 pull-right">
			<!-- Necessary HTML -->
			<div class="row-fluid">
				<div class="span12">
					<div id="lemmon-slider">
						<div id="slider3" class="slider">
							<ul>
								<li>
									<div>

									<a href="http://dintev.univalle.edu.co/index.php/acceda-al-campus-virtual-desde-su-dispositivo-movil" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N1-MoodleMovil.png'; ?>" alt=""/></a>
									</div>
								</li>
								
								<li>
									<div>
										<a href="https://docs.moodle.org/all/es/Nuevas_caracter%C3%ADsticas_de_Moodle_2.9" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N2-Moodle2-9.png'; ?>" alt=""/></a>

									</div>
								</li>
								<li>
									<div>
										<a href="<?php echo $CFG->wwwroot.'/info-dintev/capacitacion-campus.php'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N3-CapacitacionCampus.png'; ?>" alt=""/></a>
									</div>
								</li>
								<li>
									<div>
										<a href="http://gdurl.com/dQFU" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N4-OfertaDintev.png'; ?>" alt=""/></a>
									</div>
								</li>
								<li>
									<div>
										<a href="<?php echo $CFG->wwwroot.'/info-dintev/instruccion-inscripciones-cursos.php'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N5-InstruccionesInscripciones.png'; ?>" alt=""/></a>
									</div>
								</li>
								<li>
									<div>
										<a href="<?php echo $CFG->wwwroot.'/info-dintev/encuesta-satisfaccion.php'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N6-EncuestaSatisfaccion.png'; ?>" alt=""/></a>
									
									</div>
                                </li>
                                <li>
                                	<div>
                                       <a href="<?php echo $CFG->wwwroot.'/info-dintev/CVUV_usuarios_2015.swf'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/campus2.png'; ?>" alt=""/></a>
									</div>
								</li>
								<li>
                                	<div>
                                       <a href="<?php echo $CFG->wwwroot.'/course/delete_course_old'; ?>"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/EliminarCursos.png'; ?>" alt=""/></a>
									</div>
								</li>
					<li>
									<div>
										<a href="http://talentospilos.univalle.edu.co/" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N7-TalentosPilos.png'; ?>" alt=""/></a>
									
									</div>
                        </li>	
	
						</div>
						<div class="controls">
							<a href="#" class="next-slide"></a>
							<a href="#" class="prev-slide"></a>
						</div>
					</div> <!-- end of lemmon slider -->
				</div> 
			</div> 
			<script>
				window.onload = function(){
         // home page slider 
			  $( '#slider3' ).lemmonSlider({ infinite: true});
					sliderAutoplay();
			  }
			  // autoplay
			  var sliderTimeout = null;
			  function sliderAutoplay(){
				  $( '#slider3' ).trigger( 'nextSlide' );
				  sliderTimeout = setTimeout( 'sliderAutoplay()', 3000 );
			  }
			</script>
			<div class="bodydetails">
				<div class="row-fluid">
					<div class="container">




	<hr>
<div id="msj-bienvenida-campus">

    Bienvenidos al Campus Virtual de la Universidad del Valle
</div></hr>
<center><img src="theme/AvisoImportanteGestionCampus.png"</center>

<hr> <h5><center>Estimados Estudiantes:</h5></center>

<p align="justify">  
Por limitaciones de espacio en disco se eliminarán los archivos que hayan sido creados en el año 2015 y anteriores, incluyendo los del área privada y los que han sido subidos en cumplimiento de actividades de aprendizaje (i.e. tareas, talleres, presentaciones, ensayos, etc). Le sugerimos que descargue lo que considere necesario conservar, antes de que sea eliminado. Recuerde que el plazo para hacerlo se <strong>vence el 30 de Septiembre de 2016</strong> y que a través de su correo institucional tiene la posibilidad de almacenar en Google Drive con capacidad ilimitada. Por un mejor servicio, agradecemos su colaboración.</p>




<hr> <h5><center>Estimados profesores:</h5></center>

<p align="justify">
Recordamos a todos los profesores que para liberar espacio en el disco del Servidor del Campus Virtual, en la página principal de sus cursos se encuentra la opción "Eliminar Cursos", que permitirá borrar aquellos que no utiliza. Recomendamos borrar los cursos que correspondan al año 2014 y anteriores. Por un mejor servicio del Campus, agradecemos su colaboración. Para cualquier información adicional comunicarse con el correo: campusvirtual@correounivalle.edu.co Tel: 3182612 o desde Univalle ext. 2612.</p>


</hr>

						<div class="shortnote">

								<div class="bodytexts">
									<div class="forsupport">
										<div class="icons">

											<a href="<?php echo $CFG->wwwroot.'/info-dintev/manuales.php';?>">
											<div id="ico-1" class="container"></div></a>
											

										</div>
										<div class="heads">

											<p style="color: #d51b23; padding-top: 6px; font-size: 17px;"><b><!-- 'Soporte' --></b></p>

										</div>
										<div class="texts">

											<p>Cómo ingresar al campus virtual<br>
												Inscripción de cursos (para profesores)<br>
												Gestión de recursos y actividades
											</p>
										</div>
									</div> <!-- end of forsupport -->

									<div class="forcourses">
										<div class="icons">

											<a href="<?php echo $CFG->wwwroot.'/info-dintev/cursospublicos.php';?>">
												<div id="ico-2" class="container"></div>
											</a>

										</div>
									<div class="heads">

                    <p style="color: #d51b23; padding-top: 6px; font-size: 17px;"><b><!-- Cursos--></b></p>

									</div>

									<div class="texts">
										<p>Cursos disponibles para invitados<br>
											(no requiere iniciar sesión)</p>
									</div>
								</div>  <!-- end of forcourses -->
								<div class="forforum">
									<div class="icons">
										<a href="<?php echo $CFG->wwwroot.'/info-dintev/cursos-demo.php';?>">
											<div id="ico-3" class="container"></div>
										</a>

									</div>
									<div class="heads">


                    <p style="color: #d51b23; padding-top: 6px; font-size: 17px;"><b><!-- Foros --></b></p>

									</div>
									<div class="texts">

										<p>Espacio para prácticas de prueba<br>
											sobre la plataforma Moodle
											del Campus Virtual</p>
									</div>
								</div> <!-- end of forforum -->
							</div>

                		</div> <!-- end of shortnote -->
					</div> <!-- end of span8 cust -->
					<!-- INFORMACION DINTEV -->	
					<!--<div class="span4" style="margin-left: 0;">
										
							<div id="info-portada">
								<div><h5>Información Contactos</h5></div>
								<p>Dirección de Nuevas Tecnologías y Educación Virtual-Dintev</br>
								 campusvirtual@correounivalle.edu.co</br>
								 Teléfono +57 3182649 ó 3212100 Ext 2649</br>
								 Edificio 317-CREE, Ciudadela Universitaria Meléndez</br>
								 Universidad del Valle</br>
								 Cali-Colombia
								</p>
							</div>

					</div> --><!-- end of span4 -->
			</div> <!-- end of bodydetails -->

	</div> <!-- end of span12 -->
</div>  <!-- end of row-fluid -->
			<div id="bodymaincontent" class="row-fluid">
			<?php
echo $OUTPUT->main_content();
?>
			</div>
		</section>
	</div>
</div>
<?php require('footer.php');
