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
	<title>Crear Producción</title>
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
								<a href='integrante.php'><li>Atras</li></a>
							<?php  
						}
						else if(isset($_SESSION['administrador'])){
							?>
								<a href='administrador.php'><li>Atrás</li></a>
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
		<section>
			<br><br><br><br>
				<div class="container">
					<form method="post">

						<!-- Tabla para ver el tipo de publicacion o registro-->
						<table class="table table-success table-bordered table-striped table-hover">
							<tr>
								<td colspan="1">Tipo de Publicación</td>
								<td colspan="2"><select class="form-control custom-select" type="select" name="tipo" id="tipo">
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="1"){echo "selected";}?> value="1">Artículos</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="2"){echo "selected";}?> value="2">Informe técnico</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="3"){echo "selected";}?> value="3">Manual de operación, productividad innovadora, prototipo</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="4"){echo "selected";}?> value="4">Libro, capitulo de libro, memorias</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="5"){echo "selected";}?> value="5">Línea de innovación</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="6"){echo "selected";}?> value="6">Dirección individualizada </option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="7"){echo "selected";}?> value="7">Estadía en Empresa</option>
									<option <?php if(isset($_POST['tipo']) && $_POST['tipo']=="8"){echo "selected";}?> value="8">Proyecto</option>
								</select></td>
								<td><input class="btn btn-success" type="submit" name="comenzar" value="Comenzar" formnovalidate></td>
							</tr>
						</table>
					<?php 
						//If para comenzar con la seleccion
						if(isset($_POST['comenzar']) || isset($_POST['agregar'])){

							//Cada if es un tipo distinto de publicacion
							if($_POST['tipo'] == "1"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$fecha = $_POST['fecha'];
									$descripcion = $_POST['descripcion'];
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}
									$aprobacion = false;
									$publicacion = $tipo;
									$sql = "INSERT INTO produccion(nombre, autor, fecha, borrador, aprobacion, tipoPublicacion, rechazo, descripcion) VALUES('$nombre', '$autor', '$fecha', '$borrador', '$aprobacion', '$publicacion', false, '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);

									$sql = "SELECT *  FROM produccion WHERE nombre LIKE '$nombre' AND autor = '$autor'";
									$resultado = mysqli_query($conexion, $sql);
									$reg = mysqli_fetch_array($resultado);

									$idProduccion = $reg['id'];
									$revista = $_POST['revista'];
									$paginas = "Página ".$_POST['pag1']." hasta la página ".$_POST['pag2'];
									$linea = $_POST['linea'];
									$issn = $_POST['issn'];
									$tipoart = $_POST['tipoart'];

									$sql = "INSERT INTO articulo(revista, paginas, linea, issn, idProduccion, tipoArticulo) VALUES('$revista', '$paginas', '$linea', '$issn', '$idProduccion', '$tipoart')";
									$resultado = mysqli_query($conexion, $sql);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó el articulo $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);
									
									header('Location: int_colaborador.php/?produccion='.$reg['id'].'&tipo=1');
									
								}
								?>
									<div class="container"></div>
										<table class="table table-success table-bordered table-striped table-hover">
											
											<tr>
												<td colspan="1">Nombre</td>
												<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
											</tr>
											<tr>
												<td colspan="1">Autor</td>
												<td colspan="3"><?php 
													 echo $persona['nombre'];?></td>
											</tr>
											<tr>
												<td>Fecha</td>
												<td><input class="form-control" type="date" name="fecha"></td>
												<td colspan="2">
													<div class="checkbox input-group-text">
														<label>
															<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
														</label>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="1">Revista</td><td colspan="3"><input class="form-control" type="text" name="revista"></td>
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
														$sql = "SELECT * FROM lineainn WHERE borrador = false";
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
												<td colspan="1">Tipo de artículo</td>
												<td colspan="3"><select class="form-control custom-select" type="select" name="tipoart" id="tipoart" required>
													<option value="Artículo de difusión y divulgación">Artículo de difusión y divulgación</option>
													<option value="Artículo arbitrario">Artículo arbitrario</option>
													<option value="Artículo de revista indexada">Artículo de revista indexada</option>
												</select></td>
											</tr>
											<tr>
												<td colspan="1">ISSN</td><td colspan="3"><input class="form-control" type="text" name="issn"></td>
											</tr>
											<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea type="text" id="descripcion" name="descripcion" class="form-control" rows="5"></textarea></td>
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
							else if($_POST['tipo'] == "2"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$fecha = $_POST['fecha'];
									$descripcion = $_POST['descripcion'];
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}
									$aprobacion = false;
									$publicacion = $tipo;
									$sql = "INSERT INTO produccion(nombre, autor, fecha, borrador, aprobacion, tipoPublicacion, rechazo, descripcion) VALUES('$nombre', '$autor', '$fecha', '$borrador', '$aprobacion', '$publicacion', false, '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);

									$sql = "SELECT *  FROM produccion WHERE nombre LIKE '$nombre' AND autor = '$autor'";
									$resultado = mysqli_query($conexion, $sql);
									$reg = mysqli_fetch_array($resultado);

									$idProduccion = $reg['id'];
									$dependencia = $_POST['dependencia'];

									$sql = "INSERT INTO informetec(dependencia, idProduccion) VALUES('$dependencia', '$idProduccion')";
									$resultado = mysqli_query($conexion, $sql);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó el informe técnico $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									header('Location: int_colaborador.php/?produccion='.$reg['id'].'&tipo=1');
								}
								?>
									<form method="post">
											<table class="table table-success table-bordered table-striped table-hover">
												
												<tr>
													<td colspan="1">Nombre</td>
													<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
												</tr>
												<tr>
													<td colspan="1">Autor</td>
													<td colspan="3"><?php 
														echo $persona['nombre'];?></td>
												</tr>
												<tr>
													<td>Fecha</td>
													<td><input class="form-control" type="date" name="fecha"></td>
													<td colspan="2">
														<div class="checkbox input-group-text">
															<label>
																<input type="checkbox" name="borrador"> Borrador
															</label>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="1">Dependencia</td><td colspan="3"><input class="form-control" type="text" name="dependencia" required></td>
												</tr>
												<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea></td>
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
										</form>
									<?php
							}
							else if($_POST['tipo'] == "3"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$fecha = $_POST['fecha'];
									$descripcion = $_POST['descripcion'];
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}
									$aprobacion = false;
									$publicacion = $tipo;
									$sql = "INSERT INTO produccion(nombre, autor, fecha, borrador, aprobacion, tipoPublicacion, rechazo, descripcion) VALUES('$nombre', '$autor', '$fecha', '$borrador', '$aprobacion', '$publicacion', false, '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);
									
									$sql = "SELECT *  FROM produccion WHERE nombre LIKE '$nombre' AND autor = '$autor'";
									$resultado = mysqli_query($conexion, $sql);
									$reg = mysqli_fetch_array($resultado);

									$idProduccion = $reg['id'];
									$registro = $_POST['registro'];
									$tipoman = $_POST['tipoman'];

									$sql = "INSERT INTO manual(registro, idProduccion, tipoManual) VALUES('$registro', '$idProduccion', '$tipoman')";
									$resultado = mysqli_query($conexion, $sql);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó el manual $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									header('Location: int_colaborador.php/?produccion='.$reg['id'].'&tipo=1');
								}
								?>
									<form method="post">
											<table class="table table-success table-bordered table-striped table-hover">
												
												<tr>
													<td colspan="1">Nombre</td>
													<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
												</tr>
												<tr>
													<td colspan="1">Autor</td>
													<td colspan="3"><?php 
														echo $persona['nombre'];?></td>
												</tr>
												<tr>
													<td>Fecha</td>
													<td><input class="form-control" type="date" name="fecha"></td>
													<td colspan="2">
														<div class="checkbox input-group-text">
															<label>
																<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
															</label>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="1">Tipo de publicación</td>
													<td colspan="3"><select class="form-control custom-select" type="select" name="tipoman" id="tipoman" required>
														<option value="Manual de operación">Manual de operación</option>
														<option value="Productividad innovadora">Productividad innovadora</option>
														<option value="Prototipo">Prototipo</option>
													</select></td>
												</tr>
												<tr>
													<td colspan="1">Registro</td><td colspan="3"><input class="form-control" type="text" name="registro"></td>
												</tr>
												<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea name="descripcion" class="form-control" rows="5"></textarea></td>
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
										</form>
									<?php
							}
							else if($_POST['tipo'] == "4"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$fecha = $_POST['fecha'];
									$descripcion = $_POST['descripcion'];
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}
									$aprobacion = false;
									$publicacion = $tipo;
									$sql = "INSERT INTO produccion(nombre, autor, fecha, borrador, aprobacion, tipoPublicacion, rechazo, descripcion) VALUES('$nombre', '$autor', '$fecha', '$borrador', '$aprobacion', '$publicacion', false, '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);

									$sql = "SELECT *  FROM produccion WHERE nombre LIKE '$nombre' AND autor = '$autor'";
									$resultado = mysqli_query($conexion, $sql);
									$reg = mysqli_fetch_array($resultado);

									$idProduccion = $reg['id'];
									$editorial = $_POST['editorial'];
									$paginas = "Página ".$_POST['pag1']." hasta la página ".$_POST['pag2'];
									$linea = $_POST['linea'];
									$isbn = $_POST['isbn'];
									$tipolib = $_POST['tipolib'];
									$sql = "INSERT INTO libro(paginas, editorial, linea, isbn, idProduccion, tipoLibro) VALUES('$paginas', '$editorial', '$linea', '$isbn', '$idProduccion', '$tipolib')";
									$resultado = mysqli_query($conexion, $sql);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó el libro $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									header('Location: int_colaborador.php/?produccion='.$reg['id'].'&tipo=1');
								}
								?>
									<form method="post">
											<table class="table table-success table-bordered table-striped table-hover">
												
												<tr>
													<td colspan="1">Nombre</td>
													<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
												</tr>
												<tr>
													<td colspan="1">Autor</td>
													<td colspan="3"><?php 
														$persona = $_SESSION['persona']; echo $persona['nombre'];?></td>
												</tr>
												<tr>
													<td>Fecha</td>
													<td><input class="form-control" type="date" name="fecha" required></td>
													<td colspan="2">
														<div class="checkbox input-group-text">
															<label>
																<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
															</label>
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="1">ISBN</td><td colspan="3"><input class="form-control" type="text" name="isbn" required></td>
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
															$sql = "SELECT * FROM lineainn WHERE borrador = false";
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
													<td colspan="1">Tipo de publicación</td>
													<td colspan="3"><select class="form-control custom-select" type="select" name="tipolib" id="tipolib" required>
														<option value="Libro">Libro</option>
														<option value="Capitulo de libro">Capitulo de libro</option>
														<option value="Memorias">Memorias</option>
													</select></td>
												</tr>
												<tr>
													<td colspan="1">Editorial</td><td colspan="3"><input class="form-control" type="text" name="editorial" required></td>
												</tr>
												<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea name="descripcion" class="form-control" rows="5"></textarea></td>
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
										</form>
									<?php
							}
							else if($_POST['tipo'] == "5"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$campo = $_POST['campo'];

									$publicacion = $tipo;
									$sql = "INSERT INTO lineainn(nombre, codigoPersona, campo, borrador) VALUES('$nombre', '$autor', '$campo', false)";
									$resultado = mysqli_query($conexion, $sql);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó la linea de innovación $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									if(isset($_SESSION['integrante'])){
										header('Location: integrante.php');
									}
									else if(isset($_SESSION['administrador'])){
										header('Location: administrador.php');
									}
								}
								?>
									<div class="container"></div>
										<table class="table table-success table-bordered table-striped table-hover">
											
											<tr>
												<td colspan="1">Nombre</td>
												<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
											</tr>
											<tr>
												<td colspan="1">Registra: </td>
												<td colspan="3"><?php 
													 echo $persona['nombre'];?></td>
											</tr>
											<tr>
												<td colspan="1">Campo</td><td colspan="3"><input class="form-control" type="text" name="campo"></td>
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
							else if($_POST['tipo'] == "6"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];
								$borrador = false;

								if(isset($_POST['agregar'])){
									$fecha = $_POST['fecha'];
									$autor = $persona['codigo'];
									$empresa = $_POST['empresa'];
									$proyecto = $_POST['proyecto'];
									$descripcion = $_POST['descripcion'];
									$borrador = false;
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}

									$publicacion = $tipo;
									$sql = "INSERT INTO direccionind(codigoPersona, nombreEmpresa, fecha, nombreProyecto, borrador, descripcion) VALUES('$autor', '$empresa', '$fecha', '$proyecto', '$borrador', '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);
									$codigo = mysqli_insert_id($conexion); 

									if(!empty($_POST['check_list'])){
										// Simpre que la lista tenga cuando menos una selección
										foreach($_POST['check_list'] as $selected){
											echo $selected;
											$sql = "INSERT INTO alumnodireccion(idAlumno, idDireccion) VALUES('$selected', '$codigo')";
											$resultado = mysqli_query($conexion, $sql);
										}
									}

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó la dirección individualizada $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									if(isset($_SESSION['integrante'])){
										header('Location: integrante.php');
									}
									else if(isset($_SESSION['administrador'])){
										header('Location: administrador.php');
									}
								}
								?>
									<div class="container"></div>
										<table class="table table-success table-bordered table-striped table-hover">
											<tr>
												<td colspan="1">Nombre Empresa</td>
												<td colspan="3"><input class="form-control" type="text" name="empresa" required></td>
											</tr>	
											<tr>
												<td>Fecha</td>
												<td><input class="form-control" type="date" name="fecha" required></td>
												<td colspan="2">
													<div class="checkbox input-group-text">
														<label>
															<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
														</label>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="1">Nombre Proyecto</td>
												<td colspan="3"><input class="form-control" type="text" name="proyecto" required></td>
											</tr>
											
											<tr>
												<td colspan="1">Registra: </td>
												<td colspan="3"><?php 
													 echo $persona['nombre'];?></td>
											</tr>

											<tr>
												<td colspan="1"> Alumnos </td>
												<td colspan="3">
												<?php 
												$sql = "SELECT * FROM alumno";
												$resultado = mysqli_query($conexion, $sql);
												while( $row = mysqli_fetch_array($resultado) ){
													echo "<input type=checkbox name='check_list[]' value='$row[idAlumno]'><label> $row[nombreAlumno] $row[apellidoP] $row[apellidoM]</label> <br/> ";
												}//Llave del while
												?>
												</td>

											</tr>

											<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea name="descripcion" class="form-control" rows="5"></textarea></td>
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
							else if($_POST['tipo'] == "7"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$autor = $persona['codigo'];
									$empresa = $_POST['empresa'];
									$descripcion = $_POST['descripcion'];
									$borrador = false;
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}

									$publicacion = $tipo;
									$sql = "INSERT INTO estadia(codigoPersona, nombreEmpresa, borrador, descripcion) VALUES('$autor', '$empresa', '$borrador', '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);
									$codigo = mysqli_insert_id($conexion); 

									if(!empty($_POST['check_list'])){
										// Simpre que la lista tenga cuando menos una selección
										foreach($_POST['check_list'] as $selected){
											echo $selected;
											$sql = "INSERT INTO alumnoestadia(idAlumno, idEstadia) VALUES('$selected', '$codigo')";
											$resultado = mysqli_query($conexion, $sql);
										}
									}

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó la estadía en empresa $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									if(isset($_SESSION['integrante'])){
										header('Location: integrante.php');
									}
									else if(isset($_SESSION['administrador'])){
										header('Location: administrador.php');
									}
								}
								?>
									<div class="container"></div>
										<table class="table table-success table-bordered table-striped table-hover">
											<tr>
												<td>Nombre Empresa</td>
												<td><input class="form-control" type="text" name="empresa" required></td>
												<td colspan="2">
													<div class="checkbox input-group-text">
														<label>
															<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
														</label>
													</div>
												</td>
											</tr>
											
											<tr>
												<td colspan="1">Registra: </td>
												<td colspan="3"><?php 
													 echo $persona['nombre'];?></td>
											</tr>
											<tr>
												<td colspan="1"> Alumnos </td>
												<td colspan="3">
												<?php 
												$sql = "SELECT * FROM alumno";
												$resultado = mysqli_query($conexion, $sql);
												while( $row = mysqli_fetch_array($resultado) ){
													echo "<input type='checkbox' name='check_list[]' value='$row[idAlumno]'> <label> $row[nombreAlumno] $row[apellidoP] $row[apellidoM] </label> <br/> ";
												}//Llave del while
												?>
												</td>

											</tr>
											<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea name="descripcion" class="form-control" rows="5"></textarea></td>
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
							else if($_POST['tipo'] == "8"){
								$persona = $_SESSION['persona'];
								$tipo = $_POST['tipo'];

								if(isset($_POST['agregar'])){
									$nombre = $_POST['nombre'];
									$autor = $persona['codigo'];
									$fechaini = $_POST['fechaini'];
									$fechafin = $_POST['fechafin'];
									$institucion = $_POST['institucion'];
									$descripcion = $_POST['descripcion'];
									if($_POST['borrador']){
										$borrador = true;
									}
									else{
										$borrador = false;
									}
									$aprobacion = false;
									$sql = "INSERT INTO proyecto(nombre, autor, fechaInicio, fechaFin, institucion, borrador, aprobacion, rechazo, descripcion) VALUES('$nombre', '$autor', '$fechaini', '$fechafin', '$institucion', '$borrador', '$aprobacion', false, '$descripcion')";
									$resultado = mysqli_query($conexion, $sql);

									$sql = "SELECT * FROM proyecto WHERE nombre = '$nombre' AND autor = '$autor'";
									$resultado = mysqli_query($conexion, $sql);
									$reg = mysqli_fetch_array($resultado);

									//Logs
									$admin = $_SESSION['user'];
									$adminon = $admin['codigo'];
									$sql = "INSERT INTO log (codigoUsuario, actividad, fecha) VALUES ('$adminon', 'Creó el proyecto $nombre', NOW())";
									$resultado = mysqli_query($conexion, $sql);

									header('Location: int_colaborador.php/?produccion='.$reg['id'].'&tipo=2');
								}
								?>
									<form method="post">
											<table class="table table-success table-bordered table-striped table-hover">
												
												<tr>
													<td colspan="1">Nombre</td>
													<td colspan="3"><input class="form-control" type="text" name="nombre" required></td>
												</tr>
												<tr>
													<td colspan="1">Autor</td>
													<td colspan="3"><?php 
														$persona = $_SESSION['persona']; echo $persona['nombre'];?></td>
												</tr>
												<tr>
												<td>Fecha Inicio</td>
												<td><input class="form-control" type="date" name="fechaini" required></td>
												<td>Fecha Fin</td>
												<td><input class="form-control" type="date" name="fechafin" required></td>
												</tr>
												<tr>
													<td colspan="1">Institución</td><td colspan="2"><input class="form-control" type="text" name="institucion" required></td>
												<td colspan="1">
													<div class="checkbox input-group-text">
														<label>
															<input type="checkbox" aria-label="Checkbox for following text input" name="borrador"> Borrador
														</label>
													</div>
												</td>
												</tr>
												<tr>
												<td colspan="1">Descripción</td><td colspan="3"><textarea name="descripcion" class="form-control" rows="5"></textarea></td>
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
										</form>
									<?php
							}
						}
						else if(isset($_POST['cancelar'])){
							//Funcion del boton de cancelar
							if(isset($_SESSION['integrante'])){
								header('Location: integrante.php');
							}
							else if(isset($_SESSION['administrador'])){
								header('Location: administrador.php');
							}
						}
					?>
					</form>
				</div>
		</section>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
<?php  
	}
	else{//Else de sesion
		header('Location: login.php');
	}
?>
</html>