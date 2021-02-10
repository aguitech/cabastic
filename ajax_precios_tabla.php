<?php include("includes/includes.php");
include_once("login.php");
include("common_files/sesion.php");
?>
<?php
include_once("db.php");
?>
<?php 
$tbl_main = "ds_tbl_producto";


print_r($_POST);

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
			<th>ID</th>
			<th>Producto</th>
			<th>Marca</th>
			
			<th>Color</th>
			<th>Talla</th>
			<th>C&oacute;digo barras</th>
			
			<th>Precio MXN</th>
			<th>USD</th>
			<th>Inventario</th>
			<th>Agregar</th>
			
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
	
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
    }else{
        
    }
    
    
    
    ?>
	<?php 
    	//$qry_resultados = "select * from $tbl_main order by Descripcion asc";
    	//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca order by $tbl_main.Descripcion asc";
    	//left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.Id_Marca = ds_tbl_producto_detalle.Id_Marca order by $tbl_main.Descripcion asc";
    	//$qry_resultados = "select * from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto order by $tbl_main.Descripcion asc";
    	/**
    	select *, ds_cat_marca.Descripcion as marca from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca order by ds_tbl_producto.Descripcion ascArray ( [0] => stdClass Object ( [Id_Producto] => 256 [Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 79 [Id_Producto_Detalle] => 256 [Codigo_Barras] => 8001500280093 [Id_Talla] => 7 [Id_Color] => 39 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [1] => stdClass Object ( [Id_Producto] => 512 [Nombre] => AA LADIES MOTION LITE JACKET [Descripcion] => HORSE WARE [Imagen_Producto] => [Id_Marca] => 11 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:13:11 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 512 [Codigo_Barras] => 0 [Id_Talla] => 6 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:13:11 [marca] => HORSE WARE ) [2] => stdClass Object ( [Id_Producto] => 257 [Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 79 [Id_Producto_Detalle] => 257 [Codigo_Barras] => 0 [Id_Talla] => 9 [Id_Color] => 60 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [3] => stdClass Object ( [Id_Producto] => 513 [Nombre] => AA LADIES MOTION LITE JACKET [Descripcion] => HORSE WARE [Imagen_Producto] => [Id_Marca] => 11 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:13:11 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 513 [Codigo_Barras] => 0 [Id_Talla] => 34 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:13:11 [marca] => HORSE WARE ) [4] => stdClass Object ( [Id_Producto] => 769 [Nombre] => A.M.P. JACKET [Descripcion] => HORSE PILOT [Imagen_Producto] => [Id_Marca] => 14 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:14:10 [Id_Categoria_Producto] => 77 [Id_Producto_Detalle] => 769 [Codigo_Barras] => 3701101209183 [Id_Talla] => 15 [Id_Color] => 12 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:14:10 [marca] => HORSE PILOT ) [5] => stdClass Object ( [Id_Producto] => 2 [Nombre] => 91V W191 GRENOBLE GRIP [Descripcion] => VESTRUM [Imagen_Producto] => [Id_Marca] => 1 [Id_Tipo_Producto] => 14 [Id_Tipo_Sustancia] => 1 [Activo] => 1 [Fecha_Alta] => 2020-07-21 22:07:02 [Id_Categoria_Producto] => 81 [Id_Producto_Detalle] => 2 [Codigo_Barras] => 8001500018603 [Id_Talla] => 27 [Id_Color] => 32 [Id_Tipo_Mercado] => 2 [Id_Genero] => 2 [Logo] => [Fecha_Actualiza] => 2020-07-21 22:07:02 [marca] => VESTRUM ) [6] => stdClass Object ( [Id_Producto] => 258 [Nombre] => 01 VW3024 M
    	ds_tbl_precio_venta_producto
    	*/
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca order by $tbl_main.Descripcion asc";
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    	//Id_Color
    	//left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color 
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla order by $tbl_main.Descripcion asc";
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color order by $tbl_main.Descripcion asc";
    	//ds_cat_color
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color order by $tbl_main.Descripcion asc";
    	//left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle 
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
    	//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != 0 order by $tbl_main.Descripcion asc";
    	$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto != '0' or  $tbl_main.Id_Producto != '' order by $tbl_main.Descripcion asc";
    	
    	
    	
    	//echo $qry_resultados;
    
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
    		
    	<tr id="element<?php echo $id_resultado; ?>">
    		<td><?php echo $id_resultado; ?></td>
    		<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $nombre; ?></td>
    		<td><?php echo $resultado->marca; ?></td>
    		
    		<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
    		<td><?php echo $resultado->talla; ?></td>
    		<td><?php echo $resultado->Codigo_Barras; ?></td>
    		<td><?php echo $resultado->Costo_Venta; ?></td>
    		
    		<td><?php echo $resultado->Dolar; ?></td>
    		<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
    		<td><a onclick="detalle_precio('<?php echo $id_resultado; ?>')">Detalle Precio</a></td>
    
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
    						<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
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