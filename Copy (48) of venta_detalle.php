<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php 
$nombre_seccion = "Detalle de venta";
$tbl_main = "ds_tbl_venta";
$nombre_simple = "talla";
$url_name = "ventas.php";
$url_crear_name = "crear_metodo_pago.php";

$id_venta = $_GET["id"];

//$qry_resultado = "select * from $tbl_main where Id_Venta = $id_venta";
$qry_resultado = "select * from $tbl_main left join ds_tbl_cliente on $tbl_main.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta.Id_Venta = $id_venta";

//echo $qry_resultado;
$resultado = $obj->get_row($qry_resultado);
$id_cliente = $resultado->Id_Cliente;
?>
<?php 
//print_r($_POST);
// [id_entrega] => 912 [devolucion_cantidad] => 1 [Id_Estatus_Entrega_Producto] => 2 [Num_Referencia_Envio] => 578yiuhuhk [Nombre_Recibio] => hkjhjkhjkhjk [action] => 
// [id_entrega] => 912 [devolucion_cantidad] => 1 [Id_Estatus_Entrega_Producto] => 2 [] => 578yiuhuhk [] => hkjhjkhjkhjk [action] =>
//echo $_POST["id_direccion"];
//if($_POST["id_entrega"] != "" && ($_POST["Num_Referencia_Envio"] != "" && $_POST["Nombre_Recibio"] != "" && $_POST[""] != "" && $_POST[""] != "" && $_POST[""] != "")){
if($_POST["id_entrega"] != "" && ($_POST["Num_Referencia_Envio"] != "" && $_POST["Nombre_Recibio"] != "")){
    $id_entrega = $_POST["id_entrega"];
    
    //
    //Textos completos	Id_Entrega	Entrega_Fisica	Id_Domicilio	Id_Producto_detalle	Cantidad	Entregado	Id_Venta	Id_Cliente	Num_Referencia_Envio	Nombre_Recibio	Fecha_Entrega	Paqueteria	Notas	Id_Estatus_Entrega_Producto
    //Textos completos	Id_Entrega	Entrega_Fisica	Id_Domicilio	Id_Producto_detalle	Cantidad	Entregado	Id_Venta	Id_Cliente
    //		Fecha_Entrega			
    
    $Num_Referencia_Envio = $_POST["Num_Referencia_Envio"];
    $Nombre_Recibio = $_POST["Nombre_Recibio"];
    $Paqueteria = $_POST["Paqueteria"];
    $Notas = $_POST["Notas"];
    $Id_Estatus_Entrega_Producto = $_POST["Id_Estatus_Entrega_Producto"];
    
    
    //$qry_update_envio = "update ds_tbl_entrega_venta_productos where Id_Entrega = $id_entrega";
    $qry_update_envio = "update ds_tbl_entrega_venta_productos set Num_Referencia_Envio = '{$Num_Referencia_Envio}', Nombre_Recibio = '{$Nombre_Recibio}', Paqueteria = '{$Paqueteria}', Notas = '{$Notas}', Id_Estatus_Entrega_Producto = $Id_Estatus_Entrega_Producto where Id_Entrega = $id_entrega";
    //echo $qry_update_envio;
    $obj->query($qry_update_envio);
    
    
}


if($_POST["devolucion_cantidad"] != "" && $_POST["id_entrega"] != ""){
    $devolucion_cantidad = $_POST["devolucion_cantidad"];
    $id_entrega = $_POST["id_entrega"];
    
    //$qry_devolucion = "select * from ds_tbl_entrega_venta_productos where Id_Entrega = $id_entrega";
    //$qry_devolucion = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_producto_detalle on ds_tbl_entrega_venta_productos.Id_Producto_detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_entrega_venta_productos.Id_Entrega = $id_entrega";
    //ds_tbl_venta
    $qry_devolucion = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_producto_detalle on ds_tbl_entrega_venta_productos.Id_Producto_detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_venta on ds_tbl_venta.Id_Venta = ds_tbl_entrega_venta_productos.Id_Venta where ds_tbl_entrega_venta_productos.Id_Entrega = $id_entrega";
    //
    $devolucion = $obj->get_row($qry_devolucion);
    
    //print_r($devolucion);
    
    //
    //Textos completos	idDevolucionVenta							
    $id_venta_val = $devolucion->Id_Venta;
    $id_producto_detalle_val = $devolucion->Id_Producto_detalle;
    $cantidad_val = $devolucion->Cantidad;
    $id_motivo_devolucion = $_POST["motivo_devolucion"];
    $id_motivo_cancelacion = 0;
    $fecha_registro = date("Y-m-d H:i:s");
    $activo = 1;
    
    
    $id_evento = $devolucion->Id_Evento;
    //print_r($devolucion);
    $nueva_cantidad_entregado = $cantidad_val - $devolucion_cantidad;
    
    
    //
    
    
    //$qry_insert_devolucion = "insert into ds_tbl_devolucion_venta (idVenta, idProductoDetalle, cantidad, idMotivoDevolucion, idMotivoCancelacion, fechaRegistro, activo) values ($id_venta_val, $id_producto_detalle_val, $cantidad_val, $id_motivo_devolucion, $id_motivo_cancelacion, '{$fecha_registro}', $activo)";
    $qry_insert_devolucion = "insert into ds_tbl_devolucion_venta (idVenta, idProductoDetalle, cantidad, idMotivoDevolucion, idMotivoCancelacion, fechaRegistro, activo) values ($id_venta_val, $id_producto_detalle_val, $devolucion_cantidad, $id_motivo_devolucion, $id_motivo_cancelacion, '{$fecha_registro}', $activo)";
    
    //echo $qry_insert_devolucion;
    $obj->query($qry_insert_devolucion);
    
    
    
    $qry_edit_enviado = "update ds_tbl_entrega_venta_productos set Cantidad = $nueva_cantidad_entregado where ds_tbl_entrega_venta_productos.Id_Entrega = $id_entrega";
    //echo $qry_edit_enviado;
    $obj->query($qry_edit_enviado);
    
    
    $qry_inventario_evento = "select * from ds_tbl_inventario_evento where Id_Evento = $id_evento and Id_Producto_Detalle = $id_producto_detalle_val";
    $inventario_evento = $obj->get_row($qry_inventario_evento);
    
    
    $nueva_cantidad_inventario_evento = $inventario_evento->Cantidad + $devolucion_cantidad;
    $id_inventario_evento = $inventario_evento->Id_Inventario_Evento;
    
    //ds_tbl_inventario_evento
    //ds_tbl_inventario_evento
    //REVISAR ESTAR LINEA
    //$qry_disminuir_inventario_evento = "update ds_tbl_inventario_evento set Cantidad = $nueva_cantidad_inventario_evento where ds_tbl_inventario_evento.Id_Evento = $id_evento and ds_tbl_inventario_evento.Id_Producto_Detalle = $id_producto_detalle_val";
    $qry_disminuir_inventario_evento = "update ds_tbl_inventario_evento set Cantidad = $nueva_cantidad_inventario_evento where ds_tbl_inventario_evento.Id_Evento = $id_evento and ds_tbl_inventario_evento.Id_Producto_Detalle = $id_producto_detalle_val and ds_tbl_inventario_evento.Id_Inventario_Evento = $id_inventario_evento";
    //echo $qry_disminuir_inventario_evento;
    
    
    //echo $qry_disminuir_inventario_evento;
    $obj->query($qry_disminuir_inventario_evento);
    
    
    
}

