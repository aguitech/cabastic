<?php
function generarCSV($arreglo, $ruta, $delimitador, $encapsulador){
    $file_handle = fopen($ruta, 'w');
    foreach ($arreglo as $linea) {
        fputcsv($file_handle, $linea, $delimitador, $encapsulador);
    }
    rewind($file_handle);
    fclose($file_handle);
}

$arreglo[0] = array("aNombre","bApellido","cAnimal","dFruto");
$arreglo[1] = array("aJuan","Juarez","Jirafa","Jicama");
$arreglo[2] = array("bMaria","Martinez","Mono","Mandarina");
$arreglo[3] = array("cEsperanza","Escobedo","Elefante","Elote");
//$ruta ="C:/mi_archivo.csv";
$ruta ="./archivo.csv";
generarCSV($arreglo, $ruta, $delimitador = ';', $encapsulador = '"');


?>