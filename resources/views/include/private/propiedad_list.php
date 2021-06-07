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
</head>

<body style="margin: 0!important;">
	<?php include 'include/menu.php'; ?>
	<div class="contenedor bg-light" id="contenedor">
		<div class="container-fluid bg-primary bg-blue-gradient"></div>
		<div class="container-fluid p-1 p-md-4 p-xl-5">
			<section class="content p-3 p-md-4 p-xl-5 rounded shadow" id="contentBox">

				<!-- BODY -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-lg-4 order-2 order-lg-2 ml auto d-none d-md-block">
							<h5 class="mb-4 text-center text-primary title-page-h5" style="font-size: 1.5rem;text-align: left !important;letter-spacing: 0.2rem">Propiedades</h5>
						</div>

							<!-- FORMULARIO_AGREGAR_PROP -->
						<div class="col-12 col-lg-8 mt-3 mt-md-3 mt-lg-0 order-1 order-lg-2">
							<form action="#" method="POST">
								<?php
									$usertipe = $_SESSION['usertipe'];
									//Menu_Administrador_Gerente
									if ($usertipe == 1 or $usertipe == 2) 
									{ 
								?>
								<a name="" 
									class="btn rounded-5 btn-info float-right current-bg-primary text-decoration-none pt-2 pb-2"
									href="propiedad_form.php" role="button"><i class="fas fa-plus"></i> Agregar Propiedad
								</a>
								<?php
									}
								?>
							</form>
						</div>
					</div>

					<div class="row">
						<!-- FORMULARIO BUSQUEDA - INICIO -->
						<div class="col-12 col-lg-4 order-1 order-lg-2 ml-auto">
							<form method="POST" name="busqueda" action="propiedad_list.php" autocomplete="off" class="px-4 pt-4 pb-2 forms-main shadow-sm bg-white sticky-fx">
								<div class="row">
									
									<div class="form-form col-12 col-md-6 col-lg-12 mb-3 custom-inputs order-1 order-md-1">
										<label for="estadoPropiedad" class="placeholder-label fix-placeholder-label">Estado:</label>
										<select class="form-control placeholder-input " id="estadoPropiedad" name="buscar_esta">
											<option value="0" class="outline-none"></option>
											<option value="1" class="outline-none">Venta</option>
											<option value="2" class="outline-none">Renta</option>
										</select>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mb-3 custom-inputs order-2 order-md-2">
										<input type="text" class="form-control placeholder-input " id="" placeholder="" name="buscar_dire">
										<label for="tipoBusq" class="placeholder-label fix-placeholder-label">Dirección:</label>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mb-3 custom-inputs order-3 order-md-3">
										<label for="tipoBusq" class="placeholder-label fix-placeholder-label">Tipo de Propiedad:</label>
										<select class="form-control placeholder-input" name="buscar_tipo">
											<option value="" selected></option>
											<option value="1">Casas</option>
											<option value="2">Apartamentos</option>
											<option value="3">Oficinas</option>
											<option value="4">Bodegas</option>
											<option value="5">Terrenos</option>
											<option value="6">Fincas</option>
											<option value="7">Clinicas</option>
											<option value="8">Casa de playa</option>
											<option value="9">Granjas</option>
											<option value="10">Edificios</option>
											<option value="11">Locales</option>
										</select>
									</div>

									<div class="form-form col-6 col-md-6 col-lg-12 custom-inputs m-0 mt-3 mt-md-0 order-8 order-md-12 order-lg-8 ml-auto">
										<button type="submit" class="btn btn-primary btn-block text-white btn-search">Buscar</button>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-4 order-md-5 order-lg-4">
										<label for="" class="placeholder-label fix-placeholder-label">Departamento:</label>
										<select class="form-control placeholder-input " placeholder="Seleccione" name="buscar_depa">
											<option value="" selected></option>
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
										</select>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-4 order-md-5 order-lg-4">
										<label for="" class="placeholder-label fix-placeholder-label">Municipio:</label>
										<select class="form-control placeholder-input " placeholder="Seleccione" name="buscar_muni">
											<option value="" selected></option>
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
										</select>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-4 order-md-5 order-lg-4">
										<label for="" class="placeholder-label fix-placeholder-label">Zona:</label>
										<select class="form-control placeholder-input " placeholder="Seleccione" name="buscar_zona">
											<option value="" selected></option>
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
										</select>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-4 order-md-5 order-lg-4">
										<label for="" class="placeholder-label fix-placeholder-label">Dormitorios:</label>
										<select class="form-control placeholder-input " placeholder="Seleccione" name="buscar_dorm">
											<option value="" selected></option>
											<option value="1">  1</option>
											<option value="2">  2</option>
											<option value="3">  3</option>
											<option value="4">  4</option>
											<option value="5">  5</option>
											<option value="6">  6</option>
											<option value="7">  7</option>
											<option value="8">  8</option>
											<option value="9">  9</option>
											<option value="10">10</option>
										</select>
									</div>

									<div class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-4 order-md-5 order-lg-4">
										<label for="" class="placeholder-label fix-placeholder-label">Niveles:</label>
										<select class="form-control placeholder-input " placeholder="Seleccione" name="buscar_nive">
											<option value="" selected></option>
											<option value="1">  1</option>
											<option value="2">  2</option>
											<option value="3">  3</option>
											<option value="4">  4</option>
											<option value="5">  5</option>
											<option value="6">  6</option>
											<option value="7">  7</option>
											<option value="8">  8</option>
											<option value="9">  9</option>
											<option value="10">10</option>
										</select>
									</div>

									<div
										class="form-form col-12 col-md-6 col-lg-12 mt-3 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-5 order-md-6 order-lg-5">
										<label for="" class="placeholder-label fix-placeholder-label">Código:</label>
										<input type="text" class="form-control placeholder-input " id="" placeholder="0" name="buscar_codi">
									</div>



									<div class="form-form col-12 col-md-6 mt-3 col-lg-12 mt-md-0 mb-3 custom-inputs collapse busqueda-avanzada order-7 order-md-8 order-lg-7">
										<label for="precioMax" class="placeholder-label fix-placeholder-label">Precio Máximo:</label>
										<div class="input-group">
											<div class="input-group-prepend custom-prepend">
												<span class="input-group-text prepend-icon "><i class="fas fa-dollar-sign"></i></span>
											</div>
											<input type="number" class="form-control placeholder-input  text-right" placeholder="0" name="buscar_maxi">
											<div class="input-group-append custom-append">
												<span class="input-group-text input-precio-busqueda append-icon-price">.00</span>
											</div>
										</div>
									</div>

								</div>
								<div class="col-12 mt-3 text-center">
									<a name="" id="" class="text-decoration-none" href=".busqueda-avanzada" role="button"
										data-toggle="collapse" aria-expanded="false" aria-controls="busqueda-avanzada"><small><i
										class="fa fa-plus" aria-hidden="true"></i> Búsqueda Avanzada</small></a>
								</div>
							</form>
						</div>

						<!-- BUSQUEDA_(NORMAL) -->
						<div class="col-12 col-lg-8 mt-3 mt-md-3 mt-lg-0 order-2 order-lg-1">
							<div class="row">

								<?php   
								$consulta='';
								$parametros='';

								if ($_POST['buscar_esta']!='')  {if($_POST['buscar_esta']==1) {$parametros.="in_pre_v > 0".'&';} if($_POST['buscar_esta']==2) {$parametros.="in_pre_r > 0".'&';}}
								if ($_POST['buscar_dire']!='') 	{$parametros.="in_di_di LIKE '%".$_POST['buscar_dire']."%' ".'&';}
								if ($_POST['buscar_tipo']!='') 	{$parametros.="in_tip_p =".		$_POST['buscar_tipo'].'&';}
								if ($_POST['buscar_depa']!='') 	{$parametros.="in_di_de =".		$_POST['buscar_depa'].'&';}
								if ($_POST['buscar_muni']!='') 	{$parametros.="in_di_mu =".		$_POST['buscar_muni'].'&';}
								if ($_POST['buscar_zona']!='') 	{$parametros.="in_di_zo =".		$_POST['buscar_zona'].'&';}
								if ($_POST['buscar_dorm']!='') 	{$parametros.="in_co_d1 =".		$_POST['buscar_dorm'].'&';}
								if ($_POST['buscar_nive']!='') 	{$parametros.="in_co_ni =".		$_POST['buscar_nive'].'&';}
								if ($_POST['buscar_codi']!='') 	{$parametros.="in_mu_id =".		$_POST['buscar_codi'].'&';}
								if ($_POST['buscar_asoc']!='') 	{$parametros.="in_vende =".		$_POST['buscar_asoc'].'&';}
								if ($_POST['buscar_maxi']!='') 	{$parametros.="in_pre_v >=".'1'.' and '."in_pre_v <=".$_POST['buscar_maxi'].' or '. "in_pre_r >=".'1'.' and '."in_pre_r <=".$_POST['buscar_maxi'].'&';}

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
								$consulta = substr ($consulta, 0, strlen($consulta) - 4); //Elimina AND del final
								//echo $consulta.'<br><br>'; //Muestra Estructura SQL

								if ($cantidad > 0)
								{
									//CONSULTA_PROPIEDADES_BUSQUEDA
									$query = mysqli_query($con,"SELECT * FROM `si_properties` WHERE $consulta ORDER BY `si_properties`.`in_mu_id` DESC");
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
															<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>"     data-tip="Ver Propiedad"      type="submit" class="btn property-view"><i class="fas fa-search"></i></a>
															<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
															<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn property-view afterpdflist"><i class="fas fa-file-alt"></i> </a>
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
														<p class="card-text"><small><i class="fas fa-exclamation-circle"></i><?php echo " Estado: ".($in_estat); ?> </small></p>
														<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
														<p class="property-details p-1">
															<!-- Esta línea es para los Dormitorios -->
															<?php if(($in_co_d1 + $in_co_d2)> 0){ ?>
																<span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span>
															<?php } ?>
															<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
															<?php if(($in_co_ba )> 0){ ?>
																<span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span>
															<?php } ?>
															<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
															<?php if(($in_co_p1 + $in_co_p2)> 0){ ?>
																<span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span>
															<?php } ?>
															<!-- Esta línea es para los niveles -->
															<?php if($in_co_ni > 0){ ?>
																<span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span>
															<?php } ?>
														</p>
														<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
														<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn btn-outline-primary property-view-btn afterpdflist"><i class="fas fa-file-alt"></i> Agregar a PDF</a>
														
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
																<!-- Esta línea contiene el enlace de Twiter del Asesor  -->
																<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_tw); ?>" role="button">
																	<span class="">
																		<i class="fab fa-twitter"></i>
																	</span>
																</a> -->
																<!-- Esta línea contiene el enlace de Instagram del Asesor  -->
																<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_in); ?>" role="button">
																	<span class=""><i class="ion-social-instagram"></i></span>
																</a> -->
																<!-- Esta línea contiene el enlace de Whatsapp del Asesor  -->
																<a class="btn  text-primary mb-lg-3 mb-xl-0" href="https://wa.me/502<?php echo ($aseso_te); ?>?text=Estoy%20interesado%20en%20ésta%20propiedad:%20Cod.%20<?php echo ($in_mu_id); ?>" role="button">
																	<span class=""><i class="ion-social-whatsapp"></i></span>													
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
									<?php
										for ($i = 1; $i <= $count_prop - 1; $i++) 
										{
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
											} else
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
											$in_tip_p = "Error4";
											} //NO EXISTE 

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
											<!-- PROPIEDAD 2-20 -->
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
															<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>"     data-tip="Ver Propiedad"      type="submit" class="btn property-view"><i class="fas fa-search"></i></a>
															<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
															<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn property-view afterpdflist"><i class="fas fa-file-alt"></i></a>
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
														<p class="card-text"><small><i class="fas fa-exclamation-circle"></i><?php echo " Estado: ".($in_estat); ?> </small></p>
														<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
														<p class="property-details p-1">
															<!-- Esta línea es para los Dormitorios -->
															<?php if(($in_co_d1)> 0){ ?> <span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span> <?php } ?>
															<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
															<?php if(($in_co_ba)> 0){ ?> <span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span> <?php } ?>
															<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
															<?php if(($in_co_p1)> 0){ ?> <span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span> <?php } ?>
															<!-- Esta línea es para los niveles -->
															<?php if($in_co_ni > 0){ ?> <span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span> <?php } ?>
														</p>
														<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
														<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn btn-outline-primary property-view-btn afterpdflist"><i class="fas fa-file-alt"></i> Agregar a PDF</a>
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
																<!-- Esta línea contiene el enlace de Twiter del Asesor  -->
																<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_tw); ?>" role="button">
																	<span class="">
																		<i class="fab fa-twitter"></i>
																	</span>
																</a> -->
																<!-- Esta línea contiene el enlace de Instagram del Asesor  -->
																<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_in); ?>" role="button">
																	<span class=""><i class="ion-social-instagram"></i></span>
																</a> -->
																<!-- Esta línea contiene el enlace de Whatsapp del Asesor  -->
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
									} ?>

									</div>
									<?php
								}
								else
								{
									?>
									<!-- LISTADO DE PROPIEDADES -->
										<?php
											//--CONSULTA DE PROPIEDADES (TODAS)--    
											$query = mysqli_query($con,"SELECT * FROM `si_properties` ORDER BY `si_properties`.`in_mu_id` DESC");
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
												} else
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
												} //NO EXISTE 

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
																<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>"     data-tip="Ver Propiedad"      type="submit" class="btn property-view"><i class="fas fa-search"></i></a>
																<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
																<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn property-view afterpdflist"><i class="fas fa-file-alt"></i></a>
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
															<p class="card-text"><small><i class="fas fa-exclamation-circle"></i><?php echo " Estado: ".($in_estat); ?> </small></p>
															<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
															<p class="property-details p-1">
																<!-- Esta línea es para los Dormitorios -->
																<?php if(($in_co_d1)> 0){ ?> <span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span> <?php } ?>
																<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
																<?php if(($in_co_ba)> 0){ ?> <span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span> <?php } ?>
																<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
																<?php if(($in_co_p1)> 0){ ?> <span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span> <?php } ?>
																<!-- Esta línea es para los niveles -->
																<?php if($in_co_ni > 0){ ?> <span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span> <?php } ?>
															</p>
															<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
															<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn btn-outline-primary property-view-btn afterpdflist"><i class="fas fa-file-alt"></i> Agregar a PDF</a>
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
																	<!-- Esta línea contiene el enlace de Twiter del Asesor  -->
																	<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_tw); ?>" role="button">
																		<span class="">
																			<i class="fab fa-twitter"></i>
																		</span>
																	</a> -->
																	<!-- Esta línea contiene el enlace de Instagram del Asesor  -->
																	<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_in); ?>" role="button">
																		<span class=""><i class="ion-social-instagram"></i></span>
																	</a> -->
																	<!-- Esta línea contiene el enlace de Whatsapp del Asesor  -->
																	<a class="btn  text-primary mb-lg-3 mb-xl-0" href="https://wa.me/502<?php echo ($aseso_te); ?>?text=Estoy%20interesado%20en%20ésta%20propiedad:%20Cod.%20<?php echo ($in_mu_id); ?>" role="button">
																		<span class=""><i class="ion-social-whatsapp"></i></span>													
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
										<?php
											for ($i = 1; $i <= $count_prop - 1 and $i < 22; $i++) 
											{
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
												} else
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
												$in_tip_p = "Error4";
												} //NO EXISTE 

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
													if ($aseso_pr == 1)  {$aseso_pr = "Sr";} 					else
													if ($aseso_pr == 2)  {$aseso_pr = "Sra";} 					else
													if ($aseso_pr == 3)  {$aseso_pr = "Srita";} 				else
													if ($aseso_pr == 4)  {$aseso_pr = "Ing";} 					else
													if ($aseso_pr == 5)  {$aseso_pr = "Dr";} 					else 
													if ($aseso_pr == 6)  {$aseso_pr = "Dra";} 					else 
													if ($aseso_pr == 7)  {$aseso_pr = "Lic";} 					else 
													if ($aseso_pr == 8)  {$aseso_pr = "Licda";} 				else 
													if ($aseso_pr == 9)  {$aseso_pr = "Baco";} 					else 
													if ($aseso_pr == 10) {$aseso_pr = "Conta";} 				else 
													if ($aseso_pr == 11) {$aseso_pr = "Prof";} 					else 
													if ($aseso_pr == 12) {$aseso_pr = "Profa";} 				else 							
													if ($aseso_pr == 13) {$aseso_pr = "Asociado Platinum";} 	else
													if ($aseso_pr == 14) {$aseso_pr = "Asociada Platinum";} 	else
													if ($aseso_pr == 15) {$aseso_pr = "Asociado Senior";} 		else
													if ($aseso_pr == 16) {$aseso_pr = "Asociada Senior";} 		else
													if ($aseso_pr == 17) {$aseso_pr = "Asociado Élite";} 		else
													if ($aseso_pr == 18) {$aseso_pr = "Asociada Élite";} 		else
													if ($aseso_pr == 19) {$aseso_pr = "Broker";} 	else
													{$aseso_pr = " - ";}
											?>	
												<!-- PROPIEDAD 2-20 -->
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
																<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>"     data-tip="Ver Propiedad"      type="submit" class="btn property-view"><i class="fas fa-search"></i></a>
																<a href="https://api.whatsapp.com/send?text=Abre%20este%20link%20para%20mas%20detalles%20de%20la%20propiedad%20https://propiedadesplatinum.com/public/propiedad_view.php?id=<?php echo($in_mu_id);?>" data-tip="Compartir" type="submit" class="btn property-view"><i class="fas fa-share-alt"></i></a>
																<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn property-view afterpdflist"><i class="fas fa-file-alt"></i></a>
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
															<p class="card-text"><small><i class="fas fa-exclamation-circle"></i><?php echo " Estado: ".($in_estat); ?> </small></p>
															<!-- Esta línea es para los Detalles de la Descripción de la Propiedad -->
															<p class="property-details p-1">
																<!-- Esta línea es para los Dormitorios -->
																<?php if(($in_co_d1)> 0){ ?> <span class="detail"><i class="fa fa-bed"></i><?php echo ($in_co_d1); ?></span> <?php } ?>
																<!-- Esta línea es para los baños, aquí sume los baños principales y de servicio -->
																<?php if(($in_co_ba)> 0){ ?> <span class="detail"><i class="fa fa-bath"></i><?php echo ($in_co_ba); ?></span> <?php } ?>
																<!-- Esta línea es para los parqueos, aquí sume los parqueos techados y no techados -->
																<?php if(($in_co_p1)> 0){ ?> <span class="detail"><i class="fas fa-parking"></i><?php echo ($in_co_p1); ?></span> <?php } ?>
																<!-- Esta línea es para los niveles -->
																<?php if($in_co_ni > 0){ ?> <span class="detail"><i class="fas fa-building"></i><?php echo ($in_co_ni); ?></span> <?php } ?>
															</p>
															<a href="propiedad_view.php?id=<?php echo ($in_mu_id); ?>" data-tip="Ver Propiedad" type="submit" class="btn btn-outline-primary property-view-btn"><i class="fas fa-search"></i> Ver Propiedad</a>
															<a href="#" role="button" data-tip="Agregar a PDF" data-id="<?php echo ($in_mu_id); ?>" type="submit" class="btn btn-outline-primary property-view-btn afterpdflist"><i class="fas fa-file-alt"></i> Agregar a PDF</a>
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
																	<!-- Esta línea contiene el enlace de Twiter del Asesor  -->
																	<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_tw); ?>" role="button">
																		<span class="">
																			<i class="fab fa-twitter"></i>
																		</span>
																	</a> -->
																	<!-- Esta línea contiene el enlace de Instagram del Asesor  -->
																	<!-- <a name="" id="" class="btn  text-primary  " href="<?php // echo ($aseso_in); ?>" role="button">
																		<span class=""><i class="ion-social-instagram"></i></span>
																	</a> -->
																	<!-- Esta línea contiene el enlace de Whatsapp del Asesor  -->
																	<a class="btn  text-primary mb-lg-3 mb-xl-0" href="https://wa.me/502<?php echo ($aseso_te); ?>?text=Estoy%20interesado%20en%20ésta%20propiedad:%20Cod.%20<?php echo ($in_mu_id); ?>" role="button">
																		<span class=""><i class="ion-social-whatsapp"></i></span>													
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php
											}} ?>

										</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>

				</div>

			</section>
		</div>
		<div class="creating-pdf shadow-lg">
			<p>Agregado a la lista de PDF
			
			</p>
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
	<?php  include 'include/scripts.php';  ?>
		
	<!-- jQuery 3.5.1 -->
	<!-- <script src="../assets/js/jquery-3.5.1.min.js"></script> -->
	<!-- Bootstrap 4 -->
	<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<!-- App Dashboard -->
	<script src="../assets/js/app_dashboard.js"></script> 

	<script>
	function pdfhidelist() {
		$('#pdflist').ready(function () {
			setTimeout(function(){ $('.adding-pdf').removeClass("show"); }, 1500);
		});
	}
	$(document).ready(function() {
		// initGeneral();<?php echo ($in_mu_id); ?>
		var id = jQuery(this).data('id');
		$('.afterpdflist').click(function (e) { 
			e.preventDefault();

			var pdfid = jQuery(this).data('id');
			// $('.adding-pdf').show("swing");
			$('.adding-pdf').addClass('show');
			$('#afterpdflist').after('<iframe id="pdflist" src="propiedad_pdf_list.php?id=' + pdfid + '" onLoad="pdfhidelist()" marginwidth="0" marginheight="0" name="pdfcontainer" scrolling="no" border="0" frameborder="0" width="0" height="0"></iframe>');
		});
	});
	</script>

</body>

</html>
