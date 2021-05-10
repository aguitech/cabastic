<?php //include("correo_existencias.php?existencias_actual=10&existencias_nuevas=8&id_producto=10"); ?>
<?php 


// Crear un nuevo recurso cURL
$ch = curl_init();

// Establecer URL y otras opciones apropiadas
curl_setopt($ch, CURLOPT_URL, "http://cabastic.info/correo_existencias.php?existencias_actual=10&existencias_nuevas=8&id_producto=10&usuario=Hector");
curl_setopt($ch, CURLOPT_HEADER, 0);

// Capturar la URL y pasarla al navegador
curl_exec($ch);

// Cerrar el recurso cURL y liberar recursos del sistema
curl_close($ch);
?>
