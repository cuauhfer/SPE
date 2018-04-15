<?php 
	session_start();


	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];
	$sql = "SELECT * FROM usuario WHERE username='$usuario'";
	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);

	//Logs
	$cod = $reg['codigo'];
	$sql = "INSERT INTO logs (codigo_usuario, actividad, fecha) VALUES ('$cod', 'Salio del sistema', NOW())";
	$resultado = mysqli_query($conexion, $sql);

	session_destroy();

	header('Location: login.php');
?>