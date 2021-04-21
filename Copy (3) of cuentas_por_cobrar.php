<?php include("includes/includes.php"); ?>
<?php include("common_files/sesion.php"); ?>
<?php
if($_GET["fecha"] != ""){
    $fecha_val = $_GET["fecha"];
}else{
    $fecha_val = date("Y-m-d");
}
if($_GET["fecha_fin"] != ""){
    $fecha_fin = $_GET["fecha_fin"];
}else{
    $fecha_fin = date("Y-m-d");
}
$nombre_seccion = "Cuentas por cobrar";

?>
<?php 
//domingo = 0
//lunes = 1
//$orgDate = "2019-02-26";
$orgDate = "13-12-2020";
//$newDate = date("m-d-Y", strtotime($orgDate));
//$newDate = date("w", strtotime($orgDate));
$newDate = date("w", strtotime($fecha_val));

//echo "New date format is: ".$newDate. " (MM-DD-YYYY)";

$dia_de_semana = date('w');




//$new_fecha_inicio_semana = date("Y-m-d", strtotime($fecha_val. " {$val_lun} days"));
$fecha_inicio_val_start = $fecha_val . ' 00:00:00';
//$fecha_inicio_val_end = $new_fecha_inicio_semana . ' 23:59:59';

//$fecha_final_val_start = $new_fecha_final_semana . ' 00:00:00';
$fecha_final_val_end = $fecha_fin . ' 23:59:59';


$qry_semana = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_inicio_val_start}' and Fecha_Venta <= '{$fecha_final_val_end}'";
//echo $qry_hours;
$res_semana = $obj->get_row($qry_semana);

//echo $res_semana->sumatoria;

$value_percent = 100 / $res_semana->sumatoria;

//ds_tbl_venta_metodo_pago
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta where Fecha_Venta >= '{$fecha_inicio_val_start}' and Fecha_Venta <= '{$fecha_final_val_end}'";
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//ds_cat_metodo_pago`
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta left join ds_cat_metodo_pago on ds_tbl_venta_metodo_pago.Id_Metodo_Pago = ds_cat_metodo_pago.Id_Forma_Pago where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
//ds_tbl_venta.Fecha_Venta
//$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4 order by ds_tbl_venta.Fecha_Venta";
//$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4 order by ds_tbl_venta.Fecha_Venta asc";
$qry_resultados = "select * from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta left join ds_tbl_cliente on ds_tbl_venta.Id_Cliente = ds_tbl_cliente.Id_Cliente where ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4 group by ds_tbl_cliente.Id_Cliente order by ds_tbl_venta.Fecha_Venta asc";
////echo $qry_hours;
//echo $qry_resultados;
$resultados = $obj->get_results($qry_resultados);

//print_r($resultados);
//exit();
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
<?php /**
<link href="css/main.css" rel="stylesheet" type="text/css">
*/ ?>

<script type="text/javascript">
$( document ).ready(function() {
     console.log( "ready!" );
    
});
function enviar_correo_recordatorio(cliente){
	$.ajax({
        type: "POST",
        //url:"ajax_graph_hours.php",
        //url:"ajax_resultado_tipo_producto.php",
        url:"ajax_enviar_correo_cuentas_por_cobrar.php",
        data: { cliente:cliente },
        success:function(data){
            alert(data);
            
            /*

            $("#resultado_filtrado").html(data);
            
            $("#resultado_venta").html("");
            $("#resultado_realizar_pago").html("");
            
            
            var $link = $(this);
    		    var anchor  = $link.attr('href');
    		    $('html, body').stop().animate({
    		        scrollTop: $(anchor).offset().top
    		    }, 1000);
    		    $("#menu_mobile").hide();
            */
            /*
           var anchor  = $("#resultados_ventas");
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    */
        
        }
	});
}
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

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

</head>

