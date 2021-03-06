<?php
include("includes/includes.php");
session_start();

$categoria = new categoria();
$categoria->get_query = "select * from categoria where status = 1";
$categorias = $categoria->get();

if($_POST["correo"] != ""){
    $subject = "Contacto desarrollo de software Aguitech.";
    $body = '
	<center><a href="https://aguitech.com"><img src="https://aguitech.com/blue/images/logo_aguitech/Aguitech_logo.png" alt="Aguitech" style="width:300px;" /></a></center>
	';
    $email = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];
    
    //if($enviar){
    $body .= "<div style='font-size:16px; color:#003D7B;'>Hola " . $nombre . ",</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Gracias por escribirnos,</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>" . $mensaje . "</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>En un momento personal de nuestro equipo o uno de nuestros creadores se comunicar&aacute; contigo al siguiente n&uacute;mero " . $telefono . ".</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Si no puedes esperar te dejo nuestro contacto:</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>E-mail. hola@aguitech.com</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Tel&eacute;fono. 55445249906</div>";
    
    $body_cliente = $body . "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>Aguitech Solutions<br /><br />Tel&eacute;fono: 55 45 24 99 06<br /><br />E-mail: hola@aguitech.com<br /></div>";
    
    emailSend($subject, $body_cliente, $email);
    
    
    $body .= "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>" . $_POST["nombre_cotizacion"] . "<br /><br />" . $_POST["telefono_cotizacion"] . "<br /><br />E-mail: " . $email . "<br /></div>";
    emailSend("Contacto desarrollo de software Aguitech", $body, "hector@aguitech.com");
    echo "<script>alert('E-mail enviado " . $email . "');</script>";
}

if($_POST["email_cotizacion"] != ""){
    $subject = "Cotizacion desarrollo de software Aguitech.";
    $body = '
	<center><a href="https://aguitech.com"><img src="https://aguitech.com/blue/images/logo_aguitech/Aguitech_logo.png" alt="Aguitech" style="width:300px;" /></a></center>
	';
    $email = $_POST["email_cotizacion"];
    $nombre = $_POST["nombre_cotizacion"];
    
    $body .= "<div style='font-size:16px; color:#003D7B;'>Hola " . $nombre . ",</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Gracias por compartir tu idea con nosotros</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Este es un peque&ntilde;o paso para materializar tu idea, nos encantar&iacute;a saber mas de tu sue&ntilde;o.</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>En un momento mas, uno de nuestros creadores se comunicar&aacute; contigo.</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Si no puedes esperar te dejo nuestro contacto:</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>E-mail. hola@aguitech.com</div>";
    $body .= "<br />";
    $body .= "<div style='font-size:16px; color:#003D7B;'>Tel&eacute;fono. 55445249906</div>";
    
    $body .= "<br /><br />";
    
    $body .= "<div style='font-size:16px; font-weight:bold; color:#003D7B;'>Preferencias</div>";
    
    $body .= "<div style='font-size:16px;'>";
    foreach($_SESSION["pregunta"] as $clave => $valor){
        $i = $clave;
        
        if($_SESSION["pregunta"][$i] == "1"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>1. Tipo de desarrollo</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "30000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Android";
                }
            }
            if($_SESSION["cantidad"][$i] == "30000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "iOS";
                }
            }
            if($_SESSION["cantidad"][$i] == "50000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Android & iOS";
                }
            }
            if($_SESSION["cantidad"][$i] == "20000"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "Web";
                }
            }
            $body .= "</div>";
        }
        
        if($_SESSION["pregunta"][$i] == "2"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>2. Requiere manejo de sesi&oacute;n</div><div style='color:#003D7B;'>";
            
            if($_SESSION["cantidad"][$i] == "20000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Si";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "No";
                }
            }
            if($_SESSION["cantidad"][$i] == "20000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "No lo s&eacute;";
                }
            }
            $body .= "</div>";
        }
        
        if($_SESSION["pregunta"][$i] == "3"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>3. Los usuarios tienen perfil</div><div style='color:#003D7B;'>";
            
            if($_SESSION["cantidad"][$i] == "15000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Si";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "No";
                }
            }
            if($_SESSION["cantidad"][$i] == "15000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "No lo s&eacute;";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "4"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>4. Cuentas con logo y manual de identidad</div><div style='color:#003D7B;'>";
            
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Si";
                }
            }
            if($_SESSION["cantidad"][$i] == "10000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "Cuento con el logo";
                }
            }
            if($_SESSION["cantidad"][$i] == "15000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "No cuento con logo, ni manual";
                }
            }
            $body .= "</div>";
        }
        
        
        if($_SESSION["pregunta"][$i] == "5"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>5. Sobre el dise&ntilde;o</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "15000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Interfaz sencilla";
                }
            }
            if($_SESSION["cantidad"][$i] == "30000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "Interfaz personalizada";
                }
            }
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Interfaz replicada de la web";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "No necesito dise&ntilde;o";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "6"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>6. Como sacar beneficio de la app</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Aplicaci&oacute;n gratuita con publicidad";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "Aplicaci&oacute;n de pago sin anuncios";
                }
            }
            if($_SESSION["cantidad"][$i] == "50000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Compras como Candy Crush";
                }
            }
            if($_SESSION["cantidad"][$i] == "55000"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "Es un e-commerce de mis productos o servicios";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "7"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>7. Tiene que estar viculada la aplicaci&oacute;n y un sitio web</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Si";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "No";
                }
            }
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "No lo s&eacute;";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "8"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>8 . Que idioma usar&aacute; la aplicaci&oacute;n</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Espa&ntilde;ol";
                }
            }
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "Biling&uuml;e";
                }
            }
            if($_SESSION["cantidad"][$i] == "35000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "No lo s&eacute;";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "9"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>9. En que fase se encuentra tu proyecto</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "12000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Idea";
                }
            }
            if($_SESSION["cantidad"][$i] == "10000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "Boceto";
                }
            }
            if($_SESSION["cantidad"][$i] == "10000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Planificado y Dise&ntilde;ado";
                }
            }
            if($_SESSION["cantidad"][$i] == "10000"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "En proceso de desarrollo";
                }
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "10"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>10 . Quieres basarte en el modelo de negocio de</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "300000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Uber";
                }
            }
            if($_SESSION["cantidad"][$i] == "300000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "AirBnb";
                }
            }
            if($_SESSION["cantidad"][$i] == "300000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Amazon";
                }
            }
            if($_SESSION["cantidad"][$i] == "300000"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "Otro modelo de negocio similar";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                $body .= "Ninguno";
            }
            $body .= "</div>";
        }
        if($_SESSION["pregunta"][$i] == "11"){
            $body .= "<div style='padding-top:10px; color:#003D7B; font-weight:bold;'>11. Te gustar&iacute;a distinguirte por alguna tecnolog&iacute;a aplicada</div><div style='color:#003D7B;'>";
            if($_SESSION["cantidad"][$i] == "25000"){
                if($_SESSION["respuesta"][$i] == "1"){
                    $body .= "Realidad aumentada";
                }
            }
            if($_SESSION["cantidad"][$i] == "25000"){
                if($_SESSION["respuesta"][$i] == "2"){
                    $body .= "QR Code";
                }
            }
            if($_SESSION["cantidad"][$i] == "30000"){
                if($_SESSION["respuesta"][$i] == "3"){
                    $body .= "Comunicaci&oacute;n entre dispositivos";
                }
            }
            if($_SESSION["cantidad"][$i] == "45000"){
                if($_SESSION["respuesta"][$i] == "4"){
                    $body .= "Red social o comunidad virtual";
                }
            }
            if($_SESSION["cantidad"][$i] == "30000"){
                if($_SESSION["respuesta"][$i] == "5"){
                    $body .= "Smart Watch o Smart TV";
                }
            }
            if($_SESSION["cantidad"][$i] == "0"){
                if($_SESSION["respuesta"][$i] == "6"){
                    $body .= "Ninguno";
                }
            }
            $body .= "</div>";
        }
        
        
    }
    
    $body .= "</div>";
    
    $total_cotizacion = 0;
    foreach($_SESSION["pregunta"] as $clave => $valor){
        $i = $clave;
        
        $total_cotizacion += $_SESSION["cantidad"][$i];
    }
    
    $body .= "<div style='margin-top:20px; border-radius:7px; padding:20px; background-color:#003D7B; color:white;'>$ " . number_format($total_cotizacion, 2) . " MXN</div>";
    
    $body_cliente = $body . "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>Aguitech Solutions<br /><br />55 45 24 99 06<br /><br />E-mail: hola@aguitech.com<br /></div>";
    
    emailSend($subject, $body_cliente, $email);
    
    
    $body .= "<div style='margin-top:20px; border-radius:7px; padding:20px; border:1px solid #003D7B; background-color:white; color:#003D7B;'>" . $_POST["nombre_cotizacion"] . "<br /><br />" . $_POST["telefono_cotizacion"] . "<br /><br />E-mail: " . $email . "<br /></div>";
    emailSend("Contacto AGUITECH.COM", $body, "hector@aguitech.com");
    echo "<script>alert('E-mail enviado " . $email . "');</script>";
}

