<?php include("includes/includes.php");?>
<?php include("common_files/sesion.php"); ?>
<?php 
print_r($_POST);
$val_sku = $_POST["sku"];
$id_evento = $_POST["id_evento"];
//$qry_select = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto";
$qry_select = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto_detalle.Codigo_Barras = '{$val_sku}'";

$resultados = $obj->get_results($qry_select);
print_r($resultados);

print_r("conteo");
print_r(count($resultados));

$conteo = count($resultados);

if($conteo == 0){
    echo "Sin resultados";
}else if($conteo == 1){
    
    foreach($resultados as $result):
        if($id_evento != ""){
            if($id_evento == 1){
                $qry_select_product = "select * from ds_tbl_inventario_almacen left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_inventario_almacen.Id_Producto_Detalle";
                $producto_val = $obj->get_row($qry_select_product);
                
                print_r($producto_val);
                $id_producto_detalle_val = $result->Id_Producto_Detalle;
                $fecha_actualizacion_val = date("Y-m-d H:i:s");
                
                
                if($producto_val == Array()){
                    
                    
                    $cantidad_inventario_val = 1;
                    
                    $qry_id_inventario = "select * from ds_tbl_inventario_almacen order by Id_Inventario desc";
                    $inventario_id_obj = $obj->get_row($qry_id_inventario);
                    
                    $id_inventario = $inventario_id_obj->Id_Inventario;
                    
                    $qry_insert_product = "insert into ds_tbl_inventario_almacen (Id_Inventario, Id_Producto_Detalle, Cantidad_Inventario, Fecha_Actualizacion) values ($id_inventario, $id_producto_detalle_val, $cantidad_inventario_val, '{$fecha_actualizacion_val}')";
                    $obj->query($qry_insert_product);
                    
                    //
                    //Textos completos	Id_Inventario		Cantidad_Inventario	Fecha_Actualizacion	Comentario	Id_Cantidad_Producto	Id_Tipo_Almacen 	
                }else{
                    $cantidad_inventario_val = $producto_val->Cantidad_Inventario + 1;
                    $id_inventario_almacen = $producto_val->Id_Inventario;
                    $qry_update_product = "update ds_tbl_inventario_almacen set Cantidad_Inventario = $cantidad_inventario_val, Fecha_Actualizacion = '{$fecha_actualizacion_val}' where Id_Inventario = $id_inventario_almacen";
                    $obj->query($qry_update_product);
                }
                
                
                
            }else{
                    
            }
            
            
            $qry_insert = "insert into XXXXX set";
            
            
        }
        
        /**
    	<tr>
    		<td><?php echo $result->Nombre; ?></td>
    		<td><?php echo $result->Descripcion; ?></td>
    		<td><?php echo $result->Codigo_Barras; ?></td>
    		<td><?php echo $result->Id_Genero; ?></td>
    		<td><?php echo $result->Id_Color; ?></td>
    		<td><?php echo $result->Id_Categoria_Producto; ?></td>
    		<td><?php echo $result->Activo; ?></td>
    		<td><?php echo $result->Id_Tipo_Sustancia; ?></td>
    		<td><?php echo $result->Id_Marca; ?></td>
    	</tr>	
    	*/
	endforeach;
    
}else{
?>    
    <table>
    	<tr>
    		<th>Producto</th>
    		<th>Descripcion</th>
    		<th>Codigo de Barras</th>
    		<th></th>
    		<th></th>
    		<th></th>
    		<th></th>
    	</tr>	
    <?php foreach($resultados as $result): ?>
    	<tr>
    		<td><?php echo $result->Nombre; ?></td>
    		<td><?php echo $result->Descripcion; ?></td>
    		<td><?php echo $result->Codigo_Barras; ?></td>
    		<td><?php echo $result->Id_Genero; ?></td>
    		<td><?php echo $result->Id_Color; ?></td>
    		<td><?php echo $result->Id_Categoria_Producto; ?></td>
    		<td><?php echo $result->Activo; ?></td>
    		<td><?php echo $result->Id_Tipo_Sustancia; ?></td>
    		<td><?php echo $result->Id_Marca; ?></td>
    	</tr>	
    
    <?php endforeach; ?>
    </table>
    
<?php  
}
?>