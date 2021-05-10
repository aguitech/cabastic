<?php include("includes/includes.php"); ?>
<?php session_start(); ?>
<?php 
$_SESSION["start"] = "true";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<script src="https://aguitech.com/js/jquery-3.3.1.js"></script>
		<style>
        body{
        	font-family:verdana;
        }
        </style>
	</head>
	<body>
		<div style="position:absolute; top:0; left:0 right:0; bottom:0;">
			<div style="width:100%; height:100%;">
				<div>
				
				</div>
			</div>
		</div>
		<div style="position:fixed; right:0; bottom:0; display:none;" id="robot1" class="robots">
			<div style="display:flex;">
				<div style="padding:10px; background:white; border:1px solid #A5A5A5; box-shadow:0 0 7px #DCDCDC; width:270px; margin-right:10px; margin-bottom:10px;">
					<div style="display:flex; width:100%; justify-content:space-between;">
						<div>
							<b>C&eacute;sar</b> de ZoomCar
						</div>
						<div>
							Justo ahora
						</div>
						
					</div>
					<div style="padding:10px 0;">
						<!-- &iquest;Puedo ayudarte? Te llamo ahora y hablamos, sin costo para ti.-->
						&iquest;Puedo ayudarte? &iquest;Si gustas te llamo en este instante o prefieres un whatsapp?
					</div>
					<button style="padding:7px; border-radius:5px; background:red; color:white; cursor:pointer;" onclick="$('.robots').hide(); $('#robot2').show();">
						Si, ll&aacute;mame
					</button>
					<!-- 
					<div style="padding:7px; border-radius:5px; background:red; color:white; cursor:pointer;" onclick="$('.robots').hide(); $('#robot2').show();">
						Si, ll&aacute;mame
					</div>
					-->
				</div>
				<div style="margin-right:15px;">
					<img src="views_online/images/profile.png" style="border-radius:100%; width:50px;" />
				</div>
			</div>
		</div>
		<style>
		.robot_texto{
			margin:10px;
			border:1px solid #A5A5A5;
			box-shadow:0 0 5px #A5A5A5;
			border-radius:3px;
			padding:7px;
		}
		.robot_accion{
			background:red;
			color:white;
			margin:10px;
			border-radius:3px;
			padding:7px;
			cursor:pointer;
			
		}
		.robotaccion_anterior{
			background:#e57070;
		}
		</style>
		<script>
		function restaurar_robot(){
			$('.robots').animate({width:'toggle', borderRight:'toggle'},350); $('#robot1').show('slow');
			$(".robotaccion1").prop("disabled", false);
			$(".robotaccion1").removeClass("robotaccion_anterior");
			/*$(".robotaccion1").removeAttr('disabled');*/

			
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_inicio.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").html(data);

					//$("#id").attr("onclick","new_function_name()");
					//$(".robotaccion1").attr("onclick","");

					//$(".robotaccion1").attr("disabled","disabled");
					//$(".robotaccion1").addClass("robotaccion_anterior");
					
				}
			});
		}
		function robot_experto(){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_experto.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});


					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
					/**
					$('#content_robot').stop().animate({
				        scrollTop: $("#ancla_robot").offset().top
				    }, 1000);
				    */
					
					
					//$("#id").attr("onclick","new_function_name()");
					//$(".robotaccion1").attr("onclick","");
					$(".robotaccion1").attr("disabled","disabled");
					$(".robotaccion1").addClass("robotaccion_anterior");
					
				}
			});
		}
		function robot_cotizacion_prueba_manejo(){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_cotizacion_prueba.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					$(".robotaccion1").attr("disabled","disabled");
					$(".robotaccion1").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_atencion_clientes(){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_atencion_clientes.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);



					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					$(".robotaccion1").attr("disabled","disabled");
					$(".robotaccion1").addClass("robotaccion_anterior");
				}
			});
		}

		function robot_obtener_cotizacion(){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});


					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion2").attr("disabled","disabled");
					$(".robotaccion2").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_cotizacion_modelo(id_marca){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_modelo.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:id_marca, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top))
					
					
					//alert($("#ancla_robot").position().top);

					//alert($("#ancla_robot").offset().top);

					current_height = current_height + $("#ancla_robot").offset().top;

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion3").attr("disabled","disabled");
					$(".robotaccion3").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_cotizacion_anio(id_modelo){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_anio.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { modelo:id_modelo },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top))
					current_height = current_height + $("#ancla_robot").position().top;
					
					//alert($("#ancla_robot").position().top);
					//alert($("#ancla_robot").offset().top);
					

					//alert($("#ancla_robot").position().top);

					//alert($("#ancla_robot").offset().top);

					current_height = current_height + $("#ancla_robot").offset().top;

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion4").attr("disabled","disabled");
					$(".robotaccion4").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_cotizacion_version(id_anio_modelo){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_version.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { anio_modelo:id_anio_modelo },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion5").attr("disabled","disabled");
					$(".robotaccion5").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_cotizacion_informacion(id_version){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_informacion.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { version:id_version },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion6").attr("disabled","disabled");
					$(".robotaccion6").addClass("robotaccion_anterior");
				}
			});
		}
		
		
		
		function robot_obtener_prueba_manejo(){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_prueba.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:val_page, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					
					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion2").attr("disabled","disabled");
					$(".robotaccion2").addClass("robotaccion_anterior");
				}
			});
		}


		function robot_obtener_prueba_modelo(id_marca){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_prueba_modelo.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { marca:id_marca, modelo:val_categoria },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top))
					
					
					//alert($("#ancla_robot").position().top);

					//alert($("#ancla_robot").offset().top);

					current_height = current_height + $("#ancla_robot").offset().top;

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion3").attr("disabled","disabled");
					$(".robotaccion3").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_prueba_anio(id_modelo){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_prueba_anio.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { modelo:id_modelo },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);


					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top))
					current_height = current_height + $("#ancla_robot").position().top;
					
					//alert($("#ancla_robot").position().top);
					//alert($("#ancla_robot").offset().top);
					

					//alert($("#ancla_robot").position().top);

					//alert($("#ancla_robot").offset().top);

					current_height = current_height + $("#ancla_robot").offset().top;

					$('#content_robot').stop().animate({
				        scrollTop: current_height
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion4").attr("disabled","disabled");
					$(".robotaccion4").addClass("robotaccion_anterior");
				}
			});
		}
		function robot_obtener_prueba_version(id_anio_modelo){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_prueba_version.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { anio_modelo:id_anio_modelo },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion5").attr("disabled","disabled");
					$(".robotaccion5").addClass("robotaccion_anterior");
				}
			});
		}

		function robot_obtener_prueba_informacion(id_version){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_informacion.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { version:id_version },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion6").attr("disabled","disabled");
					$(".robotaccion6").addClass("robotaccion_anterior");
				}
			});
		}

		function robot_obtener_prueba_fecha(id_version){
			var val_categoria = 0;
			var val_page = 0;
			$.ajax({
				type: "POST",
				url:"/ajax_robot_obtener_cotizacion_version.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { version:id_version },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion6").attr("disabled","disabled");
					$(".robotaccion6").addClass("robotaccion_anterior");
				}
			});
		}
		//solicitud_cotizacion
		function solicitud_cotizacion(){
			var val_categoria = 0;
			var val_page = 0;
			var val_email = $("#email").val();
			var val_nombre = $("#nombre").val();
			var val_telefono = $("#telefono").val();

			var val_modelo = $("#modelo").val();
			var val_anio_modelo = $("#anio_modelo").val();
			var val_version = $("#version").val();
			
			
			$.ajax({
				type: "POST",
				url:"/ajax_robot_solicitud_cotizacion.php",
				//data: { limit:val_limit, offset:val_offset },
				data: { nombre:val_nombre, email:val_email, telefono:val_telefono, modelo:val_modelo, anio_modelo:val_anio_modelo, version:val_version },
				success:function(data){
					//$("#resultado_votos_detalle").html(data);
					//$("#publicaciones_adicionales").html(data);
					//$("#publicaciones_adicionales").append(data);
					$("#robot_mensajeria").append(data);

					

					//alert($("#robot_mensajeria").height());
					
					//alert($("#robot_mensajeria").height());
					var current_height = $("#robot_mensajeria").height();

					$("#robot_mensajeria").css({"height":current_height});

					current_height = current_height + $("#ancla_robot").position().top;
					
					
					//alert(current_height);

					//alert(Math.abs($("#ancla_robot").position().top));

					//alert(Math.abs($("#ancla_robot").offset().top));


					//alert($("#robot_mensajeria").innerHeight());

					//alert($("#robot_mensajeria").outerHeight());
					
					$('#content_robot').stop().animate({
				        //scrollTop: current_height
						//scrollTop: $("#ancla_robot").offset().top
						scrollTop: current_height
						
				    }, 1000);
				    
					//$(".robotaccion2").attr("onclick","");
					$(".robotaccion6").attr("disabled","disabled");
					$(".robotaccion6").addClass("robotaccion_anterior");
				}
			});
		}
		</script>
		<div style="position:fixed; right:0; bottom:0; top:0; display:none;" id="robot2" class="robots">
			<div style="width:300px; height:100%; box-shadow:0 0 5px #A5A5A5; border-left:1px solid #A5A5A5;">
				<div style="background:black; color:white; width:100%; height:50px; display:flex; align-items:center; justify-content:center; cursor:pointer;" onclick="restaurar_robot()">
					SHOWROOM VIRTUAL
				</div>
				<div style="position:fixed; bottom:0; top:50px;">
    				<div id="content_robot" style="display:flex; /*flex-direction:column;*/ align-items:flex-end; height:100%;  overflow-y:auto;" >
    					<div id="robot_mensajeria" style="">
        					<div class="robot_texto">
                            	&iexcl;Hola!
                            </div>
                            <div class="robot_texto">
                            	Hablas con un experto para descubrir por qué los vehículos Mazda y Renault son la mejor opción para ti. Obtén ahora mismo una cotización o solicita una prueba de manejo.
                            </div>
                            <div class="robot_texto">
                            	Si ya eres cliente de Mazda o Renault obt&eacute;n un plus por tu lealtad.
                            </div>
                            <button class="robot_accion robotaccion1" onclick="robot_experto();">
                            	Hablar con un experto
                            </button>
                            <button class="robot_accion robotaccion1" onclick="robot_cotizacion_prueba_manejo();">
                            	Obtener una cotizaci&oacute;n o solicitar una prueba de manejo
                            </button>
                            <button class="robot_accion robotaccion1" onclick="robot_atencion_clientes();">
                            	Soy cliente Mazda o Renault y busco beneficios adicionales
                            </button>
        				</div>
        				<div id="ancla_robot"></div>
    				</div>
				</div>
				
			</div>
		</div>
		<script>
		$(document).ready(function (){
			setTimeout(function (){
				$(".robots").hide();
				$("#robot1").show("slow");
				
			}, 1000);
		});
		</script>
	</body>
</html>
