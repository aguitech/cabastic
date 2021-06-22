<?php
function test ($sting_val){
    $length_val = strlen($sting_val);
    
    $new_str_inverse = "";
    for($i=$length_val; $i>=0; $i--){
        
        
        
        $new_str_inverse .= $sting_val[$i];
    }
    if($new_str_inverse == $sting_val){
        echo "TRUE";
        return true;
    }else{
        echo "FALSE";
        return false;
    }
    
    
}
if($_GET["search"] != ""){
    echo test($_GET["search"]);
    
}
?>
<form action="" method="GET">

	<input type="text" name="search" value="<?php if($_GET["search"] != ""){ echo $_GET["search"]; }?>" />
	
	<input type="submit" value="Search pallindrome" />
</form>