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
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
	header("location: ../public/login_form.php");
	exit;
}

//Base de Datos
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

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
		<h3>Mis Propiedades</h3>

		<form method="POST" />
		<div class="row">

			<?php
			//--CONSULTA DE PROPIEDADES (FAVORITAS)--    
			$query = mysqli_query($con,"
			SELECT * 
			FROM `si_properties` 
			WHERE 
			`si_properties`.`in_vende` = '".$id_users."' ");
			$count_prop = mysqli_num_rows($query);
			$ferow = mysqli_fetch_array($query);
			if ($count_prop > 0) 
			{
				$in_mu_id = $ferow['in_mu_id']; //id
				$in_titul = utf8_encode($ferow['in_titul']); //titulo
				$in_pre_v = $ferow['in_pre_v']; //precio venta
				$in_pre_r = $ferow['in_pre_r']; //precio renta
				$in_direc = utf8_encode($ferow['in_di_di']); //direcion
				$in_vende = $ferow['in_vende']; //agente
				$in_de_ot = utf8_encode($ferow['in_de_ot']); //detalles
				$in_estat = $ferow['in_estat']; //estado
				$in_tip_p = $ferow['in_tip_p']; //tipo
				$in_co_d1 = $ferow['in_co_d1']; //dormitorios
				$in_co_d2 = $ferow['in_co_d2']; //dormitorios de servicio
				$in_co_ba = $ferow['in_co_ba']; //baños
				$in_co_bs = $ferow['in_co_bs']; //baños de servicio
				$in_co_p1 = $ferow['in_co_p1']; //parqueos
				$in_di_de = $ferow['in_di_de']; //Inmueble Dirección Departamento
				$in_di_mu = $ferow['in_di_mu']; //Inmueble Dirección Municipio
				$in_co_ni = $ferow['in_co_ni']; //niveles

				if ($in_estat == 0) 
				{$in_estat = "Activa";} else
				if ($in_estat == 1) 
				{$in_estat = "Vendida";}else 
				{$in_estat = "Alquilada";}

				if ($in_tip_p == 1) {
				$in_tip_p = "Casa";
				} 
				else
				if ($in_tip_p == 2) {
				$in_tip_p = "Apartamento";
				}
				else
				if ($in_tip_p == 3) {
				$in_tip_p = "Oficina";
				}
				else
				if ($in_tip_p == 4) {
				$in_tip_p = "Bodega";
				}
				else
				if ($in_tip_p == 5) {
				$in_tip_p = "Terreno";
				}
				else
				if ($in_tip_p == 6) {
				$in_tip_p = "Finca";
				}
				else
				if ($in_tip_p == 7) {
				$in_tip_p = "Clinica";
				}
				else
				if ($in_tip_p == 8) {
				$in_tip_p = "Casa de playa";
				}
				else
				if ($in_tip_p == 9) {
				$in_tip_p = "Granja";
				}
				else
				if ($in_tip_p == 10) {
				$in_tip_p = "Edificio";
				}
				else
				if ($in_tip_p == 11) {
				$in_tip_p = "Local";
				}
				else {
				$in_tip_p = "-";
				} 

				if ($in_pre_v > 0 and $in_pre_r > 0) {
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

				if ($in_pre_v > 0 and $in_pre_r > 0) {
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

				include 'include/dep_value.php';
				include 'include/mun_value.php';

				//CONSULTA CORREDOR  
				$query2 = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "' ORDER BY `id_users` DESC ");
				$count_core = mysqli_num_rows($query2); $ferow = mysqli_fetch_array($query2);
				if ($count_core > 0) 
				{
					$id_vende = $ferow['id_users'];
					$in_vende = utf8_encode($ferow['firstnam'] . " " . $ferow['lastname']);
					$aseso_pr = $ferow['userprof'];  //Usuario Profesión
					$aseso_te = $ferow['phonenum'];  //Usuario Telefono
					$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
					//REDES SOCIALES
					$aseso_fb = $ferow['userface'];  //Usuario Facebook
					$aseso_tw = $ferow['usertwit'];  //Usuario Twitter
					$aseso_wa = $ferow['userwhat'];  //Usuario Whatsapp
					$aseso_in = $ferow['userinst'];  //Usuario Instagram
					$aseso_li = $ferow['userlink'];  //Usuario LinkedIn
					$aseso_yo = $ferow['useryout'];  //Usuario Youtube
					$aseso_pi = $ferow['userpint'];  //Usuario Pinterest
				}
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
					if ($aseso_pr == 19) {$aseso_pr = "Broker";} 	else
					{$aseso_pr = " - ";}
			?>

			<!-- PROPIEDAD 1 -->
			<div class="col-12 col-md-6  mb-3">
				<div class="col-12 info-property-content shadow-sm">
					<div class="picture-container">
						<img src="../assets/images/propiedades/<?php echo ($in_mu_id); ?>/1.jpg" alt="" class="pictures-property">
						<div class="estate-property">
							<!-- estas lineas muestran la etiqueta y precio de venta -->
							<?php if($in_pre_v > 0){ ?>
							<div class="sale-bar">
								<span class="sale-label shadow-lg">VENTA</span>
								<span class="price-sale-label">$<?php echo number_format($in_pre_v, 2, '.', ','); ?></span>
							</div>
							<?php } if($in_pre_r > 0){ ?>
							<!-- estas lineas muestran la etiqueta y precio de renta -->
							<div class="rent-bar">
								<span class="rent_label shadow-lg">RENTA</span>
								<span class="price-rent-label">$<?php echo number_format($in_pre_r, 2, '.', ','); ?><small>/M</small></span>
							</div>
							<?php } ?>
						</div>
						<!-- Esta línea es para el código de la propiedad -->
						<span class="code-property">Cod. <?php echo ($in_mu_id); ?></span>
						<!-- Esta línea es para el tipo de propiedad -->
						<span class="kind-property">Tipo: <?php echo ($in_tip_p); ?></span>
						<!-- Esta línea es para mostrar la lupa de ver la propiedad -->
						<div class="tools-property-main-thumb">
							<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
							<a href="propiedad_pdf_list.php?id=<?php echo ($in_mu_id); ?>" data-tip="Agregar a PDF"      type="submit" class="btn property-view"><i class="fas fa-file-alt"></i></a>
							<a href="propiedad_mod_list.php?id=<?php echo ($in_mu_id); ?>" data-tip="Hacer Modificación" type="submit" class="btn property-view"><i class="fas fa-eye-dropper"></i></a>
						</div>
					</div>
					<div class="info-property-container border-0 text-center">
						<!-- Esta línea es para el título de la Propiedad -->
						<div class="title-style-cont">
							<h6 class="m-0 p-2 text-primary">
								<textarea rows="4" disabled="" class="property-title-two-line-list">
									<?php echo ($in_titul); ?>
								</textarea>
							</h6>
						</div>
						<!-- Esta línea es para la Descripción de la Propiedad -->
						<!-- <p class="property-description text-primary pr-3 pl-3 pr-md-2 pl-md-2"><?php // echo ($in_de_ot); ?></p> -->
						<!-- Esta línea es para el Municipio y Departamento -->
						<p class="card-text"><small><i class="fas fa-map-marker-alt mr-2"></i><?php echo ($in_di_mu.", ".$in_di_de); ?> </small></p>
						<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
						<p class="property-details p-1">
							<!-- Esta línea es para los Dormitorios -->
							<?php if(($in_co_d1)> 0){ ?>
								<span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span>
							<?php } ?>
							<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
							<?php if(($in_co_ba )> 0){ ?>
								<span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span>
							<?php } ?>
							<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
							<?php if(($in_co_p1)> 0){ ?>
								<span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span>
							<?php } ?>
							<!-- Esta línea es para los niveles -->
							<?php if($in_co_ni > 0){ ?>
								<span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span>
							<?php } ?>
						</p>
						<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
						<!-- Esta línea es para el nombre del Asesor -->
						<a class="btn agent m-0 border-0 rounded-0" href=".info-agent-main-<?php echo ($in_mu_id); ?>" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="info-agent-main-<?php echo ($in_mu_id); ?>"><?php echo ($aseso_pr); ?>:
							<br>
							<?php echo ($in_vende); ?></a>

						<div class="col-12 p-0 text-center contact-asesor-main info-agent-main-<?php echo ($in_mu_id); ?> collapse">
							<!-- Esta línea contiene la foto del Asesor -->
							<div class="p-0 mb-3 mx-auto picture-usuario" style="height: 350px;">
								<img class="" src="../assets/images/usuarios/<?php echo ($id_vende); ?>.png" alt="nombre_asesor">
							</div>
							<div class="col-12 my-3 p-0 text-center info-social ">
								<!-- Esta línea contiene el enlace para llamar al Asesor  -->
								<a class="btn text-primary  contact-main-btn" href="tel:+502<?php echo ($aseso_te); ?>" role="button">
									<span class="" style="font-size: 0.95rem;"><i class="fas fa-phone" style="transform: rotate(90deg);"></i>
									</span>
								</a>
								<!-- Esta línea contiene el enlace del email del Asesor  -->
								<a class="btn contact-main-btn text-primary " href="mailto:<?php echo ($aseso_co); ?>">
									<span class=""><i class="fas fa-envelope"></i></span>
								</a>															
								<!-- Esta línea contiene el enlace de Facebook del Asesor  -->
								<a name="" id="" class="btn  text-primary  " href="<?php echo ($aseso_fb); ?>" role="button">
									<span class="">
										<i class="fab fa-facebook"></i>
									</span>													
								</a>
								<a class="btn  text-primary mb-lg-3 mb-xl-0" href="https://wa.me/502<?php echo ($aseso_te); ?>?text=Estoy%20interesado%20en%20ésta%20propiedad:%20Cod.%20<?php echo ($in_mu_id); ?>" role="button">
									<span class=""><i class="ion-social-whatsapp"></i></span>													
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			}
			for ($i = 1; $i <= $count_prop - 1; $i++) 
			{
				//Repetir
				$ferow = mysqli_fetch_array($query);

				$in_mu_id = $ferow['in_mu_id']; //id
				$in_titul = utf8_encode($ferow['in_titul']); //titulo
				$in_pre_v = $ferow['in_pre_v']; //precio venta
				$in_pre_r = $ferow['in_pre_r']; //precio renta
				$in_direc = utf8_encode($ferow['in_di_di']); //direcion
				$in_vende = $ferow['in_vende']; //agente
				$in_de_ot = utf8_encode($ferow['in_de_ot']); //detalles
				$in_estat = $ferow['in_estat']; //estado
				$in_tip_p = $ferow['in_tip_p']; //tipo
				$in_co_d1 = $ferow['in_co_d1']; //dormitorios
				$in_co_d2 = $ferow['in_co_d2']; //dormitorios de servicio
				$in_co_ba = $ferow['in_co_ba']; //baños
				$in_co_bs = $ferow['in_co_bs']; //baños de servicio
				$in_co_p1 = $ferow['in_co_p1']; //parqueos
				$in_di_de = $ferow['in_di_de']; //Inmueble Dirección Departamento
				$in_di_mu = $ferow['in_di_mu']; //Inmueble Dirección Municipio
				$in_co_ni = $ferow['in_co_ni']; //niveles

				if ($in_estat == 0) 
				{$in_estat = "Activa";} else
				if ($in_estat == 1) 
				{$in_estat = "Vendida";}else 
				{$in_estat = "Alquilada";}

				if ($in_tip_p == 1) {
				$in_tip_p = "Casa";
				} 
				else
				if ($in_tip_p == 2) {
				$in_tip_p = "Apartamento";
				}
				else
				if ($in_tip_p == 3) {
				$in_tip_p = "Oficina";
				}
				else
				if ($in_tip_p == 4) {
				$in_tip_p = "Bodega";
				}
				else
				if ($in_tip_p == 5) {
				$in_tip_p = "Terreno";
				}
				else
				if ($in_tip_p == 6) {
				$in_tip_p = "Finca";
				}
				else
				if ($in_tip_p == 7) {
				$in_tip_p = "Clinica";
				}
				else
				if ($in_tip_p == 8) {
				$in_tip_p = "Casa de playa";
				}
				else
				if ($in_tip_p == 9) {
				$in_tip_p = "Granja";
				}
				else
				if ($in_tip_p == 10) {
				$in_tip_p = "Edificio";
				}
				else
				if ($in_tip_p == 11) {
				$in_tip_p = "Local";
				}
				else {
				$in_tip_p = "-";
				} 

				if ($in_pre_v > 0 and $in_pre_r > 0) {
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

				if ($in_pre_v > 0 and $in_pre_r > 0) {
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

				include 'include/dep_value.php';
				include 'include/mun_value.php';

				//CONSULTA CORREDOR  
				$query2 = mysqli_query($con,"SELECT * FROM `si_users` WHERE `id_users`= '" . $in_vende . "' ORDER BY `id_users` DESC ");
				$count_core = mysqli_num_rows($query2); $ferow = mysqli_fetch_array($query2);
				if ($count_core > 0) 
				{
					$id_vende = $ferow['id_users'];
					$in_vende = utf8_encode($ferow['firstnam'] . " " . $ferow['lastname']);
					$aseso_pr = $ferow['userprof'];  //Usuario Profesión
					$aseso_te = $ferow['phonenum'];  //Usuario Telefono
					$aseso_co = utf8_encode($ferow['usermail']);  //Usuario Correo
					//REDES SOCIALES
					$aseso_fb = $ferow['userface'];  //Usuario Facebook
					$aseso_tw = $ferow['usertwit'];  //Usuario Twitter
					$aseso_wa = $ferow['userwhat'];  //Usuario Whatsapp
					$aseso_in = $ferow['userinst'];  //Usuario Instagram
					$aseso_li = $ferow['userlink'];  //Usuario LinkedIn
					$aseso_yo = $ferow['useryout'];  //Usuario Youtube
					$aseso_pi = $ferow['userpint'];  //Usuario Pinterest
				}
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
					if ($aseso_pr == 19) {$aseso_pr = "Broker";} 	else
					{$aseso_pr = " - ";}
			?>

			<!-- PROPIEDAD 2 EN ADELANTE -->
			<div class="col-12 col-md-6  mb-3">
				<div class="col-12 info-property-content shadow-sm">
					<div class="picture-container">
						<img src="../assets/images/propiedades/<?php echo ($in_mu_id); ?>/1.jpg" alt="" class="pictures-property">
						<div class="estate-property">
							<!-- estas lineas muestran la etiqueta y precio de venta -->
							<?php if($in_pre_v > 0){ ?>
							<div class="sale-bar">
								<span class="sale-label shadow-lg">VENTA</span>
								<span class="price-sale-label">$<?php echo number_format($in_pre_v, 2, '.', ','); ?></span>
							</div>
							<?php } if($in_pre_r > 0){ ?>
							<!-- estas lineas muestran la etiqueta y precio de renta -->
							<div class="rent-bar">
								<span class="rent_label shadow-lg">RENTA</span>
								<span class="price-rent-label">$<?php echo number_format($in_pre_r, 2, '.', ','); ?><small>/M</small></span>
							</div>
							<?php } ?>
						</div>
						<!-- Esta línea es para el código de la propiedad -->
						<span class="code-property">Cod. <?php echo ($in_mu_id); ?></span>
						<!-- Esta línea es para el tipo de propiedad -->
						<span class="kind-property">Tipo: <?php echo ($in_tip_p); ?></span>
						<!-- Esta línea es para mostrar la lupa de ver la propiedad -->
						<div class="tools-property-main-thumb">
							<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
							<a href="propiedad_pdf_list.php?id=<?php echo ($in_mu_id); ?>" data-tip="Agregar a PDF"      type="submit" class="btn property-view"><i class="fas fa-file-alt"></i></a>
							<a href="propiedad_mod_list.php?id=<?php echo ($in_mu_id); ?>" data-tip="Hacer Modificación" type="submit" class="btn property-view"><i class="fas fa-eye-dropper"></i></a>
						</div>
					</div>
					<div class="info-property-container border-0 text-center">
						<!-- Esta línea es para el título de la Propiedad -->
						<div class="title-style-cont">
							<h6 class="m-0 p-2 text-primary">
								<textarea rows="4" disabled="" class="property-title-two-line-list">
									<?php echo ($in_titul); ?>
								</textarea>
							</h6>
						</div>
						<!-- Esta línea es para la Descripción de la Propiedad -->
						<!-- <p class="property-description text-primary pr-3 pl-3 pr-md-2 pl-md-2"><?php // echo ($in_de_ot); ?></p> -->
						<!-- Esta línea es para el Municipio y Departamento -->
						<p class="card-text"><small><i class="fas fa-map-marker-alt mr-2"></i><?php echo ($in_di_mu.", ".$in_di_de); ?> </small></p>
						<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
						<p class="property-details p-1">
							<!-- Esta línea es para los Dormitorios -->
							<?php if(($in_co_d1)> 0){ ?>
								<span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span>
							<?php } ?>
							<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
							<?php if(($in_co_ba )> 0){ ?>
								<span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span>
							<?php } ?>
							<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
							<?php if(($in_co_p1)> 0){ ?>
								<span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span>
							<?php } ?>
							<!-- Esta línea es para los niveles -->
							<?php if($in_co_ni > 0){ ?>
								<span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span>
							<?php } ?>
						</p>
						<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
						<!-- Esta línea es para el nombre del Asesor -->
						<a class="btn agent m-0 border-0 rounded-0" href=".info-agent-main-<?php echo ($in_mu_id); ?>" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="info-agent-main-<?php echo ($in_mu_id); ?>"><?php echo ($aseso_pr); ?>:
							<br>
							<?php echo ($in_vende); ?></a>

						<div class="col-12 p-0 text-center contact-asesor-main info-agent-main-<?php echo ($in_mu_id); ?> collapse">
							<!-- Esta línea contiene la foto del Asesor -->
							<div class="p-0 mb-3 mx-auto picture-usuario" style="height: 350px;">
								<img class="" src="../assets/images/usuarios/<?php echo ($id_vende); ?>.png" alt="nombre_asesor">
							</div>
							<div class="col-12 my-3 p-0 text-center info-social ">
								<!-- Esta línea contiene el enlace para llamar al Asesor  -->
								<a class="btn text-primary  contact-main-btn" href="tel:+502<?php echo ($aseso_te); ?>" role="button">
									<span class="" style="font-size: 0.95rem;"><i class="fas fa-phone" style="transform: rotate(90deg);"></i>
									</span>
								</a>
								<!-- Esta línea contiene el enlace del email del Asesor  -->
								<a class="btn contact-main-btn text-primary " href="mailto:<?php echo ($aseso_co); ?>">
									<span class=""><i class="fas fa-envelope"></i></span>
								</a>															
								<!-- Esta línea contiene el enlace de Facebook del Asesor  -->
								<a name="" id="" class="btn  text-primary  " href="<?php echo ($aseso_fb); ?>" role="button">
									<span class="">
										<i class="fab fa-facebook"></i>
									</span>													
								</a>
								<a class="btn  text-primary mb-lg-3 mb-xl-0" href="https://wa.me/502<?php echo ($aseso_te); ?>?text=Estoy%20interesado%20en%20ésta%20propiedad:%20Cod.%20<?php echo ($in_mu_id); ?>" role="button">
									<span class=""><i class="ion-social-whatsapp"></i></span>													
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			}
			?>

		</div>
		</form>
				
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