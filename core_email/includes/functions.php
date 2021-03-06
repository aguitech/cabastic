<?php
function validaEmail ($email)
{
    $exp_reg =  "^[[:alnum:]_-]+"; // equivale a "^[a-z0-9_-]+"
    $exp_reg .= "(\.[[:alnum:]_-]+){0,}"; // equivale a "(\.[a-z0-9_-]+){0,}"
    $exp_reg .= "@";
    $exp_reg .= "[[:alnum:]_-]+"; // equivale a "[a-z0-9_-]+"
    $exp_reg .= "(\.[[:alnum:]_-]+){0,}"; // equivale a "(\.[a-z0-9_-]+){0,}"
    $exp_reg .= "(\.[[:alpha:]]{2,3})$"; // equivale a "(\.[a-z]{2,3})$"

    if ( ereg ( $exp_reg , $email ) )
    {
        return true;
    }
    else
    {
        return false;
    }
}


/**
* Extrae los emails contenidos en una cadena de texto.
* @param string $text //cadena de texto a extraerle los emails.
* @return Mixed - null en caso de error, array $emails en caso de contener emails.
*/
function extract_emails($text) {
	$res = preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $text, $matches);

	if ($res) {
		foreach(array_unique($matches[0]) as $email) {
			$emails[] = $email;
		}
	}
	else
		return null;
		
	return $emails;
}

function no_cache(){
	header("Expires: Mon, 20 Mar 1998 12:01:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

function validField($value, $type){
	$value = trim($value);
	
	switch($type){
		case (!(strpos($type, "int") === false) || !(strpos($type, "double") === false)):
			if(!is_numeric($value))
				$result = null;
			else 
				$result = $value;
			break;
		case (!(strpos($type, "varchar") === false) || !(strpos($type, "text") === false)):
			if(empty($value))
				$result = null;
			else 
				$result = $value;
			break;
		case "date":
			if(empty($value))
				$result = null;
			else 
				$result = $value;			
			break;
	}
	
	return $result;
}

/**
 * Valida una serie de datos contenidos en un array.
 *
 * @param array() $fields
 * @param string $type => int, string
 * @return boolean
 */
function validFields($fields, $type = "int"){
	foreach($fields as $value){
		switch($type){
			case (!(strpos($type, "int") === false)):
				if(!is_numeric($value))
					$result = false;
				else 
					$result = true;
				break;
			case (!(strpos($type, "varchar") === false) || !(strpos($type, "text") === false)):
				if(empty($value))
					$result = false;
				else 
					$result = true;
				break;
		}
		
		if(!$result)
			break;
	}
	
	return $result;
}

function selected($id_selected, $id_tocheck, $type = "selected", $default=false){
	if($id_selected == $id_tocheck){
		return $type;
	}
	else {
		if($default && !isset($_GET["action"])){
			return $type;
		}
		else
			return;
	}
}

function requireFiles($path_level,$path){
	if ($handle = opendir($path_level.$path)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(!is_dir($path.$file)) {
					$ext = substr(strtolower($file),-3);
					if($ext == 'php') require("$path_level/$path/$file");
				}
			}
		}
		closedir($handle);
	}
}

function splitstring($str, $len = 145, $chr = " "){
	$arrayTexto = explode($chr,$str);
	$str = ''; 

	for($x = 0; $x < count($arrayTexto); $x++){
		if((strlen($str) + strlen($arrayTexto[$x])) > $len)
			break;
		if($x==0)
			$str .= $arrayTexto[$x];
		else
			$str .= $chr.$arrayTexto[$x];
	}
	return $str;
}

