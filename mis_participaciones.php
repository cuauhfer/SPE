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
			function nombre($codigo){
				$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
				$sql = "SELECT * FROM persona WHERE codigo = $codigo";
				$resultado = mysqli_query($conexion, $sql);
				$persona = mysqli_fetch_array($resultado);
				echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
			}

			if(isset($_SESSION['username'])){
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
				else if(isset($_SESSION['colaborador'])){
					?>
					<link rel="stylesheet" href="css/index_style_home.css">
					<?php
				}
		?>
		<!--Favicon-->
		<link rel="icon" type="image/png" href="pictures/logo.png" />
		<!--Script-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src='js/script-form.js'></script>
		<!--Titulo-->
		<title>Publicaciones</title>
</head>
<body>
	<header class="fixed-top">
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
					else if(isset($_SESSION['colaborador'])){
				?>
					<a href='colaborador.php'><li>Principal</li></a>
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

	<!--Div para participaciones propias-->
	<div class="container-fluid">
		<br><br><br><br>
		<h1 class="bg-success text-white" align="center">Publicaciones donde participaste</h1>
		<br>
		<!--Vista rapida-->
		<?php
			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

			$user = $_SESSION['user'];
			$cod = $user['codigo'];
		?>

		<!--Divs de contenido-->
		<br>
		<div class="tab-content container-fluid" id="myTabContent">
			<div class="tab-pane fade show active" id="produccion" role="tabpanel" aria-labelledby="produccion-tab">
				<div class="row">
				<?php
					$sql = "SELECT * FROM personaproduccion WHERE codigoPersona = '$cod'";
					$resper = mysqli_query($conexion, $sql);

					while($regper = mysqli_fetch_array($resper)){
						$id = $regper['idProduccion'];
						$sql = "SELECT * FROM produccion WHERE id = '$id'";
						$resultado = mysqli_query($conexion, $sql);

						while ($reg = mysqli_fetch_array($resultado)){
				?>
				<!--Vistas rapidas-->
					

				        <div class="col-md-6">
				          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
					          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/publicacion.jfif" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              	<?php  
					            		if($reg['tipoPublicacion'] == 1){
					            			$idpr = $reg['id'];
					            			$sql = "SELECT * FROM articulo WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoArticulo'].'</strong>';
					            		}
					            		if($reg['tipoPublicacion'] == 2){
					            			echo '<strong class="d-inline-block mb-2 text-primary">Informe técnico</strong>';
					            		}
					            		if($reg['tipoPublicacion'] == 3){
					            			$idpr = $reg['id'];
					            			$sql = "SELECT * FROM manual WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoManual'].'</strong>';
					            		}
					            		if($reg['tipoPublicacion'] == 4){
					            			$idpr = $reg['id'];
					            			$sql = "SELECT * FROM libro WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoLibro'].'</strong>';
					            		}
					            	?>
					              	<?php  
							        	if($reg['aprobacion'] == true){
							        		echo '<span class="badge badge-success">Público</span>';
							        	}
							        	else if($reg['borrador'] == true){
							        		echo '<span class="badge badge-warning">Borrador</span>';
							        	}
							        	else if($reg['rechazo'] == true){
							        		echo '<span class="badge badge-danger">Rechazada</span>';
							        	}
							        	else{
							        		echo '<span class="badge badge-dark">En espera</span>';
							        	}
							        ?>
					              	<h3 class="mb-0">
					                	<?php echo $reg['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
					              	<div class="d-inline-block btn-group">
					              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-outline-success'>Ver más</a> "; 
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
					          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/publicacion.jfif" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              	<?php  
					            		if($reg2['tipoPublicacion'] == 1){
					            			$idpr = $reg2['id'];
					            			$sql = "SELECT * FROM articulo WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoArticulo'].'</strong>';
					            		}
					            		if($reg2['tipoPublicacion'] == 2){
					            			echo '<strong class="d-inline-block mb-2 text-primary">Informe técnico</strong>';
					            		}
					            		if($reg2['tipoPublicacion'] == 3){
					            			$idpr = $reg2['id'];
					            			$sql = "SELECT * FROM manual WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoManual'].'</strong>';
					            		}
					            		if($reg2['tipoPublicacion'] == 4){
					            			$idpr = $reg2['id'];
					            			$sql = "SELECT * FROM libro WHERE idProduccion = '$idpr'"; 
					            			$resul = mysqli_query($conexion, $sql);
					            			$resart = mysqli_fetch_array($resul);
					            			echo '<strong class="d-inline-block mb-2 text-primary">'.$resart['tipoLibro'].'</strong>';
					            		}
					            	?>
					              <?php  
							        	if($reg2['aprobacion'] == true){
							        		echo '<span class="badge badge-success">Público</span>';
							        	}
							        	else if($reg2['borrador'] == true){
							        		echo '<span class="badge badge-warning">Borrador</span>';
							        	}
							        	else if($reg2['rechazo'] == true){
							        		echo '<span class="badge badge-danger">Rechazada</span>';
							        	}
							        	else{
							        		echo '<span class="badge badge-dark">En espera</span>';
							        	}
							        ?>
					              	<h3 class="mb-0">
					                	<?php echo $reg2['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
					              	<div class="d-inline-block btn-group">
					              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-outline-success'>Ver más</a> ";
					              	?>
					              	</div>
					            </div>
				          	</div>
				        </div>
				    

			    <?php 
				    		}
				    	}//Llave del while
				    }//Llave del otro while
		    	?>
	    		</div>
				<div class="row">
				<?php

					$sql = "SELECT * FROM personaproyecto WHERE codigoPersona = '$cod'";
					$resper = mysqli_query($conexion, $sql);

					while($regper = mysqli_fetch_array($resper)){
						$id = $regper['idProyecto'];
						$sql = "SELECT * FROM proyecto WHERE id = '$id'";
						$resultado = mysqli_query($conexion, $sql);


						while ($reg = mysqli_fetch_array($resultado)){
				?>
				<!--Vistas rapidas-->
					
				        <div class="col-md-6">
				          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
					          	<img class="card-img-right flex-auto d-none d-md-block rounded-circle" src="pictures/proyecto.jfif" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              	<strong class="d-inline-block mb-2 text-primary">Proyecto</strong>
					              	<?php  
							        	if($reg['aprobacion'] == true){
							        		echo '<span class="badge badge-success">Público</span>';
							        	}
							        	else if($reg['borrador'] == true){
							        		echo '<span class="badge badge-warning">Borrador</span>';
							        	}
							        	else if($reg['rechazo'] == true){
							        		echo '<span class="badge badge-danger">Rechazada</span>';
							        	}
							        	else{
							        		echo '<span class="badge badge-dark">En espera</span>';
							        	}
							        ?>
					              	<h3 class="mb-0">
					                	<?php echo $reg['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
					              	<div class="d-inline-block btn-group">
					              	<?php 
					              	echo "<a href='proyecto_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-outline-success'>Ver más</a> "; 
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
					              <?php  
							        	if($reg2['aprobacion'] == true){
							        		echo '<span class="badge badge-success">Público</span>';
							        	}
							        	else if($reg2['borrador'] == true){
							        		echo '<span class="badge badge-warning">Borrador</span>';
							        	}
							        	else if($reg2['rechazo'] == true){
							        		echo '<span class="badge badge-danger">Rechazada</span>';
							        	}
							        	else{
							        		echo '<span class="badge badge-dark">En espera</span>';
							        	}
							        ?>
					              	<h3 class="mb-0">
					                	<?php echo $reg2['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
					              	<div class="d-inline-block btn-group">
					              	<?php 
					              	echo "<a href='proyecto_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-outline-success'>Ver más</a> ";
					              	?>
					              	</div>
					            </div>
				          	</div>
				        </div>
					<?php 
					    		}
					    	}//Llave del while
					    }//Llave del otro while
			    	?>
	    		</div>
			</div>		
		</div>
	</div>
</body>
<?php
	}else{
		header('Location: login.php');
	}
?>
</html>