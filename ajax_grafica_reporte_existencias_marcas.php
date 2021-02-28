<?php
include("includes/includes.php");

//print_r($_POST);



$id_marca = $_POST["id_marca"];
$tipo_producto = $_POST["tipo_producto"];
$anio = $_POST["anio"];

$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

$count_marcas = count($_POST["marcas"]);

$qry_prefijo_marcas = "";
$inc_marca = 0;
foreach($_POST["marcas"] as $marca_val){
    $inc_marca++;
    //print_r($marca_val);
    //echo "<br />";
    if($inc_marca == $count_marcas){
        //$qry_prefijo_marcas .= " marca = {$marca_val} ";
        $qry_prefijo_marcas .= " ds_cat_marca.Id_Marca = {$marca_val} ";
        
    }else{
        //$qry_prefijo_marcas .= " marca = {$marca_val}, ";
        $qry_prefijo_marcas .= " ds_cat_marca.Id_Marca = {$marca_val} or ";
    }
}

//echo "<hr />" . $count_marcas;
//echo "<hr />" . $qry_prefijo_marcas;
//obj->get_row("select count(*) as conteo from ds_cat_tipo_producto where Id_Tipo_Producto = $tipo_producto");

//$qry_categorias_graph = "select * from ds_cat_tipo_producto where Id_Tipo_Producto = $tipo_producto";

/*
 $qry_categorias_graph = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $tipo_producto";
 $categorias_graph = $obj->get_results($qry_categorias_graph);
 */
$qry_categorias_graph = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $tipo_producto";
$categorias_graph = $obj->get_results($qry_categorias_graph);

//$qry_marcas_graph = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $tipo_producto";
//$qry_marcas_graph = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $tipo_producto";
$qry_marcas_graph = "select * from ds_cat_marca where $qry_prefijo_marcas";
$marcas_graph = $obj->get_results($qry_marcas_graph);