if($_GET["clear"] == "true"){
    
    session_start();
    function logout(){
        session_destroy();
        session_unset();
        //header("location: ../../login.php");
    }
    logout();
    
    
    
    
}
/**
 <!--
 *************************************   _____   _____   _   _   _   _____   ____   ____   _   _
 ***      Hector Aguilar           *** .|  _  |.| ____|.| | | |.| |.|_   _|.| ___|.|  __|.| |_| |.
 ***      CEO Aguitech             *** .|  _  |.|  _  |.| |_| |.| |.  | |  .| _|_ .| |__ .|  _  |.
 ***      www.aguitech.com         *** .|_| |_|.|_____|.|_____|.|_|.  |_|  .|____|.|____|.|_| |_|.
 ***      hector@aguitech.com      ***                     by Hector Aguilar [ www.aguitech.com ]
 *************************************
 
 Gracias por visitar el codigo fuente, y lo mas seguro es que estes aqui para plagiar. Asi que adelante pase usted.
 
 Thanks 4 view our source code, and i'm sure that you're here just to copy a few source code. So, coming and welcome.
 -->
 */
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- 
		<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		 -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="Author" content="Hector Aguilar [ www.aguitech.com ]" lang="es">
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,600,800" rel="stylesheet">
		<link rel="Shortcut Icon" href="aguitech.ico" type="image/x-icon" />
