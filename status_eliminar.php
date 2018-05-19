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
		else if($subaccion == "5"){
			$sql = "SELECT * FROM lineainn WHERE id='$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$sql = "UPDATE lineainn SET borrador = true WHERE id='$idpd'";
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
				$nom = $reg['nombre'];

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

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó la producción $nom', NOW())";
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
				$nom = $reg['nombre'];

				$sql = "DELETE FROM personaproyecto WHERE idProyecto = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó el proyecto $nom', NOW())";
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
				$nom = $reg['nombreEmpresa'];

				$sql = "DELETE FROM alumnoestadia WHERE idEstadia = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó la estadía $nom', NOW())";
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
				$nom = $reg['nombreProyecto'];

				$sql = "DELETE FROM alumnodireccion WHERE idDireccion = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó la dirección $nom', NOW())";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM direccionind WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "5"){
			$sql = "SELECT * FROM lineainn WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$nom = $reg['nombre'];

				$sql = "UPDATE articulo SET linea = 1 WHERE linea = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "UPDATE libro SET linea = 1 WHERE linea = '$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Eliminó la linea de innovacíon $nom', NOW())";
				$resultado = mysqli_query($conexion, $sql);

				$sql = "DELETE FROM lineainn WHERE id='$idpd'";
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
				$nom = $reg['nombre'];
				$sql = "UPDATE produccion SET rechazo = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Rechazó la producción $nom', NOW())";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		else if($subaccion == "2"){
			$sql = "SELECT * FROM proyecto WHERE id = '$id'";
			$resultado = mysqli_query($conexion, $sql);

			while($reg = mysqli_fetch_array($resultado)){
				$idpd = $reg['id'];
				$nom = $reg['nombre'];
				$sql = "UPDATE proyecto SET rechazo = true, aprobacion = false WHERE id='$idpd'";
				$resultado = mysqli_query($conexion, $sql);

				//Logs
				$admin = $_SESSION['user'];
				$adminon = $admin['codigo'];
				$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Rechazó la producción $nom', NOW())";
				$resultado = mysqli_query($conexion, $sql);
			}
		}
		
		header('Location: ../notificacion.php');
	}
?>