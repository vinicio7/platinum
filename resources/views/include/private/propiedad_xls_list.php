<?php
/*-------------------------
PROPERTY LIST
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

//EXPORTAR_EXCEL PROPIEDADES
if(isset($_POST["export_data_pro"])) 
{
	//GENERACION DE ARCHIVO EXCEL
	$filename = "Propiedades.xlsx"; 
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=".$filename); 
	$mostrar_columnas = false; 

	//CONSULTA_PROPIEDADES
	$query = mysqli_query($con, "SELECT * FROM `si_properties` ORDER BY `si_properties`.`in_mu_id` ASC" );
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{
		$in_mu_id = $ferow['in_mu_id'];
		$in_titul = utf8_encode($ferow['in_titul']);
		$in_pre_v = $ferow['in_pre_v'];
		$in_pre_r = $ferow['in_pre_r'];
		$in_direc = utf8_encode($ferow['in_di_di']);
		$in_vende = utf8_encode($ferow['in_vende']);
		$in_de_ot = utf8_encode($ferow['in_de_ot']);
		$in_estat = $ferow['in_estat'];
		$in_fe_in = $ferow['in_fe_in'];

		if ($in_estat == 0) 
		{$in_estat = "Activa";}  else 
		if ($in_estat == 1) 
		{$in_estat = "Vendida";} else 
		{$in_estat = "Alquilada";}

		//CONSULTA CORREDOR 
		$query2 = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "'" );
		$count_core = mysqli_num_rows($query2);
		$ferow = mysqli_fetch_array($query2);
		if ($count_core > 0) 
		{ $in_vende = utf8_encode($ferow['id_users'] . " - " . $ferow['firstnam'] . " " . $ferow['lastname']); } 
		else { $in_vende = "No hay datos"; }

		?>
		<table class="table table-striped table-bordered" border="1">
			<thead align=center>
				<tr bgcolor="silver">
					<th scope="col">Código</th>
					<th scope="col">Fecha</th>
					<th scope="col">Titulo</th>
					<th scope="col">Precio</th>
					<th scope="col">Direccion</th>
					<th scope="col">Vendedor</th>
					<th scope="col">Detalles</th>
					<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody align=center>
				<tr>
					<th> <?php echo $in_mu_id; ?> </th>
					<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $in_fe_in; ?> </td>
					<td> <?php echo $in_titul; ?> </td>
					<td> <?php echo "Venta $" . $in_pre_v . " Renta $" . $in_pre_r; ?> </td>
					<td> <?php echo $in_direc; ?> </td>
					<td> <?php echo $in_vende; ?> </td> 
					<td> <?php echo $in_de_ot; ?> </td>
					<td> <?php echo $in_estat; ?> </td>
				</tr>
				<?php
				for ($i = 1; $i <= $count_prop - 1; $i++) 
				{
					//Repetir
					$ferow = mysqli_fetch_array($query);

					$in_mu_id = $ferow['in_mu_id'];
					$in_titul = utf8_encode($ferow['in_titul']);
					$in_pre_v = $ferow['in_pre_v'];
					$in_pre_r = $ferow['in_pre_r'];
					$in_direc = utf8_encode($ferow['in_di_di']);
					$in_vende = utf8_encode($ferow['in_vende']);
					$in_de_ot = utf8_encode($ferow['in_de_ot']);
					$in_estat = $ferow['in_estat'];
					$in_fe_in = $ferow['in_fe_in'];

					if ($in_estat == 0) 
					{$in_estat = "Activa";}  else 
					if ($in_estat == 1) 
					{$in_estat = "Vendida";} else 
					{$in_estat = "Alquilada";}

					//CONSULTA CORREDOR  
					$query2 = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "'" );
					$count_core = mysqli_num_rows($query2);
					$ferow = mysqli_fetch_array($query2);
					if ($count_core > 0) 
					{ $in_vende = utf8_encode($ferow['id_users'] . " - " . $ferow['firstnam'] . " " . $ferow['lastname']); } 
					else { $in_vende = "No hay datos"; }
					?>
					<tr>
						<th> <?php echo $in_mu_id; ?> </th>
						<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $in_fe_in; ?> </td>
						<td> <?php echo $in_titul; ?> </td>
						<td> <?php echo "Venta $" . $in_pre_v . " Renta $" . $in_pre_r; ?> </td>
						<td> <?php echo $in_direc; ?> </td>
						<td> <?php echo $in_vende; ?> </td> 
						<td> <?php echo $in_de_ot; ?> </td>
						<td> <?php echo $in_estat; ?> </td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	} exit; 
}//FIN PROPIEDADES

//EXPORTAR_EXCEL PROPIETARIOS
if(isset($_POST["export_data_due"])) 
{
	//GENERACION DE ARCHIVO EXCEL
	$filename = "Propietarios.xlsx"; 
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=".$filename); 
	$mostrar_columnas = false; 

	//CONSULTA_PROPIETARIOS
	$query = mysqli_query($con, "SELECT * FROM `si_users` WHERE `usertipe` = 5 ORDER BY `si_users`.`id_users` ASC" );
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{
		$id_users = $ferow['id_users'];
		$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
		$usermail = utf8_encode($ferow['usermail']);
		$phonenum = $ferow['phonenum'];
		$phonenu2 = utf8_encode($ferow['phonenu2']);
		$userdate = utf8_encode($ferow['userdate']);
		$useraddr = utf8_encode($ferow['useraddr']);
		$userndpi = utf8_encode($ferow['userndpi']);
		$userstat = $ferow['userstat'];

		if ($userstat == 1) 
		{$userstat = "Activo";} else 
		{$userstat = "Inactivo";}

		?>
		<table class="table table-striped table-bordered" border="1">
			<thead align=center>
				<tr bgcolor="silver">
					<th scope="col">Código</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo Electrónico</th>
					<th scope="col">Celular 1</th>
					<th scope="col">Celular 2</th>
					<th scope="col">Cumpleaños</th>
					<th scope="col">Dirección</th>
					<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody align=center>
				<tr>
					<th> <?php echo $id_users; ?> </th>
					<td> <?php echo $username; ?> </td>
					<td> <?php echo $usermail; ?> </td>
					<td> <?php echo $phonenum; ?> </td>
					<td> <?php echo $phonenu2; ?> </td>
					<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
					<td> <?php echo $useraddr; ?> </td>
					<td> <?php echo $userstat; ?> </td>
				</tr>
				<?php
				for ($i = 1; $i <= $count_prop - 1; $i++) 
				{
					//Repetir
					$ferow = mysqli_fetch_array($query);

					$id_users = $ferow['id_users'];
					$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
					$usermail = utf8_encode($ferow['usermail']);
					$phonenum = $ferow['phonenum'];
					$phonenu2 = utf8_encode($ferow['phonenu2']);
					$userdate = utf8_encode($ferow['userdate']);
					$useraddr = utf8_encode($ferow['useraddr']);
					$userndpi = utf8_encode($ferow['userndpi']);
					$userstat = $ferow['userstat'];

					if ($userstat == 1) 
					{$userstat = "Activo";} else 
					{$userstat = "Inactivo";}
					?>
					<tr>
						<th> <?php echo $id_users; ?> </th>
						<td> <?php echo $username; ?> </td>
						<td> <?php echo $usermail; ?> </td>
						<td> <?php echo $phonenum; ?> </td>
						<td> <?php echo $phonenu2; ?> </td>
						<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
						<td> <?php echo $useraddr; ?> </td>
						<td> <?php echo $userstat; ?> </td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	} exit; 
}//FIN PROPIETARIOS

//EXPORTAR_EXCEL CLIENTES
if(isset($_POST["export_data_cli"])) 
{
	//GENERACION DE ARCHIVO EXCEL
	$filename = "Clientes.xlsx"; 
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=".$filename); 
	$mostrar_columnas = false; 

	//CONSULTA CLIENTES
	$query = mysqli_query($con, "SELECT * FROM `si_users` WHERE `usertipe` = 6 ORDER BY `si_users`.`id_users` ASC" );
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{
		$id_users = $ferow['id_users'];
		$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
		$usermail = utf8_encode($ferow['usermail']);
		$phonenum = $ferow['phonenum'];
		$phonenu2 = utf8_encode($ferow['phonenu2']);
		$userdate = utf8_encode($ferow['userdate']);
		$useraddr = utf8_encode($ferow['useraddr']);
		$userndpi = utf8_encode($ferow['userndpi']);
		$userstat = $ferow['userstat'];

		if ($userstat == 1) 
		{$userstat = "Activo";} else 
		{$userstat = "Inactivo";}

		?>
		<table class="table table-striped table-bordered" border="1">
			<thead align=center>
				<tr bgcolor="silver">
					<th scope="col">Código</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo Electrónico</th>
					<th scope="col">Celular 1</th>
					<th scope="col">Celular 2</th>
					<th scope="col">Cumpleaños</th>
					<th scope="col">Dirección</th>
					<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody align=center>
				<tr>
					<th> <?php echo $id_users; ?> </th>
					<td> <?php echo $username; ?> </td>
					<td> <?php echo $usermail; ?> </td>
					<td> <?php echo $phonenum; ?> </td>
					<td> <?php echo $phonenu2; ?> </td>
					<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
					<td> <?php echo $useraddr; ?> </td>
					<td> <?php echo $userstat; ?> </td>
				</tr>
				<?php
				for ($i = 1; $i <= $count_prop - 1; $i++) 
				{
					//Repetir
					$ferow = mysqli_fetch_array($query);

					$id_users = $ferow['id_users'];
					$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
					$usermail = utf8_encode($ferow['usermail']);
					$phonenum = $ferow['phonenum'];
					$phonenu2 = utf8_encode($ferow['phonenu2']);
					$userdate = utf8_encode($ferow['userdate']);
					$useraddr = utf8_encode($ferow['useraddr']);
					$userndpi = utf8_encode($ferow['userndpi']);
					$userstat = $ferow['userstat'];

					if ($userstat == 1) 
					{$userstat = "Activo";} else 
					{$userstat = "Inactivo";}
					?>
					<tr>
						<th> <?php echo $id_users; ?> </th>
						<td> <?php echo $username; ?> </td>
						<td> <?php echo $usermail; ?> </td>
						<td> <?php echo $phonenum; ?> </td>
						<td> <?php echo $phonenu2; ?> </td>
						<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
						<td> <?php echo $useraddr; ?> </td>
						<td> <?php echo $userstat; ?> </td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	} exit; 
}//FIN CLIENTES

//EXPORTAR_EXCEL ASESORES
if(isset($_POST["export_data_ase"])) 
{
	//GENERACION DE ARCHIVO EXCEL
	$filename = "Asesores.xlsx"; 
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=".$filename); 
	$mostrar_columnas = false; 

	//CONSULTA ASESORES
	$query = mysqli_query($con, "SELECT * FROM `si_users` WHERE `usertipe` = 3 ORDER BY `si_users`.`id_users` ASC" );
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{
		$id_users = $ferow['id_users'];
		$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
		$usermail = utf8_encode($ferow['usermail']);
		$phonenum = $ferow['phonenum'];
		$phonenu2 = utf8_encode($ferow['phonenu2']);
		$userdate = utf8_encode($ferow['userdate']);
		$useraddr = utf8_encode($ferow['useraddr']);
		$userndpi = utf8_encode($ferow['userndpi']);
		$userstat = $ferow['userstat'];

		if ($userstat == 1) 
		{$userstat = "Activo";} else 
		{$userstat = "Inactivo";}

		?>
		<table class="table table-striped table-bordered" border="1">
			<thead align=center>
				<tr bgcolor="silver">
					<th scope="col">Código</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo Electrónico</th>
					<th scope="col">Celular 1</th>
					<th scope="col">Celular 2</th>
					<th scope="col">Cumpleaños</th>
					<th scope="col">Dirección</th>
					<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody align=center>
				<tr>
					<th> <?php echo $id_users; ?> </th>
					<td> <?php echo $username; ?> </td>
					<td> <?php echo $usermail; ?> </td>
					<td> <?php echo $phonenum; ?> </td>
					<td> <?php echo $phonenu2; ?> </td>
					<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
					<td> <?php echo $useraddr; ?> </td>
					<td> <?php echo $userstat; ?> </td>
				</tr>
				<?php
				for ($i = 1; $i <= $count_prop - 1; $i++) 
				{
					//Repetir
					$ferow = mysqli_fetch_array($query);

					$id_users = $ferow['id_users'];
					$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
					$usermail = utf8_encode($ferow['usermail']);
					$phonenum = $ferow['phonenum'];
					$phonenu2 = utf8_encode($ferow['phonenu2']);
					$userdate = utf8_encode($ferow['userdate']);
					$useraddr = utf8_encode($ferow['useraddr']);
					$userndpi = utf8_encode($ferow['userndpi']);
					$userstat = $ferow['userstat'];

					if ($userstat == 1) 
					{$userstat = "Activo";} else 
					{$userstat = "Inactivo";}
					?>
					<tr>
						<th> <?php echo $id_users; ?> </th>
						<td> <?php echo $username; ?> </td>
						<td> <?php echo $usermail; ?> </td>
						<td> <?php echo $phonenum; ?> </td>
						<td> <?php echo $phonenu2; ?> </td>
						<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
						<td> <?php echo $useraddr; ?> </td>
						<td> <?php echo $userstat; ?> </td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	} exit; 
}//FIN ASESORES

//EXPORTAR_EXCEL USUARIOS DE SISTEMA
if(isset($_POST["export_data_use"])) 
{
	//GENERACION DE ARCHIVO EXCEL
	$filename = "Usuarios.xlsx"; 
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=".$filename); 
	$mostrar_columnas = false; 

	//CONSULTA USUARIOS
	$query = mysqli_query($con, "SELECT * FROM `si_users` WHERE `usertipe` = 1 OR `usertipe` = 2 ORDER BY `si_users`.`id_users` ASC" );
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{
		$id_users = $ferow['id_users'];
		$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
		$usermail = utf8_encode($ferow['usermail']);
		$phonenum = $ferow['phonenum'];
		$userdate = utf8_encode($ferow['userdate']);
		$usernams = utf8_encode($ferow['username']);
		$userpass = utf8_encode($ferow['userpass']);
		$userndpi = utf8_encode($ferow['userndpi']);
		$userstat = $ferow['userstat'];

		if ($userstat == 1) 
		{$userstat = "Activo";} else 
		{$userstat = "Inactivo";}

		?>
		<table class="table table-striped table-bordered" border="1">
			<thead align=center>
				<tr bgcolor="silver">
					<th scope="col">Código</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo Electrónico</th>
					<th scope="col">Celular 1</th>
					<th scope="col">Cumpleaños</th>
					<th scope="col">User</th>
					<th scope="col">Pass</th>
					<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody align=center>
				<tr>
					<th> <?php echo $id_users; ?> </th>
					<td> <?php echo $username; ?> </td>
					<td> <?php echo $usermail; ?> </td>
					<td> <?php echo $phonenum; ?> </td>
					<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
					<td> <?php echo $usernams; ?> </td>
					<td> <?php echo $userpass; ?> </td>
					<td> <?php echo $userstat; ?> </td>
				</tr>
				<?php
				for ($i = 1; $i <= $count_prop - 1; $i++) 
				{
					//Repetir
					$ferow = mysqli_fetch_array($query);

					$id_users = $ferow['id_users'];
					$username = utf8_encode($ferow['firstnam']." ".$ferow['lastname']." - ".$ferow['userproy']);
					$usermail = utf8_encode($ferow['usermail']);
					$phonenum = $ferow['phonenum'];
					$userdate = utf8_encode($ferow['userdate']);
					$usernams = utf8_encode($ferow['username']);
					$userpass = utf8_encode($ferow['userpass']);
					$userndpi = utf8_encode($ferow['userndpi']);
					$userstat = $ferow['userstat'];

					if ($userstat == 1) 
					{$userstat = "Activo";} else 
					{$userstat = "Inactivo";}
					?>
					<tr>
						<th> <?php echo $id_users; ?> </th>
						<td> <?php echo $username; ?> </td>
						<td> <?php echo $usermail; ?> </td>
						<td> <?php echo $phonenum; ?> </td>
						<td data-type="date" data-format-string="DD-MM-YYYY"> <?php echo $userdate; ?> </td>
						<td> <?php echo $usernams; ?> </td>
						<td> <?php echo $userpass; ?> </td>
						<td> <?php echo $userstat; ?> </td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	} exit; 
}//FIN USUARIOS
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php'; ?>
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php'; ?>
	<div class="contenedor bg-light" id="contenedor">
		<div class="container-fluid bg-primary bg-blue-gradient "> </div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

				<?php //ACCESO ADMIN Y GERENTE
				$usertipe = $_SESSION['usertipe'];
				if ($usertipe == 1 OR $usertipe == 2) 
				{ ?>
				<!-- BODY -->
				<div class="container-fluid">
					<h3>Reportería para exportar</h3>

					<!-- FORMULARIO_BUSQUEDA -->
					<form method="POST" name="busqueda" action="propiedad_xls_list.php" class="form-inline" autocomplete="off">

						<!-- FECHA INICIO -->
						<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
							<span class="fas fa-calendar-alt form-control-feedback mirror"></span>
							<input type="date" class="form-control" name="buscar_fecha1" autocomplete="off">
							<label class="label-form-control" for="f_userdate">Fecha Inicial:</label>
						</div>

						<!-- FECHA FIN -->
						<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-4 mb-4">
							<span class="fas fa-calendar-alt form-control-feedback mirror"></span>
							<input type="date" class="form-control" name="buscar_fecha2" autocomplete="off">
							<label class="label-form-control" for="f_userdate">Fecha Final:</label>
						</div>

						<!-- TIPO -->
						<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 mb-4">
							<span class="fas fa-portrait form-control-feedback mirror"></span>
							<select class="form-control" name="buscar_tipo">
								<option disabled selected>Selecciona</option>	
								<option value="1">Propiedad</option>
								<option value="2">Propietario</option>
								<option value="3">Cliente</option>
								<option value="4">Asesor</option>
								<?php $usertipe = $_SESSION['usertipe'];
								if ($usertipe == 1) 
								{ ?> <option value="5">Usuarios</option><?php } ?>
							</select>
							<label class="label-form-control" for="buscar_tipo">Tipo:</label>
						</div>

						<!-- BOTON BUSCAR -->
						<div class="form-group mx-sm-3 mb-2">
							<button class="btn btn-primary">Buscar</button>
						</div>
					</form>

					<?php
					if(isset($_POST["buscar_tipo"])) 
					{
						$re_tip1 = $_POST["buscar_tipo"];
						$re_fec1 = $_POST["buscar_fecha1"];
						$re_fec2 = $_POST["buscar_fecha2"];

						if($re_tip1 == 1){$re_query = "SELECT * FROM `si_properties` WHERE `in_fe_in`                  BETWEEN '$re_fec1 00:00:00' AND '$re_fec2 23:59:59' ";}else
						if($re_tip1 == 2){$re_query = "SELECT * FROM `si_users`      WHERE `usertipe`=5 and `datadded` BETWEEN '$re_fec1 00:00:00' AND '$re_fec2 23:59:59' ";}else
						if($re_tip1 == 3){$re_query = "SELECT * FROM `si_users`      WHERE `usertipe`=6 and `datadded` BETWEEN '$re_fec1 00:00:00' AND '$re_fec2 23:59:59' ";}else
						if($re_tip1 == 4){$re_query = "SELECT * FROM `si_users`      WHERE `usertipe`=3 and `datadded` BETWEEN '$re_fec1 00:00:00' AND '$re_fec2 23:59:59' ";}else
						if($re_tip1 == 5){$re_query = "SELECT * FROM `si_users`      WHERE `usertipe`=1 and `datadded` BETWEEN '$re_fec1 00:00:00' AND '$re_fec2 23:59:59' ";}

						//--CONSULTA DE REPORTE 
						$query = mysqli_query($con, $re_query );
						$reporte = mysqli_num_rows($query);
						$ferow = mysqli_fetch_array($query);
						if ($reporte > 0) 
						{
							if($re_tip1 == 1){$re_tip2 = "Propiedades";}else
							if($re_tip1 == 2){$re_tip2 = "Propietarios";}else
							if($re_tip1 == 3){$re_tip2 = "Clientes";}else
							if($re_tip1 == 4){$re_tip2 = "Asesores";}else
							if($re_tip1 == 5){$re_tip2 = "Usuarios de Sistema";}
							$re_fech = $_POST["buscar_fecha1"] ." al " . $_POST["buscar_fecha2"];
							?>

							

							<!-- BOTONES_FORM -->
							<form action=" <?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="form-inline">
								<!-- TABLA DE RESULTADOS DE REPORTE -->
								<h5>Resultados de la Búsqueda</h5>
								<table class="table table-striped table-bordered">
									<thead align=center>
										<tr>
											<th scope="col">Cantidad</th>
											<th scope="col">Tipo</th>
											<th scope="col">Rango de Fecha</th>
										</tr>
									</thead>
									<tbody align=center>
										<tr>
											<td> <?php echo $reporte; ?> </td>
											<td> <?php echo $re_tip2; ?> </td>
											<td> <?php echo $re_fech; ?> </td>
										</tr>
									</tbody>
								</table>

								<?php
									if($re_tip1 == 1){?>
										<div class="form-group mx-sm-3 mb-2">
											<button type="submit" id="export_data_pro" name='export_data_pro' value="Export to excel" class="btn btn-primary">
											<i class="fas fa-file-excel"></i>
											Exportar</button>
										</div>
									<?php }

									if($re_tip1 == 2){?>
										<div class="form-group mx-sm-3 mb-2">
											<button type="submit" id="export_data_due" name='export_data_due' value="Export to excel" class="btn btn-primary">
											<i class="fas fa-file-excel"></i>
											Exportar</button>
										</div>
									<?php }

									if($re_tip1 == 3){?>
										<div class="form-group mx-sm-3 mb-2">
											<button type="submit" id="export_data_cli" name='export_data_cli' value="Export to excel" class="btn btn-primary">
											<i class="fas fa-file-excel"></i>
											Exportar</button>
										</div>
									<?php }

									if($re_tip1 == 4){?>
										<div class="form-group mx-sm-3 mb-2">
											<button type="submit" id="export_data_ase" name='export_data_ase' value="Export to excel" class="btn btn-primary">
											<i class="fas fa-file-excel"></i>
											Exportar</button>
										</div>
									<?php }

									$usertipe = $_SESSION['usertipe'];
									if($re_tip1 == 5 and $usertipe == 1){?>
										<div class="form-group mx-sm-3 mb-2">
											<button type="submit" id="export_data_use" name='export_data_use' value="Export to excel" class="btn btn-primary">
											<i class="fas fa-file-excel"></i>
											Exportar</button>
										</div>
									<?php }
								?>
							</form>
							<?php
						} 
					}?>
				</div>
				<?php } else {?>
				<!-- BODY -->
				<div class="container-fluid">
					<h3>No Autorizado</h3>
				</div>
				<?php } ?>

			</section>
		</div>
	</div>

	<?php include 'include/footer.php'; ?>
	<?php include 'include/scripts.php';  ?>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
	$(document).ready(function() {
		initGeneral();
	});
	</script>

</body>

</html>