<!--		<link href="" rel="image_src" / >-->
		
		<!-- Facebook Options 
		<meta property="og:url"                content="http://aguitech.com/blue/" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="Aguitech Solutions" />
		<meta property="og:description"        content="Desarrollo de software, aplicaciones y websites" />
		<meta property="og:image"              content="http://aguitech.com/blue/blue/images/logo_aguitech/Aguitech_logo.png" />
		-->
		<!--
		<link rel="Shortcut Icon" href="http://www.aguitech.com/icono.ico" type="image/x-icon" />
		 -->
		<?php if(!empty($_GET["blog"])){ ?>
			<?php 
			$tituloblog = new blog();
			$tituloblog = $tituloblog->get($_GET["blog"]);
			
			$categoriablog = new categoria();
			$categoriablog = $categoriablog->get($tituloblog["id_categoria"]);
			?>
			<title><?php echo $categoriablog["categoria"]; ?> | <?php echo $tituloblog["titulo"]; ?></title>
			<meta name="description" content="<?php echo $tituloblog["resenia"]; ?>">
			<meta name="keywords" content="<?php echo $tituloblog["hashtags"]; ?>">
			
			<?php if(!empty($tituloblog["thumb"])){ ?>
				<meta property="og:image"              content="https://aguitech.com/panel/images/blog/<?php echo $tituloblog["thumb"]; ?>" />
				<?php /** <meta property="og:url"              content="http://aguitech.com/panel/images/blog/<?php echo $tituloblog["thumb"]; ?>" /> */ ?>
				<?php 
				$find_gif = explode(".", $tituloblog["thumb"]);
				
				if($find_gif[1] == "gif"){
				?>
					<meta property="og:url"              content="https://aguitech.com/panel/images/blog/<?php echo $tituloblog["thumb"]; ?>" />
				<?php } ?>
			<?php }else{ ?>
				<meta property="og:image"              content="https://aguitech.com/images/aguitech_fb.png" />
			<?php } ?>
		<?php }else{ ?>
			<title>Aguitech | Desarrollo de Software | www.aguitech.com</title>
			<meta name="description" content="Desarrollo de software, websites, aplicaciones android & iOS, con sede en la Ciudad de M&eacute;xico. Contacto: hola@aguitech.com">
			<meta name="keywords" content="desarrollo de software, agencia digital, sitios web, aplicaciones android, aplicaciones ios, php consultor, php developer, programador orientado a web">
			<meta property="og:image"              content="https://aguitech.com/images/aguitech_fb.png" />
		<?php } ?>
		<link rel="stylesheet" href="blue/css/2020styles.css" />
		<script src='js/jquery-3.3.1.js' type='text/javascript'></script>
		<script>
		/*
		$(document).ready(function() {
			$("#usuario").focus();
			$("body").bind('keypress', function(event){
				if(event.keyCode == '37'){
					alert("37");
				}else if(event.keyCode == '39'){
					alert("39");
				}else if(event.keyCode == '13'){
					validar_usuario();
					//alert("Precionaste Enter");
				}else{
					//alert("Presionaste otra tecla");
					alert(event.keyCode);
				}
			});
		});
		*/
		</script>
		<script>
		$(document).on('click', 'a.smooth', function(e) {
		    var $link = $(this);
		    var anchor  = $link.attr('href');
		    $('html, body').stop().animate({
		        scrollTop: $(anchor).offset().top
		    }, 1000);
		    $("#menu_mobile").hide();
		});
		
		$(document).ready(function(){
			//animar_clientes();
			animar_home();


			//alert($(window).width())
			
			var valor_border_left = $(window).width() + "px solid white";
			var valor_border_top = "100px solid transparent";
			 

			
			//alert(valor_border_left);
			
			//$("#triangulo_inicio").css({"borderLeft":valor_border_left})
			$("#triangulo_inicio").css({"borderRight":valor_border_left, "borderTop":valor_border_top});
			
			
			<?php if($_GET["clear"] == "true"){ ?>
			$('.contenidos').hide(); $('#cotizador').show();
			<?php } ?>
			/*cargar_blog(1);*/
			<?php if(!empty($_GET["categoria"])){ ?>
			cargar_blog(<?php echo $_GET["categoria"]; ?>);
			<?php }elseif(!empty($_GET["blog"])){ ?>
			detalle_publicacion(<?php echo $_GET["blog"]; ?>);
			<?php }else{ ?>
			iniciar_blog(3);
			<?php } ?>
		});
		
		/** ANIMACION DEL MENU */
		function animar_clientes(){
			
			$('.cliente_logo').css({'-moz-transform':'rotate(-2deg)', WebkitTransform:'rotate(-2deg)'});
			setTimeout("desanimar_clientes()", "500");
		}
		function desanimar_clientes(){
			$('.cliente_logo').css({'-moz-transform':'rotate(2deg)', WebkitTransform:'rotate(2deg)'});
			setTimeout("animar_clientes()", "500");
		}

		function animar_procesos(){
			$('#img_procesos2').css({'-moz-transform':'rotate(45deg)', WebkitTransform:'rotate(45deg)'});
			$('#img_procesos2').css({'-moz-transform':'rotate(-45deg)', WebkitTransform:'rotate(-45deg)'});
			$('#img_procesos2').css({'-moz-transform':'rotate(-45deg)', WebkitTransform:'rotate(-45deg)'});

			$('#img_procesos2').animate({'marginTop':'-150px'}, 1500);
		}

		function animar_home(){
			setTimeout("$('#text_home').html('Desarrollo_')", "0");
			setTimeout("$('#text_home').html('Software_')", "150");
			setTimeout("$('#text_home').html('# Desarrollo de<br />sof_')", "300");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />soft_')", "450");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softw_')", "600");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softwa_')", "750");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />softwar_')", "900");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1050");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1200");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwar_')", "1350");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwa_')", "1500");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softw_')", "1650");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />soft_')", "1800");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />sof_')", "1950");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />so_')", "2100");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />s_')", "2250");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />a_')", "2400");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />ap_')", "2550");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apl_')", "2700");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apli_')", "2850");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />aplic_')", "3000");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplica_')", "3150");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicac_')", "3300");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicaci_')", "3450");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacio_')", "3600");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacion_')", "3750");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacione_')", "3900");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4050");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4200");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicacione_')", "4350");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacion_')", "4500");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacio_')", "4650");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicaci_')", "4800");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplicac_')", "4950");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplica_')", "5100");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplic_')", "5250");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apli_')", "5400");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apl_')", "5500");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />ap_')", "5700");
			setTimeout("$('#text_home').html('# Desarrollo de<br />a_')", "5850");
			setTimeout("$('#text_home').html('# Desarrollo de<br />s_')", "6000");
			setTimeout("$('#text_home').html('# Desarrollo de<br />si_')", "6150");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sit_')", "6300");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />siti_')", "6450");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sitio_')", "6600");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios_')", "6750");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios _')", "6900");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios w_')", "7050");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios we_')", "7200");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7350");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7500");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios we_')", "7650");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios w_')", "7800");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios _')", "7950");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitios_')", "8100");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitio_')", "8250");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />siti_')", "8400");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />sit_')", "8550");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />si_')", "8700");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />s_')", "8850");
			
			setTimeout("desanimar_home()", "9000");
		}
		/*
		function animar_home(){
			setTimeout("$('#text_home').html('# Desarrollo de<br />s_')", "0");
			setTimeout("$('#text_home').html('# Desarrollo de<br />so_')", "150");
			setTimeout("$('#text_home').html('# Desarrollo de<br />sof_')", "300");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />soft_')", "450");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softw_')", "600");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softwa_')", "750");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />softwar_')", "900");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1050");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1200");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwar_')", "1350");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwa_')", "1500");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softw_')", "1650");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />soft_')", "1800");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />sof_')", "1950");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />so_')", "2100");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />s_')", "2250");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />a_')", "2400");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />ap_')", "2550");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apl_')", "2700");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apli_')", "2850");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />aplic_')", "3000");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplica_')", "3150");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicac_')", "3300");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicaci_')", "3450");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacio_')", "3600");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacion_')", "3750");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacione_')", "3900");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4050");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4200");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicacione_')", "4350");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacion_')", "4500");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacio_')", "4650");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicaci_')", "4800");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplicac_')", "4950");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplica_')", "5100");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplic_')", "5250");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apli_')", "5400");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apl_')", "5500");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />ap_')", "5700");
			setTimeout("$('#text_home').html('# Desarrollo de<br />a_')", "5850");
			setTimeout("$('#text_home').html('# Desarrollo de<br />s_')", "6000");
			setTimeout("$('#text_home').html('# Desarrollo de<br />si_')", "6150");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sit_')", "6300");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />siti_')", "6450");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sitio_')", "6600");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios_')", "6750");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios _')", "6900");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios w_')", "7050");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios we_')", "7200");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7350");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7500");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios we_')", "7650");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios w_')", "7800");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios _')", "7950");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitios_')", "8100");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitio_')", "8250");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />siti_')", "8400");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />sit_')", "8550");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />si_')", "8700");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />s_')", "8850");
			
			setTimeout("desanimar_home()", "9000");
		}
		*/
		function desanimar_home(){
			setTimeout("$('#text_home').html('# Desarrollo de<br />s_')", "0");
			setTimeout("$('#text_home').html('# Desarrollo de<br />so_')", "150");
			setTimeout("$('#text_home').html('# Desarrollo de<br />sof_')", "300");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />soft_')", "450");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softw_')", "600");
			setTimeout("$('#text_home').html('$ Desarrollo de<br />softwa_')", "750");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />softwar_')", "900");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1050");
			setTimeout("$('#text_home').html('&lt; Desarrollo de &gt;<br />software_')", "1200");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwar_')", "1350");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softwa_')", "1500");
			setTimeout("$('#text_home').html('[ Desarrollo de ]<br />softw_')", "1650");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />soft_')", "1800");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />sof_')", "1950");
			setTimeout("$('#text_home').html('&quot; Desarrollo de &quot; <br />so_')", "2100");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />s_')", "2250");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />a_')", "2400");
			setTimeout("$('#text_home').html('( Desarrollo de )<br />ap_')", "2550");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apl_')", "2700");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />apli_')", "2850");
			setTimeout("$('#text_home').html('Desarrollo de ()<br />aplic_')", "3000");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplica_')", "3150");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicac_')", "3300");
			setTimeout("$('#text_home').html('-&gt; Desarrollo de<br />aplicaci_')", "3450");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacio_')", "3600");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacion_')", "3750");
			setTimeout("$('#text_home').html('? Desarrollo de<br />aplicacione_')", "3900");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4050");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicaciones_')", "4200");
			setTimeout("$('#text_home').html('!= Desarrollo de<br />aplicacione_')", "4350");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacion_')", "4500");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicacio_')", "4650");
			setTimeout("$('#text_home').html('Desarrollo de ;<br />aplicaci_')", "4800");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplicac_')", "4950");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplica_')", "5100");
			setTimeout("$('#text_home').html('/ Desarrollo de<br />aplic_')", "5250");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apli_')", "5400");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />apl_')", "5500");
			setTimeout("$('#text_home').html('+= Desarrollo de<br />ap_')", "5700");
			setTimeout("$('#text_home').html('# Desarrollo de<br />a_')", "5850");
			setTimeout("$('#text_home').html('# Desarrollo de<br />s_')", "6000");
			setTimeout("$('#text_home').html('# Desarrollo de<br />si_')", "6150");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sit_')", "6300");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />siti_')", "6450");
			setTimeout("$('#text_home').html('|| Desarrollo de<br />sitio_')", "6600");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios_')", "6750");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios _')", "6900");
			setTimeout("$('#text_home').html('& Desarrollo de<br />sitios w_')", "7050");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios we_')", "7200");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7350");
			setTimeout("$('#text_home').html('Desarrollo de ++<br />sitios web_')", "7500");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios we_')", "7650");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios w_')", "7800");
			setTimeout("$('#text_home').html('.= Desarrollo de<br />sitios _')", "7950");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitios_')", "8100");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />sitio_')", "8250");
			setTimeout("$('#text_home').html('{ Desarrollo de }<br />siti_')", "8400");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />sit_')", "8550");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />si_')", "8700");
			setTimeout("$('#text_home').html('@ Desarrollo de<br />s_')", "8850");
			
			setTimeout("animar_home()", "9000");
		}
		</script>
		<script>
		
		$(window).scroll(function() {
			var altura_del_navegador = window.innerHeight;
			
			var porcentaje_altura_pagina = (100 / ($(document).height() - + altura_del_navegador)) * $(window).scrollTop();
			//Redondeando para abajo
			var res_altura_pantalla = Math.round(porcentaje_altura_pagina) + "%";

			$("#altura_pagina").stop().animate({"width":res_altura_pantalla}, "100");

			if($(window).scrollTop() == 0){
				$("#imagen_logo").stop().animate({ 
					height: "40px"
				}, "100");
			}else if($(window).scrollTop() > 20 && $(window).scrollTop() < 200) {
				$("#imagen_logo").stop().animate({ 
					height: "35px"
				}, "100");
            }


			if($(window).width() > 500){
				/*
				if($(window).scrollTop() == 0){
					document.getElementById("servicios").style.opacity = "0.1";
				}else if($(window).scrollTop() > 20 && $(window).scrollTop() < 200) {
					document.getElementById("servicios").style.opacity = "0.1";
	            }if($(window).scrollTop() > 600 && $(window).scrollTop() < 619) {
	            	document.getElementById("servicios").style.opacity = "0.1"; 
	            }else if($(window).scrollTop() > 620 && $(window).scrollTop() < 639) {
	            	document.getElementById("servicios").style.opacity = "0.2"; 
	            }else if($(window).scrollTop() > 640 && $(window).scrollTop() < 659) {
	            	document.getElementById("servicios").style.opacity = "0.3"; 
	            }else if($(window).scrollTop() > 660 && $(window).scrollTop() < 679) {
	            	document.getElementById("servicios").style.opacity = "0.4"; 
	            }else if($(window).scrollTop() > 680 && $(window).scrollTop() < 699) {
	            	document.getElementById("servicios").style.opacity = "0.5"; 
	            }else if($(window).scrollTop() > 700 && $(window).scrollTop() < 719) {
	            	document.getElementById("servicios").style.opacity = "0.6";
	            }else if($(window).scrollTop() > 720 && $(window).scrollTop() < 739) {
	            	document.getElementById("servicios").style.opacity = "0.7";
	            }else if($(window).scrollTop() > 740 && $(window).scrollTop() < 759) {
	            	document.getElementById("servicios").style.opacity = "0.8";
	            }else if($(window).scrollTop() > 760 && $(window).scrollTop() < 779) {
	            	document.getElementById("servicios").style.opacity = "0.9";
	            }else if($(window).scrollTop() > 780 && $(window).scrollTop() < 799) {
	            	document.getElementById("servicios").style.opacity = "1";
	            }
	            */
	            if($(window).scrollTop() >= 0 && $(window).scrollTop() < $("#servicios").offset().top){
					$(".menu_header").removeClass("menu_header_selected");
					$(".menu_header_inicio").addClass("menu_header_selected");
	            }
	            if($(window).scrollTop() >= $("#servicios").offset().top -2 && $(window).scrollTop() < $("#nosotros").offset().top){
					$(".menu_header").removeClass("menu_header_selected");
					$(".menu_header_servicios").addClass("menu_header_selected");
	            }
	            if($(window).scrollTop() >= $("#nosotros").offset().top -2  && $(window).scrollTop() < $("#contacto").offset().top){
					$(".menu_header").removeClass("menu_header_selected");
					$(".menu_header_clientes").addClass("menu_header_selected");
	            }
	            if($(window).scrollTop() >= $("#contacto").offset().top -2 && $(window).scrollTop() < $("#blog").offset().top){
					$(".menu_header").removeClass("menu_header_selected");
					$(".menu_header_contacto").addClass("menu_header_selected");
	            }
	            if($(window).scrollTop() >= $("#blog").offset().top -2){
					$(".menu_header").removeClass("menu_header_selected");
					$(".menu_header_blog").addClass("menu_header_selected");
	            }
			}
        });
		function comprobar_tamanio_scroll(){
			var altura_del_navegador = window.innerHeight;
			
			var porcentaje_altura_pagina = (100 / ($(document).height() - + altura_del_navegador)) * $(window).scrollTop();

			var res_altura_pantalla = Math.round(porcentaje_altura_pagina) + "%";

			$("#altura_pagina").stop().animate({"width":res_altura_pantalla}, "100");
        }
		function calcular_proyecto(pregunta, cantidad, respuesta){
			$.ajax({
				type: "POST",
				url:"calcular_proyecto.php",
				data: { pregunta:pregunta, cantidad:cantidad, respuesta:respuesta },
				success:function(data){
					$("#resultado_cotizador").html(data);
				}
			});
		}
		function detalle_blog(id_blog){			
			$.ajax({
				type: "POST",
				url:"cargar_publicacion.php",
				data: { id:id_foto },
				success:function(data){
					$("#detalle_publicacion").html(data);
				}
			});
			
		}
		</script>
		<script>
						$(document).ready(function(){
			var video = document.getElementById('video_identificador');
			//mediaElement.seekable.start();
			//mediaElement.seekable.stop();
			//mediaElement.seekable.start();
			//mute
			//$("video").prop('muted', true);
			/*video.prop('muted', true);*/
			video.play();

			
		});
				/**
		var mediaElement = document.getElementById('video_identificador');
		mediaElement.seekable.start();
		*/
		</script>
	</head>
	<body onload="">
		<div style="position:fixed; top:50px; left:0; right:0; z-index:1; background:white;">
			<div style="width:100%; margin-top:2px;" id="">
				<div style="background:#003D7B; width:0%; height:7px; border-bottom:1px solid #297FCA; box-shadow:0 2px 6px rgba(220,220,220,1);" id="altura_pagina">
					&nbsp;
				</div>
			</div>
		</div>
		<div style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:2; display:none;" id="menu_mobile">
			<div style="width:100%; height:100%; z-index:2;" class="bg_menu">
				
				<div style="" class="contenedor_principal">
					<div class="header">
						<a class="logo smooth" href="#inicio" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();" style="cursor:pointer;">
							<img src="images/logo.png" alt="logo" style="padding:5px 0 5px 0; height:40px;" />
						</a>
						<div class="menu_mobile" onclick="desanimar_menu_mobile();" style="cursor:pointer;">
							<img src="blue/images/cerrar.png" alt="cerrar" style="width:20px;" />
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="contenidos_menu">
						<div>
    						<a class="menu_header_mobile smooth" href="#inicio" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							INICIO
    						</a>
    						<a class="menu_header_mobile smooth" href="#servicios" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							SERVICIOS
    						</a>
    						<a class="menu_header_mobile smooth" href="#nosotros" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							CLIENTES
    						</a>
    						<a class="menu_header_mobile smooth" href="#contacto" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							CONTACTO
    						</a>
    						<a class="menu_header_mobile smooth" href="3d/" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							3D
    						</a>
    						<!-- 
    						<a class="menu_header_mobile smooth" href="#blog" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							BLOG
    						</a>
    						
    						<a class="menu_header_mobile smooth" href="cotizador/" style="">
    							SOLICITAR COTIZACI&Oacute;N
    						</a>
    						-->
    						<a class="menu_header_mobile smooth" href="#contacto" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
    							SOLICITAR COTIZACI&Oacute;N
    						</a>
    						<a class="menu_header_mobile smooth" href="login.php" style="">
    							INICIAR SESI&Oacute;N
    						</a>
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>
		
		<div style="position:absolute; top:0; left:0; right:0; bottom:0;">
			<div style="width:100%; height:100%;">
				<div style="" class="contenedor_principal">
					<div class="header">
						<a class="logo smooth" href="#inicio" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();" style="cursor:pointer;" ondblclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#aguitech_info').css({'display':'block'});">
							<img src="images/logo.png" style="padding:10px 0 5px 0; height:35px;" id="imagen_logo" alt="logo" />
						</a>
						<a class="menu_header smooth" href="#contacto" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();" style="color:white; background:#22568f; font-size:12px; padding:6px 0; border-radius:5px; width:126px;">
							Solicitar Cotizaci&oacute;n
						</a>
						
						
						<!-- 
						<a class="menu_header smooth" href="cotizador/" style="color:white; background:#22568f; font-size:12px; padding:6px 0; border-radius:5px; width:126px;">
							Solicitar Cotizaci&oacute;n
						</a>
						
						<a class="menu_header smooth menu_header_blog" href="#blog" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
							Blog
						</a>
						-->
						<a class="menu_header smooth menu_header_blog" href="3d/" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
							3D
						</a>
						<a class="menu_header smooth menu_header_contacto" href="#contacto" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
							Contacto
						</a>
						<a class="menu_header smooth menu_header_clientes" href="#nosotros" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show(); ">
							Clientes
						</a>
						<a class="menu_header smooth menu_header_servicios" href="#servicios" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
							Servicios
						</a>
						<a class="menu_header smooth menu_header_inicio" href="#inicio" style="" onclick="$('#menu_mobile').hide(); $('.contenidos').hide(); $('#sitio_web').show();">
							Inicio
						</a>
						<script>
						function animar_menu_mobile(){
							$('#menu_mobile').show();
							$('#menu_mobile').animate({'left':'0', 'right':'0', 'bottom':'0', 'top':'0'}, "500");
						}
						function desanimar_menu_mobile(){
							$('#menu_mobile').css({'left':'000px', 'right':'0', 'bottom':'0', 'top':'-2000'});
							setTimeout("$('#menu_mobile').hide()", 700);
						}
						
						</script>
						<div class="menu_mobile" onclick="animar_menu_mobile()">
							<img src="blue/images/menu.png" style="width:20px;" alt="menu" />
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="contenidos" id="cotizador" style="display:none;">
						<div style="" class="contenedor_izquierdo_cotizador">
							<div style="height:100%; overflow-y:none;">
								<div class="titulo_seccion" onclick="">Cotizador de proyectos<br />Web, Android & iOS</div>
								<br />
								<div id="step01" class="step">
									<div class="question">1. Tipo de desarrollo</div>
									
									<a href="#step02" class="smooth answer" onclick="calcular_proyecto(1,15000, 1)" >
										Android
									</a>
									<a href="#step02" class="smooth answer" onclick="calcular_proyecto(1,15000, 2)">
										iOS
									</a>
									<a href="#step02" class="smooth answer" onclick="calcular_proyecto(1,25000, 3)">
										Android + iOS
									</a>
									<a href="#step02" class="smooth answer" onclick="calcular_proyecto(1,15000, 4)">
										Web
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step02" class="step">
									<div class="question">2. Requiere manejo de sesi&oacute;n</div>
									<a href="#step03" class="smooth answer" onclick="calcular_proyecto(2,5000, 1)">
										Si
									</a>
									<a href="#step03" class="smooth answer" onclick="calcular_proyecto(2,0, 2)">
										No
									</a>
									<a href="#step03" class="smooth answer" onclick="calcular_proyecto(2,5000, 3)">
										No lo s&eacute;
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step03" class="step">
									<div class="question">3. Los usuarios tienen perfil</div>
									<a href="#step04" class="smooth answer" onclick="calcular_proyecto(3,10000, 1)">
										Si
									</a>
									<a href="#step04" class="smooth answer" onclick="calcular_proyecto(3,0, 2)">
										No
									</a>
									<a href="#step04" class="smooth answer" onclick="calcular_proyecto(3,10000, 3)">
										No lo s&eacute;
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step04" class="step">
									<div class="question">4. Cuentas con logo y manual de identidad</div>
									<a href="#step05" class="smooth answer" onclick="calcular_proyecto(4,0, 1)">
										Si
									</a>
									<a href="#step05" class="smooth answer" onclick="calcular_proyecto(4,10000, 2)">
										Cuento con el logo
									</a>
									<a href="#step05" class="smooth answer" onclick="calcular_proyecto(4,15000, 3)">
										No tengo logo, ni manual
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step05" class="step">
									<div class="question">5. Sobre el dise&ntilde;o</div>
									<a href="#step06" class="smooth answer" onclick="calcular_proyecto(5,15000, 1)">
										Interfaz sencilla
									</a>
									<a href="#step06" class="smooth answer" onclick="calcular_proyecto(5,30000, 2)">
										Interfaz personalizada
									</a>
									<a href="#step06" class="smooth answer" onclick="calcular_proyecto(5,20000, 3)">
										Interfaz replicada de la web
									</a>
									<a href="#step06" class="smooth answer" onclick="calcular_proyecto(5,0, 4)">
										No necesito dise&ntilde;o
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step06" class="step">
									<div class="question">6. Como sacar beneficio de la app</div>
									<a href="#step07" class="smooth answer" onclick="calcular_proyecto(6,15000, 1)">
										Aplicaci&oacute;n gratuita con publicidad
									</a>
									<a href="#step07" class="smooth answer" onclick="calcular_proyecto(6,0, 2)">
										Aplicaci&oacute;n de pago sin anuncios
									</a>
									<a href="#step07" class="smooth answer" onclick="calcular_proyecto(6,20000, 3)">
										Compras como Candy Crush
									</a>
									<a href="#step07" class="smooth answer" onclick="calcular_proyecto(6,35000, 4)">
										Es un e-commerce de mis productos o servicios
									</a>
									<a href="#step07" class="smooth answer" onclick="calcular_proyecto(6,0, 2)">
										Ninguno
									</a>
									
									<div style="clear:both;"></div>
								</div>
								<div id="step07" class="step">
									<div class="question">7. Tiene que estar viculada la aplicaci&oacute;n y un sitio web</div>
									<a href="#step08" class="smooth answer" onclick="calcular_proyecto(7,15000, 1)">
										Si
									</a>
									<a href="#step08" class="smooth answer" onclick="calcular_proyecto(7,0, 2)">
										No
									</a>
									<a href="#step08" class="smooth answer" onclick="calcular_proyecto(7,15000, 3)">
										No lo s&eacute;
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step08" class="step">
									<div class="question">8. Que idioma usar&aacute; la aplicaci&oacute;n</div>
									<a href="#step09" class="smooth answer" onclick="calcular_proyecto(8,0, 1)">
										Espa&ntilde;ol
									</a>
									<a href="#step09" class="smooth answer" onclick="calcular_proyecto(8,25000, 2)">
										Biling&uuml;e
									</a>
									<a href="#step09" class="smooth answer" onclick="calcular_proyecto(8,25000, 3)">
										No lo s&eacute;
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step09" class="step">
									<div class="question">9. En que fase se encuentra tu proyecto</div>
									<a href="#step10" class="smooth answer" onclick="calcular_proyecto(9,12000, 1)">
										Idea
									</a>
									<a href="#step10" class="smooth answer" onclick="calcular_proyecto(9,10000, 2)">
										Boceto
									</a>
									<a href="#step10" class="smooth answer" onclick="calcular_proyecto(9,10000, 3)">
										Planificado y Dise&ntilde;ado
									</a>
									<a href="#step10" class="smooth answer" onclick="calcular_proyecto(9,10000, 4)">
										En proceso de desarrollo
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step10" class="step">
									<div class="question">10. Quieres basarte en el modelo de negocio de</div>
									<a href="#step11" class="smooth answer" onclick="calcular_proyecto(10,40000, 1)">
										Uber
									</a>
									<a href="#step11" class="smooth answer" onclick="calcular_proyecto(10,40000, 2)">
										AirBnb
									</a>
									<a href="#step11" class="smooth answer" onclick="calcular_proyecto(10,40000, 3)">
										Amazon
									</a>
									<a href="#step11" class="smooth answer" onclick="calcular_proyecto(10,40000, 4)">
										Otro modelo de negocio similar
									</a>
									<a href="#step11" class="smooth answer" onclick="calcular_proyecto(10,0, 5)">
										Ninguno
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step11" class="step">
									<div class="question">11. Te gustar&iacute;a distinguirte por alguna tecnolog&iacute;a aplicada</div>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,15000, 1)">
										Realidad aumentada
									</a>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,15000, 2)">
										QR Code
									</a>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,20000, 3)">
										Comunicaci&oacute;n entre dispositivos
									</a>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,25000, 4)">
										Red social o comunidad virtual
									</a>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,20000, 5)">
										Smart Watch o Smart TV
									</a>
									<a href="#step12" class="smooth answer" onclick="calcular_proyecto(11,00000, 6)">
										Ninguno
									</a>
									<div style="clear:both;"></div>
								</div>
								<div id="step12" class="step" style="">
									<form method="post" action="">
										<div class="question">Introduce tus datos para enviarte una copia de la cotizaci&oacute;n</div>
										<div>
											<label>Nombre
												<input type="text" name="nombre_cotizacion" class="text_field" placeholder="Nombre" />
											</label>
										</div>
										<div>
											<label>Email
												<input type="text" name="email_cotizacion" class="text_field" placeholder="E-mail" />
											</label>
										</div>
										<div>
											<label>Tel&eacute;fono
												<input type="text" name="telefono_cotizacion" class="text_field" placeholder="Tel&eacute;fono" />
											</label>
										</div>
										<div>
											<label>
												<input type="submit" class="text_field" placeholder="E-mail" />
											</label>
										</div>
										
										<div style="clear:both;"></div>
									</form>
								</div>
							</div>
						</div>
						<div style="" class="contenedor_derecho_cotizador">
							<div style="" class="contenedor_derecho_cotizador_secundario">
								<div style="font-size:16px; padding:5px 5px; border-bottom:1px solid #003D7B; border-radius:5px; color:#003D7B; cursor:pointer; text-align:center; font-weight:bold;">
									Precio estimado
								</div>
								<div id="resultado_cotizador" style="font-size:34px; text-align:center; padding-top:10px;">
									$ 0.00 MXN
								</div>
								<div style="font-size:14px; padding:5px 5px; text-align:center;">
									El costo es un presupuesto estimado para la realizaci&oacute;n de tu desarrollo.
								</div>
								<div onclick="window.location='?clear=true'" style="font-size:14px; padding:5px 5px; background:#003D7B; border-radius:5px; color:white; cursor:pointer; text-align:center;">
									Iniciar cotizaci&oacute;n de nuevo
								</div>
								
							</div>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="contenidos" id="desarrollo_software" style="display:none;">
						<div class="titulo_seccion">Desarrollo de software</div>
						<div class="contenedor_izquierdo_seccion">
							<img src="blue/images/imagenes_stock/Dell_Monitor.png" class="imagen_seccion" alt="software" />
							<img src="blue/images/imagenes_stock/Apple_Keyboard.png" class="imagen_seccion" alt="software" />
						</div>
						<div class="contenedor_derecho_seccion">
							<div class="subtitulo_seccion">Sitios web</div>
							<div class="descripcion_seccion">
								Tener un buen sitio web es una extensi&oacute;n de un producto de calidad, es decir no compras si no se ven bien en internet.
							</div>
							<div class="subtitulo_seccion">Aplicaciones Android & iOS</div>
							<div class="descripcion_seccion">
								Podemos desarrollar tu idea en lineas de c&oacute;digo para as&iacute; realizar aplicaciones con conexiones a tus propias bases de datos desde la intranet.
							</div>
							<div class="subtitulo_seccion">Sistemas a la medida</div>
							<div class="descripcion_seccion">
								Podemos bajar tu idea y conceptualizarla en un desarrollo en una Intranet seg&uacute;n sean las necesidades de tu empresa o proyecto.
							</div>
							<a class="btn_regresar smooth" href="#servicios" onclick="$('.contenidos').hide(); $('#sitio_web').show();">
								<img src="blue/images/flecha_anterior.png" class="imagen_regresar" alt="regresar" />
							</a>
						</div>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
						
					</div>
					<div class="contenidos" id="consultoria_procesos" style="display:none;">
						<div class="titulo_seccion">Consultoria y procesos</div>
						<div class="contenedor_izquierdo_seccion">
