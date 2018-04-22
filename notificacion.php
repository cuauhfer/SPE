<!DOCTYPE html>
<html>
<head>
	<!--Meta-->
	<meta charset="UTF-8">
	<meta name="" ="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<!--Estilos-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_style_administrador.css">
	<!--Favicon-->
	<link rel="icon" type="image/png" href="pictures/logo.png" />
	<!--Script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src='js/script-form.js'></script>
	<!--Titulo-->
	<title>Pendientes</title>
</head>

<?php 
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 
		//Conexion a BD
		$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
		$usuario = $_SESSION['username'];
		$sql = "SELECT * FROM `log` ORDER BY `fecha` DESC";
		$resultado = mysqli_query($conexion, $sql);
		$reg = mysqli_fetch_array($resultado);
?>

	<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<a href='administrador.php'><li>Principal</li></a>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>

					<a href='logout.php'><li>Salir</li></a>
				</ul>
			</nav>
		</header>

		<section>
			<br><br><br><br>
			<div class="container-fluid">
				<h1 align="center">Pendientes</h1>
			<?php
				function nombre($codigo){
					$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
					$sql = "SELECT * FROM persona WHERE codigo = $codigo";
					$resultado = mysqli_query($conexion, $sql);
					$persona = mysqli_fetch_array($resultado);
					echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
				}

				$sql = "SELECT * FROM produccion WHERE aprobacion = false";
				$resultado = mysqli_query($conexion, $sql);
				while($reg = mysqli_fetch_array($resultado)){
					if(!$reg){
						echo "<h2 class='text-muted' align='center'>No hay más pendientes por revisar</h2>";
					}
					?>
						<!--Vistas rapidas-->
					<div class="row mb-2">

				        <div class="col-md-6">
				          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
					          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              	<strong class="d-inline-block mb-2 text-primary">Producción</strong>
					              	<h3 class="mb-0">
					                	<a class="text-dark" href="#"><?php echo $reg['nombre']; ?></a>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
					              	<div class="d-inline-block">
						              	<?php 
						              	echo "<a href='produccion_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-primary'>Ver mas</a>";
						              	?>
						              	<?php 
						              	echo "<a href='status_aprobar.php/?nombre=".$reg['id']."' class='btn btn-success'>Aprobar</a>";
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
					          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Kiokay.png" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
					              	<h3 class="mb-0">
					                	<a class="text-dark" href="#"><?php echo $reg2['nombre']; ?></a>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
					              	<div class="d-inline-block">
						              	<?php 
						              	echo "<a href='produccion_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-primary'>Ver mas</a>";
						              	?>
						              	<?php 
						              	echo "<a href='status_aprobar.php/?nombre=".$reg2['id']."' class='btn btn-success'>Aprobar</a>";
						              	?>
					              	</div>
					            </div>
				          	</div>
				        </div>
				    </div>
					<?php
					}
				}

				$sql = "SELECT * FROM proyecto WHERE aprobacion = false";
				$resultado = mysqli_query($conexion, $sql);
				while($penpd = mysqli_fetch_array($resultado)){

				}
			?>
			</div>
		</section>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

<?php }
	else{
		header('Location: login.php');
	}

?>
</html>