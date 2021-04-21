<?php
include("includes/includes.php");
include("common_files/sesion.php");
$id_rol = $_SESSION["rol"];

if($_POST["id"] != ""){
    $id = $_POST["id"];
    //$qry_id = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = {$id}";
    //ds_tbl_cantidad_minima_producto (Id_Producto_Detalle,
    //ds_tbl_inventario_almacen (Id_Producto_Detalle,
    //left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    //left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    //left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle
    //
    //$qry_id = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = {$id}";
    //$qry_id = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = {$id}";
    $qry_id_detalle = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto where ds_tbl_producto.Id_Producto = {$id}";
    $resultado_detalle = $obj->get_row($qry_id_detalle);
    
    
    //$qry_id = "select * from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = {$id}";
    $qry_id = "select *, ds_tbl_precio_venta_producto.Dolar as precio_dolares, ds_tbl_costo_compra_producto.Dolar as costo_dolares from ds_tbl_producto left join ds_tbl_producto_detalle on ds_tbl_producto_detalle.Id_Producto = ds_tbl_producto.Id_Producto left join ds_tbl_cantidad_minima_producto on ds_tbl_cantidad_minima_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_inventario_almacen on ds_tbl_inventario_almacen.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_costo_compra_producto on ds_tbl_costo_compra_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle left join ds_tbl_precio_venta_producto on ds_tbl_precio_venta_producto.Id_Producto_Detalle = ds_tbl_producto_detalle.Id_Producto_Detalle where ds_tbl_producto.Id_Producto = {$id}";
    $resultado = $obj->get_row($qry_id);
    //print_r($resultado);
    
}

$tipo_cambio_dolar_val = $obj->get_row("select * from ds_cat_tipo_cambio where Id_Tipo_Cambio = 1");

$tipo_cambio_dolar = $tipo_cambio_dolar_val->Valor;






$marcas = $obj->get_results("select * from ds_cat_marca order by Descripcion asc");

//ds_cat_talla
$tallas = $obj->get_results("select * from ds_cat_talla order by Descripcion asc");

$colores = $obj->get_results("select * from ds_cat_color order by Descripcion asc");


$tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");

$sustancias = $obj->get_results("select * from ds_cat_tipo_sustancia order by Descripcion asc");

$generos = $obj->get_results("select * from ds_cat_genero order by Descripcion asc");

//ds_cat_tipo_mercado
$tipos_mercado = $obj->get_results("select * from ds_cat_tipo_mercado order by Descripcion asc");

//$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");
//$categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto group by Descripcion order by Descripcion asc");

if($resultado_detalle->Id_Producto_Detalle != ""){
    //print_r($resultado_detalle);
    
    $id_tipo_producto = $resultado_detalle->Id_Tipo_Producto;
    $qry_categorias_tipo_producto = "select * from ds_cat_categoria_producto where Id_Tipo_Producto = $id_tipo_producto order by Descripcion asc";
    
    $categorias_producto = $obj->get_results($qry_categorias_tipo_producto);
    
}else{
    
    
    $categorias_producto = $obj->get_results("select * from ds_cat_categoria_producto order by Descripcion asc");
    
}
//

$divisas = $obj->get_results("select * from ds_cat_tipo_cambio");