if($_POST["id_direccion"] != ""){
    //ds_tbl_entrega_venta_productos
    $id_direccion = $_POST["id_direccion"];
    if($id_direccion == "ENTREGA_FISICA"){
        $id_direccion = 0;
        $entrega_fisica = 1;
    }else{
        $entrega_fisica = 0;
    }
    
    foreach ($_POST["cantidad_venta"] as $producto_key => $producto_value){
        
        //Id ds_tbl_venta_detalle detalle
        //print_r($producto_key);
        //echo "<br />";
        //cantidad de productos
        //print_r($producto_value);
        //echo "<hr />";
        
        $venta_detalle_value = $obj->get_row("select * from ds_tbl_venta_detalle where Id_Venta_Detalle = $producto_key");
        
        $id_producto_detalle_value = $venta_detalle_value->Id_Producto_Detalle;
        
        if($producto_value >= 1){
            $value_entrega = $obj->get_row("select * from ds_tbl_entrega_venta_productos order by Id_Entrega desc");
            $next_id = $value_entrega->Id_Entrega + 1;
            //
            //Textos completos	Id_Entrega	Entrega_Fisica	Id_Domicilio	Id_Producto_detalle	Cantidad	Entregado	Id_Venta	Id_Cliente	Num_Referencia_Envio	Nombre_Recibio	Fecha_Entrega	Paqueteria	Notas	Id_Estatus_Entrega_Producto
            //Textos completos	Id_Entrega	Entrega_Fisica				Entregado			Num_Referencia_Envio	Nombre_Recibio	Fecha_Entrega	Paqueteria	Notas	Id_Estatus_Entrega_Producto
            $fecha_entrega = date("Y-m-d H:i:s");
            //$qry_insert_entrega = "insert into ds_tbl_entrega_venta_productos (Id_Domicilio, Cantidad, Id_Producto_detalle, Id_Venta, Id_Cliente) values ($id_direccion, $producto_value, $producto_key, $id_venta, $id_cliente)";
            //$qry_insert_entrega = "insert into ds_tbl_entrega_venta_productos (Id_Entrega, Id_Domicilio, Cantidad, Id_Producto_detalle, Id_Venta, Id_Cliente) values ($next_id, $id_direccion, $producto_value, $producto_key, $id_venta, $id_cliente)";
            
            
            
            
            
            $id_evento = $resultado->Id_Evento;
            
            $qry_inventario_evento = "select * from ds_tbl_inventario_evento where Id_Evento = $id_evento and Id_Producto_Detalle = $id_producto_detalle_value";
            //echo $qry_inventario_evento;
            $inventario_evento = $obj->get_row($qry_inventario_evento);
            
            
            //print_r($inventario_evento);
            
            if($entrega_fisica == 1){
            
                if($inventario_evento->Cantidad >= $producto_value){
                
                    //echo "Si hay disponibles";
                
                    $qry_insert_entrega = "insert into ds_tbl_entrega_venta_productos (Id_Entrega, Id_Domicilio, Cantidad, Id_Producto_detalle, Id_Venta, Id_Cliente, Entrega_Fisica, Fecha_Entrega) values ($next_id, $id_direccion, $producto_value, $id_producto_detalle_value, $id_venta, $id_cliente, $entrega_fisica, '{$fecha_entrega}')";
                    $obj->query($qry_insert_entrega);
                    //echo $qry_insert_entrega;
                    
                    
                    //ds_tbl_inventario_evento
                    
                    
                    
                    
                    if($entrega_fisica == 1){
                    
                        //echo "ENTEGANDO FISICAMENT";
                        
                        
                        $nueva_cantidad_inventario_evento = $inventario_evento->Cantidad - $producto_value;
                        $id_inventario_evento_val = $inventario_evento->Id_Inventario_Evento;
                        
                        
                        $qry_disminuir_inventario_evento = "update ds_tbl_inventario_evento set Cantidad = $nueva_cantidad_inventario_evento where ds_tbl_inventario_evento.Id_Evento = $id_evento and ds_tbl_inventario_evento.Id_Producto_Detalle = $id_producto_detalle_value";
                        //echo $qry_edit_enviado;
                        $obj->query($qry_disminuir_inventario_evento);
                    }
                    
                }else{
                    //echo "sin productos disponibles";
                    
                    $qry_insert_entrega = "insert into ds_tbl_entrega_venta_productos (Id_Entrega, Id_Domicilio, Cantidad, Id_Producto_detalle, Id_Venta, Id_Cliente, Entrega_Fisica, Fecha_Entrega) values ($next_id, $id_direccion, $producto_value, $id_producto_detalle_value, $id_venta, $id_cliente, $entrega_fisica, '{$fecha_entrega}')";
                    $obj->query($qry_insert_entrega);
                    
                }
            }
        }
        
        
        
        
    }
    
}