function ae_gen_password($silabas= 3, $use_prefix = false)
{
	
	// Definimos la función a menos de que esta exista
	if (!function_exists('ae_arr'))
	{
	// Esta función devuleve un elemento aleatorio
	function ae_arr(&$arr)
	{
	return $arr[rand(0, sizeof($arr)-1)];
	}
	}
	
	// Prefijos
	$prefix = array('aero', 'anti', 'auto', 'bi', 'bio',
	'cine', 'deca', 'demo', 'contra', 'eco',
	'ergo', 'geo', 'hipo', 'cent', 'kilo',
	'mega', 'tera', 'mini', 'nano', 'duo');
	
	// Sufijos
	$suffix = array('on', 'ion', 'ancia', 'sion', 'ia',
	'dor', 'tor', 'sor', 'cion', 'acia');
	
	// Sonidos
	$vowels = array('a', 'o', 'e', 'i', 'u', 'ia', 'eo');
	
	// Consonantes
	$consonants = array('r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j',
	'k', 'l', 'z', 'c', 'v', 'b', 'n', 'm', 'qu');
	
	$password = $use_prefix?ae_arr($prefix):'';
	$password_suffix = ae_arr($suffix);
	
	for($i=0; $i<$silabas; $i++)
	{
	// Selecciona una consonante al azar
	$doubles = array('c', 'l', 'r');
	$c = ae_arr($consonants);
	if (in_array($c, $doubles)&&($i!=0)) {
	if (rand(0, 4) == 1) // 20% de probabiidad
	$c .= $c;
	}
	$password .= $c;
	//
	
	// Seleccionamos un sonido al azar
	$password .= ae_arr($vowels);
	
	if ($i == $silabas - 1) // Si el sufijo empieza con vocal
	if (in_array($password_suffix[0], $vowels)) // Añadimos una consonante
	$password .= ae_arr($consonants);
	
	}
	
	// Seleccionamos un sufijo aleatorio
	$password .= $password_suffix;
	
	return $password;
}

function get_folio(){
	$result = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
	return $result;
}

function redirect($relativePath){
	header("Location: $relativePath");
	exit();
}

function jquery(){
	echo "<script src='./js/jquery.js' type='text/javascript' language='javascript'></script>";
}

function jqueryvalidation($path){
	echo "<script src='$path"."js/tools/josiris.js' type='text/javascript' language='javascript'></script>";
}

function tinyMce($path){
	echo "<script src='$path"."js/tools/tiny_mce/tiny_mce.js' type='text/javascript' language='javascript'></script>\n";
	echo "<script language='javascript' type='text/javascript'>\n";
	echo "tinyMCE.init({\n";
	echo "mode : 'textareas',\n";
	echo "theme_advanced_buttons3 : 'hr,removeformat,visualaid,separator,sub,sup,separator,charmap,forecolor,backcolor',\n";
	echo "theme_advanced_disable : 'image'\n";
	echo "});\n";
	echo "</script>";
}

