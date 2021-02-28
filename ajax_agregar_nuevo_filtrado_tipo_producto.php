<?php include("includes/includes.php"); ?>
<div class="form-row">

	<div class="form-group col-md-6" id="">
          <div>Tipo de producto</div>
          <?php 
          $tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
          ?>
         <select onchange="filtrar_categoria();" name="tipo_producto" id="tipo_producto" class="form-control">
        <?php foreach($tipos_producto as $tipo_producto): ?>
        <option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
        <?php endforeach; ?>
        </select>
	</div>



     <div class="form-group col-md-6">
	<div>Filtro por marca:</div>
	<?php 
     $qry_marca = "select * from ds_cat_marca order by Descripcion asc";
     $marcas = $obj->get_results($qry_marca);
     ?>
                            <select onchange="filtrar_marca(this.value);" id="marca" class="form-control">
     <option value="">Selecciona una marca</option>
    
     <?php foreach ($marcas as $marca): ?>
     <option value="<?php echo $marca->Id_Marca; ?>"><?php echo $marca->Descripcion; ?></option>
     <?php endforeach; ?>
     </select>
    </div>
    <?php /**
    <div class="form-group col-md-6" id="resultado_tipo_producto">
      <div>Tipo de producto</div>
      <?php 
      $tipos_producto = $obj->get_results("select * from ds_cat_tipo_producto order by Descripcion asc");
      ?>
     <select onchange="filtrar_categoria();" name="tipo_producto" id="tipo_producto" class="form-control">
    <?php foreach($tipos_producto as $tipo_producto): ?>
    <option value="<?php echo $tipo_producto->Id_Tipo_Producto; ?>" ><?php echo $tipo_producto->Descripcion; ?></option>
    <?php endforeach; ?>
    </select>
    </div>
    */ ?>
</div>