<body>

	<div id="banner_fondo" style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:100; background:black; opacity:.7; display:none;">
	
	</div>
	<div id="banner_contenido" style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:101; display:none;">
		<div style="width:100%; height:100%;">
			<div style="margin:10%; padding:3%; background:white; overflow-x:scroll;">
        		<div id="resultado_filtrado">
        		
        		</div>
        		<div id="resultado_venta">
                            	
                </div>
                <div id="resultado_realizar_pago">
                	
                </div>
                <div id="grafica_reporte_tipo_productos">
                
                </div>
			</div>
        </div>
	</div>

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
<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
<!-- 
<a href="usuarios.php" class="breadcrumb-item">Usuarios</a>
<span class="breadcrumb-item active">Listado</span>
-->
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

<!-- Basic datatable -->
<div class="card">
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

<div class="card-body">
Gr&aacute;ficas de tipos de productos.
</div>
<?php /**
<div class="card-body">
La lista de <code>Usuarios</code> muestra todos los participantes que pueden acceder a la <code>intranet</code>.
</div>
*/ ?>

<script>
function filtrar_cliente(id){

//var cliente = $("#cliente").val();
	var cliente = id;

	$.ajax({
         type: "POST",
         //url:"ajax_graph_hours.php",
         //url:"ajax_resultado_tipo_producto.php",
         url:"ajax_resultado_credito_cliente.php",
         data: { cliente:cliente },
         success:function(data){


        	 $("#banner_fondo").show();
        	 $("#banner_contenido").show();

        	 
         $("#resultado_filtrado").html(data);

         $("#resultado_venta").html("");
         $("#resultado_realizar_pago").html("");
         
         /*
         var $link = $(this);
		    var anchor  = $link.attr('href');
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    $("#menu_mobile").hide();
         */
            var anchor  = $("#resultados_ventas");
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    
         
         }
	});
}
function detalle_venta(id){
	var venta = id;

	$.ajax({
         type: "POST",
         //url:"ajax_graph_hours.php",
         //url:"ajax_resultado_tipo_producto.php",
         url:"ajax_resultado_detalle_venta.php",
         data: { venta:venta },
         success:function(data){
         $("#resultado_venta").html(data);

         
         /*
         var $link = $(this);
		    var anchor  = $link.attr('href');
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    $("#menu_mobile").hide();
         */
            var anchor  = $("#resultado_venta");
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    
         
         }
	});
}
function realizar_pago(id){
	var venta = id;
	$.ajax({
        type: "POST",
        //url:"ajax_graph_hours.php",
        //url:"ajax_resultado_tipo_producto.php",
        url:"ajax_resultado_detalle_venta_realizar_pago.php",
        data: { venta:venta },
        success:function(data){
        $("#resultado_realizar_pago").html(data);

        /*
        var $link = $(this);
		    var anchor  = $link.attr('href');
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    $("#menu_mobile").hide();
        */
           var anchor  = $("#resultado_realizar_pago");
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    
        
        }
	});
}
function guardar_pago(){
	if($("#monto_pago").val() != ""){

	}else{
		alert("Introduce un monto");
		$("#monto_pago").focus();
	}
	if($("#comprobante_pago").val() != ""){

	}else{
		alert("Introduce un comprobante");
		$("#comprobante_pago").focus();
	}
	if($("#metodo_pago").val() != ""){

	}else{
		alert("Introduce un m&eacute;todo de pago");
		$("#metodo_pago").focus();
	}
	alert("hola");

	//var formData = new FormData($("#form_pago")[0]);
	//var formData = new FormData(document.querySelector('#form_pago'));
	var formData = new FormData();
    var files = $('#comprobante_pago')[0].files[0];
    formData.append('file',files);
    formData.append('metodo_pago',$("#metodo_pago").val());
    formData.append('monto_pago',$("#monto_pago").val());
    formData.append('id_venta',$("#id_venta").val());
	
    
	  $.ajax({
	    //url: "page.php",
		url: "ajax_guardar_pago_credito.php",
	    type: "POST",
	    data: formData,
	    success: function (msg) {
	      alert(msg)
	    },
	    cache: false,
	    contentType: false,
	    processData: false
	});
}
function filtrar_marca(id){

	$.ajax({
             type: "POST",
             //url:"ajax_graph_hours.php",
             url:"ajax_resultado_tipo_producto.php",
             data: { id:id },
             success:function(data){
             $("#resultado_tipo_producto").html(data);
             }
	});
}
function filtrar_categoria(){

var id_marca = $("#marca").val();
var tipo_producto = $("#tipo_producto").val();
var anio = $("#anio").val();





	$.ajax({
             type: "POST",
             //url:"ajax_graph_hours.php",
             url:"ajax_grafica_reporte_tipo_productos.php",
             data: { id_marca:id_marca, tipo_producto:tipo_producto, anio:anio },
             success:function(data){
             $("#grafica_reporte_tipo_productos").html(data);
             }
	});
}
</script>
<div class="form-row">
                        <div class="form-group col-md-6">
                         <div>Cliente:</div>
                            
                         <select onchange="filtrar_cliente(this.value);" id="cliente" class="form-control">
     <option value="">Selecciona un cliente</option>
    
     <?php foreach ($resultados as $resultado): ?>
     <option value="<?php echo $resultado->Id_Cliente; ?>"><?php echo $resultado->Apellido_Paterno . " " . $resultado->Apellido_Materno . " " . $resultado->Nombre; ?><?php echo " &nbsp; $ " . $resultado->Monto . " USD"; ?> <?php echo " &nbsp; " . $resultado->Fecha_Venta; ?></option>
     <?php endforeach; ?>
     </select>
     <?php /**
     <div>Cliente:</div>
                            
                         <select onchange="filtrar_marca(this.value);" id="marca" class="form-control">
     <option value="">Selecciona un cliente</option>
    
     <?php foreach ($resultados as $resultado): ?>
     <option value="<?php echo $resultado->Id_Cliente; ?>"><?php echo $resultado->Apellido_Paterno . " " . $resultado->Apellido_Materno . " " . $resultado->Nombre; ?><?php echo " &nbsp; $ " . $resultado->Monto . " USD"; ?> <?php echo $resultado->Fecha_Venta; ?></option>
     <?php endforeach; ?>
     </select>
    
    
                          <div>A&ntilde;o:</div>
                            
                            <select onchange="filtrar_marca(this.value);" id="anio" class="form-control">
     <?php for($i = 2020; $i<=date("Y"); $i++): ?>
     <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
     <?php endfor; ?>
     </select>
     */ ?>
                        </div>
                    </div>
                    
                    <div>
                     <table class="table datatable-basic">
     <thead>
     <tr>
     <th>ID</th>
     <th>Cliente</th>
     <th>Monto</th>
    
     <th>Fecha</th>
    
    
     <th class="text-center">Actions</th>
     </tr>
     </thead>
     <tbody>
    
    
                            <?php 
                            /**
                             $
    
                                */
    
                            ?>  
                            
                            
                             <?php /**?>
    
     */ ?>
    
     <?php
     //}
     ?>
    
     <?php 
     //$qry_resultados = "select * from $tbl_main order by Descripcion asc";
    
     //$resultados = $obj->get_results($qry_resultados);
    
     ?>
     <?php //foreach ($resultados as $resultado): ?>
     <?php //endforeach; ?>
     <?php foreach($resultados as $resultado): ?>
    
    
    
     <?php //for($i=0; $i<=10; $i++): ?>
    
     <?php 
     $id_resultado=$resultado->Id_Cliente;
     $nombre=$resultado->Descripcion;
     $hexadecimal=$resultado->Codigo_Hexadecimal;
     $id_nivel="Hola";
     $extension="Hola";
     $area="Hola";
     $completo="Hola";
     $niveles="Hola";
     
     
     $qry_result = "select sum(ds_tbl_venta.MontoTotal) as total from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta.Id_Venta = ds_tbl_venta_metodo_pago.Id_Venta where ds_tbl_venta.Id_Cliente = $id_resultado and ds_tbl_venta_metodo_pago.Id_Metodo_Pago = 4";
     //echo $qry_result;
     //exit;
     $result = $obj->get_row($qry_result);
     
     
     ?>
     
     
    
    
     <tr id="element<?php echo $id_resultado; ?>">
     <td onclick="filtrar_cliente(<?php echo $id_resultado; ?>)"><?php echo $id_resultado; ?></td>
     <td onclick="filtrar_cliente(<?php echo $id_resultado; ?>)"><a onclick="filtrar_cliente(<?php echo $id_resultado; ?>)"><?php echo $resultado->Apellido_Paterno . " " . $resultado->Apellido_Materno . " " . $resultado->Nombre; ?></td>
     <td onclick="filtrar_cliente(<?php echo $id_resultado; ?>)"><?php echo " &nbsp; $ " . $result->total . " USD"; ?></td>
    <td onclick="filtrar_cliente(<?php echo $id_resultado; ?>)"><?php echo $resultado->Fecha_Venta; ?><?php //print_r($result); ?></td>
    
    
    
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
     <a onclick="filtrar_cliente(<?php echo $id_resultado; ?>)" class="dropdown-item"><i class="icon-pencil4"></i> Registrar pago</a>
     <a onclick="enviar_correo_recordatorio('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Enviar correo</a>
     <?php /**
     <a href="#" class="dropdown-item" onclick="Eliminar(<?php echo $id_resultado; ?>,'<?php echo $completo." (".$nombre.")"; ?>');"><i class="icon-bin"></i> Remove</a>
     <a onclick="cargar_editar('<?php echo $id_resultado; ?>')" class="dropdown-item"><i class="icon-pencil4"></i> Editar</a>
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
                    
                    </div>
                    <?php /**
<div class="form-row">
                        <div class="form-group col-md-6">
                          <div>Filtro por marca:</div>
                            <?php 
     $qry_marca = "select * from ds_cat_marca order by Descripcion asc";
     $marcas = $obj->get_results($qry_marca);
     ?>
                            <select onchange="filtrar_marca(this.value);" id="marca" class="form-control">
     <option value="">Selecciona una marca</option>
    
     <?php foreach ($marcas as $marca): ?>
     <option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
     <?php endforeach; ?>
     </select>
                        </div>
                        <div class="form-group col-md-6" id="resultado_tipo_producto">
                          <div>Tipo de producto</div>
                          <?php 
                          $tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
                          ?>
                         <select onchange="filtrar_categoria();" name="tipo_producto" id="tipo_producto" class="form-control">
                        <?php foreach($tipos_producto as $tipo_producto): ?>
                        <option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
                        <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                    
                    
                    <div id="resultado_filtrado">
                    
                    </div>
                    <div id="resultado_venta">
                    	
                    </div>
                    <div id="resultado_realizar_pago">
                    	
                    </div>
                    <div id="grafica_reporte_tipo_productos">
                    
                    </div>
                    
                    
                    
                    <div id="resultado_filtrado">
                    
                    </div>
                    <div id="resultado_venta">
                    	
                    </div>
                    <div id="resultado_realizar_pago">
                    	
                    </div>
                    <div id="grafica_reporte_tipo_productos">
                    
                    </div>
                    */ ?>
                    
