<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<?php  
		//Inicio de secion
		session_start();
		if(isset($_SESSION['integrante'])){
			?>
			<link rel="stylesheet" href="css/index_style_integrante.css">
			<?php  
		}
		else if(isset($_SESSION['administrador'])){
			?>
			<link rel="stylesheet" href="css/index_style_administrador.css">
			<?php
		}
		else{
			?>
			<link rel="stylesheet" href="css/index_style_home.css">
			<?php
		}
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<script>
		function confirmar(){
			if(confirm("¿Estas seguro? \n Se te eliminara del sistema.")){
				return true;
			}
			return false;
		}
	</script>
	<!--Titulo-->
	<title>Estadísticas</title>
</head>
<?php
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$total = 0;

	function burbuja($array){
	    for($i=1;$i<count($array);$i++){
	        for($j=0;$j<count($array)-$i;$j++){
	            if($array[$j]<$array[$j+1]){
	                $k=$array[$j+1];
	                $array[$j+1]=$array[$j];
	                $array[$j]=$k;
	            }
	        }
	    }
	 
	    return $array;
	}
?>
<body>
	<header class="fixed-top">
		<nav>
			<ul>
			<?php
				if(isset($_SESSION['integrante'])){
			?>
				<a href='integrante.php'><li>Principal</li></a>
			<?php  
			}
				else if(isset($_SESSION['administrador'])){
			?>
				<a href='administrador.php'><li>Principal</li></a>
			<?php
				}
				else if(isset($_SESSION['colaborador'])){
			?>
				<a href='colaborador.php'><li>Principal</li></a>
			<?php
				}
				else{
					?>
					<a href='index.php'><li>Principal</li></a>
			<?php
				}
			?>
			</ul>
					
				<img id='logo' src='pictures/logo.png'>

			<ul>
				
			</ul>
		</nav>
	</header>
	<br><br><br><br>

	<div class="row">
	  	<div class="col-3">
	    	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	      		<a class="nav-link active btn-outline-success" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Todas las publicaciones</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" <?php if(!isset($_SESSION['administrador']) && !isset($_SESSION['integrante'])){
	      			echo " disabled";
	      		} ?>>Mis publicaciones</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Producción Académica</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Proyectos</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-direccion-tab" data-toggle="pill" href="#v-pills-direccion" role="tab" aria-controls="v-pills-direccion" aria-selected="false">Dirección individualizada</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-estadia-tab" data-toggle="pill" href="#v-pills-estadia" role="tab" aria-controls="v-pills-estadia" aria-selected="false">Estadía en empresa</a>
	      		<a class="nav-link btn-outline-success" id="v-pills-linea-tab" data-toggle="pill" href="#v-pills-linea" role="tab" aria-controls="v-pills-linea" aria-selected="false">Lineas de innovación</a>
	    	</div>
	 	</div>
	  	<div class="col-9" id="HTMLtoPDF">
	    	<div class="tab-content" id="v-pills-tabContent">
	      		<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
	      			<div class="col-9">
		      			<!--Tabla de publicaciones generales-->
						<?php  
							//Grafica 1 Publicaciones totales
							{
								$sql = "SELECT * FROM produccion WHERE aprobacion = true";
								$resultado = mysqli_query($conexion, $sql);
								$produccion1 = $resultado -> num_rows;

								$sql = "SELECT * FROM proyecto WHERE aprobacion = true";
								$resultado = mysqli_query($conexion, $sql);
								$proyecto1 = $resultado -> num_rows;

								$sql = "SELECT * FROM direccionind WHERE borrador = false";
								$resultado = mysqli_query($conexion, $sql);
								$direccion1 = $resultado -> num_rows;

								$sql = "SELECT * FROM estadia WHERE borrador = false";
								$resultado = mysqli_query($conexion, $sql);
								$estadia1 = $resultado -> num_rows;

								$sql = "SELECT * FROM lineainn WHERE borrador = false";
								$resultado = mysqli_query($conexion, $sql);
								$linea1 = $resultado -> num_rows;
							}
							//Grafica 2 Publicaciones personales
							{	
								$admin = $_SESSION['user'];
								$adminon = $admin['codigo'];

		      					$sql = "SELECT * FROM persona WHERE codigo = '$adminon'";
								$result = mysqli_query($conexion, $sql);
								$cont = 0;
								$persona_array = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM produccion WHERE aprobacion = true AND autor = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion2 = $resultado -> num_rows;

									$sql = "SELECT * FROM proyecto WHERE aprobacion = true AND autor = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$proyecto2 = $resultado -> num_rows;

									$sql = "SELECT * FROM direccionind WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$direccion2 = $resultado -> num_rows;

									$sql = "SELECT * FROM estadia WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$estadia2 = $resultado -> num_rows;

									$sql = "SELECT * FROM lineainn WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$linea2 = $resultado -> num_rows;

									$total2 = $proyecto2 + $produccion2 + $direccion2 + $estadia2 + $linea2;
								}
							}
							//Grafica 3 Producción académica
							{
								$sql = "SELECT * FROM persona WHERE nombre != 'administrador'";
								$result = mysqli_query($conexion, $sql);
								$arreglo_prod = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM produccion WHERE aprobacion = true AND autor = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion3 = $resultado -> num_rows;

									array_push($arreglo_prod, array($produccion3, $reg['nombre']));
								}
								
								$arreglo_prod = burbuja($arreglo_prod);
							}
							//Grafica 4 Proyectos
							{
								$sql = "SELECT * FROM persona WHERE nombre != 'administrador'";
								$result = mysqli_query($conexion, $sql);
								$arreglo_proy = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM proyecto WHERE aprobacion = true AND autor = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion4 = $resultado -> num_rows;

									array_push($arreglo_proy, array($produccion4, $reg['nombre']));
								}
								
								$arreglo_proy = burbuja($arreglo_proy);
							}
							//Grafica 5 Direcciones
							{
								$sql = "SELECT * FROM persona WHERE nombre != 'administrador'";
								$result = mysqli_query($conexion, $sql);
								$arreglo_dirc = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM direccionind WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion5 = $resultado -> num_rows;

									array_push($arreglo_dirc, array($produccion5, $reg['nombre']));
								}
								
								$arreglo_dirc = burbuja($arreglo_dirc);
							}
							//Grafica 6 Estadías
							{
								$sql = "SELECT * FROM persona WHERE nombre != 'administrador'";
								$result = mysqli_query($conexion, $sql);
								$arreglo_esta = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM estadia WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion6 = $resultado -> num_rows;

									array_push($arreglo_esta, array($produccion6, $reg['nombre']));
								}
								
								$arreglo_esta = burbuja($arreglo_esta);
							}
							//Grafica 7 Lineas
							{
								$sql = "SELECT * FROM persona WHERE nombre != 'administrador'";
								$result = mysqli_query($conexion, $sql);
								$arreglo_line = array();
								while($reg = mysqli_fetch_array($result)){
									$pers = $reg['codigo'];
									$sql = "SELECT * FROM lineainn WHERE borrador = false AND codigoPersona = '$pers'";
									$resultado = mysqli_query($conexion, $sql);
									$produccion7 = $resultado -> num_rows;

									array_push($arreglo_line, array($produccion7, $reg['nombre']));
								}
								
								$arreglo_line = burbuja($arreglo_line);
							}

						?>

						<script>
							window.onload = function() {
								var chart1 = new CanvasJS.Chart("chartContainer1", {
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									exportEnabled: true,
									animationEnabled: true,
									title: {
										text: "Publicaciones SPE"
									},
									data: [{
										type: "pie",
										startAngle: 25,
										toolTipContent: "<b>{label}</b>: {y}",
										showInLegend: "true",
										legendText: "{label}",
										indexLabelFontSize: 14,
										indexLabel: "{label} - {y}",
										dataPoints: [
											{ y: <?php echo $produccion1; ?>, label: "Producción académica" },
											{ y: <?php echo $proyecto1; ?>, label: "Proyectos" },
											{ y: <?php echo $direccion1; ?>, label: "Dirección Individualizada" },
											{ y: <?php echo $estadia1; ?>, label: "Estadia en empresas" },
											{ y: <?php echo $linea1 ?>, label: "Lineas de innovación" }
										]
									}]
								});
								chart1.render();

								var chart2 = new CanvasJS.Chart("chartContainer2", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Tus publicaciones"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "Producción académica", y: <?php echo $produccion2; ?> },
											{ label: "Proyectos", y: <?php echo $proyecto2; ?> },
											{ label: "Direcciones", y: <?php echo $direccion2; ?> },
											{ label: "Estadías", y: <?php echo $estadia2; ?> },
											{ label: "Lineas de innovación", y: <?php echo $linea2; ?> },
											{ label: "Total", y: <?php echo $total2; ?> }	
										]
									}]
								});
								chart2.render();

								var chart3 = new CanvasJS.Chart("chartContainer3", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Mas producciones académicas"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "<?php echo $arreglo_prod['0']['1']; ?>", y: <?php echo $arreglo_prod[0][0]; ?> },
											{ label: "<?php echo $arreglo_prod['1']['1']; ?>", y: <?php echo $arreglo_prod[1][0]; ?> },
											{ label: "<?php echo $arreglo_prod['2']['1']; ?>", y: <?php echo $arreglo_prod[2][0]; ?> },
											{ label: "<?php echo $arreglo_prod['3']['1']; ?>", y: <?php echo $arreglo_prod[3][0]; ?> },
											{ label: "<?php echo $arreglo_prod['4']['1']; ?>", y: <?php echo $arreglo_prod[4][0]; ?> },
										]
									}]
								});
								chart3.render();

								var chart4 = new CanvasJS.Chart("chartContainer4", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Mas proyectos"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "<?php echo $arreglo_proy['0']['1']; ?>", y: <?php echo $arreglo_proy[0][0]; ?> },
											{ label: "<?php echo $arreglo_proy['1']['1']; ?>", y: <?php echo $arreglo_proy[1][0]; ?> },
											{ label: "<?php echo $arreglo_proy['2']['1']; ?>", y: <?php echo $arreglo_proy[2][0]; ?> },
											{ label: "<?php echo $arreglo_proy['3']['1']; ?>", y: <?php echo $arreglo_proy[3][0]; ?> },
											{ label: "<?php echo $arreglo_proy['4']['1']; ?>", y: <?php echo $arreglo_proy[4][0]; ?> },
										]
									}]
								});
								chart4.render();

								var chart5 = new CanvasJS.Chart("chartContainer5", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Mas direcciones"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "<?php echo $arreglo_dirc['0']['1']; ?>", y: <?php echo $arreglo_dirc[0][0]; ?> },
											{ label: "<?php echo $arreglo_dirc['1']['1']; ?>", y: <?php echo $arreglo_dirc[1][0]; ?> },
											{ label: "<?php echo $arreglo_dirc['2']['1']; ?>", y: <?php echo $arreglo_dirc[2][0]; ?> },
											{ label: "<?php echo $arreglo_dirc['3']['1']; ?>", y: <?php echo $arreglo_dirc[3][0]; ?> },
											{ label: "<?php echo $arreglo_dirc['4']['1']; ?>", y: <?php echo $arreglo_dirc[4][0]; ?> },
										]
									}]
								});
								chart5.render();

								var chart6 = new CanvasJS.Chart("chartContainer6", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Mas estadías"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "<?php echo $arreglo_esta['0']['1']; ?>", y: <?php echo $arreglo_esta[0][0]; ?> },
											{ label: "<?php echo $arreglo_esta['1']['1']; ?>", y: <?php echo $arreglo_esta[1][0]; ?> },
											{ label: "<?php echo $arreglo_esta['2']['1']; ?>", y: <?php echo $arreglo_esta[2][0]; ?> },
											{ label: "<?php echo $arreglo_esta['3']['1']; ?>", y: <?php echo $arreglo_esta[3][0]; ?> },
											{ label: "<?php echo $arreglo_esta['4']['1']; ?>", y: <?php echo $arreglo_esta[4][0]; ?> },
										]
									}]
								});
								chart6.render();

								var chart7 = new CanvasJS.Chart("chartContainer7", {
									exportEnabled: true,
									animationEnabled: true,
									theme: "light2", // "light1", "light2", "dark1", "dark2"
									title: {
										text: "Mas lineas de innovación"
									},
									subtitles: [{
										text: "",
										fontSize: 12
									}],
									axisY: {
										prefix: "",
										scaleBreaks: {
											customBreaks: [{
												startValue: 1,
												endValue: 1
											}]
										}
									},
									data: [{
										type: "column",
										yValueFormatString: "#",
										dataPoints: [
											{ label: "<?php echo $arreglo_line['0']['1']; ?>", y: <?php echo $arreglo_line[0][0]; ?> },
											{ label: "<?php echo $arreglo_line['1']['1']; ?>", y: <?php echo $arreglo_line[1][0]; ?> },
											{ label: "<?php echo $arreglo_line['2']['1']; ?>", y: <?php echo $arreglo_line[2][0]; ?> },
											{ label: "<?php echo $arreglo_line['3']['1']; ?>", y: <?php echo $arreglo_line[3][0]; ?> },
											{ label: "<?php echo $arreglo_line['4']['1']; ?>", y: <?php echo $arreglo_line[4][0]; ?> },
										]
									}]
								});
								chart7.render();

							}
						</script>

						<div id="chartContainer1" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
						<br>
					</div>
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
	      			<div class="col-9">
						<div id="chartContainer2" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>			
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
	      			<div class="col-9">
	      				<div id="chartContainer3" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
	      			<div class="col-9">
	      				<div id="chartContainer4" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-direccion" role="tabpanel" aria-labelledby="v-pills-direccion-tab">
	      			<div class="col-9">
	      				<div id="chartContainer5" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-estadia" role="tabpanel" aria-labelledby="v-pills-estadia-tab">
	      			<div class="col-9">
	      				<div id="chartContainer6" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>
	      		</div>

	      		<div class="tab-pane fade" id="v-pills-linea" role="tabpanel" aria-labelledby="v-pills-linea-tab">
	      			<div class="col-9">
	      				<div id="chartContainer7" style="height: 500px; max-width: 1200px; margin: 0px auto;"></div>
	      			</div>
	      		</div>

	    	</div>
	  	</div>
	</div>

	<script src="assets/pdf/jspdf.js"></script>
	<script src="assets/pdf/jquery-2.1.3.js"></script>
	<script src="assets/pdf/pdfFromHTML.js"></script>
	<script src="assets/script/canvasjs.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>