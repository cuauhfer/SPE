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
	<title>Modifical Alumno</title>
</head>
<?php 
	//Inicio de secion
	session_start();

	$id = $_SESSION['dato'];
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

	if(isset($_SESSION['username'])){

		$sql = "SELECT * FROM alumno WHERE idAlumno='$id'";
		$resultado = mysqli_query($conexion, $sql);
		$alumno = mysqli_fetch_array($resultado);

		$id = $alumno['idAlumno'];
		$nombre = $alumno['nombreAlumno'];
		$apep = $alumno['apellidoP'];
		$apem = $alumno['apellidoM'];
		$carrera = $alumno['carrera'];
		//$chance = false;
		if(isset($_POST['guardar'])){
			$alumno = mysqli_fetch_array($resultado);
			//Seleccionar nuevos valores al presionar confirmar
			//Multivalidaciones
			//nombre
			if($_POST['nombreAlumno']==""){
				$nombre = $alumno['nombreAlumno'];
			}else{
				$nombre = $_POST['nombreAlumno'];
			}
			//apellido paterno
			if($_POST['apellidop']==""){
				$apep = $alumno['apellidoP'];
			}else{
				$apep = $_POST['apellidop'];
			}
			//apellido materno
			if($_POST['apellidom']==""){
				$apem = $alumno['apellidoM'];
			}else{
				$apem = $_POST['apellidom'];
			}
			//Carrera
			if($_POST['carrera']==""){
				$carrera = $alumno['Carrera'];
			}else{
				$carrera = $_POST['carrera'];
			}

			$sql = "UPDATE alumno SET nombreAlumno='$nombre', apellidoP='$apep', apellidoM='$apem', carrera='$carrera' WHERE idAlumno='$id'";
			$resultado = mysqli_query($conexion, $sql);

			header('Location: int_alumno.php');

		}//llave del if guardar
		else if(isset($_POST['eliminar'])){
			$sql = "DELETE FROM alumno WHERE idAlumno='$id'";
			$resultado = mysqli_query($conexion, $sql);
			header('Location: int_alumno.php');
		}
		else if(isset($_POST['cancelar'])){
			header('Location: int_alumno.php');
		}

?>
	<body>
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
		<section>
		<br><br><br><br>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!--Formulario de modificacion-->
					<form method="post">
						<table class="table table-success table-bordered table-striped table-hover">
							<?php  
							echo "<tr><td><label>Nombre</label></td><td><input class='form-control type='text' name='nombreAlumno' value='$nombre' placeholder='Nuevo Nombre'></td></tr>";
							echo "<tr><td><label>Apellido Paterno</label></td><td><input class='form-control type='text' name='apellidop' value='$apep' placeholder='Nuevo Apellido Paterno'></td></tr>";
							echo "<tr><td><label>Apellido Materno</label></td><td><input class='form-control type='text' name='apellidom' value='$apem' placeholder='Nuevo Apellido Materno'></td></tr>";
							echo "<tr><td><label>Carrera</label></td><td><input class='form-control type='text' name='carrera' value='$carrera' placeholder='Nueva Carrera'></td></tr>";
							

							?>
						</table>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 text-dark">Se cambiaran los datos del alumno</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<input class="btn btn-outline-success" type="submit" name="guardar" value="Guardar"> 
								<input class="btn btn-outline-success" type="submit" name="eliminar" value="Eliminar">   
								<input class="btn btn-outline-success" type="submit" name="cancelar" value="Cancelar">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
<?php  
	}
	else{
		header('Location: int_alumno.php');
	}
?>
</html>