<!--							<img src="blue/images/imagenes_stock/Dell_Monitor.png" class="imagen_seccion" />-->
<!--							<img src="blue/images/imagenes_stock/Apple_Keyboard.png" class="imagen_seccion" />-->
							<img src="https://aguitech.com/blue/images/imagenes_stock/Pen_Holder.png" class="imagen_seccion" style="width:200px;" id="img_procesos1" alt="consultoria" />
							<img src="https://aguitech.com/blue/images/imagenes_stock/Notebook.png" class="imagen_seccion" id="img_procesos2" alt="consultoria" />
						</div>
						<div class="contenedor_derecho_seccion">
							<div class="subtitulo_seccion">An&aacute;lisis y gesti&oacute;n de recursos</div>
							<div class="descripcion_seccion">
								Diagnosticamos la estructura y cualificaci&oacute;n del actual grupo de personas que componen la empresa, con el fin de contribuir a la consecuci&oacute;n de los objetivos y estrategias de la empresa.
							</div>
							<div class="subtitulo_seccion">Manejo y control de almac&eacute;n</div>
							<div class="descripcion_seccion">
								Nos encargamos del control de la recepci&oacute;n, almacenamiento y movimiento dentro de un mismo almac&eacute;n hasta el punto de consumo de cualquier producto por medio de software.
							</div>
							<div class="subtitulo_seccion">Consultoria Integral de Mercadotecnia</div>
							<div class="descripcion_seccion">
								Impulsamos a las empresas a llegar al siguiente nivel ofreciondo soluciones de acuerdo a las necesidades del cliente adaptadas a su p&uacute;blico objetivo.
							</div>
							<a class="btn_regresar smooth" href="#servicios" onclick="$('.contenidos').hide(); $('#sitio_web').show();">
								<img src="blue/images/flecha_anterior.png" class="imagen_regresar" alt="regresar" />
							</a>
						</div>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
					</div>
					<div class="contenidos" id="graphic_design" style="display:none;">
						<div class="titulo_seccion">Dise&ntilde;o gr&aacute;fico</div>
						<div class="contenedor_izquierdo_seccion">
							<img src="https://aguitech.com/blue/images/imagenes_stock/Intuos_Pro.png" class="imagen_seccion" alt="design" />
							<img src="https://aguitech.com/blue/images/imagenes_stock/Stylus.png" class="imagen_seccion" alt="design" />
						</div>
						<div class="contenedor_derecho_seccion">
							<div class="subtitulo_seccion">Creaci&oacute;n de marca.</div>
							<div class="descripcion_seccion">
								Nos encargamos de la identidad visual, creaci&oacute;n de logotipos, sitio web, UX y UI, as&iacute; como el branding corporativo. 
							</div>
							<div class="subtitulo_seccion">Activaciones</div>
							<div class="descripcion_seccion">
								Nos valemos del poder de la tecnolog&iacute;a y creamos stands sorprendentes con lo cual generamos conexi&oacute;n con los usuarios instant&aacute;neamente.
							</div>
							<div class="subtitulo_seccion">Planes mensuales</div>
							<div class="descripcion_seccion">
								Tenemos tarifas que incluyen todos los insumos que requieras de manera planificada para satisfacer todos tus problemas de dise&ntilde;o.
							</div>
							<a class="btn_regresar smooth" href="#servicios" onclick="$('.contenidos').hide(); $('#sitio_web').show();">
								<img src="blue/images/flecha_anterior.png" class="imagen_regresar" alt="regresar" />
							</a>
						</div>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
					</div>
					<div class="contenidos" id="asistencia_legal" style="display:none;">
						
						<div class="titulo_seccion">Asistencia Legal</div>
						<div class="contenedor_izquierdo_seccion">
							<img src="https://aguitech.com/blue/images/imagenes_stock/Macbook_Pro_Open.png" class="imagen_seccion" alt="legal" />
