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
	<title>Modificar Usuario</title>
</head>
<?php 
	//Inicio de secion
	session_start();

	if(isset($_SESSION['username'])){
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];

		if(isset($_POST['agregar'])){
			$codigo = $_POST['codigo'];
			$username =  $_POST['username'];
			$password =  $_POST['password'];
			$nivel =  $_POST['nivel'];
			$nombre =  $_POST['nombre'];
			$apep =  $_POST['apellidop'];
			$apem =  $_POST['apellidom'];
			$correo =  $_POST['correo'];
			$telefono =  $_POST['telefono'];
			$division =  $_POST['division'];
			$escolaridad = $_POST['escolaridad'];

			$sql = "INSERT INTO usuario(codigo, username, password, nivel) VALUES('$codigo', '$username', '$password', '$nivel')";
			$resultado = mysqli_query($conexion, $sql);
			
			$sql = "INSERT INTO persona(codigo, nombre, apellidoP, apellidoM, email, telefono, division, escolaridad) VALUES('$codigo', '$nombre', '$apep', '$apem', '$correo', '$telefono', '$division', '$escolaridad')";
			$resultado = mysqli_query($conexion, $sql);
			
			header('Location: admin_usuario.php');

		}
?>
	<body>
		<header class="fixed-top">
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
		<section>
			<br><br><br><br>
				<div class="container">
				<form method="post">
					<table class="table table-success table-bordered table-striped table-hover">
						<tr><td>Codigo</td><td><input class="form-control" type="text" name="codigo" required></td></tr>
						<tr><td>Nombre de usuario</td><td><input class="form-control" type="text" name="username" required></td></tr>
						<tr><td>Contraseña</td><td><input class="form-control" type="password" name="password" required></td></tr>
						<tr><td>Nivel</td><td><select class="form-control" name="nivel" size="1">
												<option value = "1"> Colaborador </option>
												<option value = "2"> Integrante </option>
												<option value = "3"> Administrador </option>
						</select></td></tr>
						<tr><td>Nombre</td><td><input class="form-control" type="text" name="nombre" required></td></tr>
						<tr><td>Apellido Paterno</td><td><input class="form-control" type="text" name="apellidop" required></td></tr>
						<tr><td>Apellido Materno</td><td><input class="form-control" type="text" name="apellidom" required></td></tr>
						<tr><td>Correo</td><td><input class="form-control" type="text" name="correo" required></td></tr>
						<tr><td>Telefono</td><td><input class="form-control" type="text" name="telefono"></td></tr>
						<tr><td>Division</td><td><input class="form-control" type="text" name="division"></td></tr>
						<tr><td>Escolaridad</td><td><input class="form-control" type="text" name="escolaridad"></td></tr>
					</table>
						<div class="container" align="left"><input class="btn btn-outline-secondary" type="reset" name="" value="Limpiar"> <input class="btn btn-outline-success" type="submit" name="agregar"></div>
					
					<br><br>
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