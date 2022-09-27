<!DOCTYPE html>
<html lang="es">
<head>
	<title>SGCDOC</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../IMAGES/icons/icono.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/bootstrap/v4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../VENDOR/bootstrap/css/bootstrap.min.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../FONTS/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../FONTS/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../VENDOR/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="../SWEETALERT/dist/sweetalert2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="../CSS/mainEmpre.css">
	<link rel="stylesheet" href="../CSS/navbar.css">
	<!--===============================================================================================-->
</head>
<!-- id="btn_sesion_c" -->
<body>
	<body background="../IMAGES/img/fondoem.png">
	<nav>
        <div class="container">
            <div class="container-logo">
                <h2><span></span><img src="../IMAGES/img/logo.png" alt=""></h2>
            </div>

			    <ul class="links ">
                <li class="link" ><a  href="#" aria-hidden="true" data-toggle="modal" data-target="#ventanaModal"><img class="mas" src="../IMAGES/img/mas.png"></a></li>
                <li class="link dropdown">
				 <a class="link pr-0" href="#" role="button" id="dropdownc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="media align-items-center">
					  <span class="avatar avatar-sm rounded-circle">
						<img alt="perfil" src="../IMAGES/img/perfil.png">
					  </span>
					  <div class="media-body  ml-2  d-none d-lg-block">
						<span class="nomb-user ml-2 font-weight-bold"><?php echo $nombre;?></span>
					  </div>
					</div>
				  </a>

				  <div class="dropdown-menu  dropdown-menu-right "> 
				
					<a href="../Perfil/index.html" class="dropdown-item" data-toggle="modal" data-target="#miperfil">
					  <i class="ni ni-single-02"></i>
					  <span>Mi perfil</span>
					</a>
				<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item" id="btn_sesion_c">
					  <i class="fa fa-sign-out"></i>
					  <span>Cerrar Sesion</span>
					</a>
				  </div>
				</li>
			
            </ul>

            <div class="toggle">
                |||
            </div>
        </div>
    </nav>
	<!-- <nav class="navbar border-bottom navbar-expand ">
		<div class="container-fluid">
			<h3 class="title_Emmpre">Empresas</h3>
			<ul class="navbar-nav mx-3"><i class="fa fa-plus-square-o" aria-hidden="true" data-toggle="modal" data-target="#ventanaModal"></i> -->
				<!-- Modal  -->
			<div class="modal fade" id="ventanaModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel">Registrar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">


							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="unirse-tab" data-toggle="tab" href="#unirse" role="tab" aria-controls="unirse" aria-selected="true">Unirse</a>
								</li>

								<li class="nav-item">
								  <a class="nav-link" id="crear-tab" data-toggle="tab" href="#crear" role="tab" aria-controls="crear" aria-selected="false">Crear</a>
								</li>

							  </ul>
							  <div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="unirse" role="tabpanel" aria-labelledby="unirse-tab">
									<form class="row px-2 g-3 mt-2 needs-validation " id="formJoin"  novalidate>
										<span class="d-flex justify-content-center h3 text-muted">Unirme a una Empresa</span>
										<div class="col-lg-8">
											<label for="Code" class="form-label">Código de la Empresa</label>
											<input type="text" class="form-control" id="Code" maxlength="10" minlength="4" placeholder="Código" autocomplete="off" required>
											<div class="valid-feedback">valido!</div>
											<p class="font-weight-light user-select-none">Usa el código de la empresa con 7 caracteres minimo (mayúsculas y minúsculas)</p>
										</div>

										<div class="row mt-2 pl-2">
											<div class="col-lg-8">
												<div class="form-group">
													<div class="input-group mb-1">
														<span class="input-group-text" >Contraseña:</span>
														<input type="password" id="passuni" class="form-control" aria-label="password" aria-describedby="passuni" maxlength="10">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="CheckShowPass">
														<label class="small form-check-label p-0 font-weight-light user-select-none" for="CheckShowPass">Mostrar Contraseña</label>
													</div>
													<p class="font-weight-light user-select-none">Ingresa la contraseña para unirse</p>
												</div>
											</div>
										</div>
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Unirse</button>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="crear" role="tabpanel" aria-labelledby="crear-tab">
									<form class="row px-2 g-3 mt-2 needs-validation " action="#" method="POST" enctype="multipart/form-data" id="formaddemp" novalidate>
										<span class="d-flex justify-content-center h3 text-muted">Registrar mi Empresa</span>
										<div class="col-lg-11">
											<label for="validationrazon" class="form-label mb-1">Nombre de la Empresa (Razón Social).</label>
											<input type="text" class="form-control" id="validationrazon" name="addnombre" minlength="3" placeholder="ej. Empresa S.A. de C.V." autocomplete="off" required>
											<div class="valid-feedback">valido!</div>
										</div>
										<div class="col-lg-11 mb-2">
											<div class="mb-1">
												<label for="formFile" class="form-label">Logo empresarial</label>
												<input class="form-control" type="file" id="formFile" name="addfile" accept="image/png,image/jpeg,image/jpg" required>
											</div>
											<p class="font-weight-light user-select-none">Archivos .jpg, .jpeg o .png ,con tamaño máx. de 15MB</p>
										</div>
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Crear</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			</ul>
			
			<!-- Modal -->
			<div class="modal fade" id="miperfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-user-o" aria-hidden="true"></i> Mi Perfil</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Form Profile -->
					<form class="needs-validation" id="form_miperfil" novalidate>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="miperfil_name">Nombre</label>
								<input type="text" class="form-control" id="miperfil_name" value="<?php echo $name;?>" required minlength="2" maxlength="20" autocomplete="off">
								<div class="valid-feedback">valido!</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="miperfil_lastname">Apellido</label>
								<input type="text" class="form-control" id="miperfil_lastname" value="<?php echo $lastname;?>" required minlength="2" autocomplete="off">
								<div class="valid-feedback">valido!</div>
							</div>
							<div class="col-12 dropdown-divider"></div>

							<div class="col-12">
								<a href="Cambiar-Contraseña" class="link text-decoration-none" data-dismiss="modal" data-toggle="modal" data-target="#cambiarContrasena">Cambiar contraseña</a>
							</div>

							<div class="col-12 dropdown-divider"></div>
						</div>
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</form>
					<!-- End Profile -->
				</div>
				</div>
			</div>
			</div>


			<!-- Modal Cambiar Contraseña-->
			<div class="modal fade" id="cambiarContrasena" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog  modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          						<span aria-hidden="true">&times;</span>
        					</button>
						</div>
						<div class="modal-body">
							<!-- Form Profile -->
							<form class="needs-validation" id="form_cambContra" novalidate>
								<div class="form-row">

									<div class="col-12 d-flex align-items-center">
										<i class="fa fa-lock mr-1" aria-hidden="true"></i>
										<p class="text-muted">Contraseña actual</p>
									</div>
									<div class="col-12 input-group mb-3">
										<input type="password" class="form-control" id="cambio_pass_actual" placeholder="Contraseña actual" required minlength="6" maxlength="30">
										<div class="input-group-append">
											<button class="btn btn-light btn_eye" type="button" id="btn_ps_act" onclick="verpass(this.id,'cambio_pass_actual')"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
										</div>
									</div>

									<div class="col-12 d-flex align-items-center">
										<i class="fa fa-unlock-alt mr-1" aria-hidden="true"></i>
										<p class="text-muted">Contraseña nueva</p>
									</div>
									<div class="col-12 input-group mb-3">
										<input type="password" class="form-control" id="cambio_pass_nueva" placeholder="Contraseña nueva" required minlength="6" maxlength="30">
										<div class="input-group-append">
											<button class="btn btn-light btn_eye" type="button" id="btn_ps_nueva" onclick="verpass(this.id,'cambio_pass_nueva')"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
										</div>
									</div>

									<div class="col-12 d-flex align-items-center">
										<i class="fa fa-unlock-alt mr-1" aria-hidden="true"></i>
										<p class="text-muted">Repetir contraseña nueva</p>
									</div>
									<div class="col-12 input-group mb-3">
										<input type="password" class="form-control" id="cambio_pass_rep" placeholder="Repetir contraseña nueva" required minlength="6" maxlength="30">
										<div class="input-group-append">
											<button class="btn btn-light btn_eye" type="button" id="btn_ps_rep" onclick="verpass(this.id,'cambio_pass_rep')"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
										</div>
									</div>

									<div class="col-12 dropdown-divider"></div>
								</div>
								<button type="submit" class="btn btn-primary">Actualizar contraseña</button>
							</form>
							<!-- End Profile -->

						</div>
					</div>
				</div>
			</div>

		</div>
	</nav>
	<div class="profile-area py-5">
		<div class="container">
			<div class="row">

			<h1 class="login100-form-title">Empresas</h1>


				<?php echo $structura_empresas; ?>
				<!-- Modal -->
