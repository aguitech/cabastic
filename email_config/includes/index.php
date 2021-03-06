<?php if($_GET["hector"] == "true"): ?>

<h3>Listado de Archivos</h3>
<?php 
function listar_directorios_ruta($ruta){
   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
            //mostraría tanto archivos como directorios
            //echo "<br>Archivo: <a href='" . $ruta . $file . "'>$file</a> : Es un: " . filetype($ruta . $file);
            echo "<br>Archivo: <a href='" . $ruta . $file . "'>$file</a> : " . filetype($ruta . $file);
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               //solo si el archivo es un directorio, distinto que "." y ".."
               echo "<br>Directorio: <a href='" . $ruta . $file . "'>$ruta$file</a>";
               listar_directorios_ruta($ruta . $file . "/");
            }
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
}
listar_directorios_ruta("./");
?>

<?php endif; ?>

<?php //Original Code 
/*
function listar_directorios_ruta($ruta){
   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
            //mostraría tanto archivos como directorios
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               //solo si el archivo es un directorio, distinto que "." y ".."
               echo "<br>Directorio: <a href='" . $ruta . $file . "'>$ruta$file</a>";
               listar_directorios_ruta($ruta . $file . "/");
            }
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
}
listar_directorios_ruta("./");
 */

?>