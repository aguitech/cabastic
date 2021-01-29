<?php
include("includes/includes.php");
include("common_files/sesion.php");

$id = $_POST["id"];
$id_producto = $id;


print_r($_POST);

echo "<hr />";

print_r($_SESSION);

echo "ID PRODUCTO:";
echo $id_producto . "<br />";

//exit();
echo "----";

echo "X--" . $id;



if($id_producto == 0){
    if(empty($_SESSION["cantidad_productos"])){
        echo 0;
    }else{
        echo "---- 2";
        echo $_SESSION["cantidad_productos"];
    }
}else{
    //echo "select * from ds_tbl_producto where Id_Producto = {$id}";
    echo "<hr />";
    echo "<hr />";
    
    //$producto = $obj->get_row("select * from ds_tbl_producto where Id_Producto = {$id}");
    $qry_producto = "select * from ds_tbl_producto where Id_Producto = '{$id}'";
    echo $qry_producto;
    $producto = $obj->get_row($qry_producto);
    //$producto = $obj->get_results($qry_producto);
    
    echo "PRODUCTO";
    print_r($producto);
    
    
    if($_SESSION["cantidad_productos"] == ""){
        $_SESSION["cantidad_productos"] = 1;
    }else{
        $_SESSION["cantidad_productos"]++;
    }
    
    echo "<hr />";
    print_r($_SESSION);
    
    for($i=0; $i<=$_SESSION["cantidad_productos"]; $i++){
        if($_SESSION["producto"][$i] == $id_producto){
            $_SESSION["producto"][$i] = $_POST["id"];
            $_SESSION["precio"][$i] = $producto->precio;
            $cantidad_productos = $_SESSION["cantidad"][$i];
            $_SESSION["cantidad"][$i] = $cantidad_productos+1;
            $en_carrito = "1";
        }else{
            
        }
        
    }
    
    
    if($en_carrito == "1"){
        
    }else{
        $_SESSION["producto"][] = $_POST["id"];
        $_SESSION["precio"][] = $producto->precio;
        $_SESSION["cantidad"][] = 1;
        
    }
}
?>




<?php if(empty($_SESSION) || $_SESSION["cantidad_productos"] == 0 || $_SESSION["cantidad_productos"] == ""){ ?>
	<div style="text-align:center; font-size:30px; color:#FBC7BC;">
		<img src="images/carrito_compra.png" style="height:25px;" /> El carrito de compras est&aacute; vac&iacute;o
	</div>
	<div style="text-align:center;">
		<div onclick="window.location='./#productos'" style="display:block; margin:20px 325px; width:350px; border:2px solid #FBC7BC; color:#FBC7BC; cursor:pointer;">
			Haz click aqu&iacute; para comprar productos
		</div>
	</div>
<?php }else{ ?>
	<form id = "paypal_checkout" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">
		
	
	
	<?php include("punto_venta_actual.php"); ?>
	
	</form>
<?php } ?>
