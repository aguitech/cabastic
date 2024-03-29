<?php
//session_start();
 include_once("login.php");
 ?>
 <?php
 include_once("db.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php

	include "core_title.php";

	 ?>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="global_assets/js/main/jquery.min.js"></script>
	<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="full/assets/js/app.js"></script>
	<script src="global_assets/js/demo_pages/form_inputs.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<?php include "core_mainnav.php"; ?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<?php include "core_sidebar-mobile-toggler.php"; ?>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<?php include "core_user-menu.php"; ?>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<?php
						include_once("menu.php");
						 ?>


					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">








			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Usuarios</span> - Agregar</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center" style="display: none;">
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
						</div>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="usuarios.php" class="breadcrumb-item">Usuarios</a>
							<span class="breadcrumb-item active">Agregar</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none" style="display: none;">
						<div class="breadcrumb justify-content-center">
							<a href="#" class="breadcrumb-elements-item" style="display: none;">
								<i class="icon-comment-discussion mr-2"></i>
								Support
							</a>

							<div class="breadcrumb-elements-item dropdown p-0" style="display: none;">
								<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear mr-2"></i>
									Settings
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
									<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
									<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->


					<?php 
					$sq = "SELECT * FROM `intranet_usuario` WHERE id_usuario = '$id' ";
					$resultt = $mysqli->query($sq);
                          while ($rowt = $resultt->fetch_row()){

                            $id_usuario=$rowt[0];
                            $nombre=$rowt[1];
                            $pass=$rowt[2];
                            $id_nivel=$rowt[3];
                            $extension=$rowt[4];
                            $area=$rowt[5];
                            $completo=$rowt[6];
                        }
					?>



			<!-- Content area -->
			<div class="content">

				<!-- Form inputs -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Editar Usuario (<?php echo $completo; ?>)</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					

					<div class="card-body">
						<p class="mb-4">
							
							En esta interface puedes editar al usuario <code><?php echo $nombre; ?></code> con acceso a la <code>Intranet</code>

						</p>

						<form action="usuarios_editar_form.php">
							<input type="hidden" name="id" value="<?php echo $id_usuario; ?>">

							<fieldset class="mb-3">
								<legend class="text-uppercase font-size-sm font-weight-bold">Rellena los campos</legend>

								<div class="form-group row">
									<label class="col-form-label col-lg-2">Email</label>
									<div class="col-lg-10">
										<input  type="text" class="form-control"  autocomplete="off" value="<?php echo $nombre; ?>" name="email">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-2">Password</label>
									<div class="col-lg-10">
										<input  type="text" class="form-control"  autocomplete="off" value="<?php echo $pass; ?>" name="password">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-2">Extensión</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" placeholder="###" name="extension" value="<?php echo $extension; ?>">
									</div>
								</div>



								<div class="form-group row">
									<label class="col-form-label col-lg-2">Área</label>
									<div class="col-lg-10">
										<input type="text" class="form-control"  name="area" value="<?php echo $area; ?>">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-2">Nombre Completo</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="completo" value="<?php echo $completo; ?>" >
									</div>
								</div>




							</fieldset>

							<fieldset class="mb-3">
								<legend class="text-uppercase font-size-sm font-weight-bold">Elige el área</legend>

		                        <div class="form-group row">
		                        	<label class="col-form-label col-lg-2">Área</label>
		                        	<div class="col-lg-10">
			                            <select class="form-control" name="id_nivel">
			                            	 <option value="0">Elige uno</option>

			                            	 <?php 
					                         $qt = "SELECT * FROM intranet_nivel ORDER BY id_nivel DESC LIMIT 30";
					                         

					                          $resultt = $mysqli->query($qt);
					                          while ($rowt = $resultt->fetch_row()){

					                          	$sel="";

					                            $nivel_id_nivel=$rowt[0];
					                            $nivel_nombre_nivel=$rowt[1];
					                           
					                           	if($id_nivel==$nivel_id_nivel){
					                           		$sel = ' selected="selected" ';
					                           	}




					                            

					                        ?> 

			                                <option value="<?php echo $nivel_id_nivel; ?>" <?php echo $sel; ?> ><?php echo $nivel_nombre_nivel; ?></option>
			                               

			                                <?php 
			                            	}
			                            	?>

			                            </select>
		                            </div>
		                        </div>


							</fieldset>



							<div class="text-right">
								<button type="submit" class="btn btn-primary">Guardar <i class="icon-paperplane ml-2"></i></button>
							</div>


						</form>
					</div>
				</div>
				<!-- /form inputs -->

			</div>
			<!-- /content area -->







			<!-- Footer -->
			<?php include "core_footer.php"; ?>
			<!-- /footer -->




		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
