<?php
/*-------------------------
PROPIEDAD FORM EDIT
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

	if (!empty($_GET ['id'])) 
	{ $id = $_GET['id']; } 
	else 
	{ $id = '0'; }
	
	//CONSULTA PROPIEDAD (completar campos)
	$query=mysqli_query($con, 
	"SELECT * FROM `si_properties` WHERE `in_mu_id`= '".$id."'");
	$count_prop=mysqli_num_rows($query);
	$ferow=mysqli_fetch_array($query);
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
	}

	//DATOS OBLIGATORIOS DE FOMULARIO
	if (isset($_POST['in_titul']) && !empty($_POST ['in_titul']) && isset($_POST['in_nombr']) && !empty($_POST ['in_nombr']))
	{
		if (!$con)
		{
			die (" Error de Base de Datos " . mysqli_error($con));
		}
			else
		{
			//CAPTURA DATOS DE FORMULARIO
			if (!empty($_POST['in_titul'])) { $in_titul = utf8_decode($_POST['in_titul']); } else { $in_titul = 0; }
			if (!empty($_POST['in_porce'])) { $in_porce = utf8_decode($_POST['in_porce']); } else { $in_porce = 0; }
			if (!empty($_POST['in_pre_r'])) { $in_pre_r = utf8_decode($_POST['in_pre_r']); } else { $in_pre_r = 0; }
			if (!empty($_POST['in_pre_v'])) { $in_pre_v = utf8_decode($_POST['in_pre_v']); } else { $in_pre_v = 0; }
			if (!empty($_POST['in_nombr'])) { $in_nombr = utf8_decode($_POST['in_nombr']); } else { $in_nombr = 0; }
			if (!empty($_POST['in_tip_p'])) { $in_tip_p = utf8_decode($_POST['in_tip_p']); } else { $in_tip_p = 0; }
			if (!empty($_POST['in_vende'])) { $in_vende = utf8_decode($_POST['in_vende']); } else { $in_vende = 0; }
			if (!empty($_POST['in_ab_a1'])) { $in_ab_a1 = utf8_decode($_POST['in_ab_a1']); } else { $in_ab_a1 = 0; }
			if (!empty($_POST['in_ab_a2'])) { $in_ab_a2 = utf8_decode($_POST['in_ab_a2']); } else { $in_ab_a2 = 0; }
			if (!empty($_POST['in_ab_at'])) { $in_ab_at = utf8_decode($_POST['in_ab_at']); } else { $in_ab_at = 0; }
			if (!empty($_POST['in_ab_ba'])) { $in_ab_ba = utf8_decode($_POST['in_ab_ba']); } else { $in_ab_ba = 0; }
			if (!empty($_POST['in_ab_de'])) { $in_ab_de = utf8_decode($_POST['in_ab_de']); } else { $in_ab_de = 0; }
			if (!empty($_POST['in_ab_fi'])) { $in_ab_fi = utf8_decode($_POST['in_ab_fi']); } else { $in_ab_fi = 0; }
			if (!empty($_POST['in_ab_fo'])) { $in_ab_fo = utf8_decode($_POST['in_ab_fo']); } else { $in_ab_fo = 0; }
			if (!empty($_POST['in_ab_g1'])) { $in_ab_g1 = utf8_decode($_POST['in_ab_g1']); } else { $in_ab_g1 = 0; }
			if (!empty($_POST['in_ab_g2'])) { $in_ab_g2 = utf8_decode($_POST['in_ab_g2']); } else { $in_ab_g2 = 0; }
			if (!empty($_POST['in_ab_iu'])) { $in_ab_iu = utf8_decode($_POST['in_ab_iu']); } else { $in_ab_iu = 0; }
			if (!empty($_POST['in_ab_li'])) { $in_ab_li = utf8_decode($_POST['in_ab_li']); } else { $in_ab_li = 0; }
			if (!empty($_POST['in_ab_ni'])) { $in_ab_ni = utf8_decode($_POST['in_ab_ni']); } else { $in_ab_ni = 0; }
			if (!empty($_POST['in_ab_re'])) { $in_ab_re = utf8_decode($_POST['in_ab_re']); } else { $in_ab_re = 0; }
			if (!empty($_POST['in_ab_tc'])) { $in_ab_tc = utf8_decode($_POST['in_ab_tc']); } else { $in_ab_tc = 0; }
			if (!empty($_POST['in_ab_s1'])) { $in_ab_s1 = utf8_decode($_POST['in_ab_s1']); } else { $in_ab_s1 = 0; }
			if (!empty($_POST['in_ab_s2'])) { $in_ab_s2 = utf8_decode($_POST['in_ab_s2']); } else { $in_ab_s2 = 0; }
			if (!empty($_POST['in_ac_co'])) { $in_ac_co = utf8_decode($_POST['in_ac_co']); } else { $in_ac_co = 0; }
			if (!empty($_POST['in_ac_pi'])) { $in_ac_pi = utf8_decode($_POST['in_ac_pi']); } else { $in_ac_pi = 0; }
			if (!empty($_POST['in_ac_pu'])) { $in_ac_pu = utf8_decode($_POST['in_ac_pu']); } else { $in_ac_pu = 0; }
			if (!empty($_POST['in_ac_te'])) { $in_ac_te = utf8_decode($_POST['in_ac_te']); } else { $in_ac_te = 0; }
			if (!empty($_POST['in_ac_ve'])) { $in_ac_ve = utf8_decode($_POST['in_ac_ve']); } else { $in_ac_ve = 0; }
			if (!empty($_POST['in_ad_co'])) { $in_ad_co = utf8_decode($_POST['in_ad_co']); } else { $in_ad_co = 0; }
			if (!empty($_POST['in_ad_em'])) { $in_ad_em = utf8_decode($_POST['in_ad_em']); } else { $in_ad_em = 0; }
			if (!empty($_POST['in_ad_ex'])) { $in_ad_ex = utf8_decode($_POST['in_ad_ex']); } else { $in_ad_ex = 0; }
			if (!empty($_POST['in_ad_po'])) { $in_ad_po = utf8_decode($_POST['in_ad_po']); } else { $in_ad_po = 0; }
			if (!empty($_POST['in_ad_pu'])) { $in_ad_pu = utf8_decode($_POST['in_ad_pu']); } else { $in_ad_pu = 0; }
			if (!empty($_POST['in_am_am'])) { $in_am_am = utf8_decode($_POST['in_am_am']); } else { $in_am_am = 0; }
			if (!empty($_POST['in_am_as'])) { $in_am_as = utf8_decode($_POST['in_am_as']); } else { $in_am_as = 0; }
			if (!empty($_POST['in_am_bc'])) { $in_am_bc = utf8_decode($_POST['in_am_bc']); } else { $in_am_bc = 0; }
			if (!empty($_POST['in_am_ca'])) { $in_am_ca = utf8_decode($_POST['in_am_ca']); } else { $in_am_ca = 0; }
			if (!empty($_POST['in_am_ga'])) { $in_am_ga = utf8_decode($_POST['in_am_ga']); } else { $in_am_ga = 0; }
			if (!empty($_POST['in_am_gi'])) { $in_am_gi = utf8_decode($_POST['in_am_gi']); } else { $in_am_gi = 0; }
			if (!empty($_POST['in_am_gu'])) { $in_am_gu = utf8_decode($_POST['in_am_gu']); } else { $in_am_gu = 0; }
			if (!empty($_POST['in_am_ju'])) { $in_am_ju = utf8_decode($_POST['in_am_ju']); } else { $in_am_ju = 0; }
			if (!empty($_POST['in_am_ot'])) { $in_am_ot = utf8_decode($_POST['in_am_ot']); } else { $in_am_ot = 0; }
			if (!empty($_POST['in_am_pa'])) { $in_am_pa = utf8_decode($_POST['in_am_pa']); } else { $in_am_pa = 0; }
			if (!empty($_POST['in_am_pi'])) { $in_am_pi = utf8_decode($_POST['in_am_pi']); } else { $in_am_pi = 0; }
			if (!empty($_POST['in_am_pt'])) { $in_am_pt = utf8_decode($_POST['in_am_pt']); } else { $in_am_pt = 0; }
			if (!empty($_POST['in_am_rr'])) { $in_am_rr = utf8_decode($_POST['in_am_rr']); } else { $in_am_rr = 0; }
			if (!empty($_POST['in_am_sa'])) { $in_am_sa = utf8_decode($_POST['in_am_sa']); } else { $in_am_sa = 0; }
			if (!empty($_POST['in_am_sb'])) { $in_am_sb = utf8_decode($_POST['in_am_sb']); } else { $in_am_sb = 0; }
			if (!empty($_POST['in_am_sp'])) { $in_am_sp = utf8_decode($_POST['in_am_sp']); } else { $in_am_sp = 0; }
			if (!empty($_POST['in_am_sr'])) { $in_am_sr = utf8_decode($_POST['in_am_sr']); } else { $in_am_sr = 0; }
			if (!empty($_POST['in_ar_ii'])) { $in_ar_ii = utf8_decode($_POST['in_ar_ii']); } else { $in_ar_ii = 0; }
			if (!empty($_POST['in_ar_it'])) { $in_ar_it = utf8_decode($_POST['in_ar_it']); } else { $in_ar_it = 0; }
			if (!empty($_POST['in_co_an'])) { $in_co_an = utf8_decode($_POST['in_co_an']); } else { $in_co_an = 0; }
			if (!empty($_POST['in_co_ba'])) { $in_co_ba = utf8_decode($_POST['in_co_ba']); } else { $in_co_ba = 0; }
			if (!empty($_POST['in_co_bs'])) { $in_co_bs = utf8_decode($_POST['in_co_bs']); } else { $in_co_bs = 0; }
			if (!empty($_POST['in_co_d1'])) { $in_co_d1 = utf8_decode($_POST['in_co_d1']); } else { $in_co_d1 = 0; }
			if (!empty($_POST['in_co_d2'])) { $in_co_d2 = utf8_decode($_POST['in_co_d2']); } else { $in_co_d2 = 0; }
			if (!empty($_POST['in_co_j1'])) { $in_co_j1 = utf8_decode($_POST['in_co_j1']); } else { $in_co_j1 = 0; }
			if (!empty($_POST['in_co_j2'])) { $in_co_j2 = utf8_decode($_POST['in_co_j2']); } else { $in_co_j2 = 0; }
			if (!empty($_POST['in_co_mt'])) { $in_co_mt = utf8_decode($_POST['in_co_mt']); } else { $in_co_mt = 0; }
			if (!empty($_POST['in_co_ni'])) { $in_co_ni = utf8_decode($_POST['in_co_ni']); } else { $in_co_ni = 0; }
			if (!empty($_POST['in_co_p1'])) { $in_co_p1 = utf8_decode($_POST['in_co_p1']); } else { $in_co_p1 = 0; }
			if (!empty($_POST['in_co_p2'])) { $in_co_p2 = utf8_decode($_POST['in_co_p2']); } else { $in_co_p2 = 0; }
			if (!empty($_POST['in_co_te'])) { $in_co_te = utf8_decode($_POST['in_co_te']); } else { $in_co_te = 0; }
			if (!empty($_POST['in_de_ac'])) { $in_de_ac = utf8_decode($_POST['in_de_ac']); } else { $in_de_ac = 0; }
			if (!empty($_POST['in_de_b2'])) { $in_de_b2 = utf8_decode($_POST['in_de_b2']); } else { $in_de_b2 = 0; }
			if (!empty($_POST['in_de_ba'])) { $in_de_ba = utf8_decode($_POST['in_de_ba']); } else { $in_de_ba = 0; }
			if (!empty($_POST['in_de_bi'])) { $in_de_bi = utf8_decode($_POST['in_de_bi']); } else { $in_de_bi = 0; }
			if (!empty($_POST['in_de_bj'])) { $in_de_bj = utf8_decode($_POST['in_de_bj']); } else { $in_de_bj = 0; }
			if (!empty($_POST['in_de_bo'])) { $in_de_bo = utf8_decode($_POST['in_de_bo']); } else { $in_de_bo = 0; }
			if (!empty($_POST['in_de_bv'])) { $in_de_bv = utf8_decode($_POST['in_de_bv']); } else { $in_de_bv = 0; }
			if (!empty($_POST['in_de_cb'])) { $in_de_cb = utf8_decode($_POST['in_de_cb']); } else { $in_de_cb = 0; }
			if (!empty($_POST['in_de_cc'])) { $in_de_cc = utf8_decode($_POST['in_de_cc']); } else { $in_de_cc = 0; }
			if (!empty($_POST['in_de_ch'])) { $in_de_ch = utf8_decode($_POST['in_de_ch']); } else { $in_de_ch = 0; }
			if (!empty($_POST['in_de_cl'])) { $in_de_cl = utf8_decode($_POST['in_de_cl']); } else { $in_de_cl = 0; }
			if (!empty($_POST['in_de_co'])) { $in_de_co = utf8_decode($_POST['in_de_co']); } else { $in_de_co = 0; }
			if (!empty($_POST['in_de_cr'])) { $in_de_cr = utf8_decode($_POST['in_de_cr']); } else { $in_de_cr = 0; }
			if (!empty($_POST['in_de_de'])) { $in_de_de = utf8_decode($_POST['in_de_de']); } else { $in_de_de = 0; }
			if (!empty($_POST['in_de_ds'])) { $in_de_ds = utf8_decode($_POST['in_de_ds']); } else { $in_de_ds = 0; }
			if (!empty($_POST['in_de_du'])) { $in_de_du = utf8_decode($_POST['in_de_du']); } else { $in_de_du = 0; }
			if (!empty($_POST['in_de_dv'])) { $in_de_dv = utf8_decode($_POST['in_de_dv']); } else { $in_de_dv = 0; }
			if (!empty($_POST['in_de_es'])) { $in_de_es = utf8_decode($_POST['in_de_es']); } else { $in_de_es = 0; }
			if (!empty($_POST['in_de_j1'])) { $in_de_j1 = utf8_decode($_POST['in_de_j1']); } else { $in_de_j1 = 0; }
			if (!empty($_POST['in_de_j2'])) { $in_de_j2 = utf8_decode($_POST['in_de_j2']); } else { $in_de_j2 = 0; }
			if (!empty($_POST['in_de_ja'])) { $in_de_ja = utf8_decode($_POST['in_de_ja']); } else { $in_de_ja = 0; }
			if (!empty($_POST['in_de_je'])) { $in_de_je = utf8_decode($_POST['in_de_je']); } else { $in_de_je = 0; }
			if (!empty($_POST['in_de_la'])) { $in_de_la = utf8_decode($_POST['in_de_la']); } else { $in_de_la = 0; }
			if (!empty($_POST['in_de_oa'])) { $in_de_oa = utf8_decode($_POST['in_de_oa']); } else { $in_de_oa = 0; }
			if (!empty($_POST['in_de_ot'])) { $in_de_ot = utf8_decode($_POST['in_de_ot']); } else { $in_de_ot = 0; }
			if (!empty($_POST['in_de_pa'])) { $in_de_pa = utf8_decode($_POST['in_de_pa']); } else { $in_de_pa = 0; }
			if (!empty($_POST['in_de_pe'])) { $in_de_pe = utf8_decode($_POST['in_de_pe']); } else { $in_de_pe = 0; }
			if (!empty($_POST['in_de_po'])) { $in_de_po = utf8_decode($_POST['in_de_po']); } else { $in_de_po = 0; }
			if (!empty($_POST['in_de_s1'])) { $in_de_s1 = utf8_decode($_POST['in_de_s1']); } else { $in_de_s1 = 0; }
			if (!empty($_POST['in_de_s2'])) { $in_de_s2 = utf8_decode($_POST['in_de_s2']); } else { $in_de_s2 = 0; }
			if (!empty($_POST['in_de_s3'])) { $in_de_s3 = utf8_decode($_POST['in_de_s3']); } else { $in_de_s3 = 0; }
			if (!empty($_POST['in_de_sa'])) { $in_de_sa = utf8_decode($_POST['in_de_sa']); } else { $in_de_sa = 0; }
			if (!empty($_POST['in_de_te'])) { $in_de_te = utf8_decode($_POST['in_de_te']); } else { $in_de_te = 0; }
			if (!empty($_POST['in_de_ti'])) { $in_de_ti = utf8_decode($_POST['in_de_ti']); } else { $in_de_ti = 0; }
			if (!empty($_POST['in_de_wa'])) { $in_de_wa = utf8_decode($_POST['in_de_wa']); } else { $in_de_wa = 0; }
			if (!empty($_POST['in_di_de'])) { $in_di_de = utf8_decode($_POST['in_di_de']); } else { $in_di_de = 0; }
			if (!empty($_POST['in_di_di'])) { $in_di_di = utf8_decode($_POST['in_di_di']); } else { $in_di_di = 0; }
			if (!empty($_POST['in_di_mu'])) { $in_di_mu = utf8_decode($_POST['in_di_mu']); } else { $in_di_mu = 0; }
			if (!empty($_POST['in_di_pa'])) { $in_di_pa = utf8_decode($_POST['in_di_pa']); } else { $in_di_pa = 0; }
			if (!empty($_POST['in_di_re'])) { $in_di_re = utf8_decode($_POST['in_di_re']); } else { $in_di_re = 0; }
			if (!empty($_POST['in_di_zo'])) { $in_di_zo = utf8_decode($_POST['in_di_zo']); } else { $in_di_zo = 0; }
			if (!empty($_POST['in_e1_ce'])) { $in_e1_ce = utf8_decode($_POST['in_e1_ce']); } else { $in_e1_ce = 0; }
			if (!empty($_POST['in_e1_no'])) { $in_e1_no = utf8_decode($_POST['in_e1_no']); } else { $in_e1_no = 0; }
			if (!empty($_POST['in_e1_t1'])) { $in_e1_t1 = utf8_decode($_POST['in_e1_t1']); } else { $in_e1_t1 = 0; }
			if (!empty($_POST['in_e1_t2'])) { $in_e1_t2 = utf8_decode($_POST['in_e1_t2']); } else { $in_e1_t2 = 0; }
			if (!empty($_POST['in_e2_ce'])) { $in_e2_ce = utf8_decode($_POST['in_e2_ce']); } else { $in_e2_ce = 0; }
			if (!empty($_POST['in_e2_no'])) { $in_e2_no = utf8_decode($_POST['in_e2_no']); } else { $in_e2_no = 0; }
			if (!empty($_POST['in_e2_t1'])) { $in_e2_t1 = utf8_decode($_POST['in_e2_t1']); } else { $in_e2_t1 = 0; }
			if (!empty($_POST['in_e2_t2'])) { $in_e2_t2 = utf8_decode($_POST['in_e2_t2']); } else { $in_e2_t2 = 0; }
			if (!empty($_POST['in_fi_cn'])) { $in_fi_cn = utf8_decode($_POST['in_fi_cn']); } else { $in_fi_cn = 0; }
			if (!empty($_POST['in_fi_cp'])) { $in_fi_cp = utf8_decode($_POST['in_fi_cp']); } else { $in_fi_cp = 0; }
			if (!empty($_POST['in_fi_en'])) { $in_fi_en = utf8_decode($_POST['in_fi_en']); } else { $in_fi_en = 0; }
			if (!empty($_POST['in_fi_es'])) { $in_fi_es = utf8_decode($_POST['in_fi_es']); } else { $in_fi_es = 0; }
			if (!empty($_POST['in_fi_pl'])) { $in_fi_pl = utf8_decode($_POST['in_fi_pl']); } else { $in_fi_pl = 0; }
			if (!empty($_POST['in_fi_sn'])) { $in_fi_sn = utf8_decode($_POST['in_fi_sn']); } else { $in_fi_sn = 0; }
			if (!empty($_POST['in_fi_ta'])) { $in_fi_ta = utf8_decode($_POST['in_fi_ta']); } else { $in_fi_ta = 0; }
			if (!empty($_POST['in_in_aa'])) { $in_in_aa = utf8_decode($_POST['in_in_aa']); } else { $in_in_aa = 0; }
			if (!empty($_POST['in_in_al'])) { $in_in_al = utf8_decode($_POST['in_in_al']); } else { $in_in_al = 0; }
			if (!empty($_POST['in_in_bl'])) { $in_in_bl = utf8_decode($_POST['in_in_bl']); } else { $in_in_bl = 0; }
			if (!empty($_POST['in_in_bm'])) { $in_in_bm = utf8_decode($_POST['in_in_bm']); } else { $in_in_bm = 0; }
			if (!empty($_POST['in_in_ca'])) { $in_in_ca = utf8_decode($_POST['in_in_ca']); } else { $in_in_ca = 0; }
			if (!empty($_POST['in_in_cb'])) { $in_in_cb = utf8_decode($_POST['in_in_cb']); } else { $in_in_cb = 0; }
			if (!empty($_POST['in_in_cm'])) { $in_in_cm = utf8_decode($_POST['in_in_cm']); } else { $in_in_cm = 0; }
			if (!empty($_POST['in_in_cs'])) { $in_in_cs = utf8_decode($_POST['in_in_cs']); } else { $in_in_cs = 0; }
			if (!empty($_POST['in_in_ct'])) { $in_in_ct = utf8_decode($_POST['in_in_ct']); } else { $in_in_ct = 0; }
			if (!empty($_POST['in_in_db'])) { $in_in_db = utf8_decode($_POST['in_in_db']); } else { $in_in_db = 0; }
			if (!empty($_POST['in_in_eb'])) { $in_in_eb = utf8_decode($_POST['in_in_eb']); } else { $in_in_eb = 0; }
			if (!empty($_POST['in_in_ee'])) { $in_in_ee = utf8_decode($_POST['in_in_ee']); } else { $in_in_ee = 0; }
			if (!empty($_POST['in_in_et'])) { $in_in_et = utf8_decode($_POST['in_in_et']); } else { $in_in_et = 0; }
			if (!empty($_POST['in_in_io'])) { $in_in_io = utf8_decode($_POST['in_in_io']); } else { $in_in_io = 0; }
			if (!empty($_POST['in_in_ld'])) { $in_in_ld = utf8_decode($_POST['in_in_ld']); } else { $in_in_ld = 0; }
			if (!empty($_POST['in_in_lm'])) { $in_in_lm = utf8_decode($_POST['in_in_lm']); } else { $in_in_lm = 0; }
			if (!empty($_POST['in_in_lv'])) { $in_in_lv = utf8_decode($_POST['in_in_lv']); } else { $in_in_lv = 0; }
			if (!empty($_POST['in_in_ps'])) { $in_in_ps = utf8_decode($_POST['in_in_ps']); } else { $in_in_ps = 0; }
			if (!empty($_POST['in_in_re'])) { $in_in_re = utf8_decode($_POST['in_in_re']); } else { $in_in_re = 0; }
			if (!empty($_POST['in_in_sd'])) { $in_in_sd = utf8_decode($_POST['in_in_sd']); } else { $in_in_sd = 0; }
			if (!empty($_POST['in_ma_cu'])) { $in_ma_cu = utf8_decode($_POST['in_ma_cu']); } else { $in_ma_cu = 0; }
			if (!empty($_POST['in_ma_in'])) { $in_ma_in = utf8_decode($_POST['in_ma_in']); } else { $in_ma_in = 0; }
			if (!empty($_POST['in_mante'])) { $in_mante = utf8_decode($_POST['in_mante']); } else { $in_mante = 0; }
			if (!empty($_POST['in_por_r'])) { $in_por_r = utf8_decode($_POST['in_por_r']); } else { $in_por_r = 0; }
			if (!empty($_POST['in_se_ag'])) { $in_se_ag = utf8_decode($_POST['in_se_ag']); } else { $in_se_ag = 0; }
			if (!empty($_POST['in_se_ba'])) { $in_se_ba = utf8_decode($_POST['in_se_ba']); } else { $in_se_ba = 0; }
			if (!empty($_POST['in_se_li'])) { $in_se_li = utf8_decode($_POST['in_se_li']); } else { $in_se_li = 0; }
			if (!empty($_POST['in_se_lu'])) { $in_se_lu = utf8_decode($_POST['in_se_lu']); } else { $in_se_lu = 0; }
			if (!empty($_POST['in_se_se'])) { $in_se_se = utf8_decode($_POST['in_se_se']); } else { $in_se_se = 0; }
			if (!empty($_POST['in_ab_yo'])) { $in_ab_yo = utf8_decode($_POST['in_ab_yo']); } else { $in_ab_yo = 0; }
			if (!empty($_POST['in_estat'])) { $in_estat = utf8_decode($_POST['in_estat']); } else { $in_estat = 0; }
			if (!empty($_POST['in_us_po'])) { $in_us_po = utf8_decode($_POST['in_us_po']); } else { $in_us_po = 0; }
			if (!empty($_POST['in_fe_in'])) { $in_fe_in = utf8_decode($_POST['in_fe_in']); } else { $in_fe_in = 0; }
			if (!empty($_POST['in_am_of'])) { $in_am_of = utf8_decode($_POST['in_am_of']); } else { $in_am_of = 0; }
			if (!empty($_POST['in_am_bo'])) { $in_am_bo = utf8_decode($_POST['in_am_bo']); } else { $in_am_bo = 0; }
			if (!empty($_POST['in_am_lo'])) { $in_am_lo = utf8_decode($_POST['in_am_lo']); } else { $in_am_lo = 0; }
			
			if (!empty($_POST['foto_est'])) { $foto_est = utf8_decode($_POST['foto_est']); } else { $foto_est = 0; }
			$in_ab_tc = 7.71;
			//$in_estat = utf8_decode("0"); //estados: (0 Activa), (1 Vendida), (2 Alquilada)
			$in_us_po = utf8_decode($username);
			$in_fe_in = utf8_decode(date('Y-m-d h:i:s'));


			//EDITA PROPIEDAD ACTUAL
			mysqli_query($con,"UPDATE `si_properties` SET
			`in_titul` = '$in_titul',
			`in_porce` = '$in_porce',
			`in_pre_r` = '$in_pre_r',
			`in_pre_v` = '$in_pre_v',
			`in_nombr` = '$in_nombr',
			`in_tip_p` = '$in_tip_p',
			`in_vende` = '$in_vende',
			`in_ab_a1` = '$in_ab_a1',
			`in_ab_a2` = '$in_ab_a2',
			`in_ab_at` = '$in_ab_at',
			`in_ab_ba` = '$in_ab_ba',
			`in_ab_de` = '$in_ab_de',
			`in_ab_fi` = '$in_ab_fi',
			`in_ab_fo` = '$in_ab_fo',
			`in_ab_g1` = '$in_ab_g1',
			`in_ab_g2` = '$in_ab_g2',
			`in_ab_iu` = '$in_ab_iu',
			`in_ab_li` = '$in_ab_li',
			`in_ab_ni` = '$in_ab_ni',
			`in_ab_re` = '$in_ab_re',
			`in_ab_tc` = '$in_ab_tc',
			`in_ab_s1` = '$in_ab_s1',
			`in_ab_s2` = '$in_ab_s2',
			`in_ac_co` = '$in_ac_co',
			`in_ac_pi` = '$in_ac_pi',
			`in_ac_pu` = '$in_ac_pu',
			`in_ac_te` = '$in_ac_te',
			`in_ac_ve` = '$in_ac_ve',
			`in_ad_co` = '$in_ad_co',
			`in_ad_em` = '$in_ad_em',
			`in_ad_ex` = '$in_ad_ex',
			`in_ad_po` = '$in_ad_po',
			`in_ad_pu` = '$in_ad_pu',
			`in_am_am` = '$in_am_am',
			`in_am_as` = '$in_am_as',
			`in_am_bc` = '$in_am_bc',
			`in_am_ca` = '$in_am_ca',
			`in_am_ga` = '$in_am_ga',
			`in_am_gi` = '$in_am_gi',
			`in_am_gu` = '$in_am_gu',
			`in_am_ju` = '$in_am_ju',
			`in_am_ot` = '$in_am_ot',
			`in_am_pa` = '$in_am_pa',
			`in_am_pi` = '$in_am_pi',
			`in_am_pt` = '$in_am_pt',
			`in_am_rr` = '$in_am_rr',
			`in_am_sa` = '$in_am_sa',
			`in_am_sb` = '$in_am_sb',
			`in_am_sp` = '$in_am_sp',
			`in_am_sr` = '$in_am_sr',
			`in_ar_ii` = '$in_ar_ii',
			`in_ar_it` = '$in_ar_it',
			`in_co_an` = '$in_co_an',
			`in_co_ba` = '$in_co_ba',
			`in_co_bs` = '$in_co_bs',
			`in_co_d1` = '$in_co_d1',
			`in_co_d2` = '$in_co_d2',
			`in_co_j1` = '$in_co_j1',
			`in_co_j2` = '$in_co_j2',
			`in_co_mt` = '$in_co_mt',
			`in_co_ni` = '$in_co_ni',
			`in_co_p1` = '$in_co_p1',
			`in_co_p2` = '$in_co_p2',
			`in_co_te` = '$in_co_te',
			`in_de_ac` = '$in_de_ac',
			`in_de_b2` = '$in_de_b2',
			`in_de_ba` = '$in_de_ba',
			`in_de_bi` = '$in_de_bi',
			`in_de_bj` = '$in_de_bj',
			`in_de_bo` = '$in_de_bo',
			`in_de_bv` = '$in_de_bv',
			`in_de_cb` = '$in_de_cb',
			`in_de_cc` = '$in_de_cc',
			`in_de_ch` = '$in_de_ch',
			`in_de_cl` = '$in_de_cl',
			`in_de_co` = '$in_de_co',
			`in_de_cr` = '$in_de_cr',
			`in_de_de` = '$in_de_de',
			`in_de_ds` = '$in_de_ds',
			`in_de_du` = '$in_de_du',
			`in_de_dv` = '$in_de_dv',
			`in_de_es` = '$in_de_es',
			`in_de_j1` = '$in_de_j1',
			`in_de_j2` = '$in_de_j2',
			`in_de_ja` = '$in_de_ja',
			`in_de_je` = '$in_de_je',
			`in_de_la` = '$in_de_la',
			`in_de_oa` = '$in_de_oa',
			`in_de_ot` = '$in_de_ot',
			`in_de_pa` = '$in_de_pa',
			`in_de_pe` = '$in_de_pe',
			`in_de_po` = '$in_de_po',
			`in_de_s1` = '$in_de_s1',
			`in_de_s2` = '$in_de_s2',
			`in_de_s3` = '$in_de_s3',
			`in_de_sa` = '$in_de_sa',
			`in_de_te` = '$in_de_te',
			`in_de_ti` = '$in_de_ti',
			`in_de_wa` = '$in_de_wa',
			`in_di_de` = '$in_di_de',
			`in_di_di` = '$in_di_di',
			`in_di_mu` = '$in_di_mu',
			`in_di_pa` = '$in_di_pa',
			`in_di_re` = '$in_di_re',
			`in_di_zo` = '$in_di_zo',
			`in_e1_ce` = '$in_e1_ce',
			`in_e1_no` = '$in_e1_no',
			`in_e1_t1` = '$in_e1_t1',
			`in_e1_t2` = '$in_e1_t2',
			`in_e2_ce` = '$in_e2_ce',
			`in_e2_no` = '$in_e2_no',
			`in_e2_t1` = '$in_e2_t1',
			`in_e2_t2` = '$in_e2_t2',
			`in_fi_cn` = '$in_fi_cn',
			`in_fi_cp` = '$in_fi_cp',
			`in_fi_en` = '$in_fi_en',
			`in_fi_es` = '$in_fi_es',
			`in_fi_pl` = '$in_fi_pl',
			`in_fi_sn` = '$in_fi_sn',
			`in_fi_ta` = '$in_fi_ta',
			`in_in_aa` = '$in_in_aa',
			`in_in_al` = '$in_in_al',
			`in_in_bl` = '$in_in_bl',
			`in_in_bm` = '$in_in_bm',
			`in_in_ca` = '$in_in_ca',
			`in_in_cb` = '$in_in_cb',
			`in_in_cm` = '$in_in_cm',
			`in_in_cs` = '$in_in_cs',
			`in_in_ct` = '$in_in_ct',
			`in_in_db` = '$in_in_db',
			`in_in_eb` = '$in_in_eb',
			`in_in_ee` = '$in_in_ee',
			`in_in_et` = '$in_in_et',
			`in_in_io` = '$in_in_io',
			`in_in_ld` = '$in_in_ld',
			`in_in_lm` = '$in_in_lm',
			`in_in_lv` = '$in_in_lv',
			`in_in_ps` = '$in_in_ps',
			`in_in_re` = '$in_in_re',
			`in_in_sd` = '$in_in_sd',
			`in_ma_cu` = '$in_ma_cu',
			`in_ma_in` = '$in_ma_in',
			`in_mante` = '$in_mante',
			`in_por_r` = '$in_por_r',
			`in_se_ag` = '$in_se_ag',
			`in_se_ba` = '$in_se_ba',
			`in_se_li` = '$in_se_li',
			`in_se_lu` = '$in_se_lu',
			`in_se_se` = '$in_se_se',
			`in_ab_yo` = '$in_ab_yo',
			`in_estat` = '$in_estat',
			`in_us_po` = '$in_us_po',
			`in_fe_in` = '$in_fe_in',
			`in_am_of` = '$in_am_of',
			`in_am_bo` = '$in_am_bo',
			`in_am_lo` = '$in_am_lo'
			WHERE `si_properties`.`in_mu_id` = '$id'
			");
			
			//ALMACENA_VARIAS_FOTOS
			//if (isset($_FILES["archivo"]))
			if (isset($_POST['subir'])) 
			{
				$in_munum = 0;
				$reporte  = null;
				if($foto_est == 1) {system('RMDIR /S /Q "'."../assets/images/propiedades/$in_mu_id".'"');} //ELIMINA CARPETA COMPLETA
				mkdir ("../assets/images/propiedades/$in_mu_id", 0777); 			   					   //CREA CARPETA

				for ($x = 0; $x < count($_FILES["archivo"]["name"]); $x++) 
				{
					$in_munum = $in_munum + 1;
					$file = $_FILES["archivo"];
					$nombre = $file["name"][$x];
					$tipo = $file["type"][$x];
					$ruta_provisional = $file["tmp_name"][$x];
					$size = $file["size"][$x];
					$dimensiones = getimagesize($ruta_provisional);
					$width  = $dimensiones[0];
					$height = $dimensiones[1];

					$carpeta  = "../assets/images/propiedades/" . $in_mu_id . "/";
					$nombre =  $in_munum . ".jpg";

					if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif') 
					{
						$reporte .= "<p style='color: red'>Error $nombre, el archivo no es una imagen.</p>";
					} 
					else 
					{
						$src = $carpeta . $nombre;
						move_uploaded_file($ruta_provisional, $src);
						//chmod('../assets/images/propiedades/'.($in_mu_id).'/'.($nombre), 0777);
					}
				}
			}

	//MENSAJERÍA Y CORREO ------------------------------------
	if ($in_ad_pu == 1 ) 
	{
			//CONSULTA ASOCIADO
			$query = mysqli_query( $con, "SELECT * FROM `si_users` WHERE `id_users`= '".$in_vende."' " );
			$count_asoc = mysqli_num_rows($query);
			$ferow = mysqli_fetch_array($query);
			if ($count_asoc > 0) 
			{
				$asoc_id_users = $ferow['id_users'];
				$asoc_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
				$asoc_correo_e = $ferow['usermail'];
			}

			//CONSULTA PROPIETARIO
			$query = mysqli_query( $con, "SELECT * FROM `si_users` WHERE `id_users`= '".$in_nombr."' " );
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
		$messag_txt = "Se ha MODIFICADO la propiedad COD: ".$in_mu_id.". Agente: " .$asoc_usernomb. ". Propietario: " . $prop_usernomb; //Mensaje
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
														<td style="width:458px"><h2><span style="font-size:18px"><span style="font-family:trebuchet ms,helvetica,sans-serif"><strong>Se han actualizado los datos</strong></span></span></h2></td>
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

			//REDIRECCIONA
			?> <script type="text/javascript">
				window.location.replace("propiedad_view.php?id=<?php echo $id; ?>");
			</script> 
			<?php
			?>

			<!-- MENSAJES EN PANTALLA -->
			<div style="position: fixed;top: 115px; left: 50%; z-index: 1500;">
				<div id="toastregistrosGuardados" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header bg-success text-white">
						<strong class="mr-auto">Aviso!</strong>
						<script type="text/javascript">
							alert( "<?php echo $in_titul. " DATOS ACTUALIZADOS... "; ?>" );
						</script>

						<button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="toast-body bg-light text-success">
						Se almacenaron los datos de: <?php echo $_POST['in_titul']; ?>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function() {
					// $("#myToast").toast('show');
					$("#toastregistrosGuardados").toast({ delay: 5000 });
					$("#toastregistrosGuardados").toast('show');
					window.location.replace("propiedad_edit.php");
				});
			</script>

			<?php
			echo " " . mysqli_error($con);
		}
	}
	else
	{
		echo " " . mysqli_error($con);
	}   //FIN ALMACENA EN BASE DE DATOS 
?>

<!DOCTYPE html>
<!-- 
BackEnd:  Gustavo Blanco
FrontEnd: Erick Robledo
Web:      sistemagnet.xyz
Blog:     chofo7.blogspot.com
Mail:     chofo7@gmail.com
-->
<html lang="es">

<head>
	<?php include 'include/head.php';?>
	<link type="text/css" rel="stylesheet" href="../assets/css/lightslider.css" />
	<link type="text/css" rel="stylesheet" href="../assets/css/lightgallery.css" />
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php';?>
	<div class="contenedor bg-light" id="contenedor">
	<div class="container-fluid bg-primary bg-blue-gradient ">
	</div>
		
	<!-- CONTENEDOR FONDO -->
	<div class="container-fluid p-5">
	<section class="content p-5 rounded shadow" id="contentBox">

	<!-- BODY -->
	<div class="container-fluid">

		<!-- FORMULARIO INGRESO -->
		<form action="propiedad_edit.php?id=<?php echo $in_mu_id; ?>" method="POST" role="form" class="f1 pt-0 pb-0 p-0" autocomplete="off" enctype="multipart/form-data" />

			<h3>Formulario (EDITAR) Propiedad</h3>
			<p>Propiedad - COD: <input type="text" name="in_mu_id" size="5" value="<?php echo $in_mu_id; ?>" disabled></p>
			
			<!-- ETIQUETAS DE SECCION -->
			<div class="f1-steps">
				<div class="f1-progress">
					<div class="f1-progress-line" data-now-value="12.5" data-number-of-steps="4" style="width: 12.5%;">
					</div>
				</div>

				<div class="f1-step active">
					<div class="f1-step-icon"><i class="fa fa-building"></i></div>
					<p>Inmueble</p>
				</div>
				<div class="f1-step">
					<div class="f1-step-icon"><i class="fas fa-list-alt"></i></div>
					<p>Detalles</p>
				</div>
				<div class="f1-step">
					<div class="f1-step-icon"><i class="fas fa-store-alt"></i></div>
					<p>Amenidades</p>
				</div>
				<div class="f1-step">
					<div class="f1-step-icon"><i class="fas fa-clipboard-list"></i></div>
					<p>Arbitrios</p>
				</div>
			</div>

			<!-- SECCION INMUEBLE -->
			<fieldset>
				<h6 class="mt-3 mb-3">Ingresa los datos del inmueble:</h6>
				<div class="row">

					<!-- TITULO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-6 order-xl-1 order-md-1 ">
						<span class="fas fa-tags form-control-feedback mirror"></span>
						<textarea type="text" class="form-control" name="in_titul" placeholder="Casa Espectacular en Las Alturas" rows="1"><?php echo $in_titul; ?></textarea>
						<label class="label-form-control" for="in_titul">Título de la Propiedad:</label>
					</div>

					<!-- TIPO_PROPIEAD -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-2 order-md-3 ">
						<span class="fas fa-building form-control-feedback"></span>
						<select class="form-control" name="in_tip_p">
							<option value="1"  <?php if($in_tip_p==1) {echo "selected";} ?>>Casas</option>
							<option value="2"  <?php if($in_tip_p==2) {echo "selected";} ?>>Apartamentos</option>
							<option value="3"  <?php if($in_tip_p==3) {echo "selected";} ?>>Oficinas</option>
							<option value="4"  <?php if($in_tip_p==4) {echo "selected";} ?>>Bodegas</option>
							<option value="5"  <?php if($in_tip_p==5) {echo "selected";} ?>>Terrenos</option>
							<option value="6"  <?php if($in_tip_p==6) {echo "selected";} ?>>Fincas</option>
							<option value="7"  <?php if($in_tip_p==7) {echo "selected";} ?>>Clinicas</option>
							<option value="8"  <?php if($in_tip_p==8) {echo "selected";} ?>>Casa de playa</option>
							<option value="9"  <?php if($in_tip_p==9) {echo "selected";} ?>>Granjas</option>
							<option value="10" <?php if($in_tip_p==10){echo "selected";} ?>>Edificios</option>
							<option value="11" <?php if($in_tip_p==11){echo "selected";} ?>>Locales</option>
						</select>
						<label class="label-form-control" for="in_tip_p">Tipo:</label>
					</div>

					<!-- PROPIETARIO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-user form-control-feedback"></span>
						<input list="propietario" class="form-control" name="in_nombr" placeholder="Propietario / Proyecto" value="<?php echo $in_nombr; ?>"/>
						<datalist class="form-control d-none" id="propietario">
							<?php
							//CONSULTA PROPIETARIOS 
							$query = mysqli_query($con,"SELECT * FROM `si_users` WHERE `usertipe`= 5 or `usertipe`= 7 and `userstat`=1 ORDER BY `id_users` DESC ");
							$count_prop = mysqli_num_rows($query);
							$ferow = mysqli_fetch_array($query);
							if ($count_prop > 0) {
								$prop_id_users = $ferow['id_users'];
								$prop_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $prop_id_users; ?>"><?php echo $prop_id_users . " - " . utf8_encode($prop_usernomb); ?></option>
							<?php
							}
							for ($i = 1; $i <= $count_prop - 1; $i++) {
								$ferow = mysqli_fetch_array($query);
								$prop_id_users = $ferow['id_users'];
								$prop_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $prop_id_users; ?>"><?php echo $prop_id_users . " - " . utf8_encode($prop_usernomb); ?></option>
							<?php
							}
							?>
						</datalist>
						<label class="label-form-control" for="in_nombr">Propietario:</label>
					</div>

					<!-- CONVERSION_DOLARES_VENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-4 order-md-2 " id="contenedor">
						<span class="fas fa-dollar-sign    form-control-feedback"></span>
						<input type="text" name="in_pre_v" class="dolar form-control input-number-style" placeholder="Precio Venta ($)" 
						value="<?php if($in_pre_v > 1) {echo $in_pre_v;} ?>"/>

						<input type="hidden" name="tasa1" class="tasa  form-control" value="7.71" />
						<label class="label-form-control" for="in_pre_v">Precio de Venta ($):</label>
					</div>

					<!-- CONVERSION_QUETZALES_VENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-4 order-md-2 " id="contenedor">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" name="quetz1" class="quetz form-control input-number-style" placeholder="Precio Venta (Q)" />

						<input type="hidden" name="tasa1" class="tasa  form-control" value="7.71" />
						<label class="label-form-control" for="in_pre_v">Precio de Venta (Q):</label>
					</div>

					<!-- CONVERSION_DOLARES_RENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-8 order-md-2 " id="contenedor">
						<span class="fas fa-dollar-sign    form-control-feedback"></span>
						<input type="text" name="in_pre_r" class="dolar form-control" placeholder="Precio Renta ($)" 
						value="<?php if($in_pre_r > 1) {echo $in_pre_r;} ?>"/>

						<input type="hidden" name="tasa2" class="tasa  form-control" value="7.71" />
						<label class="label-form-control" for="in_pre_r">Precio de Renta ($):</label>
					</div>

					<!-- CONVERSION_DOLARES_RENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-8 order-md-2 " id="contenedor">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" name="quetz2" class="quetz form-control input-number-style" placeholder="Precio Renta (Q)" />

						<input type="hidden" name="tasa2" class="tasa  form-control" value="7.71" />
						<label class="label-form-control" for="in_pre_r">Precio de Renta (Q):</label>
					</div>

					<!-- PORCENTAJE_HONORARIOS_VENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-6 order-md-6">
						<span class="fa fa-percent form-control-feedback"></span>
						<input type="text" class="form-control" name="in_porce" placeholder="Honorarios" 
						value="<?php if($in_porce > 1) {echo $in_porce;} ?>"/>
						<label class="label-form-control" for="in_porce">Honorarios (Venta):</label>
					</div>

					<!-- PORCENTAJE_HONORARIOS_RENTA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-9 order-md-6">
						<span class="fa fa-percent form-control-feedback"></span>
						<input type="text" class="form-control" name="in_por_r" placeholder="Honorarios" 
						value="<?php if($in_por_r > 1) {echo $in_por_r;} ?>"/>
						<label class="label-form-control" for="in_por_r">Honorarios (Renta):</label>
					</div>

					<!-- ESTADO PROPIEDAD -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-10 order-md-6">
						<span class="fas fa-building form-control-feedback"></span>
						<select class="form-control" name="in_estat">
							<option value="0"  <?php if($in_estat==0) {echo "selected";} ?>>Activa (Venta / Renta)</option>	
							<option value="1"  <?php if($in_estat==1) {echo "selected";} ?>>Vendida</option>
							<option value="2"  <?php if($in_estat==2) {echo "selected";} ?>>Rentada</option>
						</select>
						<label class="label-form-control" for="in_estat">Estado:</label>
					</div>

					<!-- ASOCIADO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-7 order-md-7 ">
						<span class="fas fa-user-tie form-control-feedback"></span>
						<input list="in_vend1" class="form-control" name="in_vende" placeholder="Asociado Interno" 
						value="<?php echo $in_vende; ?>"/>
						<datalist class="form-control d-none" id="in_vend1">
							<?php
							//CONSULTA ASOCIADOS 
							$query = mysqli_query(
								$con,
								"SELECT * FROM `si_users` WHERE `usertipe`= 3 and `userstat`=1 ORDER BY `id_users` DESC "
							);
							$count_asoc = mysqli_num_rows($query);
							$ferow = mysqli_fetch_array($query);
							if ($count_asoc > 0) {
								$asoc_id_users = $ferow['id_users'];
								$asoc_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $asoc_id_users; ?>"><?php echo $asoc_id_users . " - " . utf8_encode($asoc_usernomb); ?></option>
							<?php
							}
							for ($i = 1; $i <= $count_asoc - 1; $i++) {
								$ferow = mysqli_fetch_array($query);
								$asoc_id_users = $ferow['id_users'];
								$asoc_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $asoc_id_users; ?>"><?php echo $asoc_id_users . " - " . utf8_encode($asoc_usernomb); ?></option>
							<?php
							}
							?>
						</datalist>
						<label class="label-form-control" for="in_vende">Asociado Interno:</label>
					</div>

					<!-- PAIS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-map form-control-feedback"></span>
						<input list="pais" class="form-control" name="in_di_pa" placeholder="Pais" 
						value="<?php echo $in_di_pa; ?>"/>
						<datalist class="form-control d-none" id="pais">
							<option value="1">Guatemala</option>
							<option value="2">Estados Unidos</option>
							<option value="3">Mexico</option>
							<option value="4">El Salvador</option>
							<option value="5">Honduras</option>
							<option value="6">Nicaragua</option>
							<option value="7">Costa Rica</option>
							<option value="8">Panamá</option>
						</datalist>
						<label class="label-form-control" for="in_di_pa">País:</label>
					</div>

					<!-- DEPARTAMENTO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-map-signs form-control-feedback"></span>
						<input list="departamento" class="form-control" name="in_di_de" placeholder="Departamento" 
						value="<?php echo $in_di_de; ?>"/>
						<datalist class="form-control d-none" id="departamento">
							<option value="1">Alta Verapaz</option>
							<option value="2">Baja Verapaz</option>
							<option value="3">Chimaltenango</option>
							<option value="4">Chiquimula</option>
							<option value="5">El Progreso</option>
							<option value="6">Escuintla</option>
							<option value="7">Guatemala</option>
							<option value="8">Huehuetenango</option>
							<option value="9">Izabal</option>
							<option value="10">Jalapa</option>
							<option value="11">Jutiapa</option>
							<option value="12">Petén</option>
							<option value="13">Quetzaltenango</option>
							<option value="14">Quiché</option>
							<option value="15">Retalhuleu</option>
							<option value="16">Sacatepéquez</option>
							<option value="17">San Marcos</option>
							<option value="18">Santa Rosa</option>
							<option value="19">Sololá</option>
							<option value="20">Suchitepéquez</option>
							<option value="21">Totonicapán</option>
							<option value="22">Zacapa</option>
						</datalist>
						<label class="label-form-control" for="in_di_de">Departamento:</label>
					</div>

					<!-- MUNICIPIO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-map-marker form-control-feedback"></span>
						<input list="municipio" class="form-control" name="in_di_mu" placeholder="Municipio" 
						value="<?php echo $in_di_mu; ?>"/>
						<datalist class="form-control d-none" id="municipio">
							<option value="1">Cobán</option>
							<option value="2">Santa Cruz Verapaz</option>
							<option value="3">San Cristóbal Verapaz</option>
							<option value="4">Tactic</option>
							<option value="5">Tamahú</option>
							<option value="6">San Miguel Tucurú</option>
							<option value="7">Panzóz</option>
							<option value="8">Senahú</option>
							<option value="9">San Pedro Carchá</option>
							<option value="10">San Juan Chamelco</option>
							<option value="11">San Agustín Lanquín</option>
							<option value="12">Santa María Cahabón</option>
							<option value="13">Chisec</option>
							<option value="14">Chahal</option>
							<option value="15">Fray Bartolomé de las Casas</option>
							<option value="16">Santa Catalina La Tinta</option>
							<option value="17">Raxruhá</option>

							<option value="18">Salamá</option>
							<option value="19">San Miguel Chicaj</option>
							<option value="20">Rabinal</option>
							<option value="21">Cubulco</option>
							<option value="22">Granados</option>
							<option value="23">Santa Cruz el Chol</option>
							<option value="24">San Jerónimo</option>
							<option value="25">Purulhá</option>

							<option value="26">Chimaltenango</option>
							<option value="27">San José Poaquil</option>
							<option value="28">San Martín Jilotepeque</option>
							<option value="29">San Juan Comalapa</option>
							<option value="30">Santa Apolonia</option>
							<option value="31">Tecpán</option>
							<option value="32">Patzún</option>
							<option value="33">San Miguel Pochuta</option>
							<option value="34">Patzicía</option>
							<option value="35">Santa Cruz Balanyá</option>
							<option value="36">Acatenango</option>
							<option value="37">San Pedro Yepocapa</option>
							<option value="38">San Andrés Itzapa</option>
							<option value="39">Parramos</option>
							<option value="40">Zaragoza</option>
							<option value="41">El Tejar</option>

							<option value="42">Chiquimula</option>
							<option value="43">Jocotán</option>
							<option value="44">Esquipulas</option>
							<option value="45">Camotán</option>
							<option value="46">Quezaltepeque</option>
							<option value="47">Olopa</option>
							<option value="48">Ipala</option>
							<option value="49">San Juan Hermita</option>
							<option value="50">Concepción Las Minas</option>
							<option value="51">San Jacinto</option>
							<option value="52">San José la Arada</option>

							<option value="53">Flores</option>
							<option value="54">San José</option>
							<option value="55">San Benito</option>
							<option value="56">San Andrés</option>
							<option value="57">La Libertad</option>
							<option value="58">San Francisco</option>
							<option value="59">Santa Ana</option>
							<option value="60">Dolores</option>
							<option value="61">San Luis</option>
							<option value="62">Sayaxché</option>
							<option value="63">Melchor de Mencos</option>
							<option value="64">Poptún</option>

							<option value="65">El Jícaro</option>
							<option value="66">Morazán</option>
							<option value="67">San Agustín Acasaguastlán</option>
							<option value="68">San Antonio La Paz</option>
							<option value="69">San Cristóbal Acasaguastlán</option>
							<option value="70">Sanarate</option>
							<option value="71">Guastatoya</option>
							<option value="72">Sansare</option>

							<option value="73">Santa Cruz del Quiché</option>
							<option value="74">Chiché</option>
							<option value="75">Chinique</option>
							<option value="76">Zacualpa</option>
							<option value="77">Chajul</option>
							<option value="78">Santo Tomás Chichicastenango</option>
							<option value="79">Patzité</option>
							<option value="80">San Antonio Ilotenango</option>
							<option value="81">San Pedro Jocopilas</option>
							<option value="82">Cunén</option>
							<option value="83">San Juan Cotzal</option>
							<option value="84">Santa María Joyabaj</option>
							<option value="85">Santa María Nebaj</option>
							<option value="86">San Andrés Sajcabajá</option>
							<option value="87">Uspantán</option>
							<option value="88">Sacapulas</option>
							<option value="89">San Bartolomé Jocotenango</option>
							<option value="90">Canillá</option>
							<option value="91">Chicamán</option>
							<option value="92">Ixcán</option>
							<option value="93">Pachalum</option>

							<option value="94">Escuintla</option>
							<option value="95">Santa Lucía Cotzumalguapa</option>
							<option value="96">La Democracia</option>
							<option value="97">Siquinalá</option>
							<option value="98">Masagua</option>
							<option value="99">Tiquisate</option>
							<option value="100">La Gomera</option>
							<option value="101">Guaganazapa</option>
							<option value="102">San José</option>
							<option value="103">Iztapa</option>
							<option value="104">Palín</option>
							<option value="105">San Vicente Pacaya</option>
							<option value="106">Nueva Concepción</option>

							<option value="107">Santa Catarina Pinula</option>
							<option value="108">San José Pinula</option>
							<option value="109">Guatemala</option>
							<option value="110">San José del Golfo</option>
							<option value="111">Palencia</option>
							<option value="112">Chinautla</option>
							<option value="113">San Pedro Ayampuc</option>
							<option value="114">Mixco</option>
							<option value="115">San Pedro Sacatapéquez</option>
							<option value="116">San Juan Sacatepéquez</option>
							<option value="117">Chuarrancho</option>
							<option value="118">San Raymundo</option>
							<option value="119">Fraijanes</option>
							<option value="120">Amatitlán</option>
							<option value="121">Villa Nueva</option>
							<option value="122">Villa Canales</option>
							<option value="123">San Miguel Petapa</option>

							<option value="124">Huehuetenango</option>
							<option value="125">Chiantla</option>
							<option value="126">Malacatancito</option>
							<option value="127">Cuilco</option>
							<option value="128">Nentón</option>
							<option value="129">San Pedro Necta</option>
							<option value="130">Jacaltenango</option>
							<option value="131">Soloma</option>
							<option value="132">Ixtahuacán</option>
							<option value="133">Santa Bárbara</option>
							<option value="134">La Libertad</option>
							<option value="135">La Democracia</option>
							<option value="136">San Miguel Acatán</option>
							<option value="137">San Rafael La Independencia</option>
							<option value="138">Todos Santos Cuchumatán</option>
							<option value="139">San Juan Atitlán</option>
							<option value="140">Santa Eulalia</option>
							<option value="141">San Mateo Ixtatán</option>
							<option value="142">Colotenango</option>
							<option value="143">San Sebastián Huehuetenango</option>
							<option value="144">Tectitán</option>
							<option value="145">Concepción Huista</option>
							<option value="146">San Juan Ixcoy</option>
							<option value="147">San Antonio Huista</option>
							<option value="148">Santa Cruz Barillas</option>
							<option value="149">San Sebastián Coatán</option>
							<option value="150">Aguacatán</option>
							<option value="151">San Rafael Petzal</option>
							<option value="152">San Gaspar Ixchil</option>
							<option value="153">Santiago Chimaltenango</option>
							<option value="154">Santa Ana Huista</option>

							<option value="155">Morales</option>
							<option value="156">Los Amates</option>
							<option value="157">Livingston</option>
							<option value="158">El Estor</option>
							<option value="159">Puerto Barrios</option>

							<option value="160">Jalapa</option>
							<option value="161">San Pedro Pinula</option>
							<option value="162">San Luis Jilotepeque</option>
							<option value="163">San Manuel Chaparrón</option>
							<option value="164">San Carlos Alzatate</option>
							<option value="165">Monjas</option>
							<option value="166">Mataquescuintla</option>

							<option value="167">Jutiapa</option>
							<option value="168">El Progreso</option>
							<option value="169">Santa Catarina Mita</option>
							<option value="170">Agua Blanca</option>
							<option value="171">Asunción Mita</option>
							<option value="172">Yupiltepeque</option>
							<option value="173">Atescatempa</option>
							<option value="174">Jerez</option>
							<option value="175">El Adelanto</option>
							<option value="176">Zapotitlán</option>
							<option value="177">Comapa</option>
							<option value="178">Jalpatagua</option>
							<option value="179">Conguaco</option>
							<option value="180">Moyuta</option>
							<option value="181">Pasaco</option>
							<option value="182">Quesada</option>

							<option value="183">Quetzaltenango</option>
							<option value="184">Salcajá</option>
							<option value="185">Olintepeque</option>
							<option value="186">San Carlos Sija</option>
							<option value="187">Sibilia</option>
							<option value="188">Cabricán</option>
							<option value="189">Cajolá</option>
							<option value="190">San Miguel Sigüilá</option>
							<option value="191">San Juan Ostuncalco</option>
							<option value="192">San Mateo</option>
							<option value="193">Concepción Chiquirichapa</option>
							<option value="194">San Martín Sacatepéquez</option>
							<option value="195">Almolonga</option>
							<option value="196">Cantel</option>
							<option value="197">Huitán</option>
							<option value="198">Zunil</option>
							<option value="199">Colomba</option>
							<option value="200">San Francisco La Unión</option>
							<option value="201">El Palmar</option>
							<option value="202">Coatepeque</option>
							<option value="203">Génova</option>
							<option value="204">Flores Costa Cuca</option>
							<option value="205">La Esperanza</option>
							<option value="206">Palestina de Los Altos</option>

							<option value="207">Retalhuleu</option>
							<option value="208">San Sebastián</option>
							<option value="209">Santa Cruz Muluá</option>
							<option value="210">San Martín Zapotitlán</option>
							<option value="211">San Felipe</option>
							<option value="212">San Andrés Villa Seca</option>
							<option value="213">Champerico</option>
							<option value="214">Nuevo San Carlos</option>
							<option value="215">El Asintal</option>

							<option value="216">Alotenango</option>
							<option value="217">Antigua Guatemala</option>
							<option value="218">Ciudad Vieja</option>
							<option value="219">Jocotenango</option>
							<option value="220">Magdalena Milpas Altas</option>
							<option value="221">Pastores</option>
							<option value="222">San Antonio Aguas Calientes</option>
							<option value="223">San Bartolomé Milpas Altas</option>
							<option value="224">San Lucas Sacatepéquez</option>
							<option value="225">San Miguel Dueñas</option>
							<option value="226">Santa Catarina Barahona</option>
							<option value="227">Santa Lucía Milpas Altas</option>
							<option value="228">Santa María de Jesús</option>
							<option value="229">Santiago Sacatepéquez</option>
							<option value="230">Santo Domingo Xenacoj</option>
							<option value="231">Sumpango</option>

							<option value="232">San Marcos</option>
							<option value="233">Ayutla</option>
							<option value="234">Catarina</option>
							<option value="235">Comitancillo</option>
							<option value="236">Concepción Tutuapa</option>
							<option value="237">El Quetzal</option>
							<option value="238">El Rodeo</option>
							<option value="239">El Tumblador</option>
							<option value="240">Ixchiguán</option>
							<option value="241">La Reforma</option>
							<option value="242">Malacatán</option>
							<option value="243">Nuevo Progreso</option>
							<option value="244">Ocós</option>
							<option value="245">Pajapita</option>
							<option value="246">Esquipulas Palo Gordo</option>
							<option value="247">San Antonio Sacatepéquez</option>
							<option value="248">San Cristóbal Cucho</option>
							<option value="249">San José Ojetenam</option>
							<option value="250">San Lorenzo</option>
							<option value="251">San Miguel Ixtahuacán</option>
							<option value="252">San Pablo</option>
							<option value="253">San Pedro Sacatepéquez</option>
							<option value="254">San Rafael Pie de la Cuesta</option>
							<option value="255">Sibinal</option>
							<option value="256">Sipacapa</option>
							<option value="257">Tacaná</option>
							<option value="258">Tajumulco</option>
							<option value="259">Tejutla</option>
							<option value="260">Río Blanco</option>
							<option value="261">La Blanca</option>

							<option value="262">Cuilapa</option>
							<option value="263">Casillas Santa Rosa</option>
							<option value="264">Chiquimulilla</option>
							<option value="265">Guazacapán</option>
							<option value="266">Nueva Santa Rosa</option>
							<option value="267">Oratorio</option>
							<option value="268">Pueblo Nuevo Viñas</option>
							<option value="269">San Juan Tecuaco</option>
							<option value="270">San Rafael Las Flores</option>
							<option value="271">Santa Cruz Naranjo</option>
							<option value="272">Santa María Ixhuatán</option>
							<option value="273">Santa Rosa de Lima</option>
							<option value="274">Taxisco</option>
							<option value="275">Barberena</option>

							<option value="276">Sololá</option>
							<option value="277">Concepción</option>
							<option value="278">Nahualá</option>
							<option value="279">Panajachel</option>
							<option value="280">San Andrés Semetabaj</option>
							<option value="281">San Antonio Palopó</option>
							<option value="282">San José Chacayá</option>
							<option value="283">San Juan La Laguna</option>
							<option value="284">San Lucas Tolimán</option>
							<option value="285">San Marcos La Laguna</option>
							<option value="286">San Pablo La Laguna</option>
							<option value="287">San Pedro La Laguna</option>
							<option value="288">Santa Catarina Ixtahuacán</option>
							<option value="289">Santa Catarina Palopó</option>
							<option value="290">Santa Clara La Laguna</option>
							<option value="291">Santa Cruz La Laguna</option>
							<option value="292">Santa Lucía Utatlán</option>
							<option value="293">Santa María Visitación</option>
							<option value="294">Santiago Atitlán</option>

							<option value="295">Mazatenango</option>
							<option value="296">Cuyotenango</option>
							<option value="297">San Francisco Zapotitlán</option>
							<option value="298">San Bernardino</option>
							<option value="299">San José El Ídolo</option>
							<option value="300">Santo Domingo Suchitépequez</option>
							<option value="301">San Lorenzo</option>
							<option value="302">Samayac</option>
							<option value="303">San Pablo Jocopilas</option>
							<option value="304">San Antonio Suchitépequez</option>
							<option value="305">San Miguel Panán</option>
							<option value="306">San Gabriel</option>
							<option value="307">Chicacao</option>
							<option value="308">Patulul</option>
							<option value="309">Santa Bárbara</option>
							<option value="310">San Juan Bautista</option>
							<option value="311">Santo Tomás La Unión</option>
							<option value="312">Zunilito</option>
							<option value="313">Pueblo Nuevo</option>
							<option value="314">Río Bravo</option>

							<option value="315">Totonicapán</option>
							<option value="316">San Cristóbal Totonicapán</option>
							<option value="317">San Francisco El Alto</option>
							<option value="318">San Andrés Xecul</option>
							<option value="319">Momostenango</option>
							<option value="320">Santa María Chiquimula</option>
							<option value="321">Santa Lucía La Reforma</option>
							<option value="322">San Bartolo</option>

							<option value="323">Cabañas</option>
							<option value="324">Estanzuela</option>
							<option value="325">Gualán</option>
							<option value="326">Huité</option>
							<option value="327">La Unión</option>
							<option value="328">Río Hondo</option>
							<option value="329">San Jorge</option>
							<option value="330">San Diego</option>
							<option value="331">Teculután</option>
							<option value="332">Usumatlán</option>
							<option value="333">Zacapa</option>
						</datalist>
						<label class="label-form-control" for="in_di_mu">Municipio:</label>
					</div>

					<!-- ZONA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-street-view form-control-feedback"></span>
						<input list="zona" class="form-control" name="in_di_zo" placeholder="Zona" 
						value="<?php echo $in_di_zo; ?>"/>
						<datalist class="form-control d-none" id="zona">
							<option value="1">Zona 1</option>
							<option value="2">Zona 2</option>
							<option value="3">Zona 3</option>
							<option value="4">Zona 4</option>
							<option value="5">Zona 5</option>
							<option value="6">Zona 6</option>
							<option value="7">Zona 7</option>
							<option value="8">Zona 8</option>
							<option value="9">Zona 9</option>
							<option value="10">Zona 10</option>
							<option value="11">Zona 11</option>
							<option value="12">Zona 12</option>
							<option value="13">Zona 13</option>
							<option value="14">Zona 14</option>
							<option value="15">Zona 15</option>
							<option value="16">Zona 16</option>
							<option value="17">Zona 17</option>
							<option value="18">Zona 18</option>
							<option value="19">Zona 19</option>
							<option value="20">Zona 20</option>
							<option value="21">Zona 21</option>
							<option value="22">Zona 22</option>
							<option value="23">Zona 23</option>
							<option value="24">Zona 24</option>
							<option value="25">Zona 25</option>
						</datalist>
						<label class="label-form-control" for="in_di_zo">Zona:</label>
					</div>

					<!-- AREA/REGION -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-location-arrow form-control-feedback"></span>
						<input list="area" class="form-control" name="in_di_re" placeholder="Area o Región" 
						value="<?php echo $in_di_re; ?>"/>
						<datalist class="form-control d-none" id="area">
							<option value="1">Ciudad de Guatemala</option>
							<option value="2">Antigua Guatemala</option>
							<option value="3">Alta Verapaz</option>
							<option value="4">Atitlan</option>
							<option value="5">Amatitlan</option>
							<option value="6">Carretera al Salvador</option>
							<option value="7">Fraijanes</option>
							<option value="8">Chimaltenango</option>
							<option value="9">Escuintla</option>
							<option value="10">Huehuetenango</option>
							<option value="11">Izabal</option>
							<option value="12">Iztapa</option>
							<option value="13">Labor de castilla</option>
							<option value="14">Monterrico</option>
							<option value="15">Muxbal</option>
							<option value="16">Nuevo Viñas</option>
							<option value="17">Puerto de san Jose</option>
							<option value="18">Retalhuleu</option>
							<option value="19">San Cristobal</option>
							<option value="20">San Jose Pinula</option>
							<option value="21">San Lazaro</option>
							<option value="22">San Lucas</option>
							<option value="23">San Miguel Petapa</option>
							<option value="24">Santa Catarina Pinula</option>
							<option value="25">Santa Lucia Cotzumalguapa</option>
							<option value="26">Santa Rosa</option>
							<option value="27">San Lucas</option>
							<option value="28">Sta. Elena Barillas</option>
							<option value="29">Sto. Tomas Milpas Altas</option>
							<option value="30">Villa Canales</option>
							<option value="31">Villa Nueva</option>
							<option value="32">Xela</option>
							<option value="33">Caban</option>
							<option value="34">Juan Gaviota</option>
							<option value="35">Marina del Sur</option>
						</datalist>
						<label class="label-form-control" for="in_di_re">Área o Región:</label>
					</div>

					<!-- DIRECCION -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-3 order-md-4 ">
						<span class="fas fa-map-marker-alt form-control-feedback"></span>
						<input type="text" class="form-control" name="in_di_di" placeholder="Dirección" 
						value="<?php echo $in_di_di; ?>"/>
						<label class="label-form-control" for="in_di_di">Dirección:</label>
					</div>

					<!-- FILL AFTER ADDRESS (RELLENO) -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-6 order-xl-3 order-md-4 ">
					</div>
				</div>

				<h6 class="mt-3 mb-3">Finaciamiento:</h6>
				<div class="row pb-3">

					<!-- FINANCIAMIENTO_S/N -->
					<div class="form-group col-sm-12 col-md-3">
						<label for="mant" class="form-label-options d-none">Finaciamiento:</label>
						<div class="form-group clearfix">
							<div class="icheck-sunflower d-inline pr-2">
								<input type="radio" id="financiamiento1" name="in_fi_sn" value="1" 
								<?php if($in_fi_sn==1) {echo "checked";} ?>/>
								<label for="financiamiento1" class="form-label-options">SI </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="radio" id="financiamiento2" name="in_fi_sn" value="0" 
								<?php if($in_fi_sn==0) {echo "checked";} ?>/>
								<label for="financiamiento2" class="form-label-options">NO </label>
							</div>
						</div>
					</div>

					<!-- ENGANCHE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 ">
						<span class="fas fa-dollar-sign form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_en" placeholder="Enganche ($)" 
						value="<?php if($in_fi_en > 1) {echo $in_fi_en;} ?>"/>
						<label class="label-form-control" for="in_fi_en">Enganche ($):</label>
					</div>

					<!-- ENGANCHE - QUETZALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 ">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_eq" placeholder="Enganche (Q)" 
						value="<?php if($in_fi_eq > 1) {echo $in_fi_eq;} ?>"/>
						<label class="label-form-control" for="in_fi_en">Enganche (Q):</label>
					</div>

					<!-- TASA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 ">
						<span class="fas fa-percent form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_ta" placeholder="Tasa" 
						value="<?php if($in_fi_ta > 1) {echo $in_fi_ta;} ?>"/>
						<label class="label-form-control" for="in_fi_ta">Tasa:</label>
					</div>

					<!-- FILL (RELLENO) -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 ">
					</div>

					<!-- CUOTAS_NIVELADAS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 mb-1">
						<span class="fas fa-dollar-sign form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_cn" placeholder="Cuotas Niveladas ($)" 
						value="<?php if($in_fi_cn > 1) {echo $in_fi_cn;} ?>"/>
						<label class="label-form-control" for="in_fi_cn">Cuotas Niveladas ($):</label>
					</div>

					<!-- CUOTAS_NIVELADAS - QUETZALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 mb-1">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_cq" placeholder="Cuotas Niveladas (Q)" 
						value="<?php if($in_fi_cq > 1) {echo $in_fi_cq;} ?>"/>
						<label class="label-form-control" for="in_fi_cq">Cuotas Niveladas (Q):</label>
					</div>

					<!-- PLAZO_MESES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 mb-1">
						<span class="fas fa-calendar-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_fi_pl" placeholder="Plazo en Meses" 
						value="<?php if($in_fi_pl > 1) {echo $in_fi_pl;} ?>"/>
						<label class="label-form-control" for="in_fi_pl">Plazo en Meses:</label>
					</div>

					<!-- CANJE_PERMUTA -->
					<div class="form-group col-sm-12 col-md-3">
						<label for="mant" class="form-label-options option-styles-title">Canje o Permuta:</label>
						<div class="form-group clearfix">
							<div class="icheck-sunflower d-inline pr-2">
								<input type="radio" id="canjePermuta1" name="in_fi_cp" value="1" 
								<?php if($in_fi_cp== 1) {echo "checked";} ?>/>
								<label for="canjePermuta1" class="form-label-options">SI </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="radio" id="canjePermuta2" name="in_fi_cp" value="0" 
								<?php if($in_fi_cp== 0) {echo "checked";} ?>/>
								<label for="canjePermuta2" class="form-label-options">NO </label>
							</div>
						</div>
					</div>

					<!-- CANJE_PERMUTA_ESPECIFIQUE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-9 pt-3">
						<span class="fas fa-sticky-note form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control" name="in_fi_es" placeholder="Especifíque" onkeypress="return isNumberKey(event)" maxlength="32" 
						value="<?php echo $in_fi_es; ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_fi_es">Especifíque:</label>
					</div>
				</div>

				<h6 class="mt-3 mb-3">Ingresa los datos del Contacto para Visitas:</h6>
				<div class="row pb-3">

					<!-- ENCARGADO1_NOMBRE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 ">
						<span class="fas fa-user form-control-feedback"></span>
						<input type="text" class="form-control" name="in_e1_no" placeholder="Nombre" 
						value="<?php if(!empty($in_e1_no)) {echo $in_e1_no;} ?>"/>
						<label class="label-form-control" for="in_e1_no">Nombre:</label>
					</div>

					<!-- ENCARGADO1_TEL1 -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 ">
						<span class="fas fa-mobile-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_e1_t1" placeholder="No. de teléfono 1" 
						value="<?php if(!empty($in_e1_t1)) {echo $in_e1_t1;} ?>"/>
						<label class="label-form-control" for="in_e1_t1">Celular:</label>
					</div>

					<!-- ENCARGADO1_TEL2 -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3">
						<span class="fas fa-mobile-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_e1_t2" placeholder="No. de teléfono 2" 
						value="<?php if(!empty($in_e1_t2)) {echo $in_e1_t2;} ?>"/>
						<label class="label-form-control" for="in_e1_t2">Teléfono:</label>
					</div>

					<!-- ENCARGADO1_EMAIL -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3">
						<span class="fas fa-envelope form-control-feedback"></span>
						<input type="email" class="form-control" name="in_e1_ce" placeholder="Email" 
						value="<?php if(!empty($in_e1_ce)) {echo $in_e1_ce;} ?>"/>
						<label class="label-form-control" for="in_e1_ce">Email:</label>
					</div>

					<!-- ENCARGADO2_NOMBRE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 ">
						<span class="fas fa-user form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_e2_no" placeholder="Nombre" 
						value="<?php if(!empty($in_e2_no)) {echo $in_e2_no;} ?>"/>
						<label class="label-form-control" for="in_e2_no">Nombre:</label>
					</div>

					<!-- ENCARGADO2_TEL1 -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3 ">
						<span class="fas fa-mobile-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_e2_t1" placeholder="No. de teléfono 1" 
						value="<?php if(!empty($in_e2_t1)) {echo $in_e2_t1;} ?>"/>
						<label class="label-form-control" for="in_e2_t1">Celular:</label>
					</div>

					<!-- ENCARGADO2_TEL2 -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3">
						<span class="fas fa-mobile-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_e2_t2" placeholder="No. de teléfono 2" 
						value="<?php if(!empty($in_e2_t2)) {echo $in_e2_t2;} ?>"/>
						<label class="label-form-control" for="in_e2_t2">Teléfono:</label>
					</div>

					<!-- ENCARGADO2_EMAIL -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-3">
						<span class="fas fa-envelope form-control-feedback"></span>
						<input type="email" class="form-control" name="in_e2_ce" placeholder="Email" 
						value="<?php if(!empty($in_e2_ce)) {echo $in_e2_ce;} ?>"/>
						<label class="label-form-control" for="in_e2_ce">Email:</label>
					</div>
				</div>

				<h6 class="mt-3 mb-3">Cuota de Mantenimiento:</h6>
				<div class="row">
					<div class="form-group col-sm-12">
						<div class="row">

							<!-- MANTENIMIENTO -->
							<div class="form-group col-sm-12 col-md-3">
								<label for="mant" class="form-label-options option-styles-title">Mantenimiento:</label>
								<div class="form-group clearfix">
									<div class="icheck-sunflower d-inline pr-2">
										<input type="radio" id="mantenimiento1" name="in_mante" value="1" 
										<?php if($in_mante== 1) {echo "checked";} ?>/>
										<label for="mantenimiento1" class="form-label-options">SI </label>
									</div>
									<div class="icheck-sunflower d-inline">
										<input type="radio" id="mantenimiento2" name="in_mante" value="0" 
										<?php if($in_mante== 0) {echo "checked";} ?>/>
										<label for="mantenimiento2" class="form-label-options">NO </label>
									</div>
								</div>
							</div>

							<!-- CUOTA MANTENIMIENTO DOLARES-->
							<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 pt-3">
								<span class="fas fa-dollar-sign form-control-feedback input-custom-icon-fix-span"></span>
								<input type="text" class="form-control input-number-style" name="in_ma_cu" placeholder="Cuota ($)" 
								value="<?php if($in_ma_cu > 0) {echo $in_ma_cu;} ?>"/>
								<label class="label-form-control input-custom-icon-fix-label" for="in_ma_cu">Cuota ($):</label>
							</div>

							<!-- CUOTA MANTENIMIENTO QUETZALES-->
							<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 pt-3">
								<span class="far fa-money-bill-alt form-control-feedback input-custom-icon-fix-span"></span>
								<input type="text" class="form-control input-number-style" name="in_ma_cq" placeholder="Cuota (Q)" 
								value="<?php if($in_ma_cq > 0) {echo $in_ma_cq;} ?>"/>
								<label class="label-form-control input-custom-icon-fix-label" for="in_ma_cq">Cuota (Q):</label>
							</div>

							<!-- CUOTA_INCLUIDO_S/N -->
							<div class="form-group col-sm-12 col-md-3">
								<label for="mant" class="form-label-options option-styles-title">Incluido en la Cuota Mensual:</label>
								<div class="form-group clearfix">
									<div class="icheck-sunflower d-inline pr-2">
										<input type="radio" id="inclMant1" name="in_ma_in" value="1" 
										<?php if($in_ma_in== 1) {echo "checked";} ?>/>
										<label for="inclMant1" class="form-label-options">SI </label>
									</div>
									<div class="icheck-sunflower d-inline">
										<input type="radio" id="inclMant2" name="in_ma_in" value="0" 
										<?php if($in_ma_in== 0) {echo "checked";} ?>/>
										<label for="inclMant2" class="form-label-options">NO </label>
									</div>
								</div>
							</div>
						</div>

						<p>Seleccione los servicios que incluye:</p>

						<div class="row">
							<!-- AGUA -->
							<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
								<input type="checkbox" id="checkboxPrimary1" name="in_se_ag" value="1"
								<?php if($in_se_ag== 1) {echo "checked";} ?>>
								<label for="checkboxPrimary1" class=" form-label-options">Agua</label>
							</div>

							<!-- SEGURIDAD -->
							<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
								<input type="checkbox" id="checkboxPrimary4" name="in_se_se" value="1"
								<?php if($in_se_se== 1) {echo "checked";} ?>>
								<label for="checkboxPrimary4" class=" form-label-options">Seguridad</label>
							</div>

							<!-- LIMPIEZA -->
							<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
								<input type="checkbox" id="checkboxPrimary5" name="in_se_li" value="1"
								<?php if($in_se_li== 1) {echo "checked";} ?>>
								<label for="checkboxPrimary5" class=" form-label-options">Limpieza de Areas Comunes</label>
							</div>

							<!-- LUZ -->
							<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
								<input type="checkbox" id="checkboxPrimary2" name="in_se_lu" value="1"
								<?php if($in_se_lu== 1) {echo "checked";} ?>>
								<label for="checkboxPrimary2" class=" form-label-options">Luz</label>
							</div>

							<!-- BASURA -->
							<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
								<input type="checkbox" id="checkboxPrimary3" name="in_se_ba" value="1"
								<?php if($in_se_ba== 1) {echo "checked";} ?>>
								<label for="checkboxPrimary3" class=" form-label-options">Extracción de Basura</label>
							</div>
						</div>
					</div>
				</div>

				<h6 class="mt-3 mb-3">Datos adicionales:</h6>

				<div class="row">
					<!-- PUBLICACIÓN_WEB -->
					<div class="form-group col-sm-6 col-md-3 mb-0">
						<label for="publicidad" class="form-label-options option-styles-title">Publicación en Redes:</label>
						<div class="form-group clearfix">
							<div class="icheck-sunflower d-inline pr-4">
								<input type="radio" id="publicidadyes" name="in_ad_pu" value="1" 
								<?php if($in_ad_pu== 1) {echo "checked";} ?>/>
								<label for="publicidadyes" class="form-label-options">SI </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="radio" id="publicidadno" name="in_ad_pu" value="0" 
								<?php if($in_ad_pu== 0) {echo "checked";} ?>/>
								<label for="publicidadno" class="form-label-options">NO </label>
							</div>
						</div>
					</div>

					<!-- EXCLUSIVIDAD -->
					<div class="form-group col-sm-12 col-md-3">
						<label for="mant" class="form-label-options option-styles-title">Exclusividad:</label>
						<div class="form-group clearfix">
							<div class="icheck-sunflower d-inline pr-2">
								<input type="radio" id="exclusividad1" name="in_ad_ex" value="1" 
								<?php if($in_ad_ex== 1) {echo "checked";} ?>/>
								<label for="exclusividad1" class="form-label-options">SI </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="radio" id="exclusividad2" name="in_ad_ex" value="0" 
								<?php if($in_ad_ex== 0) {echo "checked";} ?>/>
								<label for="exclusividad2" class="form-label-options">NO </label>
							</div>
						</div>
					</div>

					<!-- COMPARTIDA -->
					<div class="form-group col-sm-12 col-md-3">
						<label for="mant" class="form-label-options option-styles-title">Compartida:</label>
						<div class="form-group clearfix">
							<div class="icheck-sunflower d-inline pr-2">
								<input type="radio" id="compartida1" name="compartida" value="1" 
								<?php if($in_ad_co > 0) {echo "checked";} ?>/>
								<label for="compartida1" class="form-label-options">SI </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="radio" id="compartida2" name="compartida" value="0" 
								<?php if($in_ad_co== 0) {echo "checked";} ?>/>
								<label for="compartida2" class="form-label-options">NO </label>
							</div>
						</div>
					</div>

				</div>

				<p>Ingrese los siguientes datos si la propiedad es compartida:</p>
				<div class="row mb-3">

					<!-- CORREDOR_EXTERNO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-6 order-md-6">
						<span class="fas fa-user-tie form-control-feedback"></span>
						<input list="corredorExterno" class="form-control" name="in_ad_co" placeholder="Asesor Externo" 
						value="<?php if($in_ad_co > 0) {echo $in_ad_co;} ?>"/>
						<datalist class="form-control d-none" id="corredorExterno">
							<?php
							//CONSULTA CORREDOR EXTERNO 
							$query = mysqli_query(
								$con,
								"SELECT * FROM `si_users` WHERE `usertipe`= 4 and `userstat`=1 ORDER BY `id_users` DESC "
							);
							$count_core = mysqli_num_rows($query);
							$ferow = mysqli_fetch_array($query);
							if ($count_core > 0) {
								$core_id_users = $ferow['id_users'];
								$core_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $core_id_users; ?>"><?php echo $core_id_users . " - " . utf8_encode($core_usernomb); ?></option>
							<?php
							}
							for ($i = 1; $i <= $count_core - 1; $i++) {
								$ferow = mysqli_fetch_array($query);
								$core_id_users = $ferow['id_users'];
								$core_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
							?>
								<option value="<?php echo $core_id_users; ?>"><?php echo $core_id_users . " - " . utf8_encode($core_usernomb); ?></option>
							<?php
							}
							?>
						</datalist>
						<label class="label-form-control " for="in_ad_co">Asesor Externo:</label>
					</div>

					<!-- CORREDOR_EXTERNO_EMPRESA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-6 order-xl-6 order-md-6">
						<span class="fa fa-building form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ad_em" placeholder="Nombre de la Empresa" 
						value="<?php if($in_ad_em > 0) {echo $in_ad_em;} ?>"/>
						<label class="label-form-control " for="in_ad_em">Empresa:</label>
					</div>

					<!-- CORREDOR_EXTERNO_PORCENTAJE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-6 order-md-6">
						<span class="fa fa-percent form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ad_po" placeholder="Porcentaje" 
						value="<?php if($in_ad_po > 0) {echo $in_ad_po;} ?>"/>
						<label class="label-form-control " for="in_ad_po">Porcentaje:</label>
					</div>
				</div>

				<div class="f1-buttons">
					<button type="button" class="btn btn-primary btn-next">Siguiente</button>
				</div>
			</fieldset>

			<!-- SECCION DETALLES -->
			<fieldset>
				<h6 class="mt-3 mb-3">Descripción:</h6>
				<div class="row">

					<!-- TERRENO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="form-control-feedback form-control-feedback-icon-right">Vrs<sup>2</sup></span>
						<input type="text" class="form-control form-control-feedback-right input-number-style" name="in_co_te" placeholder="Terreno" 
						value="<?php if($in_co_te > 0) {echo $in_co_te;} ?>"/>
						<label class="label-form-control " for="in_co_te">Terreno:</label>
					</div>

					<!-- CONSTRUCCION mt-->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="form-control-feedback form-control-feedback-icon-right">Mts<sup>2</sup></span>
						<input type="text" class="form-control form-control-feedback-right input-number-style" name="in_co_mt" placeholder="Construcción" 
						value="<?php if($in_co_mt > 0) {echo $in_co_mt;} ?>"/>
						<label class="label-form-control " for="in_co_mt">Construcción:</label>
					</div>

					<!-- FRENTE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 ">
						<span class="form-control-feedback form-control-feedback-icon-right">Mts<sup>2</sup></span>
						<input type="text" class="form-control form-control-feedback-right input-number-style" name="in_co_j1" placeholder="Frente" 
						value="<?php if($in_co_j1 > 0) {echo $in_co_j1;} ?>"/>
						<label class="label-form-control " for="in_co_j1">Frente:</label>
					</div>

					<!-- FONDO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 ">
						<span class="form-control-feedback form-control-feedback-icon-right">Mts<sup>2</sup></span>
						<input type="text" class="form-control form-control-feedback-right input-number-style" name="in_co_j2" placeholder="Fondo" 
						value="<?php if($in_co_j2 > 0) {echo $in_co_j2;} ?>"/>
						<label class="label-form-control " for="in_co_j2">Fondo:</label>
					</div>

					<!-- CONSTRUCCION_AÑO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 ">
						<span class="fas fa-calendar-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_an" placeholder="1970" 
						value="<?php if($in_co_an > 0) {echo $in_co_an;} ?>"/>
						<label class="label-form-control " for="in_co_an">Año de Construcción:</label>
					</div>

					<!-- NIVELES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-house-user form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_ni" placeholder="Niveles" 
						value="<?php if($in_co_ni > 0) {echo $in_co_ni;} ?>"/>
						<label class="label-form-control " for="in_co_ni">Niveles:</label>
					</div>

					<!-- DORMITORIOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-house-user form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_d1" placeholder="Dormitorios" 
						value="<?php if($in_co_d1 > 0) {echo $in_co_d1;} ?>"/>
						<label class="label-form-control " for="in_co_d1">Dormitorios:</label>
					</div>

					<!-- DORMITORIOS_SERVICIO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-house-user form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_d2" placeholder="Dorm. de Servicio" 
						value="<?php if($in_co_d2 > 0) {echo $in_co_d2;} ?>"/>
						<label class="label-form-control " for="in_co_d2">Dormitorios de Servicio:</label>
					</div>

					<!-- BAÑOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-restroom form-control-feedback "></span>
						<input type="text" class="form-control input-number-style" name="in_co_ba" placeholder="Baños" 
						value="<?php if($in_co_ba > 0) {echo $in_co_ba;} ?>"/>
						<label class="label-form-control " for="in_co_bs">Baños:</label>
					</div>

					<!-- BAÑOS_SERVICIO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-restroom form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_bs" placeholder="Baños de Servicio" 
						value="<?php if($in_co_bs > 0) {echo $in_co_bs;} ?>"/>
						<label class="label-form-control " for="in_co_bs">Baños de Servicio:</label>
					</div>

					<!-- PARQUEOS_TECHADOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-car-side form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_p1" placeholder="Parq. Techados" 
						value="<?php if($in_co_p1 > 0) {echo $in_co_p1;} ?>"/>
						<label class="label-form-control " for="in_co_p1">Parqueos Techados:</label>
					</div>

					<!-- PARQUEOS_NO_TECHADOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-car-side form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_co_p2" placeholder="Parq. No Techados" 
						value="<?php if($in_co_p2 > 0) {echo $in_co_p2;} ?>"/>
						<label class="label-form-control " for="in_co_p2">Parqueos Techados:</label>
					</div>
				</div>
				
				<!-- AMBIENTES -->

				<h6 class="mt-3 mb-3">Ambientes:</h6>
				<div class="row">
					<!-- CANTIDAD DE OFICINAS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-building form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_am_of" placeholder="Oficinas" 
						value="<?php if(!empty($in_am_of)) {echo $in_am_of;} ?>"/>
						<label class="label-form-control " for="in_am_of">Oficinas:</label>
					</div>

					<!-- CANTIDAD DE BODEGAS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-industry form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_am_bo" placeholder="Bodegas" 
						value="<?php if(!empty($in_am_bo)) {echo $in_am_bo;} ?>"/>
						<label class="label-form-control " for="in_am_bo">Bodegas:</label>
					</div>

					<!-- CANTIDAD DE LOCALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3">
						<span class="fas fa-warehouse form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_am_lo" placeholder="Locales" 
						value="<?php if(!empty($in_am_lo)) {echo $in_am_lo;} ?>"/>
						<label class="label-form-control " for="in_am_lo">Locales:</label>
					</div>
				</div>


				<h6 class="mt-3 mb-3">Detalles:</h6>
				<div class="row">

					<!-- PORTON -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="porton" name="in_de_po" value="1" 
						<?php if($in_de_po== 1) {echo "checked";} ?>/>
						<label for="porton" class="form-label-options">Portón</label>
					</div>

					<!-- ALACENA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="alacena" name="in_de_ac" value="1" 
						<?php if($in_de_ac== 1) {echo "checked";} ?>/>
						<label for="alacena" class="form-label-options">Alacena</label>
					</div>

					<!-- CLOSET EN BLANCOS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="closet_blancos" name="in_de_cb" value="1" 
						<?php if($in_de_cb== 1) {echo "checked";} ?>/>
						<label for="closet_blancos" class="form-label-options">Closet en Blancos</label>
					</div>

					<!-- JARDIN_FRONTAL -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="jardinFront" name="in_de_j1" value="1" 
						<?php if($in_de_j1== 1) {echo "checked";} ?>/>
						<label for="jardinFront" class="form-label-options">Jardin Frontal</label>
					</div>

					<!-- DESPENSA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="despensa" name="in_de_ds" value="1" 
						<?php if($in_de_ds== 1) {echo "checked";} ?>/>
						<label for="despensa" class="form-label-options">Despensa</label>
					</div>

					<!-- TINA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="tina" name="in_de_ti" value="1" 
						<?php if($in_de_ti== 1) {echo "checked";} ?>/>
						<label for="tina" class="form-label-options">Tina</label>
					</div>

					<!-- JARDIN_TRASERO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="jardinBack" name="in_de_j2" value="1" 
						<?php if($in_de_j2== 1) {echo "checked";} ?>/>
						<label for="jardinBack" class="form-label-options">Jardin Trasero</label>
					</div>

					<!-- DESAYUNADOR -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="desayIsla" name="in_de_de" value="1" 
						<?php if($in_de_de== 1) {echo "checked";} ?>/>
						<label for="desayIsla" class="form-label-options">Desayunador o Isla</label>
					</div>

					<!-- DUCHA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="ducha" name="in_de_du" value="1" 
						<?php if($in_de_du== 1) {echo "checked";} ?>/>
						<label for="ducha" class="form-label-options">Ducha</label>
					</div>

					<!-- BAÑO DE VISITAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="banio_visitas" name="in_de_bv" value="1" 
						<?php if($in_de_bv== 1) {echo "checked";} ?>/>
						<label for="banio_visitas" class="form-label-options">Baño de Visitas</label>
					</div>

					<!-- LAVANDERIA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="lavanderia" name="in_de_la" value="1" 
						<?php if($in_de_la== 1) {echo "checked";} ?>/>
						<label for="lavanderia" class="form-label-options">Lavandería</label>
					</div>

					<!-- BIDET -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="bidet" name="in_de_bi" value="1" 
						<?php if($in_de_bi== 1) {echo "checked";} ?>/>
						<label for="bidet" class="form-label-options">Bidet</label>
					</div>

					<!-- DORMITORIO DE VISITAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="dormitorio_visita" name="in_de_dv" value="1" 
						<?php if($in_de_dv== 1) {echo "checked";} ?>/>
						<label for="dormitorio_visita" class="form-label-options">Dormitorio de Visitas</label>
					</div>

					<!-- PATIO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="patio" name="in_de_pa" value="1" 
						<?php if($in_de_pa== 1) {echo "checked";} ?>/>
						<label for="patio" class="form-label-options">Patio</label>
					</div>

					<!-- JETINA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="jetina" name="in_de_je" value="1" 
						<?php if($in_de_je== 1) {echo "checked";} ?>/>
						<label for="jetina" class="form-label-options">Jetina</label>
					</div>

					<!-- ESTUDIO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="estudio" name="in_de_es" value="1" 
						<?php if($in_de_es== 1) {echo "checked";} ?>/>
						<label for="estudio" class="form-label-options">Estudio</label>
					</div>

					<!-- PERGOLA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="pergola" name="in_de_pe" value="1" 
						<?php if($in_de_pe== 1) {echo "checked";} ?>/>
						<label for="pergola" class="form-label-options">Pérgola</label>
					</div>

					<!-- JACUZZI -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="jacuzzi" name="in_de_ja" value="1" 
						<?php if($in_de_ja== 1) {echo "checked";} ?>/>
						<label for="jacuzzi" class="form-label-options">Jacuzzi</label>
					</div>

					<!-- SALA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="sala" name="in_de_s1" value="1" 
						<?php if($in_de_s1== 1) {echo "checked";} ?>/>
						<label for="sala" class="form-label-options">Sala</label>
					</div>

					<!-- BODEGA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="bodega" name="in_de_bo" value="1" 
						<?php if($in_de_bo== 1) {echo "checked";} ?>/>
						<label for="bodega" class="form-label-options">Bodega</label>
					</div>

					<!-- SAUNA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="sauna2" name="in_de_sa" value="1" 
						<?php if($in_de_sa== 1) {echo "checked";} ?>/>
						<label for="sauna2" class="form-label-options">Sauna</label>
					</div>

					<!-- CHIMENEA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="chimenea" name="in_de_ch" value="1" 
						<?php if($in_de_ch== 1) {echo "checked";} ?>/>
						<label for="chimenea" class="form-label-options">Chimenea</label>
					</div>

					<!-- BODEGA_JARDIN -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="bodegaJardin" name="in_de_bj" value="1" 
						<?php if($in_de_bj== 1) {echo "checked";} ?>/>
						<label for="bodegaJardin" class="form-label-options">Bodega de Jardín</label>
					</div>

					<!-- BALCON -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="balcon" name="in_de_ba" value="1" 
						<?php if($in_de_ba== 1) {echo "checked";} ?>/>
						<label for="balcon" class="form-label-options">Balcón</label>
					</div>

					<!-- SALA/COMEDOR -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="salaCom" name="in_de_s2" value="1" 
						<?php if($in_de_s2== 1) {echo "checked";} ?>/>
						<label for="salaCom" class="form-label-options">Sala/Comedor</label>
					</div>

					<!-- SALA_FAMILIAR -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="salaFam" name="in_de_s3" value="1" 
						<?php if($in_de_s3== 1) {echo "checked";} ?>/>
						<label for="salaFam" class="form-label-options">Sala Familiar</label>
					</div>

					<!-- TERRAZA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="terraza" name="in_de_te" value="1" 
						<?php if($in_de_te== 1) {echo "checked";} ?>/>
						<label for="terraza" class="form-label-options">Terraza</label>
					</div>

					<!-- COMEDOR -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="comedor" name="in_de_co" value="1" 
						<?php if($in_de_co== 1) {echo "checked";} ?>/>
						<label for="comedor" class="form-label-options">Comedor</label>
					</div>

					<!-- WALKIN_CLOSET -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="walkCloset" name="in_de_wa" value="1" 
						<?php if($in_de_wa== 1) {echo "checked";} ?>/>
						<label for="walkCloset" class="form-label-options">Walk-In Closet</label>
					</div>

					<!-- CHURRASQUERA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="churrasquera" name="in_de_cr" value="1" 
						<?php if($in_de_cr== 1) {echo "checked";} ?>/>
						<label for="churrasquera" class="form-label-options">Churrasquera</label>
					</div>

					<!-- COCINA_GABINETES -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="cocGab" name="in_de_cc" value="1" 
						<?php if($in_de_cc== 1) {echo "checked";} ?>/>
						<label for="cocGab" class="form-label-options">Cocina con Gabinetes</label>
					</div>

					<!-- CLOSET -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="closet" name="in_de_cl" value="1" 
						<?php if($in_de_cl== 1) {echo "checked";} ?>/>
						<label for="closet" class="form-label-options">Closet</label>
					</div>
				</div>

				<!-- DETALLES_OTROS -->
				<!-- <h6 class="mt-3 mb-3">Otros:</h6> -->
				<div class="row mt-4 mb-3">
					<div class="form-group input-custom-icon col-sm-12">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Otros Detalles" name="in_de_ot"><?php if(!empty($in_de_ot)) {echo $in_de_ot;} ?></textarea>
						<label class="label-form-control" for="in_de_ot">Otros Detalles:</label>
					</div>
				</div>
				<hr>

				<!-- DETALLES_ACABADOS -->
				<h6 class="mt-4 mb-3 pb-3">Acabados:</h6>
				<div class="row mt-3 mb-3">

					<!-- CONSTRUCCIÓN -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ac_co" placeholder="Construcción" 
						value="<?php if(!empty($in_ac_co)) {echo $in_ac_co;} ?>"/>
						<label class="label-form-control" for="in_ac_co">Construcción:</label>
					</div>

					<!-- PISOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ac_pi" placeholder="Pisos" 
						value="<?php if(!empty($in_ac_pi)) {echo $in_ac_pi;} ?>"/>
						<label class="label-form-control" for="in_ac_pi">Pisos:</label>
					</div>

					<!-- PUERTAS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ac_pu" placeholder="Puertas" 
						value="<?php if(!empty($in_ac_pu)) {echo $in_ac_pu;} ?>"/>
						<label class="label-form-control" for="in_ac_pu">Puertas:</label>
					</div>

					<!-- TECHOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ac_te" placeholder="Techos" 
						value="<?php if(!empty($in_ac_te)) {echo $in_ac_te;} ?>"/>
						<label class="label-form-control" for="in_ac_te">Techos:</label>
					</div>

					<!-- VENTANAS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ac_ve" placeholder="Ventanas" 
						value="<?php if(!empty($in_ac_ve)) {echo $in_ac_ve;} ?>"/>
						<label class="label-form-control" for="in_ac_ve">Ventanas:</label>
					</div>

					<!-- OTROS ACABADOS -->
					<div class="form-group input-custom-icon col-sm-12 mt-3">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Otros Acabados" name="in_de_oa"><?php if(!empty($in_de_oa)) {echo $in_de_oa;} ?></textarea>
						<label class="label-form-control" for="in_de_oa">Otros:</label>
					</div>
				</div>
				<hr>

				<h6 class="mt-4 mb-3">Incluye:</h6>
				<div class="row mt-3 mb-3">

					<!-- REFRIGERADORA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="refri" name="in_in_re" value="1" 
						<?php if($in_in_re== 1) {echo "checked";} ?>/>
						<label for="refri" class="form-label-options">Refrigeradora</label>
					</div>

					<!-- LAMPARAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="lamparas" name="in_in_lm" value="1"
						<?php if($in_in_lm== 1) {echo "checked";} ?>/>
						<label for="lamparas" class="form-label-options">Lámparas</label>
					</div>

					<!-- AIRE_ACONDICIONADO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="aireAcon" name="in_in_aa" value="1" 
						<?php if($in_in_aa== 1) {echo "checked";} ?>/>
						<label for="aireAcon" class="form-label-options">Aire Acondicionado</label>
					</div>

					<!-- ESTUFA *** DE GAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="estufa" name="in_in_et" value="1" 
						<?php if($in_in_et== 1) {echo "checked";} ?>/>
						<label for="estufa" class="form-label-options">Estufa</label>
					</div>

					<!-- CORTINAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="cortinas" name="in_in_cs" value="1" 
						<?php if($in_in_cs== 1) {echo "checked";} ?>/>
						<label for="cortinas" class="form-label-options">Cortinas</label>
					</div>

					<!-- ALARMA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="alarma" name="in_in_al" value="1" 
						<?php if($in_in_al== 1) {echo "checked";} ?>/>
						<label for="alarma" class="form-label-options">Alarma</label>
					</div>

					<!-- ESTUFA ELECTRICA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="estufa_electrica" name="in_in_ee" value="1" 
						<?php if($in_in_ee== 1) {echo "checked";} ?>/>
						<label for="estufa_electrica" class="form-label-options">Estufa Eléctrica</label>
					</div>

					<!-- BLACKOUTS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="blackouts" name="in_in_bl" value="1" 
						<?php if($in_in_bl== 1) {echo "checked";} ?>/>
						<label for="blackouts" class="form-label-options">Blackouts</label>
					</div>

					<!-- CAMARAS_SEGURIDAD -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="camSec" name="in_in_cm" value="1" 
						<?php if($in_in_cm== 1) {echo "checked";} ?>/>
						<label for="camSec" class="form-label-options">Cámaras de Seguridad</label>
					</div>

					<!-- LAVA_VAJILLAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="lavavajillas" name="in_in_lv" value="1" 
						<?php if($in_in_lv== 1) {echo "checked";} ?>/>
						<label for="lavavajillas" class="form-label-options">Lavavajillas</label>
					</div>

					<!-- CORTINAS DE BAÑO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="cortinas_banios" name="in_in_cb" value="1" 
						<?php if($in_in_cb== 1) {echo "checked";} ?>/>
						<label for="cortinas_banios" class="form-label-options">Cortinas de Baño</label>
					</div>

					<!-- PANEL_SOLAR -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="panSolar" name="in_in_ps" value="1" 
						<?php if($in_in_ps== 1) {echo "checked";} ?>/>
						<label for="panSolar" class="form-label-options">Páneles Solares</label>
					</div>

					<!-- CAMPANA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="campana" name="in_in_ca" value="1" 
						<?php if($in_in_ca== 1) {echo "checked";} ?>/>
						<label for="campana" class="form-label-options">Campana</label>
					</div>

					<!-- CALENTADOR_AGUA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="calentAgua" name="in_in_ct" value="1" 
						<?php if($in_in_ct== 1) {echo "checked";} ?>/>
						<label for="calentAgua" class="form-label-options">Calentador de Agua</label>
					</div>

					<!-- BOMBA/CISTERNA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="bombaCist" name="in_in_bm" value="1" 
						<?php if($in_in_bm== 1) {echo "checked";} ?>/>
						<label for="bombaCist" class="form-label-options">Bomba y Cisterna</label>
					</div>

					<!-- LAVADORA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="lavadora" name="in_in_ld" value="1" 
						<?php if($in_in_ld== 1) {echo "checked";} ?>/>
						<label for="lavadora" class="form-label-options">Lavadora</label>
					</div>

					<!-- ESPEJOS_BAÑO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="espejosBanio" name="in_in_eb" value="1" 
						<?php if($in_in_eb== 1) {echo "checked";} ?>/>
						<label for="espejosBanio" class="form-label-options">Espejos de Baño</label>
					</div>

					<!-- DEPÓSITO DE BASURA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="depositBasura" name="in_in_db" value="1" 
						<?php if($in_in_db== 1) {echo "checked";} ?>/>
						<label for="depositBasura" class="form-label-options">Depósito de Basura</label>
					</div>

					<!-- SECADORA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="secadora" name="in_in_sd" value="1" 
						<?php if($in_in_sd== 1) {echo "checked";} ?>/>
						<label for="secadora" class="form-label-options">Secadora</label>
					</div>
				</div>

				<!-- OTROS_INCLUYE -->
				<!-- <h6 class="mt-3 mb-3">Otros:</h6> -->
				<div class="row mt-4 mb-3">
					<div class="form-group input-custom-icon col-sm-12">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Otros" name="in_in_io"><?php if(!empty($in_in_io)) {echo $in_in_io;} ?></textarea>
						<label class="label-form-control" for="in_in_io">Otros:</label>
					</div>
				</div>

				<div class="f1-buttons">
					<button type="button" class="btn btn-secondary btn-previous">Anterior</button>
					<button type="button" class="btn btn-primary btn-next">Siguiente</button>
				</div>
			</fieldset>

			<!-- SECCION AMENIDADES -->
			<fieldset>
				<h6 class="mt-3 mb-3">Amenidades Condominio:</h6>
				<div class="row mt-3 mb-3">

					<!-- GARITA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="garita" name="in_am_ga" value="1" 
						<?php if($in_am_ga== 1) {echo "checked";} ?>/>
						<label for="garita" class="form-label-options">Garita</label>
					</div>

					<!-- GIMNASIO -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="Gimnasio" name="in_am_gi" value="1" 
						<?php if($in_am_gi== 1) {echo "checked";} ?>/>
						<label for="Gimnasio" class="form-label-options">Gimnasio</label>
					</div>

					<!-- JUEGOS_INFANTILES -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="juegosInf" name="in_am_ju" value="1" 
						<?php if($in_am_ju== 1) {echo "checked";} ?>/>
						<label for="juegosInf" class="form-label-options">Juegos Infantiles</label>
					</div>

					<!-- GUARDIANIA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="guardiania" name="in_am_gu" value="1" 
						<?php if($in_am_gu== 1) {echo "checked";} ?>/>
						<label for="guardiania" class="form-label-options">Guardianía</label>
					</div>

					<!-- SAUNA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="sauna" name="in_am_sa" value="1" 
						<?php if($in_am_sa== 1) {echo "checked";} ?>/>
						<label for="sauna" class="form-label-options">Sauna</label>
					</div>

					<!-- PISCINA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="piscina" name="in_am_pi" value="1" 
						<?php if($in_am_pi== 1) {echo "checked";} ?>/>
						<label for="piscina" class="form-label-options">Piscina</label>
					</div>

					<!-- AREA_SOCIAL -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="areaSocial" name="in_am_as" value="1" 
						<?php if($in_am_as== 1) {echo "checked";} ?>/>
						<label for="areaSocial" class="form-label-options">Área Social</label>
					</div>

					<!-- SPA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="spa" name="in_am_sp" value="1" 
						<?php if($in_am_sp== 1) {echo "checked";} ?>/>
						<label for="spa" class="form-label-options">Spa</label>
					</div>

					<!-- ACCESO SILLA DE RUEDA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="acceso_silla" name="in_am_sr" value="1" 
						<?php if($in_am_sr== 1) {echo "checked";} ?>/>
						<label for="acceso_silla" class="form-label-options">Acceso Silla de Rueda:</label>
					</div>

					<!-- ÁREA PARA MASCOTAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="area_mascotas" name="in_am_am" value="1" 
						<?php if($in_am_am== 1) {echo "checked";} ?>/>
						<label for="area_mascotas" class="form-label-options">Área para Mascotas:</label>
					</div>

					<!-- SALON_BELLEZA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="makeUp" name="in_am_sb" value="1" 
						<?php if($in_am_sb== 1) {echo "checked";} ?>/>
						<label for="makeUp" class="form-label-options">Salón de Belleza</label>
					</div>

					<!-- PLANTA TELEFÓNICA -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="planta_telefonica" name="in_am_pt" value="1" 
						<?php if($in_am_pt== 1) {echo "checked";} ?>/>
						<label for="planta_telefonica" class="form-label-options">Planta Telefónica</label>
					</div>

					<!-- PARQUEO_VISITAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="parqueo_visitas" name="in_am_pa" value="1" 
						<?php if($in_am_pa== 1) {echo "checked";} ?>/>
						<label for="parqueo_visitas" class="form-label-options">Parqueo Visitas</label>
					</div>

					<!-- CANCHAS -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="canchas" name="in_am_ca" value="1" 
						<?php if($in_am_ca== 1) {echo "checked";} ?>/>
						<label for="canchas" class="form-label-options">Canchas Deportivas</label>
					</div>

					<!-- RAZOR RIBBON -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="razor_ribon" name="in_am_rr" value="1" 
						<?php if($in_am_rr== 1) {echo "checked";} ?>/>
						<label for="razor_ribon" class="form-label-options">Razor Ribbon</label>
					</div>

					<!-- BUSINESS_CENTER -->
					<div class="icheck-sunflower form-group col-sm-4 col-md-3 col-lg-4">
						<input type="checkbox" id="businessCenter" name="in_am_bc" value="1" 
						<?php if($in_am_bc== 1) {echo "checked";} ?>/>
						<label for="businessCenter" class="form-label-options">Business Center</label>
					</div>

				</div>

				<!-- OTROS_AMENIDADES (no está en base de datos) -->
				<!-- <h6 class="mt-3 mb-3">Otras Amenidades:</h6> -->
				<div class="row mt-4 mb-3">
					<div class="form-group input-custom-icon col-sm-12">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Otras Amenidades" name="in_am_ot"><?php if(!empty($in_am_ot)) {echo $in_am_ot;} ?></textarea>
						<label class="label-form-control" for="in_de_ot">Otras Amenidades:</label>
					</div>
				</div>

				<!-- Slides - Fotos de Propiedades VERSION TAVO -->
				<h3>Fotos Actuales</h3>
				<div class="row">
					<?php
					if ( is_dir("../assets/images/propiedades/".$in_mu_id."/") ) 
					{
						$directory = "../assets/images/propiedades/".$in_mu_id."/"; 
						$files1 = scandir($directory); 
						$num_files = count($files1) - 2; 
						//echo $num_files . " files"; 
					}
					$count_pic = 0;
					if ( is_dir("../assets/images/propiedades/".$in_mu_id."/") ) 
					{
						$dirint = dir("../assets/images/propiedades/".$in_mu_id."/");  
						for ($i = 1; $i <= $num_files; $i++) 
						{
							?>
								<div class="form-group  mt-3 mb-3" style="margin-right:5px;">
									<a href="#"><img style="width:100%; width:280px; height:200px!important;" src="../assets/images/propiedades/<?php echo $in_mu_id.'/'.$i.'.jpg'; ?>"></a>
								</div>
							<?php
						}
						$dirint->close();
					}
					?>
				</div>

				<!-- ESTADO FOTOS -->
				<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-10 order-md-6">
					<span class="fas fa-building form-control-feedback"></span>
					<select class="form-control" name="foto_est">
						<option value="0">Sobrescribir Fotos (Sin Eliminar Actuales)</option>
						<option value="1">Solo Nuevas Fotos (Se Eliminarán las Actuales)</option>	
					</select>
					<label class="label-form-control" for="foto_est">Estado Fotos:</label>
				</div>

				<!-- FOTOS FORM -->
				<h3>Subir Nuevas Fotos</h3>
				<div class="row">
					<div class="form-group col-sm-12 col-md-4">
						<div class="file-field input-group rounded-top-0">
							<input type="file" class="custom-file-input pictureUpload rounded-top-0" name="archivo[]" multiple />
							<label class="custom-file-label rounded-top-0" for="customFile">Seleccionar Fotos</label>
						</div>
					</div>
				</div>

				<div class="f1-buttons">
					<button type="button" class="btn btn-secondary btn-previous">Anterior</button>
					<button type="button" class="btn btn-primary btn-next">Siguiente</button>
				</div>
			</fieldset>

			<!-- SECCION ARBITRIOS -->
			<fieldset>
				<h6 class="mt-3 mb-3">Seleccione los Arbitrios de la Propiedad:</h6>
				<div class="row">

					<!-- VALOR_REGISTRO - DOLARES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-1 order-md-1 ">
						<span class="fas fa-dollar-sign form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_re" placeholder="Valor del Registro ($)" 
						value="<?php if($in_ab_re > 0) {echo $in_ab_re;} ?>"/>
						<label class="label-form-control " for="in_ab_re">Valor del Registro ($):</label>
					</div>

					<!-- VALOR_REGISTRO - QUETZALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-1 order-md-1 ">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_rq" placeholder="Valor del Registro (Q)" 
						value="<?php if($in_ab_rq > 0) {echo $in_ab_rq;} ?>"/>
						<label class="label-form-control " for="in_ab_rq">Valor del Registro (Q):</label>
					</div>

					<!-- IUSI - DOLARES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-1 order-md-2 ">
						<span class="fas fa-dollar-sign form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_iu" placeholder="IUSI Trimestral ($)" 
						value="<?php if($in_ab_iu > 0) {echo $in_ab_iu;} ?>"/>
						<label class="label-form-control " for="in_ab_iu">IUSI Trimestral ($):</label>
					</div>

					<!-- IUSI - QUETZALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-4 col-xl-3 order-xl-1 order-md-2 ">
						<span class="far fa-money-bill-alt form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_iq" placeholder="IUSI Trimestral (Q)" 
						value="<?php if($in_ab_iq > 0) {echo $in_ab_iq;} ?>"/>
						<label class="label-form-control " for="in_ab_iq">IUSI Trimestral (Q):</label>
					</div>

					<!-- LIBRO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-2 col-xl-2 order-xl-5 order-md-5">
						<span class="fas fa-pen form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_li" placeholder="Libro" 
						value="<?php if($in_ab_li > 0) {echo $in_ab_li;} ?>"/>
						<label class="label-form-control " for="in_ab_li">Libro:</label>
					</div>

					<!-- FOLIO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-2 col-xl-2 order-xl-3 order-md-3">
						<span class="fas fa-pen form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_fo" placeholder="Folio" 
						value="<?php if($in_ab_fo > 0) {echo $in_ab_fo;} ?>"/>
						<label class="label-form-control " for="in_ab_fo">Folio:</label>
					</div>

					<!-- FINCA -->
					<div class="form-group input-custom-icon col-sm-12 col-md-2 col-xl-2 order-xl-4 order-md-4">
						<span class="fas fa-pen form-control-feedback"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_fi" placeholder="Finca" 
						value="<?php if($in_ab_fi > 0) {echo $in_ab_fi;} ?>"/>
						<label class="label-form-control " for="in_ab_fi">Finca:</label>
					</div>

					<!-- FILL (RELLENO) -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 order-xl-5 order-md-5">

					</div>

					<!-- INSCRITO_SOCIEDAD -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-6 order-xl-6 order-md-6">
						<label for="insSA" class="form-label-options d-block option-styles-title">Inscrita en una Sociedad Anónima:</label>
						<div class="icheck-sunflower d-inline pr-2">
							<input type="radio" id="insSA1" name="in_ab_s2" value="1" <?php if($in_ab_s2== 1) {echo "checked";} ?>/>
							<label for="insSA1" class="form-label-options">SI </label>
						</div>
						<div class="icheck-sunflower d-inline">
							<input type="radio" id="insSA2" name="in_ab_s2" value="0" <?php if($in_ab_s2== 0) {echo "checked";} ?>/>
							<label for="insSA2" class="form-label-options">NO </label>
						</div>
					</div>

					<!-- NOMBRE_SOCIEDAD -->
					<div class="form-group input-custom-icon col-sm-12 col-md-6 col-xl-6 order-xl-7 order-md-7 pt-3">
						<span class="fa fa-building form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control" name="in_ab_s1" placeholder="Nombre de la Sociedad Anónima" 
						value="<?php if(!empty($in_ab_s1)) {echo $in_ab_s1;} ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_s1">Sociedad Anónima:</label>
					</div>

					<!-- GRAVAMEN_SI/NO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-7 order-md-7">
						<label for="insSA" class="form-label-options d-block option-styles-title">Gravamen Hipotecario:</label>
						<div class="icheck-sunflower d-inline pr-2">
							<input type="radio" id="grabHIP1" name="in_ab_g1" value="1" <?php if($in_ab_g1== 1) {echo "checked";} ?>/>
							<label for="grabHIP1" class="form-label-options">SI </label>
						</div>
						<div class="icheck-sunflower d-inline">
							<input type="radio" id="grabHIP2" name="in_ab_g1" value="0" <?php if($in_ab_g1== 0) {echo "checked";} ?>/>
							<label for="grabHIP2" class="form-label-options">NO </label>
						</div>
					</div>

					<!-- GRAVAMEN_VALOR - DOLARES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-8 order-md-8 pt-3 ">
						<span class="fas fa-dollar-sign form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_g2" placeholder="Valor del Gravamen ($)" 
						value="<?php if($in_ab_g2 > 0) {echo $in_ab_g2;} ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_g2">Gravamen ($):</label>
					</div>

					<!-- GRAVAMEN_VALOR - QUETZALES-->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-8 order-md-8 pt-3 ">
						<span class="far fa-money-bill-alt form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_gq" placeholder="Valor del Gravamen (Q)" 
						value="<?php if($in_ab_gq > 0) {echo $in_ab_gq;} ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_gq">Gravamen (Q):</label>
					</div>

					<!-- NOMBRE_BANCO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-9 order-md-9 pt-3">
						<span class="fas fa-building form-control-feedback input-custom-icon-fix-span"></span>
						<select class="form-control" name="in_ab_ba">
							<option value="0" <?php if($in_ab_ba== 0) {echo "selected";}?>>Selecciona el Banco</option>
							<option value="1" <?php if($in_ab_ba== 1) {echo "selected";}?>>BanRural</option>
							<option value="2" <?php if($in_ab_ba== 2) {echo "selected";}?>>Banco Inductrial</option>
							<option value="3" <?php if($in_ab_ba== 3) {echo "selected";}?>>Banco Reformador</option>
							<option value="4" <?php if($in_ab_ba== 4) {echo "selected";}?>>Banco CHN</option>
							<option value="5" <?php if($in_ab_ba== 5) {echo "selected";}?>>Banco Promerica</option>
							<option value="6" <?php if($in_ab_ba== 6) {echo "selected";}?>>Banco de Guatemala</option>
							<option value="7" <?php if($in_ab_ba== 7) {echo "selected";}?>>Banco G&T Continental</option>
							<option value="8" <?php if($in_ab_ba== 8) {echo "selected";}?>>Otro</option>
						</select>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_ba">Nombre del Banco:</label>
					</div>

					<!-- AVALUO_RECIENTE -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-10 order-md-10">
						<label for="insSA" class="form-label-options d-block option-styles-title">Avalúo Reciente:</label>
						<div class="icheck-sunflower d-inline pr-2">
							<input type="radio" id="avaREC1" name="in_ab_a1" value="1" <?php if($in_ab_a1== 1) {echo "checked";} ?>/>
							<label for="avaREC1" class="form-label-options">SI </label>
						</div>
						<div class="icheck-sunflower d-inline">
							<input type="radio" id="avaREC2" name="in_ab_a1" value="0" <?php if($in_ab_a1== 0) {echo "checked";} ?>/>
							<label for="avaREC2" class="form-label-options">NO </label>
						</div>
					</div>

					<!-- VALOR_AVALUO - DOLARES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-11 order-md-11 pt-3 ">
						<span class="fas fa-dollar-sign form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_a2" placeholder="Valor del Avaluo ($)" 
						value="<?php if($in_ab_a2 > 0) {echo $in_ab_a2;} ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_a2">Valor del Avaluo ($):</label>
					</div>

					<!-- VALOR_AVALUO - QUETZALES -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-11 order-md-11 pt-3 ">
						<span class="far fa-money-bill-alt form-control-feedback input-custom-icon-fix-span"></span>
						<input type="text" class="form-control input-number-style" name="in_ab_aq" placeholder="Valor del Avaluo (Q)" 
						value="<?php if($in_ab_aq > 0) {echo $in_ab_aq;} ?>"/>
						<label class="label-form-control input-custom-icon-fix-label" for="in_ab_aq">Valor del Avaluo (Q):</label>
					</div>

					<!-- TIPO DE AVALUO -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-11 order-md-11 mb-0">
						<label for="insSA" class="form-label-options d-block option-styles-title">Tipo de Avalúo:</label>
						<div class="icheck-sunflower d-inline pr-2">
							<input type="radio" id="avaTYPE1" name="in_ab_at" value="1" <?php if($in_ab_at== 1) {echo "checked";} ?>/>
							<label for="avaTYPE1" class="form-label-options">Comercial</label>
						</div>
						<div class="icheck-sunflower d-inline">
							<input type="radio" id="avaTYPE2" name="in_ab_at" value="2" <?php if($in_ab_at== 2) {echo "checked";} ?>/>
							<label for="avaTYPE2" class="form-label-options">Bancario </label>
						</div>
					</div>

					<!-- IMPUESTOS -->
					<div class="form-group input-custom-icon col-sm-12 col-md-3 col-xl-3 order-xl-12 order-md-12">
						<label for="precIVA" class="form-label-options option-styles-title">Impuestos: </label>
						<div class="form-group">
							<div class="icheck-sunflower d-inline pr-2">
								<input type="checkbox" id="timbres" name="in_ar_it" value="1" <?php if($in_ar_it== 1) {echo "checked";} ?>>
								<label for="timbres" class="form-label-options">Timbres </label>
							</div>
							<div class="icheck-sunflower d-inline">
								<input type="checkbox" id="IVA" name="in_ar_ii" value="1" <?php if($in_ar_ii== 1) {echo "checked";} ?>>
								<label for="IVA" class="form-label-options">IVA </label>
							</div>
						</div>
					</div>

				</div>
				<hr>

				<!-- DESCRIPCION_ARBITRIOS-->
				<h6 class="mt-5 mb-3">Descripción:</h6>
				<div class="row">
					<div class="form-group input-custom-icon col-sm-12">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Descripción de la Propiedad" name="in_ab_de"><?php if(!empty($in_ab_de)) {echo $in_ab_de;} ?></textarea>
					</div>
				</div>

				<!-- Link de YouTube -->
				<h6 class="mt-3 mb-3">Link de YouTube:</h6>
				<div class="row">
					<div class="form-group input-custom-icon col-sm-12 col-md-12 col-xl-12">
						<span class="fas fa-globe form-control-feedback"></span>
						<input type="text" class="form-control" name="in_ab_yo" placeholder="Link de YouTube" 
						value="<?php if(!empty($in_ab_yo)) {echo $in_ab_yo;} ?>"/>
						<label class="label-form-control" for="in_ab_yo">Tour de la Propiedad:</label>
					</div>
				</div>

				<!-- OTROS_NOTAS_INTERNAS -->
				<h6 class="mt-3 mb-3">Notas Internas:</h6>
				<div class="row">
					<div class="form-group input-custom-icon col-sm-12">
						<span class="fas fa-sticky-note form-control-feedback"></span>
						<textarea class="form-control" rows="3" placeholder="Notas Internas" name="in_ab_ni"><?php if(!empty($in_ab_ni)) {echo $in_ab_ni;} ?></textarea>
					</div>
				</div>

				<div class="f1-buttons">
					<button type="button" class="btn btn-secondary btn-previous">Previous</button>
					<input class="rounded-5 btn text-right collapsed current-bg-primary text-decoration-none pt-2 pb-2" id="guardarPropiedad" type="submit" name="subir" value="Guardar" />
					</input>
				</div>
			</fieldset>
		</form>
			
	</div>
	<!-- BODY -->
				
	</section>
	</div>
	<!-- CONTENEDOR FONDO -->
	</div>

	<?php
	//CONSULTA PROPIETARIOS 
	$query = mysqli_query
	( $con, "SELECT * FROM `si_users` WHERE `usertipe`= 5 or `usertipe`= 7 and `userstat`=1 ORDER BY `id_users` DESC ");
	$count_prop = mysqli_num_rows($query);
	$ferow = mysqli_fetch_array($query);

	if ($count_prop > 0) 
	{
		?>
		<input type="hidden" value="">
		<?php
	}
	?>

	<?php include 'include/footer.php'; ?>
	<div id="Guardando" style="position: fixed;top: 50%;right: 50%;translate: 50% 50%;background-color: #fff;text-align: center;font-weight: bold;padding: 2rem;z-index: 20;border: solid 1px #f1f1f1;display: none;">
		<i class="fas fa-spinner fa-pulse"></i>
		<p>Guardando</p>
	</div>
	<?php include 'include/scripts.php'; ?>

	<script src="../assets/js/lightslider.js"></script>
	<script src="../assets/js/lightgallery.js"></script>
	<script src="../assets/js/jquery.alphanum.js"></script>
	<script src="../assets/js/app_dashboard.js"></script>

	<script>
		$(document).ready(function() 
		{
			initGeneral();
			$('#guardarPropiedad').click(function () {
				$('#Guardando').fadeIn();
			})

			<?php
			//CONSULTA PROPIETARIOS 
			$query = mysqli_query(
				$con,
				"SELECT * FROM `si_users` WHERE `usertipe`= 5 or `usertipe`= 7 and `userstat`=1 ORDER BY `id_users` DESC "
			);

			$count_prop = mysqli_num_rows($query);
			$prop_id_users = $ferow['id_users'];
			$prop_usernomb = $ferow['firstnam'] . " " . $ferow['lastname'];
			// $ferow = mysqli_fetch_array($query);

			if ($count_prop > 0) {
			?>

				$('input[name=in_nombr]').blur(function() {
					var cont = parseInt(<?php echo $prop_id_users; ?>);
					var selected = parseInt($('input[name=in_nombr]').val());

					console.log(selected);
					if (selected == cont) {
						var ownername = <?php echo $prop_usernomb; ?>;
						console.log(selected)
					} else {
						console.log('no es igual')
					}
				});

			<?php
			}
			?>
		});

		// SLIDER
		$('.images-properties').lightSlider
			({
				adaptiveHeight: true,
				gallery: true,
				item: 1,
				loop: true,
				thumbItem: 8,
				slideMargin: 0,
				enableDrag: false,
				currentPagerPosition: 'left',
				verticalHeight: 300,
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '.images-properties .lslide'
					});
				}
			});
	</script>

</body>
</html>