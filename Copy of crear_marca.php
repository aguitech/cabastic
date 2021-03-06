<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_marca where Id_Marca = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}
?>
<script>
function previewFile(id) {
	var img = ".img" + id;
	var thumb = ".thumbnail";
	var file = ".file" + id;
	var imgpreview = ".imgpreview" + id;
	
	var preview = document.querySelector(img);
	var file    = document.querySelector(file).files[0];
	
	var thumbnail = document.querySelector(thumb);
	
	var preview_selector = document.querySelector(imgpreview);
	
	var reader  = new FileReader();

	reader.onloadend = function () {
		document.querySelector(".thumbnail").style.display = "inline";
		document.querySelector(".ocultar_thumb").style.display = "none";
		
		
		document.querySelector(".div_identificacion").style.padding = "0px";
		document.querySelector(".div_identificacion").style.marginTop = "-10px";
		
		
		var img_url = reader.result;

		console.log("url");
		console.log(img_url);
	
		preview.src = img_url;
	}
	if (file) {
		reader.readAsDataURL(file);
	} else {
		preview.src = "";
	}
}
</script>
<style>
.thumbnail {
  position: relative;
  width: 120px;
  height: 120px;
  overflow: hidden;
	border-radius:100%;
}
.thumbnail img {
  position: absolute;
  left: 50%;
  top: 50%;
  height: 100%;
  width: auto;
  -webkit-transform: translate(-50%,-50%);
      -ms-transform: translate(-50%,-50%);
          transform: translate(-50%,-50%);
}
.thumbnail img.portrait {
  width: 100%;
  height: auto;
}


.div_identificacion {
    border: 1px dashed #9e9e9e;
	
    /*margin-top: 10px;*/
    padding: 20px 25px 10px 25px;
	
}
.div_identificacion_clear {
    border: 1px dashed #9e9e9e;
	
    /*margin-top: 10px;*/
    padding: 0px;
	
}

.div_identificacion img {
    background: transparent !important;
    display:  inline-block;
    vertical-align:  middle;
    height: 20px;
}

.div_identificacion p {
    display:  inline-block;
    vertical-align:  middle;
    font-size: 12px;
    margin-left: 10px;
    color: #767F90;
}

.div_identificacion p span{
    color: #1ECBC8;
}

.div_identificacion input {
    position:  absolute;
    z-index:  2;
    opacity:  0;
    cursor:  pointer;
    text-indent: -9999px;
    width:  100%;
    left:  0px;
    height:  100%;
    top: 0px;
}



.circle_foto{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: auto;
    text-align: center;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.circle_foto p{
    margin-left: 0 !important;
    font-size: 10px;
}

.circle_foto .ico-edit-f{
    background-color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    line-height: 25px;
    padding: 0 2px;
    font-size: 15px;
    border: 1px solid #767F90;
    right: -11px;
    position: absolute;
}
.valign-wrapper{
	display:flex;
}
</style>
<div style="width:100%;" class="content_form_crear">
	<form id="form_crear" method="post" action="?" enctype="multipart/form-data">
		<div class="card-header header-elements-inline">
        	<h5 class="card-title">&nbsp;</h5>
        	<div class="header-elements">
        		<div class="list-icons">
            		<!-- 
            		<a class="list-icons-item" data-action="collapse"></a>
            		<a class="list-icons-item" data-action="reload"></a>
            		-->
            		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
            	</div>
        	</div>
        </div>
		<input type="hidden" name="editar" value="<?php echo $resultado->Id_Marca; ?>" />
		<div>
			<h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> marca</h3>
			
			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>Marca</div>
             		<input type="text" placeholder="Marca" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>" class="form-control" />
			
                </div>
                <?php /**?>
                <div class="form-group col-md-6">
                 	<div>Imagen Producto</div>
         			<input type="file" name="Logo" id="Logo" value="<?php echo $resultado->Logo; ?>" />
			
                </div>
                */ ?>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
               		<div>Imagen</div>
               		<div class="div_identificacion rel circle_foto valign-wrapper imgpreview1">
                    	<div class="thumbnail" style="display:none;">
                    		<img src="images/upload_photos.svg" alt="" srcset="" class="img1 portrait" style="">
                    		
                    	</div>
                    	<div class="ocultar_thumb">
                            <?php /**
                            <img src="images/upload_photos.svg" alt="" srcset="" class="" style="width:40px;">
                            */ ?>
                            <p>Arrastre la foto aqui o <span>navegar</span></p>
                        </div>
                        <input type="file" name="imagen_marca" id="imagen_marca" class="file1" onchange="previewFile(1)" />
                        <?php /**
                        <i class="material-icons ico-edit-f pointer">create</i>
                        */ ?>
                    </div>
     <?php /**          
					<input type="file" name="imagen_producto" id="imagen_producto" value="<?php echo $resultado->Imagen_Producto; ?>" onchange="previewFile(1)" />
*/ ?>
                </div>
            </div>
			
		</div>
		<div>
			<div class="form-row">
                <div class="form-group col-md-6">
                     &nbsp;
                </div>
                <div class="form-group col-md-6">
                 	<button class="btn waves-effect waves-light bg_aguitech" type="button" onclick="validar_crear()" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                </div>
            </div>
			
		</div>
	</form>
</div>