<div>

<script>
                 function mostrar_horarios_home(fecha){
                 $("#graph_home_days").hide();
                 $("#graph_home_hours").show();
                
                 $.ajax({
                 type: "POST",
                 //url:"ajax_graph_hours.php",
                 url:"ajax_home_horas.php",
                 data: { fecha:fecha },
                 success:function(data){
                 $("#graph_home_hours").html(data);
                 }
                 });
                
                 }
                 function ir_detalle(){
                 var valor_fecha_inicio = $('#fecha_inicio').val();

                 var valor_fecha_fin = $('#fecha_fin').val();
                

                
                
                 window.location="?fecha=" + valor_fecha_inicio + "&fecha_fin=" + valor_fecha_fin;
                 }
                 </script>
                 <style>
                        .graph_home{
                         background:orange;
                         /*background: linear-gradient(180deg, red, yellow);*/
                         background: linear-gradient(180deg, #2b8bf2, yellowgreen);
                         width:10%;
                         margin:0 2%;
                         cursor:pointer;
                        }
                        .graph_home_day{
                         width:10%;
                         margin:0 2%;
                         text-align:center;
                         font-weight:bold;
                         font-size:20px;
                        }
                        .graph_home_percent{
                         width:10%;
                         margin:0 2%;
                         text-align:center;
                        }
                        </style>











</div>
</div>
<!-- /basic datatable -->



</div>
<!-- /content area -->






<!-- Footer -->
<?php include "core_footer.php"; ?>
<!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>