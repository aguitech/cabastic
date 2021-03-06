<?php
/*** Code create by Hector Aguilar [hector@10me.net] ***/

//Obtener info del server
$_SERVER["QUERY_STRING"];

$obt_name = explode("=", $_SERVER["QUERY_STRING"]);
$name_url = str_replace("/", "", $obt_name[1]);

//meses en letra en espaniol (default)
$mounth_letter = array(1=>"Enero", 2=>"Febrero", 3=>"Marzo", 4=>"Abril", 5=>"Mayo", 6=>"Junio", 7=>"Julio", 8=>"Agosto", 9=>"Septiembre", 10=>"Octubre", 11=>"Noviembre", 12=>"Diciembre");
$mounth_letter_english = array(1=>"January", 2=>"February", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"Octuber", 11=>"November", 12=>"December");
$mounth_letter_permalink = array(1=>"january", 2=>"february", 3=>"march", 4=>"april", 5=>"may", 6=>"june", 7=>"july", 8=>"august", 9=>"september", 10=>"octuber", 11=>"november", 12=>"december");

$posicion_letter = array(1=>"Portero", 2=>"Defensa", 3=>"Medio", 4=>"Delantero");
//DOMAIN
$domain_url = "http://chokococo.com/";
$domainurl = "chokococo.com";
$developer = "Chokococo M&eacute;xico";
$contactemail = "info@chokococo.com";
$projectname = "Chokococo by Hector Aguilar";
$projectdescription = "Chokococo | La Era del Chokolate | Comunidad Virtual";
$projectkeywords = "Chokococo, Hector Aguilar, La Era del Chokolate, Ciudad de Mexico, Comunidad Virtual, Red Social";
/*
<title><?php echo $domainurl . " | "; ?><?php echo $projectname . " | "; ?><?php echo $contactemail . " | "; ?><?php echo $developer; ?> by Héctor Aguilar</title>
*/
$projecttitle = "Chokococo.com - Red Virtual, Comunidad Virtual y BlogSite";
//$mundial_url = "mundial2010/";
$project_url = "";
$project_doc = "10me";
$project_file = "10me";
//$project_doc = "mundial2010";

$project_headers = "common_files/{$project_doc}_headers.php";
$project_header = "common_files/{$project_doc}_header.php";
$project_footer = "common_files/{$project_doc}_footer.php";
$project_session = "common_files/{$project_doc}_session.php";

/*
$project_headers = "common_files/headers_{$project_doc}.php";
$project_header = "common_files/header_{$project_doc}.php";
$project_footer = "common_files/footer_{$project_doc}.php";
*/
$generalheader = "common_files/generalheader.php";
$generalfooter = "common_files/generalfooter.php";
//$proyecto = "mundial2010";


