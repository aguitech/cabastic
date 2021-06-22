<?php
include("includes/includes.php");
if($_POST["id"] != ""){
    $id = $_POST["id"];
    $qry_id = "select * from ds_cat_color where Id_Color = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
}

$marcas = $obj->get_results("select * from ds_cat_marca order by Descripcion asc");

//ds_cat_talla
$tallas = $obj->get_results("select * from ds_cat_talla order by Descripcion asc");

$colores = $obj->get_results("select * from ds_cat_color order by Descripcion asc");


$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");

$sustancias = $obj->get_results("select * from ds_cat_tipo_sustancia order by Descripcion asc");

$generos = $obj->get_results("select * from ds_cat_genero order by Descripcion asc");

//ds_cat_tipo_mercado
$tipos_mercado = $obj->get_results("select * from ds_cat_tipo_mercado order by Descripcion asc");

$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");

?>

<div style="width:100%; padding:0 10%;" class="content_form_crear">
<form id="" method="post" action="?" enctype="multipart/form-data">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
        	</div>
    	</div>
    </div>
    <input type="hidden" name="editar" value="<?php echo $resultado->Id_Color; ?>" />
    <div>
    <h3><?php if($_POST["id"] != ""): echo "Actualizar"; else: echo "Crear"; endif; ?> producto</h3>
    <?php /**
    <input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
    <input type="text" placeholder="Nota" name="nota" id="nota" value="<?php echo $resultado->nota; ?>" />
    
    <textarea name="nota" id="nota"><?php echo $resultado->nota; ?></textarea>
    */ ?>
    
    <style>
    .contenedor_agregar_titulo{
        display:flex; justify-content:space-between;
    }
    .btn_agregar_en_titulo{
    	background:red;
    	width:20px;
    	height:20px;
    	border-radius:100%;
    	display:flex;
    	align-items:center;
    	justify-content:center;
    	font-size:18px;
    	
    }
    </style>
    
			<div class="form-row">
                <div class="form-group col-md-6">
                 	<div>C&oacute;digo de barras del producto</div>
         		<input type="text" placeholder="C&oacute;digo de barras" name="codigo_barras" id="codigo_barras" value="" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Nombre del producto</div>
         			<input type="text" placeholder="Nombre del producto" name="nombre_producto" id="nombre_producto" value="" class="form-control" />
                </div>
            </div>
            <div class="form-row">
            	<div class="form-group col-md-12">
             		<div>Descripción del producto</div>
    				<input type="text" placeholder="Descripcion" name="Descripcion" id="Descripcion" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
            	</div>
            </div>
			<div class="form-row">
                <div class="form-group col-md-6">
                	<div style="" class="contenedor_agregar_titulo">
                		Sustancia del producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_sustancia').show();">add</i>
               		
                	</div>
                	<div style="display:none;" id="contenedor_agregar_sustancia">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_sustancia" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_sustancia();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="sustancia_producto" id="sustancia_producto" class="form-control">
               			<?php foreach($sustancias as $sustancia): ?>
               			<option value="<?php echo $sustancia->Id_Tipo_Sustancia; ?>" ><?php echo $sustancia->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Sustancia" name="" id="sustancia_producto" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
                	<div style="" class="contenedor_agregar_titulo">
                		Marca del producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_marca').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_marca">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_marca" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_marca();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	
               		<select name="marca" id="marca" class="form-control">
               			<?php foreach($marcas as $marca): ?>
               			<option value="<?php echo $marca->Id_Marca; ?>" ><?php echo $marca->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
               		<br />
					<input type="text" placeholder="Marca" name="marca" id="marca" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div style="" class="contenedor_agregar_titulo">
                		Tipo de producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_tipo_producto').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_tipo_producto">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_tipo_producto" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_tipo_producto();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="tipo_producto" id="tipo_producto" class="form-control" onchange="filtrar_tipo_producto(this.value)">
               			<?php foreach($tipos_producto as $tipo_producto): ?>
               			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de producto" name="tipo_producto" id="tipo_producto" value="" class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div style="" class="contenedor_agregar_titulo">
                		Categoría producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_categoria_producto').show();">add</i>
               		
                	</div>
               		<div style="display:none;" id="contenedor_agregar_categoria_producto">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_categoria_producto" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_categoria_producto();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
               		<div id="filtrar_tipo_producto">
               			<select name="categoria" id="categoria" class="form-control">
                   			<?php foreach($categorias_producto as $categoria_producto): ?>
                   			<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>"><?php echo $categoria_producto->Descripcion; ?></option>
                   			<?php endforeach; ?>
                   		</select>
               		</div>
               		
					<?php /**
					<input type="text" placeholder="Categor&iacute;a" name="categoria" id="categoria" value="" class="form-control" />
					*/ ?>
					
					
					
                </div>
                
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div style="" class="contenedor_agregar_titulo">
                		Talla
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_talla').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_talla">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_talla" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_talla();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	
               		<select name="talla" id="talla" class="form-control">
               			<?php foreach($tallas as $talla): ?>
               			<option value="<?php echo $talla->Id_Talla; ?>"><?php echo $talla->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Talla" name="talla" id="talla" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		
               		<div style="" class="contenedor_agregar_titulo">
                		Género
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_genero').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_genero">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_genero" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_genero();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
               		
               		<select name="genero" id="genero" class="form-control">
               			<?php foreach($generos as $genero): ?>
               			<option value="<?php echo $genero->Id_Genero; ?>"><?php echo $genero->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="G&eacute;nero" name="genero" id="genero" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                	
                	<div style="" class="contenedor_agregar_titulo">
                		Tipo de mercado
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_tipo_mercado').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_tipo_mercado">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_tipo_mercado" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_tipo_mercado();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="tipo_mercado" id="tipo_mercado" class="form-control">
               			<?php foreach($tipos_mercado as $tipo_mercado): ?>
               			<option value="<?php echo $tipo_mercado->Id_Tipo_Mercado; ?>" ><?php echo $tipo_mercado->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de mercado" name="tipo_mercado" id="tipo_mercado" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div style="" class="contenedor_agregar_titulo">
                		Color
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_color').show();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_color">
                		<input type="text" placeholder="Descripcion" name="Descripcion" id="descripcion_color" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_color();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
               		<select name="color" id="color" class="form-control">
               			<?php foreach($colores as $color): ?>
               			<option value="<?php echo $color->Id_Color; ?>"><?php echo $color->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
					<?php /**
					<input type="text" placeholder="Color" name="color" id="color" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Cantidad m&iacute;nima en almacen</div>
					<input type="text" placeholder="Cantidad m&iacute;nima en almacen" name="cantidad_minima" id="cantidad_minima" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Cantidad m&aacute;xima en almacen</div>
					<input type="text" placeholder="Cantidad m&aacute;xima" name="cantidad_maxima" id="cantidad_maxima" value=""  class="form-control" />

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Precio de venta mxn</div>
					<input type="text" placeholder="Precio de venta MXN" name="precio_venta" id="precio_venta" value=""  class="form-control" />
                </div>
                <div class="form-group col-md-6">
                	<div>Existencia actual</div>
					<input type="text" placeholder="Existencia acutal" name="cantidad_inventario" id="cantidad_inventario" value=""  class="form-control" />
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
               		<div>Imagen</div>
					<input type="file" name="imagen_producto" id="imagen_producto" value="<?php echo $resultado->Imagen_Producto; ?>" />

                </div>
            </div>
            <br />
            <div>
    			<div class="form-row">
                    <div class="form-group col-md-6">
                         &nbsp;
                    </div>
                    <div class="form-group col-md-6">
                     	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                    </div>
                </div>
    			
    		</div>
    		<br />

<?php /**










*/ ?>






</div>
</form>
</div> 