<?php
	/*-------------------------
	PROPERTY PDF View
	Autor: Gustavo Blanco
	Web: chofo7.blogspot.com
	Mail: chofo7@gmail.com
	---------------------------*/

	// Notificar 0 errores  - HORARIO GUATEMALA
	error_reporting(0);
	date_default_timezone_set('America/Guatemala');

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
?>

<?php
	//--CONSULTA DE PROPIEDADES (Favoritas)--   
	$query=mysqli_query($con, 
	"SELECT * FROM `si_properties`, `si_favoritos` 
	WHERE `si_favoritos`.`fa_us_id`= '" . $id_users . "' AND `si_properties`.`in_mu_id` = `si_favoritos`.`fa_pr_id` 
	ORDER BY `si_properties`.`in_mu_id` DESC");
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);
	if ($count_prop > 0) 
	{	
		$in_mu_id = $ferow['in_mu_id'];  				//ID
		$in_titul = utf8_encode($ferow['in_titul']);  	//Titulo
		$in_porce = $ferow['in_porce'];
		$in_pre_r = $ferow['in_pre_r'];
		$in_pre_v = $ferow['in_pre_v'];
		$in_nombr = $ferow['in_nombr'];
		$in_tip_p = $ferow['in_tip_p'];
		$in_vende = $ferow['in_vende'];
		$in_ab_a1 = $ferow['in_ab_a1'];
		$in_ab_a2 = $ferow['in_ab_a2'];
		$in_ab_at = $ferow['in_ab_at'];
		$in_ab_ba = $ferow['in_ab_ba'];
		$in_ab_de = utf8_encode($ferow['in_ab_de']);  //Arbitrios Descripcion
		$in_ab_fi = $ferow['in_ab_fi'];
		$in_ab_fo = $ferow['in_ab_fo'];
		$in_ab_g1 = $ferow['in_ab_g1'];
		$in_ab_g2 = $ferow['in_ab_g2'];
		$in_ab_iu = $ferow['in_ab_iu'];
		$in_ab_li = $ferow['in_ab_li'];
		$in_ab_ni = utf8_encode($ferow['in_ab_ni']);  //TEXTO
		$in_ab_re = $ferow['in_ab_re'];
		$in_ab_tc = $ferow['in_ab_tc'];
		$in_ab_s1 = utf8_encode($ferow['in_ab_s1']);  //TEXTO
		$in_ab_s2 = $ferow['in_ab_s2'];
		$in_ac_co = utf8_encode($ferow['in_ac_co']);  //TEXTO
		$in_ac_pi = utf8_encode($ferow['in_ac_pi']);  //TEXTO
		$in_ac_pu = utf8_encode($ferow['in_ac_pu']);  //TEXTO
		$in_ac_te = utf8_encode($ferow['in_ac_te']);  //TEXTO
		$in_ac_ve = utf8_encode($ferow['in_ac_ve']);  //TEXTO
		$in_ad_co = $ferow['in_ad_co'];
		$in_ad_em = $ferow['in_ad_em'];
		$in_ad_ex = $ferow['in_ad_ex'];
		$in_ad_po = $ferow['in_ad_po'];
		$in_ad_pu = $ferow['in_ad_pu'];
		$in_am_am = $ferow['in_am_am'];
		$in_am_as = $ferow['in_am_as'];
		$in_am_bc = $ferow['in_am_bc'];
		$in_am_ca = $ferow['in_am_ca'];
		$in_am_ga = $ferow['in_am_ga'];
		$in_am_gi = $ferow['in_am_gi'];
		$in_am_gu = $ferow['in_am_gu'];
		$in_am_ju = $ferow['in_am_ju'];
		$in_am_ot = utf8_encode($ferow['in_am_ot']);  //Amenidades Otros
		$in_am_pa = $ferow['in_am_pa'];
		$in_am_pi = $ferow['in_am_pi'];
		$in_am_pt = $ferow['in_am_pt'];
		$in_am_rr = $ferow['in_am_rr'];
		$in_am_sa = $ferow['in_am_sa'];
		$in_am_sb = $ferow['in_am_sb'];
		$in_am_sp = $ferow['in_am_sp'];
		$in_am_sr = $ferow['in_am_sr'];
		$in_ar_ii = $ferow['in_ar_ii'];
		$in_ar_it = $ferow['in_ar_it'];
		$in_co_an = $ferow['in_co_an'];
		$in_co_ba = $ferow['in_co_ba'];
		$in_co_bs = $ferow['in_co_bs'];
		$in_co_d1 = $ferow['in_co_d1'];
		$in_co_d2 = $ferow['in_co_d2'];
		$in_co_j1 = $ferow['in_co_j1'];
		$in_co_j2 = $ferow['in_co_j2'];
		$in_co_mt = $ferow['in_co_mt'];
		$in_co_ni = $ferow['in_co_ni'];
		$in_co_p1 = $ferow['in_co_p1'];
		$in_co_p2 = $ferow['in_co_p2'];
		$in_co_te = $ferow['in_co_te'];
		$in_de_ac = $ferow['in_de_ac'];
		$in_de_b2 = $ferow['in_de_b2'];
		$in_de_ba = $ferow['in_de_ba'];
		$in_de_bi = $ferow['in_de_bi'];
		$in_de_bj = $ferow['in_de_bj'];
		$in_de_bo = $ferow['in_de_bo'];
		$in_de_bv = $ferow['in_de_bv'];
		$in_de_cb = $ferow['in_de_cb'];
		$in_de_cc = $ferow['in_de_cc'];
		$in_de_ch = $ferow['in_de_ch'];
		$in_de_cl = $ferow['in_de_cl'];
		$in_de_co = $ferow['in_de_co'];
		$in_de_cr = $ferow['in_de_cr'];
		$in_de_de = $ferow['in_de_de'];
		$in_de_ds = $ferow['in_de_ds'];
		$in_de_du = $ferow['in_de_du'];
		$in_de_dv = $ferow['in_de_dv'];
		$in_de_es = $ferow['in_de_es'];
		$in_de_j1 = $ferow['in_de_j1'];
		$in_de_j2 = $ferow['in_de_j2'];
		$in_de_ja = $ferow['in_de_ja'];
		$in_de_je = $ferow['in_de_je'];
		$in_de_la = $ferow['in_de_la'];
		$in_de_oa = utf8_encode($ferow['in_de_oa']);  //Detalles Acabados
		$in_de_ot = utf8_encode($ferow['in_de_ot']);  //Detalles Otros
		$in_de_pa = $ferow['in_de_pa'];
		$in_de_pe = $ferow['in_de_pe'];
		$in_de_po = $ferow['in_de_po'];
		$in_de_s1 = $ferow['in_de_s1'];
		$in_de_s2 = $ferow['in_de_s2'];
		$in_de_s3 = $ferow['in_de_s3'];
		$in_de_sa = $ferow['in_de_sa'];
		$in_de_te = $ferow['in_de_te'];
		$in_de_ti = $ferow['in_de_ti'];
		$in_de_wa = $ferow['in_de_wa'];
		$in_di_de = $ferow['in_di_de'];
		$in_di_di = utf8_encode($ferow['in_di_di']);  //Dirección Detalles
		$in_di_mu = $ferow['in_di_mu'];
		$in_di_pa = $ferow['in_di_pa'];
		$in_di_re = $ferow['in_di_re'];
		$in_di_zo = $ferow['in_di_zo'];
		$in_e1_ce = $ferow['in_e1_ce'];
		$in_e1_no = utf8_encode($ferow['in_e1_no']);  //Encargado 1 Nombre
		$in_e1_t1 = $ferow['in_e1_t1'];
		$in_e1_t2 = $ferow['in_e1_t2'];
		$in_e2_ce = $ferow['in_e2_ce'];
		$in_e2_no = utf8_encode($ferow['in_e2_no']);  //TEXTO
		$in_e2_t1 = $ferow['in_e2_t1'];
		$in_e2_t2 = $ferow['in_e2_t2'];
		$in_fi_cn = $ferow['in_fi_cn'];
		$in_fi_cp = $ferow['in_fi_cp'];
		$in_fi_en = $ferow['in_fi_en'];
		$in_fi_es = $ferow['in_fi_es'];
		$in_fi_pl = $ferow['in_fi_pl'];
		$in_fi_sn = $ferow['in_fi_sn'];
		$in_fi_ta = $ferow['in_fi_ta'];
		$in_in_aa = $ferow['in_in_aa'];
		$in_in_al = $ferow['in_in_al'];
		$in_in_bl = $ferow['in_in_bl'];
		$in_in_bm = $ferow['in_in_bm'];
		$in_in_ca = $ferow['in_in_ca'];
		$in_in_cb = $ferow['in_in_cb'];
		$in_in_cm = $ferow['in_in_cm'];
		$in_in_cs = $ferow['in_in_cs'];
		$in_in_ct = $ferow['in_in_ct'];
		$in_in_db = $ferow['in_in_db'];
		$in_in_eb = $ferow['in_in_eb'];
		$in_in_ee = $ferow['in_in_ee'];
		$in_in_et = $ferow['in_in_et'];
		$in_in_io = utf8_encode($ferow['in_in_io']);  //TEXTO
		$in_in_ld = $ferow['in_in_ld'];
		$in_in_lm = $ferow['in_in_lm'];
		$in_in_lv = $ferow['in_in_lv'];
		$in_in_ps = $ferow['in_in_ps'];
		$in_in_re = $ferow['in_in_re'];
		$in_in_sd = $ferow['in_in_sd'];
		$in_ma_cu = $ferow['in_ma_cu'];
		$in_ma_in = $ferow['in_ma_in'];
		$in_mante = $ferow['in_mante'];
		$in_por_r = $ferow['in_por_r'];
		$in_se_ag = $ferow['in_se_ag'];
		$in_se_ba = $ferow['in_se_ba'];
		$in_se_li = $ferow['in_se_li'];
		$in_se_lu = $ferow['in_se_lu'];
		$in_se_se = $ferow['in_se_se'];
		$in_ab_yo = utf8_encode($ferow['in_ab_yo']);  //TEXTO
		$in_estat = $ferow['in_estat'];
		$in_us_po = $ferow['in_us_po'];
		$in_fe_in = $ferow['in_fe_in'];
		$in_am_of = utf8_encode($ferow['in_am_of']);  //TEXTO
		$in_am_bo = utf8_encode($ferow['in_am_bo']);  //TEXTO
		$in_am_lo = utf8_encode($ferow['in_am_lo']);  //TEXTO

		if ($in_estat == 0) {$in_estat="Activa";}else
		if ($in_estat == 1) {$in_estat="Vendida";}else
		{$in_estat="Alquilada";} 

		if ($in_tip_p == 1)  {$in_tip_p="Casa";}else
		if ($in_tip_p == 2)  {$in_tip_p="Apartamento";}else
		if ($in_tip_p == 3)  {$in_tip_p="Oficina";}else
		if ($in_tip_p == 4)  {$in_tip_p="Bodega";}else
		if ($in_tip_p == 5)  {$in_tip_p="Terreno";}else
		if ($in_tip_p == 6)  {$in_tip_p="Finca";}else
		if ($in_tip_p == 7)  {$in_tip_p="Clinica";}else
		if ($in_tip_p == 8)  {$in_tip_p="Casa de playa";}else
		if ($in_tip_p == 9)  {$in_tip_p="Granja";}else
		if ($in_tip_p == 10) {$in_tip_p="Edificio";}else
		if ($in_tip_p == 11) {$in_tip_p="Local";}else
		{$in_tip_p = "-";}

		if ($in_pre_v > 0 and $in_pre_v > 0)  {$in_preci = "$".number_format($in_pre_v, 2, '.', ',')." / $".number_format($in_pre_r, 2, '.', ',');} else {	
		if ($in_pre_v > 0)  {$in_preci = "$".number_format($in_pre_v, 2, '.', ',');} else {
		if ($in_pre_r > 0)  {$in_preci = "$".number_format($in_pre_r, 2, '.', ',');} else {$in_preci = "$0.00 / $0.00";} }}

		if ($in_pre_v > 0 and $in_pre_v > 0)  {$in_prevr = "Venta / Renta";} else {	
		if ($in_pre_v > 0)  {$in_prevr = "Venta";} else {
		if ($in_pre_r > 0)  {$in_prevr = "Renta";} else {$in_prevr = "Venta / Renta";} }}

		//-------------------------------------------------------------------------------------------
		//CONSULTA PARA AGENTE_INTERNO
		$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "'");
		$data_user = mysqli_num_rows($query_user);
		$ferow = mysqli_fetch_array($query_user);
		if ($data_user > 0) 
		{
			$aseso_id = $ferow['id_users'];  //Usuario Datos ID
			$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
			$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
			$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
			$aseso_fi = $ferow['datadded'];  //Usuario Fecha de Ingreso
			$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
			$aseso_es = $ferow['userstat'];  //Usuario Esado 
			$aseso_te = $ferow['phonenum'];  //Usuario Telefono
			$aseso_cu = $ferow['userdate'];  //Usuario Cumpleaños
			$aseso_di = utf8_encode($ferow['useraddr']);  //Usuario Dirección
			$aseso_ge = $ferow['usergend'];  //Usuario Genero
			$aseso_dp = $ferow['userndpi'];  //Usuario DPI
			$aseso_ec = $ferow['usermatr'];  //Usuario Estado Civil
			$aseso_pr = $ferow['userprof'];  //Usuario Profesión
			//REDES SOCIALES
			$aseso_fb = $ferow['userface'];  //Usuario Facebook
			$aseso_tw = $ferow['usertwit'];  //Usuario Twitter
			$aseso_wa = $ferow['userwhat'];  //Usuario Whatsapp
			$aseso_in = $ferow['userinst'];  //Usuario Instagram
			$aseso_li = $ferow['userlink'];  //Usuario LinkedIn
			$aseso_yo = $ferow['useryout'];  //Usuario Youtube
			$aseso_pi = $ferow['userpint'];  //Usuario Pinterest

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
			if ($aseso_pr == 19) {$aseso_pr = "Broker Owner";} 	else
			{$aseso_pr = " - ";}
		}


		//-------------------------------------------------------------------------------------------
		//CONSULTA PARA AGENTE
		$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_ad_co . "'");
		$data_user = mysqli_num_rows($query_user);
		$ferow = mysqli_fetch_array($query_user);
		if ($data_user > 0) {
			$ase_e_id = $ferow['id_users'];  //Usuario Datos ID
			$ase_e_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
			$ase_e_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
			$ase_e_es = $ferow['userstat'];  //Usuario Esado 
		}

		//-------------------------------------------------------------------------------------------
		//CONSULTA DEPARTAMENTOS
		$query_dep = mysqli_query($con,"SELECT * FROM `si_departments` WHERE `de_pa_id`= '" . $in_di_de . "'");
		$data  = mysqli_num_rows($query_dep);
		$ferow = mysqli_fetch_array($query_dep);
		if ($data > 0) {
			$de_pa_id = $ferow['de_pa_id'];  //Datos ID
			$de_nombr = utf8_encode($ferow['de_nombr']);  //Nombre
		}

		//-------------------------------------------------------------------------------------------
		//CONSULTA MUNICIPIOS
		$query_mun = mysqli_query($con,"SELECT * FROM `si_municips` WHERE `mu_ni_id`= '" . $in_di_mu . "'");
		$data  = mysqli_num_rows($query_mun);
		$ferow = mysqli_fetch_array($query_mun);
		if ($data > 0) {
			$mu_ni_id = $ferow['mu_ni_id'];  //Datos ID
			$mu_nombr = utf8_encode($ferow['mu_nombr']);  //Nombre
		}

		//vuelve a cargar datos de tipo de usuario
		$usertipe = $_SESSION['usertipe'];
	}
