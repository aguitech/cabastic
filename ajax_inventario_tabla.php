<?php include("includes/includes.php");
include_once("login.php");
include("common_files/sesion.php");
?>
<?php
include_once("db.php");
?>
<?php 
$tbl_main = "ds_tbl_producto";


//print_r($_POST);

// [id_marca] => 1 [id_producto] => 5 [id_talla] => 11 [id_color] => 73 ) 
// [] => 1 [] => 5 [] => 11 [] => 73 )
$id_marca = $_POST["id_marca"];
$id_producto = $_POST["id_producto"];
$id_talla = $_POST["id_talla"];
$id_color = $_POST["id_color"];

?>

<table class="table datatable-basic">
	<thead>
		<tr>
			<th>C&oacute;digo barras</th>
			
			<th>Producto</th>
			<?php /**
			<th>Descripci&oacute;n</th>
			*/ ?>
			<th>Marca</th>
			
			<th>Color</th>
			<th>Talla</th>
			<th>Existencias</th>
			
			<th>Tipo Almac&eacute;n</th>
			<th>Cantidad</th>
			
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		

    <?php 
    /**
     
        */

    ?>  
    
    
    	<?php /**?>
		
		*/ ?>

		<?php
		//}
		?>

		<?php 
		$where_append = "";
		if($id_marca != ""){
		    $where_append .= "ds_tbl_producto.Id_Marca = $id_marca";
		    
		    
		    //$tbl_main.Id_Producto = $id_producto
		    if($id_producto != ""){
		        //$where_append .= " and $tbl_main.Id_Producto = $id_producto";
		        //$where_append .= " and $tbl_main.Nombre = '{$id_producto}'";
		        //$where_append .= " and $tbl_main.Nombre like '%{$id_producto}%'";
		        $where_append .= " and $tbl_main.Nombre like '{$id_producto}'";
		        
		        if($id_talla != ""){
		            //$where_append .= " and ds_tbl_producto_detalle.Id_Producto = $id_producto";
		            $where_append .= " and ds_tbl_producto_detalle.Id_Talla = $id_talla";
		            
		            if($id_color != ""){
		                $where_append .= " and ds_tbl_producto_detalle.Id_Color = $id_color";
		                
		            }
		        }
		    }
		    $where_append .= " and";
		    
		}else{
		    
		}
		
		//$qry_resultados = "select * from $tbl_main order by Descripcion asc";
		//ds_tbl_producto.Id_Producto_Detalle != ''
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";
		//ds_tbl_inventario_almacen.Id_Tipo_Almacen = //
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_cat_tipo_almacen.Descripcion as tipo_almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_tbl_inventario_almacen.Id_Tipo_Almacen = ds_cat_tipo_almacen.Id_Tipo_Almacen where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";

		//$where_append
		//echo $qry_resultados;
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_cat_tipo_almacen.Descripcion as tipo_almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_tbl_inventario_almacen.Id_Tipo_Almacen = ds_cat_tipo_almacen.Id_Tipo_Almacen where $where_append $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '' order by $tbl_main.Descripcion asc";
		$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_cat_tipo_almacen.Descripcion as tipo_almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_tbl_inventario_almacen.Id_Tipo_Almacen = ds_cat_tipo_almacen.Id_Tipo_Almacen where $where_append ($tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' or ds_tbl_producto_detalle.Id_Producto_Detalle != 0 or ds_tbl_producto_detalle.Id_Producto_Detalle != '') order by $tbl_main.Descripcion asc";
		
		//echo $qry_resultados . "<br />";
		
		$resultados = $obj->get_results($qry_resultados);
	
		//print_r($resultados);
	//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
	
	//$resultados = $obj->get_results($qry_resultados);
	
	
	?>
	<?php foreach($resultados as $resultado): ?>
	
	
	
		<?php //for($i=0; $i<=10; $i++): ?>
		
		<?php 
		//[0] => stdClass Object ( [Id_Producto] => 256 
		//[Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] 
		//=> [Id_Marca] => 1 [Id_Tipo_Producto] => 14
		//[Id_Tipo_Sustancia] => 1 [Activo] => 1 
		//[Fecha_Alta] => 2020-07-21 22:10:43 
		//[Id_Categoria_Producto] => 79 
		
		$id_resultado=$resultado->Id_Producto;
		$nombre=$resultado->Nombre;
		$hexadecimal=$resultado->Descripcion;
		$id_nivel="Hola";
		$extension="Hola";
		$area="Hola";
		$completo="Hola";
		$niveles="Hola";
		?>
		
		<?php //if($resultado->Id_Producto_Detalle != ""){ ?>
		<tr id="element<?php echo $id_resultado; ?>">
			<td><?php echo $resultado->Codigo_Barras; //print_r($resultado); ?></td>
			<td><?php echo $nombre; ?></td>
			<?php /**
			<td><?php echo $resultado->Descripcion; ?></td>
			*/ ?>
			<td><?php echo $resultado->marca; ?></td>
			
			<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
			<td><?php echo $resultado->talla; ?> <?php //print_r($resultado); ?></td>
			<?php /**
			<td><?php echo $resultado->Costo_Venta; ?></td>
			<td><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = $resultado->Costo_Compra; }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			
			<td><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = $resultado->Costo_Compra; }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			
			*/ ?>
			<td><div id="contenedor_cantidad_inventario<?php echo $id_resultado; ?>"><?php echo $resultado->Cantidad_Inventario; ?><?php //echo $qry_resultados; //print_r($resultado); ?></div></td>
			<td><?php echo $resultado->tipo_almacen; ?><?php //echo $qry_resultados; //print_r($resultado); ?></td>
			
			<td><input type="text" name="" id="" onchange="actualizar_inventario_evento(<?php echo $resultado->Id_Producto_Detalle; ?>, this.value);" /></td>
			
			
			<?php /**
			<td><div id="contenedor_dolar<?php echo $id_resultado; ?>"><?php echo $resultado->Dolar; ?></div></td>
			<td><a onclick="detalle_costo('<?php echo $id_resultado; ?>')">Detalle Precio</a></td>
			<td><?php echo $hexadecimal; ?></td>
			<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $color->Codigo_Hexadecimal; ?>"></div> <?php echo $color->Codigo_Hexadecimal; ?></td>
			*/ ?>
			
			<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Eliminar</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
							
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Empleado</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Asignar Inventario</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Iniciar Venta</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Cierre de evento</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Ver evento</a>
														
							
							<?php /**
							<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
							*/ ?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php //} ?>
		<?php //endfor; ?>
		<?php endforeach; ?>

	</tbody>
</table>