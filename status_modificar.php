<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<?php  
		//Inicio de secion
		session_start();
		if(isset($_SESSION['integrante'])){
			?>
			<link rel="stylesheet" href="../css/index_style_integrante.css">
			<?php  
		}
		else if(isset($_SESSION['administrador'])){
			?>
			<link rel="stylesheet" href="../css/index_style_administrador.css">
			<?php
		}
		else if(isset($_SESSION['colaborador'])){
			?>
			<link rel="stylesheet" href="../css/index_style_home.css">
			<?php
		}
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="../pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='../js/script-form.js'></script>
	<!--Titulo-->
	<title>Modificar</title>
</head>

<?php  
	session_start();
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

	if(isset($_SESSION['username'])){
		function nombre($codigo){
			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
			$sql = "SELECT * FROM persona WHERE codigo = $codigo";
			$resultado = mysqli_query($conexion, $sql);
			$persona = mysqli_fetch_array($resultado);
			echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
		}
?>
<body>
	<header class="fixed-top">
		<nav>
			<ul>
				<ul>
					<a href="javascript:window.history.go(-1);"><li>Volver</li></a>
				</ul>
				<?php
					if(isset($_SESSION['integrante'])){
				?>
					<a href='../integrante.php'><li>Principal</li></a>
				<?php  
				}
					else if(isset($_SESSION['administrador'])){
				?>
					<a href='../administrador.php'><li>Principal</li></a>
				<?php
					}
					else if(isset($_SESSION['colaborador'])){
				?>
					<a href='../colaborador.php'><li>Principal</li></a>
				<?php
					}
				?>
					
				</ul>
				<img id='logo' src='../pictures/logo.png'>

			<ul>
				<a href='../logout.php'><li>Salir</li></a>
			</ul>
		</nav>
	</header>

	<div class="container-fluid">
		<br><br><br><br>

		<?php  
		

		$id = $_GET['id'];
		$tipo = $_GET['tipo']; 

		$sql = "SELECT * FROM produccion WHERE nombre='$var1'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){}
	?>

	</div>

</body>
<?php 
	}else{
		header('Location: login.php');
	}

?>

</html>