function compartir_con_redes($url, $titulo){
	$compartir = 
	'<div style="padding:3px 0;">
		<b style="margin-right:3px; letter-spacing:-1px; font-size:14px;">COMPARTIR CON</b>
		<a href="http://www.facebook.com/sharer.php?u=' . $url . '&amp;t=' . $titulo . '" title="Compartir con Facebook">
			<img src="http://chokococo.com/images/redes/facebook.gif" alt="Agregar a Facebook" border="0">
		</a>
		<a href="http://twitter.com/home?status=Add+this:' . $url . '&amp;title=' . $titulo . '" title="Compartir con Twitter">
			<img src="http://chokococo.com/images/redes/twitter.gif" alt="Agregar a Twitter" border="0">
		</a>
		<a href="https://favorites.live.com/quickadd.aspx?marklet=1&amp;url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Live">
			<img src="http://chokococo.com/images/redes/live.gif" alt="Agregar a Live" border="0"">
		</a>
		<a href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Google Bookmarks">
			<img src="http://chokococo.com/images/redes/googlebookmarks.gif" alt="Agregar a Google Bookmarks" border="0">
		</a>
		<a href="http://www.reddit.com/submit?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Reddit">
			<img src="http://chokococo.com/images/redes/reddit.gif" alt="Agregar a Reddit" border="0">
		</a>
		<a href="http://digg.com/submit/?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Digg">
			<img src="http://chokococo.com/images/redes/digg.gif" alt="Agregar a Digg" border="0">
		</a>
		<a href="http://delicious.com/save?jump=yes&amp;noui&amp;v=4&amp;url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Delicious">
			<img src="http://chokococo.com/images/redes/delicious.gif" alt="Agregar a Delicious" border="0">
		</a>
		<a href="http://slashdot.org/bookmark.pl?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Slashdot">
			<img src="http://chokococo.com/images/redes/slashdot.gif" alt="Agregar a Slashdot" border="0">
		</a>
		<a href="http://www.spurl.net/spurl.php?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Spurl">
			<img src="http://chokococo.com/images/redes/spurl.gif" alt="Agregar a Spurl" border="0">
		</a>
		<a href="http://www.furl.net/savedialog.jsp?p=1&amp;u=' . $url . '&amp;t=' . $titulo . '" title="Compartir con Furl">
			<img src="http://chokococo.com/images/redes/furl.gif" alt="Agregar a Furl" border="0">
		</a>
		<a href="http://www.stumbleupon.com/submit?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con StumbleUpon">
			<img src="http://chokococo.com/images/redes/stumbleupon.gif" alt="Agregar a StumbleUpon" border="0">
		</a>
		<a href="http://technorati.com/faves/?add=' . $url . '&amp;title=' . $titulo . '" title="Compartir con Terchnorati">
			<img src="http://chokococo.com/images/redes/technorati.gif" alt="Agregar a Terchnorati" border="0">
		</a>
		<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=' . $url . '&amp;t=' . $titulo . '" title="Compartir con MySpace">
			<img src="http://chokococo.com/images/redes/myspace.gif" alt="Agregar a MySpace" border="0">
		</a>
		<a href="http://favorites.my.aol.com/ffclient/webroot/0.4.5/src/html/addBookmarkDialog.html?url=' . $url . '&amp;title=' . $titulo . '" title="Compartir con MyAOL">
			<img src="http://chokococo.com/images/redes/myaol.gif" alt="Agregar a MyAOL" border="0">
		</a>
		<a href="javascript:agregar_favorito(\'' . $url . '\', \'' . $titulo . '\');">Agregar a favoritos</a>
		
	</div>
	<div style="clear:both;"></div>';
	return $compartir;
}
/*
<a href=\'javascript:window.external.AddFavorite("' . $url . '","' . $titulo . '");\'>
	<img src="http://www.autoswifi.com.ar/images/icons/star.png" alt="Agregar a Favoritos" border="0" />		
</a>

<a href="javascript:window.external.AddFavorite(\'http://www.misitio.com\',\'Titulo del sitio\');">Agregar a favoritos</a>

 * */

function reemplazar_comillas($string){
	$string = str_replace ("'", "\"", $string);
	$string = str_replace ('"', '\"', $string);
	$string = str_replace ("\'", "\"", $string);
	$string = str_replace ('\"', '\"', $string);
	
	return $string;
}
function reemplazar_comillas_arreglo($arreglo){
	foreach($arreglo as $key => $a){
		$regreso[$key] = Constantes::reemplazar_comillas($a);
	}
	return $regreso;
}
/** Funcion de Clase
public static function reemplazar_comillas_arreglo($arreglo){
	foreach($arreglo as $key => $a){
		$regreso[$key] = Constantes::reemplazar_comillas($a);
	}
	return $regreso;
}
 * */
/*
<script>
function agregar_favorito(url, titulo){
	//var url="http://www.chokococo.com.com/"; //Cambia esta dirección por la de tu web
	//var titulo="Una web con sentido"; //Cambia esta nombre por el de tu web
	//IE
	if ((navigator.appName=="Microsoft Internet Explorer") && (parseInt(navigator.appVersion)>=4)) {
		//var url="http://www.chokococo.com.com/"; //Cambia esta dirección por la de tu web
		//var titulo="Una web con sentido"; //Cambia esta nombre por el de tu web
		//var url="http://www.chokococo.com.com/"; //Cambia esta dirección por la de tu web
		//var titulo="Una web con sentido"; //Cambia esta nombre por el de tu web
		window.external.AddFavorite(url,titulo);
	}
	//Para Firefox
	else {
	if(navigator.appName == "Netscape")
	//Hay que modificar el nombre por el de vuestra pagina
		//var url="http://www.chokococo.com.com/"; //Cambia esta dirección por la de tu web
		//var titulo="Una web con sentido"; //Cambia esta nombre por el de tu web
	
		//window.sidebar.addPanel("Una web con sentido", "http://chokococo.com","");
		window.sidebar.addPanel(titulo, url,"");
	}
}
</script>
*/
 ?>
