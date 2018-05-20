<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/login_style.css">
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<!--Titulo-->
	<title>Ingreso</title>
</head>

<?php 
	//Inicio de secion
	session_start();
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

	//iniciar variables
	$usuario = "";
	$pwd = "";
	$error = "";

	//Procedimiento al presionar "Ingresar"
	if($_POST){

		//Recepción de variables ingresadas
		$usuario = $_POST['username'];
		$pwd = md5($_POST['password']);

		//Consulta a la base de datos
		$sql = "SELECT * FROM usuario WHERE username='$usuario' AND password='$pwd'";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado); 

		//Si la consulta coincide, cargará las páginas de administrador
		if(mysqli_num_rows($resultado) == 1){

			$_SESSION['username'] = $reg['username'];
			$_SESSION['user'] = $reg;

			//Logs
			$cod = $reg['codigo'];
			$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$cod', 'Ingresó al sistema', NOW())";
			$resultado = mysqli_query($conexion, $sql);

			if($reg['nivel'] == 2){
				$_SESSION['integrante'] = $reg['nivel'];
				header('Location: integrante.php');
			}
			else if($reg['nivel'] == 3){
				$_SESSION['administrador'] = $reg['nivel'];
				header('Location: administrador.php');
			}
			else if($reg['nivel'] == 1){
				$_SESSION['colaborador'] = $reg['nivel'];
				header('Location: colaborador.php');
			}
			$codigo = $reg['codigo'];

			$sql = "SELECT * FROM persona WHERE codigo='$codigo'";
			$resultado = mysqli_query($conexion, $sql);
			$reg = mysqli_fetch_array($resultado); 
			$_SESSION['persona'] = $reg;
		}else{
			echo '<script language="JavaScript"> alert("Datos Incorrectos"); </script>'; 
		}
	}

?>

<body>
    <form method="post">
    	<div align="center"><a href="index.php" title="Pagina Principal"><img src="pictures/logo.png" width="100" height="100"></a></div>
		<h3>Acceder al Sistema</h3>
		<input class="form-control" type="text" name="username" placeholder="Nombre de usuario" required>
		<input class="form-control" type="Password" name="password" placeholder="&#128272; Contraseña" required>
		<input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="Buscar" value="Ingresar">
	</form>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>