//echo $qry_marcas_graph;
//print_r($marcas_graph);
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes' <?php foreach($marcas_graph as $marca_val){ ?>, '<?php echo $marca_val->Descripcion; ?>'<?php } ?>],
          <?php $inc_mes = 0; ?>
          <?php foreach($meses as $mes_val): ?>
          <?php $inc_mes++; ?>
          <?php 
          //select * from ds_tbl_venta where month(Fecha_Venta) = 7   
          ?>
          ['<?php echo $mes_val; ?>'  <?php foreach($marcas_graph as $marca_val){ $id_marca_actual = $marca_val->Id_Marca; $qry_cantidad = "select *, sum(ds_tbl_venta_detalle.MontoVenta) as sumatoria from ds_tbl_venta left join ds_tbl_venta_detalle on ds_tbl_venta_detalle.Id_Venta = ds_tbl_venta.Id_Venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_cat_marca on ds_tbl_producto.Id_Marca = ds_cat_marca.Id_Marca where MONTH(ds_tbl_venta.Fecha_Venta) = $inc_mes and YEAR(ds_tbl_venta.Fecha_Venta) = $anio and ds_tbl_producto.Id_Marca = $id_marca_actual"; $res_val = $obj->get_row($qry_cantidad); ?>, <?php if($res_val->sumatoria != ""){ echo $res_val->sumatoria; }else{ echo 0; } ?><?php } ?>]<?php if($inc_mes != 12){ ?>,<?php } ?>
          <?php endforeach; ?>
          /*
          and ds_tbl_producto.Id_Marca = $id_marca
          
           $qry_cantidad = "select *, sum(ds_tbl_venta_detalle.Cantidad) as sumatoria from ds_tbl_venta left join ds_tbl_venta_detalle on ds_tbl_venta_detalle.Id_Venta = ds_tbl_venta.Id_Venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto left join ds_tbl_producto on ds_tbl_producto.Id_Marca = ds_cat_marca.Id_Marca where MONTH(ds_tbl_venta.Fecha_Venta) = $inc_mes and YEAR(ds_tbl_venta.Fecha_Venta) = $anio and ds_tbl_producto.Id_Categoria_Producto = {$id_categoria_actual} and ds_tbl_producto.Id_Marca = $id_marca"; $res_val = $obj->get_row($qry_cantidad); 

          $qry_cantidad = "select *, sum(ds_tbl_venta_detalle.Cantidad) as sumatoria from ds_tbl_venta left join ds_tbl_venta_detalle on ds_tbl_venta_detalle.Id_Venta = ds_tbl_venta.Id_Venta left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto_Detalle = ds_tbl_venta_detalle.Id_Producto_Detalle left join ds_tbl_producto on ds_tbl_producto.Id_Producto = ds_tbl_producto_detalle.Id_Producto where MONTH(ds_tbl_venta.Fecha_Venta) = $inc_mes and YEAR(ds_tbl_venta.Fecha_Venta) = $anio and ds_tbl_producto.Id_Categoria_Producto = {$id_categoria_actual}"; $res_val = $obj->get_row($qry_cantidad); ?>, 
          
          ['2007',  1500, 1030,      540, 1000, 1000,      400, 1000, 1000,      400, 5000, 1000,      1400, 1000, 1000,      400]
          */
        ]);

        var options = {
          title: 'Reporte tipo de productos',
          //curveType: 'function', ///DESCOMENTAR PARA HACERLA DE CURVAS EN LUGAR DE LINEAS
          legend: { position: 'bottom' },
          packages: ['corechart', 'line']
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

<div id="curve_chart" style="width: 900px; height: 500px"></div>


<?php /**
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>
      
      
      <script>
      oogle.charts.load('current', {packages: ['corechart', 'line']});
      google.charts.setOnLoadCallback(drawCrosshairs);

      function drawCrosshairs() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'X');
            data.addColumn('number', 'Dogs');
            data.addColumn('number', 'Cats');

            data.addRows([
              [0, 0, 0],    [1, 10, 5],   [2, 23, 15],  [3, 17, 9],   [4, 18, 10],  [5, 9, 5],
              [6, 11, 3],   [7, 27, 19],  [8, 33, 25],  [9, 40, 32],  [10, 32, 24], [11, 35, 27],
              [12, 30, 22], [13, 40, 32], [14, 42, 34], [15, 47, 39], [16, 44, 36], [17, 48, 40],
              [18, 52, 44], [19, 54, 46], [20, 42, 34], [21, 55, 47], [22, 56, 48], [23, 57, 49],
              [24, 60, 52], [25, 50, 42], [26, 52, 44], [27, 51, 43], [28, 49, 41], [29, 53, 45],
              [30, 55, 47], [31, 60, 52], [32, 61, 53], [33, 59, 51], [34, 62, 54], [35, 65, 57],
              [36, 62, 54], [37, 58, 50], [38, 55, 47], [39, 61, 53], [40, 64, 56], [41, 65, 57],
              [42, 63, 55], [43, 66, 58], [44, 67, 59], [45, 69, 61], [46, 69, 61], [47, 70, 62],
              [48, 72, 64], [49, 68, 60], [50, 66, 58], [51, 65, 57], [52, 67, 59], [53, 70, 62],
              [54, 71, 63], [55, 72, 64], [56, 73, 65], [57, 75, 67], [58, 70, 62], [59, 68, 60],
              [60, 64, 56], [61, 60, 52], [62, 65, 57], [63, 67, 59], [64, 68, 60], [65, 69, 61],
              [66, 70, 62], [67, 72, 64], [68, 75, 67], [69, 80, 72]
            ]);

            var options = {
              hAxis: {
                title: 'Time'
              },
              vAxis: {
                title: 'Popularity'
              },
              colors: ['#a52714', '#097138'],
              crosshair: {
                color: '#000',
                trigger: 'selection'
              }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
            chart.setSelection([{row: 38, column: 1}]);

          }
      </script>
      */ ?>
          
          
          