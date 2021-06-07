<?php
/*-------------------------
PROPERTY VIEW
Autor: Gustavo Blanco
Web: chofo7.blogspot.com
Mail: chofo7@gmail.com
---------------------------*/

// Notificar 0 errores  - HORARIO GUATEMALA
error_reporting(0);
date_default_timezone_set('America/Guatemala');

session_start(); //validacion para la sesion
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../public/login_form.php");
    exit;
}

//Base de Datos
require_once("../config/db.php");
require_once("../config/conexion.php");

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
    <link type="text/css" rel="stylesheet" href="../assets/css/lightslider.css" />
    <link type="text/css" rel="stylesheet" href="../assets/css/lightgallery.css" />
</head>

<body style="margin: 0!important;">
    <?php include 'include/menu.php'; ?>

    <div class="contenedor bg-light" id="contenedor">

        <!-- BODY -->
        <div class="container">
            <div class="row">

                <?php
                //--CONSULTA DE PROPIEDADES (TODAS)--   
                if (!empty($_GET['id'])) {
                    $id = utf8_decode($_GET['id']);
                } else {
                    $id = '1';
                }

                $query = mysqli_query(
                    $con,
                    "SELECT * FROM `si_properties` WHERE `in_mu_id`= '" . $id . "'"
                );
                $count_prop = mysqli_num_rows($query);
                $ferow = mysqli_fetch_array($query);
                if ($count_prop > 0) {
                    $in_mu_id = $ferow['in_mu_id'];                  //ID
                    $in_titul = utf8_encode($ferow['in_titul']);      //Titulo
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

                    if ($in_estat == 0) {
                        $in_estat = "Activa";
                    } else
					if ($in_estat == 1) {
                        $in_estat = "Vendida";
                    } else {
                        $in_estat = "Alquilada";
                    }

                    if ($in_tip_p == 1) {
                        $in_tip_p = "Casa";
                    } else
					if ($in_tip_p == 2) {
                        $in_tip_p = "Apartamento";
                    } else
					if ($in_tip_p == 3) {
                        $in_tip_p = "Oficina";
                    } else
					if ($in_tip_p == 4) {
                        $in_tip_p = "Bodega";
                    } else
					if ($in_tip_p == 5) {
                        $in_tip_p = "Terreno";
                    } else
					if ($in_tip_p == 6) {
                        $in_tip_p = "Finca";
                    } else
					if ($in_tip_p == 7) {
                        $in_tip_p = "Clinica";
                    } else
					if ($in_tip_p == 8) {
                        $in_tip_p = "Casa de playa";
                    } else
					if ($in_tip_p == 9) {
                        $in_tip_p = "Granja";
                    } else
					if ($in_tip_p == 10) {
                        $in_tip_p = "Edificio";
                    } else
					if ($in_tip_p == 11) {
                        $in_tip_p = "Local";
                    } else {
                        $in_tip_p = "-";
                    }

                    if ($in_pre_v > 0 and $in_pre_v > 0) {
                        $in_preci = "$" . number_format($in_pre_v, 2, '.', ',') . " / $" . number_format($in_pre_r, 2, '.', ',');
                    } else {
                        if ($in_pre_v > 0) {
                            $in_preci = "$" . number_format($in_pre_v, 2, '.', ',');
                        } else {
                            if ($in_pre_r > 0) {
                                $in_preci = "$" . number_format($in_pre_r, 2, '.', ',');
                            } else {
                                $in_preci = "$0.00 / $0.00";
                            }
                        }
                    }

                    if ($in_pre_v > 0 and $in_pre_v > 0) {
                        $in_prevr = "Venta / Renta";
                    } else {
                        if ($in_pre_v > 0) {
                            $in_prevr = "Venta";
                        } else {
                            if ($in_pre_r > 0) {
                                $in_prevr = "Renta";
                            } else {
                                $in_prevr = "Venta / Renta";
                            }
                        }
                    }

                    if ($in_ab_ba == 1) {
                        $in_ab_ba = "BanRural";
                    } else
					if ($in_ab_ba == 2) {
                        $in_ab_ba = "Banco Inductrial";
                    } else
					if ($in_ab_ba == 3) {
                        $in_ab_ba = "Banco Reformador";
                    } else
					if ($in_ab_ba == 4) {
                        $in_ab_ba = "Banco CHN";
                    } else
					if ($in_ab_ba == 5) {
                        $in_ab_ba = "Banco Promerica";
                    } else
					if ($in_ab_ba == 6) {
                        $in_ab_ba = "Banco de Guatemala";
                    } else
					if ($in_ab_ba == 7) {
                        $in_ab_ba = "Banco G&T";
                    } else 
					if ($in_ab_ba == 8) {
                        $in_ab_ba = "Otro";
                    }

                    //-------------------------------------------------------------------------------------------
                    //CONSULTA PARA AGENTE_INTERNO
                    $query_user = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "'");
                    $data_user = mysqli_num_rows($query_user);
                    $ferow = mysqli_fetch_array($query_user);
                    if ($data_user > 0) {
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

                        if ($aseso_ec == 1) {
                            $aseso_ec = "Casado(a)";
                        } else
						if ($aseso_ec == 2) {
                            $aseso_ec = "Soltero(a)";
                        } else
						if ($aseso_ec == 3) {
                            $aseso_ec = "Unido(a)";
                        } else
						if ($aseso_ec == 4) {
                            $aseso_ec = "Viudo(a)";
                        } else
						if ($aseso_ec == 5) {
                            $aseso_ec = "Divorciado(a)";
                        } else {
                            $aseso_ec = "-";
                        }

                        if ($aseso_pr == 1) {
                            $aseso_pr = "Sr";
                        } else
						if ($aseso_pr == 2) {
                            $aseso_pr = "Sra";
                        } else
						if ($aseso_pr == 3) {
                            $aseso_pr = "Srita";
                        } else
						if ($aseso_pr == 4) {
                            $aseso_pr = "Ing";
                        } else
						if ($aseso_pr == 5) {
                            $aseso_pr = "Dr";
                        } else 
						if ($aseso_pr == 6) {
                            $aseso_pr = "Dra";
                        } else 
						if ($aseso_pr == 7) {
                            $aseso_pr = "Lic";
                        } else 
						if ($aseso_pr == 8) {
                            $aseso_pr = "Licda";
                        } else 
						if ($aseso_pr == 9) {
                            $aseso_pr = "Baco";
                        } else 
						if ($aseso_pr == 10) {
                            $aseso_pr = "Conta";
                        } else 
						if ($aseso_pr == 11) {
                            $aseso_pr = "Prof";
                        } else 
						if ($aseso_pr == 12) {
                            $aseso_pr = "Profa";
                        } else 
						if ($aseso_pr == 13) {
                            $aseso_pr = "Asociado Platinum";
                        } else
						if ($aseso_pr == 14) {
                            $aseso_pr = "Asociada Platinum";
                        } else
						if ($aseso_pr == 15) {
                            $aseso_pr = "Asociado Senior";
                        } else
						if ($aseso_pr == 16) {
                            $aseso_pr = "Asociada Senior";
                        } else
						if ($aseso_pr == 17) {
                            $aseso_pr = "Asociado Élite";
                        } else
						if ($aseso_pr == 18) {
                            $aseso_pr = "Asociada Élite";
                        } else
						if ($aseso_pr == 19) {
                            $aseso_pr = "Broker Owner";
                        } else {
                            $aseso_pr = " - ";
                        }
                    }

                    //-------------------------------------------------------------------------------------------
                    //CONSULTA PARA AGENTE
                    $query_user = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_ad_co . "'");
                    $data_user = mysqli_num_rows($query_user);
                    $ferow = mysqli_fetch_array($query_user);
                    if ($data_user > 0) {
                        $ase_e_id = $ferow['id_users'];  //Usuario Datos ID
                        $ase_e_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
                        $ase_e_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
                        $ase_e_es = $ferow['userstat'];  //Usuario Esado 
                    }

                    //-------------------------------------------------------------------------------------------
                    //CONSULTA PROPIETARIO
                    $query_user = mysqli_query($con, "SELECT * FROM `si_users` WHERE `id_users`= '" . $in_nombr . "'");
                    $data_user = mysqli_num_rows($query_user);
                    $ferow = mysqli_fetch_array($query_user);
                    if ($data_user > 0) {
                        $owner_id = $ferow['id_users'];  //Usuario Datos ID
                        $owner_fn = utf8_encode($ferow['firstnam']);  //Usuario Nombre
                        $owner_ln = utf8_encode($ferow['lastname']);  //Usuario Apellidos
                        $owner_un = utf8_encode($ferow['username']);  //Usuario UserName
                        $owner_co = utf8_encode($ferow['usermail']);  //Usuario Correo
                        $owner_tu = $ferow['usertipe'];  //Usuario Tipo de Usuario
                        $owner_es = $ferow['userstat'];  //Usuario Estado 
                        $owner_te = $ferow['phonenum'];  //Usuario Telefono
                        $owner_cu = $ferow['userdate'];  //Usuario Cumpleaños
                        $owner_di = utf8_encode($ferow['useraddr']);  //Usuario Dirección
                        $owner_dp = $ferow['userndpi'];  //Usuario DPI
                        $owner_ec = $ferow['usermatr'];  //Usuario Estado Civil
                        $owner_pr = $ferow['userprof'];  //Usuario Profesión

                        if ($owner_ec == 1) {
                            $owner_ec = "Casado(a)";
                        } else
						if ($owner_ec == 2) {
                            $owner_ec = "Soltero(a)";
                        } else
						if ($owner_ec == 3) {
                            $owner_ec = "Unido(a)";
                        } else
						if ($owner_ec == 4) {
                            $owner_ec = "Viudo(a)";
                        } else
						if ($owner_ec == 5) {
                            $owner_ec = "Divorciado(a)";
                        } else {
                            $owner_ec = "-";
                        }

                        if ($owner_pr == 1) {
                            $owner_pr = "Sr";
                        } else
						if ($owner_pr == 2) {
                            $owner_pr = "Sra";
                        } else
						if ($owner_pr == 3) {
                            $owner_pr = "Srita";
                        } else
						if ($owner_pr == 4) {
                            $owner_pr = "Ing";
                        } else
						if ($owner_pr == 5) {
                            $owner_pr = "Dr";
                        } else 
						if ($owner_pr == 6) {
                            $owner_pr = "Dra";
                        } else 
						if ($owner_pr == 7) {
                            $owner_pr = "Lic";
                        } else 
						if ($owner_pr == 8) {
                            $owner_pr = "Licda";
                        } else 
						if ($owner_pr == 9) {
                            $owner_pr = "Baco";
                        } else 
						if ($owner_pr == 10) {
                            $owner_pr = "Conta";
                        } else 
						if ($owner_pr == 11) {
                            $owner_pr = "Prof";
                        } else 
						if ($owner_pr == 12) {
                            $owner_pr = "Profa";
                        } else {
                            $owner_pr = "-";
                        }
                    }

                    //-------------------------------------------------------------------------------------------
                    //CONSULTA DEPARTAMENTOS
                    $query = mysqli_query($con, "SELECT * FROM `si_departments` WHERE `de_pa_id`= '" . $in_di_de . "'");
                    $data  = mysqli_num_rows($query);
                    $ferow = mysqli_fetch_array($query);
                    if ($data > 0) {
                        $de_pa_id = $ferow['de_pa_id'];  //Datos ID
                        $de_nombr = utf8_encode($ferow['de_nombr']);  //Nombre
                    }

                    //-------------------------------------------------------------------------------------------
                    //CONSULTA MUNICIPIOS
                    $query = mysqli_query($con, "SELECT * FROM `si_municips` WHERE `mu_ni_id`= '" . $in_di_mu . "'");
                    $data  = mysqli_num_rows($query);
                    $ferow = mysqli_fetch_array($query);
                    if ($data > 0) {
                        $mu_ni_id = $ferow['mu_ni_id'];  //Datos ID
                        $mu_nombr = utf8_encode($ferow['mu_nombr']);  //Nombre
                    }

                    $usertipe = $_SESSION['usertipe'];
                ?>

                    <!-- Información de Propiedad -->
                    <div class="col-12 col-lg-8 p-1">

                        <!-- Título de la Propiedad y Fotos -->
                        <div class="container rounded border shadow-sm info-property pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                            <div class="row ">
                                <div class="col">
                                    <h5 class="col-10 p-0 d-inline float-left">
                                        <textarea rows="2" disabled="" class="property-title-two-line-view">
										<?php echo ($in_titul); ?>
									</textarea>
                                    </h5>
                                    <h6 class="col-2 p-0 d-inline float-right text-right">COD: <?php echo ($in_mu_id); ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                        echo ($in_di_di . " zona " . $in_di_zo . ", " . $de_nombr . ", " . $mu_nombr . ".");
                                    } else {
                                        echo ($de_nombr . ", " . $mu_nombr . ".");
                                    }
                                    ?>
                                    <h6 class="col-2 p-0 d-inline float-right text-right">(<?php echo ($in_estat); ?>)</h6>
                                </div>
                            </div>

                            <!-- Slides - Fotos de Propiedades VERSION TAVO -->
                            <?php
                            if (is_dir("../assets/images/propiedades/" . $in_mu_id . "/")) {
                                $directory = "../assets/images/propiedades/" . $in_mu_id . "/";
                                $files1 = scandir($directory);
                                $num_files = count($files1) - 2;
                                //echo $num_files . " files"; 
                            }
                            ?>
                            <div class="row">
                                <div class="col">
                                    <ul class="images-properties">
                                        <?php
                                        $count_pic = 0;

                                        if (is_dir("../assets/images/propiedades/" . $in_mu_id . "/")) {
                                            $dirint = dir("../assets/images/propiedades/" . $in_mu_id . "/");
                                            for ($i = 1; $i <= $num_files; $i++) {
                                        ?>
                                                <li data-thumb="../assets/images/propiedades/<?php echo $in_mu_id . '/' . $i . '.jpg'; ?>" data-src="../assets/images/propiedades/<?php echo $in_mu_id . '/' . $i . '.jpg'; ?>">
                                                    <img src="../assets/images/propiedades/<?php echo $in_mu_id . '/' . $i . '.jpg'; ?>" class="w-100" />
                                                </li>
                                        <?php
                                            }
                                            $dirint->close();
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>


                        <!-- Acerca de - Descripción -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">

                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Descripción:</h6>
                                </div>

                                <!-- Detalles -->
                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Terreno:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_te); ?> Vrs<sup>2</sup></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Construcción:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo $in_co_mt; ?> Mts<sup>2</sup></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Frente:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_j1); ?> Mts<sup>2</sup></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Fondo:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_j2); ?> Mts<sup>2</sup></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Año de Construcción:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_an); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Niveles:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_ni); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Dormitorios:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_d1); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Dormitorios de Servicio:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_d2); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Baños:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_ba); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Baños de Servicio:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_co_bs); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Detalles -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">

                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Detalles:</h6>
                                </div>
                                <!-- Detalles -->
                                <?php if ($in_de_wa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Walkin Closet
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_cl == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Closet
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_po == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Portón
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_j1 == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Jardín Frontal
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_j2 == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Jardín Trasero
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_es == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Estudio
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_pe == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Pérgola
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_s2 == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Sala/Comedor
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_s1 == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Sala
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_co == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Comedor
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ch == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Chimenea
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_cc == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2"><i class="fas fa-check"></i></span>
                                            Cocina Con Gabinetes
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_de == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Desayudador o Isla
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_la == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Lavandería
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_pa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Patio
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_bo == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Bodega
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_s3 == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Sala Familiar
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ba == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Balcón
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_bj == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Bodega de Jardín
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_cr == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Churrasquera
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_te == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Terraza
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_te == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Despensa
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ac == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Alacena
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ti == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Tina
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ja == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Jacuzzi
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_je == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Jetina
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_du == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Ducha
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_sa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Sauna
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_bv == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Baño de Visitas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_de_ot == true) { ?>
                                    <div class="col-12">
                                        <p class="mt-2"><strong>Otros Detalles:</strong></p>
                                        <p class="text-left">
                                            <?php echo ($in_de_ot); ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Acabados -->
                        <?php if ($in_de_oa == true) { ?>
                            <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="info-property-title">Acabados:</h6>
                                    </div>
                                    <!-- Detalles -->
                                    <div class="col-12">
                                        <p class="text-left">
                                            <?php echo ($in_de_oa); ?></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Incluye -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">

                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Incluye:</h6>
                                </div>
                                <!-- Inclye - Items -->
                                <?php if ($in_in_re == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Refrigeradora
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_et == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Estufa
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_lv == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Lavavajillas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_ca == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Campana
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_ct == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Calentador de Agua
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_bm == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Bomba y Cisterna
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_aa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Aire Acondicionado
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_al == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Alarma
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_cs == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Cortinas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_bl == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Blackouts
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_lm == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Lámparas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_eb == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Espejos de Baño
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_ps == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Páneles Solares
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_cm == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Cámaras de Seguridad
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_in_io == true) { ?>
                                    <div class="col-12">
                                        <p class="mt-2"><strong>Otros:</strong></p>
                                        <p class="text-left">
                                            <?php echo ($in_in_io); ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Amenidades -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">

                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Amenidades:</h6>
                                </div>
                                <!-- Inclye - Items -->
                                <?php if ($in_am_gi == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Gimnasio
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_ca == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Canchas Deportivas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_as == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Área Social
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_sp == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Spá
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_sa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Sauna
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_sb == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Salón de Belleza
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_pi == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Piscina
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_bc == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Business Center
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_gu == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Guardianía
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_ga == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Garita
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_ju == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Juegos Infantiles
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_pa == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Parqueo de Visitas
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_am_ot == true) { ?>
                                    <div class="col-12">
                                        <p class="mt-2"><strong>Otros:</strong></p>
                                        <p class="text-left">
                                            <?php echo ($in_am_ot); ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Arbitrios -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Arbitrios de la Propiedad:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6">
                                            <p>
                                                Valor del Registro
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6">
                                            <p class="text-left">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_ab_re); ?></p></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p>
                                                IUSI Trimestral
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p class="text-left">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_ab_iu); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p>
                                                Folio
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_ab_fo); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p>
                                                Finca
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_ab_fi); ?></strong></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p>
                                                Libro
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-sm-12 col-md-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_ab_li); ?></strong></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <hr>
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Inscrita en una Sociedad Anónima:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <?php if ($in_ab_s2 == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Nombre de la Sociedad Anónima:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <strong><?php echo ($in_ab_s1); ?></strong></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <hr>
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Gravamen Hipotecario:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <?php if ($in_ab_g1 == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Valor:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_ab_g1); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Nombre del Banco:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <strong><?php echo ($in_ab_ba); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <hr>
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Avaluo Reciente:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <?php if ($in_ab_a1 == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Valor del Avaluo:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="text-left m-0">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_ab_a2); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <hr>
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <p class="m-0">
                                                Impuestos:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-md-6 col-sm-12">
                                            <?php if ($in_ar_it == 1) { ?>
                                                <p class="col-6 d-inline text-left m-0">
                                                    <span class="text-warning mr-1">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <strong>Timbres</strong>
                                                </p>
                                            <?php } ?>
                                            <?php if ($in_ar_ii == 1) { ?>
                                                <p class="col-6 d-inline text-left m-0">
                                                    <span class="text-warning mr-1">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <strong>IVA</strong>
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Datos del Inmueble -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Datos del Inmueble:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-4">
                                            <p>
                                                Tipo:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-8">
                                            <p class="text-left">
                                                <strong><?php echo ($in_tip_p); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-4">
                                            <p>
                                                Honorarios:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-8">
                                            <p class="text-left">
                                                <strong><?php echo ($in_porce); ?></strong>
                                                <span class="mr-1">
                                                    <i class="fas fa-percent"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Mantenimiento -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Mantenimiento:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Mantenimiento:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_mante == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Cuota:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_ma_cu); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Incluido en Cuota Mensual:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_ma_in == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h6 class="info-property-title">Servicios que Incluye:</h6>
                                </div>
                                <!-- Servicios - Items -->
                                <?php if ($in_se_ag == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Agua
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_se_lu == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Luz
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_se_se == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Seguridad
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_se_ba == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Extracción de Basura
                                        </p>
                                    </div>
                                <?php } ?>

                                <?php if ($in_se_li == 1) { ?>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <p class="text-left">
                                            <span class="text-warning mr-2">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            Limpieza de Áreas C.
                                        </p>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                        <!-- Financiamiento -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Financiamiento:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Financiamiento:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_fi_sn == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Enganche:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_fi_en); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Cuotas Niveladas:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <span class="mr-1">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <strong><?php echo ($in_fi_cn); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Plazo en meses:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_fi_pl); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Tasa:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_fi_ta); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Canje o Permuta:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_fi_cp == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-12">
                                            <p class="m-0">
                                                Tipo de Canje o Permuta:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-12">
                                            <p class="text-left">
                                                <strong><?php echo ($in_fi_es); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Contacto para Visitas -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Contacto para Visitas:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-xl-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-3">
                                            <p>
                                                Nombre:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-9">
                                            <p class="text-left">
                                                <strong><?php echo ($in_e1_no); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xl-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6 col-md-3 col-xl-6">
                                            <p>
                                                Tel:<strong><?php echo ($in_e1_t1); ?></strong>
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6 col-md-3 col-xl-6">
                                            <p class="text-left">
                                                Tel:<strong><?php echo ($in_e1_t2); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="mt-0">
                                </div>

                                <div class="col-sm-12 col-xl-6">

                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-3">
                                            <p>
                                                Nombre:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-9">
                                            <p class="text-left">
                                                <strong><?php echo ($in_e2_no); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xl-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6 col-md-3 col-xl-6">
                                            <p>
                                                Tel:<strong><?php echo ($in_e2_t1); ?></strong>
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6 col-md-3 col-xl-6">
                                            <p class="text-left">
                                                Tel:<strong><?php echo ($in_e2_t2); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Datos Adicionales -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-4 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="info-property-title">Datos Adicionales:</h6>
                                </div>
                                <!-- Detalles -->
                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Publicidad en Redes:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_ad_pu == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Exclusividad:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_ad_ex == 1) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="mt-0">
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Compartida:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_ad_co == true) { ?>
                                                    <strong>SI</strong>
                                                <?php } else { ?>
                                                    <strong>NO</strong>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Corredor Externo:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($ase_e_fn . " " . $ase_e_ln); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Empresa:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <?php if ($in_ad_em > 0) {
                                                    echo $in_ad_em;
                                                } else {
                                                    echo "-";
                                                }; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6">
                                    <div class="row">
                                        <!-- Titulo de Tipo de Detalle -->
                                        <div class="col-6">
                                            <p>
                                                Porcentaje:
                                            </p>
                                        </div>
                                        <!-- Detalle -->
                                        <div class="col-6">
                                            <p class="text-left">
                                                <strong><?php echo ($in_ad_po); ?></strong>
                                                <span class="mr-1">
                                                    <i class="fas fa-percent"></i>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php if (!empty($in_ab_de)) { ?>
                            <!-- Descripción -->
                            <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="info-property-title">Descripción:</h6>
                                    </div>
                                    <!-- Detalles -->
                                    <div class="col-12">
                                        <p class="text-left">
                                            <?php echo $in_ab_de; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if (!empty($in_ab_ni) and ($usertipe == 1 or $usertipe == 2 or $usertipe == 3)) {
                        ?>
                            <!-- Notas Internas -->
                            <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="info-property-title">Notas Internas:</h6>
                                    </div>
                                    <!-- Detalles -->
                                    <div class="col-12">
                                        <p class="text-left">
                                            <?php echo $in_ab_ni; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <?php if (!empty($in_ab_yo)) { ?>
                            <div class="container rounded shadow-sm info-property mt-4 pt-4 pl-3 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                                <!-- Youtube -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="info-property-title">Tour Virtual:</h6>
                                    </div>
                                    <div class="col-12">
                                        <?php $link_youtube = substr($in_ab_yo, 17, 20); ?>
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $link_youtube; ?>?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if ($usertipe == 1 or $usertipe == 2) {
                            $map_address = $in_di_di . ", " . $de_nombr . ", " . $mu_nombr;
                        ?>
                            <!-- Mapa -->
                            <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-2 pl-md-5 pr-3 pr-md-5 pb-2 bg-white">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="info-property-title">Mapa:</h6>
                                    </div>
                                    <div class="col-12">
                                        <iframe width="100%" height="100%" src="https://maps.google.it/maps?q=<?php echo $map_address; ?>&output=embed" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" scrolling="no" marginheight="0" marginwidth="0">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- Precio -->
                        <div class="container rounded border shadow-sm info-property mt-4 pt-4 pl-5 pr-5 pb-4 bg-primary text-white">
                            <div class="row mt-3">
                                <div class="col-11">
                                    <?php if (($in_pre_v > 0) && ($in_pre_r > 0)) { ?>
                                        <!-- Para Venta -->
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-light text-danger p-2 rounded-0 align-bottom info-property-title">VENTA</span>

                                                <h4 class="d-inline ml-3">
                                                    <span class="mr-1">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <?php echo $in_pre_v = number_format($in_pre_v, 2, '.', ','); ?>
                                                </h4>
                                            </div>
                                        </div>

                                        <!-- Activar este div si se muestran ambos -Venta  y Renta- -->
                                        <div class="row mb-3">

                                        </div>
                                        <!-- Para Renta -->
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-light text-danger p-2 rounded-0 align-bottom info-property-title">RENTA</span>

                                                <h4 class="d-inline ml-3">
                                                    <span class="mr-1">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <?php echo $in_pre_r = number_format($in_pre_r, 2, '.', ','); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php } else if (($in_pre_r > 0) && ($in_pre_v == 0)) { ?>
                                        <!-- Para Renta -->
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-light text-danger p-2 rounded-0 align-bottom info-property-title">RENTA</span>

                                                <h4 class="d-inline ml-3">
                                                    <span class="mr-1">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <?php echo $in_pre_r = number_format($in_pre_r, 2, '.', ','); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php } else if (($in_pre_v > 0) && ($in_pre_r == 0)) { ?>
                                        <!-- Para Venta -->
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="badge bg-light text-danger p-2 rounded-0 align-bottom info-property-title">VENTA</span>

                                                <h4 class="d-inline ml-3">
                                                    <span class="mr-1">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                    <?php echo $in_pre_v = number_format($in_pre_v, 2, '.', ','); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-1">
                                    <button type="button" class="btn text-white ml-2 mb-0 p-0 h2 float-right">
                                        <span class="h5">
                                            <i class="d-none ion-ios-heart"></i>
                                            <i class="ion-ios-heart-outline"></i>
                                        </span>
                                    </button>
                                </div>
                                <!-- Detalles -->
                                <div class="col-12 mt-3">
                                    <p class="text-left text-white">
                                        <span class="mr-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <?php
                                        if ($usertipe == 1 or $usertipe == 2) {
                                            echo ($in_di_di . ", " . $de_nombr . ", " . $mu_nombr . ".");
                                        } else {
                                            echo ($de_nombr . ", " . $mu_nombr . ".");
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="col-12 mb-3">
                                    <?php if (($in_co_d1 + $in_co_d2) > 0) { ?>
                                        <p class="text-left text-white d-inline mr-4">
                                            <span class="mr-1">
                                                <i class="fas fa-bed"></i>
                                            </span>
                                            <?php echo ($in_co_d1 + $in_co_d2); ?>
                                        </p>
                                    <?php } ?>

                                    <?php if (($in_co_ba + $in_co_bs) > 0) { ?>
                                        <p class="text-left text-white d-inline mr-4">
                                            <span class="mr-1">
                                                <i class="fas fa-bath"></i>
                                            </span>
                                            <?php echo ($in_co_ba + $in_co_bs); ?>
                                        </p>
                                    <?php } ?>

                                    <?php if (($in_co_p1 + $in_co_p2) > 0) { ?>
                                        <p class="text-left text-white d-inline mr-4">
                                            <span class="mr-1">
                                                <i class="fas fa-parking"></i>
                                            </span>
                                            <?php echo ($in_co_p1 + $in_co_p2); ?>
                                        </p>
                                    <?php } ?>

                                    <?php if ($in_co_ni > 0) { ?>
                                        <p class="text-left text-white d-inline mr-4">
                                            <span class="mr-1">
                                                <i class="fas fa-building"></i>
                                            </span>
                                            <?php echo ($in_co_ni); ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- EDITAR_PROPIEDAD -->
                        <div class="col-12 p-0 mt-3 ">
                            <form action="#" method="POST">
                                <?php
                                if ($usertipe == 1 or $usertipe == 2) {
                                ?>
                                    <a name="" class="btn btn-outline-primary" href="propiedad_edit.php?id=<?php echo ($in_mu_id); ?>" role="button"><i class="fas fa-highlighter"></i> Actualizar Propiedad
                                    </a>
                                <?php
                                }
                                ?>
                                <a href="#" role="button" style="float:right;" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn btn-outline-primary property-view-btn afterpdflist"><i class="fas fa-file-alt"></i> Agregar a PDF</a>
                            </form>
                        </div>

                    </div>

                    <!-- Asesor y Cliente -->
                    <div class="col-12 col-lg-4">

                        <!-- Asesor -->
                        <div class="container rounded border shadow-sm info-property pt-2 pl-4 pr-4 pb-2 bg-white">
                            <div class="row mt-3">
                                <div class="col-12 text-center">

                                    <div class="col-6 p-0 mx-auto">
                                        <img class="img-thumbnail rounded-circle" src="../assets/images/usuarios/<?php echo ($aseso_id); ?>.png" alt="nombre_asesor">
                                    </div>
                                    <h6 class=""><?php echo ($aseso_pr); ?></h6>
                                    <p class="mb-3">
                                        <?php echo ($aseso_fn . " " . $aseso_ln); ?>
                                    </p>


                                    <p>
                                        <a name="" id="" class="btn fb-color text-white float-left" href="<?php echo ($us_sn_fb); ?>" role="button">
                                            <span class="">
                                                <i class="fab fa-facebook"></i>
                                            </span>
                                        </a>

                                        <a name="" id="" class="btn tw-color text-white " href="<?php echo ($us_sn_fb); ?>" role="button">
                                            <span class="">
                                                <i class="fab fa-twitter"></i>
                                            </span>
                                        </a>

                                        <a name="" id="" class="btn ins-color text-white float-right" href="<?php echo ($us_sn_fb); ?>" role="button">
                                            <span class="">
                                                <i class="fab fa-instagram"></i>
                                            </span>
                                        </a>
                                    </p>

                                    <hr>

                                    <p>
                                        <a name="" id="" class="btn btn-success mb-lg-3 mb-xl-0" href="https://wa.me/50253689090?text=Estoy%20interesado%20en%20la%20propiedad%20COD:<?php echo ($in_mu_id); ?> " role="button">
                                            <span class="mr-2">
                                                <i class="fab fa-whatsapp"></i>

                                            </span>
                                            Contactar
                                        </a>
                                        <a name="" id="" class="btn btn-warning" href="https://wa.me/50253689090?text=Estoy%20interesado%20en%20la%20propiedad%20COD:<?php echo ($in_mu_id); ?>" role="button">
                                            <span class="mr-2">
                                                <i class="fas fa-phone" style="transform: rotate(90deg);"></i>
                                            </span>
                                            Llamar
                                        </a>
                                    </p>

                                    <p class="mb-3">
                                        <span class="mr-2">
                                            <i class="icon-mail"></i>
                                        </span>
                                        <button class="btn btn-info mb-lg-3 mb-xl-0" href="mailto:sarah.alzugaray@propiedadesplatinum.com">Email</button>
                                    </p>

                                </div>

                                <div class="col-12 mt-0">
                                    <hr class="mt-0">
                                </div>
                                <!-- Datos Completos del Asesor -->
                                <div class="col-12">

                                    <h6 class="text-center">Información del Asesor</h6>
                                    <div class="col-12">
                                        <p class="mb-0">
                                            <strong>Nombre:</strong>
                                        </p>
                                        <p class="">
                                            <?php echo ($aseso_fn . " " . $aseso_ln); ?>
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

                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Teléfono:</strong>
                                            </p>
                                            <p class="mb-0">
                                                +(502) <?php echo ($aseso_te); ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
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
                                            <strong>Fecha de Nacimiento:</strong>
                                        </p>
                                        <p class="">
                                            <?php echo date("d-m-Y", strtotime("$aseso_cu")); ?>
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
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>DPI:</strong>
                                            </p>
                                            <p class="">
                                                <?php if ($aseso_dp > 0) { ?>
                                                    <?php echo ($aseso_ec); ?>
                                                <?php } else { ?>
                                                    No Disponible
                                                <?php } ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>

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

                                    <!-- EDITAR_USUARIO-->
                                    <div class="col-12">
                                        <form action="#" method="POST">
                                            <?php
                                            $usertipe = $_SESSION['usertipe'];
                                            if ($usertipe == 1 or $usertipe == 2) {
                                            ?>
                                                <a name="" class="btn btn-outline-primary" href="usuario_edit.php?id=<?php echo $aseso_id; ?>" role="button"><i class="fas fa-highlighter"></i> Actualizar Asesor
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>

                                </div>
                                <!-- Detalles -->

                            </div>
                        </div>

                        <!-- PROPIETARIO -->

                        <div class="mt-4 container rounded border shadow-sm info-property pt-2 pl-4 pr-4 pb-2 bg-white">
                            <div class="row mt-3">
                                <div class="col-12">

                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2 or $usertipe == 3 or $usertipe == 5) {
                                    ?>
                                        <h6 class="text-center">Propietario</h6>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Nombre:</strong>
                                            </p>
                                            <p class="">
                                                <?php echo ($owner_fn . " " . $owner_ln); ?>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Profesión:</strong>
                                            </p>
                                            <p class="">
                                                <?php echo ($owner_pr); ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Dirección:</strong>
                                            </p>
                                            <p class="">
                                                <?php echo ($owner_di); ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>



                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Teléfono:</strong>
                                            </p>
                                            <p class="mb-0">
                                                <?php echo ($owner_te); ?>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Correo Electrónico:</strong>
                                            </p>
                                            <p class="">
                                                <?php echo ($owner_co); ?>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>DPI:</strong>
                                            </p>
                                            <p class="">
                                                <?php if ($owner_dp > 0) { ?>
                                                    <?php echo ($owner_dp); ?>
                                                <?php } else { ?>
                                                    -
                                                <?php } ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($usertipe == 1 or $usertipe == 2) {
                                    ?>
                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Fecha de Nacimiento:</strong>
                                            </p>
                                            <p class="">
                                                <?php echo date("d-m-Y", strtotime("$owner_cu")); ?>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p class="mb-0">
                                                <strong>Estado Civil:</strong>
                                            </p>
                                            <p class="">
                                                <?php if ($owner_ec == true) { ?>
                                                    <?php echo ($owner_ec); ?>
                                                <?php } else { ?>
                                                    -
                                                <?php } ?>
                                            </p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <!-- EDITAR_USUARIO-->
                                    <div class="col-12">
                                        <form action="#" method="POST">
                                            <?php
                                            $usertipe = $_SESSION['usertipe'];
                                            if ($usertipe == 1 or $usertipe == 2) {
                                            ?>
                                                <a name="" class="btn btn-outline-primary" href="usuario_edit.php?id=<?php echo $owner_id; ?>" role="button"><i class="fas fa-highlighter"></i> Actualizar Propietario
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>

                                </div>
                                <!-- Detalles -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <?php
                }
    ?>
    </div>
    </div>
    <div class="alert alert-success alert-dismissible fade  adding-pdf" style="width: max-content;height: 50px;overflow: hidden;position: absolute;right: 1rem;top: 1rem;" role="alert">
        Agregado a la lista de PDF.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div id="afterpdflist" style="width: 0; height: 0;"></div>
    </div>

    <?php include 'include/footer.php'; ?>
    <?php include 'include/scripts.php';  ?>
    <script src="../assets/js/lightslider.js"></script>
    <script src="../assets/js/lightgallery.js"></script>
    <script src="../assets/js/app_dashboard.js"></script>

    <script>
        function pdfhidelist() {
            $('#pdflist').ready(function() {
                setTimeout(function() {
                    $('.adding-pdf').removeClass("show");
                }, 1500);
            });
        }
        $(document).ready(function() {
            // initGeneral();<?php echo ($in_mu_id); ?>
            var id = jQuery(this).data('id');
            $('.afterpdflist').click(function(e) {
                e.preventDefault();

                var pdfid = jQuery(this).data('id');
                // $('.adding-pdf').show("swing");
                $('.adding-pdf').addClass('show');
                $('#afterpdflist').after('<iframe id="pdflist" src="propiedad_pdf_list.php?id=' + pdfid + '" onLoad="pdfhidelist()" marginwidth="0" marginheight="0" name="pdfcontainer" scrolling="no" border="0" frameborder="0" width="0" height="0"></iframe>');
            });
        });
    </script>

    <script type="text/javascript">
        function enviar_mensaje() {
            var nombre = "" + $("#nombre").val();
            var email = "" + $("#email").val();
            var telefono = "" + $("#telefono").val();
            var mensaje = "" + $("#mensaje").val();

            if (nombre == "") {
                mensajealerta("El campo Nombre es Obligatorio", "error");
                return;
            } else {
                if (email == "") {
                    mensajealerta("El campo Email es Obligatorio", "error");
                    return;
                } else {
                    mensajealerta("El Mensaje fue enviado correctamente", "enviar");
                }
            }
        }

        function mensajealerta(mensaje, tipo) {
            $("#mensaje_error").hide();
            $("#mensaje_enviado").hide();

            $("#mensaje_" + tipo + "").show("fast");
            $("#mensaje_" + tipo + "_texto").html("" + mensaje);
        }

        function enviar_whatsapp() {
            var cadena_pedido = "";
            cadena_pedido += "%2ANuevo Pedido%2A" + '%0A' + '%0A';
            for (var i = 0; i < arra_prods_exis.length; i++) {
                var obj_prod = get_nombre_ref(arra_prods_exis[i]);
                if (obj_prod.nombre_producto != "") {
                    cadena_pedido += "%2A" + obj_prod.nombre_producto + '%2A%0A';
                }
                cadena_pedido += "" + get_linea_cadena_by_ref(arra_prods_exis[i], "1");
                cadena_pedido += "---------------------------------" + '%0A';
            }
            cadena_pedido += "---------------------------------" + '%0A';
            if (valor_total_cotizacion > 0) {
                cadena_pedido += "%2A" + "TOTAL:" + "%2A%20%20" + addCommas(valor_total_cotizacion) + '%0A';
                cadena_pedido += "---------------------------------" + '%0A';
            }
            cadena_pedido += "%2A" + "Nombres:" + "%2A%20" + encodeURIComponent($("#nombrePedido").val()) + '%0A';
            cadena_pedido += "%2A" + "Email:" + "%2A%20" + $("#emailPedido").val() + '%0A';
            cadena_pedido += "%2A" + "Teléfonos:" + "%2A%20" + encodeURIComponent($("#telefonoPedido").val()) + '%0A';
            cadena_pedido += "%2A" + "Dirección:" + "%2A%20" + encodeURIComponent($("#direccionPedido").val()) + '%0A';
            cadena_pedido += "%2A" + "Ciudad:" + "%2A%20" + $("#ciudadPedido").val() + '%0A';
            cadena_pedido += "%2A" + "Observación:" + "%2A%20" + encodeURIComponent($("#observacionPedido").val()) + '%0A';
            var url_final = "https://api.whatsapp.com/send?phone=50230303187&text=" + cadena_pedido;
            window.open(url_final, "_blank");
            localStorage.setItem('nombrePedido', '' + $("#nombrePedido").val());
            localStorage.setItem('emailPedido', '' + $("#emailPedido").val());
            localStorage.setItem('telefonoPedido', '' + $("#telefonoPedido").val());
            localStorage.setItem('direccionPedido', '' + $("#direccionPedido").val());
            localStorage.setItem('ciudadPedido', '' + $("#ciudadPedido").val());
            localStorage.setItem('observacionPedido', '' + $("#observacionPedido").val());
        }



        function crear_cod_qr() {
            var ran = Math.random();
            $("#body_image").html(
                '<img src="http://www.codigos-qr.com/qr/php/qr_img.php?d=http%3A%2F%2Fcentrognet.xyz%2Fsoporte%2F&s=4&e=m" 
                alt = "Generador de Códigos QR Codes" / > ' );
            }

            function modal_youtube() {
                $('#video_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#video_youtube").html(
                    '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/jW_kb8UXf1k?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1"></iframe>'
                );
            }

            function cerrar_youtube() {
                $("#video_youtube").html('');
            }
    </script>




    <script>
        $(document).ready(function() {
            // SLIDER
            $('.images-properties').lightSlider({
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
        });
    </script>

</body>

</html>