?>
<style>
.contenedor_dinamico_producto{
	padding:20px;
	background:#DCDCDC;
	margin:2px;
	border-radius:5px;
}
</style>
<div style="width:100%;" class="content_form_crear">
<form id="" method="post" action="?" enctype="multipart/form-data">
	<div class="card-header header-elements-inline">
    	<h5 class="card-title">&nbsp;</h5>
    	<div class="header-elements">
    		<div class="list-icons">
        		
        		<a class="list-icons-item" data-action="remove" onclick="cerrar_cargar()"></a>
        	</div>
    	</div>
    </div>
    <input type="hidden" name="editar" value="<?php echo $resultado->Id_Producto; ?>" />
    <input type="hidden" name="editar_detalle" value="<?php echo $resultado_detalle->Id_Producto_Detalle; ?>" />
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
    	background:#DCDCDC;
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
         		<input type="text" placeholder="C&oacute;digo de barras" name="codigo_barras" id="codigo_barras" value="<?php echo $resultado->Codigo_Barras; ?>" class="form-control" />
        
                </div>
                <div class="form-group col-md-6">
                 	<div>Nombre del producto</div>
         			<input type="text" placeholder="Nombre del producto" name="nombre_producto" id="nombre_producto" value="<?php echo $resultado->Nombre; ?>" class="form-control" />
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
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_sustancia').toggle();">add</i>
               		
                	</div>
                	<div style="display:none;" id="contenedor_agregar_sustancia" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Sustancia" id="descripcion_sustancia" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_sustancia();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="sustancia_producto" id="sustancia_producto" class="form-control">
                		<option value="0">Selecciona</option>
               			<?php foreach($sustancias as $sustancia): ?>
               			<option value="<?php echo $sustancia->Id_Tipo_Sustancia; ?>" <?php if($resultado->Id_Tipo_Sustancia == $sustancia->Id_Tipo_Sustancia){ ?>selected="selected"<?php } ?>><?php echo $sustancia->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Sustancia" name="" id="sustancia_producto" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
                	<div style="" class="contenedor_agregar_titulo">
                		Marca del producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_marca').toggle();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_marca" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Marca" id="descripcion_marca" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_marca();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	
               		<select name="marca" id="marca" class="form-control">
               			<option value="0">Selecciona</option>
               			<?php foreach($marcas as $marca): ?>
               			<option value="<?php echo $marca->Id_Marca; ?>" <?php if($resultado->Id_Marca == $marca->Id_Marca){ ?>selected="selected"<?php } ?>><?php echo $marca->Descripcion; ?></option>
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
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_tipo_producto').toggle();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_tipo_producto" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Tipo de producto" id="descripcion_tipo_producto" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_tipo_producto();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="tipo_producto" id="tipo_producto" class="form-control" onchange="filtrar_tipo_producto(this.value)">
               			<option value="0">Selecciona</option>
               			<?php foreach($tipos_producto as $tipo_producto): ?>
               			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" <?php if($resultado->Id_Tipo_Producto == $tipo_producto->Id_Tipo_Producto){ ?>selected="selected"<?php } ?>><?php echo $tipo_producto->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de producto" name="tipo_producto" id="tipo_producto" value="" class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div style="" class="contenedor_agregar_titulo">
                		Categoría producto
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_categoria_producto').toggle();">add</i>
               		
                	</div>
               		<div style="display:none;" id="contenedor_agregar_categoria_producto" class="contenedor_dinamico_producto">
                		<div>Tipo de producto</div>
                		<select name="tipo_producto_select" id="tipo_producto_select" class="form-control">
                   			<option value="0">Selecciona</option>
               				<?php foreach($tipos_producto as $tipo_producto): ?>
                   			<option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
                   			<?php endforeach; ?>
                   		</select>
                    	
                		<br />
                		<input type="text" placeholder="Categor&iacute;a de producto" id="descripcion_categoria_producto" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
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
               				<option value="0">Selecciona</option>
               				<?php foreach($categorias_producto as $categoria_producto): ?>
                   			<option value="<?php echo $categoria_producto->Id_Categoria_Producto; ?>" <?php if($resultado->Id_Categoria_Producto == $categoria_producto->Id_Categoria_Producto){ ?>selected="selected"<?php } ?>><?php echo $categoria_producto->Descripcion; ?></option>
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
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_talla').toggle();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_talla" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Talla" id="descripcion_talla" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_talla();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	
               		<select name="talla" id="talla" class="form-control">
               			<option value="0">Selecciona</option>
               			<?php foreach($tallas as $talla): ?>
               			<option value="<?php echo $talla->Id_Talla; ?>" <?php if($resultado->Id_Talla == $talla->Id_Talla){ ?>selected="selected"<?php } ?>><?php echo $talla->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
               		<?php /**
					<input type="text" placeholder="Talla" name="talla" id="talla" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		
               		<div style="" class="contenedor_agregar_titulo">
                		Género
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_genero').toggle();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_genero" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="G&eacute;nero" id="descripcion_genero" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_genero();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
               		
               		<select name="genero" id="genero" class="form-control">
               			<option value="0">Selecciona</option>
               			<?php foreach($generos as $genero): ?>
               			<option value="<?php echo $genero->Id_Genero; ?>" <?php if($resultado->Id_Genero == $genero->Id_Genero){ ?>selected="selected"<?php } ?>><?php echo $genero->Descripcion; ?></option>
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
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_tipo_mercado').toggle();">add</i>
               		
                	</div>
                	
                	<div style="display:none;" id="contenedor_agregar_tipo_mercado" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Tipo de mercado" id="descripcion_tipo_mercado" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_tipo_mercado();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
                	<select name="tipo_mercado" id="tipo_mercado" class="form-control">
                		<option value="0">Selecciona</option>
               			<?php foreach($tipos_mercado as $tipo_mercado): ?>
               			<option value="<?php echo $tipo_mercado->Id_Tipo_Mercado; ?>" <?php if($resultado->Id_Tipo_Mercado == $tipo_mercado->Id_Tipo_Mercado){ ?>selected="selected"<?php } ?>><?php echo $tipo_mercado->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
                	<?php /**
					<input type="text" placeholder="Tipo de mercado" name="tipo_mercado" id="tipo_mercado" value=""  class="form-control" />
					*/ ?>
                </div>
                <div class="form-group col-md-6">
               		<div style="" class="contenedor_agregar_titulo">
                		Color
                		<i class="material-icons right btn_agregar_en_titulo" onclick="$('#contenedor_agregar_color').toggle();">add</i>
               		</div>
                	
                	<div style="display:none;" id="contenedor_agregar_color" class="contenedor_dinamico_producto">
                		<input type="text" placeholder="Color" id="descripcion_color" value="<?php echo $resultado->Descripcion; ?>"  class="form-control" />
                		
                		<br />
                		<button class="btn waves-effect waves-light bg_aguitech" type="button" name="action" onclick="guardar_color();">GUARDAR <i class="material-icons right">send</i></button>
                		
                		
                		<?php /**
                		<div class="form-group col-md-6">
                         	<button class="btn waves-effect waves-light bg_aguitech" type="submit" name="action"><?php if($_POST["id"] != ""): ?>ACTUALIZAR<?php else: ?>AGREGAR<?php endif; ?> <i class="material-icons right">send</i></button>
                        </div>
                		*/ ?>
                	</div>
               		<select name="color" id="color" class="form-control">
               			<option value="0">Selecciona</option>
               			<?php foreach($colores as $color): ?>
               			<option value="<?php echo $color->Id_Color; ?>" <?php if($resultado->Id_Color == $color->Id_Color){ ?>selected="selected"<?php } ?>><?php echo $color->Descripcion; ?></option>
               			<?php endforeach; ?>
               		</select>
					<?php /**
					<input type="text" placeholder="Color" name="color" id="color" value=""  class="form-control" />
					*/ ?>
                </div>
            </div>
            <?php if($id_rol == 1 || $id_rol == 3 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7): ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Cantidad m&iacute;nima en almacen</div>
					<input type="text" placeholder="Cantidad m&iacute;nima en almacen" name="cantidad_minima" id="cantidad_minima" value="<?php echo $resultado->Cantidad_Minima; ?>" class="form-control" />
                </div>
                <div class="form-group col-md-6">
               		<div>Cantidad m&aacute;xima en almacen</div>
					<input type="text" placeholder="Cantidad m&aacute;xima" name="cantidad_maxima" id="cantidad_maxima" value="<?php echo $resultado->Cantidad_Maxima; ?>" class="form-control" />

                </div>
            </div>
            <?php endif; ?>
            <?php if($id_rol == 1 || $id_rol == 4 || $id_rol == 5): ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                	<div>Divisa Precio</div>
                	<select name="select_divisa_precio" id="select_divisa_precio" class="form-control">
                		<?php foreach($divisas as $divisa): ?>
                		<option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option>
                		<?php endforeach; ?>
                	</select>
					
                </div>
                <div class="form-group col-md-6">
               		<div>Costo</div>
					<input type="text" id="costo_compra" name="costo_compra" placeholder="" value="<?php echo $dolar_precio = $resultado->costo_dolares * $tipo_cambio_dolar; ?>" style=""  class="form-control" />
                </div>
            </div>
            <?php endif; ?>
            <div class="form-row">
            	<?php if($id_rol == 1 || $id_rol == 2 || $id_rol == 5): ?>
                <div class="form-group col-md-6">
                	<div>Divisa Costo</div>
                	<select name="select_divisa_costo" id="select_divisa_costo" class="form-control">
                		<?php foreach($divisas as $divisa): ?>
                		<option value="<?php echo $divisa->Id_Tipo_Cambio; ?>" <?php if($divisa->Id_Tipo_Cambio == 3): ?>selected="selected"<?php endif; ?>><?php echo $divisa->Descripcion; ?></option>
                		<?php endforeach; ?>
                	</select>
					
                </div>
                <div class="form-group col-md-6">
                	<div>Precio de venta mxn</div>
                	<?php 
                	//$tipo_cambio_dolar
                	//$tipo_cambio_dolar
                	
                	?>
                	
					<input type="text" placeholder="Precio de venta MXN" name="precio_venta" id="precio_venta" value="<?php echo $dolar_precio = $resultado->precio_dolares * $tipo_cambio_dolar; ?>"  class="form-control" />
                </div>
                <?php endif; ?>
            </div>
			<div class="form-row">
                <?php if($id_rol == 1 || $id_rol == 3 || $id_rol == 5 || $id_rol == 6 || $id_rol == 7): ?>
                <div class="form-group col-md-6">
                	<div>Existencia actual</div>
					<input type="text" placeholder="Existencia acutal" name="cantidad_inventario" id="cantidad_inventario" value="<?php echo $resultado->Cantidad_Inventario; ?>"  class="form-control" />
                </div>
                <?php endif; ?>
            </div>
            
            






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
.displaynone{
	display:none;
}
</style>
<?php /**
<div class="div_identificacion rel circle_foto valign-wrapper imgpreview1">
	<div class="thumbnail" style="display:none;">
		<img src="images/upload_photos.svg" alt="" srcset="" class="img1 portrait" style="">
	</div>
	<div class="ocultar_thumb">
        <img src="images/upload_photos.svg" alt="" srcset="" class="" style="width:40px;">
        <p>Arrastre la foto aqui o <span>navegar</span></p>
    </div>
    <input type="file" name="image" class="file1" onchange="previewFile(1)" />
    <i class="material-icons ico-edit-f pointer">create</i>
</div>
*/ ?>


            
            <?php if ($_POST["id"] != ""): ?>
			<?php 
			$id_search = $_POST["id"];
			
			$qry_imagen_thumb = "select * from ds_tbl_producto_imagen where Id_Producto = $id_search";
			
			$resultado_preview_img = $obj->get_row($qry_imagen_thumb);
			
			?>
			
			
			
			<div class="form-row">
                <div class="form-group col-md-6">
               		<div>Imagen</div>
               		<div class="div_identificacion rel circle_foto valign-wrapper imgpreview1 <?php if(isset($resultado_preview_img->Url_Imagen) && $resultado_preview_img->Url_Imagen != ""): echo "div_identificacion_clear"; else: echo ""; endif; ?>">
        				<div class="thumbnail" style="<?php if(isset($resultado_preview_img->Url_Imagen) && $resultado_preview_img->Url_Imagen != ""): echo ""; else: echo "display:none;"; endif; ?>">
                			<img src="<?php if(isset($resultado_preview_img->Url_Imagen) && $resultado_preview_img->Url_Imagen != ""): echo "images/productos/" . $resultado_preview_img->Url_Imagen; endif; ?>" alt="" srcset="" class="img1 portrait">
                		</div>
                    	<div class="ocultar_thumb <?php if(isset($resultado_preview_img->Url_Imagen) && $resultado_preview_img->Url_Imagen != ""): echo "displaynone"; else: echo ""; endif; ?>" >
                            <p>Arrastre la foto aqui o <span>navegar</span></p>
                        </div>
                        <input type="file" name="imagen_producto" id="imagen_producto" class="file1" onchange="previewFile(1)" />
                    </div>
               		
               		
                </div>
            </div>
            <?php else: ?>
            
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
                        <input type="file" name="imagen_producto" id="imagen_producto" class="file1" onchange="previewFile(1)" />
                        <?php /**
                        <i class="material-icons ico-edit-f pointer">create</i>
                        */ ?>
                    </div>
     <?php /**          
					<input type="file" name="imagen_producto" id="imagen_producto" value="<?php echo $resultado->Imagen_Producto; ?>" onchange="previewFile(1)" />
*/ ?>
                </div>
            </div>
            <?php endif; ?>
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