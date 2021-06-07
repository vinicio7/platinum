<?php
/*-------------------------
MENSAJE VIEW
Autor: Gustavo Blanco
Web: chofo7.blogspot.com
Mail: chofo7@gmail.com
---------------------------*/

// Notificar errores excepto E_NOTICE - HORARIO GUATEMALA
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Guatemala');

session_start(); //validacion para la sesion
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) 
{ header("location: ../public/login_form.php");    exit; }

//Base de Datos
require_once ("../config/db.php");
require_once ("../config/conexion.php");

//LIBRERIAS NECESARIAS PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../assets/phpmailer/src/Exception.php';
require '../assets/phpmailer/src/PHPMailer.php';
require '../assets/phpmailer/src/SMTP.php';

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

//MENSAJERÍA Y CORREO ------------------------------------
//aun en arreglos
if (isset($_GET['me_sa_id_quitar'])) 
{
		//CONSULTA ASOCIADO
		$query = mysqli_query( $con, "SELECT * FROM `si_users` WHERE `usertipe`= 3 and `userstat`= 1 and `id_users`= '".$in_vende."' " );
		$count_asoc = mysqli_num_rows($query);
		$ferow = mysqli_fetch_array($query);
		if ($count_asoc > 0) 
		{
			$asoc_id_users = $ferow['id_users'];
			$asoc_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
			$asoc_correo_e = $ferow['usermail'];
		}

		//CONSULTA PROPIETARIO
		$query = mysqli_query( $con, "SELECT * FROM `si_users` WHERE `usertipe`= 5 or `usertipe`= 7 and `userstat`= 1 and `id_users`= '".$in_nombr."' " );
		$count_asoc = mysqli_num_rows($query);
		$ferow = mysqli_fetch_array($query);
		if ($count_asoc > 0) 
		{
			$prop_id_users = $ferow['id_users'];
			$prop_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
			$prop_correo_e = $ferow['usermail'];
		}

	//VARIABLES PARA MENSAJE
	$f_id_users = $_SESSION['id_users']; 	//ID De
	$m_me_re_id	= 1;						//ID Para
	$m_me_estad = 0;						//Estado:	0) noleido   1) leido
	$m_me_asunt = 3;						//Asunto: 	1) Formular	 2) para Asesor  3) Prop Nueva  4) Cumpleaños   5) de Respuesta
	$mensaj_dat = utf8_decode(date('Y-m-d H:i:s'));	//Fecha de Ingreso
	$messag_txt = "Se ha CREADO la propiedad COD: ".$in_mu_id.". Agente: " .$asoc_usernomb. ". Propietario: " . $prop_usernomb; //Mensaje
	$messag_lin = "https://propiedadesplatinum.com/public/propiedad_view.php?id=" . $in_mu_id;

	//INSERTA EN LA TABLA MENSAJES
	mysqli_query($con,"INSERT INTO si_messages(
	`me_us_id`,		`me_re_id`,		`me_fecha`,
	`me_sages`, 	`me_estad`,		`me_asunt`)
	VALUES(
	'$f_id_users',	'$m_me_re_id',	'$mensaj_dat',
	'$messag_txt',	'$m_me_estad',	'$m_me_asunt'
	)");
	$client_dat = utf8_decode(date('d-m-Y'));

	//CUERPO DEL (MAIL)
	$body = '
	<html>
	<head>
		<title>Sistema Inmobiliario</title>
		<link href="https://propiedadesplatinum.com/assets/css/all.css" rel="stylesheet" type="text/css" />
		<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
	</head>
	<body aria-readonly="false" style="cursor: auto;">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
		<tbody>
			<tr>
				<td style="width:100.0%">
				<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:620px">
					<tbody>
						<tr>
							<td style="width:620px">
							<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
								<tbody>
									<tr>
										<td style="height:80px; width:30px" bgcolor="black">&nbsp;</td>
										<td style="height:80px" bgcolor="black"><img src="https://propiedadesplatinum.com/assets/images/logos/2.png" style="height:80px; width:250px" /></td>
										<td style="height:80px; width:30px" bgcolor="black">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:30px">&nbsp;</td>
										<td>&nbsp;</td>
										<td style="width:30px">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:30px">&nbsp;</td>
										<td>
										<h1><span style="font-family:trebuchet ms,helvetica,sans-serif">Tienes una nueva notificacion</span></h1>
										</td>
										<td style="width:30px">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:30px">&nbsp;</td>
										<td>
										<hr /></td>
										<td style="width:30px">&nbsp;</td>
									</tr>
								</tbody>
							</table>
	
							<div>&nbsp;</div>
							&nbsp;
	
							<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%">
								<tbody>
									<tr>
										<td style="width:30px">&nbsp;</td>
										<td>
										<table border="0" cellpadding="0" cellspacing="0" style="height:105px; width:549px">
											<tbody>
												<tr>
													<td style="width:85px"><img src="https://propiedadesplatinum.com/assets/images/logos/user.png" style="height:57px; width:57px" /></td>
													<td style="width:458px"><h2><span style="font-size:18px"><span style="font-family:trebuchet ms,helvetica,sans-serif"><strong>Tienes una propiedad nueva</strong></span></span></h2></td>
												</tr>
												<tr>
													<td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Mensaje</span></strong></td>
													<td style="width:458px">
													<div>
													<div><span>'.$messag_txt.'</span></div>
													</div>
													</td>
												</tr>
												<tr>
													<td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Link</span></strong></td>
													<td style="width:458px">
													<div>
													<div><span>'.$messag_lin.'</span></div>
													</div>
													</td>
												</tr>
												<tr>
													<td style="width:85px"><strong><span style="font-family:trebuchet ms,helvetica,sans-serif">Fecha</span></strong></td>
													<td style="width:458px">
													<div>
													<div><span>'.$mensaj_dat.'</span></div>
													</div>
													</td>
												</tr>
											</tbody>
										</table>
										</td>
										<td style="width:30px">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:30px">&nbsp;</td>
										<td></td>
										<td style="width:30px">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<br><br>

							<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100.0%" bgcolor="black">
								<tbody>
									<tr>
										<td style="height:80px; width:30px">&nbsp;</td>
										<td style="height:70px; text-align: center;"><img src="https://propiedadesplatinum.com/assets/images/logos/2.png" style="height:70px; width:200px" /></td>
										<td style="height:80px; width:30px">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="black">
											<tbody>
												<tr>
													<td style="width:30px"><img src="https://propiedadesplatinum.com/assets/images/logos/rface.png" style="height:25px; width:25px" /></td>
													<td style="width:30px">&nbsp;</td>
													<td style="width:30px"><img src="https://propiedadesplatinum.com/assets/images/logos/rtwit.png" style="height:25px; width:25px" /></td>
													<td style="width:30px">&nbsp;</td>
													<td style="width:30px"><img src="https://propiedadesplatinum.com/assets/images/logos/ryout.png" style="height:25px; width:25px" /></td>
												</tr>
											</tbody>
										</table>
	
										<div>&nbsp;</div>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr align="center">
										<td>&nbsp;</td>
										<td style="color:white">Si ya no deseas notificaciones puedes: <a href="https://propiedadesplatinum.com/public/unsuscribe.php">darte de baja</a> del sistema.</td>
										<td>&nbsp;</td>
									</tr>
								</tbody>
							</table>
	
							<div>&nbsp;</div>
							</td>
						</tr>
					</tbody>
				</table>
	
				<div>&nbsp;</div>
				</td>
			</tr>
		</tbody>
	</table>
	</body>
	</html>
	';

	//CONFIGURACION PHPMailer
	$smtpUsername = "info@propiedadesplatinum.com";
	$smtpPassword = "SistemaInmobiliario7";

	//DATOS PARA ENVIAR CORREO
	$mail = new PHPMailer;
	$mail->isSMTP(); 
	$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	$mail->Host = "propiedadesplatinum.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
	$mail->Port = 465; // TLS only
	$mail->SMTPSecure = 'ssl'; // tls - ssl 
	$mail->SMTPAuth = true;
	$mail->Username = $smtpUsername;
	$mail->Password = $smtpPassword;
	$mail->setFrom   ("info@propiedadesplatinum.com", "Propiedades Platinum");  //DE INFO
	$mail->addAddress("info@propiedadesplatinum.com", "Propiedades Platinum");  //PARA INFO
	$mail->addAddress($asoc_correo_e, $asoc_usernomb);                          //Add a recipient (AGENTE)
	$mail->addAddress($prop_correo_e, $prop_usernomb);                          //Add a recipient (PROPIE)
	$mail->Subject = 'Sistema Inmobiliario';
	$mail->msgHTML($body); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
	// Attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Add attachments

	if (!$mail->send()) 
	{
		//$msg = 'Sorry, something went wrong. Please try again later.';
	}
	else 
	{
		//$msg = 'Message sent! Thanks for contacting us.';
	}
}
//MENSAJERIA Y CORREO --------------------------------------------------------------------
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

				<?php  $usertipe = $_SESSION['usertipe']; if ($usertipe == 1 or $usertipe == 2) { 
					if (isset($_GET['msj_id'])) 
					{  
					?>

						<!-- RESPONDER MENSAJE-->	
						<div class="container">
							<div class="row">
						
								<!-- MENSAJE -->
								<div class="col-12 col-lg-12">
									<h3> Responder Mensaje </h3> <br>

										<?php
										//CONSULTA MENSAJE
										$msj_id = $_GET['msj_id'];
										$query = mysqli_query($con,"SELECT * FROM `si_messages` WHERE `me_sa_id`= '" . $msj_id . "' ");
										$data  = mysqli_num_rows($query );
										$ferow = mysqli_fetch_array($query );
										if ($data > 0 AND $id_users == 1  or $id_users ==2 or $id_users ==10) 
										{
											$me_sa_id = $ferow['me_sa_id'];  //MENSAJE ID
											$me_us_id = $ferow['me_us_id'];  //MENSAJE Usuario ID 
											$me_re_id = $ferow['me_re_id'];  //MENSAJE Destinatario 
											$me_fecha = $ferow['me_fecha'];  //MENSAJE Fecha Hora
											$me_sages = utf8_encode($ferow['me_sages']);  //MENSAJE Mensaje 
											$me_estad = $ferow['me_estad'];  //MENSAJE Estado (noleido = 0, leido = 1) 
											$me_asunt = $ferow['me_asunt'];  //MENSAJE Asunto (1 formulario, 2 Asesor, 3 prop nueva, 4 cumpleaños, 5 respuesta)
											
											if ($me_estad == 1) {$me_estad = "Leído";} else {$me_estad = "No Leído";} 			

											//CONSULTA AGENTE
											$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $me_us_id . "'");
											$data_user = mysqli_num_rows($query_user);
											$ferow = mysqli_fetch_array($query_user);
											if ($data_user > 0) 
											{		
												$aseso_id = $ferow['id_users'];  //Usuario ID
												$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
												$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
												$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
												$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario

												if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
												if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
												if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
												if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
												if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
												if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
												{$aseso_tu = " - ";}
											}
											?>
												<form  method="POST" role="form" autocomplete="off" action="mensaje_list.php?msj_send=<?php echo $me_sa_id; ?>" />
													<div class="form-group col-sm-12 ">
														<label class="label-form-control" data-type="date" data-format-string="DD-MM-YYYY">Fecha: <?php echo $me_fecha; ?></label>
													</div>

													<div class="form-group col-sm-12 input-custom-icon">
														<label class="label-form-control" >De:</label>
														<input type="text" name="msj_de" class="form-control" placeholder="De" 	value="<?php echo $username; ?>"/>
													</div>

													<div class="form-group col-sm-12 input-custom-icon">
														<label class="label-form-control" >Para:</label>
														<input type="text" name="msj_para" class="form-control" placeholder="Para" 	value="<?php echo $aseso_fn." ".$aseso_ln; ?>"/>	
													</div>

													<div class="form-group col-sm-12 input-custom-icon">
														<label class="label-form-control" >Asunto:</label>
														
														<select class="form-control" name="msj_asun">
															<option value="1"<?php if($me_asunt== 1) {echo "selected";}?>>Desde Formulario</option>
															<option value="2"<?php if($me_asunt== 2) {echo "selected";}?>>Para Asesor</option>
															<option value="3"<?php if($me_asunt== 3) {echo "selected";}?>>Propiedad</option>
															<option value="4"<?php if($me_asunt== 4) {echo "selected";}?>>Cumpleaños</option>
															<option value="5"<?php if($me_asunt== 5) {echo "selected";}?>>Respuesta</option>
														</select>	
													</div>

													<div class="form-group col-sm-12 input-custom-icon">
														<label class="label-form-control" >Mensaje:</label>
														<textarea type="text" class="form-control" name="msj_mensaje" placeholder="Casa Espectacular en Las Alturas" rows="5"><?php echo $me_sages; ?></textarea>
													</div>

													<div>
														<input class="rounded-5 btn text-right collapsed current-bg-primary text-decoration-none pt-2 pb-2" type="submit" name="enviar" value="Responder"/></input>
													</div>
												</form>
											<?php
										}
										?>
										
								</div>
							</div>
						</div>

					<?php
					} 
					else
					{
					?>
						<!-- LISTA DE MENSAJES -->	
						<div class="container">
							<div class="row">
						
								<!-- MENSAJES -->
								<div class="col-12 col-lg-12">
									<h3> Lista de Mensajes </h3>
									<table class="table table-striped table-bordered">
										<thead align=center>
											<tr>
												<th scope="col">Asunto</th>
												<th scope="col">Mensaje</th>
												<th scope="col">De</th>
												<th scope="col">Fecha</th>
												<th scope="col">Estado</th>
											</tr>
										</thead>
										<tbody align=center>

										<?php
										//CONSULTA MENSAJES (Todos)
										$query = mysqli_query($con,"SELECT * FROM `si_messages` ORDER BY `me_sa_id` DESC");
										$data  = mysqli_num_rows($query );
										$ferow = mysqli_fetch_array($query );
										if ($data > 0 AND $id_users == 1  or $id_users ==2 or $id_users ==10) 
										{
											$me_sa_id = $ferow['me_sa_id'];  //MENSAJE ID
											$me_us_id = $ferow['me_us_id'];  //MENSAJE Usuario ID 
											$me_re_id = $ferow['me_re_id'];  //MENSAJE Destinatario 
											$me_fecha = $ferow['me_fecha'];  //MENSAJE Fecha Hora
											$me_sages = utf8_encode($ferow['me_sages']);  //MENSAJE Mensaje 
											$me_estad = $ferow['me_estad'];  //MENSAJE Estado (noleido = 0, leido = 1) 
											$me_asunt = $ferow['me_asunt'];  //MENSAJE Asunto (1 formulario, 2 Asesor, 3 prop nueva, 4 cumpleaños, 5 respuesta)
											
											if ($me_estad == 1) {$me_estad = "Leído";} else {$me_estad = "No Leído";} 		

											if ($me_asunt == 1) {$me_asunt = "Desde Formulario";} 	else
											if ($me_asunt == 2) {$me_asunt = "Para Asesor";} 		else
											if ($me_asunt == 3) {$me_asunt = "Propiedad";} 			else
											if ($me_asunt == 4) {$me_asunt = "Cumpleaños";} 		else
											if ($me_asunt == 5) {$me_asunt = "Respuesta";} 			else 
											{$me_asunt = " - ";}	

											//CONSULTA AGENTE
											$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $me_us_id . "'");
											$data_user = mysqli_num_rows($query_user);
											$ferow = mysqli_fetch_array($query_user);
											if ($data_user > 0) 
											{		
												$aseso_id = $ferow['id_users'];  //Usuario ID
												$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
												$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
												$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
												$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario

												if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
												if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
												if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
												if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
												if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
												if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
												{$aseso_tu = " - ";}
											}
											?>
								
											<tr class='clickable-row' data-href='mensaje_list.php?msj_id=<?php echo $me_sa_id; ?>'>
												<td><?php echo $me_asunt; ?></td>
												<td><?php echo $me_sages; ?></td>
												<td><?php echo $aseso_fn." ".$aseso_ln; ?></td>
												<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $me_fecha; ?> </td>
												<td><?php echo $me_estad; ?></td>
											</tr>

											<?php
											for ($i = 1; $i <= $data - 1; $i++) 
											{
												$ferow = mysqli_fetch_array($query); //REPITE CAMPOS

												$me_sa_id = $ferow['me_sa_id'];  //MENSAJE ID
												$me_us_id = $ferow['me_us_id'];  //MENSAJE Usuario ID 
												$me_re_id = $ferow['me_re_id'];  //MENSAJE Destinatario 
												$me_fecha = $ferow['me_fecha'];  //MENSAJE Fecha Hora
												$me_sages = utf8_encode($ferow['me_sages']);  //MENSAJE Mensaje 
												$me_estad = $ferow['me_estad'];  //MENSAJE Estado (noleido = 0, leido = 1) 
												$me_asunt = $ferow['me_asunt'];  //MENSAJE Asunto (1 formulario, 2 Asesor, 3 prop nueva, 4 cumpleaños, 5 respuesta)
												
												if ($me_estad == 1) {$me_estad = "Leído";} else {$me_estad = "No Leído";} 		
			
												if ($me_asunt == 1) {$me_asunt = "Desde Formulario";} 	else
												if ($me_asunt == 2) {$me_asunt = "Para Asesor";} 		else
												if ($me_asunt == 3) {$me_asunt = "Propiedad";} 	else
												if ($me_asunt == 4) {$me_asunt = "Cumpleaños";} 		else
												if ($me_asunt == 5) {$me_asunt = "Respuesta";} 			else 
												{$me_asunt = " - ";}	
			
												//CONSULTA AGENTE
												$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $me_us_id . "'");
												$data_user = mysqli_num_rows($query_user);
												$ferow = mysqli_fetch_array($query_user);
												if ($data_user > 0) 
												{		
													$aseso_id = $ferow['id_users'];  //Usuario ID
													$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
													$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
													$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
													$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
			
													if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
													if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
													if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
													if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
													if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
													if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
													{$aseso_tu = " - ";}
												}
												?>
												<tr class='clickable-row' data-href='mensaje_list.php?msj_id=<?php echo $me_sa_id; ?>'>
													<td><?php echo $me_asunt; ?></td>
													<td><?php echo $me_sages; ?></td>
													<td><?php echo $aseso_fn." ".$aseso_ln; ?></td>
													<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $me_fecha; ?> </td>
													<td><?php echo $me_estad; ?></td>
												</tr>
												<?php
											}
										}
										else
										{
											//CONSULTA MENSAJES
											$query = mysqli_query($con,"SELECT * FROM `si_messages` WHERE `me_us_id`= '" . $id_users . "'");
											$data  = mysqli_num_rows($query);
											$ferow = mysqli_fetch_array($query);
											if ($data > 0) 
											{
												$me_sa_id = $ferow['me_sa_id'];  //MENSAJE ID
												$me_us_id = $ferow['me_us_id'];  //MENSAJE Usuario ID 
												$me_re_id = $ferow['me_re_id'];  //MENSAJE Destinatario 
												$me_fecha = $ferow['me_fecha'];  //MENSAJE Fecha Hora
												$me_sages = utf8_encode($ferow['me_sages']);  //MENSAJE Mensaje 
												$me_estad = $ferow['me_estad'];  //MENSAJE Estado (noleido = 0, leido = 1) 

												if ($me_estad == 1) {$me_estad = "Leído";} 
												else {$me_estad = "No Leído";} 		
			
												if ($me_re_id == 1) {$me_re_id = "Consulta (web)";} 
												else {$me_re_id = "Mensaje Interno";} 	

												//CONSULTA AGENTE
												$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $me_us_id . "'");
												$data_user = mysqli_num_rows($query_user);
												$ferow = mysqli_fetch_array($query_user);
												if ($data_user > 0) 
												{		
													$aseso_id = $ferow['id_users'];  //Usuario ID
													$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
													$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
													$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
													$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario

													if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
													if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
													if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
													if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
													if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
													if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
													{$aseso_tu = " - ";}
												}
												?>
												<!-- MENSAJES -->
												<div class="col-12 col-lg-12">
													<div class="container rounded border shadow-sm info-property pt-2 pl-4 pr-4 pb-2 bg-white">
														<tr class='clickable-row' data-href='mensaje_list.php?msj_id=<?php echo $me_sa_id; ?>'>
															<td><?php echo $me_re_id; ?></td>
															<td><?php echo $me_sages; ?></td>
															<td><?php echo $aseso_fn." ".$aseso_ln; ?></td>
															<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $me_fecha; ?> </td>
															<td><?php echo $me_estad; ?></td>
														</tr>
													</div>
												</div>
												<?php
												for ($i = 1; $i <= $data - 1; $i++) 
												{
													$ferow = mysqli_fetch_array($query); //REPITE CAMPOS

													$me_sa_id = $ferow['me_sa_id'];  //MENSAJE ID
													$me_us_id = $ferow['me_us_id'];  //MENSAJE Usuario ID 
													$me_re_id = $ferow['me_re_id'];  //MENSAJE Destinatario 
													$me_fecha = $ferow['me_fecha'];  //MENSAJE Fecha Hora
													$me_sages = utf8_encode($ferow['me_sages']);  //MENSAJE Mensaje 
													$me_estad = $ferow['me_estad'];  //MENSAJE Estado (noleido = 0, leido = 1) 
													
													if ($me_estad == 1) {$me_estad = "Leído";} 
													else {$me_estad = "No Leído";} 		
				
													if ($me_re_id == 1) {$me_re_id = "Consulta (web)";} 
													else {$me_re_id = "Mensaje Interno";} 	
				
													//CONSULTA AGENTE
													$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $me_us_id . "'");
													$data_user = mysqli_num_rows($query_user);
													$ferow = mysqli_fetch_array($query_user);
													if ($data_user > 0) 
													{		
														$aseso_id = $ferow['id_users'];  //Usuario ID
														$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
														$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
														$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
														$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
				
														if ($aseso_tu == 1) {$aseso_tu = "Administrador";} 		else
														if ($aseso_tu == 2) {$aseso_tu = "Gerente";} 			else
														if ($aseso_tu == 3) {$aseso_tu = "Agente Interno";} 	else
														if ($aseso_tu == 4) {$aseso_tu = "Agente Externo";} 	else
														if ($aseso_tu == 5) {$aseso_tu = "Propietario";} 		else 
														if ($aseso_tu == 6) {$aseso_tu = "Cliente";} 			else 
														{$aseso_tu = " - ";}
													}
													?>
													<tr class='clickable-row' data-href='mensaje_list.php?msj_id=<?php echo $me_sa_id; ?>'>
														<td><?php echo $me_re_id; ?></td>
														<td><?php echo $me_sages; ?></td>
														<td><?php echo $aseso_fn." ".$aseso_ln; ?></td>
														<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $me_fecha; ?> </td>
														<td><?php echo $me_estad; ?></td>
													</tr>
													<?php
												}
											}
										}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
				<?php }} ?>

				<?php  $usertipe = $_SESSION['usertipe']; if ($usertipe == 3 or $usertipe == 4 or $usertipe == 5 or $usertipe == 6) { ?>
					<!-- BODY -->	
					<div class="container">
						<div class="row">
					
							<!-- MENSAJES -->
							<div class="col-12 col-lg-12">
								<h3> No Autorizado </h3>
							</div>
						</div>
					</div>
				<?php } ?>
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

		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
			});
		});
	</script>

</body>
</html>