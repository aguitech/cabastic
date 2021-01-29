<?php include("includes/includes.php"); ?>
<?php print_r($_POST); ?>
<?php 
$id_cliente = $_POST["cliente"];

$qry_result = "select * from ds_tbl_venta where Id_Cliente = $id_cliente";
$resultados = $obj->get_results($qry_result);

print_r($resultados);
?>
asdfghbjhbhjbhjbhb
<table class="table datatable-basic">
	<thead>
		<tr>
			<th>ID</th>
			<th>Color</th>
			<th>Hexadecimal</th>
			
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			
			
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_usuario; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
							<a onclick="cargar_editar('<?php echo $id_usuario; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
							<?php /**
							<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
							*/ ?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php //endfor; ?>

	</tbody>
</table>