function formsubmit($obj, $_fields = null){
	$mainTable = new $obj();
	$update = array();
	
	if(isset($_GET['id']) && is_numeric($_GET['id']))
		$id = $_GET['id'];
	else 
		$id = null;
	
	if(isset($_GET['action']))
		$action = $_GET['action'];
	else 
		$action = null;
		
	if(isset($action)){
		switch ($action){
			case (isset($_POST["submit"]) && $action == "add"):
				$fields = $mainTable->postArray();
				if(!empty($_fields)){
					foreach($_fields as $key=>$value)
						$fields[$key] = $value;
				}

				foreach($mainTable->form_type_field as $key=>$value){
					switch ($value) {
						case "date":
							$_date = explode("/",$fields[$key]);
							$fields[$key] = $_date[2].$_date[1].$_date[0];
							break;
						case ($value == "checkbox" || $value == "multiple"):
							unset($fields[$key]);
							break;
						case "function":
							$_class = get_class($mainTable);
							$_class = new $_class();
							$tmparr = $_class->function_field_value[$key];
							$fields[$key] = call_user_func_array($tmparr[0],$tmparr[1]);
							break;
						case ($value == "file" || $value == "image"):
							$fields[$key] = upload_file($_FILES[$key],"../../archivos",false);
							if(isset($_POST[$key]))
								$fields[$key] = " ";
							break;
						case "multiplefile":
							$_class = get_class($mainTable);
							$_class = new $_class();
							$multiple = $_GET["multiple"];
							$id_multiple = $_GET["id_".$multiple];

							$_fields["id_".$multiple] = $id_multiple;
							foreach($_FILES as $file=>$value){
								$_file = upload_file($_FILES[$file], "../../archivos");
								upload_file($_FILES[$file], "../archivos");
								if(empty($_file))
									continue;
								
								$_fields[$key] = $_file;
								$_class->add($_fields);
							}
							$disable_add = true;
							break;
						case (!(strpos($value, "thumbnail") === false)):
							$tmp_array = explode("&",$type);
							$fields[$key] = upload_thumb($_FILES[$key],"../../archivos", $tmp_array[1]);
							break;
						default:
							
							break;
					}
				}

				if(!isset($disable_add)){
					$res = $mainTable->add($fields);
					if($res === 0)
						return array("error",$mainTable->error_info);
				}
					
				foreach($mainTable->form_type_field as $key=>$value){
					switch ($value) {
						case ($value == "checkbox" || $value == "multiple"):
							$arr = $_POST[$key];
							$_curtable = get_parent_class($mainTable);
							if($_curtable == "db")
								$_curtable = get_class($mainTable);
							$_reftable = str_replace("id_","",$key);
							$_table =  $_curtable . "_" . $_reftable;
							$id = $mainTable->get_lastid();
							
							$query = "delete from $_table where id_$_curtable = $id";
							$mainTable->query($query);
							
							foreach($arr as $_arr){
								$query = "insert into $_table(id_$_curtable, id_$_reftable) values($id, $_arr)";
								$mainTable->query($query);
							}
							break;
						default:
							
							break;
					}
				}
				
				break;
			case ($action == "delete" && !empty($id)):
				$mainTable->drop($id);
				break;
			case ($action == "edit" && !empty($id)):
				$update = $mainTable->updateArray($id);
				break;
			case (isset($_POST["submit"]) && $action == "update" && !empty($id)):
				$fields = $mainTable->postArray();
				if(!empty($_fields)){
					foreach($_fields as $key=>$value){
						$fields[$key] = $value;
					}
				}
				
				foreach($mainTable->form_type_field as $key=>$value){
					switch ($value) {
						case "date":
							$_date = explode("/",$fields[$key]);
							$fields[$key] = $_date[2].$_date[1].$_date[0];
							break;
						case ($value == "checkbox" || $value == "multiple"):
							$arr = $_POST[$key];
							$_curtable = get_parent_class($mainTable);
							if($_curtable == "db")
								$_curtable = get_class($mainTable);
							$_reftable = str_replace("id_","",$key);
							$_table =  $_curtable . "_" . $_reftable;
							
							$query = "delete from $_table where id_$_curtable = $id";
							$mainTable->query($query);
							
							foreach($arr as $_arr){
								$query = "insert into $_table(id_$_curtable, id_$_reftable) values($id, $_arr)";
								$mainTable->query($query);
							}
							break;
						case ($value == "file" || $value == "image"):
							$fields[$key] = upload_file($_FILES[$key],"../../archivos");
							if(isset($_POST[$key]))
								$fields[$key] = " ";
							break;
						case (!(strpos($value, "thumbnail") === false)):
							$tmp_array = explode("&",$type);
							$fields[$key] = upload_thumb($_FILES[$key],"../../archivos", $tmp_array[1]);
							break;
						default:
							
							break;
					}
				}
				
				$mainTable->update($id, $fields);
				$update = $mainTable->updateArray($id);
				break;
		}
	}
	
	if(isset($_GET["parentmultiple"]) && isset($_GET["parentid"]) && isset($_GET["redirect"])){
		$parentmultiple = $_GET["parentmultiple"];
		$parentid = $_GET["parentid"];

		header("Location: editar.php?action=edit&table=$parentmultiple&id=$parentid");
		exit;
	}
	
	return $update;
}

