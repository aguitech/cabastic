<?php
function levels($parent){
	$pages = split("/",$_SERVER['PHP_SELF']);
	
	$count = 0;
	$flag = false;
	
	foreach($pages as $page){
		if($page == $parent)
			$flag = true;
	
		if($flag)
			$count++;
	}
	$count--;
	
	switch ($count){
		case 1:
			$path = "./";
			break;
		case 2:
			$path = "../";
			break;
			
		default:
			$count--;
			
			for($x=1;$x<=$count;$x++){
				$path .= "../";
			}
			break;
	}
	
	return $path;
}

$path_level = ".";
$pages = split("/",$_SERVER['PHP_SELF']);

$folder = $pages[count($pages)-2];
$page = $pages[count($pages)-1];

if($folder == "admin" || $folder == "scripts")
	$path_level = "..";

header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'en_US.UTF8');

$global["folder"] = $folder;
$global["page"] = $page;
$global["path"] = levels(PATH);

require("$path_level/config/config_basic.php");
require("$path_level/config/config_general.php");
require("$path_level/config/config_mail.php");
require("./config/config_session.php");
require("$path_level/code_behind/config.php");

require("$path_level/includes/functions.php");
require("$path_level/classes/core/class.sql.php");
require("$path_level/classes/core/class.db.php");

requireFiles($path_level,"/classes");
require("$path_level/classes/optional/emailing/class.smtp.php");
require("$path_level/classes/optional/excel/excelreader.php");
requireFiles($path_level,"/classes/optional");
requireFiles($path_level,"/classes/beta");

require("$path_level/includes/aguitech.php");

if($sesion["enabled"])
	$session = new session($sesion,$global);

if(file_exists("./code_behind/$page"))
	require("./code_behind/$page");
	
require("$path_level/includes/global.php");
require("$path_level/includes/vars.php");
//require("$path_level/includes/aguitech.php");