<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
	<script>
		function confirmar(){
			if(confirm("¿Estas seguro? \n Se te eliminara del sistema.")){
				return true;
			}
			return false;
		}
	</script>
	<!--Titulo-->
	<title>Perfil</title>
</head>

<?php 
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];
	$sql = "SELECT * FROM usuario WHERE username='$usuario'";
	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);

	$codigo = $reg['codigo'];
	if(isset($_SESSION['username'])){ 
?>
	<body>
		<header>
			<nav>
				<ul>
				<?php
					if(isset($_SESSION['integrante'])){
				?>
					<a href='integrante.php'><li>Principal</li></a>
				<?php  
				}
					else if(isset($_SESSION['administrador'])){
				?>
					<a href='administrador.php'><li>Principal</li></a>
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
	
	<section id='banner'>
		<br><br><br><br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
					<?php
						$nombre = $reg['codigo'];
						if(!file_exists("profile_pictures/".$nombre.".jpg")){
						?>
							<img src="profile_pictures/default.png" class="img-responsive img-circle" width="250" height="250"/>
						<?php
						}//Lñave del if
						else{

							echo "<img src='profile_pictures/".$nombre.".jpg' width='250' height='250'/>";

						}//Llave del else

						if(isset($_POST['upload'])){
							$carpeta = "profile_pictures/";
							opendir($carpeta);
							$destino = $carpeta.$_FILES['foto']['name'];
							copy($_FILES['foto']['tmp_name'], $destino);
							rename($carpeta.$_FILES['foto']['name'], $carpeta.$nombre.".jpg");
							header('Location: persona.php');
						}
						else if(isset($_POST['borrarimg']) && file_exists("profile_pictures/".$nombre.".jpg")){
							unlink('profile_pictures/'.$codigo.".jpg");
							header('Location: persona.php');
						}

						if(isset($_POST['actualizarimg'])){
						?>
							<form method="post" enctype="multipart/form-data">
								<br>
								<input class="form-control-file" type="file" name="foto" required><br>
								<input class="btn btn-success" type="submit" name="upload" value="Subir">
							</form><br>
							<form method="post">
								<input class="btn btn-success" type="submit" name="cancelarimg" value="Cancelar">
							</form>	
						<?php
						}else{
						?>
						<form method="post" enctype="multipart/form-data"><br>
							<input class="btn btn-success" type="submit" name="actualizarimg" value="Cambiar">
							<input class="btn btn-success" type="submit" name="borrarimg" value="Eliminar">
						</form>
					<?php 
					}
					?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
					<table class="table table-dark table-bordered table-striped table-hover">
						<?php 
							//If para mostrar el perfil
							if(!isset($_POST['modificar'])){
								$sql = "SELECT * FROM usuario WHERE username='$usuario'";
								$resultado = mysqli_query($conexion, $sql);

								$usuario = $_SESSION["user"];
								$codigo = $usuario['codigo'];
								$sql = "SELECT * FROM persona WHERE codigo='$codigo'";
								$resultado_p = mysqli_query($conexion, $sql);
								$reg_p = mysqli_fetch_array($resultado_p);

								while($reg = mysqli_fetch_array($resultado)){
								echo 
									"<tr><td>Codigo</td><td>".$reg['codigo']."</td></tr>".
									"<tr><td>Nombre</td><td>".$reg_p['nombre']."</td>"."</tr>".
									"<tr><td>Apellido Paterno</td><td>".$reg_p['apellidoP']."</td>"."</tr>".
									"<tr><td>Apellido Materno</td><td>".$reg_p['apellidoM']."</td>"."</tr>".
									"<tr><td>Correo</td><td>".$reg_p['email']."</td>"."</tr>".
									"<tr><td>Telefono</td><td>".$reg_p['telefono']."</td>"."</tr>".
									"<tr><td>Division</td><td>".$reg_p['division']."</td>"."</tr>".
									"<tr><td>Escolaridad</td><td>".$reg_p['escolaridad']."</td>"."</tr>".
									"<tr><td>Nombre de Usuario</td><td>".$reg['username']."</td>"."</tr>";
								}//Llave del while
							}//Llave del else
						?>
					</table>
					<?php  
						if(!isset($_POST['modificar'])){
					?>
						<form method="post">
							<input class="btn btn-success" type="submit" name="modificar" value="Modificar">
						</form>
					<?php
						}else{
							header('Location: comprobar.php');
						}
					?>
					
				</div>
			</div>
		</div>
	</section>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<br>
	</body>

<?php  
	}
	else{
		header('Location: login.php');
	}
?>
</html>