
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<?php 
	session_start();

	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];

	//variables por URL
	$id = $_GET['nombre'];
	$tipo = $_GET['tipo'];

	if($tipo == 1){
		$sql = "SELECT * FROM produccion WHERE id='$id'";
		$resultado = mysqli_query($conexion, $sql);

		while($reg = mysqli_fetch_array($resultado)){
			$idpd = $reg['id'];
			$sql = "UPDATE produccion SET aprobacion = true WHERE id='$idpd'";
			$resultado = mysqli_query($conexion, $sql);
		}
	}
	if($tipo == 2){
		$sql = "SELECT * FROM proyecto WHERE id='$id'";
		$resultado = mysqli_query($conexion, $sql);

		while($reg = mysqli_fetch_array($resultado)){
			$idpd = $reg['id'];
			$sql = "UPDATE proyecto SET aprobacion = true WHERE id='$idpd'";
			$resultado = mysqli_query($conexion, $sql);
		}
	}
	
	header('Location: ../notificacion.php');
?>

<body>

</body>
</html>
