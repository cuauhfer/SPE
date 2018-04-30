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
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<!--Titulo-->
	<title>Modificar Alumno</title>
</head>
<?php 
	//Inicio de secion
	session_start();

	if(isset($_SESSION['username'])){
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];

		if(isset($_POST['agregar'])){
			$nombre =  $_POST['nombre'];
			$apep =  $_POST['apellidop'];
			$apem =  $_POST['apellidom'];
			$carrera =  $_POST['carrera'];

			$sql = "INSERT INTO alumno(nombreAlumno, apellidoP, apellidoM, carrera) VALUES('$nombre', '$apep', '$apem', '$carrera')";
			$resultado = mysqli_query($conexion, $sql);
		
			header('Location: int_alumno.php');

		}
?>
	<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<a href='int_alumno.php'><li>Atras</li></a>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>

					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>
		<section id="banner">
			<br><br><br>
				<div class="container">
				<form method="post">
					<table class="table table-dark table-bordered table-striped table-hover">
						<tr><td>Nombre</td><td><input class="form-control" type="text" name="nombre" required></td></tr>
						<tr><td>Apellido Paterno</td><td><input class="form-control" type="text" name="apellidop" required></td></tr>
						<tr><td>Apellido Materno</td><td><input class="form-control" type="text" name="apellidom" required></td></tr>
						<tr><td>Carrera</td><td><input class="form-control" type="text" name="carrera" required></td></tr>
						
						<tr><td><input class="btn btn-warning" type="reset" name=""></td><td><input class="btn btn-success" type="submit" name="agregar"></td></tr>
					</table>
				</form>
				</div>
		</section>
	</body>
<?php  
	}
	else{
		header('Location: login.php');
	}
?>
</html>