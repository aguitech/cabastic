<?php include("includes/includes.php");
include("common_files/sesion.php");
?>
<?php 
$id_rol = $_SESSION["rol"];
$tbl_main = "ds_tbl_producto";

//print_r($_POST);

// [id_marca] => 1 [id_producto] => 5 [id_talla] => 11 [id_color] => 73 ) 
// [] => 1 [] => 5 [] => 11 [] => 73 )
$id_marca = $_POST["id_marca"];

$id_genero = $_POST["id_genero"];

$id_producto = $_POST["id_producto"];
$id_talla = $_POST["id_talla"];
$id_color = $_POST["id_color"];

$id_almacen = $_POST["id_almacen"];
$id_tipo_producto = $_POST["id_tipo_producto"];
$id_categoria = $_POST["id_categoria"];


/**
 * id_marca=&id_talla=&id_color=&id_genero=&id_almacen=&id_tipo_producto=3&=
 * =&=&=&=&=&=3&id_categoria=
*/

$divisas = $obj->get_results("select * from ds_cat_tipo_cambio");

?>
<table class="table datatable-basic">
	<thead>
		<tr>
			<th>C&oacute;digo de Barras</th>
			<th>Imagen</th>
			<th>Nombre</th>
			<th>Tipo de producto</th>
			<th>Marca</th>
			<th>Color</th>
			<th>Talla</th>
			<th>Cantidad M&iacute;nima</th>
			<th>Cantidad M&aacute;xima</th>
			<th>Existencias</th>
			<th>Almac&eacute;n</th>
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6): ?>
			<th>Costo</th>
			<?php endif; ?>
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6): ?>
			<th>Precio</th>
			<?php endif; ?>
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$where_append = "";
		if($id_marca != "" || $id_genero != "" || $id_almacen != "" || $id_tipo_producto != "" || $id_categoria != ""){
		    
		    $where_append .= "where ";
		    if($id_marca != ""){
		        //$where_append .= "where ds_tbl_producto.Id_Marca = $id_marca";
		        $where_append .= "ds_tbl_producto.Id_Marca = $id_marca";
		    }
		    if($id_marca != "" && $id_genero != ""){
		        $where_append .= " and ";
		        
		    }
		    
		    if($id_genero != ""){
		        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
		        $where_append .= "ds_tbl_producto_detalle.Id_Genero = $id_genero";
		        
		    }
		    if($id_genero != "" && $id_almacen != ""){
		        $where_append .= " and ";
		        
		    }
		    
		    if($id_almacen != ""){
		        //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
		        $where_append .= "ds_tbl_inventario_almacen.Id_Tipo_Almacen = $id_almacen";
		        
		    }
		    
		    if($id_almacen != "" && $id_tipo_producto != ""){
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
		/**
        ORIGINAL WHERE
        
        $where_append = "";
        if($id_marca != "" || $id_genero != ""){
            
            $where_append .= "where ";
            if($id_marca != ""){
                //$where_append .= "where ds_tbl_producto.Id_Marca = $id_marca";
                $where_append .= "ds_tbl_producto.Id_Marca = $id_marca";
            }
            if($id_marca != "" && $id_genero != ""){
                $where_append .= " and ";
                
            }
            
            if($id_genero != ""){
                //$where_append .= " and ds_tbl_producto_detalle.Id_Genero = $id_genero";
                $where_append .= "ds_tbl_producto_detalle.Id_Genero = $id_genero";
                
            }
            
            
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
        ?>
		<?php
		//left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
		//$qry_resultados = "select *, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto order by $tbl_main.Descripcion asc";
		//left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
		//left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
		//left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle $where_append order by $tbl_main.Descripcion asc";
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
		//$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle $where_append group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
		//left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen
		$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color, $tbl_main.Descripcion as descripcion_producto, ds_cat_tipo_producto.Descripcion as tipo_producto, ds_cat_tipo_almacen.Descripcion as almacen from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = $tbl_main.Id_Producto left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_cat_talla on ds_cat_talla.Id_Talla = ds_tbl_producto_detalle.Id_Talla left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_cat_tipo_producto on ds_cat_tipo_producto.Id_Tipo_Producto = ds_tbl_producto.Id_Tipo_Producto left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_tipo_almacen on ds_cat_tipo_almacen.Id_Tipo_Almacen = ds_tbl_inventario_almacen.Id_Tipo_Almacen $where_append group by ds_tbl_producto_detalle.Id_Producto_Detalle order by $tbl_main.Descripcion asc";
		//echo $qry_resultados;
		$resultados = $obj->get_results($qry_resultados);
	
		//echo $qry_resultados;
		//exit();
	?>
	<?php foreach($resultados as $resultado): ?>
		<?php 
		$id_resultado=$resultado->Id_Producto;
		$nombre=$resultado->Nombre;
		?>
		<tr id="element<?php echo $id_resultado; ?>">
			<td><?php echo $resultado->Codigo_Barras; ?></td>
			
			<?php 
            $qry_producto_imagen = "select * from ds_tbl_producto_imagen where Id_Producto = $id_resultado order by Id_Producto_Imagen desc limit 1";
            $resultado_imagen_val = $obj->get_row($qry_producto_imagen);
            ?>
			<?php /**
			<td><?php if($resultado->Imagen_Producto != ""): ?><img src="images/productos/<?php echo $resultado->Imagen_Producto; ?>" style="max-height:50px; max-width:100px;" /><?php endif; ?></td>
			*/ ?>
			<td><?php if($resultado_imagen_val->Url_Imagen != ""): ?><img src="images/productos/<?php echo $resultado_imagen_val->Url_Imagen; ?>" style="max-height:50px; max-width:100px;" /><?php endif; ?></td>
			<td><?php echo $nombre; ?></td>
			<td><?php echo $resultado->tipo_producto; ?></td>
			<td><?php echo $resultado->marca; ?></td>
			<?php /**
			<td><?php echo $resultado->color; ?> <?php echo $resultado->Codigo_Hexadecimal; ?><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $resultado->Codigo_Hexadecimal; ?>"></div></td>
			*/ ?>
			<td><?php echo $resultado->color; ?></td>
			<td><?php echo $resultado->talla; ?></td>
			
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 4 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
			<td style="text-align:center;" id="contenedor_resultado_input_cantidad_minima<?php echo $id_resultado; ?>"><div id="resultado_input_cantidad_minima<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_cantidad_minima<?php echo $id_resultado; ?>').show(); $('#input_cantidad_minima<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Minima != ""){ $res_pintar = $resultado->Cantidad_Minima; }else{ $res_pintar = "Introduce su cantidad m&iacute;nima"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_cantidad_minima<?php echo $id_resultado; ?>" ><input type="text" id="input_cantidad_minima<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Minima; ?>" onblur="actualizar_cantidad_minima(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			<?php /**
			<td><div id="resultado_input_existencia<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_existencia<?php echo $id_resultado; ?>').show(); $('#input_existencia<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Inventario != ""){ $res_pintar = $resultado->Cantidad_Inventario; }else{ $res_pintar = "Introduce su existencia"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_existencia<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Inventario; ?>" onblur="actualizar_existencia(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			<td><?php echo $resultado->Cantidad_Minima; ?></td>
			*/ ?>
			<?php endif; ?>
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 3  || $id_rol == 4 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7  || $id_rol == 8): ?>
			<td style="text-align:center;" id="contenedor_resultado_input_cantidad_maxima<?php echo $id_resultado; ?>"><div id="resultado_input_cantidad_maxima<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_cantidad_maxima<?php echo $id_resultado; ?>').show(); $('#input_cantidad_maxima<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Cantidad_Maxima != ""){ $res_pintar = $resultado->Cantidad_Maxima; }else{ $res_pintar = "Introduce su cantidad m&aacute;xima"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo_cantidad_maxima<?php echo $id_resultado; ?>" ><input type="text" id="input_cantidad_maxima<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Cantidad_Maxima; ?>" onblur="actualizar_cantidad_maxima(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			<?php /**
			<td><?php echo $resultado->Cantidad_Maxima; ?></td>
			*/ ?>
			<?php endif; ?>
			<?php /**
			<td><?php echo $resultado->Cantidad_Minima; ?></td>
			<td><?php echo $resultado->Cantidad_Maxima; ?></td>
			*/ ?>
			
			<td style="text-align:center;" id="contenedor_resultado_input_existencia<?php echo $id_resultado; ?>"><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
			<td><?php echo $resultado->almacen; ?></td>
			<?php /**
			<td><?php echo $resultado->Costo_Compra; ?></td>
			<td style="text-align:right;"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = $resultado->Costo_Compra; }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" /></div></td>
			<td style="text-align:right;"><?php echo $resultado->Costo_Venta; ?></td>
			
			*/?>
			
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6): ?>
			<td style="text-align:right;" id="contenedor_resultado_input<?php echo $id_resultado; ?>"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = "$" . number_format($resultado->Costo_Compra, 2); }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none; width:170px;" id="input_alternativo<?php echo $id_resultado; ?>" ><select name="select_divisa_costo<?php echo $id_resultado; ?>" id="select_divisa_costo<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" style=" width:55px; border:none; margin:0 5px;" /><span><i class="icon-checkmark4 mr-3 icon-1x" onclick="actualizar_costo($('#input<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);"></i></span></div></td>
			
			<?php /**
			<td style="text-align:right;" id="contenedor_resultado_input<?php echo $id_resultado; ?>"><div id="resultado_input<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo<?php echo $id_resultado; ?>').show(); $('#input<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Compra != ""){ $res_pintar = "$" . number_format($resultado->Costo_Compra, 2); }else{ $res_pintar = "Introduce su costo"; } echo $res_pintar; ?></div><div style="display:none;" id="input_alternativo<?php echo $id_resultado; ?>" ><select name="select_divisa_costo<?php echo $id_resultado; ?>" id="select_divisa_costo<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Compra; ?>" onblur="actualizar_costo(this.value, <?php echo $id_resultado; ?>);" style=" width:55px;" /></div></td>
			*/ ?>
			<?php endif; ?>
			<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 4 || $id_rol == 5 || $id_rol == 6): ?>

			<td style="text-align:right;" id="contenedor_resultado_input_precio<?php echo $id_resultado; ?>"><div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($resultado->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none; width:170px;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Venta; ?>" style=" width:55px; border:none; margin:0 5px;" /><input type="button" onclick="actualizar_precio($('#input_precio<?php echo $id_resultado; ?>').val(), <?php echo $id_resultado; ?>);" value="Guardar" /></div></td>
			
			
			<?php /**
			<td style="text-align:right;" id="contenedor_resultado_input_precio<?php echo $id_resultado; ?>"><div id="resultado_input_precio<?php echo $id_resultado; ?>" onclick="$(this).hide(); $('#input_alternativo_precio<?php echo $id_resultado; ?>').show(); $('#input_precio<?php echo $id_resultado; ?>').focus();"><?php if($resultado->Costo_Venta != ""){ $res_pintar_precio = "$" . number_format($resultado->Costo_Venta, 2); }else{ $res_pintar_precio = "Introduce su precio"; } echo $res_pintar_precio; ?></div><div style="display:none;" id="input_alternativo_precio<?php echo $id_resultado; ?>" ><select name="select_divisa_precio<?php echo $id_resultado; ?>" id="select_divisa_precio<?php echo $id_resultado; ?>"><?php foreach($divisas as $divisa): ?><option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option><?php endforeach; ?></select><input type="text" id="input_precio<?php echo $id_resultado; ?>" placeholder="" value="<?php echo $resultado->Costo_Venta; ?>" onblur="actualizar_precio(this.value, <?php echo $id_resultado; ?>);" style=" width:55px;" /></div></td>
			<td><?php echo $resultado->Costo_Venta; ?></td>
			*/ ?>
			<?php endif; ?>

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
		<?php endforeach; ?>

	</tbody>
</table>
<?php /**
<table class="table datatable-basic">
	<thead>
		<tr>
			<th>Producto</th>
			<th>Marca</th>
			
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
    
    
    
    
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $tbl_main.Id_Producto = $id_producto order by $tbl_main.Descripcion asc";
    //$qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    $qry_resultados = "select *, ds_cat_marca.Descripcion as marca, ds_cat_talla.Descripcion as talla, ds_cat_color.Descripcion as color from $tbl_main left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.id_Producto left join ds_cat_marca on ds_cat_marca.id_marca = ds_tbl_producto.Id_Marca left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_cat_talla on ds_tbl_producto_detalle.Id_Talla = ds_cat_talla.Id_Talla left join ds_cat_color on ds_cat_color.Id_Color = ds_tbl_producto_detalle.Id_Color left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where $where_append order by $tbl_main.Descripcion asc";
    
    //echo $qry_resultados;
		
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
			<td><?php echo $nombre; ?></td>
			<td><?php echo $resultado->marca; ?></td>
			
			<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div><br /><?php echo $resultado->color; ?><br /><?php echo $resultado->Codigo_Hexadecimal; ?></td>
			<td><?php echo $resultado->talla; ?></td>
			<td><?php echo $resultado->Codigo_Barras; ?></td>
			<td><?php echo $resultado->Costo_Venta; ?></td>
			
			<td><?php echo $resultado->Dolar; ?></td>
			<td><?php echo $resultado->Cantidad_Inventario; ?><?php //print_r($resultado); ?></td>
			<td><a onclick="agregar_producto('<?php echo $id_resultado; ?>')">Agregar</a></td>

			
			<td class="text-center">
				<div class="list-icons">
					<div class="dropdown">
						<a href="#" class="list-icons-item" data-toggle="dropdown">
							<i class="icon-menu9"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Eliminar</a>
							<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<?php //endfor; ?>
		<?php endforeach; ?>

	</tbody>
</table>

*/ ?>