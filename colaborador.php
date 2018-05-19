<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_style_home.css">
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script.js'></script>
	<!--Titulo-->
	<title>Colaborador SPE</title>
</head>
<?php 
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['colaborador'])){ 
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$total = 0;
?>
	<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<a href='persona.php'><li>Perfil</li></a>
					<a href='mis_participaciones.php'><li>Participaciones</li></a>
					
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>
					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header >

		<!--Carrusel de imagenes-->
		<section>
			<div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel">
		        <ol class="carousel-indicators">
		          	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		          	<li data-target="#myCarousel" data-slide-to="1"></li>
		          	<li data-target="#myCarousel" data-slide-to="2"></li>
		        </ol>
	        <div class="carousel-inner">
	          	<div class="carousel-item active">
	          		<script type="text/javascript">
	          			var screen = screen.availWidth;
	          			print '';
	          		</script>
	          		<img class="first-slide" src="pictures/diagrama-ca.png" width="1360" height="500" alt="First slide Responsive image">
            		<div class="container">
	              		<div class="carousel-caption text-left">
	                		<h1 style="color: white; text-shadow: black 0.1em 0.1em 0.2em">Sistema de Producciones educativas SPE</h1>
	                		<p style="color: white; text-shadow: black 0.1em 0.1em 0.2em">SPE es un sitio web que está dedicado a las publicaciones de cualquier producción académica que hayan sido realizadas por algún integrante del cuerpo académico al que pertenece el sistema.</p>
	              		</div>
	            	</div>
	          	</div>
	          	<div class="carousel-item">
	            	<img class="second-slide" src="pictures/mision.jpg" width="1360" height="500" alt="Second slide">
	            	<div class="container">
	              		<div class="carousel-caption">
	                		<h1 style="color: white; text-shadow: black 0.1em 0.1em 0.2em">Misión</h1>
	                		<p style="color: white; text-shadow: black 0.1em 0.1em 0.2em">Crear un sistema en línea compatible con la mayoría de dispositivos, donde cualquier persona pueda conocer la producción educativa de los conjuntos de cuerpos académicos pertenecientes a una universidad o división.</p>
	              		</div>
	            	</div>
	          	</div>
	          	<div class="carousel-item">
	            	<img class="third-slide" src="pictures/Vision.png" width="1360" height="500" alt="Third slide">
	            		<div class="container">
	              			<div class="carousel-caption text-right">
	                			<h1 style="color: white; text-shadow: black 0.1em 0.1em 0.2em">Visión</h1>
	                			<p style="color: white; text-shadow: black 0.1em 0.1em 0.2em">Ser el sitio ideal para compartir tu conocimiento con el resto del campo académico. Proporcionando un entorno en el cual todos los profesores de una universidad podrán compartir sus logros, haciendo de SPE su principal medio de difusión.</p>
	              			</div>
	           		 	</div>
	          		</div>
	        	</div>
	        	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
	          		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	          		<span class="sr-only">Previous</span>
	        	</a>
	        	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
	          		<span class="carousel-control-next-icon" aria-hidden="true"></span>
	          		<span class="sr-only">Next</span>
	       		</a>
	      	</div>
		</section>

		<!--Barra de navegación y contenidos-->
		<section>
			<!--Navbar para los div de contenido-->
			<div class="container-fluid">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
		  			<li class="nav-item">
		    			<a class="nav-link text-primary active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Todo</a>
		  			</li>
				  	<li class="nav-item">
				    	<a class="nav-link text-primary btn" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Lo más reciente</a>
				  	</li>
		  			<li class="nav-item">
		    			<a class="nav-link text-primary btn" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacto</a>
		  			</li>
				</ul>
			</div>

			<!--Divs de contenido-->
			<br><br><br>
			<div class="tab-content container-fluid" id="myTabContent">

	  			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	  				<div class="row">
		            	<div class="col-md-4">
		              		<div class="card mb-4 box-shadow">
		                		<img class="card-img-top" src="pictures/publicacion.jfif" width="200" height="200" alt="Card image cap">
		                		<div class="card-body">
		                			<h3 class="text-center">Producción Académica</h3>
		                  			<p class="card-text">Artículos, libros, prototipos, manuales, informes técnicos, memorias y mas tipos de producciones académicas desarrolladas por nuestros integrantes.</p>
		                  			<div class="d-flex justify-content-between align-items-center">
		                    			<div class="btn-group">
		                      				<a href="ver_produccion.php"><button type="button" class="btn btn-sm btn-outline-success">Ver Más</button></a>
		                    			</div>
		                    			<small class="text-muted">
		                    				<?php  
												$sql = "SELECT * FROM produccion WHERE aprobacion = true";
												$resultado = mysqli_query($conexion, $sql);
												$pendiente = $resultado -> num_rows;
												$total = $total + $pendiente;
												echo $pendiente." resultados";
											?>
		                    			</small>
		                  			</div>
		                		</div>
		              		</div>
		            	</div>
		            	<div class="col-md-4">
		              		<div class="card mb-4 box-shadow">
		                		<img class="card-img-top" src="pictures/proyecto.jfif" width="200" height="200" alt="Card image cap">
		                		<div class="card-body">
		                			<h3 class="text-center">Proyectos</h3>
		                  			<p class="card-text">Descubre los diferentes proyectos desarrollados por nuestros integrantes.</p>
		                  			<div class="d-flex justify-content-between align-items-center">
		                    			<div class="btn-group">
		                      				<a href="ver_proyecto.php"><button type="button" class="btn btn-sm btn-outline-success">Ver Más</button></a>
		                    			</div>
		                    			<small class="text-muted">
		                    				<?php  
												$sql = "SELECT * FROM proyecto WHERE aprobacion = true";
												$resultado = mysqli_query($conexion, $sql);
												$pendiente = $resultado -> num_rows;
												$total = $total + $pendiente;
												echo $pendiente." resultados";
											?>
		                    			</small>
		                  			</div>
		                		</div>
		              		</div>
		            	</div>
		            	<div class="col-md-4">
		              		<div class="card mb-4 box-shadow">
		                		<img class="card-img-top" src="pictures/estadia.jfif" width="200" height="200" alt="Card image cap">
		                		<div class="card-body">
		                			<h3 class="text-center">Estadía en empresas</h3>
		                  			<p class="card-text">Conoce la variedad de estadías en empresas que han sido aprobadas para nuestros alumnos.</p>
		                  			<div class="d-flex justify-content-between align-items-center">
		                    			<div class="btn-group">
		                      				<a href="ver_estadia.php"><button type="button" class="btn btn-sm btn-outline-success">Ver Más</button></a>
		                    			</div>
		                    			<small class="text-muted">
		                    				<?php  
												$sql = "SELECT * FROM estadia WHERE borrador = false";
												$resultado = mysqli_query($conexion, $sql);
												$pendiente = $resultado -> num_rows;
												$total = $total + $pendiente;
												echo $pendiente." resultados";
											?>
		                    			</small>
		                  			</div>
		                		</div>
		              		</div>
		            	</div>
		            	<div class="col-md-4">
		              		<div class="card mb-4 box-shadow">
		                		<img class="card-img-top" src="pictures/direccion.jfif" width="200" height="200" alt="Card image cap">
		                		<div class="card-body">
		                			<h3 class="text-center">Dirección individualizada</h3>
		                  			<p class="card-text">Infórmate sobre las direcciones individualizadas que llevan a cabo nuestros integrantes.</p>
		                  			<div class="d-flex justify-content-between align-items-center">
		                    			<div class="btn-group">
		                      				<a href="ver_direccion.php"><button type="button" class="btn btn-sm btn-outline-success">Ver Más</button></a>
		                    			</div>
		                    			<small class="text-muted">
		                    				<?php  
												$sql = "SELECT * FROM direccionind WHERE borrador = false";
												$resultado = mysqli_query($conexion, $sql);
												$pendiente = $resultado -> num_rows;
												$total = $total + $pendiente;
												echo $pendiente." resultados";
											?>
		                    			</small>
		                  			</div>
		                		</div>
		              		</div>
		            	</div>
		            	<div class="col-md-4">
		              		<div class="card mb-4 box-shadow">
		                		<img class="card-img-top" src="pictures/innovacion.jpg" width="200" height="200" alt="Card image cap">
		                		<div class="card-body">
		                			<h3 class="text-center">Línea de innovación</h3>
		                  			<p class="card-text">Conoce las diferentes lineas de investigación en las que trabajan nuestros integrantes.</p>
		                  			<div class="d-flex justify-content-between align-items-center">
		                    			<div class="btn-group">
		                      				<a href="ver_linea.php"><button type="button" class="btn btn-sm btn-outline-success">Ver Más</button></a>
		                    			</div>
		                    			<small class="text-muted">
		                    				<?php  
												$sql = "SELECT * FROM lineainn WHERE borrador = false";
												$resultado = mysqli_query($conexion, $sql);
												$pendiente = $resultado -> num_rows;
												$total = $total + $pendiente;
												echo $pendiente." resultados";
											?>
		                    			</small>
		                  			</div>
		                		</div>
		              		</div>
		            	</div>
		            </div>
	  			</div>

	  			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	  				<br><br>
						<h3 align="center">Producción académica</h3>
						<br>
						<?php  
							function nombre($codigo){
								$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
								$sql = "SELECT * FROM persona WHERE codigo = $codigo";
								$resultado = mysqli_query($conexion, $sql);
								$persona = mysqli_fetch_array($resultado);
								echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
							}

							$sql = "SELECT * FROM produccion WHERE aprobacion = true ORDER BY `produccion`.`id` DESC LIMIT 0, 4";
							//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
							$resultado = mysqli_query($conexion, $sql);


							while ($reg = mysqli_fetch_array($resultado)){
						?>
						<!--Vistas rapidas-->
							<div class="row mb-2">

						        <div class="col-md-6">
						          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
							          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/publicacion.jfif" alt="Card image cap" width="200" height="200">
							            <div class="card-body d-flex flex-column align-items-start">
							              	<strong class="d-inline-block mb-2 text-primary">Producción</strong>
							              	<h3 class="mb-0">
							                	<?php echo $reg['nombre']; ?>
							              	</h3>
							              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
							              	<?php 
							              	echo "<a href='produccion_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-outline-success'>Ver más</a>";
							              	?>
							            </div>
						            
						          	</div>
						        </div>
							<?php
								$reg2 = mysqli_fetch_array($resultado);
								if($reg2){
							?>

						        <div class="col-md-6">
						          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
							          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/publicacion.jfif" alt="Card image cap" width="200" height="200">
							            <div class="card-body d-flex flex-column align-items-start">
							              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
							              	<h3 class="mb-0">
							                	<?php echo $reg2['nombre']; ?>
							              	</h3>
							              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
							              	<?php 
							              	echo "<a href='produccion_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-outline-success'>Ver más</a>";
							              	?>
							            </div>
						          	</div>
						        </div>
						    </div>

					    <?php 
					    	}
				    		else{
				    				echo "</div>";
				    		}
					    	}//Llave del while
					    ?>


					    <br><br>
						<!--Vista rapida Estadias en empresas-->
						<h3 align="center">Estadía en empresas</h3>
						<br>
						<?php  
							$sql = "SELECT * FROM estadia WHERE borrador = false ORDER BY `estadia`.`id` DESC LIMIT 0, 4";
							$resultado = mysqli_query($conexion, $sql);

							while ($reg = mysqli_fetch_array($resultado)){
					?>
						<div class="row container-fluid mb-2">

					        <div class="col-md-6">
					          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
						          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/estadia.jfif" alt="Card image cap" width="200" height="200">
						            <div class="card-body d-flex flex-column align-items-start">
						              	<strong class="d-inline-block mb-2 text-primary">Estadía</strong>
						              	<h3 class="mb-0">
						                	<?php echo $reg['nombreEmpresa']; ?>
						              	</h3>
						              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
						              	<?php 
							              	echo "<a href='estadia_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a>";
							            ?>
						            </div>
					            
					          	</div>
					        </div>
						<?php
							$reg2 = mysqli_fetch_array($resultado);
							if($reg2){
						?>

					        <div class="col-md-6">
					          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
						          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/estadia.jfif" alt="Card image cap" width="200" height="200">
						            <div class="card-body d-flex flex-column align-items-start">
						              <strong class="d-inline-block mb-2 text-primary">Estadía</strong>
						              	<h3 class="mb-0">
						                	<?php echo $reg2['nombreEmpresa']; ?>
						              	</h3>
						              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
						              	<?php 
							              	echo "<a href='estadia_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a>";
							            ?>
						            </div>
					          	</div>
					        </div>
					    </div>

				    <?php 
				    	}
			    		else{
			    				echo "</div>";
			    		}
				    	}//Llave del while
				    ?>


				    <br><br>
					<!--Vista rapida direccion individualizada-->
					<h3 align="center">Dirección individualizada</h3>
					<br>
					<?php  
						$sql = "SELECT * FROM direccionind WHERE borrador = false ORDER BY `direccionind`.`id` DESC LIMIT 0, 4";
						//$sql = "SELECT * FROM produccion ORDER BY `produccion`.`id` DESC LIMIT 0, 4";
						$resultado = mysqli_query($conexion, $sql);


						while ($reg = mysqli_fetch_array($resultado)){
					?>
					<!--Vistas rapidas-->
						<div class="row container-fluid mb-2">

					        <div class="col-md-6">
					          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
						          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/direccion.jfif" alt="Card image cap" width="200" height="200">
						            <div class="card-body d-flex flex-column align-items-start">
						              	<strong class="d-inline-block mb-2 text-primary">Dirección</strong>
						              	<h3 class="mb-0">
						                	<?php echo $reg['nombreProyecto']; ?>
						              	</h3>
						              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
						              	<?php 
							              	echo "<a href='direccion_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a>";
							            ?>
						            </div>
					            
					          	</div>
					        </div>
						<?php
							$reg2 = mysqli_fetch_array($resultado);
							if($reg2){
						?>

					        <div class="col-md-6">
					          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
						          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/direccion.jfif" alt="Card image cap" width="200" height="200">
						            <div class="card-body d-flex flex-column align-items-start">
						              <strong class="d-inline-block mb-2 text-primary">Dirección</strong>
						              	<h3 class="mb-0">
						                	<?php echo $reg2['nombreProyecto']; ?>
						              	</h3>
						              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
						              	<?php 
							              	echo "<a href='direccion_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a>";
							            ?>
						            </div>
					          	</div>
					        </div>
					    </div>

				    <?php 
				    		}
			    		else{
			    			echo "</div>";
			    		}
				    	}//Llave del while
				    ?>

				    <br><br>
						<!--Vista rapida Estadias en empresas-->
						<h3 align="center">Proyectos</h3>
						<br>
						<?php  
							$sql = "SELECT * FROM proyecto WHERE aprobacion = true ORDER BY `proyecto`.`id` DESC LIMIT 0, 4";
							$resultado = mysqli_query($conexion, $sql);

							while ($reg = mysqli_fetch_array($resultado)){
					?>
						<div class="row container-fluid mb-2">

					        <div class="col-md-6">
						          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
							          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/proyecto.jfif" alt="Card image cap" width="200" height="200">
							            <div class="card-body d-flex flex-column align-items-start">
							              <strong class="d-inline-block mb-2 text-primary">Proyecto</strong>
							              	<h3 class="mb-0">
							                	<?php echo $reg['nombre']; ?>
							              	</h3>
							              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
							              	<div class="d-inline-block btn-group">
								              	<?php 
								              	echo "<a href='proyecto_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-outline-success'>Ver más</a>";
								              	?>
							              	</div>
							            </div>
						          	</div>
						        </div>
						<?php
							$reg2 = mysqli_fetch_array($resultado);
							if($reg2){
						?>

					        <div class="col-md-6">
						          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
							          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/proyecto.jfif" alt="Card image cap" width="200" height="200">
							            <div class="card-body d-flex flex-column align-items-start">
							              <strong class="d-inline-block mb-2 text-primary">Proyecto</strong>
							              	<h3 class="mb-0">
							                	<?php echo $reg2['nombre']; ?>
							              	</h3>
							              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
							              	<div class="d-inline-block btn-group">
								              	<?php 
								              	echo "<a href='proyecto_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-outline-success'>Ver más</a>";
								              	?>
							              	</div>
							            </div>
						          	</div>
						        </div>
					    </div>

				    <?php 
				    		}
			    		else{
			    			echo "</div>";
			    		}
				    	}//Llave del while
				    ?>
				</div>

	  			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	  				<div class="row">
	  					<?php  
	  						$sql = "SELECT * FROM persona WHERE nombre != 'Administrador' ORDER BY `persona`.`nombre` ASC";
	  						$resultado = mysqli_query($conexion, $sql);
	  						while($reg = mysqli_fetch_array($resultado)){
	  					?>
			  				<div class="col-md-6">
					          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
					          		<?php
									$foto = $reg['codigo'];
									if(file_exists("profile_pictures/".$foto.".jpg")){
									?>
						          		<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="profile_pictures/<?php echo $reg['codigo']; ?>.jpg" alt="Card image cap" width="200" height="200">
						          	<?php  
									}else{
									?>
										<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="profile_pictures/default.png" alt="Card image cap" width="200" height="200">
									<?php  
									}
									?>
						            <div class="card-body d-flex flex-column align-items-start">
						            	<?php  
						            		$codigo = $reg['codigo'];
						            		$sql = "SELECT * FROM usuario WHERE codigo = '$codigo'";
	  										$resul = mysqli_query($conexion, $sql);
	  										$usreg = mysqli_fetch_array($resul);
						            		if($usreg['nivel']==1){
						            			echo '<strong class="d-inline-block mb-2 text-primary">Colaborador</strong>';
						            		}
						            		else if($usreg['nivel']==2){
						            			echo '<strong class="d-inline-block mb-2 text-primary">Integrante</strong>';
						            		}
						            		else if($usreg['nivel']==3){
						            			echo '<strong class="d-inline-block mb-2 text-primary">Administrador</strong>';
						            		}
						            	?>
						              	
						              	<h3 class="mb-0">
						                	<?php echo $reg['nombre']." ".$reg['apellidoP']." ".$reg['apellidoM']; ?>
						              	</h3>
						              	<div class="mb-1 text-muted"><?php echo $reg['escolaridad']; ?></div>
						              	<div class="mb-1 text-muted"><?php echo $reg['email']; ?></div>
						              	<?php  
						              		if($reg['telefono'] >= 10000000 && $reg['telefono'] <= 9999999999999){
						              			echo '<div class="mb-1 text-muted">'.$reg['telefono'].'</div>';
						              		}
						              	
						              	?>
						            </div>
					            
					          	</div>
					        </div>
				        <?php  
				        }
				        ?>
			        </div>
	  			</div>
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