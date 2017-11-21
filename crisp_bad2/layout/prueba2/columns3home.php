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
								<ul><!--
									<li>
										<div>
											<a href="http://gdurl.com/dQFU" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/OfertaDintev.png'; ?>" alt=""/></a>
										</div>
									</li>-->
									<li>
										<div>
											<a href="<?php echo $CFG->wwwroot.'/info-dintev/instruccion-inscripciones-cursos.php'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N5-InstruccionesInscripciones.png'; ?>" alt=""/></a>
										</div>
									</li>
<li>
                                                                        <div>
                                                                                <a href="http://dintev.univalle.edu.co/index.php/2-uncategorised/58-memorias-encuentro" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N-Encuentro30Nov.png'; ?>" alt=""/></a>

  
                                                                        </div>
</li>
 <li>
                                                                        <div>
                                                                                <a href="http://dintev.univalle.edu.co/index.php/2-uncategorised/55-de-videoconferencias-y-tortugas" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N-VCIbiologia.jpg'; ?>" alt=""/></a>

  
                                                                        </div>
</li>

 <li>
                                                                        <div>
                                                                                <a href="http://dintev.univalle.edu.co/index.php/10-boletin/57-invitacion-encuentro" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/N-MeryCruz.jpg'; ?>" alt=""/></a>

  
                                                                        </div>
</li>
									<!--
									<li>
										<div>
									
									 <a href="http://www.plandecenal.edu.co/" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/U3.png'; ?>" alt=""/></a>	
										</div>
	                                </li>
	                            -->
	                                <li>
	                                	<div>
	                                       <a href="<?php echo $CFG->wwwroot.'/info-dintev/CVUV_usuarios_2015.swf'; ?>" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/campus2.png'; ?>" alt=""/></a>
										</div>
									</li>
									<!--
									<li>
	                                	<div>
	                                       <a href="<?php echo $CFG->wwwroot.'/course/delete_course_old'; ?>"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/EliminarCursos.png'; ?>" alt=""/></a>
										</div>
									</li>
									-->
									<li>
										<div>
											<a href="http://talentospilos.univalle.edu.co/" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/pilos_2016.png'; ?>" alt=""/></a>
										</div>
	                        		</li>
	                        		<li>
										<div>
											<a href="https://sites.google.com/a/correounivalle.edu.co/herramientas-informaticas/" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/BannerWolfram.jpg'; ?>" alt=""/></a>
										</div>
	                        		</li>	
<li>
                                                                        <div>
                                                                                <a href="http://dintev.univalle.edu.co/formacion/para-profesores/" target="_blank"><img src="<?php echo $CFG->wwwroot.'/theme/'.$CFG->theme.'/img/ofertadocente.png'; ?>" alt=""/></a>

                     
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
<!--
<center><hr><b>Estimados usuarios del Campus Virtual</b></hr></center>
<p></p>
<center><hr><b>ATENCION: MANTENIMIENTO EN LA RED DE UNIVALLE</b></hr></center>

<p></p>
<p align="justify">

El jueves 15 de diciembre a las 9pm se ha programado una actividad de mejoramiento en la red institucional por parte de la OITEL. Con esta actividad se pretende recobrar la estabilidad en el servicio de conectividad, que ha estado afectado en los últimos días. Esta actividad de mejoramiento  ocasionará una afectación en el servicio del Campus Virtual entre las 9pm y las 10pm. Les recomendamos tomar este aviso en consideración, para que todas las actividades del Campus Virtual que tengan planificadas para ese día, las procuren realizar antes de las 9pm.

<p align="justify">
En el caso de los profesores, que tengan programadas actividades en ese horario, les solicitamos el favor de reprogramarlas.
</p>
<p></p>
<p align="justify">
Cordialmente,

<p><br>Dirección de Nuevas Tecnologías y Educación Virtual
<br>Universidad del Valle
<br>Cali, Colombia
</br>
</p>
-->

<!--  
        <div id="msj-bienvenida-campus">

            Bienvenidos al Campus Virtual de la Universidad del Valle
        </div>
<center><img src="theme/AvisoImportanteGestionCampus.png"</center>

<hr> <h5><center>Estimados profesores:</h5></center>

<p align="justify"> Recordamos a todos los profesores que para liberar espacio en el disco del Servidor del Campus Virtual, en la página principal de sus cursos se encuentra la opción "Eliminar Cursos", que permitirá borrar aquellos que no utiliza. Recomendamos borrar sus cursos antiguos a partir del 2014 o anteriores. Por un mejor servicio del Campus, agradecemos su colaboración.

Para cualquier información adicional comunicarse con el correo: campusvirtual@correounivalle.edu.co  Tel: 3182612 o univalle 2612</p>
</hr>
-->

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
