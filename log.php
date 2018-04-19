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
	<title>Historial de acceso</title>
</head>

<?php 
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 
		//Conexion a BD
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];
		$sql = "SELECT * FROM `log` ORDER BY `fecha` DESC";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);
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
		<section id="banner">
			<br><br><br><br>
			<div class="row">
				<div class="container col-xs-12 col-sm-12 col-md-10 col-lg-10">
					<table class="table table-dark table-bordered table-striped table-hover">
						<tr><th colspan="5"><center><h2>Logs</h2></center></th></tr>
						<tr><th>Codigo</th><th>Actividad</th><th>Fecha</th><th>Hora</th></tr>
						<?php
							while($reg = mysqli_fetch_array($resultado)){
								$date = date_create($reg['fecha']);
								echo "<tr><td>".$reg['codigo_usuario']."</td><td>".$reg['actividad']."</td> <td>".date_format($date, 'd-m-Y')."</td><td>".date_format($date, 'H:i:s')."</td></tr>";
							}//Llave del while
						?>
					</table>
				</div>
			</div>
		</section>

	</body>
<?php }
	else{
		header('Location: login.php');
	}

?>
</html>