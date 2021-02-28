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
$nombre_seccion = "Reporte Exitencias o Costos y/o Precios";

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
$qry_resultados = "select *, sum(MontoTotalMXN) as sumatoria from ds_tbl_venta left join ds_tbl_venta_metodo_pago on ds_tbl_venta_metodo_pago.Id_Venta = ds_tbl_venta.Id_Venta left join ds_cat_metodo_pago on ds_tbl_venta_metodo_pago.Id_Metodo_Pago = ds_cat_metodo_pago.Id_Forma_Pago where ds_tbl_venta.Fecha_Venta >= '{$fecha_inicio_val_start}' and ds_tbl_venta.Fecha_Venta <= '{$fecha_final_val_end}' group by ds_tbl_venta_metodo_pago.Id_Metodo_Pago";
//echo $qry_hours;
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
<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="full/assets/css/components.min.css" rel="stylesheet" type="text/css">
<link href="full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="global_assets/js/main/jquery.min.js"></script>
<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>

<script src="full/assets/js/app.js"></script>
<script src="global_assets/js/demo_pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<script type="text/javascript">
$( document ).ready(function() {
     console.log( "ready!" );
    
});

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

<!-- Main navbar -->
<?php include "core_mainnav.php"; ?>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

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
function filtrar_marca(id){

var marcas = $("#marca").val();
var anio = $("#anio").val();

$.ajax({
             type: "POST",
             //url:"ajax_graph_hours.php",
             //url:"ajax_resultado_tipo_producto.php",
             url:"ajax_grafica_macro_reporte.php",
            
             //data: { id:id },
             data: { marcas:marcas, anio:anio },
            
             success:function(data){
             $("#grafica_reporte_marcas").html(data);
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
             //url:"ajax_grafica_reporte_tipo_productos.php",
             url:"ajax_grafica_macro_reporte.php",
             //data: { id_marca:id_marca, tipo_producto:tipo_producto, anio:anio },
             data: { tipo_producto:tipo_producto, anio:anio },
             success:function(data){
             $("#grafica_reporte_tipo_productos").html(data);
             }
             });
}


function filtrar_por(tipo_filtrado){
if(tipo_filtrado == 1){
ocultar_filtrados_generales();
obtener_grafica_filtrados();
$("#filtrado_marcas").fadeIn("slow");
}
if(tipo_filtrado == 2){
ocultar_filtrados_generales();
obtener_grafica_filtrados();
$("#filtrado_tipos_productos").fadeIn("slow");
}
if(tipo_filtrado == 3){
ocultar_filtrados_generales();
obtener_grafica_filtrados();
$("#filtrado_categorias_productos").fadeIn("slow");
}
if(tipo_filtrado == 4){
ocultar_filtrados_generales();
obtener_grafica_filtrados();
$("#filtrado_productos").fadeIn("slow");
}
}
function ocultar_filtrados_generales(){
filtrado_tipos_productos
$(".filtrado_productos").hide();

}
function obtener_grafica_filtrados(){
var filtrar_por = $("#filtrar_por").val();
var tipo_reporte = $("#tipo_reporte").val();


if(filtrar_por == ""){
alert("Selecciona que deseas filtrar");
$("#filtrar_por").focus();
}


$.ajax({
             type: "POST",
             url:"ajax_grafica_macro_reporte.php",
             data: { filtrar_por:filtrar_por, tipo_reporte:tipo_reporte },
             success:function(data){
             $("#grafica_macro_reporte").html(data);
             }
             });
}
function agregar_nuevo_filtrado_tipo_producto(){
$.ajax({
             type: "POST",
             url:"ajax_agregar_nuevo_filtrado_tipo_producto.php",
             //data: { filtrar_por:filtrar_por, tipo_reporte:tipo_reporte },
             success:function(data){
             $("#agregar_nuevo_filtrado_tipo_producto").append(data);
             }
             });
}
</script>
<div class="form-row">
                        <div class="form-group col-md-6">
                          <div>Filtrar por:</div>
                            
                            <select onchange="filtrar_por(this.value);" id="filtrar_por" class="form-control">
     <option value="">Selecciona</option>
     <option value="1">Marcas</option>
     <option value="2">Tipos de productos</option>
     <option value="3">Categorias de productos</option>
     <option value="4">Productos</option>
    
     </select>
                        </div>
                        <div class="form-group col-md-6">
                          <div>Tipo de reporte:</div>
                            
                            <select onchange="obtener_grafica_filtrados();" id="tipo_reporte" class="form-control">
     <option value="">Selecciona</option>
     <option value="1">Existencias</option>
     <option value="2">Costos y Precios</option>
     <option value="3">Costos</option>
     <option value="4">Precios</option>
    
     </select>
                        </div>
                    </div>
                    
                    
                    

<div style="display:none;" id="filtrado_marcas" class="filtrados_generales">


     <div class="form-row">
                            <div class="form-group col-md-6">
                              <div>A&ntilde;o:</div>
                                
                                <select onchange="filtrar_marca(this.value);" id="anio" class="form-control">
         <?php for($i = 2020; $i<=date("Y"); $i++): ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php endfor; ?>
         </select>
                            </div>
                        </div>
     <div class="form-row">
     <div class="form-group col-md-6">
                              <div>Filtro por marca:</div>
                                <?php 
         $qry_marca = "select * from ds_cat_marca order by Descripcion asc";
         $marcas = $obj->get_results($qry_marca);
         ?>
                                <select onchange="filtrar_marca(this.value);" id="marca" class="form-control" multiple>
         <option value="">Selecciona una marca</option>
        
         <?php foreach ($marcas as $marca): ?>
         <option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
         <?php endforeach; ?>
         </select>
                            </div>
                            <?php /**
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
                            */ ?>
                        </div>
                    </div>
                    <div style="display:none;" id="filtrado_tipos_productos" class="filtrados_generales">
<div class="form-row">
                            <div class="form-group col-md-6">
                              <div>A&ntilde;o:</div>
                                
                                <select onchange="" id="anio" class="form-control">
                                
         <?php for($i = 2020; $i<=date("Y"); $i++): ?>
         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
         <?php endfor; ?>
         </select>
                            </div>
                        </div>
     <div class="form-row">
     <div class="form-group col-md-6">
                              <div>Filtro por marca:</div>
                                <?php 
         $qry_marca = "select * from ds_cat_marca order by Descripcion asc";
         $marcas = $obj->get_results($qry_marca);
         ?>
                                <select onchange="obtener_tipo_producto(this.value)" id="" class="form-control">
         <option value="">Selecciona una marca</option>
        
         <?php foreach ($marcas as $marca): ?>
         <option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
         <?php endforeach; ?>
         </select>
                            </div>
                            <div class="form-group col-md-6">
                              <div>Filtro por marca:</div>
                                <?php 
         $qry_marca = "select * from ds_cat_marca order by Descripcion asc";
         $marcas = $obj->get_results($qry_marca);
         ?>
                                <select onchange="" id="" class="form-control">
         <option value="">Selecciona una marca</option>
        
         <?php foreach ($marcas as $marca): ?>
         <option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
         <?php endforeach; ?>
         </select>
                            </div>
                            <div id="agregar_nuevo_filtrado_tipo_producto">
                            
                            </div>
                            <div>
                             <button onclck="agregar_nuevo_filtrado_tipo_producto();">Agregar nuevo filtrado</button>
                            </div>
                            <?php /**
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
                            */ ?>
                        </div>
</div>
<div style="display:none;" id="filtrado_categorias_productos" class="filtrados_generales">

</div>
<div style="display:none;" id="filtrado_productos" class="filtrados_generales">

</div>
                    <div id="resultado_grafica">
                    
                    
                    
                    
                    </div>
                    <div id="grafica_macro_reporte">
                    
                    </div>
                    <div id="grafica_reporte_marcas">
                    
                    </div>
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