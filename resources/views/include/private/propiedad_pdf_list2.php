<?php
/*-------------------------
PROPERTY LIST
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php'; ?>
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php'; ?>
	<div class="contenedor bg-light" id="contenedor">
		<div class="container-fluid bg-primary bg-blue-gradient "></div>
		<div class="container-fluid p-5">
			<section class="content p-5 rounded shadow" id="contentBox">

				<!-- BODY -->
				<div class="container-fluid">
				<h3>Lista de Propiedades para PDF</h3>

				<?php
				//CAPTURA DATOS PDF-INSERT
				if (!empty($_GET['id'])) 
				{
					$id_pdf_1 = $_GET['id'];
					$in_fe_in = utf8_decode(date('Y-m-d'));

					//INSERTA EN LA BASE DE DATOS
					mysqli_query($con,"INSERT INTO `si_favoritos`(
					`fa_pr_id`, 
					`fa_us_id`, 
					`fa_fecha`)
					VALUES(
					'$id_pdf_1',
					'$id_users',	
					'$in_fe_in'
					)");
				} 

				//CAPTURA DATOS PDF-DELETE
				if (!empty($_POST['pdf_eliminar'])) 
				{
					$id_pdf_2 = $_POST['pdf_eliminar'];

					//ELIMINA DE LA BASE DE DATOS
					mysqli_query($con,"DELETE FROM `si_favoritos` WHERE `si_favoritos`.`favor_id` = '$id_pdf_2'");
				} 

				//--CONSULTA DE PROPIEDADES (PDF)--    
				$query = mysqli_query( $con, 
				"SELECT * 
				FROM `si_properties`, `si_favoritos` 
				WHERE `si_favoritos`.`fa_us_id`= '" . $id_users . "' AND `si_properties`.`in_mu_id` = `si_favoritos`.`fa_pr_id` 
				ORDER BY `si_properties`.`in_mu_id` DESC" );
				$count_prop = mysqli_num_rows($query);
				$ferow = mysqli_fetch_array($query);
				if ($count_prop > 0) 
				{
					$in_mu_id = $ferow['in_mu_id'];
					$favor_id = $ferow['favor_id'];
					$in_titul = utf8_encode($ferow['in_titul']);
					$in_pre_v = $ferow['in_pre_v'];
					$in_pre_r = $ferow['in_pre_r'];
					$in_direc = utf8_encode($ferow['in_di_di']);
					$in_vende = $ferow['in_vende'];
					$in_de_ot = $ferow['in_de_ot'];
					$in_estat = $ferow['in_estat'];

					if ($in_estat == 0) 
					{
						$in_estat = "Activa";
					} 
					else if ($in_estat == 1) 
					{
						$in_estat = "Vendida";
					}
					else 
					{
						$in_estat = "Rentada";
					} 
					?>

					<!-- BOTONES_FORM -->
					<form action="#" method="POST">
						<div class="card-footer clearfix">
							<a name="" 
								class="btn rounded-5 btn-info float-right  text-decoration-none pt-2 pb-2"
								href="propiedad_pdf_view.php" role="button"><i class="fas fa-plus"></i> Generar PDF
							</a> 
						</div>
					</form>

					<!-- TABLA DE PROPIEDADES -->
					<table class="table table-bordered">
						<thead align=center>
							<tr>
								<th scope="col">Código</th>
								<th scope="col">Fotografia</th>
								<th scope="col">Titulo</th>
								<th scope="col">Precio</th>
								<th scope="col">Direccion</th>
								<th scope="col">Vendedor</th>
								<th scope="col">Estado</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody align=center>

						<tr>
							<th scope="row"> <a id="viewPropiedad" class="btn custom-principal-button mt-4" href="propiedad_view.php?id=<?php echo $in_mu_id;?>" role="button"><?php echo $in_mu_id; ?></a> </th>
							<td> <img src="../assets/images/propiedades/<?php echo $in_mu_id; ?>/1.jpg" alt="foto" width="125" height="100"> </td>
							<td> <?php echo $in_titul; ?> </td>
							<td> <?php echo utf8_encode("Venta $" . $in_pre_v . " Renta $" . $in_pre_r); ?> </td>
							<td> <?php echo $in_direc; ?> </td>

							<?php
							//CONSULTA CORREDOR 
							$query2 = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "' ORDER BY `id_users` DESC");
							$count_core = mysqli_num_rows($query2);
							$ferow = mysqli_fetch_array($query2);
							if ($count_core > 0) 
							{ 
								$in_vende = $ferow['id_users'] . " - " . $ferow['firstnam'] . " " . $ferow['lastname']; ?>
								<td> <?php echo utf8_encode($in_vende); ?> </td> <?php
							} 
							else 
							{
								?> 
								<td> <?php echo $in_vende . " - No hay datos"; ?> </td> 
								<?php
							}
							?>
							<td> <?php echo $in_estat; ?> </td>
							<td> 
								<form method="POST" name="pdf" action="propiedad_pdf_list.php" >
									<button class="btn-danger" name="pdf_eliminar" value="<?php echo $favor_id;?>">Eliminar</button>
								</form>
							</td>
						</tr>
						<?php
				}
					for ($i = 1; $i <= $count_prop - 1 and $i < 10; $i++) 
					{
						//Repetir
						$ferow = mysqli_fetch_array($query);

						$in_mu_id = $ferow['in_mu_id'];
						$favor_id = $ferow['favor_id'];
						$in_titul = utf8_encode($ferow['in_titul']);
						$in_pre_v = $ferow['in_pre_v'];
						$in_pre_r = $ferow['in_pre_r'];
						$in_direc = utf8_encode($ferow['in_di_di']);
						$in_vende = $ferow['in_vende'];
						$in_de_ot = $ferow['in_de_ot'];
						$in_estat = $ferow['in_estat'];

						if ($in_estat == 0) 
						{
							$in_estat = "Activa";
						} 
						else if ($in_estat == 1) 
						{
							$in_estat = "Vendida";
						}
						else 
						{
							$in_estat = "Rentada";
						} 
						?>
						<tr>
							<th scope="row"> <a id="viewPropiedad" class="btn custom-principal-button mt-4" href="propiedad_view.php?id=<?php echo $in_mu_id;?>" role="button"><?php echo $in_mu_id; ?></a> </th>
							<td> <img src="../assets/images/propiedades/<?php echo $in_mu_id; ?>/1.jpg" alt="foto" width="125" height="100"> </td>
							<td> <?php echo $in_titul; ?> </td>
							<td> <?php echo utf8_encode("Venta $" . $in_pre_v . " Renta $" . $in_pre_r); ?> </td>
							<td> <?php echo $in_direc; ?> </td>

							<?php
							//CONSULTA CORREDOR 
							$query2 = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "' ORDER BY `id_users` DESC");
							$count_core = mysqli_num_rows($query2);
							$ferow = mysqli_fetch_array($query2);
							if ($count_core > 0) 
							{ 
								$in_vende = $ferow['id_users'] . " - " . $ferow['firstnam'] . " " . $ferow['lastname']; ?>
								<td> <?php echo utf8_encode($in_vende); ?> </td> <?php
							} 
							else 
							{
								?> 
								<td> <?php echo $in_vende . " - No hay datos"; ?> </td> 
								<?php
							}
							?>
							<td> <?php echo $in_estat; ?> </td>
							<td> 
								<form method="POST" name="pdf" action="propiedad_pdf_list.php" >
									<button class="btn-danger" name="pdf_eliminar" value="<?php echo $favor_id;?>">Eliminar</button>
								</form>
							</td>
						</tr>
						<?php
					}
					?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>

	<?php include 'include/footer.php'; ?>
	<?php include 'include/scripts.php';  ?>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
	$(document).ready(function() 
	{
		initGeneral();
	});
	</script>

</body>
</html>