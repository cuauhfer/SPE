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
		else if(isset($_SESSION['colaborador']) || isset($_SESSION['visitante'])){
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
	<script>
		function confirmar(){
			if(confirm("¿Estas seguro? \n Se te eliminara del sistema.")){
				return true;
			}
			return false;
		}
	</script>
	<!--Titulo-->
	<title>Proyecto</title>
</head>

<?php 
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
?>

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
				else if(isset($_SESSION['visitante'])){
					?>
					<a href='index.php'><li>Principal</li></a>
			<?php
				}
			?>
			</ul>
					
				<img id='logo' src='pictures/logo.png'>

			<ul>
				<section align="right">
						<form class="form-inline my-2 my-lg-0" method="post">
      						<input class="form-control mr-sm-2" type="search" name="busca" id="busca" laceholder="Buscar" aria-label="Buscar">
      						<button class="btn btn-outline-primary my-2 my-sm-0"  name="buscar" id="buscar" type="submit">Buscar</button>
      						<?php 
      							if(isset($_SESSION['administrador']) || isset($_SESSION['integrante']) || isset($_SESSION['colaborador'])){
      								echo "<a href='logout.php'><li>Salir</li></a>";
      							}
      						?>
   						</form>
   				</section>
				
			</ul>
		</nav>
	</header>
	<br><br><br><br>
			<!--Vista rapida-->
			<h1 align="center">Proyectos</h1>
			<br>
			<?php  
				function nombre($codigo){
					$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
					$sql = "SELECT * FROM persona WHERE codigo = $codigo";
					$resultado = mysqli_query($conexion, $sql);
					$persona = mysqli_fetch_array($resultado);
					echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
				}

				if(isset($_POST['buscar'])){
					$bus = $_POST['busca'];
					$sql = "SELECT * FROM persona WHERE `nombre` LIKE '%$bus%' OR (`apellidoP` LIKE '%$bus%' OR `apellidoM` LIKE '%$bus%') ORDER BY `persona`.`codigo`";
					$resultadoautor = mysqli_query($conexion, $sql);

					$sql = "SELECT * FROM proyecto WHERE aprobacion = true AND `nombre` LIKE '%$bus%' ORDER BY `proyecto`.`id`";
					$resultado = mysqli_query($conexion, $sql);

					while($reg = mysqli_fetch_array($resultadoautor)){
						$codigo = $reg['codigo'];
						$sql = "SELECT * FROM proyecto WHERE aprobacion = true AND (`autor` LIKE '%$codigo%' OR `nombre` LIKE '%$bus%') ORDER BY `proyecto`.`id`";
						$resultado = mysqli_query($conexion, $sql);
					}
				}
				else{
					$sql = "SELECT * FROM proyecto WHERE aprobacion = true ORDER BY `proyecto`.`id`";
					$resultado = mysqli_query($conexion, $sql);
				}

				while ($reg = mysqli_fetch_array($resultado)){
			?>
			<!--Vistas rapidas-->
				<div class="row container-fluid mb-2">

			        <div class="col-md-6">
			          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
				          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/kiokay.png" alt="Card image cap" width="200" height="200">
				            <div class="card-body d-flex flex-column align-items-start">
				              	<strong class="d-inline-block mb-2 text-primary">Proyecto</strong>
				              	<h3 class="mb-0">
				                	<?php echo $reg['nombre']; ?>
				              	</h3>
				              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
				              	<?php 
					              	echo "<a href='proyecto_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-primary'>Ver mas</a>";
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
				          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/kiokay.png" alt="Card image cap" width="200" height="200">
				            <div class="card-body d-flex flex-column align-items-start">
				              <strong class="d-inline-block mb-2 text-primary">Proyecto</strong>
				              	<h3 class="mb-0">
				                	<?php echo $reg2['nombre']; ?>
				              	</h3>
				              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
				              	<?php 
					              	echo "<a href='proyecto_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-primary'>Ver mas</a>";
					            ?>
				            </div>
			          	</div>
			        </div>
			    </div>

		    <?php 
		    		}
		    	}//Llave del while
		    ?>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<br>
</body>
</html>