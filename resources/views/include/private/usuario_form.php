<?php
/*-------------------------
USER FORM
Autor: Gustavo Blanco
Web: chofo7.blogspot.com
Mail: chofo7@gmail.com
---------------------------*/

// Notificar errores excepto E_NOTICE - HORARIO GUATEMALA
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/Guatemala');

session_start(); //validacion para la sesion
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) 
{
	header("location: ../public/login_form.php");    exit;
}

//Base de Datos
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

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

	//CONTEO_USUARIOS		
	$query=mysqli_query($con,
	"SELECT `id_users` FROM `si_users` WHERE 1 ORDER BY `si_users`.`id_users` DESC"); 
	$count=mysqli_num_rows($query);
	$ferow=mysqli_fetch_array($query);
	if ($count>0)
	{		
		$f_id_users	=$ferow['id_users'];
	}

	//DATOS OBLIGATORIOS DE FOMULARIO
	if (
		isset($_POST['f_firstnam']) && !empty($_POST ['f_firstnam']) &&
		isset($_POST['f_lastname']) && !empty($_POST ['f_lastname'])
		)
	{
		if (!$con)
		{
			die (" Error de Base de Datos " . mysqli_error($con));
		}
			else
		{
			//INICIO CAPTURA DATOS DE FORMULARIO----------------
			if (!empty($_POST ['f_firstnam'])) 
			{$f_firstnam = utf8_decode($_POST['f_firstnam']);} else 
			{$f_firstnam = "";}

			if (!empty($_POST ['f_lastname'])) 
			{$f_lastname = utf8_decode($_POST['f_lastname']);} else 
			{$f_lastname = "";}

			if (!empty($_POST ['f_username'])) 
			{$f_username = utf8_decode($_POST['f_username']);} else 
			{$f_username = "";}

			if (!empty($_POST ['f_userpass'])) 
			{$f_userpass = utf8_decode($_POST['f_userpass']);} else 
			{$f_userpass = "";}

			if (!empty($_POST ['f_usermail'])) 
			{$f_usermail = utf8_decode($_POST['f_usermail']);} else 
			{$f_usermail = "";}

			if (!empty($_POST ['f_phonenum'])) 
			{$f_phonenum = utf8_decode($_POST['f_phonenum']);} else 
			{$f_phonenum = 0;}

			if (!empty($_POST ['f_phonenu2'])) 
			{$f_phonenu2 = utf8_decode($_POST['f_phonenu2']);} else 
			{$f_phonenu2 = 0;}

			if (!empty($_POST ['f_userndpi'])) 
			{$f_userndpi = utf8_decode($_POST['f_userndpi']);} else 
			{$f_userndpi = 0;}

			if (!empty($_POST ['f_userdate'])) 
			{$f_userdate = utf8_decode($_POST['f_userdate']);} else 
			{$f_userdate = "";}

			if (!empty($_POST ['f_useraddr'])) 
			{$f_useraddr = utf8_decode($_POST['f_useraddr']);} else 
			{$f_useraddr = "";}

			if (!empty($_POST ['f_userproy'])) 
			{$f_userproy = utf8_decode($_POST['f_userproy']);} else 
			{$f_userproy = "";}
			
			$f_datadded = utf8_decode(date('Y-m-d h:i:s'));
			$f_usertipe = utf8_decode($_POST['f_usertipe']);
			$f_userstat = utf8_decode($_POST['f_userstat']);
			$f_usergend = utf8_decode($_POST['f_usergend']);
			$f_usermatr = utf8_decode($_POST['f_usermatr']);
			$f_userprof = utf8_decode($_POST['f_userprof']);
			$f_useripor = utf8_decode($username);

			$f_userface = utf8_decode($_POST['f_userface']);
			$f_usertwit = utf8_decode($_POST['f_usertwit']);
			$f_userwhat = utf8_decode($_POST['f_userwhat']);
			$f_userinst = utf8_decode($_POST['f_userinst']);
			$f_userlink = utf8_decode($_POST['f_userlink']);
			$f_useryout = utf8_decode($_POST['f_useryout']);
			$f_userpint = utf8_decode($_POST['f_userpint']);
			//FIN CAPTURA DATOS DE FORMULARIO----------------

			//INSERTA EN LA BASE DE DATOS
			mysqli_query($con,"INSERT INTO si_users(
			`firstnam`,		`lastname`,		`username`,
			`userpass`,		`usermail`,		`datadded`,
			`usertipe`,		`userstat`,		`phonenum`,
			`phonenu2`,		`userdate`,		`useraddr`,		
			`usergend`,		`userndpi`,		`usermatr`,		
			`userprof`,		`useripor`, 	`userproy`,
			`userface`,		`usertwit`, 	`userwhat`,
			`userinst`,		`userlink`, 	`useryout`,
			`userpint`)
			VALUES(
			'$f_firstnam',	'$f_lastname',	'$f_username',
			'$f_userpass',	'$f_usermail',	'$f_datadded',
			'$f_usertipe',	'$f_userstat',	'$f_phonenum',
			'$f_phonenu2',	'$f_userdate',	'$f_useraddr',	
			'$f_usergend',	'$f_userndpi',	'$f_usermatr',	
			'$f_userprof',	'$f_useripor',	'$f_userproy',
			'$f_userface',	'$f_usertwit',	'$f_userwhat',
			'$f_userinst',	'$f_userlink',	'$f_useryout',
			'$f_userpint'
			)");

			//ALMACENA_UNA_FOTO
			if (isset($_POST['subir'])) {
				$archivo = $_FILES['archivo']['name'];
				if (isset($archivo) && $archivo != "") {
					$tipo = $_FILES['archivo']['type'];
					$tamano = $_FILES['archivo']['size'];
					$temp = $_FILES['archivo']['tmp_name'];
					if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) 
					{
						//echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
					}
					else {
						if (move_uploaded_file($temp, '../assets/images/usuarios/'.($f_id_users+1).'.png')) 
						{
							chmod('../assets/images/usuarios/'.($f_id_users+1).'.png', 0777);
						}
						else 
						{
							//echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
						}
					}
				}
			}
			?> <script type="text/javascript">
				window.location.replace("usuario_list.php");
			</script> 
			<?php
			?>

	<!-- MENSAJES EN PANTALLA -->
	<div style="position: fixed;top: 115px; left: 50%; z-index: 1500;">
		<div id="toastregistrosGuardados" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header bg-success text-white">
				<strong class="mr-auto">Aviso!</strong>
				<button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="toast-body bg-light text-success">
				Se almacenaron los datos de: <?php echo $_POST['f_firstnam']." ".$_POST['f_lastname']; ?>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			// $("#myToast").toast('show');
			$("#toastregistrosGuardados").toast({ delay: 5000 });
			$("#toastregistrosGuardados").toast('show');
			window.location.replace("dashboard.php");
		});
	</script>

