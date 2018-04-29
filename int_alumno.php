<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	//<link rel="stylesheet" href="css/index_style_administrador.css">
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<!--Titulo-->
	<title>Control de Alumnos</title>
</head>

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
	else if(isset($_SESSION['colaborador'])){
		header('Location: index.php');
	}
	else if(isset($_SESSION['visitante'])){
		header('Location: index.php');
	}
		?>
		<?php  
	if(!isset($_SESSION['visitante'])){
		header('Location: index.php');
	}
	if(isset($_SESSION['username']) ){ 
		//Conexion a BD
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$sql = "SELECT * FROM `alumno`";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);
		$alumno = $reg['idAlumno'];

		if(isset($_POST['seleccionar'])){
			$sql = "SELECT * FROM alumno";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				if($reg['idAlumno'] == $_POST['codigo']){
					$_SESSION['dato'] = $_POST['codigo'];
					header('Location: int_alumnodata.php');
				}
			}
		}
		else if(isset($_POST['crear'])){
			header('Location: int_alumnoadd.php');
		}
		$sql = "SELECT * FROM alumno";
		$resultado = mysqli_query($conexion, $sql);
?>
	<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<?php
						if(isset($_SESSION['integrante'])){
							?>
								<a href='integrante.php'><li>Atras</li></a>
							<?php  
						}
						else if(isset($_SESSION['administrador'])){
							?>
								<a href='administrador.php'><li>Atras</li></a>
							<?php
						}
					?>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>

					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>

		<section id='banner'>
			<br><br><br><br>
			<div class="row">
				<div class="container col-xs-12 col-sm-12 col-md-8 col-lg-9">
					<table class="table table-dark table-bordered table-striped table-hover">
						<tr><th>Código</th><th>Nombre de Alumno</th><th>Carrera</th></tr>
						<?php 
							while($reg = mysqli_fetch_array($resultado)){
								$sql = "SELECT * FROM alumno";
								$resultado_p = mysqli_query($conexion, $sql);
								while ($alumno = mysqli_fetch_array($resultado_p)) {
									if($reg['idAlumno'] == $alumno['idAlumno']){
										echo "<tr><td>".$reg['idAlumno']."</td><td>".$alumno['nombreAlumno']." ".$alumno['apellidoP']." ".$alumno['apellidoM']."</td><td>".$reg['carrera']."</td></tr>";
									}
								}
							}//Llave del while
						?>
					</table>
				</div>
				<div class="container col-xs-12 col-sm-12 col-md-4 col-lg-3">
					<form method="post">
						<input class="btn btn-success" type="submit" name="crear" value="Agregar"><br><br><br><br>
					</form>
					<form method="post">
						<input class="form" type="text" name="codigo" required>
						<input class="btn btn-success" type="submit" name="seleccionar" value="Buscar">
						<p class="text-warning">Seleccione un codigo para operar con ese alumno</p>
					</form>
				</div>
			</div>
		</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
<?php }
	else{
		//header('Location: login.php');
	}

?>
</html>