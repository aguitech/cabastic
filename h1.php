<?php 
include("includes/includes.php");
$saldo_inicial = 0;

//Aqui obtengo los valores del select de la base de datos
$qry_resultados_cuenta = "select * from Movimientos";
$resultados_cuenta = $obj->query($qry_resultados_cuenta);

//date( 't' ) obtiene la cantidad de días del mes actual
//$dias_mes = date( 't' );

//Lo hacemos dinamico
$fecha_buscar = "2009/06/01";
$date = new DateTime($fecha_buscar);
$dias_mes = $date->format('t');

//for($i = 0; $i<= $dias_mes; $i++){
foreach($resultados_cuenta as $resultado){
    $date = new DateTime($fecha_buscar);
    $string_fecha = $date->format('Y-M-d');
	if($string_fecha == $resultado->Mov_Fecha){
	    if($saldos_diarios[$string_fecha] != ""){
	        $nuevo_valor = $saldos_diarios[$string_fecha];
	        $saldos_diarios[$string_fecha] = $nuevo_valor;
	        
	        
	        if($resultado->Mov_Natura == "Abono"){
	            $nuevo_valor = $saldos_diarios[$string_fecha] + $resultado->Mov_Cantid;
	            $saldos_diarios[$string_fecha] = $nuevo_valor;
	        }elseif($resultado->Mov_Natura == "Cargo"){
	            $nuevo_valor = $saldos_diarios[$string_fecha] + $resultado->Mov_Cantid;
	            $saldos_diarios[$string_fecha] = $nuevo_valor;
	        }
	        
	        
        }else{
            
            if($resultado->Mov_Natura == "Abono"){
                $nuevo_valor = $resultado->Mov_Cantid;
                $saldos_diarios[$string_fecha] = $nuevo_valor;
            }elseif($resultado->Mov_Natura == "Cargo"){
                $nuevo_valor = $resultado->Mov_Cantid;
                $saldos_diarios[$string_fecha] = $nuevo_valor;
            }
            
        }
		
	}
}

$total_saldo = 0;
echo "<table>";
echo "<tr>";
echo "<th>Fecha</th>";
echo "<th>Saldo</th>";
echo "</tr>";
foreach($saldos_diarios as $fecha => $saldo){
    echo "<tr>";
    echo "<td>" . $fecha . "</td>";
    echo "<td>" . $saldo . "</td>";
    
    $nuevo_total = $total_saldo + $saldo;
    $total_saldo = $nuevo_total;
    
    echo "</tr>";
    
}
echo "<table>";

echo "Saldo total: " . $total_saldo;
echo "<br />";
echo "Promedio: " . ($total_saldo / $dias_mes);


?>