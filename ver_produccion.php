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
	<title>Producción</title>
</head>

<?php 
	//Conexion a BD
	$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
	$usuario = $_SESSION['username'];
	$sql = "SELECT * FROM usuario WHERE username='$usuario'";
	$resultado = mysqli_query($conexion, $sql);
	$reg = mysqli_fetch_array($resultado);

	$codigo = $reg['codigo'];

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
				<a href='logout.php'><li>Salir</li></a>
			</ul>
		</nav>
	</header>

	<br><br><br>
			<!--Vista rapida-->
			<h1 align="center">Producción Academica</h1>
			<br>
			<?php  
				function nombre($codigo){
					$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
					$sql = "SELECT * FROM persona WHERE codigo = $codigo";
					$resultado = mysqli_query($conexion, $sql);
					$persona = mysqli_fetch_array($resultado);
					echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
				}

				$sql = "SELECT * FROM produccion WHERE aprobacion = true ORDER BY `produccion`.`id`";
				//$sql = "SELECT * FROM produccion ORDER BY `produccion`.`id` DESC LIMIT 0, 4";
				$resultado = mysqli_query($conexion, $sql);


				while ($reg = mysqli_fetch_array($resultado)){
			?>
			<!--Vistas rapidas-->
				<div class="row mb-2">

			        <div class="col-md-6">
			          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
				          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Adlet.png" alt="Card image cap" width="200" height="200">
				            <div class="card-body d-flex flex-column align-items-start">
				              	<strong class="d-inline-block mb-2 text-primary">Producción</strong>
				              	<h3 class="mb-0">
				                	<?php echo $reg['nombre']; ?>
				              	</h3>
				              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
				              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-primary'>Ver mas</a>";
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
				          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Adlet.png" alt="Card image cap" width="200" height="200">
				            <div class="card-body d-flex flex-column align-items-start">
				              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
				              	<h3 class="mb-0">
				                	<?php echo $reg2['nombre']; ?>
				              	</h3>
				              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
				              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-primary'>Ver mas</a>";
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

<?php  

?>

</html>