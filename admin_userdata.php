<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_style_administrador.css">
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<!--Titulo-->
	<title>Modifical Usuario</title>
</head>
<?php 
	//Inicio de secion
	session_start();

	$codigo = $_SESSION['dato'];
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];
	$sql = "SELECT * FROM usuario WHERE codigo='$codigo'";

	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);
	if(isset($_SESSION['username'])){ 
		$username = $reg['username'];
		$password = $reg['password'];
		$nivel = $reg['nivel'];
		$nombre = $reg['nombre'];
		$apep = $reg['apellidop'];
		$apem = $reg['apellidom'];
		$correo = $reg['email'];
		$telefono = $reg['telefono'];
		$division = $reg['division'];
		$escolaridad = $reg['escolaridad'];
		$chance = false;
		if(isset($_POST['guardar'])){
			$reg = mysqli_fetch_array($resultado);
			//Seleccionar nuevos valores al presionar confirmar
			//Multivalidaciones
			//nombre
			if($_POST['nombre']==""){
				$nombre = $reg['nombre'];
			}else{
				$nombre = $_POST['nombre'];
			}
			//apellido paterno
			if($_POST['apellidop']==""){
				$apep = $reg['apellidop'];
			}else{
				$apep = $_POST['apellidop'];
			}
			//apellido materno
			if($_POST['apellidom']==""){
				$apem = $reg['apellidom'];
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
			//username
			if($_POST['username']==""){
				$username = $reg['username'];
			}else{
				$username = $_POST['username'];
			}
			//password
			if($_POST['password']==""){
				$password= $reg['password'];
			}else{
				$password = $_POST['password'];
			}
			//nivel
			if($_POST['nivel']==""){
				$nivel = $reg['nivel'];
			}else{
				$nivel = $_POST['nivel'];
			}

			$sql = "UPDATE usuario SET nombre='$nombre', apellidop='$apep', apellidom='$apem', email='$correo', telefono='$telefono', division='$division', escolaridad='$escolaridad', username='$username', password='$password', nivel='$nivel' WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);

			//Logs
			$cod = $codigo;
			$sql = "INSERT INTO logs (codigo_usuario, actividad, fecha) VALUES ('$cod', 'Se modifico su perfil por medio de administrador', NOW())";
			$resultado = mysqli_query($conexion, $sql);

			if(($reg['nivel'] != $_POST['nivel']) && ($_POST['username'] == $_SESSION['username'])){
				header('Location: logout.php');
			}
			else{
				header('Location: admin_usuario.php');
			}


		}//llave del if guardar
		else if(isset($_POST['eliminar'])){
			$sql = "UPDATE usuario SET telefono='-', division='-', escolaridad='-', username='-', password='-', nivel='0' WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);

			//Logs
			$cod = $codigo;
			$sql = "INSERT INTO logs (codigo_usuario, actividad, fecha) VALUES ('$cod', 'Se elimino su perfil por medio de administrador', NOW())";
			$resultado = mysqli_query($conexion, $sql);
			header('Location: admin_usuario.php');
		}
		else if(isset($_POST['cancelar'])){
			header('Location: admin_usuario.php');
		}

?>
	<body>
		<body>
		<header>
			<nav>
				<ul>
					<a href='admin_usuario.php'><li>Atras</li></a>
				</ul>
						
					<img id='logo' src='pictures/logo.png'>

				<ul>
					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>
		<section id='banner'>
		<br><br><br><br>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!--Formulario de modificacion-->
					<form method="post">
						<table class="table table-dark table-bordered table-striped table-hover">
							<?php  
							echo "<tr><td><label>Nombre usuario</label></td><td><input class='form-control type='text' name='username' value='$username' placeholder='Nuevo Usuario'></td></tr>";
							echo "<tr><td><label>Contraseña</label></td><td><input class='form-control type='password' name='password' value='$password' placeholder='Nueva Contraseña'></td></tr>";
							echo "<tr><td><label>Nivel</label></td><td><input class='form-control type='text' name='nivel' value='$nivel' placeholder='Nuevo Nivel'></td></tr>";
							echo "<tr><td><label>Nombre</label></td><td><input class='form-control type='text' name='nombre' value='$nombre' placeholder='Nuevo Nombre'></td></tr>";
							echo "<tr><td><label>Apellido Paterno</label></td><td><input class='form-control type='text' name='apellidop' value='$apep' placeholder='Nuevo Apellido Paterno'></td></tr>";
							echo "<tr><td><label>Apellido Materno</label></td><td><input class='form-control type='text' name='apellidom' value='$apem' placeholder='Nuevo Apellido Materno'></td></tr>";
							echo "<tr><td><label>Correo</label></td><td><input class='form-control type='text' name='correo' value='$correo' placeholder='Nuevo Correo'></td></tr>";
							echo "<tr><td><label>Telefono</label></td><td><input class='form-control type='text' name='telefono' value='$telefono' placeholder='Nuevo Telefono'></td></tr>";
							echo "<tr><td><label>Division</label></td><td><input class='form-control type='text' name='division' value='$division' placeholder='Nueva Division'></td></tr>";
							echo "<tr><td><label>Escolaridad</label></td><td><input class='form-control type='text' name='escolaridad' value='$escolaridad' placeholder='Nuevo Grado'></td></tr>";

							?>
							<tr><td class="text-warning">Se cambiaran los datos del usuario</td><td><input class="btn btn-success" type="submit" name="guardar" value="Guardar"> <input class="btn btn-success" type="submit" name="eliminar" value="Eliminar">   
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