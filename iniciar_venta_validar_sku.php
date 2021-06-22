<?php
include("includes/includes.php");
include("common_files/sesion.php");

$tipo_cambio_dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");
$tipo_cambio_dolar = $tipo_cambio_dolar_val->Valor;


$val_sku = $_POST["sku"];

$producto_search_qry = "select * from ds_tbl_producto_detalle where ds_tbl_producto_detalle.Codigo_Barras = '{$val_sku}'";
$producto_search = $obj->get_row($producto_search_qry);


if($producto_search->Id_Producto != ""){
    $id_producto = $producto_search->Id_Producto;
}else{
    $id_producto = 0;
}

$id = $id_producto;
/*
print_r($_POST);

echo "<hr />";

print_r($_SESSION);

echo "ID PRODUCTOx:";
echo $id_producto . "<br />";

//exit();
echo "----";

echo "X--" . $id;
*/


if($id_producto == 0){
    if(empty($_SESSION["cantidad_productos"])){
        echo 0;
    }else{
        //echo "---- 2";
        echo $_SESSION["cantidad_productos"];
    }
}else{
    //echo "select * from ds_tbl_producto where Id_Producto = {$id}";
    //echo "<hr />";
    //echo "<hr />";
    
    //$producto = $obj->get_row("select * from ds_tbl_producto where Id_Producto = {$id}");
    //$qry_producto = "select * from ds_tbl_producto where Id_Producto = '{$id}'";
    //$producto = $obj->get_row("select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where Id_Producto = '{$id}'");
    $qry_producto = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = '{$id}'";
    //
    //echo $qry_producto;
    $producto = $obj->get_row($qry_producto);
    //$producto = $obj->get_results($qry_producto);
    
    //echo "PRODUCTO";
    //print_r($producto);
    
    
    if($_SESSION["cantidad_productos"] == ""){
        $_SESSION["cantidad_productos"] = 1;
    }else{
        $_SESSION["cantidad_productos"]++;
    }
    
    //echo "<hr />";
    //print_r($_SESSION);
    
    for($i=0; $i<=$_SESSION["cantidad_productos"]; $i++){
        if($_SESSION["producto"][$i] == $id_producto){
            $_SESSION["producto"][$i] = $id;
            //$_SESSION["precio"][$i] = $producto->Costo_Venta;
            
            if($_SESSION["precio"][$i] != ""){
                $_SESSION["precio"][$i] = $_SESSION["precio"][$i];
                
            }else{
                $_SESSION["precio"][$i] = $producto->Dolar * $tipo_cambio_dolar;
            }
            
            
            $cantidad_productos = $_SESSION["cantidad"][$i];
            $_SESSION["cantidad"][$i] = $cantidad_productos+1;
            $en_carrito = "1";
        }else{
            
        }
        
    }
    
    
    if($en_carrito == "1"){
        
    }else{
        $_SESSION["producto"][] = $id;
        $_SESSION["precio"][] = $producto->Dolar * $tipo_cambio_dolar;
        $_SESSION["cantidad"][] = 1;
        
        
        $_SESSION["sucede"] = "algo";
        
    }
}

//print_r($_SESSION);
?>




<?php if(empty($_SESSION) || $_SESSION["cantidad_productos"] == 0 || $_SESSION["cantidad_productos"] == ""){ ?>
	<?php /**
	CARRITO VACIO
	
	
	<div style="text-align:center; font-size:30px; color:#FBC7BC;">
		<img src="images/carrito_compra.png" style="height:25px;" /> El carrito de compras est&aacute; vac&iacute;o
	</div>
	<div style="text-align:center;">
		<div onclick="window.location='./#productos'" style="display:block; margin:20px 325px; width:350px; border:2px solid #FBC7BC; color:#FBC7BC; cursor:pointer;">
			Haz click aqu&iacute; para comprar productos
		</div>
	</div>
	*/ ?>
<?php }else{ ?>
	<?php /**
	<form id = "paypal_checkout" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">
	*/ ?>
	<form>
	
	<?php include("iniciar_venta_actual.php"); ?>
	
	</form>
<?php } ?>


<?php //print_r($_SESSION); ?>


<?php /**?>

PRUEBA



<table class="table datatable-basic">
						<thead>
							<tr>
								<th>ID</th>
								<th>Producto</th>
								<th>Marca</th>
								
								<th>Color</th>
								<th>Talla</th>
								<th>Num. Piezas</th>
								
								<th>Precio</th>
								<th>Total</th>
								
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							


							<?php
							//}
							?>

							<?php 
							$qry_resultados = "select * from ds_tbl_producto order by Descripcion asc";
						
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
							//$nombre=$resultado->Nombre;
							//$hexadecimal=$resultado->Descripcion;
							$nombre="";
							$hexadecimal="";
							$id_nivel="Hola";
							$extension="Hola";
							$area="Hola";
							$completo="Hola";
							$niveles="Hola";
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								<td><?php echo $id_resultado; ?></td>
								<td><a href="usuarios_editar.php?id=<?php echo $id_resultado; ?>"><?php echo $nombre; ?></td>
								<td><?php echo $hexadecimal; ?></td>
								
								<td><div style="width:20px; height:20px; border-radius:100%; background:<?php echo $hexadecimal; ?>"></div></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								
¡
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_usuario; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
												<a onclick="cargar_editar('<?php echo $id_usuario; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
										
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php //endfor; ?>
							<?php endforeach; ?>

						</tbody>
					</table>
					
					
					
					PRUEBA 2
					*/ ?>