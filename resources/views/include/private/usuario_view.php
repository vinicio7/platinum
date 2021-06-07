<?php
	/*-------------------------
	USER VIEW
	Autor: Gustavo Blanco
	Web: chofo7.blogspot.com
	Mail: chofo7@gmail.com
	---------------------------*/
	
	// Notificar todos los errores excepto E_NOTICE
	error_reporting(E_ALL ^ E_NOTICE);

  	session_start(); //validacion para la sesion
  	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) 
  	{ header("location: ../public/login_form.php");    exit; }

	//Base de Datos
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

	//TIPO_USUARIO
	$id_users = $_SESSION['id_users'];
	$username = $_SESSION['username'];
	$usertipe = $_SESSION['usertipe'];
	if ($usertipe == 1) {
		$usertipe = "Administrador";
	} else {
		if ($usertipe == 2) {
			$usertipe = "Gerente";
		} else {
			if ($usertipe == 3) {
				$usertipe = "Asesor Interno";
			} else {
				if ($usertipe == 4) {
					$usertipe = "Asesor Externo";
				} else {
					if ($usertipe == 5) {
						$usertipe = "Propietario";
					} else {
						if ($usertipe == 6) {
							$usertipe = "Cliente";
						} else {
							$usertipe = "ID: " . $usertipe;
						}
					}
				}
			}
		}
	}

	$us_sn_fb  = "https://www.facebook.com/PropiedadesPlatinum/";
	$us_sn_tw  = "https://twitter.com/alzugaraysarah";
	$us_sn_in  = "https://www.instagram.com/propiedades_platinum/";
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php';?>
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php';?>
	<div class="contenedor bg-light" id="contenedor">
		<div class="container-fluid bg-primary bg-blue-gradient "></div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

				<?php
				if (!empty($_GET ['id'])) {$id = $_GET['id'];} else {$id = '1';}
				
				//CONSULTA PARA AGENTE_INTERNO
				$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $id . "'");
				$data_user = mysqli_num_rows($query_user);
				$ferow = mysqli_fetch_array($query_user);
				if ($data_user > 0) 
				{		
					$aseso_id = $ferow['id_users'];  //Usuario Datos ID
					$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
					$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
					$aseso_us = utf8_encode($ferow['username']);  //Usuario USER
					$aseso_ps = $ferow['userpass'];  //Usuario PASS
					$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
					$aseso_fi = $ferow['datadded'];  //Usuario Fecha de Ingreso
					$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
					$aseso_es = $ferow['userstat'];  //Usuario Esado 
					$aseso_te = $ferow['phonenum'];  //Usuario Cel 1
					$aseso_t2 = $ferow['phonenu2'];  //Usuario Cel 2
					$aseso_cu = $ferow['userdate'];  //Usuario Cumpleaños
					$aseso_di = $ferow['useraddr'];  //Usuario Dirección
					$aseso_ge = $ferow['usergend'];  //Usuario Genero
					$aseso_dp = $ferow['userndpi'];  //Usuario DPI
					$aseso_ec = $ferow['usermatr'];  //Usuario Estado Civil
					$aseso_pr = $ferow['userprof'];  //Usuario Profesión
					$aseso_py = $ferow['userproy'];  //Usuario Proyecto

					$aseso_fb = $ferow['userface'];  //Usuario Facebook
					$aseso_tw = $ferow['usertwit'];  //Usuario Twitter
					$aseso_wa = $ferow['userwhat'];  //Usuario WhatsApp
					$aseso_in = $ferow['userinst'];  //Usuario Instagram
					$aseso_li = $ferow['userlink'];  //Usuario LinkedIN
					$aseso_yo = $ferow['useryout'];  //Usuario Youtube
					$aseso_pi = $ferow['userpint'];  //Usuario Pinterest

					if ($aseso_ge == 1) {$aseso_ge = "Masculino";} 			else
					if ($aseso_ge == 2) {$aseso_ge = "Femenino";} 			else
					{$aseso_ge = " - ";}

					if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
					if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
					if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
					if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
					if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
					if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
					{$aseso_tu = " - ";}

					if ($aseso_ec == 1) {$aseso_ec = "Casado(a)";} 		else
					if ($aseso_ec == 2) {$aseso_ec = "Soltero(a)";} 	else
					if ($aseso_ec == 3) {$aseso_ec = "Unido(a)";} 		else
					if ($aseso_ec == 4) {$aseso_ec = "Viudo(a)";} 		else
					if ($aseso_ec == 5) {$aseso_ec = "Divorciado(a)";} 	else 
					{$aseso_ec = " - ";}

					if ($aseso_pr == 1)  {$aseso_pr = "Sr";} 		else
					if ($aseso_pr == 2)  {$aseso_pr = "Sra";} 		else
					if ($aseso_pr == 3)  {$aseso_pr = "Srita";} 	else
					if ($aseso_pr == 4)  {$aseso_pr = "Ing";} 		else
					if ($aseso_pr == 5)  {$aseso_pr = "Dr";} 		else 
					if ($aseso_pr == 6)  {$aseso_pr = "Dra";} 		else 
					if ($aseso_pr == 7)  {$aseso_pr = "Lic";} 		else 
					if ($aseso_pr == 8)  {$aseso_pr = "Licda";} 	else 
					if ($aseso_pr == 9)  {$aseso_pr = "Baco";} 		else 
					if ($aseso_pr == 10) {$aseso_pr = "Conta";} 	else 
					if ($aseso_pr == 11) {$aseso_pr = "Prof";} 		else 
					if ($aseso_pr == 12) {$aseso_pr = "Profa";} 	else 
					if ($aseso_pr == 13) {$aseso_pr = "Asociado Platinum";} 	else
					if ($aseso_pr == 14) {$aseso_pr = "Asociada Platinum";} 	else
					if ($aseso_pr == 15) {$aseso_pr = "Asociado Senior";} 		else
					if ($aseso_pr == 16) {$aseso_pr = "Asociada Senior";} 		else
					if ($aseso_pr == 17) {$aseso_pr = "Asociado Élite";} 		else
					if ($aseso_pr == 18) {$aseso_pr = "Asociada Élite";} 		else
					if ($aseso_pr == 19) {$aseso_pr = "Broker Owner Manager";} 	else
					{$aseso_pr = " - ";}
				?>

				<!-- BODY -->	
				<div class="container">
					<div class="row">
				

				<!-- Asesor y Cliente -->
				<div class="col-12 col-lg-12">
					<div class="container rounded border shadow-sm info-property pt-2 pl-4 pr-4 pb-2 bg-white">
						<div class="row mt-3">
							<div class="col-12 text-center">
								<div class="col-6 p-0 mx-auto">
									<img class="img-thumbnail rounded-circle" src="../assets/images/usuarios/<?php echo ($aseso_id); ?>.png" 
									alt="" width="200" height="200">
								</div>
								<h2 class=""><?php echo ($aseso_tu); ?></h2>
								<h4 class="mb-3"><?php echo ($aseso_pr . " " . $aseso_fn . " " . $aseso_ln . " - ". $aseso_py); ?></h4>
							</div>

							<div class="col-12 mt-0">
								<hr class="mt-0">
							</div>

							<div class="col-12">
								<h5 class="text-center">Información Detallada</h5>
							</div>

							<div class="col-12 mt-0">
								<hr class="mt-0">
							</div>
							
							<!-- Datos Completos del Asesor -->
							<div class="col-6">
								<div class="col-12">
									<p class="mb-0">
										<strong>Nombre:</strong>
									</p>
									<p class="">
										<?php echo ($aseso_pr . " " . $aseso_fn . " " . $aseso_ln . " - ". $aseso_py); ?>
									</p>
								</div>

								<?php
									$usertipe = $_SESSION['usertipe'];
									if ($usertipe == 1 or $usertipe == 2) 
									{	
									?>						
									<div class="col-12">
										<p class="mb-0">
											<strong>Usuario:</strong>
										</p>
										<p class="">
											<?php echo ($aseso_us); ?>
										</p>
									</div>

									<div class="col-12">
										<p class="mb-0">
											<strong>Contraseña:</strong>
										</p>
										<p class="">
											<?php echo ($aseso_ps); ?>
										</p>
									</div>

									<div class="col-12">
										<p class="mb-0">
											<strong>DPI:</strong>
										</p>
										<p class="">
											<?php if ($aseso_dp > 0) { ?>
												<?php echo ($aseso_dp); ?>
											<?php } else { ?>
												No Disponible
											<?php } ?>
										</p>
									</div>

									<div class="col-12">
										<p class="mb-0">
											<strong>Celular 1:</strong>
										</p>
										<p class="">
											+(502) <?php echo ($aseso_te); ?>
										</p>
									</div>

									<div class="col-12">
										<p class="mb-0">
											<strong>Celular 2 / Cel USA:</strong>
										</p>
										<p class="">
											<?php echo $aseso_t2; ?>
										</p>
									</div>
									
									<div class="col-12">
										<p class="mb-0">
											<strong>Dirección:</strong>
										</p>
										<p class="">
											<?php echo ($aseso_di); ?>
										</p>
									</div>

									<div class="col-12">
										<p class="mb-0">
											<strong>Correo Electrónico:</strong>
										</p>
										<p class="">
											<?php echo ($aseso_co); ?>
										</p>
									</div>
									<?php
									}
								?>

								<div class="col-12">
									<p class="mb-0">
										<strong>Tipo:</strong>
									</p>
									<p class="">
										<?php echo ($aseso_tu); ?>
									</p>
								</div>
								
								<div class="col-12">
									<p class="mb-0">
										<strong>Estado:</strong>
									</p>
									<p class="">
										<?php if ($aseso_es == 1) { ?>
											Activo
										<?php } else { ?>
											Ininactivo
										<?php } ?>
									</p>
								</div>
							</div>

							<div class="col-6">
								<div class="col-12">
									<p class="mb-0">
										<strong>Fecha de Nacimiento:</strong>
									</p>
									<p class="">
										<?php echo date("d-m-Y", strtotime("$aseso_cu")); ?>
									</p>
								</div>

								<div class="col-12">
									<p class="mb-0">
										<strong>Género:</strong>
									</p>
									<p class="">
										<?php echo ($aseso_ge); ?>
									</p>
								</div>

								<div class="col-12">
									<p class="mb-0">
										<strong>Estado Civil:</strong>
									</p>
									<p class="">
										<?php if ($aseso_ec == true) { ?>
											<?php echo ($aseso_ec); ?>
										<?php } else { ?>
											No Disponible
										<?php } ?>
									</p>
								</div>

								<?php
								$usertipe = $_SESSION['usertipe'];
									if ($usertipe == 1 or $usertipe == 2) 
									{	
									?>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (Facebook):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_fb); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (Twitter):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_tw); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (WhatsApp):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_wa); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (Instagram):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_in); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (LinkedIN):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_li); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (Youtube):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_yo); ?>
											</p>
										</div>

										<div class="col-12">
											<p class="mb-0">
												<strong>Red Social (Pinterest):</strong>
											</p>
											<p class="">
												<?php echo ($aseso_pi); ?>
											</p>
										</div>

									<?php
									}
								?>
							</div>

							<div class="col-12">
								<!-- EDITAR_USUARIO-->
								<div class="col-12">
									<form action="#" method="POST">
										<?php
											$usertipe = $_SESSION['usertipe'];
											if ($usertipe == 1 or $usertipe == 2) 
											{
												?>
												<a name="" 
													class="btn btn-outline-primary"
													href="usuario_edit.php?id=<?php echo $id;?>" role="button"><i class="fas fa-highlighter"></i> Actualizar Asesor
												</a>
												<?php
											}
										?>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
				<?php
				}
				?>
			</section>
		</div>
	</div>
