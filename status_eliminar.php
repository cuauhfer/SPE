<?php 
	session_start();

	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];

	//variables por URL
	$id = $_GET['id'];
	$accion = $_GET['accion'];
	$subaccion = $_GET['subaccion'];

	//Accion 1, eliminacion logica
	if($accion == "1"){
		if($subaccion == "1"){
			$sql = "SELECT * FROM produccion WHERE id='$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE produccion SET borrador = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "2"){
			$sql = "SELECT * FROM proyecto WHERE id='$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE proyecto SET borrador = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "3"){
			$sql = "SELECT * FROM estadia WHERE id='$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE estadia SET borrador = true WHERE id ='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "4"){
			$sql = "SELECT * FROM direccionind WHERE id='$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE direccionind SET borrador = true WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		

		header('Location: ../mis_publicaciones.php');
	}
	else if($accion == "0"){
		if($subaccion == "1"){
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

				$sql = "DELETE FROM personaproduccion WHERE idProduccion = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM produccion WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "2"){
			$sql = "SELECT * FROM proyecto WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];

				$sql = "DELETE FROM personaproyecto WHERE idProyecto = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM proyecto WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "3"){
			$sql = "SELECT * FROM estadia WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];

				$sql = "DELETE FROM alumnoestadia WHERE idEstadia = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM estadia WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "4"){
			$sql = "SELECT * FROM direccionind WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];

				$sql = "DELETE FROM alumnodireccion WHERE idDireccion = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM direccionind WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		
		header('Location: ../mis_publicaciones.php');
	}
	else if($accion == "2"){//Este metodo se encarga de rechazar un pendiente 
		if($subaccion == "1"){
			$sql = "SELECT * FROM produccion WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE produccion SET rechazo = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "2"){
			$sql = "SELECT * FROM proyecto WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE proyecto SET rechazo = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		
		header('Location: ../notificacion.php');
	}
?>