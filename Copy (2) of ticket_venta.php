<?php include("includes/includes.php");?>
<?php include("common_files/sesion.php"); ?>
<?php
include "fpdf/fpdf.php";

$id_venta = $_GET["id"];

//print_r($id_venta);

$qry_venta = "select * from ds_tbl_venta where Id_Venta = $id_venta";
//echo $qry_venta;
$venta_val = $obj->get_row($qry_venta);

//print_r($venta_val);


//$qry_venta = "select * form ds_tbl_venta_detalle where Id_Venta = $id_venta";
$qry_venta_detalle = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_venta_detalle.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
//echo $qry_venta_detalle;
$productos_venta = $obj->get_results($qry_venta_detalle);

//print_r($productos_venta);
//exit();
/*
892select * from ds_tbl_venta where Id_Venta = 892stdClass Object ( [Id_Venta] => 892 [Id_Cliente] => 228 [Fecha_Venta] => 2021-06-18 22:30:17 [MontoTotal] => 87.06 [Id_Evento] => 1 [ExcentarIva] => 0 [DescuentoPorcentaje] => 0 [DescuentoPrecio] => 0.00 [TipoCambio] => 22.00 [SubtotalMXN] => 1651.1 [MontoTotalMXN] => 1915.28 [DescuentoMXN] => 0 [IdEmpleado] => 1 [plazo] => 0 [frecuencia] => 0 [id_Motivo_Cancelacion] => 0 [fecha_Cancelacion] => ) select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_venta_detalle.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_venta_detalle.Id_Venta = 892Array ( [0] => stdClass Object ( [Id_Venta_Detalle] => 1334 [Id_Producto_Detalle] => 900 [Cantidad] => 1 [MontoVenta] => 1650.00 [Id_Venta] => 892 [id_Motivo_Devolucion] => 0 [fecha_Devolucion] => [Codigo_Barras] => A101751030 [Id_Talla] => 1 [Id_Color] => 1 [Id_Producto] => 900 [Id_Tipo_Mercado] => 6 [Id_Genero] => 1 [Activo] => 1 [Nombre] => SELEVIT [Descripcion] => FRASCO DE 100ML [Imagen_Producto] => [Id_Marca] => 36 [Id_Tipo_Producto] => 9 [Id_Tipo_Sustancia] => 1 [Fecha_Alta] => 2020-07-22 23:57:15 [Id_Categoria_Producto] => 46 ) [1] => stdClass Object ( [Id_Venta_Detalle] => 1335 [Id_Producto_Detalle] => 863 [Cantidad] => 1 [MontoVenta] => 1.10 [Id_Venta] => 892 [id_Motivo_Devolucion] => 0 [fecha_Devolucion] => [Codigo_Barras] => 0100404200031 [Id_Talla] => 1 [Id_Color] => 1 [Id_Producto] => 863 [Id_Tipo_Mercado] => 6 [Id_Genero] => 1 [Activo] => 1 [Nombre] => BIZZY BITES DULCES REFIL (1)KG (ORIGINAL REFIL) [Descripcion] => SABOR ORIGINAL REFIL [Imagen_Producto] => [Id_Marca] => 18 [Id_Tipo_Producto] => 7 [Id_Tipo_Sustancia] => 1 [Fecha_Alta] => 2020-07-21 22:20:43 [Id_Categoria_Producto] => 1 ) ) 

*
892select * from ds_tbl_venta where Id_Venta = 892
stdClass Object ( [Id_Venta] => 892 [Id_Cliente] => 228 [Fecha_Venta] => 2021-06-18 22:30:17 [MontoTotal] => 87.06 [Id_Evento] => 1 [ExcentarIva] => 0 [DescuentoPorcentaje] => 0 [DescuentoPrecio] => 0.00 [TipoCambio] => 22.00 [SubtotalMXN] => 1651.1 [MontoTotalMXN] => 1915.28 [DescuentoMXN] => 0 [IdEmpleado] => 1 [plazo] => 0 [frecuencia] => 0 [id_Motivo_Cancelacion] => 0 [fecha_Cancelacion] => ) select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_venta_detalle.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_venta_detalle.Id_Venta = 892Array ( [0] => stdClass Object ( [Id_Venta_Detalle] => 1334 [Id_Producto_Detalle] => 900 [Cantidad] => 1 [MontoVenta] => 1650.00 [Id_Venta] => 892 [id_Motivo_Devolucion] => 0 [fecha_Devolucion] => [Codigo_Barras] => A101751030 [Id_Talla] => 1 [Id_Color] => 1 [Id_Producto] => 900 [Id_Tipo_Mercado] => 6 [Id_Genero] => 1 [Activo] => 1 [Nombre] => SELEVIT [Descripcion] => FRASCO DE 100ML [Imagen_Producto] => [Id_Marca] => 36 [Id_Tipo_Producto] => 9 [Id_Tipo_Sustancia] => 1 [Fecha_Alta] => 2020-07-22 23:57:15 [Id_Categoria_Producto] => 46 ) [1] => stdClass Object ( [Id_Venta_Detalle] => 1335 [Id_Producto_Detalle] => 863 [Cantidad] => 1 [MontoVenta] => 1.10 [Id_Venta] => 892 [id_Motivo_Devolucion] => 0 [fecha_Devolucion] => [Codigo_Barras] => 0100404200031 [Id_Talla] => 1 [Id_Color] => 1 [Id_Producto] => 863 [Id_Tipo_Mercado] => 6 [Id_Genero] => 1 [Activo] => 1 [Nombre] => BIZZY BITES DULCES REFIL (1)KG (ORIGINAL REFIL) [Descripcion] => SABOR ORIGINAL REFIL [Imagen_Producto] => [Id_Marca] => 18 [Id_Tipo_Producto] => 7 [Id_Tipo_Sustancia] => 1 [Fecha_Alta] => 2020-07-21 22:20:43 [Id_Categoria_Producto] => 1 ) ) 
*/

$pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
$textypos = 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"CABASTIC S.A. DE C.V.");

$pdf->SetFont('Arial','B',6);    //Letra Arial, negrita (Bold), tam. 20
$textypos += 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"RFC CABASTIC007");

$textypos += 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Alejandro Graham Bell 15,");

$textypos += 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Col. Industrial Cuamatla, C.P. 54730");

$textypos += 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"Cuautitl&aacute;n Izcalli, Méx.");


$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'——————————————————————-');
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'CANT.  ARTICULO       PRECIO               TOTAL');

$total =0;
$off = $textypos+6;
$producto = array(
	"q"=>1,
	"name"=>"Computadora Lenovo i5",
	"price"=>100
);
$productos = array($producto, $producto, $producto, $producto, $producto );
//foreach($productos as $pro){
//print_r($productos_venta);
foreach($productos_venta as $pro){
//print_r($pro);
//print_r($pro->Nombre);
$pdf->setX(2);
//$pdf->Cell(5,$off,$pro["q"]);
$pdf->Cell(5,$off,100000);
$pdf->setX(6);
$val_nombre = $pro->Nombre;
$pdf->Cell(35,$off,  strtoupper(substr($val_nombre, 0,12)) );
$pdf->setX(20);
$pdf->Cell(11,$off,  "$".number_format(1000,2,".",",") ,0,0,"R");
$pdf->setX(32);
//$pdf->Cell(11,$off,  "$ ".number_format($pro["q"]*$pro["price"],2,".",",") ,0,0,"R");
//echo $pro->Cantidad . "<br />";
$val_cantidad = $pro->Cantidad;
$pdf->Cell(11,$off,  "$ ".number_format($val_cantidad,2,".",",") ,0,0,"R");

//$total += $pro["q"]*$pro["price"];
$total += 1000;
$off+=6;
}
$textypos=$off+6;

$pdf->setX(2);
$pdf->Cell(5,$textypos,"TOTAL: " );
$pdf->setX(38);
$pdf->Cell(5,$textypos,"$ ".number_format($total,2,".",","),0,0,"R");

$pdf->setX(2);
$pdf->Cell(5,$textypos+6,'GRACIAS POR TU COMPRA ');

$pdf->output();