</div>

	<?php include 'include/footer.php';?>
	<?php include 'include/scripts.php';  ?>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
		$(document).ready(function() {
			initGeneral();
		});
	</script>

	<script 
		type="text/javascript" 
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwW46vROW21vAh6SWRwKEP1FfXbsH_6YQ&callback=initMap">



	function initMap() {
			var map;
			var bounds = new google.maps.LatLngBounds();
			var mapOptions = {
				mapTypeId: 'roadmap'
			};
	
			map = new google.maps.Map(document.getElementById('mapa'), {
				mapOptions
			});
	
			map.setTilt(50);
	
			// Crear múltiples marcadores desde la Base de Datos 
			var marcadores = [
				<?php include('php/marcadores.php'); ?>
			];
	
			// Creamos la ventana de información para cada Marcador
			var ventanaInfo = [
				<?php include('php/info_marcadores.php'); ?>
			];
	
			// Creamos la ventana de información con los marcadores 
			var mostrarMarcadores = new google.maps.InfoWindow(),
				marcadores, i;
	
			// Colocamos los marcadores en el Mapa de Google 
			for (i = 0; i < marcadores.length; i++) {
				var position = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
				bounds.extend(position);
				marker = new google.maps.Marker({
					position: position,
					map: map,
					title: marcadores[i][0]
				});
	
				// Colocamos la ventana de información a cada Marcador del Mapa de Google 
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						mostrarMarcadores.setContent(ventanaInfo[i][0]);
						mostrarMarcadores.open(map, marker);
					}
				})(marker, i));
	
				// Centramos el Mapa de Google para que todos los marcadores se puedan ver 
				map.fitBounds(bounds);
			}
	
			// Aplicamos el evento 'bounds_changed' que detecta cambios en la ventana del Mapa de Google, también le configramos un zoom de 14 
			var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
				this.setZoom(14);
				google.maps.event.removeListener(boundsListener);
			});
	
		}
	
		// Lanzamos la función 'initMap' para que muestre el Mapa con Los Marcadores y toda la configuración realizada 
		google.maps.event.addDomListener(window, 'load', initMap);


	</script>

	<script>
		$(document).ready(function() {

			(function(exports) {
				"use strict";

				function initMap() {
					exports.map = new google.maps.Map(document.getElementById("map"), {
						center: {
							lat: -34.397,
							lng: 150.644
						},
						zoom: 8
					});
				}
				exports.initMap = initMap;
			})((this.window = this.window || {}));

			$('.images-properties').magnificPopup({
				type: 'image',
				delegate: 'a',
				gallery: {
					enabled: true
				}
			});
		});
	</script>

</body>
</html>