<?php include("includes/includes.php");
include("common_files/sesion.php");
?>
<?php 
$tbl_main = "ds_tbl_producto";


//print_r($_POST);

// [id_marca] => 1 [id_producto] => 5 [id_talla] => 11 [id_color] => 73 ) 
// [] => 1 [] => 5 [] => 11 [] => 73 )
/**
$id_marca = $_POST["id_marca"];
$id_producto = $_POST["id_producto"];
$id_talla = $_POST["id_talla"];
$id_color = $_POST["id_color"];
*/
$id_marca = $_POST["id_marca"];

$id_genero = $_POST["id_genero"];

$id_producto = $_POST["id_producto"];
$id_talla = $_POST["id_talla"];
$id_color = $_POST["id_color"];

$id_almacen = $_POST["id_almacen"];
$id_tipo_producto = $_POST["id_tipo_producto"];
$id_categoria = $_POST["id_categoria"];

?>

<table class="table datatable-basic">
	<thead>
		<tr>
			<th>Producto</th>
			<th>Marca</th>
			
			<th>Hexadecimal</th>
			<th>Color</th>
			<th>Talla</th>
			<th>C&oacute;digo barras</th>
			
			<th>Precio MXN</th>
			<th>USD</th>
			<th>Inventario</th>
			<th>Agregar</th>
			
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
	
	<?php 
	$where_append = "";
	if($id_marca != "" || $id_genero != "" || $id_almacen != "" || $id_tipo_producto != "" || $id_categoria != "" || $id_talla != "" || $id_color != "" || $id_categoria != "" || $id_producto != ""){
	    
	    $where_append .= "where ";
	    if($id_marca != ""){
	        //$where_append .= "where ds_tbl_producto.Id_Marca = $id_marca";
	        $where_append .= "ds_tbl_producto.Id_Marca = $id_marca";
	    }
	    ///if($id_marca != "" && $id_genero != ""){
	    if($id_marca != "" && ($id_genero != "" || $id_almacen != "" || $id_tipo_producto != "" || $id_talla != "" || $id_color != "" || $id_categoria != "" || $id_producto != "")){
	        $where_append .= " and ";
	        
	    }
	    
	    if($id_genero != ""){
	        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
	        $where_append .= "ds_tbl_producto_detalle.Id_Genero = $id_genero";
	        
	    }
	    if($id_genero != "" && ($id_almacen != "" || $id_tipo_producto != "" || $id_talla != "" || $id_color != "" || $id_categoria != "" || $id_producto != "")){
	        $where_append .= " and ";
	        
	    }
	    
	    if($id_almacen != ""){
	        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
	        $where_append .= "ds_tbl_inventario_almacen.Id_Tipo_Almacen = $id_almacen";
	        
	    }
	    
	    if($id_almacen != "" && ($id_tipo_producto != "" || $id_talla != "" || $id_color != "" || $id_categoria != "" || $id_producto != "")){
	        $where_append .= " and ";
	        
	    }
	    
	    if($id_tipo_producto != ""){
	        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
	        $where_append .= "ds_tbl_producto.Id_Tipo_Producto = $id_tipo_producto";
	        
	    }
	    /*
	     if($id_tipo_producto != "" && $id_categoria != ""){
	     $where_append .= " and ";
	     
	     }
	     
	     if($id_categoria != ""){
	     //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
	     $where_append .= "ds_tbl_producto.Id_Tipo_Producto = $id_categoria";
	     
	     }
	     */
	    if($id_tipo_producto != "" && ($id_talla != "" || $id_color != "" || $id_categoria != "" || $id_producto != "")){
	        $where_append .= " and ";
	        
	    }
	    
	    if($id_categoria != ""){
	        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
	        $where_append .= "ds_tbl_producto.Id_Categoria_Producto = $id_categoria";
	        
	    }
	    
	    
	    
	    if($id_categoria != "" && ($id_talla != "" || $id_color != "" || $id_producto != "")){
	        $where_append .= " and ";
	    }
	    
	    
	    if($id_talla != ""){
	        //$where_append .= " and ds_tbl_producto_detalle.Id_Producto = $id_producto";
	        $where_append .= "ds_tbl_producto_detalle.Id_Talla = $id_talla";
	    }
	    
	    if($id_talla != ""  && ($id_color != "" || $id_producto != "")){
	        $where_append .= " and ";
	        
	    }
	    
	    if($id_color != ""){
	        $where_append .= "ds_tbl_producto_detalle.Id_Color = $id_color";
	        
	    }
	    
	    if($id_color != ""  && $id_producto != ""){
	        $where_append .= " and ";
	        
	    }
	    
	    
	    if($id_producto != ""){
	        //$where_append .= " and $tbl_main.Id_Producto = $id_producto";
	        //$where_append .= " and $tbl_main.Nombre = '{$id_producto}'";
	        //$where_append .= " and $tbl_main.Nombre like '%{$id_producto}%'";
	        $where_append .= "$tbl_main.Nombre like '{$id_producto}'";
	    }
	    
	    /*
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
	     }else{
	     
	     
	     
	     
	     }
	     */
	}else{
	    if($id_producto != ""){
	        //$where_append .= " and $tbl_main.Id_Producto = $id_producto";
	        //$where_append .= " and $tbl_main.Nombre = '{$id_producto}'";
	        //$where_append .= " and $tbl_main.Nombre like '%{$id_producto}%'";
	        $where_append .= "where $tbl_main.Nombre like '{$id_producto}'";
	    }
    }
	/** ORIGINAL WHERE
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
    }else{
        
    }
    */
    
    
    
    
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto = $id_producto order by $tbl_main.Descripcion asc";
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen, ds_cat_categoria_producto.Descripcion as categoria, ds_tbl_costo_compra_producto.Dolar as dolar_costo, ds_tbl_precio_venta_producto.Dolar as dolar_precio from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
    
    $qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, ds_tbl_producto.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen, ds_cat_categoria_producto.Descripcion as categoria, ds_tbl_costo_compra_producto.Dolar as dolar_costo, ds_tbl_precio_venta_producto.Dolar as dolar_precio from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen left join ds_cat_categoria_producto on ds_cat_categoria_producto.Id_Categoria_Producto = ds_tbl_producto.Id_Categoria_Producto $where_append group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    //echo $qry_resultados;
		
		
		$resultados = $obj->get_results($qry_resultados);
	
		//print_r($resultados);
	//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
	
	//$resultados = $obj->get_results($qry_resultados);
	
	
	?>
	<tr>
		<td><?php echo $qry_resultados; ?></td>
	</tr>
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
			
		<tr id="element<?php echo $id_resultado; ?>">
			<td><?php echo $nombre; ?></td>
			<td><?php echo $resultado->marca; ?></td>
			<td><?php echo $resultado->Codigo_Hexadecimal; ?></td>
			<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div></td>
			<td><?php echo $resultado->talla; ?></td>
			<td><?php echo $resultado->Codigo_Barras; ?></td>
			<td><?php echo $resultado->Costo_Venta; ?></td>
			
			<td><?php echo $resultado->Dolar; ?></td>
			<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
			<td><a onclick="agregar_producto('<?php echo $id_resultado; ?>')"><i class="icon-checkmark2"></i></a></td>

			<?php /**
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
							<?php /**
							<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
							*/ ?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php //endfor; ?>
		<?php endforeach; ?>

	</tbody>
</table>