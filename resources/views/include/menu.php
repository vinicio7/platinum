<!-- HORIZONTAL NAVBAR - INICIO -->
<nav class="navbar navbar-light bg-white menu-horizontal" id="menuHorizontal">
	<button class="navbar-toggler" type="button" id="compact_btn">
		<span class="navbar-toggler-icon"></span>
	</button>

	

	<ul class="nav justify-content-end">
		<li class="nav-item">
			<a class="nav-link active" href="#"><i class="fas fa-bell    "></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#"><i class="fas fa-envelope    "></i></a>
		</li>
	</ul>
</nav>
<!-- HORIZONTAL NAVBAR - FIN -->

<!-- VERTICAL NAVBAR - INICIO -->
<aside class="shadow menu-lateral" id="menuLateral">
	<div class="logo w-100 pt-3 pb-2 pr-3 pl-3 text-center">
		<img class="img-fluid large-logo" src="../assets/images/logos/logo_azul_centrado.svg" alt="">
		<img class="img-fluid icon-logo"  src="../assets/images/logos/icon_logo_azul.svg" alt="">
		<p class="text-muted mb-0"><small>Sistema v2.0</small> </p>
	</div>
	<h6 class="text-muted mt-3 mb-0 pl-3 menu-etiqueta">USUARIO</h6>
	<div class="user-info pt-3 pb-3 d-flex">
		<div class="image-user mr-3 ml-3">
			<img src="../assets/images/usuarios/<?php echo $id_users; ?>.png"
				class="img-fluid rounded-circle  shadow-md" alt="">
		</div>
		<div class="info pt-2">
			<a href="#" class="d-block text-decoration-none "><?php echo $username; ?></a>
			<a><small><?php echo $usertipe; ?></small></a>
		</div>
	</div>
	<h6 class="text-muted mt-2 mb-2 pl-3 menu-etiqueta">MENU</h6>
	<nav class="navbar p-0">
		<ul class="navbar-nav w-100">

		<?php
		$test = '123';
		$usertipe = $_SESSION['usertipe'];

			//Menu_Administrador_Gerente
			if ($usertipe == 1 or $usertipe == 2) 
			{ 
			?>
				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3 menu-activo " href="index.php" type="button"><i
						class="fas fa-home mr-3 icon-principal-menu"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_list.php" type="button" id="listaPropiedades1"><i
						class="fas fa-building mr-3 icon-principal-menu"></i>
						<span class="nav-label">Propiedades</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_pdf_list.php" type="button"><i
						class="fas fa-folder-open mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Favoritos (PDF)</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_xls_list.php" type="button"><i
						class="fas fa-folder-open mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Reportes (XLS)</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="mensaje_list.php" type="button"><i
						class="fas fa-envelope mr-3 icon-principal-menu"></i>
						<span class="nav-label">Mensajes</span>
					</a>
				</li>

				<li class="nav-item" hidden="true">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_mod_list.php" type="button"><i
						class="fas fa-file-alt mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Modificaciones</span>
					</a>
				</li>

				<li class="nav-item" hidden="true">
					<a class="nav-link principal-menu pr-3 pl-3" href="#" type="button"><i
						class="fas fa-calendar-plus mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Mantenimientos</span>
					</a>
				</li>

				<li class="nav-item" hidden="true">
					<a class="nav-link principal-menu pr-3 pl-3" href="#" type="button"><i
						class="fas fa-address-card mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Panel de Control</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="usuario_list.php" type="button" id="usuariosMenu1"><i
						class="fas fa-user mr-3 icon-principal-menu"></i>
						<span class="nav-label">Usuarios</span> 
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="../public/login_form.php?logout" type="button"><i
						class="ion-log-out mr-3 icon-principal-menu"></i>
						<span class="nav-label">Cerrar Sesión</span>
					</a>
				</li>
			<?php	
			} //Menu_Administrador_Gerente
		
			else {

			//Menu_Agentes
			if ($usertipe == 3) 
			{ 
			?>
				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3 menu-activo " href="index.php" type="button"><i
						class="fas fa-home mr-3 icon-principal-menu"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_list.php" type="button" id="listaPropiedades1"><i
						class="fas fa-building mr-3 icon-principal-menu"></i>
						<span class="nav-label">Buscar Propiedades</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_me.php" type="button"><i
						class="fas fa-folder-open mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Mis Propiedades</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_pdf_list.php" type="button"><i
						class="fas fa-folder-open mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Favoritos (PDF)</span>
					</a>
				</li>

				<li class="nav-item" hidden="true">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_mod_list.php" type="button"><i
						class="fas fa-file-alt mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Modificaciones</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="usuario_list.php" type="button" id="usuariosMenu1"><i
						class="fas fa-user mr-3 icon-principal-menu"></i>
						<span class="nav-label">Contactos</span> 
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="../public/login_form.php?logout" type="button"><i
						class="ion-log-out mr-3 icon-principal-menu"></i>
						<span class="nav-label">Cerrar Sesión</span>
					</a>
				</li>
			<?php	
			} //Menu_Agentes

			else {

			//Menu_Propietario
			if ($usertipe == 5) 
			{ 
			?>
				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3 menu-activo " href="index.php" type="button"><i
						class="fas fa-home mr-3 icon-principal-menu"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_me.php" type="button" id="listaPropiedades1"><i
						class="fas fa-building mr-3 icon-principal-menu"></i>
						<span class="nav-label">Mis Propiedades</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="mensaje_list.php" type="button"><i
						class="fas fa-envelope mr-3 icon-principal-menu"></i>
						<span class="nav-label">Mensajes</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="../public/login_form.php?logout" type="button"><i
						class="ion-log-out mr-3 icon-principal-menu"></i>
						<span class="nav-label">Cerrar Sesión</span>
					</a>
				</li>
			<?php	
			} //Menu_Propietario

			else {

			//Menu_Clientes
			if ($usertipe == 6) 
			{ 
			?>
				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3 menu-activo " href="index.php" type="button"><i
						class="fas fa-home mr-3 icon-principal-menu"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="propiedad_me.php" type="button"><i
						class="fas fa-folder-open mr-3 icon-principal-menu" aria-hidden="true"></i>
						<span class="nav-label">Favoritos</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="mensaje_list.php" type="button"><i
						class="fas fa-envelope mr-3 icon-principal-menu"></i>
						<span class="nav-label">Mensajes</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link principal-menu pr-3 pl-3" href="../public/login_form.php?logout" type="button"><i
						class="ion-log-out mr-3 icon-principal-menu"></i>
						<span class="nav-label">Cerrar Sesión</span>
					</a>
				</li>
			<?php	
			} //Menu_Clientes
			else {
			} //No_Permitido
			} //Menu_Propietario
			} //Menu_Agentes
			} //Menu_Administrador_Gerente
		?>

		</ul>
	</nav>
</aside>
<!-- VERTICAL NAVBAR - FIN -->