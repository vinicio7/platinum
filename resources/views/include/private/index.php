<?php
	/*-------------------------
	DASHBOARD
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
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<?php include 'include/head.php';?>
</head>

<!-- BODY - DASHBOARD -->
<body style="margin: 0!important;">
	<?php include 'include/menu.php';?>
	<div class="contenedor bg-light" id="contenedor">

		<div class="container-fluid bg-primary bg-blue-gradient "> </div>
		<div class="container-fluid p-1 p-md-4 p-xl-5">
			<section class="content p-3 p-md-4 p-xl-5 rounded shadow" id="contentBox">			
				
				<?php
				//ACCESO A ADMINISTRADORES Y GERENTES
				$usertipe = $_SESSION['usertipe'];
				if ($usertipe == 1 or $usertipe == 2 ) 
				{ 

					//--CONSULTA DE PROPIEDADES (VENTA Activas)--   
					$query_pro_venta=mysqli_query($con, 
					"SELECT count(*)as numventa FROM `si_properties` WHERE `in_pre_v` > 0 and in_estat = 0");
					$count_pro_venta=mysqli_num_rows($query_pro_venta);
					$ferow=mysqli_fetch_array($query_pro_venta);
					if ($count_pro_venta > 0)
					{		
						$in_pre_v = intval($ferow['numventa']);  //Inmueble Precio Venta
					}

					//--CONSULTA DE PROPIEDADES (RENTA Activas)--   
					$query_pro_renta=mysqli_query($con, 
					"SELECT count(*)as numrenta FROM `si_properties` WHERE `in_pre_r` > 0 and in_estat = 0");
					$count_pro_renta=mysqli_num_rows($query_pro_renta);
					$ferow=mysqli_fetch_array($query_pro_renta);
					if ($count_pro_renta > 0)
					{		
						$in_pre_r = intval($ferow['numrenta']);  //Inmueble Precio Renta
					}

					//--CONSULTA DE USUARIOS (AGENTES)--   
					$query_user_agente=mysqli_query($con, 
					"SELECT count(*)as numagente FROM `si_users` WHERE `usertipe` = 3 and userstat = 1");
					$count_user_agente=mysqli_num_rows($query_user_agente);
					$ferow=mysqli_fetch_array($query_user_agente);
					if ($count_user_agente > 0)
					{		
						$user_cant = intval($ferow['numagente']);  //Usuario Num Agentes
					}
						
					//--CONSULTA DE PROPIEDADES (VENTA Inactivas)--   
					$query_pro_venta2=mysqli_query($con, 
					"SELECT count(*)as numventa2 FROM `si_properties` WHERE `in_pre_v` > 0 and in_estat = 1");
					$count_pro_venta2=mysqli_num_rows($query_pro_venta2);
					$ferow=mysqli_fetch_array($query_pro_venta2);
					if ($count_pro_venta2 > 0)
					{		
						$in_pre_v2 = intval($ferow['numventa2']);  //Inmueble Precio Venta
					}

					//--CONSULTA DE PROPIEDADES (RENTA Inactivas)--   
					$query_pro_renta2=mysqli_query($con, 
					"SELECT count(*)as numrenta2 FROM `si_properties` WHERE `in_pre_r` > 0 and in_estat = 2");
					$count_pro_renta2=mysqli_num_rows($query_pro_renta2);
					$ferow=mysqli_fetch_array($query_pro_renta2);
					if ($count_pro_renta2 > 0)
					{		
						$in_pre_r2 = intval($ferow['numrenta2']);  //Inmueble Precio Renta
					}
					?>

					<!-- fullCalendar -->
					<link rel="stylesheet" href="../assets/plugins/fullcalendar/main.min.css">
					<link rel="stylesheet" href="../assets/plugins/fullcalendar-daygrid/main.min.css">
					<link rel="stylesheet" href="../assets/plugins/fullcalendar-timegrid/main.min.css">
					<link rel="stylesheet" href="../assets/plugins/fullcalendar-bootstrap/main.min.css">

					<div class="container-fluid">
						<div class="row">

							<div class="col-lg-4 col-6">
								<div class="small-box bg-info">
									<div class="inner pb-0">
										<h3><?php echo utf8_encode($in_pre_v); ?></h3>
										<p>En Venta</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="propiedad_list.php" >
											<button class="btn-primary" name="buscar_esta" value="1">Más info</button>
										</form>
									</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box bg-info">
									<div class="inner pb-0">
										<h3><?php echo utf8_encode($in_pre_r); ?><sup style="font-size: 20px"></sup></h3>
										<p>En Alquiler</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="propiedad_list.php" >
											<button class="btn-primary" name="buscar_esta" value="2">Más info</button>
										</form>
									</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box bg-danger">
									<div class="inner pb-0">
										<h3><?php echo ($user_cant); ?></h3>
										<p>Agentes Inmobiliarios</p>
									</div>
									<div class="icon">
										<i class="fas fa-chalkboard-teacher"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="usuario_list.php" >
											<button class="btn-primary" name="buscar_tipo" value="3">Más info</button>
										</form>
									</a>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 col-sm-6 col-12">
								<div class="info-box bg-info">
									<span class="info-box-icon"><i class="far fa-bookmark"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Vendidas</span>
										<span class="info-box-number"><?php echo ($in_pre_v2); ?></span>

										<div class="progress">
											<div class="progress-bar" style="width: <?php echo ($in_pre_v2*100)/($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2); ?>%"></div>
										</div>
										<span class="progress-description">
										<?php echo number_format(($in_pre_v2*100)/($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2), 2, '.', ','); ?>% del total de Propiedades
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->
							<div class="col-md-4 col-sm-6 col-12">
								<div class="info-box bg-info">
									<span class="info-box-icon"><i class="far fa-bookmark"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Rentadas</span>
										<span class="info-box-number"><?php echo ($in_pre_r2); ?></span>

										<div class="progress">
											<div class="progress-bar" style="width: <?php echo ($in_pre_r2*100)/($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2); ?>%"></div>
										</div>
										<span class="progress-description">
										<?php echo number_format(($in_pre_r2*100)/($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2), 2, '.', ','); ?>% del total de Propiedades
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->
							<div class="col-md-4 col-sm-6 col-12">
								<div class="info-box bg-danger">
									<span class="info-box-icon"><i class="fas fa-chart-line"></i></span>

									<div class="info-box-content">
										<span class="info-box-text">Propiedades</span>
										<span class="info-box-number"><?php echo ($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2); ?></span>

										<div class="progress">
											<div class="progress-bar" style="width: 100%"></div>
										</div>
										<span class="progress-description">
											Total
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->


									
						<?php
						//Administrador_Gerente
						$usertipe = $_SESSION['usertipe'];
						if ($usertipe == 1 OR $usertipe == 2) 
						{ 

						//CONSULTA_PROPIEDADES_TOTALES
						$query1=mysqli_query($con, "SELECT 
						sum(case when in_estat = '0' or in_estat = '1' or in_estat = '2'  then if(`in_pre_v`>0,1,0) else 0 end) 		canti_v,
						sum(case when in_estat = '0' or in_estat = '1' or in_estat = '2'  then if(`in_pre_r`>0,1,0) else 0 end) 		canti_r,
						sum(case when in_estat = '0' or in_estat = '1' or in_estat = '2'  then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	preci_v,
						sum(case when in_estat = '0' or in_estat = '1' or in_estat = '2'  then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	preci_r,

						sum(case when in_tip_p = '1' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	casas_p_v,
						sum(case when in_tip_p = '1' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	casas_p_r,
						sum(case when in_tip_p = '1' then if(`in_pre_v`>0,1,0) else 0 end) 			casas_c_v,
						sum(case when in_tip_p = '1' then if(`in_pre_r`>0,1,0) else 0 end) 			casas_c_r,

						sum(case when in_tip_p = '2' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	apart_p_v,
						sum(case when in_tip_p = '2' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	apart_p_r,
						sum(case when in_tip_p = '2' then if(`in_pre_v`>0,1,0) else 0 end) 			apart_c_v,
						sum(case when in_tip_p = '2' then if(`in_pre_r`>0,1,0) else 0 end) 			apart_c_r,

						sum(case when in_tip_p = '3' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	ofici_p_v,
						sum(case when in_tip_p = '3' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	ofici_p_r,
						sum(case when in_tip_p = '3' then if(`in_pre_v`>0,1,0) else 0 end) 			ofici_c_v,
						sum(case when in_tip_p = '3' then if(`in_pre_r`>0,1,0) else 0 end) 			ofici_c_r,

						sum(case when in_tip_p = '4' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	bodeg_p_v,
						sum(case when in_tip_p = '4' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	bodeg_p_r,
						sum(case when in_tip_p = '4' then if(`in_pre_v`>0,1,0) else 0 end) 			bodeg_c_v,
						sum(case when in_tip_p = '4' then if(`in_pre_r`>0,1,0) else 0 end) 			bodeg_c_r,

						sum(case when in_tip_p = '5' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	terre_p_v,
						sum(case when in_tip_p = '5' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	terre_p_r,
						sum(case when in_tip_p = '5' then if(`in_pre_v`>0,1,0) else 0 end) 			terre_c_v,
						sum(case when in_tip_p = '5' then if(`in_pre_r`>0,1,0) else 0 end) 			terre_c_r,

						sum(case when in_tip_p = '6' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	finca_p_v,
						sum(case when in_tip_p = '6' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	finca_p_r,
						sum(case when in_tip_p = '6' then if(`in_pre_v`>0,1,0) else 0 end) 			finca_c_v,
						sum(case when in_tip_p = '6' then if(`in_pre_r`>0,1,0) else 0 end) 			finca_c_r,

						sum(case when in_tip_p = '7' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	clini_p_v,
						sum(case when in_tip_p = '7' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	clini_p_r,
						sum(case when in_tip_p = '7' then if(`in_pre_v`>0,1,0) else 0 end) 			clini_c_v,
						sum(case when in_tip_p = '7' then if(`in_pre_r`>0,1,0) else 0 end) 			clini_c_r,

						sum(case when in_tip_p = '8' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	casap_p_v,
						sum(case when in_tip_p = '8' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	casap_p_r,
						sum(case when in_tip_p = '8' then if(`in_pre_v`>0,1,0) else 0 end) 			casap_c_v,
						sum(case when in_tip_p = '8' then if(`in_pre_r`>0,1,0) else 0 end) 			casap_c_r,

						sum(case when in_tip_p = '9' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	granj_p_v,
						sum(case when in_tip_p = '9' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	granj_p_r,
						sum(case when in_tip_p = '9' then if(`in_pre_v`>0,1,0) else 0 end) 			granj_c_v,
						sum(case when in_tip_p = '9' then if(`in_pre_r`>0,1,0) else 0 end) 			granj_c_r,

						sum(case when in_tip_p = '10' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	edifi_p_v,
						sum(case when in_tip_p = '10' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	edifi_p_r,
						sum(case when in_tip_p = '10' then if(`in_pre_v`>0,1,0) else 0 end) 		edifi_c_v,
						sum(case when in_tip_p = '10' then if(`in_pre_r`>0,1,0) else 0 end) 		edifi_c_r,

						sum(case when in_tip_p = '11' then if(`in_pre_v`>0,in_pre_v,0) else 0 end) 	local_p_v,
						sum(case when in_tip_p = '11' then if(`in_pre_r`>0,in_pre_r,0) else 0 end) 	local_p_r,
						sum(case when in_tip_p = '11' then if(`in_pre_v`>0,1,0) else 0 end) 		local_c_v,
						sum(case when in_tip_p = '11' then if(`in_pre_r`>0,1,0) else 0 end) 		local_c_r

						FROM `si_properties` ");
						$count1=mysqli_num_rows($query1);
						$ferow=mysqli_fetch_array($query1);
						if ($count1>0)
						{	
							$total_prop1 = $ferow['canti_v'] + $ferow['canti_r'];
							$total_total = $ferow['preci_v'] + $ferow['preci_r'];

							$casas_totalc = $ferow['casas_c_v'] + $ferow['casas_c_r'];
							$casas_totalp = $ferow['casas_p_v'] + $ferow['casas_p_r'];
							
							$apart_totalc = $ferow['apart_c_v'] + $ferow['apart_c_r'];
							$apart_totalp = $ferow['apart_p_v'] + $ferow['apart_p_r'];
							
							$ofici_totalc = $ferow['ofici_c_v'] + $ferow['ofici_c_r'];
							$ofici_totalp = $ferow['ofici_p_v'] + $ferow['ofici_p_r'];

							$bodeg_totalc = $ferow['bodeg_c_v'] + $ferow['bodeg_c_r'];
							$bodeg_totalp = $ferow['bodeg_p_v'] + $ferow['bodeg_p_r'];

							$terre_totalc = $ferow['terre_c_v'] + $ferow['terre_c_r'];
							$terre_totalp = $ferow['terre_p_v'] + $ferow['terre_p_r'];

							$finca_totalc = $ferow['finca_c_v'] + $ferow['finca_c_r'];
							$finca_totalp = $ferow['finca_p_v'] + $ferow['finca_p_r'];

							$clini_totalc = $ferow['clini_c_v'] + $ferow['clini_c_r'];
							$clini_totalp = $ferow['clini_p_v'] + $ferow['clini_p_r'];

							$casap_totalc = $ferow['casap_c_v'] + $ferow['casap_c_r'];
							$casap_totalp = $ferow['casap_p_v'] + $ferow['casap_p_r'];

							$granj_totalc = $ferow['granj_c_v'] + $ferow['granj_c_r'];
							$granj_totalp = $ferow['granj_p_v'] + $ferow['granj_p_r'];

							$edifi_totalc = $ferow['edifi_c_v'] + $ferow['edifi_c_r'];
							$edifi_totalp = $ferow['edifi_p_v'] + $ferow['edifi_p_r'];

							$local_totalc = $ferow['local_c_v'] + $ferow['local_c_r'];
							$local_totalp = $ferow['local_p_v'] + $ferow['local_p_r'];
						}
						

						//CONSULTA_PROPIEDADES_ACTIVAS
						$query=mysqli_query($con, "SELECT 
						sum(case when in_tip_p = '1'  then if(`in_pre_v`>0,1,0) else 0 end) 			casas_cant_v,
						sum(case when in_tip_p = '1'  then if(`in_pre_r`>0,1,0) else 0 end) 			casas_cant_r,
						sum(case when in_tip_p = '1'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	casas_prec_v,
						sum(case when in_tip_p = '1'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	casas_prec_r,
						
						sum(case when in_tip_p = '2'  then if(`in_pre_v`>0,1,0) else 0 end) 			apart_cant_v,
						sum(case when in_tip_p = '2'  then if(`in_pre_r`>0,1,0) else 0 end) 			apart_cant_r,
						sum(case when in_tip_p = '2'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	apart_prec_v,
						sum(case when in_tip_p = '2'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	apart_prec_r,
						
						sum(case when in_tip_p = '3'  then if(`in_pre_v`>0,1,0) else 0 end) 			ofici_cant_v,
						sum(case when in_tip_p = '3'  then if(`in_pre_r`>0,1,0) else 0 end) 			ofici_cant_r,
						sum(case when in_tip_p = '3'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	ofici_prec_v,
						sum(case when in_tip_p = '3'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	ofici_prec_r,
						
						sum(case when in_tip_p = '4'  then if(`in_pre_v`>0,1,0) else 0 end) 			bodeg_cant_v,
						sum(case when in_tip_p = '4'  then if(`in_pre_r`>0,1,0) else 0 end) 			bodeg_cant_r,
						sum(case when in_tip_p = '4'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	bodeg_prec_v,
						sum(case when in_tip_p = '4'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	bodeg_prec_r,
						
						sum(case when in_tip_p = '5'  then if(`in_pre_v`>0,1,0) else 0 end) 			terre_cant_v,
						sum(case when in_tip_p = '5'  then if(`in_pre_r`>0,1,0) else 0 end) 			terre_cant_r,
						sum(case when in_tip_p = '5'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	terre_prec_v,
						sum(case when in_tip_p = '5'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	terre_prec_r,
						
						sum(case when in_tip_p = '6'  then if(`in_pre_v`>0,1,0) else 0 end) 			finca_cant_v,
						sum(case when in_tip_p = '6'  then if(`in_pre_r`>0,1,0) else 0 end) 			finca_cant_r,
						sum(case when in_tip_p = '6'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	finca_prec_v,
						sum(case when in_tip_p = '6'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	finca_prec_r,
						
						sum(case when in_tip_p = '7'  then if(`in_pre_v`>0,1,0) else 0 end) 			clini_cant_v,
						sum(case when in_tip_p = '7'  then if(`in_pre_r`>0,1,0) else 0 end) 			clini_cant_r,
						sum(case when in_tip_p = '7'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	clini_prec_v,
						sum(case when in_tip_p = '7'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	clini_prec_r,
						
						sum(case when in_tip_p = '8'  then if(`in_pre_v`>0,1,0) else 0 end) 			casap_cant_v,
						sum(case when in_tip_p = '8'  then if(`in_pre_r`>0,1,0) else 0 end) 			casap_cant_r,
						sum(case when in_tip_p = '8'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	casap_prec_v,
						sum(case when in_tip_p = '8'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	casap_prec_r,
						
						sum(case when in_tip_p = '9'  then if(`in_pre_v`>0,1,0) else 0 end) 			granj_cant_v,
						sum(case when in_tip_p = '9'  then if(`in_pre_r`>0,1,0) else 0 end) 			granj_cant_r,
						sum(case when in_tip_p = '9'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	granj_prec_v,
						sum(case when in_tip_p = '9'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	granj_prec_r,
						
						sum(case when in_tip_p = '10'  then if(`in_pre_v`>0,1,0) else 0 end) 			edifi_cant_v,
						sum(case when in_tip_p = '10'  then if(`in_pre_r`>0,1,0) else 0 end) 			edifi_cant_r,
						sum(case when in_tip_p = '10'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	edifi_prec_v,
						sum(case when in_tip_p = '10'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	edifi_prec_r,
						
						sum(case when in_tip_p = '11'  then if(`in_pre_v`>0,1,0) else 0 end) 			local_cant_v,
						sum(case when in_tip_p = '11'  then if(`in_pre_r`>0,1,0) else 0 end) 			local_cant_r,
						sum(case when in_tip_p = '11'  then if(`in_pre_v`>0,`in_pre_v`,0) else 0 end) 	local_prec_v,
						sum(case when in_tip_p = '11'  then if(`in_pre_r`>0,`in_pre_r`,0) else 0 end) 	local_prec_r
						
						FROM `si_properties` WHERE `in_estat` = 0");
						$count=mysqli_num_rows($query);
						$ferow=mysqli_fetch_array($query);
						if ($count>0)
						{	
							$casas_cant_v = $ferow['casas_cant_v'];
							$casas_cant_r = $ferow['casas_cant_r'];
							$casas_prec_v = $ferow['casas_prec_v']; 
							$casas_prec_r = $ferow['casas_prec_r']; 

							$apart_cant_v = $ferow['apart_cant_v'];
							$apart_cant_r = $ferow['apart_cant_r'];
							$apart_prec_v = $ferow['apart_prec_v']; 
							$apart_prec_r = $ferow['apart_prec_r']; 

							$ofici_cant_v = $ferow['ofici_cant_v'];
							$ofici_cant_r = $ferow['ofici_cant_r'];
							$ofici_prec_v = $ferow['ofici_prec_v']; 
							$ofici_prec_r = $ferow['ofici_prec_r']; 

							$bodeg_cant_v = $ferow['bodeg_cant_v'];
							$bodeg_cant_r = $ferow['bodeg_cant_r'];
							$bodeg_prec_v = $ferow['bodeg_prec_v']; 
							$bodeg_prec_r = $ferow['bodeg_prec_r']; 

							$terre_cant_v = $ferow['terre_cant_v'];
							$terre_cant_r = $ferow['terre_cant_r'];
							$terre_prec_v = $ferow['terre_prec_v']; 
							$terre_prec_r = $ferow['terre_prec_r']; 

							$finca_cant_v = $ferow['finca_cant_v'];
							$finca_cant_r = $ferow['finca_cant_r'];
							$finca_prec_v = $ferow['finca_prec_v']; 
							$finca_prec_r = $ferow['finca_prec_r']; 

							$clini_cant_v = $ferow['clini_cant_v'];
							$clini_cant_r = $ferow['clini_cant_r'];
							$clini_prec_v = $ferow['clini_prec_v']; 
							$clini_prec_r = $ferow['clini_prec_r']; 

							$casap_cant_v = $ferow['casap_cant_v'];
							$casap_cant_r = $ferow['casap_cant_r'];
							$casap_prec_v = $ferow['casap_prec_v']; 
							$casap_prec_r = $ferow['casap_prec_r']; 

							$granj_cant_v = $ferow['granj_cant_v'];
							$granj_cant_r = $ferow['granj_cant_r'];
							$granj_prec_v = $ferow['granj_prec_v']; 
							$granj_prec_r = $ferow['granj_prec_r']; 

							$edifi_cant_v = $ferow['edifi_cant_v'];
							$edifi_cant_r = $ferow['edifi_cant_r'];
							$edifi_prec_v = $ferow['edifi_prec_v']; 
							$edifi_prec_r = $ferow['edifi_prec_r']; 

							$local_cant_v = $ferow['local_cant_v'];
							$local_cant_r = $ferow['local_cant_r'];
							$local_prec_v = $ferow['local_prec_v']; 
							$local_prec_r = $ferow['local_prec_r']; 

							$total_cant_v = $casas_cant_v + $apart_cant_v + $ofici_cant_v + $bodeg_cant_v + $terre_cant_v + $finca_cant_v + $clini_cant_v + $casap_cant_v + $granj_cant_v + $edifi_cant_v + $local_cant_v; 
							$total_cant_r = $casas_cant_r + $apart_cant_r + $ofici_cant_r + $bodeg_cant_r + $terre_cant_r + $finca_cant_r + $clini_cant_r + $casap_cant_r + $granj_cant_r + $edifi_cant_r + $local_cant_r; 
							$total_prec_v = $casas_prec_v + $apart_prec_v + $ofici_prec_v + $bodeg_prec_v + $terre_prec_v + $finca_prec_v + $clini_prec_v + $casap_prec_v + $granj_prec_v + $edifi_prec_v + $local_prec_v;
							$total_prec_r = $casas_prec_r + $apart_prec_r + $ofici_prec_r + $bodeg_prec_r + $terre_prec_r + $finca_prec_r + $clini_prec_r + $casap_prec_r + $granj_prec_r + $edifi_prec_r + $local_prec_r;
							$total_prop2  = $total_cant_v + $total_cant_r;
						}
						?>

						<div class="row">
							<table class="table table-bordered">
								<thead align=center>
									<tr>
										<th colspan="3" bgcolor="lightblue"><?php echo $total_prop1; ?> - Total Propiedades</th>
										<th scope="col">&nbsp;</th>
										<th colspan="4" bgcolor="lightblue"><?php echo $total_prop2; ?> - Propiedades Activas</th>
									</tr>
									<tr>
										<th scope="col" bgcolor="lightgray">Tipo de Inmueble</th>
										<th scope="col" bgcolor="lightgray">Propiedades</th>
										<th scope="col" bgcolor="lightgray">Totales</th>
										<th scope="col">&nbsp;</th>
										<th colspan="2" bgcolor="lightgray">Venta</th>
										<th colspan="2" bgcolor="lightgray">Renta</th>
									</tr>
								</thead>

								<tbody align=center>
								<tr>
									<td>Casas</td>
									<td><?php echo $casas_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($casas_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $casas_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($casas_prec_v).".oo"; ?></td>
									<td><?php echo $casas_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($casas_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Apartamentos</td>
									<td><?php echo $apart_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($apart_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $apart_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($apart_prec_v).".oo"; ?></td>
									<td><?php echo $apart_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($apart_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Oficinas</td>
									<td><?php echo $ofici_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($ofici_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $ofici_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($ofici_prec_v).".oo"; ?></td>
									<td><?php echo $ofici_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($ofici_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Bodegas</td>
									<td><?php echo $bodeg_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($bodeg_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $bodeg_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($bodeg_prec_v).".oo"; ?></td>
									<td><?php echo $bodeg_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($bodeg_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Terrenos</td>
									<td><?php echo $terre_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($terre_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $terre_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($terre_prec_v).".oo"; ?></td>
									<td><?php echo $terre_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($terre_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Fincas</td>
									<td><?php echo $finca_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($finca_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $finca_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($finca_prec_v).".oo"; ?></td>
									<td><?php echo $finca_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($finca_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Clinicas</td>
									<td><?php echo $clini_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($clini_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $clini_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($clini_prec_v).".oo"; ?></td>
									<td><?php echo $clini_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($clini_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Casas de Playa</td>
									<td><?php echo $casap_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($casap_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $casap_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($casap_prec_v).".oo"; ?></td>
									<td><?php echo $casap_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($casap_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Granjas</td>
									<td><?php echo $granj_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($granj_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $granj_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($granj_prec_v).".oo"; ?></td>
									<td><?php echo $granj_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($granj_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Edificios</td>
									<td><?php echo $edifi_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($edifi_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $edifi_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($edifi_prec_v).".oo"; ?></td>
									<td><?php echo $edifi_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($edifi_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td>Locales</td>
									<td><?php echo $local_totalc; ?></td>
									<td align="right"><?php echo "$ ".number_format($local_totalp).".oo"; ?></td>
									<td>&nbsp;</td>
									<td><?php echo $local_cant_v; ?></td>
									<td align="right"><?php echo "$ ".number_format($local_prec_v).".oo"; ?></td>
									<td><?php echo $local_cant_r; ?></td>
									<td align="right"><?php echo "$ ".number_format($local_prec_r).".oo"; ?></td>
								</tr>
								<tr>
									<td bgcolor="lightgray">TOTALES</td>
									<td bgcolor="lightpink"> <?php echo $total_prop1; ?> </td>
									<td bgcolor="lightpink" align="right"> <?php echo "$ ".number_format($total_total).".oo"; ?> </td>
									<td> </td>
									<td bgcolor="lightpink"> <?php echo $total_cant_v; ?> </td>
									<td bgcolor="lightpink" align="right"> <?php echo "$ ".number_format($total_prec_v).".oo"; ?> </td>
									<td bgcolor="lightpink"> <?php echo $total_cant_r; ?> </td>
									<td bgcolor="lightpink" align="right"> <?php echo "$ ".number_format($total_prec_r).".oo"; ?> </td>
								</tr>
								</tbody>
							</table>
						</div>

						<!-- CHART 
						<div class="row">
							<section class="col-md-6 connectedSortable">
								<div class="card card-primary">
									<div class="card-header ui-sortable-handle">
										<h3 class="card-title">Captaciones Mensuales</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
													class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove"><i
													class="fas fa-times"></i></button>
										</div>
									</div>
									<div class="card-body" style="display: block;">
										<div class="chart">
											<div class="chartjs-size-monitor">
												<div class="chartjs-size-monitor-expand">
													<div class=""></div>
												</div>
												<div class="chartjs-size-monitor-shrink">
													<div class=""></div>
												</div>
											</div>
											<canvas id="areaChart"
												style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
												width="487" height="250" class="chartjs-render-monitor"></canvas>
										</div>
									</div>
								</div>

							</section>
							<section class="col-md-6 connectedSortable">
								<div class="card card-success">
									<div class="card-header ui-sortable-handle">
										<h3 class="card-title">Propiedades por Zona</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
													class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove"><i
													class="fas fa-times"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart">
											<div class="chartjs-size-monitor">
												<div class="chartjs-size-monitor-expand">
													<div class=""></div>
												</div>
												<div class="chartjs-size-monitor-shrink">
													<div class=""></div>
												</div>
											</div>
											<canvas id="barChart"
												style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
												width="487" height="250" class="chartjs-render-monitor"></canvas>
										</div>
									</div>
								</div>

							</section>
						</div>
						<div class="row d-none">
							<div class="col-md-6 connectedSortable">

								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Captaciones Mensuales</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
													class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove"><i
													class="fas fa-times"></i></button>
										</div>
									</div>
									<div class="card-body" style="display: block;">
										<div class="chart">
											<div class="chartjs-size-monitor">
												<div class="chartjs-size-monitor-expand">
													<div class=""></div>
												</div>
												<div class="chartjs-size-monitor-shrink">
													<div class=""></div>
												</div>
											</div>
											<canvas id="areaChart"
												style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
												width="487" height="250" class="chartjs-render-monitor"></canvas>
										</div>
									</div>
								</div>
					

							</div>
							<div class="col-md-6 connectedSortable">

								<div class="card card-success">
									<div class="card-header">
										<h3 class="card-title">Propiedades por Zona</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
													class="fas fa-minus"></i>
											</button>
											<button type="button" class="btn btn-tool" data-card-widget="remove"><i
													class="fas fa-times"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="chart">
											<div class="chartjs-size-monitor">
												<div class="chartjs-size-monitor-expand">
													<div class=""></div>
												</div>
												<div class="chartjs-size-monitor-shrink">
													<div class=""></div>
												</div>
											</div>
											<canvas id="barChart"
												style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;"
												width="487" height="250" class="chartjs-render-monitor"></canvas>
										</div>
									</div>
								</div>



							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="sticky-top mb-3">
									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Eventos</h4>
										</div>
										<div class="card-body">

											<div id="external-events">
												<div class="external-event bg-success ui-draggable ui-draggable-handle"
													style="position: relative; z-index: auto; left: 0px; top: 0px;">Almuerzo</div>
												<div class="external-event bg-warning ui-draggable ui-draggable-handle"
													style="position: relative;">Ir a Casa</div>
												<div class="external-event bg-info ui-draggable ui-draggable-handle"
													style="position: relative;">Hacer Tareas</div>
												<div class="external-event bg-primary ui-draggable ui-draggable-handle"
													style="position: relative;">Trabajar en UI Design</div>
												<div class="external-event bg-danger ui-draggable ui-draggable-handle"
													style="position: relative;">Dormir temprano</div>
												<div class="checkbox">
													<label for="drop-remove">
														<input type="checkbox" id="drop-remove">
														Remover después de arrastrar
													</label>
												</div>
											</div>
										</div>

									</div>

									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Crear Evento</h3>
										</div>
										<div class="card-body">
											<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
												<ul class="fc-color-picker" id="color-chooser">
													<li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
													<li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
												</ul>
											</div>

											<div class="input-group">
												<input id="new-event" type="text" class="form-control" placeholder="Título del Evento">

												<div class="input-group-append">
													<button id="add-new-event" type="button" class="btn btn-primary">Añadir</button>
												</div>

											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-md-9">
								<div class="card card-primary">
									<div class="card-body p-0">

										<div id="calendar" class="fc fc-ltr fc-bootstrap" style="">

										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="row">
							<section class="col-lg-12 connectedSortable">

								<div class="card" style="position: relative; left: 0px; top: 0px;">
									<div class="card-header ui-sortable-handle" style="cursor: move;">
										<h3 class="card-title">
											<i class="ion ion-clipboard mr-1"></i>
											Modificaciones Pendientes
										</h3>

										<div class="card-tools">
											<ul class="pagination pagination-sm">
												<li class="page-item"><a href="#" class="page-link">«</a></li>
												<li class="page-item"><a href="#" class="page-link">1</a></li>
												<li class="page-item"><a href="#" class="page-link">2</a></li>
												<li class="page-item"><a href="#" class="page-link">3</a></li>
												<li class="page-item"><a href="#" class="page-link">»</a></li>
											</ul>
										</div>
									</div>

									<div class="card-body">
										<ul class="todo-list" data-widget="todo-list">
											<li>

												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>

												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo1" id="todoCheck1">
													<label for="todoCheck1"></label>
												</div>

												<span class="text">Cambiar telefono de propiedad ID 4457</span>

												<small class="badge badge-danger"><i class="far fa-clock"></i> 2
													mins</small>

												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
													<label for="todoCheck2"></label>
												</div>
												<span class="text">Llamar a los dueños de propiedad ID 523 el 23 de marzo
													9am</span>
												<small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo3" id="todoCheck3">
													<label for="todoCheck3"></label>
												</div>
												<span class="text">Quitar de propiedad vendida, con ID 568</span>
												<small class="badge badge-warning"><i class="far fa-clock"></i> 1
													day</small>
												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo4" id="todoCheck4">
													<label for="todoCheck4"></label>
												</div>
												<span class="text">Publicar la propiedad ID 452</span>
												<small class="badge badge-success"><i class="far fa-clock"></i> 3
													days</small>
												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo5" id="todoCheck5">
													<label for="todoCheck5"></label>
												</div>
												<span class="text">Revisar los mensajes del propiedario ID 41</span>
												<small class="badge badge-primary"><i class="far fa-clock"></i> 1
													week</small>
												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
											<li>
												<span class="handle">
													<i class="fas fa-ellipsis-v"></i>
													<i class="fas fa-ellipsis-v"></i>
												</span>
												<div class="icheck-primary d-inline ml-2">
													<input type="checkbox" value="" name="todo6" id="todoCheck6">
													<label for="todoCheck6"></label>
												</div>
												<span class="text">Cambiar fotografias de propiedad ID 745</span>
												<small class="badge badge-secondary"><i class="far fa-clock"></i> 1
													month</small>
												<div class="tools">
													<i class="fas fa-edit"></i>
													<i class="fas fa-trash-o"></i>
												</div>
											</li>
										</ul>
									</div>

									<div class="card-footer clearfix">
										<button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i>
											Sugerir Modificación</button>
									</div>
								</div>

							</div>
						-->

						<?php
					} 
				}

				//ACCESO A AGENTES INTERNOS
				$usertipe = $_SESSION['usertipe'];
				if ($usertipe == 3) 
				{ 
					?>
					<div class="container-fluid">
						<h3> Accesos Directos </h3>
						<div class="row">

							<div class="col-lg-4 col-6">
								<div class="small-box bg-info">
									<div class="inner pb-0">
										<p>En Venta</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="propiedad_list.php" >
											<button class="btn-primary" name="buscar_esta" value="1">Más info</button>
										</form>
									</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box bg-info">
									<div class="inner pb-0">
										<p>En Alquiler</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="propiedad_list.php" >
											<button class="btn-primary" name="buscar_esta" value="2">Más info</button>
										</form>
									</a>
								</div>
							</div>

							<div class="col-lg-4 col-6">
								<div class="small-box bg-danger">
									<div class="inner pb-0">
										<p>Agentes Inmobiliarios</p>
									</div>
									<div class="icon">
										<i class="fas fa-chalkboard-teacher"></i>
									</div>
									<a  class="small-box-footer">
										<form method="POST" name="busqueda" action="usuario_list.php" >
											<button class="btn-primary" name="buscar_tipo" value="3">Más info</button>
										</form>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php
				}

				//ACCESO A Clientes y Propietarios
				$usertipe = $_SESSION['usertipe'];
				if ($usertipe == 5 or $usertipe == 6) 
				{ 
					//--CONSULTA DE PROPIEDADES (FAVORITAS)--    
					$query = mysqli_query($con,"
					SELECT count(*) as p_favoritos FROM `si_properties`,`si_favoritos` WHERE  
					`si_properties`.`in_mu_id` = `si_favoritos`.`fa_pr_id` and 
					`si_favoritos`.`fa_us_id`  = '".$id_users."'            ");
					$count_prop = mysqli_num_rows($query);
					$ferow = mysqli_fetch_array($query);
					if ($count_prop > 0) { $cant_prop = $ferow['p_favoritos']; }

					?>
						<div class="info-box-content">
							<span class="info-box-text">Propiedades (favoritos) - <?php echo intval(($cant_prop * 100) / ($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2)); ?>%</span>
							<span class="info-box-number"></span>

							<div class="progress">
								<div class="progress-bar" style="width: <?php echo ($cant_prop * 100) / ($in_pre_v + $in_pre_r + $in_pre_v2 + $in_pre_r2); ?>%"></div>
							</div>
						</div>
					<?php
				}	
				?>
				
			</section>
		</div>





				</section>
			</div>
			<?php include 'include/footer.php';?>
		</div>
		
		<?php /* include 'include/scripts.php'; */ ?>
		
		<!-- jQuery 3.5.1 -->
		<script src="../assets/js/jquery-3.5.1.min.js"></script>
		<script src="../assets/js/jquery.alphanum.js"></script>
		<!-- App Dashboard -->
		<script src="../assets/js/app_dashboard.js"></script> 
		
		<script>
		$(document).ready(function() 
		{
			
		});

		
		</script>

	</body>
</html>