function formvalues($page, $update){
	if(isset($_GET['action']))
		$action = $_GET['action'];
	else 
		$action = "add";
	
	if(!empty($update) && isset($_GET["id"]) && is_numeric($_GET["id"]))
		$action = "update&id=".$_GET["id"];
		
	if($page != "editar.php")
		return "name='form' action='$page?action=$action' method='post' enctype='multipart/form-data'";
	else {
		$table = $_GET['table'];
		return "name='form' action='$page?" . querystring("table=$table&action=$action") . "' method='post' enctype='multipart/form-data'";
	}
}

function alertMsg($global, $obj = null){
	$table = $_GET["table"];
	$msg = ""; $tmpo = $obj;
	if(!empty($obj)  && isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == "add"){
			if(class_exists($obj)){
				$o = new $obj();
				$c = get_parent_class($o);
				if($c == "db")
					$c = $obj;
					
				if(!empty($o->translate[$obj]))
					$obj = $o->translate[$obj];
				else 
					$obj = $c;
			}
			if(!in_array($tmpo,$global["filter"])){
				$tmpglobal = $global["add_item"];
				if(substr($obj,strlen($obj) - 1) == "s")
					$tmpglobal = substr($obj,0,strlen($obj) - 1);
				else 
					$tmpglobal = $obj;
				
				$msg = ucfirst($tmpglobal) . " " . $global["add_item"];
			}
			else {
				$tmpglobal = $global["add_item"];
				if(substr($obj,strlen($obj) - 1) == "s")
					$tmpglobal = substr($obj,0,strlen($obj) - 1);
				else 
					$tmpglobal = $obj;
					
				$msg = ucfirst($tmpglobal) . " " . $global["alternative"]["add_item"];
			}
		}
		elseif ($action == "update"){
			if(class_exists($obj)){
				$o = new $obj();
				$c = get_parent_class($o);
				if($c == "db")
					$c = $obj;
					
				if(!empty($o->translate[$obj]))
					$obj = $o->translate[$obj];
				else 
					$obj = $c;
			}
			if(!in_array($tmpo,$global["filter"])){
				$tmpglobal = $global["add_item"];
				if(substr($obj,strlen($obj) - 1) == "s")
					$tmpglobal = substr($obj,0,strlen($obj) - 1);
				else 
					$tmpglobal = $obj;
					
				$msg = ucfirst($tmpglobal) . " " . $global["update_item"];
			}
			else{
				if(substr($obj,strlen($obj) - 1) == "s")
					$tmpglobal = substr($obj,0,strlen($obj) - 1);
				else 
					$tmpglobal = $obj;
					
				$msg = ucfirst($tmpglobal) . " " . $global["alternative"]["update_item"];
			}
		}
	}
	else
		$msg = $global;

	if(isset($_POST["submit"])){
			return "onLoad=\"alert('$msg.');location.href='listar.php?table={$table}'\"";
	}
}

function emailSend($subject, $body, $email) {
	$mail = new PHPMailer();

	$mail->SMTPAuth = "true";
	$mail->From     = EMAIL_FROM;
	$mail->FromName = EMAIL_FROM_NAME;
	$mail->Host     = EMAIL_HOST;
	
	$mail->Mailer   = MAILER;
	$mail->Username = EMAIL_LOGIN_USER;
	$mail->Password = EMAIL_LOGIN_PASSWORD; 

	$mail->Subject	= $subject;
	$mail->isHTML(true);
	$mail->CharSet = "UTF-8";

    $mail->Body = $body;
	if(validaEmail($email)){
		    $mail->AddAddress($email);
		    $status_envio = $mail->Send();
		    $mail->ClearAddresses();
	}
}

