<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/add_produccion.css">
	<?php  
		//Inicio de secion
		session_start();
		if(isset($_SESSION['integrante'])){
			?>
			<link rel="stylesheet" href="css/index_style_integrante.css">
			<?php  
		}
		else if(isset($_SESSION['administrador'])){
			?>
			<link rel="stylesheet" href="css/index_style_administrador.css">
			<?php
		}
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<script src='add_produccion.js'></script>
	<!--Titulo-->
	<title>Modificar Usuario</title>
</head>
<?php 

	if(isset($_SESSION['username'])){
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];

		if(isset($_POST['agregar'])){

			$sql = "INSERT INTO usuario(codigo, username, password, nivel, nombre, apellidop, apellidom, email, telefono, division, escolaridad) VALUES('$codigo', '$username', '$password', '$nivel', '$nombre', '$apep', '$apem', '$correo', '$telefono', '$division', '$escolaridad')";
			$resultado = mysqli_query($conexion, $sql);
			
		}
?>
	<body>
		<header>
			<nav>
				<ul>
					<?php
						if(isset($_SESSION['integrante'])){
							?>
								<a href='integrante.php'><li>Atras</li></a>
							<?php  
						}
						else if(isset($_SESSION['administrador'])){
							?>
								<a href='administrador.php'><li>Atras</li></a>
							<?php
						}
					?>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>

					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>
		<section id="banner">
			<br><br><br><br>
				<div class="container">
					<?php  
						if(isset($_POST['comenzar'])){

							if($_POST['tipo'] == "1"){
								?>
									<form method="post">
										<table class="table table-dark table-bordered table-striped table-hover">
											
											<tr>
												<td colspan="1">Nombre</td>
												<td colspan="3"><input class="form-control" type="text" name="username" required></td>
											</tr>
											<tr>
												<td colspan="1">Autor</td>
												<td colspan="3"><?php 
													$persona = $_SESSION['persona']; echo $persona['nombre'];?></td>
											</tr>
											<tr>
												<td>Fecha</td>
												<td><input class="form-control" type="date" name="fecha" required></td>
												<td>Borrador</td>
												<td align="center"><input class="form-control" type="checkbox" name="apellidop" required></td>
											</tr>
											<tr>
												<td colspan="1">Revista</td><td colspan="3"><input class="form-control" type="text" name="revista" required></td>
											</tr>
											<tr>
												<td colspan="1">Paginas</td><td colspan="3"><input class="form-control" type="text" name="paginas" required></td>
											</tr>
											<tr>
												<td colspan="1">Linea</td><td colspan="3"></td>
											</tr>
											<tr>
												<td colspan="1">ISSN</td><td colspan="3"><input class="form-control" type="text" name="issn" required></td>
											</tr>
											<tr>
												<td colspan="4"></td>
											</tr>
											<tr>
												<td colspan="1"><input class="btn btn-warning" type="reset" name=""></td>
												<td colspan="1"><input class="btn btn-success" type="submit" name="agregar"></td>
												<td colspan="2"><input class="btn btn-success" type="submit" name="cancelar" value="Cancelar"></td>
											</tr>
										</table>
									</form>
								<?php
							}
							else if($_POST['tipo'] == "2"){
								?>
								<?php
							}

							else if($_POST['tipo'] == "3"){
								?>
								<?php
							}
							else if($_POST['tipo'] == "4"){
								?>
								<?php
							}
						}
						else{
							?>
								<table class="table table-dark table-bordered table-striped table-hover">
									<tr>
										<form method="post">
											<td colspan="1">Tipo de Publicacion</td>
											<td colspan="2"><select class="form-control" type="select" name="tipo" id="tipo">
												<option value="1">Articulo</option>
												<option value="2">Informe Tecnico</option>
												<option value="3">Manual</option>
												<option value="4">Libro</option>
											</select></td>
											<td><input class="btn btn-success" type="submit" name="comenzar" value="Comenzar"></td>
										</form>
									</tr>
								</table>
							<?php
						}
					?>
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