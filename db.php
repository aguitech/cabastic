<?php


 $DB_USER='cabastic_admin'; 
 $DB_PASS='4dm1n'; 
 $DB_HOST='localhost';
 $DB_NAME='cabastic_db';


 //$link = mysqli_connect('localhost', 'molcajet_admin', '4dm1n', 'molcajet_db');

 
extract($_POST);
extract($_GET); 


    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    /* check connection */
    if (mysqli_connect_errno())
                   {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
    }  
    $mysqli->query("SET NAMES 'utf8'");


?>