?>

<head>
	<?php include 'include/head.php'; ?>
	<link rel="stylesheet" href="../assets/css/styles_sheets.css">
</head>

<body>
	<?php $count_p = 1; ?>

	<?php 
	for ($i = 1; $i <= ($count_prop*2); $i=$i+2)
	{
		if($i==1)
		{
			$page_script1=$page_script1.
			"pdf.addHTML($('#page".$i."'), 0, 0, options, function ()" ."<br>".
			"{" ."<br>".

			"pdf.addPage();" ."<br>".
			"pdf.addHTML($('#page".($i+1)."'), 0, 0, options, function ()" ."<br>".
			"{"."<br>" ;
		}
		else
		{
			$page_script1=$page_script1.
			"pdf.addPage();" ."<br>".
			"pdf.addHTML($('#page".$i."'), 0, 0, options, function ()" ."<br>".
			"{" ."<br>".

			"pdf.addPage();" ."<br>".
			"pdf.addHTML($('#page".($i+1)."'), 0, 0, options, function ()" ."<br>".
			"{"."<br>" ;
		}
	}
	$page_script1=$page_script1."pdf.save('listado_propiedades.pdf');"."<br>" ;
	for ($i = 1; $i <= ($count_prop*2); $i=$i+2)
	{
		$page_script1=$page_script1.
		"});"."<br>".
		"});"."<br>" ;
	}
	//echo $page_script1;
	?>

		<div class="pdf-container-page-1" id="page<?php echo $count_p; ?>">
			<div class="header-container">
				<div class="logo-container">
					<img src="../assets/images/pdf/logo_lg_blanco.svg" alt="Logo Propiedades Platinum">
				</div>
			</div>
			<div class="titles-container">
				<div class="titles-content">
					<div class="title">
						<h1><?php echo str_replace("\n", "<br>", $in_titul); ?></h1>
					</div>
					<div class="subtitle">
						<h3><strong>PROPIEDAD COD. <?php echo($in_mu_id); ?></strong> - SOLO INTERESADOS DIRECTOS -</h3>
					</div>
				</div>
				<div class="pleca-container">
					<img src="../assets/images/pdf/pleca_gray_blue.png" alt="" srcset="">
				</div>
			</div>
			<div class="principal-pictures-properties-container">
				<div class="picture-lg-content bg-elements picture-1-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/1.jpg) !important;">
				</div>
				<div class="picture-md-content bg-elements picture-2-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/2.jpg) !important;">
				</div>
				<div class="picture-md-content bg-elements picture-3-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/3.jpg) !important;">
				</div>
			</div>
			<div class="property-details">
				<div class="content-details">
					<div class="descriptions">
						<h3>DESCRIPCIÓN</h3>
							<!-- Descripción -->
							<?php if ($in_ab_de == true) { ?>
								<p><?php echo ($in_ab_de); ?></p>
							<?php } ?>

							<!-- Varas, Frente y Fondo -->
							<?php if ($in_co_te > 0 || $in_co_j1 > 0) { ?>
								<p>
									<?php if ($in_co_te > 0) { 
											echo ($in_co_te." Vrs<sup>2</sup> de terreno");
										}
										if ($in_co_te > 0 && $in_co_j1 > 0) {
											echo (", ");
										}
										?>									
									<?php if ($in_co_j1 > 0) { 
										echo ($in_co_j1." x ".$in_co_j2." de fondo (aprox)");
										}
									?>
								</p>
							<?php } ?>
						<!-- <p>973 Mts de terreno 21 x 48 de fondo (aprox) </p> -->

						<!-- Metros de Construcción -->
						<?php if ($in_co_mt > 0) { ?>
							<p><?php echo ($in_co_mt." "); ?>Mts<sup>2</sup> de construcción</p>
						<?php } ?>
						<!-- <p>650 Mts2 de construcción</p> -->

						<!-- Años o Año de Construcción -->
						<?php if ($in_co_an > 0) { ?>
							<?php 
								if ($in_co_an > 1099) {
									$current_year = date("Y");
									$building_years = ($current_year - $in_co_an); ?> 
										<p><?php echo ($building_years." "); ?> años de construida, en perfecto estado</p>
									<?php 
								} else if ($in_co_an > 0 && $in_co_an < 2) {
									$a = (2020 - $in_co_an);
									$current_year = date("Y");
									$building_years = ($current_year - $a); ?>
										<p><?php echo ($building_years." "); ?> año de construida, en perfecto estado</p>
									<?php 
								} else if ($in_co_an > 0 && $in_co_an < 100) {
									$a = (2020 - $in_co_an);
									$current_year = date("Y");
									$building_years = ($current_year - $a); ?>
										<p><?php echo ($building_years." "); ?> años de construida, en perfecto estado</p>
									<?php 
								} else { ?> 
										<p><?php echo ($in_co_an); ?> años de construida (aprox), en perfecto estado</p>
									<?php
								}
								
							?>
							<!-- <p>28 años de construida, en perfecto estado  reformada</p> -->
						<?php } ?>

						<!-- Niveles -->
						<?php if ($in_co_ni > 0) { ?>
							<?php if ($in_co_ni == 1) { ?>
								<p><?php echo ($in_co_ni); ?> nivel</p>
							<?php } else { ?>
								<p><?php echo ($in_co_ni); ?> niveles</p>
						<?php }} ?>

						<!-- Dormitorio de Servicio -->
						<?php if ($in_co_d2 > 0) { ?>
							<?php if ($in_co_d2 == 1) { ?>
								<p><?php echo ($in_co_d2); ?> dormitorio de servicio</p>
							<?php } else { ?>
								<p><?php echo ($in_co_d2); ?> dormitorios de servicio</p>
								<!-- <p>2 dormitorios de servicio con su baño</p> -->
						<?php }} ?>

						<!-- Área de Lavandería y Patio -->
						<?php if ($in_de_la > 0 && $in_de_pa > 0) { ?>
								<p>Área de lavandería y patio</p>
							<?php } else if ($in_de_la > 0 && $in_de_pa == 0) { ?>
								<p>Área de lavandería</p>
							<?php } else if ($in_de_la == 0 && $in_de_pa > 0) { ?>
								<p>Área de Patio</p>
						<?php } ?>

						<!-- Chimenea -->
						<?php if ($in_de_ch > 0) { ?>
							<p>Sala con chimenea</p>
						<?php } ?>

						<!-- Comedor -->
						<?php if ($in_de_co > 0) { ?>
							<p>Comedor independiente</p>
						<?php } ?>

						<!-- Dormitorios y Baños -->
						<?php if ($in_co_d1 == 1 && $in_co_ba > 1) { ?>
							<p><?php echo ($in_co_d1) ?> dormitorio amplio con baño completo</p>
						<?php } else if ($in_co_d1 > 1 && $in_co_ba > 1) { ?>
							<p><?php echo ($in_co_d1) ?> dormitorios amplios con baño completo</p> 
						<?php } ?>

						<!-- Walking Closet -->
						<?php if ($in_co_d1 > 0) { ?>
							<p>Walk-In Closet</p>
						<?php } ?>
						
						<!-- Parqueos Techados  -->
						<?php if ($in_co_p1 == 1) { ?>
							<p><?php echo ($in_co_p1) ?> Parqueo techado</p>
						<?php } elseif ($in_co_p1 > 1) { ?>
							<p><?php echo ($in_co_p1) ?> Parqueos techados</p>
						<?php } ?>
						
						<!-- Jardínes -->
						<?php if ($in_de_j1 == 1 && $in_de_j2 == 1 ) { ?>
							<p>2 jardines</p>
						<?php } else if ($in_de_j1 == 1 || $in_de_j2 == 1 ) { ?>
							<p>1 jardin</p>
						<?php } ?>					

						<!-- Pérgola -->
						<?php if ($in_de_pe == 1 ) { ?>
							<p>Pérgola amplia</p>
						<?php } ?>	
						
						<!-- Bodega -->
						<?php if ($in_am_bo == 1) { ?>
							<p>1 bodega grande</p>
						<?php } else if ($in_am_bo > 0 ) { ?>
							<p><?php echo ($in_am_bo) ?> bodegas grandes</p>
						<?php } else if ($in_de_bo == 1 ) { ?>
							<p>1 bodega</p>
						<?php } ?>

						<!-- Cocina con Isla -->
						<?php if ($in_de_cb == 1 ) { ?>
							<p>Cocina con isla</p>
						<?php } ?>

						<!-- Lavandería y Linea Blanca -->					
						<?php if ($in_de_la == 1 && ($in_in_re == 1 || $in_in_et == 1 || $in_in_ee == 1 || $in_in_ld == 1 || $in_in_sd == 1)) { ?>
							<p>Lavandería y Línea Blanca</p>
						<?php } else if ($in_de_la == 1 ) { ?>
							<p>Lavandería</p>
						<?php } ?>

					</div>
					<div class="details">
						<?php if ($in_ma_cu > 0 ) { ?>
							<h3>CUOTA DE MANTENIMIENTO</h3>
							<p>Q. <?php echo ($in_ma_cu ) ?>/mes  (incluye: 
								<?php
									// Agua
									if ($in_se_ag == 1 ) { 
										echo ("agua");
										if ($in_se_se == 1 || $in_se_li == 1 || $in_se_lu == 1 || $in_se_ba == 1) {
											echo (", ");
										}
									}
									// Luz
									if ($in_se_lu == 1 ) { 
										echo ("luz");
										if ($in_se_se == 1 || $in_se_li == 1 || $in_se_ba == 1) {
											echo (", ");
										}
									}
									// Extracción de Basura
									if ($in_se_ba == 1 ) { 
										echo ("extracción de basura");
										if ($in_se_se == 1 || $in_se_li == 1 ) {
											echo (", ");
										}
									}
									// Seguridad
									if ($in_se_se == 1 ) { 
										echo ("seguridad");
										if ($in_se_li == 1 ) {
											echo (", ");
										}
									}
									// Limpieza de Áreas Comunes
									if ($in_se_li == 1 ) { 
										echo ("mantenimiento de áreas comunes");
									}
								?>
							</p>					
							<div class="line-space"></div>
						<?php } ?>

						<?php if ($in_in_ct == 1 || $in_in_bm == 1 || $in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1 ) { ?>
							<h3>INCLUYE</h3>
							
							<p>
							<?php 
								// Calentador de Agua
								if ($in_in_ct == 1 ) { 
									echo ("calentador de agua");
									if ($in_in_bm == 1 || $in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Bomba y Cisterna
								if ($in_in_bm == 1 ) { 
									echo ("bomba y cisterna");
									if ($in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Alarma
								if ($in_in_al == 1 ) { 
									echo ("alarma");
									if ($in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Espejos de Baño
								if ($in_in_eb == 1 ) { 
									echo ("espejos de baño");
									if ($in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Cortinas
								if ($in_in_cs == 1 ) { 
									echo ("cortinas");
									if ($in_in_aa == 1) {
										echo (", ");
									}
								}
								// Aire Acondicionado
								if ($in_in_aa == 1 ) { 
									echo ("aire acondicionado");
								}
							?>
							<!-- calentador de agua, cisterna y bomba, alarmas, conexiones internas para alarma con su planta telefónica, espejos en baños,  cortinas, 1 aire acondicionado</p> -->
							<div class="line-space"></div>
						<?php } ?>

						<?php if ($in_am_ca == 1 || $in_am_as == 1 || $in_am_ju == 1 ) { ?>
							<h3>AMENIDADES</h3>
							<p>
							<?php
								// Cancha deportiva
								if ($in_am_ca == 1 ) { 
									echo ("cancha deportiva");
									if ($in_am_as == 1 || $in_am_ju == 1 ) {
										echo (", ");
									}
								}
								// Área Social
								if ($in_am_as == 1 ) { 
									echo ("salón social");
									if ($in_am_ju == 1 ) {
										echo (", ");
									}
								}
								// Juegos Infantiles
								if ($in_am_ju == 1 ) { 
									echo ("área de juegos para niños");								
								}
							?>
							<!-- canchas deportivas, salón social, área de juego para niños.</p> -->
						<?php } ?>					
					</div>
					
				</div>
			</div>
			<div class="footer">
				<div class="price-container">
					<div class="price-content">
						<h4>US$ 
						<?php if ($in_pre_r > 0 ) { 
							echo ($in_pre_r);
						} elseif ($in_pre_v > 0) {
							echo ($in_pre_v);
						} ?>
						</h4>
						<h5>+ imp</h5>
					</div>
				</div>
				<div class="info-contact-container">
					<div class="agent-info-content">
						<h4><?php echo($aseso_pr.": ".$aseso_fn." ".$aseso_ln); ?></h4>
						<h5><strong>Info/cel:</strong> +502 <?php echo($aseso_te); ?></h5>
						<h6><strong>Correo:</strong> <?php echo($aseso_co); ?></h6>
					</div>
				</div>
			</div>
		</div> <?php $count_p = $count_p +1; ?>
		<div class="pdf-container-page-2" id="page<?php echo $count_p; ?>">
			<div class="header-container">
				<div class="logo-container">
					<img src="../assets/images/pdf/logo_lg_blanco.svg" alt="Logo Propiedades Platinum">
				</div>
			</div>
			<div class="titles-container">
				<div class="titles-content">
					<div class="title">
						<h1><?php echo str_replace("\n", "<br>", $in_titul); ?></h1>
					</div>
					<div class="subtitle">
						<h3><strong>PROPIEDAD COD. <?php echo($in_mu_id); ?></strong> - SOLO INTERESADOS DIRECTOS -</h3>
					</div>
				</div>
				<div class="pleca-container">
					<img src="../assets/images/pdf/pleca_gray_blue.png" alt="" srcset="">
				</div>
			</div>
			<div class="principal-pictures-properties-container">
				<div class="picture-md-content-left bg-elements picture-4" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/4.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-5" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/5.jpg) !important;">
				</div>
				<div class="picture-md-content-left bg-elements picture-6" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/6.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-7" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/7.jpg) !important;">
				</div>
				<div class="picture-md-content-left bg-elements picture-8" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/8.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-9" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/9.jpg) !important;">
				</div>
			</div>
			
			<div class="footer">
				<div class="price-container">
					<div class="price-content">
						<h4><?php echo($aseso_pr.": ".$aseso_fn." ".$aseso_ln); ?></h4>
					</div>
				</div>
				<div class="info-contact-container">
					<div class="agent-info-content">					
						<h5><strong>Info/cel:</strong> +502 <?php echo($aseso_te); ?></h5>
						<h6><strong>Correo:</strong> <?php echo($aseso_co); ?></h6>
					</div>
				</div>
			</div>
		</div> <?php $count_p = $count_p +1; ?>

	<?php
		for ($i = 1; $i <= ($count_prop-1) and $i < 5; $i++) 
		{
			$ferow = mysqli_fetch_array($query);

			$in_mu_id = $ferow['in_mu_id'];  				//ID
			$in_titul = utf8_encode($ferow['in_titul']); 	//Titulo
			$in_porce = $ferow['in_porce'];
			$in_pre_r = $ferow['in_pre_r'];
			$in_pre_v = $ferow['in_pre_v'];
			$in_nombr = $ferow['in_nombr'];
			$in_tip_p = $ferow['in_tip_p'];
			$in_vende = $ferow['in_vende'];
			$in_ab_a1 = $ferow['in_ab_a1'];
			$in_ab_a2 = $ferow['in_ab_a2'];
			$in_ab_at = $ferow['in_ab_at'];
			$in_ab_ba = $ferow['in_ab_ba'];
			$in_ab_de = utf8_encode($ferow['in_ab_de']);  //Arbitrios Descripcion
			$in_ab_fi = $ferow['in_ab_fi'];
			$in_ab_fo = $ferow['in_ab_fo'];
			$in_ab_g1 = $ferow['in_ab_g1'];
			$in_ab_g2 = $ferow['in_ab_g2'];
			$in_ab_iu = $ferow['in_ab_iu'];
			$in_ab_li = $ferow['in_ab_li'];
			$in_ab_ni = utf8_encode($ferow['in_ab_ni']);  //TEXTO
			$in_ab_re = $ferow['in_ab_re'];
			$in_ab_tc = $ferow['in_ab_tc'];
			$in_ab_s1 = utf8_encode($ferow['in_ab_s1']);  //TEXTO
			$in_ab_s2 = $ferow['in_ab_s2'];
			$in_ac_co = utf8_encode($ferow['in_ac_co']);  //TEXTO
			$in_ac_pi = utf8_encode($ferow['in_ac_pi']);  //TEXTO
			$in_ac_pu = utf8_encode($ferow['in_ac_pu']);  //TEXTO
			$in_ac_te = utf8_encode($ferow['in_ac_te']);  //TEXTO
			$in_ac_ve = utf8_encode($ferow['in_ac_ve']);  //TEXTO
			$in_ad_co = $ferow['in_ad_co'];
			$in_ad_em = $ferow['in_ad_em'];
			$in_ad_ex = $ferow['in_ad_ex'];
			$in_ad_po = $ferow['in_ad_po'];
			$in_ad_pu = $ferow['in_ad_pu'];
			$in_am_am = $ferow['in_am_am'];
			$in_am_as = $ferow['in_am_as'];
			$in_am_bc = $ferow['in_am_bc'];
			$in_am_ca = $ferow['in_am_ca'];
			$in_am_ga = $ferow['in_am_ga'];
			$in_am_gi = $ferow['in_am_gi'];
			$in_am_gu = $ferow['in_am_gu'];
			$in_am_ju = $ferow['in_am_ju'];
			$in_am_ot = utf8_encode($ferow['in_am_ot']);  //Amenidades Otros
			$in_am_pa = $ferow['in_am_pa'];
			$in_am_pi = $ferow['in_am_pi'];
			$in_am_pt = $ferow['in_am_pt'];
			$in_am_rr = $ferow['in_am_rr'];
			$in_am_sa = $ferow['in_am_sa'];
			$in_am_sb = $ferow['in_am_sb'];
			$in_am_sp = $ferow['in_am_sp'];
			$in_am_sr = $ferow['in_am_sr'];
			$in_ar_ii = $ferow['in_ar_ii'];
			$in_ar_it = $ferow['in_ar_it'];
			$in_co_an = $ferow['in_co_an'];
			$in_co_ba = $ferow['in_co_ba'];
			$in_co_bs = $ferow['in_co_bs'];
			$in_co_d1 = $ferow['in_co_d1'];
			$in_co_d2 = $ferow['in_co_d2'];
			$in_co_j1 = $ferow['in_co_j1'];
			$in_co_j2 = $ferow['in_co_j2'];
			$in_co_mt = $ferow['in_co_mt'];
			$in_co_ni = $ferow['in_co_ni'];
			$in_co_p1 = $ferow['in_co_p1'];
			$in_co_p2 = $ferow['in_co_p2'];
			$in_co_te = $ferow['in_co_te'];
			$in_de_ac = $ferow['in_de_ac'];
			$in_de_b2 = $ferow['in_de_b2'];
			$in_de_ba = $ferow['in_de_ba'];
			$in_de_bi = $ferow['in_de_bi'];
			$in_de_bj = $ferow['in_de_bj'];
			$in_de_bo = $ferow['in_de_bo'];
			$in_de_bv = $ferow['in_de_bv'];
			$in_de_cb = $ferow['in_de_cb'];
			$in_de_cc = $ferow['in_de_cc'];
			$in_de_ch = $ferow['in_de_ch'];
			$in_de_cl = $ferow['in_de_cl'];
			$in_de_co = $ferow['in_de_co'];
			$in_de_cr = $ferow['in_de_cr'];
			$in_de_de = $ferow['in_de_de'];
			$in_de_ds = $ferow['in_de_ds'];
			$in_de_du = $ferow['in_de_du'];
			$in_de_dv = $ferow['in_de_dv'];
			$in_de_es = $ferow['in_de_es'];
			$in_de_j1 = $ferow['in_de_j1'];
			$in_de_j2 = $ferow['in_de_j2'];
			$in_de_ja = $ferow['in_de_ja'];
			$in_de_je = $ferow['in_de_je'];
			$in_de_la = $ferow['in_de_la'];
			$in_de_oa = utf8_encode($ferow['in_de_oa']);  //Detalles Acabados
			$in_de_ot = utf8_encode($ferow['in_de_ot']);  //Detalles Otros
			$in_de_pa = $ferow['in_de_pa'];
			$in_de_pe = $ferow['in_de_pe'];
			$in_de_po = $ferow['in_de_po'];
			$in_de_s1 = $ferow['in_de_s1'];
			$in_de_s2 = $ferow['in_de_s2'];
			$in_de_s3 = $ferow['in_de_s3'];
			$in_de_sa = $ferow['in_de_sa'];
			$in_de_te = $ferow['in_de_te'];
			$in_de_ti = $ferow['in_de_ti'];
			$in_de_wa = $ferow['in_de_wa'];
			$in_di_de = $ferow['in_di_de'];
			$in_di_di = utf8_encode($ferow['in_di_di']);  //Dirección Detalles
			$in_di_mu = $ferow['in_di_mu'];
			$in_di_pa = $ferow['in_di_pa'];
			$in_di_re = $ferow['in_di_re'];
			$in_di_zo = $ferow['in_di_zo'];
			$in_e1_ce = $ferow['in_e1_ce'];
			$in_e1_no = utf8_encode($ferow['in_e1_no']);  //Encargado 1 Nombre
			$in_e1_t1 = $ferow['in_e1_t1'];
			$in_e1_t2 = $ferow['in_e1_t2'];
			$in_e2_ce = $ferow['in_e2_ce'];
			$in_e2_no = utf8_encode($ferow['in_e2_no']);  //TEXTO
			$in_e2_t1 = $ferow['in_e2_t1'];
			$in_e2_t2 = $ferow['in_e2_t2'];
			$in_fi_cn = $ferow['in_fi_cn'];
			$in_fi_cp = $ferow['in_fi_cp'];
			$in_fi_en = $ferow['in_fi_en'];
			$in_fi_es = $ferow['in_fi_es'];
			$in_fi_pl = $ferow['in_fi_pl'];
			$in_fi_sn = $ferow['in_fi_sn'];
			$in_fi_ta = $ferow['in_fi_ta'];
			$in_in_aa = $ferow['in_in_aa'];
			$in_in_al = $ferow['in_in_al'];
			$in_in_bl = $ferow['in_in_bl'];
			$in_in_bm = $ferow['in_in_bm'];
			$in_in_ca = $ferow['in_in_ca'];
			$in_in_cb = $ferow['in_in_cb'];
			$in_in_cm = $ferow['in_in_cm'];
			$in_in_cs = $ferow['in_in_cs'];
			$in_in_ct = $ferow['in_in_ct'];
			$in_in_db = $ferow['in_in_db'];
			$in_in_eb = $ferow['in_in_eb'];
			$in_in_ee = $ferow['in_in_ee'];
			$in_in_et = $ferow['in_in_et'];
			$in_in_io = utf8_encode($ferow['in_in_io']);  //TEXTO
			$in_in_ld = $ferow['in_in_ld'];
			$in_in_lm = $ferow['in_in_lm'];
			$in_in_lv = $ferow['in_in_lv'];
			$in_in_ps = $ferow['in_in_ps'];
			$in_in_re = $ferow['in_in_re'];
			$in_in_sd = $ferow['in_in_sd'];
			$in_ma_cu = $ferow['in_ma_cu'];
			$in_ma_in = $ferow['in_ma_in'];
			$in_mante = $ferow['in_mante'];
			$in_por_r = $ferow['in_por_r'];
			$in_se_ag = $ferow['in_se_ag'];
			$in_se_ba = $ferow['in_se_ba'];
			$in_se_li = $ferow['in_se_li'];
			$in_se_lu = $ferow['in_se_lu'];
			$in_se_se = $ferow['in_se_se'];
			$in_ab_yo = utf8_encode($ferow['in_ab_yo']);  //TEXTO
			$in_estat = $ferow['in_estat'];
			$in_us_po = $ferow['in_us_po'];
			$in_fe_in = $ferow['in_fe_in'];
			$in_am_of = utf8_encode($ferow['in_am_of']);  //TEXTO
			$in_am_bo = utf8_encode($ferow['in_am_bo']);  //TEXTO
			$in_am_lo = utf8_encode($ferow['in_am_lo']);  //TEXTO

			if ($in_estat == 0) {$in_estat="Activa";}else
			if ($in_estat == 1) {$in_estat="Vendida";}else
			{$in_estat="Alquilada";} 

			if ($in_tip_p == 1)  {$in_tip_p="Casa";}else
			if ($in_tip_p == 2)  {$in_tip_p="Apartamento";}else
			if ($in_tip_p == 3)  {$in_tip_p="Oficina";}else
			if ($in_tip_p == 4)  {$in_tip_p="Bodega";}else
			if ($in_tip_p == 5)  {$in_tip_p="Terreno";}else
			if ($in_tip_p == 6)  {$in_tip_p="Finca";}else
			if ($in_tip_p == 7)  {$in_tip_p="Clinica";}else
			if ($in_tip_p == 8)  {$in_tip_p="Casa de playa";}else
			if ($in_tip_p == 9)  {$in_tip_p="Granja";}else
			if ($in_tip_p == 10) {$in_tip_p="Edificio";}else
			if ($in_tip_p == 11) {$in_tip_p="Local";}else
			{$in_tip_p = "-";}

			if ($in_pre_v > 0 and $in_pre_v > 0)  {$in_preci = "$".number_format($in_pre_v, 2, '.', ',')." / $".number_format($in_pre_r, 2, '.', ',');} else {	
			if ($in_pre_v > 0)  {$in_preci = "$".number_format($in_pre_v, 2, '.', ',');} else {
			if ($in_pre_r > 0)  {$in_preci = "$".number_format($in_pre_r, 2, '.', ',');} else {$in_preci = "$0.00 / $0.00";} }}

			if ($in_pre_v > 0 and $in_pre_v > 0)  {$in_prevr = "Venta / Renta";} else {	
			if ($in_pre_v > 0)  {$in_prevr = "Venta";} else {
			if ($in_pre_r > 0)  {$in_prevr = "Renta";} else {$in_prevr = "Venta / Renta";} }}

			//-------------------------------------------------------------------------------------------
			//CONSULTA PARA AGENTE_INTERNO
			$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "'");
			$data_user = mysqli_num_rows($query_user);
			$ferow = mysqli_fetch_array($query_user);
			if ($data_user > 0) 
			{
				$aseso_id = $ferow['id_users'];  //Usuario Datos ID
				$aseso_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
				$aseso_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
				$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
				$aseso_fi = $ferow['datadded'];  //Usuario Fecha de Ingreso
				$aseso_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
				$aseso_es = $ferow['userstat'];  //Usuario Esado 
				$aseso_te = $ferow['phonenum'];  //Usuario Telefono
				$aseso_cu = $ferow['userdate'];  //Usuario Cumpleaños
				$aseso_di = utf8_encode($ferow['useraddr']);  //Usuario Dirección
				$aseso_ge = $ferow['usergend'];  //Usuario Genero
				$aseso_dp = $ferow['userndpi'];  //Usuario DPI
				$aseso_ec = $ferow['usermatr'];  //Usuario Estado Civil
				$aseso_pr = $ferow['userprof'];  //Usuario Profesión
				//REDES SOCIALES
				$aseso_fb = $ferow['userface'];  //Usuario Facebook
				$aseso_tw = $ferow['usertwit'];  //Usuario Twitter
				$aseso_wa = $ferow['userwhat'];  //Usuario Whatsapp
				$aseso_in = $ferow['userinst'];  //Usuario Instagram
				$aseso_li = $ferow['userlink'];  //Usuario LinkedIn
				$aseso_yo = $ferow['useryout'];  //Usuario Youtube
				$aseso_pi = $ferow['userpint'];  //Usuario Pinterest

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
				if ($aseso_pr == 19) {$aseso_pr = "Broker Owner";} 	else
				{$aseso_pr = " - ";}
			}


			//-------------------------------------------------------------------------------------------
			//CONSULTA PARA AGENTE
			$query_user = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_ad_co . "'");
			$data_user = mysqli_num_rows($query_user);
			$ferow = mysqli_fetch_array($query_user);
			if ($data_user > 0) {
				$ase_e_id = $ferow['id_users'];  //Usuario Datos ID
				$ase_e_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
				$ase_e_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
				$ase_e_es = $ferow['userstat'];  //Usuario Esado 
			}

			//-------------------------------------------------------------------------------------------
			//CONSULTA DEPARTAMENTOS
			$query_dep = mysqli_query($con,"SELECT * FROM `si_departments` WHERE `de_pa_id`= '" . $in_di_de . "'");
			$data  = mysqli_num_rows($query_dep);
			$ferow = mysqli_fetch_array($query_dep);
			if ($data > 0) {
				$de_pa_id = $ferow['de_pa_id'];  //Datos ID
				$de_nombr = utf8_encode($ferow['de_nombr']);  //Nombre
			}

			//-------------------------------------------------------------------------------------------
			//CONSULTA MUNICIPIOS
			$query_mun = mysqli_query($con,"SELECT * FROM `si_municips` WHERE `mu_ni_id`= '" . $in_di_mu . "'");
			$data  = mysqli_num_rows($query_mun);
			$ferow = mysqli_fetch_array($query_mun);
			if ($data > 0) {
				$mu_ni_id = $ferow['mu_ni_id'];  //Datos ID
				$mu_nombr = utf8_encode($ferow['mu_nombr']);  //Nombre
			}

			//vuelve a cargar datos de tipo de usuario
			$usertipe = $_SESSION['usertipe'];
			?>
	
		<div class="pdf-container-page-1" id="page<?php echo $count_p; ?>">
			<div class="header-container">
				<div class="logo-container">
					<img src="../assets/images/pdf/logo_lg_blanco.svg" alt="Logo Propiedades Platinum">
				</div>
			</div>
			<div class="titles-container">
				<div class="titles-content">
					<div class="title">
						<h1><?php echo str_replace("\n", "<br>", $in_titul); ?></h1>
					</div>
					<div class="subtitle">
						<h3><strong>PROPIEDAD COD. <?php echo($in_mu_id); ?></strong> - SOLO INTERESADOS DIRECTOS -</h3>
					</div>
				</div>
				<div class="pleca-container">
					<img src="..assets/images/pdf/pleca_gray_blue.png" alt="" srcset="">
				</div>
			</div>
			<div class="principal-pictures-properties-container">
				<div class="picture-lg-content bg-elements picture-1-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/1.jpg) !important;">
				</div>
				<div class="picture-md-content bg-elements picture-2-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/2.jpg) !important;">
				</div>
				<div class="picture-md-content bg-elements picture-3-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/3.jpg) !important;">
				</div>
			</div>
			<div class="property-details">
				<div class="content-details">
					<div class="descriptions">
						<h3>DESCRIPCIÓN</h3>
							<!-- Descripción -->
							<?php if ($in_ab_de == true) { ?>
								<p><?php echo ($in_ab_de); ?></p>
							<?php } ?>

							<!-- Varas, Frente y Fondo -->
							<?php if ($in_co_te > 0 || $in_co_j1 > 0) { ?>
								<p>
									<?php if ($in_co_te > 0) { 
											echo ($in_co_te." Vrs<sup>2</sup> de terreno");
										}
										if ($in_co_te > 0 && $in_co_j1 > 0) {
											echo (", ");
										}
										?>									
									<?php if ($in_co_j1 > 0) { 
										echo ($in_co_j1." x ".$in_co_j2." de fondo (aprox)");
										}
									?>
								</p>
							<?php } ?>
						<!-- <p>973 Mts de terreno 21 x 48 de fondo (aprox) </p> -->

						<!-- Metros de Construcción -->
						<?php if ($in_co_mt > 0) { ?>
							<p><?php echo ($in_co_mt." "); ?>Mts<sup>2</sup> de construcción</p>
						<?php } ?>
						<!-- <p>650 Mts2 de construcción</p> -->

						<!-- Años o Año de Construcción -->
						<?php if ($in_co_an > 0) { ?>
							<?php 
								if ($in_co_an > 1099) {
									$current_year = date("Y");
									$building_years = ($current_year - $in_co_an); ?> 
										<p><?php echo ($building_years." "); ?> años de construida, en perfecto estado</p>
									<?php 
								} else if ($in_co_an > 0 && $in_co_an < 2) {
									$a = (2020 - $in_co_an);
									$current_year = date("Y");
									$building_years = ($current_year - $a); ?>
										<p><?php echo ($building_years." "); ?> año de construida, en perfecto estado</p>
									<?php 
								} else if ($in_co_an > 0 && $in_co_an < 100) {
									$a = (2020 - $in_co_an);
									$current_year = date("Y");
									$building_years = ($current_year - $a); ?>
										<p><?php echo ($building_years." "); ?> años de construida, en perfecto estado</p>
									<?php 
								} else { ?> 
										<p><?php echo ($in_co_an); ?> años de construida (aprox), en perfecto estado</p>
									<?php
								}
								
							?>
							<!-- <p>28 años de construida, en perfecto estado  reformada</p> -->
						<?php } ?>

						<!-- Niveles -->
						<?php if ($in_co_ni > 0) { ?>
							<?php if ($in_co_ni == 1) { ?>
								<p><?php echo ($in_co_ni); ?> nivel</p>
							<?php } else { ?>
								<p><?php echo ($in_co_ni); ?> niveles</p>
						<?php }} ?>

						<!-- Dormitorio de Servicio -->
						<?php if ($in_co_d2 > 0) { ?>
							<?php if ($in_co_d2 == 1) { ?>
								<p><?php echo ($in_co_d2); ?> dormitorio de servicio</p>
							<?php } else { ?>
								<p><?php echo ($in_co_d2); ?> dormitorios de servicio</p>
								<!-- <p>2 dormitorios de servicio con su baño</p> -->
						<?php }} ?>

						<!-- Área de Lavandería y Patio -->
						<?php if ($in_de_la > 0 && $in_de_pa > 0) { ?>
								<p>Área de lavandería y patio</p>
							<?php } else if ($in_de_la > 0 && $in_de_pa == 0) { ?>
								<p>Área de lavandería</p>
							<?php } else if ($in_de_la == 0 && $in_de_pa > 0) { ?>
								<p>Área de Patio</p>
						<?php } ?>

						<!-- Chimenea -->
						<?php if ($in_de_ch > 0) { ?>
							<p>Sala con chimenea</p>
						<?php } ?>

						<!-- Comedor -->
						<?php if ($in_de_co > 0) { ?>
							<p>Comedor independiente</p>
						<?php } ?>

						<!-- Dormitorios y Baños -->
						<?php if ($in_co_d1 == 1 && $in_co_ba > 1) { ?>
							<p><?php echo ($in_co_d1) ?> dormitorio amplio con baño completo</p>
						<?php } else if ($in_co_d1 > 1 && $in_co_ba > 1) { ?>
							<p><?php echo ($in_co_d1) ?> dormitorios amplios con baño completo</p> 
						<?php } ?>

						<!-- Walking Closet -->
						<?php if ($in_co_d1 > 0) { ?>
							<p>Walk-In Closet</p>
						<?php } ?>
						
						<!-- Parqueos Techados  -->
						<?php if ($in_co_p1 == 1) { ?>
							<p><?php echo ($in_co_p1) ?> Parqueo techado</p>
						<?php } elseif ($in_co_p1 > 1) { ?>
							<p><?php echo ($in_co_p1) ?> Parqueos techados</p>
						<?php } ?>
						
						<!-- Jardínes -->
						<?php if ($in_de_j1 == 1 && $in_de_j2 == 1 ) { ?>
							<p>2 jardines</p>
						<?php } else if ($in_de_j1 == 1 || $in_de_j2 == 1 ) { ?>
							<p>1 jardin</p>
						<?php } ?>					

						<!-- Pérgola -->
						<?php if ($in_de_pe == 1 ) { ?>
							<p>Pérgola amplia</p>
						<?php } ?>	
						
						<!-- Bodega -->
						<?php if ($in_am_bo == 1) { ?>
							<p>1 bodega grande</p>
						<?php } else if ($in_am_bo > 0 ) { ?>
							<p><?php echo ($in_am_bo) ?> bodegas grandes</p>
						<?php } else if ($in_de_bo == 1 ) { ?>
							<p>1 bodega</p>
						<?php } ?>

						<!-- Cocina con Isla -->
						<?php if ($in_de_cb == 1 ) { ?>
							<p>Cocina con isla</p>
						<?php } ?>

						<!-- Lavandería y Linea Blanca -->					
						<?php if ($in_de_la == 1 && ($in_in_re == 1 || $in_in_et == 1 || $in_in_ee == 1 || $in_in_ld == 1 || $in_in_sd == 1)) { ?>
							<p>Lavandería y Línea Blanca</p>
						<?php } else if ($in_de_la == 1 ) { ?>
							<p>Lavandería</p>
						<?php } ?>

					</div>
					<div class="details">
						<?php if ($in_ma_cu > 0 ) { ?>
							<h3>CUOTA DE MANTENIMIENTO</h3>
							<p>Q. <?php echo ($in_ma_cu ) ?>/mes  (incluye: 
								<?php
									// Agua
									if ($in_se_ag == 1 ) { 
										echo ("agua");
										if ($in_se_se == 1 || $in_se_li == 1 || $in_se_lu == 1 || $in_se_ba == 1) {
											echo (", ");
										}
									}
									// Luz
									if ($in_se_lu == 1 ) { 
										echo ("luz");
										if ($in_se_se == 1 || $in_se_li == 1 || $in_se_ba == 1) {
											echo (", ");
										}
									}
									// Extracción de Basura
									if ($in_se_ba == 1 ) { 
										echo ("extracción de basura");
										if ($in_se_se == 1 || $in_se_li == 1 ) {
											echo (", ");
										}
									}
									// Seguridad
									if ($in_se_se == 1 ) { 
										echo ("seguridad");
										if ($in_se_li == 1 ) {
											echo (", ");
										}
									}
									// Limpieza de Áreas Comunes
									if ($in_se_li == 1 ) { 
										echo ("mantenimiento de áreas comunes");
									}
								?>
							</p>					
							<div class="line-space"></div>
						<?php } ?>

						<?php if ($in_in_ct == 1 || $in_in_bm == 1 || $in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1 ) { ?>
							<h3>INCLUYE</h3>
							
							<p>
							<?php 
								// Calentador de Agua
								if ($in_in_ct == 1 ) { 
									echo ("calentador de agua");
									if ($in_in_bm == 1 || $in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Bomba y Cisterna
								if ($in_in_bm == 1 ) { 
									echo ("bomba y cisterna");
									if ($in_in_al == 1 || $in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Alarma
								if ($in_in_al == 1 ) { 
									echo ("alarma");
									if ($in_in_eb == 1 || $in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Espejos de Baño
								if ($in_in_eb == 1 ) { 
									echo ("espejos de baño");
									if ($in_in_cs == 1 || $in_in_aa == 1) {
										echo (", ");
									}
								}
								// Cortinas
								if ($in_in_cs == 1 ) { 
									echo ("cortinas");
									if ($in_in_aa == 1) {
										echo (", ");
									}
								}
								// Aire Acondicionado
								if ($in_in_aa == 1 ) { 
									echo ("aire acondicionado");
								}
							?>
							<!-- calentador de agua, cisterna y bomba, alarmas, conexiones internas para alarma con su planta telefónica, espejos en baños,  cortinas, 1 aire acondicionado</p> -->
							<div class="line-space"></div>
						<?php } ?>

						<?php if ($in_am_ca == 1 || $in_am_as == 1 || $in_am_ju == 1 ) { ?>
							<h3>AMENIDADES</h3>
							<p>
							<?php
								// Cancha deportiva
								if ($in_am_ca == 1 ) { 
									echo ("cancha deportiva");
									if ($in_am_as == 1 || $in_am_ju == 1 ) {
										echo (", ");
									}
								}
								// Área Social
								if ($in_am_as == 1 ) { 
									echo ("salón social");
									if ($in_am_ju == 1 ) {
										echo (", ");
									}
								}
								// Juegos Infantiles
								if ($in_am_ju == 1 ) { 
									echo ("área de juegos para niños");								
								}
							?>
							<!-- canchas deportivas, salón social, área de juego para niños.</p> -->
						<?php } ?>					
					</div>
					
				</div>
			</div>
			<div class="footer">
				<div class="price-container">
					<div class="price-content">
						<h4>US$ 
						<?php if ($in_pre_r > 0 ) { 
							echo ($in_pre_r);
						} elseif ($in_pre_v > 0) {
							echo ($in_pre_v);
						} ?>
						</h4>
						<h5>+ imp</h5>
					</div>
				</div>
				<div class="info-contact-container">
					<div class="agent-info-content">
						<h4><?php echo($aseso_pr.": ".$aseso_fn." ".$aseso_ln); ?></h4>
						<h5><strong>Info/cel:</strong> +502 <?php echo($aseso_te); ?></h5>
						<h6><strong>Correo:</strong> <?php echo($aseso_co); ?></h6>
					</div>
				</div>
			</div>
		</div> <?php $count_p = $count_p +1; ?>
		<div class="pdf-container-page-2" id="page<?php echo $count_p; ?>">
			<div class="header-container">
				<div class="logo-container">
					<img src="../assets/images/pdf/logo_lg_blanco.svg" alt="Logo Propiedades Platinum">
				</div>
			</div>
			<div class="titles-container">
				<div class="titles-content">
					<div class="title">
						<h1><?php echo str_replace("\n", "<br>", $in_titul); ?></h1>
					</div>
					<div class="subtitle">
						<h3><strong>PROPIEDAD COD. <?php echo($in_mu_id); ?></strong> - SOLO INTERESADOS DIRECTOS -</h3>
					</div>
				</div>
				<div class="pleca-container">
					<img src="../assets/images/pdf/pleca_gray_blue.png" alt="" srcset="">
				</div>
			</div>
			<div class="principal-pictures-properties-container">
				<div class="picture-md-content-left bg-elements picture-4-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/4.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-5-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/5.jpg) !important;">
				</div>
				<div class="picture-md-content-left bg-elements picture-6-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/6.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-7-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/7.jpg) !important;">
				</div>
				<div class="picture-md-content-left bg-elements picture-8-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/8.jpg) !important;">
				</div>
				<div class="picture-md-content-right bg-elements picture-9-<?php echo($in_mu_id); ?>" style="background-image: url(../assets/images/propiedades/<?php echo($in_mu_id); ?>/9.jpg) !important;">
				</div>
			</div>
			
			<div class="footer">
				<div class="price-container">
					<div class="price-content">
						<h4><?php echo($aseso_pr.": ".$aseso_fn." ".$aseso_ln); ?></h4>
					</div>
				</div>
				<div class="info-contact-container">
					<div class="agent-info-content">					
						<h5><strong>Info/cel:</strong> +502 <?php echo($aseso_te); ?></h5>
						<h6><strong>Correo:</strong> <?php echo($aseso_co); ?></h6>
					</div>
				</div>
			</div>
		</div> <?php $count_p = $count_p +1; ?>
			<?php
		}
	?>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="../assets/js/jspdf.debug.js"></script>

<script>
	
	var controlPage;
	var basePage;
	var totalPage;
	function pdf_generator() {
		controlPage = controlPage + 1;
		pageNumber = "'"+basePage+controlPage+"'";
		if (controlPage > totalPage) {
			pdf.addPage();
			pdf.addHTML($(pageNumber), 0, 0, options, function () // Página #3
			{
				controlPage = controlPage + 1;
				pageNumber = "'"+basePage+controlPage+"'";
				pdf.addPage();
				pdf.addHTML($(pageNumber), 0, 0, options, function () // Página #4
				{
					pdf_generator();
				});
			});
		} else {
			
		}
	}
	$(document).ready(function () 
	{
		

		$(function() 
		{ 
			var options = 
			{ };
			var pdf = new jsPDF('p', 'pt', 'letter');
			var totalPages = <?php echo $count_p; ?>;			
			var controlPage = 1;
			var basePage = '#page';
			var pageNumber = "'"+basePage+controlPage+"'";
			// PROPIEDAD NO. 1
			pdf.addHTML($(pageNumber), 0, 0, options, function () // Página #1
			{
				controlPage = controlPage + 1;
				pageNumber = "'"+basePage+controlPage+"'";
				pdf.addPage();
				pdf.addHTML($(pageNumber), 0, 0, options, function () // Página #2
				{
					pdf_generator();
				});
			});
		});			
		

	});
	
</script>
