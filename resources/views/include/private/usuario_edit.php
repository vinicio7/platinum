<?php
	/*-------------------------
	USER FORM EDIT
	Autor: Gustavo Blanco
	Web: chofo7.blogspot.com
	Mail: chofo7@gmail.com
	---------------------------*/
	
	// Notificar todos los errores excepto E_NOTICE
	error_reporting(E_ALL ^ E_NOTICE);

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


	if (!empty($_GET ['id'])) 
	{ $id = $_GET['id']; } 
	else 
	{ $id = '0'; }
	
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
		$aseso_te = $ferow['phonenum'];  //Usuario Celular 1
		$aseso_t2 = $ferow['phonenu2'];  //Usuario Celular 2
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
		$aseso_it = $ferow['userinst'];  //Usuario Instagram
		$aseso_li = $ferow['userlink'];  //Usuario LinkedIN
		$aseso_yo = $ferow['useryout'];  //Usuario Youtube
		$aseso_pi = $ferow['userpint'];  //Usuario Pinterest
	}

	//DATOS OBLIGATORIOS DE FOMULARIO
	if (isset($_POST['f_firstnam']) && !empty($_POST ['f_firstnam']) && isset($_POST['f_lastname']) && !empty($_POST ['f_lastname']))
	{
		if (!$con)
		{
			die (" Error de Base de Datos " . mysqli_error($con));
		}
			else
		{
			//CAPTURA DATOS DE FORMULARIO
			if (!empty($_POST ['f_firstnam'])) {$f_firstnam = utf8_decode($_POST['f_firstnam']);} else {$f_firstnam = "";}

			if (!empty($_POST ['f_lastname'])) {$f_lastname = utf8_decode($_POST['f_lastname']);} else {$f_lastname = "";}

			if (!empty($_POST ['f_username'])) {$f_username = utf8_decode($_POST['f_username']);} else {$f_username = "";}

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

			//INSERTA EN LA BASE DE DATOS
			mysqli_query($con,"UPDATE `si_users` SET
			`firstnam` = '$f_firstnam',		
			`lastname` = '$f_lastname',		
			`username` = '$f_username',
			`userpass` = '$f_userpass',		
			`usermail` = '$f_usermail',		
			`usertipe` = '$f_usertipe',		
			`userstat` = '$f_userstat',		
			`phonenum` = '$f_phonenum',
			`phonenu2` = '$f_phonenu2',
			`userdate` = '$f_userdate',
			`useraddr` = '$f_useraddr',		
			`usergend` = '$f_usergend',
			`userndpi` = '$f_userndpi',		
			`usermatr` = '$f_usermatr',		
			`userprof` = '$f_userprof',
			`useripor` = '$f_useripor',
			`userface` = '$f_userface',	
			`usertwit` = '$f_usertwit',	
			`userwhat` = '$f_userwhat',
			`userinst` = '$f_userinst',	
			`userlink` = '$f_userlink',	
			`useryout` = '$f_useryout',
			`userpint` = '$f_userpint'
			WHERE `si_users`.`id_users` = '$id'
			");

			//ALMACENA_UNA_FOTO
			if (isset($_POST['subir'])) 
			{
				$archivo = $_FILES['archivo']['name'];
				if (isset($archivo) && $archivo != "") 
				{
					$tipo = $_FILES['archivo']['type'];
					$tamano = $_FILES['archivo']['size'];
					$temp = $_FILES['archivo']['tmp_name'];
					if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 9000000))) 
					{
						//echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
					}
					else {
						if (move_uploaded_file($temp, '../assets/images/usuarios/'.($id).'.png')) 
						{
							chmod('../assets/images/usuarios/'.($id).'.png', 0777);
						}
						else 
						{
							//echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
						}
					}
				}
			}
			?> <script type="text/javascript">
				window.location.replace("usuario_view.php?id=<?php echo $id; ?>");
			</script> 
			<?php
			?>

	<!-- MENSAJES EN PANTALLA -->
	<div style="position: fixed;top: 115px; left: 50%; z-index: 1500;">
		<div id="toastregistrosGuardados" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header bg-success text-white">
				<strong class="mr-auto">Aviso!</strong>
				<script type="text/javascript">
					alert( "<?php echo $aseso_fn." ".$aseso_ln. " DATOS ACTUALIZADOS... "; ?>" );
				</script>

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
		<div class="container-fluid bg-primary bg-blue-gradient ">

		</div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

			<!-- BODY -->
			<div class="container-fluid">
				<h3 class="text-dark">ACTUALIZAR DATOS - CODIGO: <input type="text" name="f_aseso_id" value="<?php echo $aseso_id; ?>" disabled></h3>
				<p>Clientes, Propietarios, Usuarios de Sistema, etc.</p>
				<hr/>

				<!-- FORMULARIO INGRESO -->
				<form action="usuario_edit.php?id=<?php echo $aseso_id; ?>" id="formNuevosUsuarios" method="POST" role="form" class="f1 pt-0 pb-0" autocomplete="off" enctype="multipart/form-data"/>
					<div class="accordion" id="datos">
						<div class="row pt-3">
							<div class="form-group col-12">
								<div class="row pb-3">
									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-id-card form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_firstnam" placeholder="Ingrese Nombre" autocomplete="off" value="<?php echo $aseso_fn; ?>">
										<label class="label-form-control" for="f_firstnam">Nombre:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-id-card form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_lastname" placeholder="Ingrese Apellido" autocomplete="off" value="<?php echo $aseso_ln; ?>">
										<label class="label-form-control" for="f_lastname">Apellido:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-city form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userproy" placeholder="Ingrese Nombre de Proyecto" autocomplete="off" value="<?php echo $aseso_py; ?>">
										<label class="label-form-control" for="f_userproy">Nombre del Proyecto:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_username" placeholder="Nombre de Usuario (Sistema)" autocomplete="off" value="<?php echo $aseso_us; ?>">
										<label class="label-form-control" for="f_username">Usuario:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-lock form-control-feedback mirror"></span>
										<input type="password" class="form-control" name="f_userpass" placeholder="Contraseña" autocomplete="off" value="<?php echo $aseso_ps; ?>">
										<label class="label-form-control" for="f_userpass">Contraseña:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-user-cog form-control-feedback mirror"></span>
										<select class="form-control" name="f_usertipe" required >
											<option value="0" <?php if($aseso_tu==0){echo "selected";} ?> >Seleccionar</option>
											<option value="1" <?php if($aseso_tu==1){echo "selected";} ?> >Administrador</option>
											<option value="2" <?php if($aseso_tu==2){echo "selected";} ?> >Gerente</option>
											<option value="3" <?php if($aseso_tu==3){echo "selected";} ?> >Vendedor Interno</option>
											<option value="4" <?php if($aseso_tu==4){echo "selected";} ?> >Vendedor Externo</option>
											<option value="5" <?php if($aseso_tu==5){echo "selected";} ?> >Propietario</option>
											<option value="6" <?php if($aseso_tu==6){echo "selected";} ?> >Cliente</option>
											<option value="7" <?php if($aseso_tu==7){echo "selected";} ?> >Proyecto</option>
										</select>
										<label class="label-form-control" for="f_usertipe">Tipo de Usuario:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-envelope form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_usermail" placeholder="Correo Electrónico" autocomplete="off" value="<?php echo $aseso_co; ?>">
										<label class="label-form-control" for="f_usermail">Correo Electrónico:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-phone form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_phonenum" placeholder="12345678" autocomplete="off" value="<?php echo $aseso_te; ?>">
										<label class="label-form-control" for="f_phonenum">Celular 1:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-phone form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_phonenu2" placeholder="+0010123567890" autocomplete="off" value="<?php echo $aseso_t2; ?>">
										<label class="label-form-control" for="f_phonenu2">Celular 2 / Cel USA:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-map-marker-alt form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_useraddr" placeholder="Dirección" autocomplete="off" value="<?php echo $aseso_di; ?>">
										<label class="label-form-control" for="f_useraddr">Dirección:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-id-card form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userndpi" placeholder="DPI" autocomplete="off" value="<?php echo $aseso_dp; ?>">
										<label class="label-form-control" for="f_userndpi">DPI:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
										<span class="fas fa-calendar-alt form-control-feedback mirror"></span>
										<input type="date" class="form-control" name="f_userdate" placeholder="Dia-Mes-Año" autocomplete="off" 
										value="<?php  echo ("$aseso_cu"); ?>">
										<label class="label-form-control" for="f_userdate">Fecha de Nacimiento:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-portrait form-control-feedback mirror"></span>
										<select class="form-control" name="f_usermatr">
											<option value="0" <?php if($aseso_ec==0){echo "selected";} ?> >Seleccionar</option>
											<option value="1" <?php if($aseso_ec==1){echo "selected";} ?> >Casado(a)</option>
											<option value="2" <?php if($aseso_ec==2){echo "selected";} ?> >Soltero(a)</option>
											<option value="3" <?php if($aseso_ec==3){echo "selected";} ?> >Unido(a)</option>
											<option value="4" <?php if($aseso_ec==4){echo "selected";} ?> >Viudo(a)</option>
											<option value="5" <?php if($aseso_ec==5){echo "selected";} ?> >Divorciado(a)</option>
										</select>
										<label class="label-form-control" for="f_usermatr">Estado Civil:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="far fa-user form-control-feedback mirror"></span>
										<select class="form-control" name="f_usergend">
											<option value="0" <?php if($aseso_ge==0){echo "selected";} ?> >Seleccionar</option>
											<option value="1" <?php if($aseso_ge==1){echo "selected";} ?> >Masculino</option>
											<option value="2" <?php if($aseso_ge==2){echo "selected";} ?> >Femenino</option>
										</select>
										<label class="label-form-control" for="f_usergend">Género:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user-tie form-control-feedback mirror"></span>
										<select class="form-control" name="f_userprof">
											<option value="0"  <?php if($aseso_pr==0) {echo "selected";} ?> >Seleccionar</option>
											<option value="1"  <?php if($aseso_pr==1) {echo "selected";} ?> >Sr.</option>
											<option value="2"  <?php if($aseso_pr==2) {echo "selected";} ?> >Sra.</option>
											<option value="3"  <?php if($aseso_pr==3) {echo "selected";} ?> >Srita.</option>
											<option value="4"  <?php if($aseso_pr==4) {echo "selected";} ?> >Ing.</option>
											<option value="5"  <?php if($aseso_pr==5) {echo "selected";} ?> >Dr.</option>
											<option value="6"  <?php if($aseso_pr==6) {echo "selected";} ?> >Dra.</option>
											<option value="7"  <?php if($aseso_pr==7) {echo "selected";} ?> >Lic.</option>
											<option value="8"  <?php if($aseso_pr==8) {echo "selected";} ?> >Licda.</option>
											<option value="9"  <?php if($aseso_pr==9) {echo "selected";} ?> >Baco.</option>
											<option value="10" <?php if($aseso_pr==10){echo "selected";} ?> >Conta.</option>
											<option value="11" <?php if($aseso_pr==11){echo "selected";} ?> >Prof.</option>
											<option value="12" <?php if($aseso_pr==12){echo "selected";} ?> >Profa.</option>
											<option value="13" <?php if($aseso_pr==13){echo "selected";} ?> >Asociado Platinum.</option>
											<option value="14" <?php if($aseso_pr==14){echo "selected";} ?> >Asociada Platinum.</option>
											<option value="15" <?php if($aseso_pr==15){echo "selected";} ?> >Asociado Senior.</option>
											<option value="16" <?php if($aseso_pr==16){echo "selected";} ?> >Asociada Senior.</option>
											<option value="17" <?php if($aseso_pr==17){echo "selected";} ?> >Asociado Élite.</option>
											<option value="18" <?php if($aseso_pr==18){echo "selected";} ?> >Asociada Élite.</option>
											<option value="19" <?php if($aseso_pr==19){echo "selected";} ?> >Broker Owner Manager.</option>
										</select>
										<label class="label-form-control" for="f_userprof">Título:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-id-card-alt form-control-feedback mirror"></span>
										<select class="form-control" name="f_userstat" required>
											<option value="1" <?php if($aseso_es==1) {echo "selected";} ?>>Activo</option>
											<option value="0" <?php if($aseso_es==0) {echo "selected";} ?>>Inactivo</option>
										</select>
										<label class="label-form-control" for="f_userstat">Estado del Usuario:</label>
									</div>

									<!-- REDES SOCIALES -->
									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userface" placeholder="Facebook" autocomplete="off" value="<?php echo $aseso_fb; ?>">
										<label class="label-form-control" for="f_userface">Facebook:</label>
									</div>	

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_usertwit" placeholder="Twitter" autocomplete="off" value="<?php echo $aseso_tw; ?>">
										<label class="label-form-control" for="f_usertwit">Twitter:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userwhat" placeholder="Whatsapp" autocomplete="off" value="<?php echo $aseso_wa; ?>">
										<label class="label-form-control" for="f_userwhat">Whatsapp:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userinst" placeholder="Instagram" autocomplete="off" value="<?php echo $aseso_it; ?>">
										<label class="label-form-control" for="f_userinst">Instagram:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userlink" placeholder="Linkedin" autocomplete="off" value="<?php echo $aseso_li; ?>">
										<label class="label-form-control" for="f_userlink">Linkedin:</label>
									</div>		

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_useryout" placeholder="Youtube" autocomplete="off" value="<?php echo $aseso_yo; ?>">
										<label class="label-form-control" for="f_useryout">Youtube:</label>
									</div>

									<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
										<span class="fas fa-user form-control-feedback mirror"></span>
										<input type="text" class="form-control" name="f_userpint" placeholder="Pinterest" autocomplete="off" value="<?php echo $aseso_pi; ?>">
										<label class="label-form-control" for="f_userpint">Pinterest:</label>
									</div>	
								</div>
							
								<!-- FOTOS FORM -->
								<div class="row">
									<div class="form-group col-auto photo-section">
										<div class="form-group border bg-dark rounded image_pvw" align="center" >
											<img id="img_preview" src="../assets/images/usuarios/<?php echo $aseso_id; ?>.png" alt=""/>
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
									id="guardar_usuario" type="submit" name="subir" value="Guardar Cambios"/>
								</input>
							</div>
						</div>
					</div>

			</div>
			</form>
			</div>
				</div>
			</section>
		</div>
	</div>

	<?php include 'include/footer.php';?>
	<?php /* include 'include/scripts.php'; */ ?>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
		$(document).ready(function() {
			initGeneral();
		});
	</script>

</body>
</html>