<div class="modal fade p-0" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalEditLabel">Modal title</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-6">
			
			</div>
		</div>
	</div>
</div>

<!-- Modal Compartir -->
<div class="modal fade" id="ModalCode" aria-hidden="true" aria-labelledby="ModalCodeLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalCodeLabel">Código</h5>
				<button type="button" class="btn-close" data-bs-target="#ModalEdit" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="needs-validation" id="formCompartir" novalidate>
					<div class="container pb-3">
						<div class="row">
							<div class="col d-flex justify-content-start align-items-center">
								Código:
								<div class="bg-light w-100"><p class="fw-bold text-center h5 m-0 lh-base" id="codelabel"> ...</p></div>
							</div>
						</div>
						<div class="row">
							<div class="input-group my-3">
								<input type="password" class="form-control" placeholder="Contraseña" name="contracom" aria-describedby="contracom" disabled autocomplete="off">
								<button class="btn btn-outline-secondary" type="button" id="contracom"><i class="fa fa-pencil" aria-hidden="true"></i></button>
							</div>
						</div>
						<div class="form-check form-switch d-flex">
							<input class="form-check-input" type="checkbox" id="switchCheckAccess">
							<label class="form-check-label" for="switchCheckAccess">Permitir Acceso</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



					  <script src="navbar.js"></script>
			</div>
		</div>
	</div>
<!--===============================================================================================-->
	<script src="../VENDOR/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../VENDOR/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../VENDOR/bootstrap/js/popper.min.js"></script>
	<script src="../VENDOR/bootstrap/js/bootstrap.min.js"></script>
	<script src="../VENDOR/bootstrap/v4/js/bootstrap.min.js"></script>
	<script src="../VENDOR/bootstrap/js/popper2.min.js"></script>
<!--===============================================================================================-->
	<script src="../VENDOR/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../VENDOR/daterangepicker/moment.min.js"></script>
	<script src="../VENDOR/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../VENDOR/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../SWEETALERT/dist/sweetalert2.all.min.js"></script>
<!--===============================================================================================-->
	<script src="../JS/main.js"></script>
<!--===============================================================================================-->
	<script src="../JS/empresas.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
	integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->
</body>
</html>