<!--							<img src="blue/images/imagenes_stock/Dell_Monitor.png" class="imagen_seccion" />-->
<!--							<img src="blue/images/imagenes_stock/Apple_Keyboard.png" class="imagen_seccion" />-->
						</div>
						<div class="contenedor_derecho_seccion">
							
							<div class="subtitulo_seccion">Registros de marca y derechos de autor.</div>
							<div class="descripcion_seccion">
								Nos encargamos del registro de tu marca o de tus derechos de propiedad intelectual. 
							</div>
							<div class="subtitulo_seccion">Creaci&oacute;n de contratos</div>
							<div class="descripcion_seccion">
								Contamos con bastantes formatos de contratos listos para personalizar con tu informaci&oacute;n a costos accesibles.
							</div>
							<div class="subtitulo_seccion">Asesoramiento a la medida</div>
							<div class="descripcion_seccion">
								De igual manera proveemos cualquier tipo de servicio legal.
							</div>
							<a class="btn_regresar smooth" href="#servicios" onclick="$('.contenidos').hide(); $('#sitio_web').show();">
								<img src="blue/images/flecha_anterior.png" class="imagen_regresar" alt="regresar" />
							</a>
						</div>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
						
					</div>
					<div class="contenidos" id="detalle_cliente" style="display:none;">
						<div id="contenido_cliente">
							
						</div>
						<div style="clear:both;"></div>
						<a href="#nosotros" onclick="$('.contenidos').hide(); $('#sitio_web').show();">
							<img src="blue/images/flecha_anterior.png" style="width:25px; float:right; margin:10px 10px 0 0; cursor:pointer;" alt="regresar" />
						</a>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
					</div>
					<div class="contenidos" id="detalle_publicacion" style="display:none;">
						<div id="contenido_publicacion">
							
						</div>
						<div style="clear:both;"></div>
						<br />
						<br />
						<br />
						
					</div>
					<div class="contenidos" id="aguitech_info" style="height:100%; opacity:.5; display:none;">
						<div style="position:absolute; top:0; left:0; right:0; bottom:0;">
							<img src="images/logo.png" />
						</div>
						
						<?php /**
						<div style="position:absolute; top:0; left:0; right:0; bottom:0;">
							<div style="width:100%;height:100%;" id="bodymovin"></div>
						</div>
						<script src="intro/lottie.js"></script>
						<script>
						
						    var animData = {
						        wrapper: document.getElementById('bodymovin'),
						        animType: 'html',
						        loop: true,
						        prerender: true,
						        autoplay: true,
						        path: 'intro/data.json'
						
						    };
						    var anim = bodymovin.loadAnimation(animData);
						</script>
						*/ ?>
						<?php /** Juego 2048 
						<!-- 
						<div class="titulo_seccion">
							
							<div class="containermax">
						    <div class="heading">
						      <h1 class="title">2048</h1>
						      <div class="scores-container">
						        <div class="score-container">0</div>
						        <div class="best-container">0</div>
						      </div>
						    </div>
						
						    <div class="above-game">
						      <a class="restart-button">New Game</a>
						    </div>
						
						    <div class="game-container">
						      <div class="game-message">
						        <p></p>
						        <div class="lower">
							        <a class="keep-playing-button">Keep going</a>
						          <a class="retry-button">Try again</a>
						        </div>
						      </div>
						
						      <div class="grid-container">
						        <div class="grid-row">
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						        </div>
						        <div class="grid-row">
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						        </div>
						        <div class="grid-row">
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						        </div>
						        <div class="grid-row">
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						          <div class="grid-cell"></div>
						        </div>
						      </div>
						
						      <div class="tile-container">
						
						      </div>
						    </div>
						
						    <p class="game-explanation">
						      <strong class="important">Como jugar:</strong> Usa las flechas del teclado</strong>
						    </p>
						  </div>
						
						
							<link href="2048-master/style/main.css" rel="stylesheet" type="text/css">
						  <script src="2048-master/js/bind_polyfill.js"></script>
						  <script src="2048-master/js/classlist_polyfill.js"></script>
						  <script src="2048-master/js/animframe_polyfill.js"></script>
						  <script src="2048-master/js/keyboard_input_manager.js"></script>
						  <script src="2048-master/js/html_actuator.js"></script>
						  <script src="2048-master/js/grid.js"></script>
						  <script src="2048-master/js/tile.js"></script>
						  <script src="2048-master/js/local_storage_manager.js"></script>
						  <script src="2048-master/js/game_manager.js"></script>
						  <script src="2048-master/js/application.js"></script>	
						</div>
						
						<br />
						<br />
						<br />
						-->
						*/?>
					</div>
					<div class="contenidos" id="sitio_web" style="">
						<div id="inicio">
							<?php /**
							<video style="background-size:cover; min-width:100%; max-width:100%; min-height: 500px; height: 500px; z-index:3; position:absolute; top:10px; left:0;" loop="" poster="" id="video_identificador">
		<!--							
		                              <video style="background-size:cover; min-width:100%; max-width:100%; min-height: 100%; height: 900px; z-index:3; position:absolute; top:0;" loop="" poster="" id="video_identificador">
		<!--							<source src="video/HPNOTIQ_WEB.mp4" type="video/mp4">-->
		<!--							<source src="video/video_intro_web_vina_real.mp4" type="video/mp4">-->
<!--									<source src="video/video_vina_real_web.mp4" type="video/mp4">-->
<!--									<source src="video/video_web_vina_real_autorizado.mp4" type="video/mp4">-->
<!--									<source src="video/final_video_intro_web_vina_real.mp4" type="video/mp4">-->
									<source src="vinareal/video/final_video_intro_logo_web_vina_real.mp4" type="video/mp4">
									
									
									
		<!--							<source src="video/main-video.webm" type="video/webm">-->
		<!--							<source src="video/main-video.ogv" type="video/ogg">-->
									Your browser does not support the video tag.
								</video>
								*/ ?>
								<!-- 
		<source src="video/HPNOTIQ_WEB.mp4" type="video/mp4">-->
		<!--							<source src="video/video_intro_web_vina_real.mp4" type="video/mp4">-->
