<?php
//
//session vars configuration (optional)
//
$sesion["enabled"] = false; //enable or disable session use
$sesion["logintable"] = "usuario"; //table to use to validate user logins

$sesion["page"]["index"] = "listar.php?table=usuario"; //send users on login sucessfully
$sesion["page"]["login"] = "index.php"; //send users on login failed or user not logued

$sesion["restrictedfolder"][] = "";

$sesion["restrictedpage"][] = "";

$sesion["logged"] = "main";

$sesion["customvar"][] = "es_admin2";
$sesion["customvar"][] = "id_areaa";
?>