function emailMassSend($subject, $body, $emails) {
	$mail = new PHPMailer();
	$mail->From     = EMAIL_FROM;
	$mail->FromName = EMAIL_FROM_NAME;
	$mail->Host     = EMAIL_HOST;
	$mail->Mailer   = MAILER;
	$mail->SMTPAuth = "true";
	$mail->Username = EMAIL_LOGIN_USER;
	$mail->Password = EMAIL_LOGIN_PASSWORD; 
	$mail->Subject	= $subject;
	$mail->isHTML(true);
	$mail->CharSet = "UTF-8";

    $mail->Body = $body;
	
	$count = 0;
	
	foreach ($emails as $email) {
	    $mail->AddAddress($email);
		if(validaEmail($email))
			$status_envio = $mail->Send();
	    $mail->ClearAddresses();
	    echo $mail->ErrorInfo;
	    $count++;
	}
}

function printpdf2($html, $archivo){
	$pdf = new HTML2FPDF2();
	
	$pdf->DisplayPreferences('HideWindowUI');
	$pdf->AddPage();
	$pdf->UseCSS($opt==true);
	$pdf->WriteHTML($html);
	$pdf->ReadCSS($html); 
	$pdf->Output($archivo . '.pdf','I');
}

function printpdf($html, $archivo){
	try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es');
        //$html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(15, 5, 15, 5));
        //$html2pdf->setModeDebug();
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($html, isset($_GET['vuehtml']));
        $html2pdf->Output($archivo);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
    	exit;
    }
}

function querystring($filtro = null){
	if(!empty($filtro)){
		$filtro = explode("&",$filtro);
		$array = $filtro;
		
		foreach($array as $_arr){
			$tmp_array = explode("=",$_arr);
			$qrystr[$tmp_array[0]] = $tmp_array[1];
		}
	}
	
	$query_string = "";
	if(!empty($_SERVER["QUERY_STRING"]))
		foreach($_GET as $key => $value)
			if(!key_exists($key, $qrystr))
				$qrystr[$key] = $value;

	if(!empty($qrystr))
		foreach($qrystr as $key => $value)
			$query_string .= $key."=".$value."&";
	
	$query_string = substr($query_string,0,strlen($query_string) - 1);
	return $query_string;
}

function curpage(){
	$page = $_SERVER["REQUEST_URI"];
	$page = str_replace("/","", $page);
	return $page;
}

function isUTF8($string)
{
    if (is_array($string))
    {
        $enc = implode('', $string);
        return @!((ord($enc[0]) != 239) && (ord($enc[1]) != 187) && (ord($enc[2]) != 191));
    }
    else
    {
        return (utf8_encode(utf8_decode($string)) == $string);
    }   
}

function sortArrayByField($original,$field,$descending = false){
    $sortArr = array();
   
    foreach ( $original as $key => $value )
    {
        $sortArr[ $key ] = $value[ $field ];
    }

    if ( $descending )
    {
        arsort( $sortArr );
    }
    else
    {
        asort( $sortArr );
    }
   
    $resultArr = array();
    foreach ( $sortArr as $key => $value )
    {
        $resultArr[ $key ] = $original[ $key ];
    }

    return $resultArr;
} 

function array_insertElement($keyflag, $key, $value, $arr){
	$_arr = array();
	
	foreach($arr as $x=>$y){
		$_arr[$x] = $y;
		
		if($x==$keyflag)
			$_arr[$key] = $value;		
	}
	
	return $_arr;
}

function array_removeElement($value, $arr){
	$_arr = array();

	foreach($arr as $_value){
		if($_value != $value)
			$_arr[] = $_value;
	}
	
	return $_arr;
}

function DownloadFile($file) { // $file = include path
    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

function getNums($a, $b){
	for($x = $a; $x <= $b; $x++){
		$arr[] = $x;
	}
	
	return $arr;
}

function getMonth($mes){
	$res[] = "Ene";
	$res[] = "Feb";
	$res[] = "Mar";
	$res[] = "Abr";
	$res[] = "May";
	$res[] = "Jun";
	$res[] = "Jul";
	$res[] = "Ago";
	$res[] = "Sep";
	$res[] = "Oct";
	$res[] = "Nov";
	$res[] = "Dic";
	
	return $res[$mes - 1];
}

function toPermalink($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}