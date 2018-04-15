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
	<title>Control de usuarios</title>
</head>

<?php 
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 
		//Conexion a BD
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];
		$sql = "SELECT * FROM `usuario`";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);

		function nivel($nivel){
			if($nivel == 1){
				return "Colaborador";
			}
			else if($nivel == 2){
				return "Integrante";
			}
			else if($nivel == 3){
				return "Administrador";
			}
			else{
				return "visitante";
			}
		}

		if(isset($_POST['seleccionar'])){
			$sql = "SELECT * FROM `usuario`";
			$resultado = mysqli_query($conexion, $sql);
			while($reg = mysqli_fetch_array($resultado)){
				if($reg['codigo'] == $_POST['codigo']){
					$_SESSION['dato'] = $_POST['codigo'];
					header('Location: admin_userdata.php');
				}
			}
		}
		else if(isset($_POST['crear'])){
			header('Location: admin_useradd.php');
		}
		$sql = "SELECT * FROM `usuario`";
		$resultado = mysqli_query($conexion, $sql);
?>
	<body>
		<header>
			<nav>
				<ul>
					<a href='administrador.php'><li>Principal</li></a>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>

					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>

		<section id='banner'>
			<br><br><br><br>
			<div class="row">
				<div class="container col-xs-12 col-sm-12 col-md-8 col-lg-9">
					<table class="table table-dark table-bordered table-striped table-hover">
						<tr><th>Codigo</th><th>Nombre</th><th>Nombre Usuario</th><th>Contraseña</th><th>Nivel</th></tr>
						<?php 
							while($reg = mysqli_fetch_array($resultado)){
								echo 
									"<tr><td>".$reg['codigo']."</td><td>".$reg['nombre']." ".$reg['apellidop']." ".$reg['apellidom']."</td><td>".$reg['username']."</td><td>".$reg['password']."</td><td>".nivel($reg['nivel'])."</td></tr>";
							}//Llave del while
						?>
					</table>
				</div>
				<div class="container col-xs-12 col-sm-12 col-md-4 col-lg-3">
					<form method="post">
						<input class="btn btn-success" type="submit" name="crear" value="Agregar"><br><br><br><br>
					</form>
					<form method="post">
						<input class="form" type="text" name="codigo" required>
						<input class="btn btn-success" type="submit" name="seleccionar" value="Modificar">
						<p class="text-warning">Seleccione un codigo para operar con ese usuario</p>
					</form>
				</div>
			</div>
		</section>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
<?php }
	else{
		header('Location: login.php');
	}

?>
</html>