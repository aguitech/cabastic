<?php
include("includes/includes.php");
// Include and initialize phpmailer class
//require 'PHPMailer/PHPMailerAutoload.php';
//require 'class.phpmailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//existencias_actual=10&existencias_nuevas=8&id_producto=10
$usuario_actual = $_GET["usuario"];
$costo_actual = $_GET["costo_actual"];
$costo_nuevo = $_GET["costo_nuevo"];
$id_producto = $_GET["id_producto"];


//function enviar_correo($existencias_actual, $existencias_nuevas, $id_producto){




require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
// SMTP configuration
$mail->isSMTP();
$mail->Host = 'mail.cabastic.info';
$mail->SMTPAuth = true;
$mail->Username = 'notificaciones@cabastic.info';
$mail->Password = 'n0t1f1c4c10n3s';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
//$mail->Port = 465;


$mail->setFrom('notificaciones@cabastic.info', 'Notificaciones');
$mail->addReplyTo('notificaciones@cabastic.info', 'Notificaciones');



$id_cliente = $_POST["cliente"];

$qry_clientes = "select * from ds_tbl_cliente where Id_Cliente = $id_cliente";

$cliente = $obj->get_row($qry_clientes);

print_r($cliente->Correo_Electronico);

if($cliente->Correo_Electronico != ""){
    $email_cliente = $cliente->Correo_Electronico;
    
}else{
    $email_cliente = "";
    exit();
}

// Add a recipient
//$mail->addAddress('hector@aguitech.com');
$mail->addAddress($email_cliente);
//$mail->addAddress('israel.aguilar@divagsystems.com');
//$mail->addAddress('tanya.martinezbaca.rivera@gmail.com');
//$mail->addAddress('jjimenez@cabastic.com');

// Add cc or bcc
//$mail->addCC([email protected]');
//$mail->addBCC([email protected]');

// Email subject
$mail->Subject = 'Detalle de ciente';

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "<h3>Detalle de cliente</h3>";

/**
 $mailContent = "<h1>Aguitech</h1>
 <p>This is a test email has sent using SMTP mail server with PHPMailer.</p>";
 
 $qry_resultados = "select * from ds_cat_marca order by Descripcion asc";
 
 $resultados = $obj->get_results($qry_resultados);
 
 foreach($resultados as $resultado){
 $mailContent .= $resultado->Descripcion . "<br />";
 
 }
 
 $mailContent .= "Se actualizo el producto:<br />";
 
 */



$tbl_main = "ds_tbl_producto";



$id = $_GET["cliente"];

//echo $id;
$qry_cliente = "select * from ds_tbl_cliente where Id_Cliente = {$id}";
$cliente = $obj->get_row($qry_cliente);

//print_r($cliente);

$qry_result = "select sum(ds_tbl_venta.MontoTotalMXN) as total from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//echo $qry_result;
//exit;
$result = $obj->get_row($qry_result);


$qry_result_abonos = "select sum(ds_tbl_venta_abono.Monto_Abono) as total from ds_tbl_venta_abono left join ds_tbl_venta on ds_tbl_venta.Id_Venta = ds_tbl_venta_abono.Id_Venta where ds_tbl_venta.Id_Cliente = $id";
//echo $qry_result;
//exit;
$result_abono = $obj->get_row($qry_result_abonos);


$total_restante = $result->total - $result_abono->total;

$mailContent .= '<table style="width:100%;">
		<tr>
			 <td>
			 	<b>Detalle de la venta</b><br />
			 	<span style="font-size:15px; ">' . $result->Fecha_Venta . '</span>
			 </td>';
$mailContent .= '<td style="text-align:right;">Deuda restante<br /><b style="font-size:18px; padding-left:40px;">$ ' . number_format($total_restante, 2) . 'MXN</b></td>
		</tr>
	</table>';
$qry_ventas = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//echo $qry_result;
//exit;
$ventas = $obj->get_results($qry_ventas);
foreach($ventas as $venta):
$mailContent .= '<hr />
	<div>
		<div>
			Monto Total: ' . $venta->MontoTotalMXN . '
		</div>
		<div>
			Fecha de Venta:' . $venta->Fecha_Venta . '
		</div>';
		$id_venta = $venta->Id_Venta;
		
		$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_venta_detalle.Id_Venta = $id_venta";
		//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
		
		$productos = $obj->get_results($qry_productos);
		
		
$mailContent .= '
		
		
		<table class="table datatable-basic">
    		<thead>
    			<tr>
    				<th>Cantidad</th>
    				<th>C&oacute;digo de Barras</th>
    				<th>Producto</th>
    				<th>Descripci&oacute;n</th>
    				
    				<th class="text-center">&nbsp;</th>
    			</tr>
    		</thead>
    		<tbody>';
foreach($productos as $producto):
    			$id_producto = $producto->Id_Producto;
$mailContent .= '<tr id="element' . $id_producto . '">
    					
    					
        			<td>' . $producto->Cantidad . '</td>
    				<td>' . $producto->Codigo_Barras . '</td>
    				<td>' . $producto->Nombre . '</td>
        			<td>' . $producto->Descripcion . '</td>
        			<td class="text-center">
    					<div class="list-icons">
    						<div class="dropdown">
    							<a href="#" class="list-icons-item" data-toggle="dropdown">
    								<i class="icon-menu9"></i>
    							</a>
    
    							<div class="dropdown-menu dropdown-menu-right">
    								
    							</div>
    						</div>
    					</div>
    				</td>
    			</tr>
';
endforeach;
$mailContent .= '</tbody>
    	</table>';

//$qry_abono_res = "select * from ds_tbl_venta_abono where ds_tbl_venta_abono.Id_Venta = $id_venta";
$qry_abono_res = "select * from ds_tbl_venta_abono left join ds_cat_metodo_pago on ds_cat_metodo_pago.Id_Forma_Pago = ds_tbl_venta_abono.Id_Metodo_Pago where ds_tbl_venta_abono.Id_Venta = $id_venta";

//$qry_productos = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
//echo $qry_abono_res . "<br />";
$abono_res = $obj->get_results($qry_abono_res);


$mailContent .= '<table class="table datatable-basic">
			<thead>
				<tr>
    				<th>Fecha</th>
    				<th>Monto</th>
    				<th>M&eacute;todo de pago</th>
    			</tr>
			</thead>
			<tbody>';
$sum_total = 0;
foreach($abono_res as $abono):
$id_abono = $abono->Id_Venta_Abono;
$mailContent .= '<tr id="element' . $id_abono . '">
					<td>' . $abono->Fecha_Abono . '</td>
					$sum_total += $abono->Monto_Abono;
        			<td>$' . number_format($abono->Monto_Abono, 2) . 'MXN</td>
        			<td>' . $abono->Descripcion . '</td>
				</tr>
				';
endforeach;
$mailContent .= '<tr>
    				<th><b>Total abonos</b></th>
    				<th><b>$' .number_format($abono->Monto_Abono, 2) . 'MXN</b></th>
    			</tr>
			</tbody>
		</table>	
		
		
	</div>';
endforeach;

echo $mailContent;
?>

<?php 
/**
$mailContent .= $usuario_actual;
$mailContent .= "Que tal " . $cliente->Nombre . ":<br />";

$mailContent .= "Presentas un adeudo total de: " . $result->total . "<br /><br />";

$mailContent .= "Quedamos a tus ordenes<br /><br />";

$mailContent .= date("Y-m-d H:i");
*/
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    //echo 'Message has been sent';
}
//}


//enviar_correo(1, 2, 10);