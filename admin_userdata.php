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

		$sql = "SELECT * FROM persona WHERE codigo='$codigo'";
		$resultado = mysqli_query($conexion, $sql);
		$persona = mysqli_fetch_array($resultado);

		$username = $reg['username'];
		$password = $reg['password'];
		$nivel = $reg['nivel'];
		$nombre = $persona['nombre'];
		$apep = $persona['apellidoP'];
		$apem = $persona['apellidoM'];
		$correo = $persona['email'];
		$telefono = $persona['telefono'];
		$division = $persona['division'];
		$escolaridad = $persona['escolaridad'];
		$chance = false;
		if(isset($_POST['guardar'])){
			$reg = mysqli_fetch_array($resultado);
			//Seleccionar nuevos valores al presionar confirmar
			//Multivalidaciones
			//nombre
			if($_POST['nombre']==""){
				$nombre = $persona['nombre'];
			}else{
				$nombre = $_POST['nombre'];
			}
			//apellido paterno
			if($_POST['apellidop']==""){
				$apep = $persona['apellidoP'];
			}else{
				$apep = $_POST['apellidop'];
			}
			//apellido materno
			if($_POST['apellidom']==""){
				$apem = $persona['apellidoM'];
			}else{
				$apem = $_POST['apellidom'];
			}
			//Correo
			if($_POST['correo']==""){
				$correo = $persona['email'];
			}else{
				$correo = $_POST['correo'];
			}
			//telefono
			if($_POST['telefono']==""){
				$telefono = $persona['telefono'];
			}else{
				$telefono = $_POST['telefono'];
			}
			//division
			if($_POST['division']==""){
				$division = $persona['division'];
			}else{
				$division = $_POST['division'];
			}
			//escolaridad
			if($_POST['escolaridad']==""){
				$escolaridad = $persona['escolaridad'];
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
			if($_POST['password']=="" || $_POST['password'] == " "){
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
			$persona = $_SESSION['persona'];
			$codigoadmin = $persona['codigo'];

			$sql = "SELECT * FROM usuario WHERE username = '$username'";
			$resultado = mysqli_query($conexion, $sql);
			$usuariosreg = mysqli_fetch_array($resultado);

			if($usuariosreg['codigo'] == $codigo || $usuariosreg['codigo'] == 0){
				$sql = "UPDATE persona SET nombre='$nombre', apellidoP='$apep', apellidoM='$apem', email='$correo', telefono='$telefono', division='$division', escolaridad='$escolaridad' WHERE codigo='$codigo'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "UPDATE usuario SET username='$username', password='$password', nivel='$nivel' WHERE codigo='$codigo'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Modificó el perfil de $username por medio del administrador', NOW())";
				$resultado = mysqli_query($conexion, $sql);

				if(($reg['nivel'] != $_POST['nivel']) && ($_POST['username'] == $_SESSION['username'])){
					header('Location: logout.php');
				}
				else{
					header('Location: admin_usuario.php');
				}
			}
			else{
				echo '<script language="JavaScript"> alert("Usuario ya existente, cambie el nombre de usuario"); </script>';
			}
			


		}//llave del if guardar
		else if(isset($_POST['eliminar'])){
			$sql = "DELETE FROM persona WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);

			$sql = "DELETE FROM usuario WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);

			//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó el perfil de $username por medio del administrador', NOW())";
				$resultado = mysqli_query($conexion, $sql);

			header('Location: admin_usuario.php');
		}
		else if(isset($_POST['cancelar'])){
			header('Location: admin_usuario.php');
		}

?>
	<body>
		<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<a href='admin_usuario.php'><li>Atrás</li></a>
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
							echo "<tr><td><label>Nombre usuario</label></td><td><input class='form-control type='text' name='username' value='$username' placeholder='Nuevo Usuario'></td></tr>";
							echo "<tr><td><label>Contraseña</label></td><td><input class='form-control' type='password' name='password' placeholder='Nueva Contraseña' value='$password'></td></tr>";
							echo "<tr><td>Nivel</td><td><select class='form-control' name='nivel' size='1'>
												<option value = '1' "; if($nivel == "1"){echo "selected";} echo "> Colaborador </option>
												<option value = '2' "; if($nivel == "2"){echo "selected";} echo "> Integrante </option>
												<option value = '3' "; if($nivel == "3"){echo "selected";} echo "> Administrador </option>
									</select></td></tr>";
							echo "<tr><td><label>Nombre</label></td><td><input class='form-control type='text' name='nombre' value='$nombre' placeholder='Nuevo Nombre'></td></tr>";
							echo "<tr><td><label>Apellido Paterno</label></td><td><input class='form-control type='text' name='apellidop' value='$apep' placeholder='Nuevo Apellido Paterno'></td></tr>";
							echo "<tr><td><label>Apellido Materno</label></td><td><input class='form-control type='text' name='apellidom' value='$apem' placeholder='Nuevo Apellido Materno'></td></tr>";
							echo "<tr><td><label>Correo</label></td><td><input class='form-control type='text' name='correo' value='$correo' placeholder='Nuevo Correo'></td></tr>";
							echo "<tr><td><label>Teléfono</label></td><td><input class='form-control type='number' name='telefono' value='$telefono'></td></tr>";
							echo "<tr><td><label>División</label></td><td><input class='form-control type='text' name='division' value='$division' placeholder='Nueva División'></td></tr>";
							echo "<tr><td><label>Escolaridad</label></td><td><input class='form-control type='text' name='escolaridad' value='$escolaridad' placeholder='Nuevo Grado'></td></tr>";

							?>
							</table>
						<div class="row">
							<div class="col-sm-12 col-md-6 col-lg-6 text-danger">Se cambiarán los datos del usuario</div>
							<div class="col-sm-12 col-md-6 col-lg-6">
								<input class="btn btn-outline-success" type="submit" name="guardar" value="Guardar"> 
								<input class="btn btn-outline-success" type="submit" name="eliminar" value="Eliminar">   
								<input class="btn btn-outline-success" type="submit" name="cancelar" value="Cancelar">
							</div>
						</div>
					</form>
					<br><br>
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