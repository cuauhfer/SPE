<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/add_produccion.css">
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
	?>
	<!--Favicon-->
	<link rel="icon" type="image/png" href="../pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='../js/script-form.js'></script>
	<script src='../add_produccion.js'></script>
	<!--Titulo-->
	<title>Agregar Colaboradores</title>
</head>
<?php 

	if(isset($_SESSION['username'])){
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];
?>
<body>
	<header class="fixed-top">
		<nav>
			<ul>
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
				?>
			</ul>
				
				<img id='logo' src='../pictures/logo.png'>

			<ul>

				<a href='../logout.php'><li>Salir</li></a>
			</ul>
		</nav>
	</header>

	<section>
		<br><br><br><br>

		<?php  
			$var1 = $_GET['produccion'];
			$var2 = $_GET['tipo'];

			if(isset($_POST['adicional']) && $var2 == 1){
				$per = $_POST['persona'];

				$sql = "SELECT * FROM personaproduccion WHERE codigoPersona = '$per' AND idProduccion = '$var1'";
				$resultado = mysqli_query($conexion, $sql);
				$existe = ($resultado -> num_rows);

				if($existe == 0){
					$sql = "INSERT INTO personaproduccion (codigoPersona, idProduccion) VALUES ('$per', '$var1')";
					$resultado = mysqli_query($conexion, $sql);
				}
			}
			else if(isset($_POST['adicional']) && $var2 == 2){
				$per = $_POST['persona'];

				$sql = "SELECT * FROM personaproyecto WHERE codigoPersona = '$per' AND idProyecto = '$var1'";
				$resultado = mysqli_query($conexion, $sql);
				$existe = ($resultado -> num_rows);

				if($existe == 0){
					$sql = "INSERT INTO personaproyecto (codigoPersona, idProyecto) VALUES ('$per', '$var1')";
					$resultado = mysqli_query($conexion, $sql);
				}
			}

			if(isset($_POST['quitar']) && $var2 == 2){
				$per = $_POST['persona'];

				$sql = "DELETE FROM personaproyecto WHERE codigoPersona = '$per' AND idProyecto = '$var1'";
				$resultado = mysqli_query($conexion, $sql);
			}
			else if(isset($_POST['quitar']) && $var2 == 1){
				$per = $_POST['persona'];

				$sql = "DELETE FROM personaproduccion WHERE codigoPersona = '$per' AND idProduccion = '$var1'";
				$resultado = mysqli_query($conexion, $sql);
			}
		?>

		<div class="container">
			<form method="post">
				<table class="table-success table table-hover table-stripped">
					<th><td colspan="2">Agregar Nuevo Colaborador</td> 
						<td colspan="4">
							<select class="form-control custom-select" type="select" name="persona" id="persona" required>
								<?php 
									$sql = "SELECT * FROM persona WHERE nombre != 'Administrador'";
									$resultado = mysqli_query($conexion, $sql);
									while ($personas = mysqli_fetch_array($resultado)){
										$nombre = $personas['nombre'];
										$apep = $personas['apellidoP'];
										$apem = $personas['apellidoM'];
										$codigo = $personas['codigo'];
										?>
											<option <?php echo "value = '$codigo'";?> > <?php echo $nombre." ".$apep." ".$apem; ?></option>
										<?php
									}
								?>
							</select>
						</td>
						<td colspan="1">
							<div class="btn-group d-inline-block">
								<input type="submit" id="adicional" name="adicional" class="btn btn-outline-info" value="Agregar">
								<input type="submit" id="quitar"    name="quitar" 	 class="btn btn-outline-info" value="Eliminar">
							</div>
							<?php
								if(isset($_SESSION['integrante'])){
									?>
										<a class="btn btn-outline-info" href='../integrante.php'>Finalizar</a>
									<?php  
								}
								else if(isset($_SESSION['administrador'])){
									?>
										<a class="btn btn-outline-info" href='../administrador.php'>Finalizar</a>
									<?php
								}
							?>
						</td>	
					</th>
				</table>
			</form>

			<table class="table-success table table-hover table-stripped">
				<?php
					if($var2 == 1){
						$sql = "SELECT * FROM personaproduccion WHERE idProduccion = '$var1'";
						$resultado = mysqli_query($conexion, $sql);

						while($col = mysqli_fetch_array($resultado)){
							$codigo = $col['codigoPersona'];
							$sql = "SELECT * FROM persona WHERE codigo = '$codigo'";
							$res = mysqli_query($conexion, $sql);
							$per = mysqli_fetch_array($res);
							echo "<tr><td>Colaborador</td><td>".$per['nombre']." ".$per['apellidoP']." ".$per['apellidoM']."</td></tr>";
						}
					}
					else if($var2 == 2){
						$sql = "SELECT * FROM personaproyecto WHERE idProyecto = '$var1'";
						$resultado = mysqli_query($conexion, $sql);

						while($col = mysqli_fetch_array($resultado)){
							$codigo = $col['codigoPersona'];
							$sql = "SELECT * FROM persona WHERE codigo = '$codigo'";
							$res = mysqli_query($conexion, $sql);
							$per = mysqli_fetch_array($res);
							echo "<tr><td>Colaborador</td><td>".$per['nombre']." ".$per['apellidoP']." ".$per['apellidoM']."</td></tr>";
						}
					}
				?>
			</table>
		</div>
	</section>


	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
<?php  
	}
	else{//Else de sesion
		header('Location: login.php');
	}
?>
</html>