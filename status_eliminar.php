<?php 
	session_start();

	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];

	//variables por URL
	$id = $_GET['id'];
	$accion = $_GET['accion'];

	if($accion == "1"){
		$sql = "SELECT * FROM produccion WHERE id='$id'";
		$resultado = mysqli_query($conexion, $sql);

		while($reg = mysqli_fetch_array($resultado)){
			$idpd = $reg['id'];
			$sql = "UPDATE produccion SET borrador = true, aprobacion = false WHERE id='$idpd'";
			$resultado = mysqli_query($conexion, $sql);
		}

		header('Location: ../mis_publicaciones.php');
	}
	else if($accion == "0"){
		$sql = "SELECT * FROM produccion WHERE id = '$id'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){
			$idpd = $reg['id'];

			if($reg['tipoPublicacion'] == 1){
				$sql = "DELETE FROM articulo WHERE idProduccion='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
			else if($reg['tipoPublicacion'] == 2){
				$sql = "DELETE FROM informetec WHERE idProduccion='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
			else if($reg['tipoPublicacion'] == 3){
				$sql = "DELETE FROM manual WHERE idProduccion='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
			else if($reg['tipoPublicacion'] == 4){
				$sql = "DELETE FROM libro WHERE idProduccion='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}

			$sql = "DELETE FROM produccion WHERE id='$idpd'";
			$resultado = mysqli_query($conexion, $sql);

			header('Location: ../mis_publicaciones.php');
		}
	}
	else if($accion == "2"){
		$sql = "SELECT * FROM produccion WHERE id = '$id'";
		$resultado = mysqli_query($conexion, $sql);

		while($reg = mysqli_fetch_array($resultado)){
			$idpd = $reg['id'];
			$sql = "UPDATE produccion SET rechazo = true, aprobacion = false WHERE id='$idpd'";
			$resultado = mysqli_query($conexion, $sql);
		}
		header('Location: ../notificacion.php');
	}
?>