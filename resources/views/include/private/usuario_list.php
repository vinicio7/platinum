<?php
	/*-------------------------
	USER LIST
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php';?>
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php';?>
	<div class="contenedor bg-light" id="contenedor">

		<div class="loader-bg" id="loader">
			<div class="spinner-border text-warning loader" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>

		<div class="container-fluid bg-primary bg-blue-gradient ">

		</div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

			<!-- BODY -->
			<div class="container-fluid">
				<h3>Lista de Usuarios / Contactos</h3>
				<div class="card-footer clearfix">
					<form action="#" method="get">
						<?php
							$usertipe = $_SESSION['usertipe'];
							//Menu_Administrador_Gerente
							if ($usertipe == 1 or $usertipe == 2) 
							{ 
								?>
								<a name="" id="newUsuario" class="btn rounded-5 btn-info float-right current-bg-primary text-decoration-none pt-2 pb-2" 
									href="usuario_form.php" role="button"><i class="fas fa-plus"></i> Agregar Usuario
								</a>
								<?php
							}
						?>
					</form>

					<!-- FORMULARIO_BUSQUEDA -->
					<form method="POST" name="busqueda" action="usuario_list.php" class="form-inline" autocomplete="off">
						<div class="form-group mx-sm-3 mb-2">
							<input  list="tipo2" class="form-control" name="buscar_tipo" placeholder="Tipo de Usuario" />
							<datalist id="tipo2" class="form-control d-none">
								<option value="1">Administrador</option>
								<option value="2">Gerente</option>
								<option value="3">Asesor Interno</option>
								<option value="4">Asesor Externo</option>
								<option value="5">Propietario</option>
								<option value="6">Cliente</option>
								<option value="7">Proyecto</option>
							</datalist>
						</div>

						<div class="form-group mx-sm-3 mb-2">
							<input  list="estado2" class="form-control" name="buscar_esta" placeholder="Estado" />
							<datalist id="estado2" class="form-control d-none">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</datalist>
						</div>

						<div class="form-group mx-sm-3 mb-2">
							<input type="text" class="form-control" name="buscar_clav" placeholder="Nombre / Cod"/>
						</div>

						<div class="form-group mx-sm-3 mb-2">
							<button class="btn btn-primary">Buscar</button>
						</div>
					</form>

				</div>

				<table class="table table-bordered">
					<thead align=center>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Fotografia</th>
							<th scope="col">Nombre</th>
							<th scope="col">Tipo</th>
							<th scope="col">Estado</th>
						</tr>
					</thead>
					<tbody align=center>
					
					<!-- BUSQUEDA_(NORMAL) -->
					<?php   
					$consulta='';
					$parametros='';

					if ($_POST['buscar_tipo']!='') 	$parametros.="usertipe=".$_POST['buscar_tipo'].'&';
					if ($_POST['buscar_esta']!='') 	$parametros.="userstat=".$_POST['buscar_esta'].'&';
					if ($_POST['buscar_clav']!='') 	$parametros.="
					firstnam LIKE '%".$_POST['buscar_clav']."%' OR 
					lastname LIKE '%".$_POST['buscar_clav']."%' OR 
					id_users LIKE '%".$_POST['buscar_clav']."%' ".'&';
					$porciones=explode('&',$parametros);	//Dividimos los parametros
					$cantidad=count($porciones)-1;			//Contamos la cantidad de parametros
					if ($cantidad > 1)						//Si hay mas de 1 parametro se unen con AND para mysql
					{
						for ($i=0; $i < $cantidad; $i++) 
						{ $consulta.= $porciones[$i].' AND '; }
					} 
					else 
					{
						$consulta.= $porciones[0].' AND ';
					}
					$consulta = substr ($consulta, 0, strlen($consulta) - 4);//Elimina AND del final
					//echo $consulta.'<br><br>';

					if ($cantidad > 0)
					{
						//CONSULTA_USUARIOS_BUSQUEDA
						$query=mysqli_query($con, 
						"SELECT * FROM `si_users` WHERE $consulta ORDER BY `si_users`.`id_users` DESC");
						$count_users=mysqli_num_rows($query);
						$ferow=mysqli_fetch_array($query);
						if ($count_users>0)
						{
							$id_users = $ferow['id_users'];
							$firstnam = $ferow['firstnam'];
							$lastname = $ferow['lastname'];
							$usertipe = $ferow['usertipe'];
							$userstat = $ferow['userstat'];
	
							if ($usertipe == 1) {$usertipe="Administrador";}else
							if ($usertipe == 2) {$usertipe="Gerente";}else
							if ($usertipe == 3) {$usertipe="Vendedor Interno";}else
							if ($usertipe == 4) {$usertipe="Vendedor Externo";}else
							if ($usertipe == 5) {$usertipe="Propietario";}else
							if ($usertipe == 6) {$usertipe="Cliente";}else
							if ($usertipe == 7) {$usertipe="Proyecto";}else
							{$usertipe="Error2";} //NO EXISTE TIPO USUARIO
	
							if ($userstat == 1) {$userstat="Activo";}else
							if ($userstat == 0) {$userstat="Inactivo";}else
							{$userstat="Error3";} //NO EXISTE ESTADO USUARIO
						
							?>
							<tr>
								<th scope="row"> <a id="" class="btn custom-principal-button mt-4" href="usuario_view.php?id=<?php echo $id_users; ?>" role="button"><?php echo $id_users; ?></a> </th>
								<td> <img src="../assets/images/usuarios/<?php echo $id_users; ?>.png" alt="foto" 
										width="75" height="75"> </td>
								<td> <?php echo utf8_encode($firstnam." ".$lastname); ?> </td>
								<td> <?php echo $usertipe; ?> </td>
								<td> <?php echo $userstat; ?> </td>
							</tr>
							<?php	
						}
						for ($i = 1; $i <= $count_users-1 and $i < 50; $i++)
						{
							$ferow=mysqli_fetch_array($query);
							$id_users = $ferow['id_users'];
							$firstnam = $ferow['firstnam'];
							$lastname = $ferow['lastname'];
							$usertipe = $ferow['usertipe'];
							$userstat = $ferow['userstat'];
	
							if ($usertipe == 1) {$usertipe="Administrador";}else
							if ($usertipe == 2) {$usertipe="Gerente";}else
							if ($usertipe == 3) {$usertipe="Vendedor Interno";}else
							if ($usertipe == 4) {$usertipe="Vendedor Externo";}else
							if ($usertipe == 5) {$usertipe="Propietario";}else
							if ($usertipe == 6) {$usertipe="Cliente";}else
							if ($usertipe == 7) {$usertipe="Proyecto";}else
							{$usertipe="Error2";} //NO EXISTE TIPO USUARIO
	
							if ($userstat == 1) {$userstat="Activo";}else
							if ($userstat == 0) {$userstat="Inactivo";}else
							{$userstat="Error3";} //NO EXISTE ESTADO USUARIO
							
							?>
							<tr>
								<th scope="row"> <a id="" class="btn custom-principal-button mt-4" href="usuario_view.php?id=<?php echo $id_users; ?>" role="button"><?php echo $id_users; ?></a> </th>
								<td> <img src="../assets/images/usuarios/<?php echo $id_users; ?>.png" alt="foto" 
										width="75" height="75"> </td>
								<td> <?php echo utf8_encode($firstnam." ".$lastname); ?> </td>
								<td> <?php echo $usertipe; ?> </td>
								<td> <?php echo $userstat; ?> </td>
							</tr>
							<?php
						}
					}
					else
					{
						//CONSULTA_USUARIOS_TODOS
						$query=mysqli_query($con, 
						"SELECT * FROM `si_users` ORDER BY `si_users`.`id_users` DESC");
						$count_users=mysqli_num_rows($query);
						$ferow=mysqli_fetch_array($query);
						if ($count_users>0)
						{	
							$id_users = $ferow['id_users'];
							$firstnam = $ferow['firstnam'];
							$lastname = $ferow['lastname'];
							$usertipe = $ferow['usertipe'];
							$userstat = $ferow['userstat'];

							if ($usertipe == 1) {$usertipe="Administrador";}else
							if ($usertipe == 2) {$usertipe="Gerente";}else
							if ($usertipe == 3) {$usertipe="Vendedor Interno";}else
							if ($usertipe == 4) {$usertipe="Vendedor Externo";}else
							if ($usertipe == 5) {$usertipe="Propietario";}else
							if ($usertipe == 6) {$usertipe="Cliente";}else
							if ($usertipe == 7) {$usertipe="Proyecto";}else
							{$usertipe="Error2";} //NO EXISTE TIPO USUARIO

							if ($userstat == 1) {$userstat="Activo";}else
							if ($userstat == 0) {$userstat="Inactivo";}else
							{$userstat="Error3";} //NO EXISTE ESTADO USUARIO
							
							?>
							<tr>
								<th scope="row"> <a id="" class="btn custom-principal-button mt-4" href="usuario_view.php?id=<?php echo $id_users; ?>" role="button"><?php echo $id_users; ?></a> </th>
								<td> <img src="../assets/images/usuarios/<?php echo $id_users; ?>.png" alt="foto" 
										width="75" height="75"> </td>
								<td> <?php echo utf8_encode($firstnam." ".$lastname); ?> </td>
								<td> <?php echo $usertipe; ?> </td>
								<td> <?php echo $userstat; ?> </td>
							</tr>
							<?php	
						}
						for ($i = 1; $i <= $count_users-1 and $i < 10; $i++)
						{
							$ferow=mysqli_fetch_array($query);
							$id_users = $ferow['id_users'];
							$firstnam = $ferow['firstnam'];
							$lastname = $ferow['lastname'];
							$usertipe = $ferow['usertipe'];
							$userstat = $ferow['userstat'];

							if ($usertipe == 1) {$usertipe="Administrador";}else
							if ($usertipe == 2) {$usertipe="Gerente";}else
							if ($usertipe == 3) {$usertipe="Vendedor Interno";}else
							if ($usertipe == 4) {$usertipe="Vendedor Externo";}else
							if ($usertipe == 5) {$usertipe="Propietario";}else
							if ($usertipe == 6) {$usertipe="Cliente";}else
							if ($usertipe == 7) {$usertipe="Proyecto";}else
							{$usertipe="Error2";} //NO EXISTE TIPO USUARIO

							if ($userstat == 1) {$userstat="Activo";}else
							if ($userstat == 0) {$userstat="Inactivo";}else
							{$userstat="Error3";} //NO EXISTE ESTADO USUARIO
							
							?>
							<tr>
								<th scope="row"> <a id="" class="btn custom-principal-button mt-4" href="usuario_view.php?id=<?php echo $id_users; ?>" role="button"><?php echo $id_users; ?></a> </th>
								<td> <img src="../assets/images/usuarios/<?php echo $id_users; ?>.png" alt="foto" 
										width="75" height="75"> </td>
								<td> <?php echo utf8_encode($firstnam." ".$lastname); ?> </td>
								<td> <?php echo $usertipe; ?> </td>
								<td> <?php echo $userstat; ?> </td>
							</tr>
							<?php
						}
					}
					?>

					</tbody>
				</table>
				</div>
				</div>
			</section>
		</div>
	</div>

	<?php include 'include/footer.php';?>
	<?php /* include 'include/scripts.php';  */ ?>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
		$(document).ready(function() {
			initGeneral();
		});
	</script>

</body>
</html>