<?php include("includes/includes.php");?>


<?php 
        						$qry_evento = "select * from ds_tbl_evento";
        						$eventos = $obj->get_results($qry_evento);
        						?>
                                <select name="id_evento" id="id_evento" class="form-control" <?php if($_GET["id_evento"]){ ?>readonly="readonly" disabled="disabled" <?php } ?>>
        							<?php /**
        							<option value="">Selecciona evento</option>
        							*/ ?>
        							<?php foreach ($eventos as $evento): ?>
        							<option value="<?php echo $evento->Id_Evento; ?>" <?php if($_GET["id_evento"] == $evento->Id_Evento){ ?>selected="selected"<?php } ?>><?php echo $evento->Descripcion; ?></option>
        							<?php endforeach; ?>
        						</select>