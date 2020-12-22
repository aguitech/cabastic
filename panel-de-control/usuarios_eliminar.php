<?php
//session_start();
 include_once("login.php");
 ?>
 <?php
 include_once("db.php");
 ?>


 <?php 


					$qt = "
								DELETE FROM `intranet_usuario` WHERE `intranet_usuario`.`id_usuario` = '$id'


					";
					echo $qt;
					$resultt = $mysqli->query($qt);



 ?>