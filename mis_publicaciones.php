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
	<div class="container-fluid">
		<br><br><br><br>
		<!--Vista rapida-->
		
		<?php  
			if(isset($_SESSION['administrador'])){
				?>
					<h1 class="bg-dark text-white" align="center">Mis publicaciones</h1>
					<br>
				<?php
			}
			else if(isset($_SESSION['integrante'])){
				?>
					<h1 class="bg-dark text-white" align="center">Mis publicaciones</h1>
					<br>
				<?php
			}

			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

			function nombre($codigo){
				$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");
				$sql = "SELECT * FROM persona WHERE codigo = $codigo";
				$resultado = mysqli_query($conexion, $sql);
				$persona = mysqli_fetch_array($resultado);
				echo $persona['nombre']." ".$persona['apellidoP']." ".$persona['apellidoM'];
			}

			$user = $_SESSION['user'];
			$cod = $user['codigo'];


			$sql = "SELECT * FROM produccion WHERE autor = '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
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
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."&tipo=".$reg['tipoPublicacion']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=1' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=1' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Adlet.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
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
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."&tipo=".$reg2['tipoPublicacion']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=1' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=1' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM proyecto WHERE autor = '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Kiokay.png" alt="Card image cap" width="200" height="200">
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
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."&tipo=8' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=2' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=2' class='btn btn-outline-danger'>Eliminar</a>";
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
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."&tipo=8' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=2' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=2' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM estadia WHERE codigoPersona = '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Rukia.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Estadía en empresas</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg['nombreEmpresa']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='estadia_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=3' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=3' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Rukia.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Estadía en empresas</strong>
			              	<?php  
					        	if($reg2['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg2['nombreEmpresa']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='estadia_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=3' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=3' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		            
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM direccionind WHERE codigoPersona = '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Dirección individualizada</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg['nombreProyecto']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='direccion_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=4' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=4' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Dirección individualizada</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg2['nombreProyecto']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='direccion_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=4' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=4' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		            
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	if(isset($_SESSION['administrador'])){
	    ?>

	    <h1 class="bg-dark text-white" align="center">Publicaciones generales</h1>
		<br>
		<?php  

			$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

			$user = $_SESSION['user'];
			$cod = $user['codigo'];
			$sql = "SELECT * FROM produccion WHERE autor != '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
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
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."&tipo=".$reg['tipoPublicacion']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=1' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=1' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Adlet.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
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
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."&tipo=".$reg2['tipoPublicacion']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=1' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=1' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM proyecto WHERE autor != '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Kiokay.png" alt="Card image cap" width="200" height="200">
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
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."&tipo=8' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=2' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=2' class='btn btn-outline-danger'>Eliminar</a>";
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
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."&tipo=8' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=2' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=2' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM estadia WHERE codigoPersona != '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Rukia.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Estadía en empresas</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg['nombreEmpresa']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='estadia_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=3' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=3' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Rukia.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Estadía en empresas</strong>
			              	<?php  
					        	if($reg2['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg2['nombreEmpresa']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='estadia_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=3' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=3' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		            
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

	    	$sql = "SELECT * FROM direccionind WHERE codigoPersona != '$cod'";
			//$sql = "SELECT * FROM produccion ORDER BY 'id' DESC LIMIT 0, 4";
			$resultado = mysqli_query($conexion, $sql);


			while ($reg = mysqli_fetch_array($resultado)){
		?>
		<!--Vistas rapidas-->
			<div class="row mb-2">

		        <div class="col-md-6">
		          	<div class="card flex-md-row mb-4 box-shadow h-md-250">
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Dirección individualizada</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg['nombreProyecto']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='direccion_ind.php/?nombre=".$reg['id']."&autor=".$reg['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=1&subaccion=4' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg['id']."&accion=0&subaccion=4' class='btn btn-outline-danger'>Eliminar</a>";
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
			          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
			            <div class="card-body d-flex flex-column align-items-start">
			              	<strong class="d-inline-block mb-2 text-primary">Dirección individualizada</strong>
			              	<?php  
					        	if($reg['borrador'] == true){
					        		echo '<span class="badge badge-warning">Borrador</span>';
					        	}
					        	else{
					        		echo '<span class="badge badge-success">Público</span>';
					        	}
					        ?>
			              	<h3 class="mb-0">
			                	<?php echo $reg2['nombreProyecto']; ?>
			              	</h3>
			              	<div class="mb-1 text-muted"><?php echo nombre($reg2['codigoPersona']); ?></div>
			              	<div class="d-inline-block btn-group">
			              	<?php 
			              	echo "<a href='direccion_ind.php/?nombre=".$reg2['id']."&autor=".$reg2['codigoPersona']."' class='btn btn-outline-success'>Ver más</a> "; 
			              	echo "<a href='status_modificar.php/?id=".$reg2['id']."' class='btn btn-outline-primary'>Modificar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=1&subaccion=4' class='btn btn-outline-secondary'>Ocultar</a> ";
			              	echo "<a href='status_eliminar.php/?id=".$reg2['id']."&accion=0&subaccion=4' class='btn btn-outline-danger'>Eliminar</a>";
			              	?>
			              	</div>
			            </div>
		            
		          	</div>
		        </div>
		    </div>

	    <?php 
	    		}
	    		else{
	    			?>
	    				</div>
	    			<?php
	    		}
	    	}//Llave del while

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