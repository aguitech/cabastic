<?php 
session_start();
if(empty($_SESSION["username"])){
	header("Location: ../index.php");
}
/**
alert("<?php //print_r(session_cache_expire()); ?>")
<?php //session_cache_expire(900); ?>
		
alert("<?php //print_r(session_cache_expire()); ?>")


<?php session_cache_expire(900); ?>

var window_logout = function(){
	window.location = "/login.php";
}
setTimeout(window_logout, 10000000);
<script>


</script>

*/


?>
