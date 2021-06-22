<?php 
include("includes/includes.php");

print_r($_POST);

?>
<br />
<?php print_r($_SESSION); ?>
<?php  ?>
<?php 
$indice_actual = 0;


/*
Array ( [id] => 0 [id_cliente] => 1 [id_evento] => 1 )
Array ( [login] => ok [id_login] => 1 [nombre] => admin [sucede] => algo [cantidad_productos] => 4 [producto] => Array ( [0] => 3 ) [precio] => Array ( [0] => 7790.00 ) [cantidad] => Array ( [0] => 4 ) ) 

*
id_cliente] => 1 [id_evento] =>
*/

echo "<hr />";

echo $_POST["id_evento"];
echo "<br />";

if($_POST["id_evento"] != ""){
    
    $id_evento = $_POST["id_evento"];
    
    
    $id_cliente = $_POST["id_cliente"];
    
    $fecha_actual = date("Y-m-d H:i:s");
    
    $monto_total = 0;
    
    foreach($_SESSION["producto"] as $producto){
        
        $producto_val = $_SESSION["producto"][$indice_actual];
        $cantidad_val = $_SESSION["cantidad"][$indice_actual];
        $precio_val = $_SESSION["precio"][$indice_actual];
        
        $monto_total += ($cantidad_val * $precio_val);
        
        echo $monto_total . "<br />";
        
        $indice_actual++;
    }
    //$monto_total = "";
    
        //$qry_insert_venta = "insert into ds_tbl_evento (Descripcion, Fecha_Inicio, Calle, Colonia, Id_Codigo_Postal, Fecha_Alta, Activo, Fecha_Cierre, Id_Empleado_Alta, Inventario_Revisado, Fecha_Revision_Inventario, Inventario_Revisado_Dia_Posterior, Fecha_Revision_Inventario_Dia_Posterior)";
    //
    //Textos completos	Id_Venta	Id_Cliente	Fecha_Venta	MontoTotal	Id_Evento	DescuentoPorcentaje	DescuentoPrecio	TipoCambio	MontoTotalMXN	IdEmpleado	plazo	frecuencia	id_Motivo_Cancelacion	fecha_Cancelacion
    //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion)";
    //
    //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}',  $id_evento, )";
    //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, DescuentoPorcentaje, DescuentoPrecio, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total,  $id_evento, )";
    
    $dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");
    
    $dolar_valor = $dolar_val->Valor;
    
    $id_empleado = 1;
    
    $monto_total_dolar = $monto_total / $dolar_valor;
    
    //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total,  $id_evento, )";
    //
    //$qry_insert_venta = "insert into ds_tbl_evento (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, plazo, frecuencia, id_Motivo_Cancelacion, fecha_Cancelacion) values ($id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado;)";
    //
    //$qry_insert_venta = "insert into ds_tbl_venta (Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
    //
    $venta_val = $obj->get_row("select * from ds_tbl_venta order by Id_Venta desc limit 1");
    $id_venta = $venta_val->Id_Venta + 1;
    
    //$qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
    //$qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado)";
    //DescuentoPorcentaje	DescuentoPrecio
    $descuento_porcentaje = 0;
    $descuento_precio = 0;
    
    $qry_insert_venta = "insert into ds_tbl_venta (Id_Venta, Id_Cliente, Fecha_Venta, MontoTotal, Id_Evento, TipoCambio, MontoTotalMXN, IdEmpleado, DescuentoPorcentaje, DescuentoPrecio) values ($id_venta, $id_cliente, '{$fecha_actual}', $monto_total_dolar,  $id_evento, $dolar_valor, $monto_total, $id_empleado, $descuento_porcentaje, $descuento_precio)";
    //echo $qry_insert_venta; 
    
    $obj->query($qry_insert_venta);
    
}


?>
hola