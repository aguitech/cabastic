<?php 
function generarCSV($arreglo, $ruta, $delimitador, $encapsulador){
    $file_handle = fopen($ruta, 'w');
    foreach ($arreglo as $linea) {
        fputcsv($file_handle, $linea, $delimitador, $encapsulador);
    }
    rewind($file_handle);
    fclose($file_handle);
}

$arreglo[0] = array("Nombre","Apellido","Animal","Fruto");
$arreglo[1] = array("Juan","Juarez","Jirafa","Jicama");
$arreglo[2] = array("Maria","Martinez","Mono","Mandarina");
$arreglo[3] = array("Esperanza","Escobedo","Elefante","Elote");
//$ruta ="C:/mi_archivo.csv";
$ruta ="./archivo.csv";
generarCSV($arreglo, $ruta, $delimitador = ';', $encapsulador = '"');




?>