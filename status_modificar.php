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

	<div class="container">
		<br><br><br><br>

		<?php 

			$persona = $_SESSION['persona'];
			$id = $_GET['id'];
			$tipo = $_GET['tipo']; 

			if($tipo == 1 || $tipo == 2 || $tipo == 3 || $tipo == 4){
				$sql = "SELECT * FROM produccion WHERE id='$id'";
				$resultado = mysqli_query($conexion, $sql);
				while($reg = mysqli_fetch_array($resultado)){
					?>
						<table class="table table-success table-bordered table-striped table-hover">
							
							<tr>
								<td colspan="1">Nombre</td>
								<td colspan="3"><input class="form-control" type="text" name="nombre" required value="<?php echo $reg['nombre'] ?>"></td>
							</tr>
							<tr>
								<td colspan="1">Autor</td>
								<td colspan="3"><?php 
									 echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];?></td>
							</tr>
							<tr>
								<td>Fecha</td>
								<td><input class="form-control" type="date" name="fecha" value="<?php echo $reg['fecha'] ?>"></td>
								<td colspan="2">
									<div class="checkbox input-group-text">
										<label>
											<input type="checkbox" aria-label="Checkbox for following text input" name="borrador" value="<?php echo $reg['borrador'] ?>"> Borrador
										</label>
									</div>
								</td>
							</tr>
							<?php  
								if($tipo == 1){
									$sql = "SELECT * FROM articulo WHERE idProduccion = '$id'";
									$resultado = mysqli_query($conexion, $sql);
									$art = mysqli_fetch_array($resultado);
									?>
										<tr>
											<td colspan="1">Revista</td><td colspan="3"><input class="form-control" type="text" name="revista" value="<?php echo $art['revista'] ?>"></td>
										</tr>
										<tr>
											<td colspan="1">Paginas</td>
											<td colspan="3">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="">Desde</span>
													</div>
												  	<input type="number" class="form-control" name="pag1">
												  	<div class="input-group-prepend">
														<span class="input-group-text" id="">Hasta</span>
													</div>
												  	<input type="number" class="form-control" name="pag2">
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="1">Linea de pertenencia</td>
											<td colspan="3"><select class="form-control custom-select" type="select" name="linea" id="linea" required>
												<?php 
													$sql = "SELECT * FROM lineainn";
													$resultado = mysqli_query($conexion, $sql);
													while ($lineas = mysqli_fetch_array($resultado)){
														$nombrelinea = $lineas['nombre'];
														$idlinea = $lineas['id'];
														?>
															<option <?php echo "value = '$idlinea'";?> > <?php echo $nombrelinea; ?></option>
														<?php
													}

												?>
											</select></td>
										</tr>
										<tr>
											<td colspan="1">ISSN</td><td colspan="3"><input class="form-control" type="text" name="issn" value="<?php echo $art['issn'] ?>"></td>
										</tr>
									<?php
								}
								else if($tipo == 2){

								}
								else if($tipo == 3){
									$sql = "SELECT * FROM manual WHERE idProduccion = '$id'";
									$resultado = mysqli_query($conexion, $sql);
									$man = mysqli_fetch_array($resultado);
									?>
										<tr>
											<td colspan="1">Registro</td><td colspan="3"><input class="form-control" type="text" name="registro" value="<?php echo $man['registro'] ?>"></td>
										</tr>
									<?php
								}
								else if($tipo == 4){

								}
							?>
							<tr>
								<td colspan="1">Descripcion</td><td colspan="3"><textarea type="text" id="descripcion" name="descripcion" class="form-control" rows="5"><?php echo $reg['descripcion'] ?></textarea></td>
							</tr>
							<tr>
								<td colspan="4"></td>
							</tr>
							<tr>
								<td colspan="4" align="center">
									<div class="btn-group d-inline-block">
										<input class="btn btn-light" type="reset" name="" value="Limpiar">
										<input class="btn btn-light" type="submit" name="agregar" value="Agregar">
										<input class="btn btn-light" type="submit" name="cancelar" value="Cancelar" formnovalidate>
									</div>
								</td>
							</tr>
						</table>
					<?php
				}
			}
		?>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
<?php 
	}else{
		header('Location: login.php');
	}

?>

</html>