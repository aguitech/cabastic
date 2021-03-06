<script type="text/javascript">
function show_aguitechhide(){
	$("#main_aguitechhide").show("slow");
}
function toggle_aguitechhide(){
	$("#main_aguitechhide").toggle("slow");
	$("#sitesaguitechhide").hide();
}
function hide_aguitechhide(){
	$("#main_aguitechhide").hide("slow");
}
function show_sitesaguitechhide(){
	$("#sitesaguitechhide").show("slow");
}
function toggle_sitesaguitechhide(){
	$("#sitesaguitechhide").toggle("slow");
}
function hide_sitesaguitechhide(){
	$("#sitesaguitechhide").hide("slow");
}
</script>
<style type="text/css">
.main_aguitech{
	position:fixed;
	left:0;
	bottom:0;
}
.main_aguitechhide{
	position:fixed;
	left:100px;
	bottom:100px;
	/*
	width:100px;
	height:300px;
	*/
	background:orange;
	display:none;
}
.sitesaguitechhide{
	position:fixed;
	left:500px;
	bottom:100px;
	background:#163E71;
	color:white;
	display:none;
}
</style>

<div class="main_aguitech" id="main_aguitech">
	<a onmouseover="return toggle_aguitechhide()" onclick="return toggle_aguitechhide()" style="cursor:pointer;"><img src="http://aguitech.com/images/varios/angelindependencia.jpg" border="0" /></a>
</div>
<div class="main_aguitechhide" id="main_aguitechhide">
	<table border="1" style="background:gray">
		<tr>
			<td><img src="http://" style="width:100%"></td>
			<td><img src="http://" style="width:100%"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/visualize.png"></td>
			<td><a onmouseover="return toggle_sitesaguitechhide()">Mis Sitios</a></td>
		</tr>
		<tr>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/hi5.png"></td>
			<td><img src="http://" style="width:100%"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/msn.png"></td>
			<td>SoloAntro</td>
		</tr>
		<tr>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/facebook.png"></td>
			<td><img src="http://" style="width:100%"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/vimeo.png"></td>
			<td>Aguitech BlogSite</td>
		</tr>
		<tr>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/twitter.png"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/linkedin.png"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/rss.png"></td>
			<td>Héctor Aguilar BlogSite</td>
		</tr>
		<tr>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/myspace.png"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/lastfm.png"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/aol.png"></td>
			<td>Pensamientos y Reflexiones</td>
		</tr>
		<tr>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/youtube.png"></td>
			<td><img src="http://" style="width:100%"></td>
			<td><img src="http://hector-aguilar.com/images/utiles/iconos/picasa.png"></td>
			<td>10me</td>
		</tr>
		<tr>
			<td colspan="4">
				<form action=" http://aguitech.com/search.php" id="cse-search-box">
				  <div>
				    <input type="hidden" name="cx" value="018230516843689654267:us6wjb4j5wc" />
				    <input type="hidden" name="cof" value="FORID:10" />
				    <input type="hidden" name="ie" value="UTF-8" />
				    <input type="text" name="q" size="31" />
				    <input type="submit" name="sa" value="Buscar" />
				  </div>
				</form>
				<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=es"></script>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size:11px;"><b>hector@aguitech.com | contacto@hector-aguilar.com</b></td>
		</tr>
	</table>
</div>
<div id="sitesaguitechhide" class="sitesaguitechhide">
	<table border="1">
		<tr>
			<td><img src="http://hector-aguilar.com/favicon.ico" /></td>
			<td>www.hector-aguilar.com</td>
		</tr>
		<tr>
			<td><img src="http://aguitech.com/favicon.ico" /></td>
			<td>www.aguitech.com</td>
		</tr>
		<tr>
			<td><img src="http://soloantro.com/favicon.ico" /></td>
			<td>SoloAntro.com</td>
		</tr>
		<tr>
			<td><img src="http://solocondesa.com/favicon.ico" /></td>
			<td>SoloCondesa.com</td>
		</tr>
		<tr>
			<td><img src="http://solocondesa.com/favicon.ico" /></td>
			<td>SoloPolanco.com</td>
		</tr>
		<tr>
			<td><img src="http://solocondesa.com/favicon.ico" /></td>
			<td>SoloSatelite.com</td>
		</tr>
		<tr>
			<td><img src="http://solocondesa.com/favicon.ico" /></td>
			<td>SoloAguascalientes.com</td>
		</tr>
		<tr>
			<td><img src="http://solocondesa.com/favicon.ico" /></td>
			<td>SoloAguascalientes.com</td>
		</tr>
	</table>
</div>