<!--									<source src="video/video_vina_real_web.mp4" type="video/mp4">-->
<!--									<source src="video/video_web_vina_real_autorizado.mp4" type="video/mp4">-->
<!--									<source src="video/final_video_intro_web_vina_real.mp4" type="video/mp4">-->
									
								
							<a href="#servicios" class="smooth" style="text-decoration:none; display:inline;">
								<div class="titulo_home"><span id="text_home">software_</span></div>
								
								<img src="blue/images/flecha_home.png" style="" class="flecha_inicio" alt="inicio" />
							</a>
						</div>
						<div style="border-right:1000px solid white; border-top:100px solid transparent; margin-top:-100px; width:0; height:0;" id="triangulo_inicio">
							
						</div>
						<div id="servicios">
							<div class="titulo_seccion">Servicios</div>
							<div class="descripcion_seccion">
								Desde 2009 desarrollamos soluciones a la medida para empresas reconocidas nacional e internacionalmente.
							</div>
							<div class="contenedor_servicios">
    							<a href="#desarrollo_software" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#desarrollo_software').show();*/ ?>">
    								<div class="titulo_servicios">
    									Sitios<br />Web
    								</div>
    								<div class="descripcion_servicios">
    									Creamos experiencias web del alto nivel, cumpliendo altos niveles est&eacute;ticos para clientes importantes del sector de lujo.
    									<?php /**Programaci&oacute;n Orientada a Objetos, Webservices, aplicaciones Android & iOS, software a la medida.*/ ?>
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#consultoria_procesos" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#consultoria_procesos').show(); animar_procesos();*/ ?>">
    								
    								<div class="titulo_servicios">
    									Aplicaciones<br />Android
    								</div>
    								<div class="descripcion_servicios">
    									Interfaces elaboradas oriendas a la experiencia del usuario UX con interfaces de lujo UI, programadas en Kotlin o Java.
    									<?php /**
    									An&aacute;lisis y gesti&oacute;n de recursos.<br />
    									Manejo y control de almac&eacute;n.<br />
    									Consultoria Integral de Mercadotecnia
    									*/ ?>
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Aplicaciones<br />iOS
    								</div>
    								<div class="descripcion_servicios">
    									iOS es el sector de lujo en su m&acute;ximo nivel y lo atendemos como se merece, las programamos en Swift u Objective-C.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Comercio<br />Electr&oacute;nico
    								</div>
    								<div class="descripcion_servicios">
    									Ya sea por medio de un Magento, WooCommerce o un desarrollo a la medida con conexiones a las entidades bancarias &iexcl;lo hacemos!
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Sistemas a<br />la medida
    								</div>
    								<div class="descripcion_servicios">
    									Nuestro Core Business, es lo que hacemos y todos nuestros desarrollos llevan nuestro empe&ntilde;o, cari&ntilde;o y dedicaci&oacute;n.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Mundo<br />3D
    								</div>
    								<div class="descripcion_servicios">
    									Un concepto propio y original, para satisfacer necesidades que engloban interacci&oacute;n humana haci&eacute;ndolo como videojuego.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Realidad<br />Aumentada
    								</div>
    								<div class="descripcion_servicios">
    									La capidad de extender las posibilidades con modelados 3d es extraordinaria y de esta manera generar propuestas innovadoras.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Recorridos<br />Virtuales
    								</div>
    								<div class="descripcion_servicios">
    									Ya sean por medio de im&aacute;genes 360, videos 360 o Mundos 3d, lo realizamos para navegadores web & mobile.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Trivias y<br />Concursos
    								</div>
    								<div class="descripcion_servicios">
    									Imprescindibles para las empresas para generar bases de datos de sus clientes, as&iacute; como programas de Loyalty.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Interactivos<br />
    								</div>
    								<div class="descripcion_servicios">
    									Ya sea para activaciones o ideas realmente revolucionarias que involucr&aacute;n conceptualizaci&oacute;n y desarrollo.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									E-learning<br />
    								</div>
    								<div class="descripcion_servicios">
    									Adecuamos tu modelo de ense&ntilde;anza en interfaces din&aacute;micas de acuerdo a tus motivos organizacionales.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Software<br />Especializado
    								</div>
    								<div class="descripcion_servicios">
    									Desarrollamos plataformas en AngularJS, Angular versi&oacute;n 2 a la 8, React, VueJS, as&iacute; como otros frameworks.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#graphic_design" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								
    								<div class="titulo_servicios">
    									Banca<br />
    								</div>
    								<div class="descripcion_servicios">
    									Desarrollos de programaci&oacute;n asincrona o reactiva, as&iacute; como arquitecturas MVC, MVP, MVVM, consumiendo REST o SOAP.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Internet de<br />las Cosas (IOT)
    								</div>
    								<div class="descripcion_servicios">
    									Cuando es necesario complementar las interacciones con el mundo f&iacute;sico, tal es el caso de sensores, motores, luces, etc.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="<?php /*$('#sitio_web').hide(); $('#asistencia_legal').show();*/?>">
    								<div class="titulo_servicios">
    									Concepto<br />Creativo
    								</div>
    								<div class="descripcion_servicios">
    									Lo deje para el final debido a que todo comienza con un Gran Comienzo Creativo, es el comienzo para trazar el rumbo correcto.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    						<?php /**
							<div class="descripcion_seccion">
								Contamos con la experiencia y el equipo para el desarrollo de software sofisticado.
							</div>
							<div class="contenedor_servicios">
    							<a href="#desarrollo_software" class="servicios smooth" onclick="$('#sitio_web').hide(); $('#desarrollo_software').show();">
    								<div class="titulo_servicios">
    									Desarrollo<br />de software
    								</div>
    								<div class="descripcion_servicios">
    									Programaci&oacute;n Orientada a Objetos, Webservices, aplicaciones Android & iOS, software a la medida.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#consultoria_procesos" class="servicios smooth" onclick="$('#sitio_web').hide(); $('#consultoria_procesos').show(); animar_procesos();">
    								
    								<div class="titulo_servicios">
    									Consultoria<br />y Procesos
    								</div>
    								<div class="descripcion_servicios">
    									An&aacute;lisis y gesti&oacute;n de recursos.<br />
    									Manejo y control de almac&eacute;n.<br />
    									Consultoria Integral de Mercadotecnia
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#graphic_design" class="servicios smooth" onclick="$('#sitio_web').hide(); $('#graphic_design').show();">
    								
    								<div class="titulo_servicios">
    									Dise&ntilde;o<br />Gr&aacute;fico
    								</div>
    								<div class="descripcion_servicios">
    									Identidad visual, creaci&oacute;n de logotipos, Sitio Web, UX y UI, branding corporativo.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							<a href="#asistencia_legal" class="servicios smooth" onclick="$('#sitio_web').hide(); $('#asistencia_legal').show();">
    								<div class="titulo_servicios">
    									Asistencia<br />Legal
    								</div>
    								<div class="descripcion_servicios">
    									Registro de marca, creaci&oacute;n de contratos, conversi&oacute;n en franquicia, derechos de autor.
    								</div>
    								<div class="mas_informacion">
    									M&aacute;s informaci&oacute;n &gt;
    								</div>
    							</a>
    							 */?>
    							<div style="clear:both;"></div>
    						</div>
						</div>
						<div id="nosotros">
							<div>
								<div class="titulo_seccion">Casos de &eacute;xito</div>
								<div class="descripcion_seccion">
									Hemos realizado websites, sistemas administrativos personalizados, aplicaciones Android & iOS, trivias y concusos digitales para empresas reconocidas nacional e internacionalmente.
								</div>
								<script>
								function rollover_cliente(id){
									logo_id = "#cliente_logo_" + id;
									id_cliente = "#cliente_hover_" + id;
									$(logo_id).hide();
									$(id_cliente).show();
								}
								function rollout_cliente(id){
									logo_id = "#cliente_logo_" + id;
									id_cliente = "#cliente_hover_" + id;
									$(id_cliente).hide();
									$(logo_id).show();
								}
								</script>
								<script>
								function cargar_entrada(id){
									$.ajax({
										type: "POST",
										url:"cargar_blog.php",
										data: { id:id },
										success:function(data){
											$("#banner_contenido").html(data);
										}
									});
								}
								function cargar_cliente(id){
									$(".contenidos").hide();
									$("#detalle_cliente").show();
									$('html, body').stop().animate({
								        scrollTop: $("#detalle_cliente").offset().top
								    }, 1000);
									$.ajax({
										type: "POST",
										url:"cargar_cliente.php",
										data: { id:id },
										success:function(data){
											$("#contenido_cliente").html(data);
										}
									});
								}
								function cargar_blog(id){
									var cat_blog = "#categoria_blog_" + id;

									$('.categoria_blog').css({'background':'white'});
									$('.categoria_blog').css({'color':'#297fca'});
									$(cat_blog).css({'background':'#297fca'});
									$(cat_blog).css({'color':'white'});
									
									$('html, body').stop().animate({
								        scrollTop: $("#blog").offset().top
								    }, 1000);
									
									
									$.ajax({
										type: "POST",
										url:"cargar_categoria_blog.php",
										data: { id:id },
										success:function(data){
											$("#contenido_blog").html(data);
											comprobar_tamanio_scroll();
											
										}
									});
								}
								function iniciar_blog(id){
									var cat_blog = "#categoria_blog_" + id;

									$('.categoria_blog').css({'background':'white'});
									$('.categoria_blog').css({'color':'#297fca'});
									$(cat_blog).css({'background':'#297fca'});
									$(cat_blog).css({'color':'white'});
									
									$.ajax({
										type: "POST",
										url:"cargar_categoria_blog.php",
										data: { id:id },
										success:function(data){
											$("#contenido_blog").html(data);
											
										}
									});
								}
								function detalle_publicacion(id){
									$(".contenidos").hide();
									$("#detalle_publicacion").show();
									
									$.ajax({
										type: "POST",
										url:"cargar_publicacion.php",
										data: { id:id },
										success:function(data){
											$("#contenido_publicacion").html(data);
											comprobar_tamanio_scroll();
											
										}
									});
									$('html, body').stop().animate({
								        scrollTop: $("#detalle_publicacion").offset().top
								    }, 1000);	
								}
								</script>
								<div class="contenedor_marcas">
									<div class="cliente" onmouseover="rollover_cliente(1)" onmouseout="rollout_cliente(1)" onclick="cargar_cliente(19);">
										<img src="images/logos/corona.jpg" class="cliente_logo" style="" id="cliente_logo_1" alt="corona" />
										<div id="cliente_hover_1" class="cliente_hover">
											<div class="cliente_nombre">Corona</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Aplicaci&oacute;n Facebook</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(2)" onmouseout="rollout_cliente(2)" onclick="cargar_cliente(3);">
										<img src="images/logos/google.png" class="cliente_logo" style="" id="cliente_logo_2" alt="google" />
										<div id="cliente_hover_2" class="cliente_hover">
											<div class="cliente_nombre">Google</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Sitio Web<br />Google Developer Fest</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(3)" onmouseout="rollout_cliente(3)" onclick="cargar_cliente(33);">
										<img src="images/logos/la_cetto.png" class="cliente_logo" style="" id="cliente_logo_3" alt="la cetto" />
										<div id="cliente_hover_3" class="cliente_hover">
											<div class="cliente_nombre">Vinos L.A. Cetto</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Sitio Web</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(4)" onmouseout="rollout_cliente(4)" onclick="cargar_cliente(48);">
										<img src="images/logos/mi_gusto_es.jpg" class="cliente_logo" style="" id="cliente_logo_4" alt="mi gusto es" />
										<div id="cliente_hover_4" class="cliente_hover">
											<div class="cliente_nombre">Mi Gusto Es</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Promoci&oacute;n con<br />Fiesta Americana</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(5)" onmouseout="rollout_cliente(5)" onclick="cargar_cliente(20);">
										<img src="images/logos/mcdonalds.jpg" class="cliente_logo" style="" id="cliente_logo_5" alt="mcdonald's" />
										<div id="cliente_hover_5" class="cliente_hover">
											<div class="cliente_nombre">McDonald's</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Sitio Web</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(6)" onmouseout="rollout_cliente(6)" onclick="cargar_cliente(42);">
										<img src="images/logos/sanborns.png" class="cliente_logo" style="" id="cliente_logo_6" alt="sanborns" />
										<div id="cliente_hover_6" class="cliente_hover">
											<div class="cliente_nombre">Sanborns</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Internet Gratis<br />con Cisco Meraki</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(7)" onmouseout="rollout_cliente(7)" onclick="cargar_cliente(34);">
										<img src="images/logos/vina_real.png" class="cliente_logo" style="" id="cliente_logo_7" alt="vina real" />
										<div id="cliente_hover_7" class="cliente_hover">
											<div class="cliente_nombre">Vi&ntilde;a Real</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Sitio Web</div>
										</div>
									</div>
									<div class="cliente" onmouseover="rollover_cliente(8)" onmouseout="rollout_cliente(8)" onclick="cargar_cliente(35);">
										<img src="images/logos/hpnotiq.png" class="cliente_logo" style="" id="cliente_logo_8" alt="hpnotiq" />
										<div id="cliente_hover_8" class="cliente_hover">
											<div class="cliente_nombre">Hpnotiq</div>
											<div class="cliente_linea"></div>
											<div class="cliente_tipo">Sitio Web</div>
										</div>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
							<?php /**
							Especialistas en websites, sistemas administrativos personalizados, aplicaciones Android &amp; iOS.
							*/ ?>
						</div>
						<div id="contacto">
							<div class="titulo_seccion">Contacto</div>
							<div class="descripcion_seccion">
								Nuestro objetivo es que nos contactes para encontrar esa primera interacci&oacute;n,<br />de ah&iacute; haremos proyectos interesantes juntos.
							</div>
							
							<form method="post" action="" onchange="validarFormContacto()">
								<div>
								
									<div style="" class="contenedor_contacto">
										<?php /**
										<div id="maps_web">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.061723535475!2d-99.23422764943642!3d19.36647988685766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20058f869eea9%3A0xa460f258089cec3e!2sAv.+Sta.+Lucia+1120%2C+Colina+del+Sur%2C+01430+Ciudad+de+M%C3%A9xico%2C+CDMX!5e0!3m2!1ses!2smx!4v1521696819791" frameborder="0" style="border:0" allowfullscreen class="maps_size" title="maps"></iframe>
										</div>
										<div class="direccion">
											Av. Santa Luc&iacute;a 1120 Int. 204<br />
											Col. Colinas del Sur<br />
											Del. &Aacute;lvaro Obreg&oacute;n, C.P. 01430<br />
											Ciudad de M&eacute;xico, M&eacute;xico<br /><br />
											Tel&eacute;fono: 55 45 24 99 06<br />
											E-mail: hector@aguitech.com<br />
											<!-- 
											E-mail: hola@aguitech.com<br />
											-->
											Web: aguitech.com<br />
											<br />
										</div>
										*/ ?>
										<div class="direccion direccion_cafe">
											<div>
    											Representante legal<br />
    											H&eacute;ctor Fco. Aguilar N.<br /><br />
    											
    											Tel&eacute;fono: 55 45 24 99 06<br />
    											E-mail: hector@aguitech.com<br />
    											Web: aguitech.com<br /><br />
    											
    											Av. Santa Lucía 1120 Int. 204<br />
    											Col. Colinas del Sur<br />
    											Del. &Aacute;lvaro Obreg&oacute;n, C.P. 01430<br />
    											Ciudad de M&eacute;xico, M&eacute;xico<br /><br />
    											
											</div>
											<div>
												<img src="blue/images/imagenes_stock/Coffee_Cup.png" class="taza_cafe" />
											</div>
										</div>
										
										
										
									</div>
									<div style="" class="contenedor_contacto">
											<script>
											function validarFormContacto(){
												if($("#nombre").val() == ""){
													$("#nombre").focus();
												}
												if($("#telefono").val() == ""){
													$("#telefono").focus();
												}
												if($("#correo").val() == ""){
													$("#correo").focus();
												}
												if($("#mensaje").val() == ""){
													$("#mensaje").focus();
												}
												if($("#validate_checkbox").val() == ""){
													$("#validate_checkbox").focus();
												}
												if($("#nombre").val() != "" && $("#telefono").val() != "" && $("#correo").val() != "" && $("#mensaje").val() != "" && $("#validate_checkbox").val() != ""){
													$("#btn_send_contacto").prop('disabled', false);
												}
									        }
											</script>
    										<div>
    											<label class="label" >Nombre<br />
    												<input type="text" class="text_field" name="nombre" id="" placeholder="NOMBRE" />
    											</label>
    										</div>
    										<div>
    											<label class="label">Tel&eacute;fono<br />
    												<input type="text" class="text_field" name="telefono" id="" placeholder="TEL&Eacute;FONO" />
    											</label>
    										</div>
    										<div>
    											<label class="label">Correo<br />
    												<input type="text" class="text_field" name="correo" id="" placeholder="CORREO" />
    											</label>
    										</div>
    										<div style="padding-top:20px;">
    											<label class="label">Mensaje<br />
    												<textarea type="text" class="text_field" name="mensaje" id="" placeholder="MENSAJE" rows="4" ></textarea>
    											</label>
    										</div>
    										<div style="padding:10px 0px;">
        										<div class="g-recaptcha" data-sitekey="6LczsqkUAAAAAFwP-uSz42xJdb5oaT7Y2sOrU4ST" data-callback="correctCaptcha"></div>
        										<input type="hidden" value="" id="validate_checkbox" />
    										</div>
    										<div style="cursor:pointer;">
    											<input type="submit" class="text_field" name="" id="btn_send_contacto" value="ENVIAR" style="cursor:pointer;" disabled="disabled" onclick="validarFormContacto()" />
    										</div>
									</div>
									<div style="clear:both;"></div>
								</div>
								<br />
							</form>
							<?php /**
							<div id="maps_mobile">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.061723535475!2d-99.23422764943642!3d19.36647988685766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20058f869eea9%3A0xa460f258089cec3e!2sAv.+Sta.+Lucia+1120%2C+Colina+del+Sur%2C+01430+Ciudad+de+M%C3%A9xico%2C+CDMX!5e0!3m2!1ses!2smx!4v1521696819791" width="300" height="150" frameborder="0" style="border:0" allowfullscreen class="maps_size"></iframe>
							</div>
							
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.061723535475!2d-99.23422764943642!3d19.36647988685766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20058f869eea9%3A0xa460f258089cec3e!2sAv.+Sta.+Lucia+1120%2C+Colina+del+Sur%2C+01430+Ciudad+de+M%C3%A9xico%2C+CDMX!5e0!3m2!1ses!2smx!4v1521696819791" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
							 
							<iframe width="500" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=19.3664799,-99.2342223&amp;num=1&amp;sll=19.3664799,-99.2342223&amp;sspn=0.021048,0.032015&amp;hl=es&amp;ie=UTF8&amp;ll=19.3664799,-99.2342223&amp;spn=0.018782,0.038581&amp;z=14&amp;layer=c&amp;cbll=19.3664799,-99.2342223&amp;panoid=FLaz8Br0w7o5_5y5KvZVjA&amp;cbp=12,187.08,,0,1.37&amp;source=embed&amp;output=svembed"></iframe>
							
							<iframe width="500" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=19.401973,-99.059608&amp;num=1&amp;sll=19.410307,-99.065402&amp;sspn=0.021048,0.032015&amp;hl=es&amp;ie=UTF8&amp;ll=19.413335,-99.055309&amp;spn=0.018782,0.038581&amp;z=14&amp;layer=c&amp;cbll=19.402094,-99.060527&amp;panoid=FLaz8Br0w7o5_5y5KvZVjA&amp;cbp=12,187.08,,0,1.37&amp;source=embed&amp;output=svembed"></iframe>
							*/ ?>
							<br /><br />
							
						</div>
						<style>
						
						</style>
						<div id="blog">
							<div class="titulo_seccion">Blog</div>
							<div class="descripcion_seccion">
								Nuestros contenidos mas recientes
							</div>
							<div style="text-align:center;">
								<?php foreach($categorias as $categoria){ ?>
								<div id="categoria_blog_<?php echo $categoria['id_categoria']; ?>" class="categoria_blog" onclick="cargar_blog(<?php echo $categoria['id_categoria']; ?>);"><?php echo $categoria['categoria']; ?></div>
								<?php } ?>
								<div style="clear:both;"></div>
							</div>
							<div id="contenido_blog"></div>
							<div style="clear:both;"></div>
						</div>
						<?php /**
						<div class="footer">
								AGUITECH 2009 - <?php echo date("Y"); ?>
								<br />
								&copy; Todos los derechos reservados
								
							
						</div>
						*/ ?>
						<div class="footer">
							<div class="footer_contenedor">
							
    							<div class="footer_sitemap">
    								<div>Inicio</div>
    								<div>Servicios</div>
    								<div>Clientes</div>
    								<div>Contacto</div>
    							</div>
    							<div class="footer_solicitar">
    								<div>Solicita una sesi&oacute;n, conversemos de tu proyecto</div>
    								<div class="btn_solicitar">Solicitar</div>
    							</div>
							</div>
							<div class="footer_derechos">
								&copy; 2009 - <?php echo date("Y"); ?> Aguitech Todos los derechos reservados
								
								<?php /**
								AGUITECH 2009 - <?php echo date("Y"); ?>
								<br />
								&copy; Todos los derechos reservados
								*/ ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
		$( window ).resize(function() {
			//setTimeout(function(){
				var valor_border_left = $(window).width() + "px solid white";
				var valor_border_top = "100px solid transparent";
				 

				alert(valor_border_left);
				
				//$("#triangulo_inicio").css({"borderLeft":valor_border_left})
				$("#triangulo_inicio").css({"borderRight":valor_border_left, "borderTop":valor_border_top});

				//alert("res");
				
			//}, 1000);
			
		}

		function handleHeaderState() {
		    //var $win = $(this);
		    //$('.navbar').toggleClass('back', $win.scrollTop() > 60 && $win.width() > 639);
			var valor_border_left = $(window).width() + "px solid white";
			var valor_border_top = "100px solid transparent";
			 

			alert(valor_border_left);
			
			//$("#triangulo_inicio").css({"borderLeft":valor_border_left})
			$("#triangulo_inicio").css({"borderRight":valor_border_left, "borderTop":valor_border_top});


		    
		}

		$(window).on({
		    scroll: handleHeaderState, // on scroll
		    resize: handleHeaderState // on resize
		});

		handleHeaderState(); // on load

		/*
		function handleHeaderState() {
    	    var $win = $(this);
    	    $('.navbar').toggleClass('back', $win.scrollTop() > 60 && $win.width() > 639);
    	}
    
    	$(window).on({
    	    scroll: handleHeaderState, // on scroll
    	    resize: handleHeaderState // on resize
    	});
    
    	handleHeaderState(); // on load
		*/
		</script>
		<!-- Analytics Aguitech 2018 -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116916309-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		
		  gtag('config', 'UA-116916309-1');
		</script>
		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script>
        var correctCaptcha = function(response) {
            $("#validate_checkbox").val(response);
            validarFormContacto();
        };
        jQuery(document).ready(function() {
            $('.grecaptcha-badge').appendTo("body"); //fix recaptcha positioning to body  
        });
        $.initialize(".grecaptcha-badge", function() {
            $(this).appendTo("body"); //fix recaptcha positioning to body, even if it loads after the page  
        });
        
        </script>
        <style>
.gc-reset{
transform:scale(0.95) !important;
-webkit-transform:scale(0.95) !important;
transform-origin:0 0 !important;
-webkit-transform-origin:0 0 !important;
}
.grecaptcha-badge {
  line-height:50px !important;
}
        </style>
		<?php /**
		<!-- Hotjar Tracking Code for aguitech.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:908930,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
        */ ?>
	</body>
</html>