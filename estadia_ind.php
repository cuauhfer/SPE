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
	<title>Estadía</title>
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

		$sql = "SELECT * FROM estadia WHERE id ='$var1'";
		$resultado = mysqli_query($conexion, $sql);
		while($reg = mysqli_fetch_array($resultado)){
	?>

	<section>
		<br><br><br><br>
		<div class="container">

			<div class="row jumbotron p-3 p-md-5 rounded bg-ligth rounded">
				<div class="col-md-4">
					<img class="card-img-right flex-auto d-none d-md-block" src="../pictures/Rukia.png" alt="Card image cap" width="200" height="200">
				</div>
	        	<div class="col-md-8 px-0">
			        <h3 class="text-primary display-4 font-italic"><?php echo $reg['nombreEmpresa'];?></h3>
			        <?php  
			        	if($reg['borrador'] == true){
			        		echo '<span class="badge badge-warning">Borrador</span>';
			        	}
			        ?>
			        <div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>

			        <div class="mb-1 text-muted">Estadía en Empresas</div>
					<div class="mb-1">Codigo de Estadía: <?php echo $reg['id'] ?></div>
					<div class="mb-1">Nombre de Empresa: <?php echo $reg['nombreEmpresa'] ?></div>
					<div class="mb-1">Descripción: <?php echo $reg['descripcion'] ?></div>
					<div class="mb-1">Alumnos Participantes:
					<div class="row">
						<table class="table table-dark table-bordered table-striped table-hover">
							<tr><th>Nombre Alumno</th><th>Carrera</th></tr>
					        <?php
					        $sql = "SELECT * FROM alumnoestadia";
							$alumDir = mysqli_query($conexion, $sql);
							
							while( $actual = mysqli_fetch_array($alumDir)  ){
								if( $actual['idEstadia'] == $reg['id'] ){
									$idAlu = $actual['idAlumno'];
									$sql = "SELECT * FROM alumno WHERE idAlumno = '$idAlu'";
						    		$resultado3 = mysqli_query($conexion, $sql);
									
									while( $row = mysqli_fetch_array($resultado3) ){
										echo "<tr><td>".$row['nombreAlumno']." ".$row['apellidoP']." ".$row['apellidoM']."</td><td>". $row['carrera']."</td></tr>"; 
									}
								}
							}//Llave del while
							?>
						</table>
					</div>
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