if($_POST["Descripcion"] != ""){
    
    $val_descripcion = $_POST["Descripcion"];
    $val_activo = $_POST["Activo"];
    $val_abreviatura = $_POST["Abreviatura"];
    $val_comentario = $_POST["Comentario"];
    $fecha_hoy = date("Y-m-d H:i:s");
    
    
    if($_POST["editar"] != ""){
        $id_editar = $_POST["editar"];
        //$qry_edit = "update ds_cat_tipo_sustancia set Descripcion = '{$val_descripcion}', Abreviatura = '{$val_abreviatura}', Comentario = '{$val_comentario}', Activo = $val_activo, Fecha_Actualiza = '{$fecha_hoy}' where Id_Tipo_Sustancia = $id_editar";
        //echo $qry_edit;
        $qry_edit = "update ds_cat_talla set Descripcion = '{$val_descripcion}', Abreviacion = '{$val_abreviatura}', Activo = $val_activo, Fecha_Actualiza = '{$fecha_hoy}' where Id_Talla = $id_editar";
        //
        $obj->query($qry_edit);
        
        
        header('Location: ./tallas.php', true, 303);
        exit;
    }else{
        //$qry_insert = "insert into ds_cat_tipo_sustancia (Descripcion, Abreviatura, Comentario, Activo, Fecha_Alta, Fecha_Actualiza) values ('{$val_descripcion}', '{$val_abreviatura}', '{$val_comentario}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        $qry_insert = "insert into ds_cat_talla (Descripcion, Abreviacion, Activo, Fecha_Alta, Fecha_Actualiza) values ('{$val_descripcion}', '{$val_abreviatura}', 1, '{$fecha_hoy}', '{$fecha_hoy}')";
        $obj->query($qry_insert);
        
        
        header('Location: ./tallas.php', true, 303);
        exit;
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php

	include "core_title.php";

	 ?>

	<script type="text/javascript">
		$( document ).ready(function() {
    		console.log( "ready!" );
    		
		});

		function eliminar_pago(id){
			
			if(confirm("¿Seguro de eliminar el pago?")){
				$.ajax({
					type: "POST",
		            url:"eliminar_pago.php",
		            //data: { limit:val_limit, offset:val_offset },
		            data: { id:id },
		            success:function(data){
		            	console.log(data);
		            	var element_id = "#elementpago" + id;
		            	//alert(element_id);
		            	$(element_id).hide("");

		            	<?php /**
		            	window.location = "venta_detalle.php?id=<?php echo $_GET['id']; ?>";
		            	*/ ?>
		            }
				});
			}
		}



		   function activar_metodo_pago(tipo_metodo_pago, id_venta_val){
				//alert(tipo_metodo_pago);
			   //var id_venta_val = $("#id_venta").val();
				//alert(id_venta_val);
			   $.ajax({
					type: "POST",
					//url:"/views_online/guardar_venta.php",
					url:"/activar_metodo_pago.php",
					//data: { limit:val_limit, offset:val_offset },
					//data: { id:id, id_ship:id_ship },
					data: { tipo_metodo_pago:tipo_metodo_pago, id_venta_val:id_venta_val },
					success:function(data){
						console.log(data);
						//$('#fondo_especial').slideDown('slow'); $('#banner_especial').show('slow');

						//alert(data);

						//$("#resultado_metodo_pago").html(data);
						//$("#resultado_activar_metodo_pago").html(data);
						//$("#resultado_activar_metodo_pago").append(data);
						//alert(data);
						$("#resultado_activar_metodo_pago").html(data);
						DatatableBasic.init();
						/**
						$("#form_venta").html(data);
						$(".select_refresh").formSelect();
						*/

						//iniciar_venta.php

						
					}
				});
		   }



		function guardar_pago_tarjeta(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_tarjeta.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					//$("#resultado_activar_metodo_pago").append(data);
					$("#resultado_pago").html(data);
					activar_metodo_pago(id_metodo_pago, id_venta_val);
				}
			});
		}
		function guardar_pago_efectivo(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_efectivo.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
					activar_metodo_pago(id_metodo_pago, id_venta_val);
				}
			});
		}
		function guardar_pago_cortesia(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			$.ajax({
				type: "POST",
				url:"/guardar_pago_cortesia.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
					activar_metodo_pago(id_metodo_pago, id_venta_val);
				}
			});
		}
		function guardar_pago_credito(){
			var monto_val = $("#monto").val();
			var terminacion_tarjeta_val = $("#terminacion_tarjeta").val();
			var referencia_val = $("#referencia").val();
			var id_venta_val = $("#id_venta").val();
			var id_moneda_val = $("#id_moneda").val();
			var id_metodo_pago = $("#id_metodo_pago").val();
			
			$.ajax({
				type: "POST",
				url:"/guardar_pago_credito.php",
				data: { monto_val:monto_val, terminacion_tarjeta_val:terminacion_tarjeta_val, referencia_val:referencia_val, id_venta_val:id_venta_val, id_moneda_val:id_moneda_val, id_metodo_pago:id_metodo_pago },
				success:function(data){
					console.log(data);
					$("#resultado_pago").html(data);
					activar_metodo_pago(id_metodo_pago, id_venta_val);
					
				}
			});
		}






		
	    function calcular_billetes_mil(cantidad){
	    	$('#resultado_billete_1000').val(cantidad * 1000);

		    actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_quinientos(cantidad){
	    	$('#resultado_billete_500').val(cantidad * 500);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_doscientos(cantidad){
		    $('#resultado_billete_200').val(cantidad * 200);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_cien(cantidad){
	    	$('#resultado_billete_100').val(cantidad * 100);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_cincuenta(cantidad){
	    	$('#resultado_billete_50').val(cantidad * 50);

	    	actualizar_total_billetes();
	        
	    }
	    function calcular_billetes_veinte(cantidad){
	    	$('#resultado_billete_20').val(cantidad * 20);

	    	actualizar_total_billetes();
	        
	    }
	    function actualizar_total_billetes(){
	    	var val_mil = parseInt($('#resultado_billete_1000').val());
	    	var val_quinientos = parseInt($('#resultado_billete_500').val());
	    	var val_doscientos = parseInt($('#resultado_billete_200').val());

	    	var val_cien = parseInt($('#resultado_billete_100').val());
	    	var val_cincuenta = parseInt($('#resultado_billete_50').val());
	    	var val_veinte = parseInt($('#resultado_billete_20').val());

	    	var val_total = val_mil + val_quinientos + val_doscientos + val_cien + val_cincuenta + val_veinte;

	    	//alert(val_total);

	    	$('#resultado_billetes').val(val_total);

	    	var monto_restante_mxn = parseFloat($('#monto_restante_mxn').val());
	    	var monto_restante_mxn = parseFloat($('#monto_restante_mxn').val());



	    	var cambio = monto_restante_mxn - val_total;

	    	if(cambio > 0){
	    		$('#resultado_cambio').val(0);

	    		
	    		$('#resultado_restante').val(cambio);


	    		$('#monto').val(val_total);
	    		

	    		
	    	}else{
	    		$('#resultado_cambio').val(cambio);

	    		$('#resultado_restante').val(0);


	    		$('#monto').val(monto_restante_mxn);

	    		
	    	}


	    	//$('#monto').val(val_total);
	    	
	    	
	    	
	    	
	    	
	    	
	    }
	    //resultado_cambio
		

		function Eliminar(t_id,t_completo){
			//alert("Eliminar; "+t_id);

			var r = confirm("Estás seguro que deseas eliminar al usuario: "+t_completo);
			if (r == true) {
			  txt = "You pressed OK!";

			  	$.ajax({url: "usuarios_eliminar.php?id="+t_id, success: function(result){
    				//$("#div1").html(result);
    				//alert(result);
    				$("#element"+t_id).hide(500);
  				}});

			} else {
			  txt = "You pressed Cancel!";
			}

		}

		function validar_crear(){

			if($("#Descripcion").val() != ""){
				$("#form_crear").submit();
			}else{
				$("#Descripcion").focus();
			}
			
			
			
		}
	</script>

</head>

<body>

	<script>
		function cargar_crear_history(){
			$("#container_create").show("");
			$("#container_create").html("");
			$("#container").hide("");
			$("#container_devolucion").hide("");
			var val_page = "";
			var val_categoria = "";

			$.ajax({
				type: "POST",
				url:"<?php echo $url_crear_name; ?>",
				//data: { limit:val_limit, offset:val_offset },
				data: { page:val_page, categoria:val_categoria },
				success:function(data){
					console.log(data);
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#container_create").html(data);
					$(".select_refresh").formSelect();
				}
			});

		   //window.history.pushState("object or string", "Title", "/create");
		   //window.history.pushState("object or string", "Title", "/panel/proyectos.php?create=new");
		   //window.history.pushState("object or string", "Title", "/panel/proyectos.php?func=new");
		   
		   
		}

		function cargar_detalle_entrega(id){
			//$("#container").html("");
			$("#container").hide("");
			$("#container_devolucion").hide("");
			$("#container_create").show("");
			$("#container_create").html("");
			
			
			//if(confirm("¿Estás seguro de hacer devolución?")){
    			$.ajax({
    				type: "POST",
    				url:"ajax_cargar_detalle_entrega.php?rand=257",
    				//data: { limit:val_limit, offset:val_offset },
    				data: { id:id },
    				success:function(data){
    					console.log(data);
    					//alert(data);
    					//$("#resultado_votos_detalle").html(data);
    					//$("#publicaciones_adicionales").html(data);
    					//$("#publicaciones_adicionales").append(data);
    					//$("#container").html(data);
    					$("#container_create").html(data);
    					DatatableBasic.init();
    					
    				}
    			});
			//}
		}
			function cargar_devolucion(id){
			//$("#container").html("");
			$("#container_create").hide("");
			$("#container").hide("");
			$("#container_devolucion").show("");
			$("#container_devolucion").html("");

			if(confirm("¿Estás seguro de hacer devolución?")){
    			$.ajax({
    				type: "POST",
    				url:"ajax_cargar_devolucion.php?rand=256",
    				//data: { limit:val_limit, offset:val_offset },
    				data: { id:id },
    				success:function(data){
    					console.log(data);
    					//alert(data);
    					//$("#resultado_votos_detalle").html(data);
    					//$("#publicaciones_adicionales").html(data);
    					//$("#publicaciones_adicionales").append(data);
    					//$("#container").html(data);
    					$("#container_devolucion").html(data);
    					DatatableBasic.init();
    					
    				}
    			});
			}

			//window.history.pushState("object or string", "Title", "/<?php echo $url_name; ?>?func=new");
		   
		}
		
		function cargar_crear(){
			//$("#container").html("");
			$("#container_create").show("");
			$("#container_create").html("");
			$("#container").hide("");
			$("#container_devolucion").hide("");
		   
			var val_page = "";
			var val_categoria = "";

			$.ajax({
				type: "POST",
				url:"<?php echo $url_crear_name; ?>",
				//data: { limit:val_limit, offset:val_offset },
				data: { page:val_page, categoria:val_categoria },
				success:function(data){
					console.log(data);
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					//$("#container").html(data);
					$("#container_create").html(data);
					
				}
			});

			window.history.pushState("object or string", "Title", "/<?php echo $url_name; ?>?func=new");
		   
		}
		function cargar_editar(id){
            $("#container_create").show("");
            $("#container_create").html("");
			$("#container").hide("");
			$("#container_devolucion").hide("");
		   
            //$("#container").html("");
            var val_page = "";
			var val_categoria = "";
		   
			$.ajax({
				type: "POST",
                url:"<?php echo $url_crear_name; ?>",
                //data: { limit:val_limit, offset:val_offset },
                data: { id:id },
                success:function(data){
                	console.log(data);
                	//$("#resultado_votos_detalle").html(data);
                	//$("#publicaciones_adicionales").html(data);
                	//$("#publicaciones_adicionales").append(data);
                	//$("#container").html(data);
                	$("#container_create").html(data);
                }
			});
		}
		function cerrar_cargar(){
            //window.history.pushState("object or string", "Title", "/panel/proyectos.php");
            //window.history.pushState("proyectos", "Title", "/<?php echo $url_name; ?>");
			window.history.pushState("proyectos", "Title", "/venta_detalle.php");
            $('#container').show();
            $('#container_create').hide();
            $('#container_devolucion').hide();
		}
        (function(history){
            var pushState = history.pushState;
            console.log("test");
			console.log(pushState);
			history.pushState = function(state) {
                console.log("state");
                console.log(state);
                if (typeof history.onpushstate == "function") {
                    history.onpushstate({state: state});
                    console.log("history");
                    console.log(history);
                }
                // whatever else you want to do
				// maybe call onhashchange e.handler
				return pushState.apply(history, arguments);
			}
        })(window.history);
		window.onpopstate = function (event) {

			console.log(window.location);
			console.log("www");
			console.log(window.location.href);
			console.log("www pathname");
			console.log(window.location.pathname);

			console.log("www search");
			console.log(window.location.search);

			
			
			if(window.location.search == "?func=new"){
				console.log("CREAR");
				/*
				$("#container_create").show("");
				$("#container").hide("");
				*/

				//cargar_crear();
				cargar_crear_history();
			}else{
				$("#container_create").hide("");
				$("#container").show("");
			}
			if(window.location.pathname == "/<?php echo $url_name; ?>"){
				console.log("PROY");
				//$("#container_create").hide("");
				//$("#container").show("");
				
			}
			if(window.location.pathname == "/<?php echo $url_name; ?>?func=new"){
				console.log("CREAR");
				/*
				$("#container_create").show("");
				$("#container").hide("");
				*/

				cargar_crear();
			}

			
			console.log("entro");
			if (event.state) {
				//history changed because of pushState/replaceState
                console.log("si");
				//ir al siguiente movimiento
			} else {
				//history changed because of a page load
                console.log("no");
                //$("#container_create").hide("");
				//ir hacia atras
			}
		}

		window.addEventListener('replaceState', function(e) {
			console.warn('THEY DID IT AGAIN!');
		});
		
		window.addEventListener('popstate', function(e) {
			console.log("EeE");
            var character = e.state;
            console.log(character);
            
            if (character == null) {
                removeCurrentClass();
                textWrapper.innerHTML = " ";
                content.innerHTML = " ";
                document.title = defaultTitle;
            } else {
                updateText(character);
                requestContent(character + ".html");
                addCurrentClass(character);
				document.title = "Ghostbuster | " + character;
            }
		});
		</script>

	<!-- Main navbar -->
	<?php include "core_mainnav.php"; ?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<?php include "core_sidebar-mobile-toggler.php"; ?>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">


				<!-- User menu -->
				<?php include "core_user-menu.php"; ?>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<?php
						include_once("menu.php");
						 ?>


					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">






			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $nombre_seccion; ?></span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center" style="display: none;">
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
							<a href="#" class="btn btn-link btn-float text-default" style="display: none;"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
						</div>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="home.php" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<a href="<?php echo $url_name; ?>" class="breadcrumb-item"><?php echo $nombre_seccion; ?></a>
							<span class="breadcrumb-item active">Listado</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none" style="display: none;">
						<div class="breadcrumb justify-content-center">
							<a href="#" class="breadcrumb-elements-item" style="display: none;">
								<i class="icon-comment-discussion mr-2"></i>
								Support
							</a>

							<div class="breadcrumb-elements-item dropdown p-0" style="display: none;">
								<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear mr-2"></i>
									Settings
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
									<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
									<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->



			<!-- Content area -->
			<div class="content">

				
				<div class="card" id="container_devolucion">
				
				</div>
				
				<!-- Create container -->
				<div class="card" id="container_create">
				
				</div>
				
				<!-- Basic datatable -->
				<div class="card" id="container">
				
					
					<?php /**
					<div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div style="text-align:right;">
                            	<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="cargar_crear()"><i class="material-icons right">add</i> Agregar pago</button>
                            	
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                    </div>
                    <br /><br /><br />
                    */ ?>
					
					<div class="card-header header-elements-inline">
						<h5 class="card-title"><?php echo $nombre_seccion; ?></h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<?php
					/**
					$id_venta = $_GET["id"];
					
					//$qry_resultado = "select * from $tbl_main where Id_Venta = $id_venta";
					$qry_resultado = "select * from $tbl_main left join ds_tbl_cliente on $tbl_main.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta.Id_Venta = $id_venta";
					
					//echo $qry_resultado;
					$resultado = $obj->get_row($qry_resultado);
					$id_cliente = $resultado->Id_Cliente;
					*/
					?>
					<h1><?php //print_r($resultado); ?></h1>
					<div>
						<?php
						$date = new DateTime($resultado->Fecha_Venta);
						//echo $date->format('d-m-Y');
						//echo $detalle_venta->Fecha_Venta;
						
						//echo "Fecha de venta: " . $resultado->Fecha_Venta . "<br />";
						echo "<b>Fecha de venta:</b> " . $date->format('d-m-Y') . "<br />";
						echo "<b>Monto total:</b> $" . number_format($resultado->MontoTotalMXN, 2) . "MXN<br />";
						echo "<b>Cliente:</b> " . $resultado->Nombre . " " . $resultado->Apellido_Paterno . " " . $resultado->Apellido_Materno . " " . "<br />";
						
						//stdClass Object ( [Id_Venta] => 704 [Id_Cliente] => 228 [Fecha_Venta] => 2021-04-23 23:01:32 [MontoTotal] => 300.00 [Id_Evento] => 1 [DescuentoPorcentaje] => 19 [DescuentoPrecio] => 19.00 [TipoCambio] => 20.00 [MontoTotalMXN] => 6000.00 [IdEmpleado] => 1 [plazo] => 0 [frecuencia] => 0 [id_Motivo_Cancelacion] => 0 [fecha_Cancelacion] => [Nombre] => AGUSTIN [Apellido_Paterno] => LERA [Apellido_Materno] => [CURP] => [Correo_Electronico] => [Telefono] => [Celular] => [Codigo_Cliente] => [Contrasena] => [Limite_Credito] => 0 [Plazo_Credito] => 0 [Fecha_Alta] => 2020-10-02 11:21:18 [Fecha_Actualiza] => 2020-10-02 11:21:18 [Es_Comisionista] => 0 [Activo] => 1 )
						?>
						<br /><br />
					</div>
					<div>
						<?php //$id_venta =  $resultado->Id_Venta; ?>
						
						
					</div>
					<?php 
					//$qry_prductos_ventas = "select * from ds_tbl_venta_detalle where Id_Venta = $id_venta";
					//$qry_prductos_ventas = "select * from ds_tbl_venta_detalle left join left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					$qry_prductos_ventas = "select * from ds_tbl_venta_detalle left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_venta_detalle.Id_Venta = $id_venta";
					//echo $qry_prductos_ventas;
					//echo $qry_venta_detalle;
						//$resultados = $obj->get_results($qry_resultados);
					$prductos_ventas = $obj->get_results($qry_prductos_ventas);
					
						?>
					<h4>Productos de la venta</h4>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Cantidad</th>
								<th>Producto</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							

							<?php
							//}
							?>

							
							
							
						<?php foreach($prductos_ventas as $resultado): ?>
						
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							//[0] => stdClass Object ( [Id_Producto] => 256 
							//[Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] 
							//=> [Id_Marca] => 1 [Id_Tipo_Producto] => 14
							//[Id_Tipo_Sustancia] => 1 [Activo] => 1 
							//[Fecha_Alta] => 2020-07-21 22:10:43 
							//[Id_Categoria_Producto] => 79 
							
							$id_resultado=$resultado->Id_Venta_Detalle;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								<td><?php echo $resultado->Cantidad; ?></td>
								
								<td><?php echo $resultado->Nombre; ?></td>
								
								<td><?php echo $resultado->MontoVenta; ?></td>
								
								

							</tr>
							<?php //endfor; ?>
							<?php endforeach; ?>

						</tbody>
					</table>
					
					<hr />
<form method="post" action="">
					<h4>Productos disponibles por entregar</h4>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Disponibles</th>
								<th>Cantidad</th>
								<th>Producto</th>
								<th>Precio</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							

							
							
							
						<?php foreach($prductos_ventas as $resultado): ?>
						
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							//[0] => stdClass Object ( [Id_Producto] => 256 
							//[Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] 
							//=> [Id_Marca] => 1 [Id_Tipo_Producto] => 14
							//[Id_Tipo_Sustancia] => 1 [Activo] => 1 
							//[Fecha_Alta] => 2020-07-21 22:10:43 
							//[Id_Categoria_Producto] => 79 
							
							$id_resultado=$resultado->Id_Venta_Detalle;
							$id_producto_detalle_actual = $resultado->Id_Producto_Detalle;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							
							
							$qry_entregado = "select count(*) as sumatoria from ds_tbl_entrega_venta_productos where Id_Venta = $id_venta and Id_Producto_Detalle = $id_producto_detalle_actual";
							//echo $qry_pagos;
							//$resultados = $obj->get_results($qry_resultados);actua
							$entregado = $obj->get_row($qry_entregado);
							
							
							$inc_maximo = $resultado->Cantidad - $entregado->sumatoria;
							?>
							<?php if($inc_maximo > 0): ?>
							<tr id="element<?php echo $id_resultado; ?>">
								<td>
									<select name="cantidad_venta[<?php echo $id_resultado; ?>]" class="form-control">
										<?php //for($i=0; $i<=$resultado->Cantidad; $i++): ?>
										<?php for($i=0; $i<=$inc_maximo; $i++): ?>
										<option><?php echo $i; ?></option>
										<?php endfor; ?>
									
									</select>
								</td>
								<td><?php echo $resultado->Cantidad; ?></td>
								
								<td><?php echo $resultado->Nombre; ?></td>
								
								<td><?php echo $resultado->MontoVenta; ?></td>
								
								
								

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
							<?php endif; ?>
							<?php //endfor; ?>
							<?php endforeach; ?>

						</tbody>
					</table>
					<?php 
					//echo $id_cliente;
					
					$qry_direcciones = "select * from ds_tbl_cliente_domicilio_entrega where Id_Cliente = $id_cliente";
					$direcciones = $obj->get_results($qry_direcciones);
					//print_r($direcciones);
					?>
					
					<div>
					
					</div>
					<div class="form-row">
                        <div class="form-group col-md-6">
                             <b>Direcci&oacute;n de env&iacute;o</b>
                             <br />
                             <select name="id_direccion" class="form-control" >
                             	<option value="ENTREGA_FISICA">Entrega f&iacute;sica</option>
                             	<option value="DEVOLUCION">Devoluci&oacute;n</option>
                             	<?php foreach($direcciones as $direccion): ?>
                             	<option value="<?php echo $direccion->Id_Cliente_Domicilio_Entrega; ?>"><?php echo $direccion->Calle; ?></option>
                             	<?php endforeach; ?>
                             </select>
                        </div>
                        <div class="form-group col-md-6">
                         	&nbsp;
                        </div>
                    </div>
                    
					<div class="form-row">
                        <div class="form-group col-md-6">
                             &nbsp;
                        </div>
                        <div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                    </div>

</form>
					<hr />
        			
					
					
					<div class="form-row">
                        <div class="form-group col-md-6">
                         	<select class="form-control" id="id_metodo_pago" name="id_metodo_pago" onchange="activar_metodo_pago(this.value, <?php echo $id_venta; ?>);">
                                <option value="">Selecciona</option>
                                <?php 
                                $metodos_pago = $obj->get_results("select * from ds_cat_metodo_pago");
                                ?>
                                <?php foreach($metodos_pago as $metodo_pago){ ?>
                                	<option value="<?php echo $metodo_pago->Id_Forma_Pago; ?>"><?php echo $metodo_pago->Descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                         	&nbsp;
                        </div>
                    </div>
					<div id="resultado_metodo_pago"></div>
					<h4>Pagos</h4>
					
    				<div id="resultado_activar_metodo_pago">
    					
    					
    					<?php 
    					$qry_pagos_realizados = "select * from ds_tbl_venta_metodo_pago left join ds_cat_metodo_pago on ds_cat_metodo_pago.Id_Forma_Pago = ds_tbl_venta_metodo_pago.Id_Metodo_Pago where ds_tbl_venta_metodo_pago.Id_Venta = $id_venta";
    					
    					//echo $qry_pagos_realizados;
    					$pagos_realizados = $obj->get_results($qry_pagos_realizados);
    					
    					?>
    					
    					
    					<?php if($pagos_realizados == Array()): ?>
<h2 style="margin-left:40px;">Sin pagos realizados</h2>
<?php else: ?>
<table class="table datatable-basic">
<tr>
	<th>Monto</th>
	<th>M&eacute;todo de pago</th>
	<th>Moneda</th>
	<th>Terminaci&oacute;n tarjeta</th>
	<th>Referencia</th>
</tr>
<?php foreach($pagos_realizados as $resultado): ?>
	<?php //print_r($resultado); ?>
	<?php 
	$id_resultado = $resultado->Id_Venta_Metodo;
	$monto_val = $resultado->Monto;
	
	$id_moneda = $resultado->Id_Moneda;
	
	$monto_acumulado += $resultado->Monto;
	?>
	<tr id="elementpago<?php echo $id_resultado; ?>">
								
								<td>$<?php echo $resultado->Monto; ?>MXN</td>
								<td>
									<?php echo $resultado->Descripcion; ?>
	
    	
								</td>
								<td>
									<?php //print_r($resultado); ?>
									<?php //echo $pago_realizado->Id_Moneda;
							        if($resultado->Id_Moneda == 1){
                                	    echo "Pagado en moneda nacional";
                                	}
                                	if($resultado->Id_Moneda == 2){
                                	    echo "Pagado en d&oacute;lares";
                                	}
                                	
                                	?>
								</td>
								<td>
									<?php echo $resultado->Terminacion_Tarjerta; ?>
	
    	
								</td>
								<td>
									<?php echo $resultado->Referenci; ?>
								</td>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="eliminar_pago(<?php echo $id_resultado; ?>);"><i class="icon-bin"></i> Eliminar</a>
												<?php /**
												<a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												<a href="usuarios_editar.php?id=<?php echo $id_usuario; ?>" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
												*/ ?>
											</div>
										</div>
									</div>
								</td>
							</tr>
	
<?php endforeach; ?>
</table>
<?php endif; ?>
    					
    					
    					
    				</div>
					
					
					<?php
							//}
							?>

							<?php 
							
							//$qry_pagos = "select * from ds_tbl_entrega_venta_productos where Id_Venta = $id_venta";
							//$qry_pagos = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente on ds_tbl_entrega_venta_productos.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_entrega_venta_productos.Id_Venta = $id_venta";
							//ds_tbl_cliente_domicilio_entrega
							//$qry_pagos = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente_domicilio_entrega on ds_tbl_entrega_venta_productos.Id_Cliente = ds_tbl_cliente_domicilio_entrega.Id_Cliente where ds_tbl_entrega_venta_productos.Id_Venta = $id_venta";
							$qry_pagos = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente_domicilio_entrega on ds_tbl_entrega_venta_productos.Id_Domicilio = ds_tbl_cliente_domicilio_entrega.Id_Cliente_Domicilio_Entrega where ds_tbl_entrega_venta_productos.Id_Venta = $id_venta";
							/**
							select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente_domicilio_entrega on ds_tbl_entrega_venta_productos.Id_Domicilio = ds_tbl_cliente_domicilio_entrega.Id_Cliente_Domicilio_Entrega
							left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_entrega_venta_productos.Id_Producto_detalle
							left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto
							
							
							where ds_tbl_entrega_venta_productos.Id_Venta = 785 
							
							
							select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente_domicilio_entrega on ds_tbl_entrega_venta_productos.Id_Domicilio = ds_tbl_cliente_domicilio_entrega.Id_Cliente_Domicilio_Entrega left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_entrega_venta_productos.Id_Producto_detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_entrega_venta_productos.Id_Venta = 

							
							785 
							
							*/
							$qry_entregas = "select * from ds_tbl_entrega_venta_productos left join ds_tbl_cliente_domicilio_entrega on ds_tbl_entrega_venta_productos.Id_Domicilio = ds_tbl_cliente_domicilio_entrega.Id_Cliente_Domicilio_Entrega left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_entrega_venta_productos.Id_Producto_detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_entrega_venta_productos.Id_Venta = $id_venta";
							
							//echo $qry_entregas;
							//$resultados = $obj->get_results($qry_resultados);
							$entregas = $obj->get_results($qry_entregas);
							//print_r($pagos);
						//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
						
						//$resultados = $obj->get_results($qry_resultados);
							
							$estatus_entrega_producto = $obj->get_results("select * from ds_cat_estatus_entrega_producto");
						?>
						
					<?php if($entregas == Array()): ?>
					<h4>Sin entregas realizadas</h4>
					<?php else: ?>
					<h4>Entregas realizadas</h4>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Cantidad</th>
								<th>Producto</th>
								<th>Entrega F&iacute;sica</th>
								<th>Domicilio</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							

							
						<?php /**
						<tr>
						
							<td><?php echo $qry_entregas; ?></td>
						</tr>
						*/ ?>
						<?php foreach($entregas as $resultado): ?>
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							$id_resultado=$resultado->Id_Entrega;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								
								<td><?php echo $resultado->Cantidad; ?></td>
								
								<td><?php echo $resultado->Nombre; ?></td>
								<td>
									<?php 
									if($resultado->Entrega_Fisica == "1"){
									    echo "Si";
									}else{
									    echo "No";
									}
									//echo $resultado->Nombre;
									
									?>
								
								</td>
								<td><?php echo $resultado->Calle . " " . $resultado->Numero . " " . $resultado->Colonia . " " . $resultado->Delegacion_Municipio . " " . $resultado->Estado . " " . $resultado->Codigo_Postal; ?></td>
								<?php /**
								<td>
									<select>
									<?php foreach($estatus_entrega_producto as $status_entrega){ ?>
										<option value="<?php echo $status_entrega->Id_Estatus_Entrega_Producto; ?>"><?php echo $status_entrega->Descripcion; ?></option>
									<?php } ?>
									</select>
								</td>
								*/ ?>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="cargar_devolucion(<?php echo $id_resultado; ?>);"><i class="icon-bin"></i>  Devoluci&oacute;n</a>
												<a href="#" class="dropdown-item" onclick="cargar_detalle_entrega(<?php echo $id_resultado; ?>);"><i class="icon-bin"></i>  Detalle de entrega</a>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<?php //endfor; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php endif; ?>
					
					
					<?php 
							
							
							//$qry_devoluciones = "select * from ds_tbl_devolucion_venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_devolucion_venta.IdProductoDetalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_devolucion_venta.Id_Venta = $id_venta";
							//$qry_devoluciones = "select * from ds_tbl_devolucion_venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_devolucion_venta.IdProductoDetalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where ds_tbl_devolucion_venta.idVenta = $id_venta";
							$qry_devoluciones = "select * from ds_tbl_devolucion_venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_devolucion_venta.IdProductoDetalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_cat_motivo_devolucion_venta on ds_cat_motivo_devolucion_venta.idMotivoDevolucionVenta = ds_tbl_devolucion_venta.idMotivoDevolucion where ds_tbl_devolucion_venta.idVenta = $id_venta";
                            //echo $qry_devoluciones;
							$devoluciones = $obj->get_results($qry_devoluciones);
								
						
						?>
					<?php if($devoluciones == Array()): ?>
					<h4>Sin devoluciones realizadas</h4>
					
					<?php else: ?>
					
					<h4>Devoluciones realizadas</h4>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Cantidad</th>
								<th>Producto</th>
								<th>Motivo devoluci&oacute;n</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							

							<?php
							//}
							?>

							
						<?php /**
						<tr>
							<td><?php echo $qry_devoluciones; ?></td>
						</tr>
						*/ ?>
						<?php foreach($devoluciones as $resultado): ?>
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							$id_resultado=$resultado->Id_Entrega;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								
								<td><?php echo $resultado->cantidad; ?></td>
								
								<td><?php echo $resultado->Nombre; ?></td>
								<td>
									<?php 
									echo $resultado->motivoDevolucionVenta;
									//echo $resultado->Nombre;
									
									?>
								
								</td>
								
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>
<?php /**
											
											<div class="dropdown-menu dropdown-menu-right">
												<a href="#" class="dropdown-item" onclick="cargar_devolucion(<?php echo $id_resultado; ?>);"><i class="icon-bin"></i>  Devoluci&oacute;n</a>
											</div>
											*/ ?>
											
										</div>
									</div>
								</td>
							</tr>
							<?php //endfor; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php endif; ?>
					
					
					<?php /*
					<h4>Abonos</h4>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Cantidad</th>
								<th>Producto</th>
								
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							

							<?php
							//}
							?>

							
							
							<?php 
							
							$qry_abonos = "select * from ds_tbl_venta_abono where Id_Venta = $id_venta";
							//echo $qry_abonos;
							//$resultados = $obj->get_results($qry_resultados);
							$abonos = $obj->get_results($qry_abonos);
							//print_r($abonos);
						//$qry_resultados = "select * from $tbl_main order by Fecha_Venta desc";
						
						//$resultados = $obj->get_results($qry_resultados);
							
						
						?>
						<?php foreach($abonos as $resultado): ?>
						
						
						
							<?php //for($i=0; $i<=10; $i++): ?>
							
							<?php 
							//[0] => stdClass Object ( [Id_Producto] => 256 
							//[Nombre] => 01 VW3024 MOSCA JACKET [Descripcion] 
							//=> [Id_Marca] => 1 [Id_Tipo_Producto] => 14
							//[Id_Tipo_Sustancia] => 1 [Activo] => 1 
							//[Fecha_Alta] => 2020-07-21 22:10:43 
							//[Id_Categoria_Producto] => 79 
							
							$id_resultado=$resultado->Id_Talla;
							$nombre=$resultado->Nombre;
							$hexadecimal=$resultado->Descripcion;
							?>
								
							<tr id="element<?php echo $id_resultado; ?>">
								
								<td><?php echo $resultado->Cantidad; ?></td>
								
								<td><?php echo $resultado->Monto_Venta; ?></td>
								
								
								
								
								
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
				</div>
				<!-- /basic datatable -->
			</div>
			<!-- /content area -->

			<!-- Footer -->
			<?php include "core_footer.php"; ?>
			<!-- /footer -->
		</div>
		<!-- /main content --
	</div>
	<!-- /page content -->
</body>
</html>