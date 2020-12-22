<?php
//session_start();
 include_once("login.php");
 ?>
 <?php
 include_once("db.php");
 ?>


 <?php 


					$qt = "
								DELETE FROM `intranet_notificaciones` WHERE `intranet_notificaciones`.`id_notificacion` = '$id'


					";
					echo $qt;
					$resultt = $mysqli->query($qt);



 ?>