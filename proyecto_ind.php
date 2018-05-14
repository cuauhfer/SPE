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
	<title>Proyecto</title>
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

		$sql = "SELECT * FROM proyecto WHERE nombre='$var1'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){
	?>

	<section>
		<br><br><br><br>
		<div class="container" id="HTMLtoPDF">

			<div class="row jumbotron p-3 p-md-5 rounded bg-ligth rounded">
				<div class="col-md-4">
					<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="../pictures/proyecto.jfif" alt="Card image cap" width="200" height="200">
				</div>
	        	<div class="col-md-8 px-0">
			        <h3 class="text-primary display-4 font-italic"><?php echo $reg['nombre'];?></h3>
			        <?php  
			        	if($reg['aprobacion'] == true){
			        		echo '<span class="badge badge-success">Público</span>';
			        	}
			        	else if($reg['borrador'] == true){
			        		echo '<span class="badge badge-warning">Borrador</span>';
			        	}
			        	else if($reg['rechazo'] == true){
			        		echo '<span class="badge badge-danger">Rechazada</span>';
			        	}
			        	else{
			        		echo '<span class="badge badge-dark">En espera</span>';
			        	}
			        ?>
			        <div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
			        <div class="mb-1 text-muted">Fecha de inicio: <?php echo $reg['fechaInicio'] ?></div>
			        <div class="mb-1 text-muted">Fecha de termino: <?php echo $reg['fechaFin'] ?></div>
			        <div class="mb-1">Institución: <?php echo $reg['institucion']; ?></div>
			        <br>
					<div class="mb-1 text-muted">Descripción: <?php echo $reg['descripcion'] ?></div>
					<br>
					<div class="mb-1 text-primary text-center">Colaboradores</div>
					<br>
						<?php
							$idpr = $reg['id'];
							$autorpr = $reg['autor'];
							$sql = "SELECT * FROM personaproyecto WHERE idProyecto = '$idpr'";
							$resultado = mysqli_query($conexion, $sql);

							while($reg = mysqli_fetch_array($resultado)){
								if($reg['codigoPersona'] != $autorpr){
									?>
										<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
									<?php
								}
							}
						?>
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