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

			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

			function nombre($codigo){
				$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
				$sql = "SELECT * FROM persona WHERE codigo = $codigo";
				$resultado = mysqli_query($conexion, $sql);
				$persona = mysqli_fetch_array($resultado);
				echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
			}

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
			else if(isset($_SESSION['colaborador']) || isset($_SESSION['visitante'])){
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
<body>
	<header class="fixed-top">
			<nav>
				<ul>
					<a href="javascript:window.history.go(-1);"><li>Volver</li></a>
				</ul>
						
					<img id='logo' src='../pictures/logo.png'>

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
						else if(isset($_SESSION['colaborador'])){
					?>
						<a href='../colaborador.php'><li>Principal</li></a>
					<?php
						}
						else if(isset($_SESSION['visitante'])){
					?>
						<a href='../index.php'><li>Principal</li></a>
					<?php
						}
					?>
					<?php  
						if(!isset($_SESSION['visitante'])){
					?>
					<a href='../logout.php'><li>Salir</li></a>
					<?php  
						}
					?>
				</ul>
			</nav>
	</header>

	<?php 
		$var1 = $_GET['nombre'];
		$var2 = $_GET['autor']; 

		$sql = "SELECT * FROM produccion WHERE nombre='$var1'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){
	?>

	<section>
		<br><br><br><br>
		<div class="container">

			<div class="row jumbotron p-3 p-md-5 rounded bg-ligth rounded">
				<div class="col-md-4">
					<img class="card-img-right flex-auto d-none d-md-block" src="../pictures/Adlet.png" alt="Card image cap" width="200" height="200">
				</div>
	        	<div class="col-md-8 px-0">
			        <h3 class="text-primary display-4 font-italic"><?php echo $reg['nombre'];?></h3>
			        <div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
			        <div class="mb-1 text-muted"><?php echo $reg['fecha'] ?></div>
			        <?php
				        if($reg['tipoPublicacion'] == "1"){
				        	$idpu = $reg['id'];
				        	$sql = "SELECT * FROM articulo WHERE idProduccion='$idpu'";
							$resultado = mysqli_query($conexion, $sql);
							$art = mysqli_fetch_array($resultado);

							$idli = $art['linea'];
							$sql = "SELECT * FROM lineainn WHERE id='$idli'";
							$resultado = mysqli_query($conexion, $sql);
							$lin = mysqli_fetch_array($resultado);
							?>
								<div class="mb-1 text-muted">Articulo</div>
								<div class="mb-1">Revista: <?php echo $art['revista'] ?></div>
								<div class="mb-1"><?php echo $art['paginas'] ?></div>
								<div class="mb-1">ISSN: <?php echo $art['issn'] ?></div>
								<div class="mb-1">Campo: <?php echo $lin['nombre'] ?></div>
							<?php	
						}else if($reg['tipoPublicacion'] == "2"){
							$idpu = $reg['id'];
				        	$sql = "SELECT * FROM informetec WHERE idProduccion='$idpu'";
							$resultado = mysqli_query($conexion, $sql);
							$inf = mysqli_fetch_array($resultado);

							?>
								<div class="mb-1 text-muted">Informe Técnico</div>
								<div class="mb-1">Dependencia: <?php echo $inf['dependencia'] ?></div>
							<?php
						}else if($reg['tipoPublicacion'] == "3"){
							$idpu = $reg['id'];
				        	$sql = "SELECT * FROM manual WHERE idProduccion='$idpu'";
							$resultado = mysqli_query($conexion, $sql);
							$man = mysqli_fetch_array($resultado);

							?>
								<div class="mb-1 text-muted">Manual</div>
								<div class="mb-1">Registro: <?php echo $man['registro'] ?></div>
							<?php
						}else if($reg['tipoPublicacion'] == "4"){
							$idpu = $reg['id'];
				        	$sql = "SELECT * FROM libro WHERE idProduccion='$idpu'";
							$resultado = mysqli_query($conexion, $sql);
							$lib = mysqli_fetch_array($resultado);

							$idli = $lib['linea'];
							$sql = "SELECT * FROM lineainn WHERE id='$idli'";
							$resultado = mysqli_query($conexion, $sql);
							$lin = mysqli_fetch_array($resultado);
							?>
								<div class="mb-1 text-muted">Libro</div>
								<div class="mb-1">Editorial: <?php echo $lib['editorial'] ?></div>
								<div class="mb-1"><?php echo $lib['paginas'] ?></div>
								<div class="mb-1">ISSN: <?php echo $lib['isbn'] ?></div>
								<div class="mb-1">Campo: <?php echo $lin['nombre'] ?></div>
							<?php
						} 
						if($reg['borrador'] == true){
							echo "<div class='mb-1'>Borrador</div>";
						}
					?>
		        </div>
	      	</div>
      	</div>
	</section>
	<?php 
		}
	?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>