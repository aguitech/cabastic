<?php include("includes/includes.php"); ?>
<?php 
$id_evento = $_POST["id"];
$empleados = $obj->get_results("select * from ds_tbl_empleado where Id_Empleado_Rol = 2");

/*
$qry_evento_detalle = "select * from ds_tbl_evento where Id_Evento = {$id_evento}";
$evento_detalle = $obj->row($qry_evento_detalle);
*/
$qry_evento_detalle = "select * from ds_tbl_evento where Id_Evento = {$id_evento}";
//echo $qry_evento_detalle;
$evento_detalle = $obj->get_row($qry_evento_detalle);
?>
<div style="width:100%; padding:0 10%;" class="content_form_crear">
	<form id="" method="post" action="?">
		<div class="card-header header-elements-inline">
        	<h5 class="card-title">&nbsp;</h5>
        	<div class="header-elements">
        		<div class="list-icons">
            		<!-- 
            		<a class="list-icons-item" data-action="collapse"></a>
            		<a class="list-icons-item" data-action="reload"></a>
            		-->
            		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
            	</div>
        	</div>
        </div>
		<h1>Asignar empleado a Evento "<?php echo $evento_detalle->Descripcion; ?>"</h1>
		<?php foreach($empleados as $empleado): ?>
		
		<?php 
		$id_empleado = $empleado->Id_Empleado;
		$qry_empleado = "select * from ds_tbl_evento_empleado where Id_Envento = $id_evento and Id_Empleado = $id_empleado";
		$empleado_actual = $obj->get_row($qry_empleado);
		?>
		<div>
			<span>
				<input type="checkbox" name="" value="<?php echo $id_empleado; ?>" <?php if($empleado_actual->Id_Empleado == $empleado->Id_Empleado){ ?>checked="checked"<?php } ?> onclick="asignar_empleado_evento(this.value, <?php echo $id_evento; ?>)" />
			</span>
			<?php echo $empleado->Apellido_Paterno . " " . $empleado->Apellido_Materno . " " . $empleado->Nombre; ?>
		</div>
		<?php endforeach; ?>
	</form>
</div>