<?php
		echo " " . mysqli_error($con);
		}
	}
	else
	{
		echo " " . mysqli_error($con);
	}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php';?>
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php';?>
	<div class="contenedor bg-light" id="contenedor">

		<!-- <div class="loader-bg" id="loader">
			<div class="spinner-border text-warning loader" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div> -->

		<div class="container-fluid bg-primary bg-blue-gradient ">

		</div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

			<!-- BODY -->
			<div class="container-fluid">
				<h3 class="text-primary">INGRESO DE USUARIOS</h3>
				<p>Clientes, Propietarios, Usuarios de Sistema, etc.</p>
				<hr />

				<!-- FORMULARIO INGRESO -->
				<form action="usuario_form.php" id="formNuevosUsuarios" method="POST" role="form" class="f1 p-0" autocomplete="off" enctype="multipart/form-data">
					<h6 class="mt-3 mb-4">Ingrese los datos del Usuario - <?php echo "COD: ".($f_id_users+1); ?>:</h6>
						
					<div class="row pt-3">
						<div class="form-group col-12">
							<div class="row pb-3">
								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-id-card form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_firstnam" placeholder="Ingrese Nombre" autocomplete="off">
									<label class="label-form-control" for="f_firstnam">Nombre:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-id-card form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_lastname" placeholder="Ingrese Apellido" autocomplete="off">
									<label class="label-form-control" for="f_lastname">Apellido:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-city form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userproy" placeholder="Ingrese Nombre de Proyecto" autocomplete="off">
									<label class="label-form-control" for="f_userproy">Nombre del Proyecto:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_username" placeholder="Nombre de Usuario (Sistema)" autocomplete="off">
									<label class="label-form-control" for="f_username">Usuario:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-lock form-control-feedback mirror"></span>
									<input type="password" class="form-control" name="f_userpass" placeholder="Contraseña" autocomplete="off">
									<label class="label-form-control" for="f_userpass">Contraseña:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-user-cog form-control-feedback mirror"></span>
									<select class="form-control" name="f_usertipe" required>
										<option disabled selected>Selecciona</option>
										<option value="1">Administrador</option>
										<option value="2">Gerente</option>
										<option value="3">Vendedor Interno</option>
										<option value="4">Vendedor Externo</option>
										<option value="5">Propietario</option>
										<option value="6">Cliente</option>
										<option value="7">Proyecto</option>
									</select>
									<label class="label-form-control" for="f_usertipe">Tipo de Usuario:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-envelope form-control-feedback mirror"></span>
									<input type="email" class="form-control" name="f_usermail" placeholder="Correo Electrónico" autocomplete="off">
									<label class="label-form-control" for="f_usermail">Correo Electrónico:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-phone form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_phonenum" placeholder="12345678" autocomplete="off">
									<label class="label-form-control" for="f_phonenum">Celular 1:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-phone form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_phonenu2" placeholder="+0010123567890" autocomplete="off">
									<label class="label-form-control" for="f_phonenu2">Celular 2 / Cel USA:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-map-marker-alt form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_useraddr" placeholder="Dirección" autocomplete="off">
									<label class="label-form-control" for="f_useraddr">Dirección:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-id-card form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userndpi" placeholder="DPI" autocomplete="off">
									<label class="label-form-control" for="f_userndpi">DPI:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
									<span class="fas fa-calendar-alt form-control-feedback mirror"></span>
									<input type="date" class="form-control" name="f_userdate" placeholder="Dia/Mes/Año" autocomplete="off">
									<label class="label-form-control" for="f_userdate">Fecha de Nacimiento:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-portrait form-control-feedback mirror"></span>
									<select class="form-control" name="f_usermatr">
										<option disabled selected>Selecciona</option>
										<option value="0">Ninguno</option>
										<option value="1">Casado(a)</option>
										<option value="2">Soltero(a)</option>
										<option value="3">Unido(a)</option>
										<option value="4">Viudo(a)</option>
										<option value="5">Divorciado(a)</option>
									</select>
									<label class="label-form-control" for="f_usermatr">Estado Civil:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="far fa-user form-control-feedback mirror"></span>
									<select class="form-control" name="f_usergend">
										<option disabled selected>Selecciona</option>
										<option value="0">Ninguno</option>
										<option value="1">Masculino</option>
										<option value="2">Femenino</option>
									</select>
									<label class="label-form-control" for="f_usergend">Género:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user-tie form-control-feedback mirror"></span>
									<select class="form-control" name="f_userprof">
										<option disabled selected>Selecciona</option>
										<option value="0">Ninguno</option>
										<option value="1">Sr.</option>
										<option value="2">Sra.</option>
										<option value="3">Srita.</option>
										<option value="4">Ing.</option>
										<option value="5">Dr.</option>
										<option value="6">Dra.</option>
										<option value="7">Lic.</option>
										<option value="8">Licda.</option>
										<option value="9">Baco.</option>
										<option value="10">Conta.</option>
										<option value="11">Prof.</option>
										<option value="12">Profa.</option>
										<option value="13">Asociado</option>
										<option value="14">Asociada</option>
										<option value="15">Broker Owner Manager</option>
									</select>
									<label class="label-form-control" for="f_userprof">Título:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-id-card-alt form-control-feedback mirror"></span>
									<select class="form-control" name="f_userstat" required>
										<option disabled>Selecciona</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
									<label class="label-form-control" for="f_userstat">Estado del Usuario:</label>
								</div>	

								<!-- REDES SOCIALES -->
								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userface" placeholder="Facebook" autocomplete="off">
									<label class="label-form-control" for="f_userface">Facebook:</label>
								</div>	

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_usertwit" placeholder="Twitter" autocomplete="off">
									<label class="label-form-control" for="f_usertwit">Twitter:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userwhat" placeholder="Whatsapp" autocomplete="off">
									<label class="label-form-control" for="f_userwhat">Whatsapp:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userinst" placeholder="Instagram" autocomplete="off">
									<label class="label-form-control" for="f_userinst">Instagram:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userlink" placeholder="Linkedin" autocomplete="off">
									<label class="label-form-control" for="f_userlink">Linkedin:</label>
								</div>		

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_useryout" placeholder="Youtube" autocomplete="off">
									<label class="label-form-control" for="f_useryout">Youtube:</label>
								</div>

								<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
									<span class="fas fa-user form-control-feedback mirror"></span>
									<input type="text" class="form-control" name="f_userpint" placeholder="Pinterest" autocomplete="off">
									<label class="label-form-control" for="f_userpint">Pinterest:</label>
								</div>	
							</div>
						
							<!-- FOTOS FORM -->
							<div class="row">
								<div class="form-group col-auto photo-section">
									<div class="form-group border bg-dark rounded image_pvw" align="center" >
										<img id="img_preview" src="../assets/images/usuarios/00.jpg" alt=""/>
									</div>
									<div class="file-field input-group rounded-top-0 btn-upload-content col-auto">
										<input type="file"  class="custom-file-input pictureUpload rounded-top-0" name="archivo" id="archivo" />
										<label class="custom-file-label rounded-top-0" for="customFile">Seleccionar Fotos</label>
									</div>
								</div>
							</div>
							
						</div>
						<div class="col-12 d-flex justify-content-end">
							<input class="rounded-5 btn text-right collapsed current-bg-primary text-decoration-none pt-2 pb-2" 
								id="guardar_usuario" type="submit" name="subir" value="Guardar"/>
							</input>
						</div>
					</div>

				</form>
			</div>
				</div>
			</section>
		</div>
	</div>

	<?php include 'include/footer.php';?>
	<div id="Guardando" style="position: fixed;top: 20%;right: 50%;translate: 50% 50%;background-color: #fff;text-align: center;font-weight: bold;padding: 2rem;z-index: 20;border: solid 1px #f1f1f1;display: none;">
		<i class="fas fa-spinner fa-pulse"></i>
		<p>Guardando</p>
	</div>
	<?php /* include 'include/scripts.php'; */ ?>
	<script src="../assets/js/jquery-3.5.1.min.js"></script>
	<script src="../assets/js/jquery.alphanum.js"></script>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
		$(document).ready(function() {
			
			$('#guardar_usuario').submit(function () {
				$('#Guardando').fadeIn();
			})

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#img_preview').attr('src', e.target.result);					
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#archivo").change(function() {
			readURL(this);
			});

			
		});
	</script>

</body>
</html>