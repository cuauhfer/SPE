<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<?php  
		//Inicio de secion
		session_start();

			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

			function nombre($codigo){
				$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
				$sql = "SELECT * FROM persona WHERE codigo = $codigo";
				$resultado = mysqli_query($conexion, $sql);
				$persona = mysqli_fetch_array($resultado);
				echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
			}

			if(isset($_SESSION['integrante'])){
				?>
				<link rel="stylesheet" href="../css/index_style_integrante.css">
				<?php  
			}
			else if(isset($_SESSION['administrador'])){
				?>
				<link rel="stylesheet" href="../css/index_style_administrador.css">
				<?php
			}
			else if(isset($_SESSION['colaborador']) || isset($_SESSION['visitante'])){
				?>
				<link rel="stylesheet" href="../css/index_style_home.css">
				<?php
			}
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="../pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='../js/script-form.js'></script>
	<script>
		function confirmar(){
			if(confirm("¿Estas seguro? \n Se te eliminara del sistema.")){
				return true;
			}
			return false;
		}
	</script>
	<!--Titulo-->
	<title>Linea de Innovación</title>
</head>
<body>
	<header class="fixed-top">
			<nav>
				<ul>
					<a href="javascript:window.history.go(-1);"><li>Volver</li></a>
				</ul>
						
					<img id='logo' src='../pictures/logo.png'>

				<ul>
					<?php
						if(isset($_SESSION['integrante'])){
					?>
						<a href='../integrante.php'><li>Principal</li></a>
					<?php  
					}
						else if(isset($_SESSION['administrador'])){
					?>
						<a href='../administrador.php'><li>Principal</li></a>
					<?php
						}
						else if(isset($_SESSION['colaborador'])){
					?>
						<a href='../colaborador.php'><li>Principal</li></a>
					<?php
						}
						else if(isset($_SESSION['visitante'])){
					?>
						<a href='../index.php'><li>Principal</li></a>
					<?php
						}
					?>
					<?php  
						if(!isset($_SESSION['visitante'])){
					?>
					<a href='../logout.php'><li>Salir</li></a>
					<?php  
						}
					?>
				</ul>
			</nav>
	</header>

	<?php 
		$var1 = $_GET['nombre'];
		$var2 = $_GET['autor']; 

		$sql = "SELECT * FROM lineainn WHERE id='$var1'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){
	?>

	<section>
		<br><br><br><br>
		<div class="container" id="HTMLtoPDF">

			<div class="row jumbotron p-3 p-md-5 rounded bg-ligth rounded">
				<div class="col-md-4">
					<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="../pictures/innovacion.jpg" alt="Card image cap" width="200" height="200">
				</div>
	        	<div class="col-md-8 px-0">
			        <h3 class="text-primary display-4 font-italic"><?php echo $reg['nombre'];?></h3>
			        <?php  
			        	if($reg['borrador'] == true){
			        		echo '<span class="badge badge-warning">Borrador</span>';
			        	}
			        	else{
			        		echo '<span class="badge badge-success">Público</span>';
			        	}
			        ?>
			        <div class="mb-1 text-muted">Creador: <?php echo nombre($reg['codigoPersona']); ?></div>
			        <div class="mb-1 text-muted">Campo: <?php echo $reg['campo'] ?></div>
		        </div>
	      	</div>
      	</div>
	</section>
	<?php 
		}
	?>
	<div class="container">
		<a class="btn btn-outline-success" onclick="HTMLtoPDF()">Guardar PDF</a>
		<br><br>
	</div>
	<script src="../assets/pdf/jspdf.js"></script>
	<script src="../assets/pdf/jquery-2.1.3.js"></script>
	<script src="../assets/pdf/pdfFromHTML.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>