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
	<title>Modifical Perfil</title>
</head>
<?php 
	//inicio de sesion

	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['user'];
	$codigo = $usuario['codigo'];
	$sql = "SELECT * FROM persona WHERE codigo='$codigo'";
	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);
	if(isset($_SESSION['username'])){ 
		$codigo = $reg['codigo'];
		$nombre = $reg['nombre'];
		$apep = $reg['apellidoP'];
		$apem = $reg['apellidoM'];
		$correo = $reg['email'];
		$telefono = $reg['telefono'];
		$division = $reg['division'];
		$escolaridad = $reg['escolaridad'];
		$chance = false;
		if(isset($_POST['guardar'])){
			$reg = mysqli_fetch_array($resultado);
			//Seleccionar nuevos valores al presionar confirmar
			//nombre
			if($_POST['nombre']==""){
				$nombre = $reg['nombre'];
			}else{
				$nombre = $_POST['nombre'];
			}
			//apellido paterno
			if($_POST['apellidop']==""){
				$apep = $reg['apellidoP'];
			}else{
				$apep = $_POST['apellidop'];
			}
			//apellido materno
			if($_POST['apellidom']==""){
				$apem = $reg['apellidoM'];
			}else{
				$apem = $_POST['apellidom'];
			}
			//Correo
			if($_POST['correo']==""){
				$correo = $reg['email'];
			}else{
				$correo = $_POST['correo'];
			}
			//telefono
			if($_POST['telefono']==""){
				$telefono = $reg['telefono'];
			}else{
				$telefono = $_POST['telefono'];
			}
			//division
			if($_POST['division']==""){
				$division = $reg['division'];
			}else{
				$division = $_POST['division'];
			}
			//escolaridad
			if($_POST['escolaridad']==""){
				$escolaridad = $reg['escolaridad'];
			}else{
				$escolaridad = $_POST['escolaridad'];
			}

			$sql = "UPDATE persona SET nombre='$nombre', apellidoP='$apep', apellidoM='$apem', email='$correo', telefono='$telefono', division='$division', escolaridad='$escolaridad' WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);

			//Logs
			$cod = $codigo;
			$sql = "INSERT INTO logs (codigo_usuario, actividad, fecha) VALUES ('$cod', 'Modifico su perfil', NOW())";
			$resultado = mysqli_query($conexion, $sql);

			if(isset($_SESSION['integrante'])){
				header('Location: integrante.php');
			}
			else if(isset($_SESSION['administrador'])){
				header('Location: administrador.php');
			}
		}//llave del if guardar
		else if(isset($_POST['cancelar'])){
			header('Location: persona.php');
		}
?>
	<body>
		<header>
			<nav>
				<ul>
				</ul>
						
					<img id='logo' src='pictures/logo.png'>

				<ul>
					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>
		<section id='banner'>
		<br><br><br><br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!--Formulario de modificacion-->
					<form method="post">
						<table class="table table-dark table-bordered table-striped table-hover">
							<?php  
							echo "<tr><td><label>Nombre</label></td><td><input class='form-control type='text' name='nombre' value='$nombre' placeholder='Nuevo Nombre'></td></tr>";
							echo "<tr><td><label>Apellido Paterno</label></td><td><input class='form-control type='text' name='apellidop' value='$apep' placeholder='Nuevo Apellido Paterno'></td></tr>";
							echo "<tr><td><label>Apellido Materno</label></td><td><input class='form-control type='text' name='apellidom' value='$apem' placeholder='Nuevo Apellido Materno'></td></tr>";
							echo "<tr><td><label>Correo</label></td><td><input class='form-control type='text' name='correo' value='$correo' placeholder='Nuevo Correo'></td></tr>";
							echo "<tr><td><label>Telefono</label></td><td><input class='form-control type='text' name='telefono' value='$telefono' placeholder='Nuevo Telefono'></td></tr>";
							echo "<tr><td><label>Division</label></td><td><input class='form-control type='text' name='division' value='$division' placeholder='Nueva Division'></td></tr>";
							echo "<tr><td><label>Escolaridad</label></td><td><input class='form-control type='text' name='escolaridad' value='$escolaridad' placeholder='Nuevo Grado'></td></tr>";

							?>
							<tr><td class="text-warning">Se te pedira reingresar  al sistema</td><td><input class="btn btn-success" type="submit" name="guardar" value="Guardar">
							<input class="btn btn-success" type="submit" name="cancelar" value="Cancelar"></td></tr>
						</table>
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
		header('Location: login.php');
	}
?>
</html>