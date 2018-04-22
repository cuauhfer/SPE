<!DOCTYPE html>
<html lang="es">
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
	<script src='js/script.js'></script>
	<!--Titulo-->
	<title>Administrador SPE</title>
</head>

<?php 
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['administrador'])){ 
?>

	<body>
		<header class="fixed-top">
			<nav>
				<ul>
					<a href='persona.php'><li>Perfil</li></a>
					<a href='admin_usuario.php'><li>Usuarios</li></a>
					<a href='notificacion.php'><li>Pendientes</li></a>
					<a href='mis_publicaciones.php'><li>Publicaciones</li></a>
					<a href='log.php'><li>Logs</li></a>
				</ul>
					
					<img id='logo' src='pictures/logo.png'>

				<ul>
					
					<section align="right">
						<form class="form-inline my-2 my-lg-0">
      						<input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
      						<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Buscar</button>
      						<a href='logout.php'><li>Salir</li></a>
   						</form>
   					</section>
				</ul>
			</nav>
		</header>

		<section id='banner'>
		</section>

		<section id='body'>
			<br>
			<div class="container-fluid">
				<!--Carrusel de Imagenes-->	
				<section class="row" id="carrusel">
					
					<script type="text/javascript">
							//Ancho (en pixeles)
							var screen = screen.availWidth;
							var sliderwidth=(screen)+"px"
							//Alto
							var sliderheight="200px"
							//Velocidad 1-10
							var slidespeed=1
							//Color de fondo:
							slidebgcolor="#FFFFFF"

							//Vínculos y enlaces de las imágenes
							var leftrightslide=new Array()
							var finalslide=''
							leftrightslide[0]='<a href="int_produccion.php" target="blank" title="Nueva Produccion Academica"><img border="1" src="pictures/Albedo.png" height="200"></a>'
							leftrightslide[1]='<a href="https://google.com" target="blank" title="Google"><img border="1" src="pictures/Kiokay.png" height="200"></a>'
							leftrightslide[2]='<a href="https://youtube.com" target="blank" title="Youtube"><img border="1" src="pictures/Ulquiorra.png" height="200"></a>'
							leftrightslide[3]='<a href="http://cuceineerbd.byethost17.com/Home.html" target="blank" title="Home"><img border="1" src="pictures/Rukia.png" height="200"></a>'
							leftrightslide[4]='<a href="http://blog.belzec.net/" target="blank" title="Belzec"><img border="1" src="pictures/Adlet.png" height="200"></a>'
							
							var imagegap=""
							var slideshowgap=5


							var copyspeed=slidespeed
							leftrightslide='<nobr>'+leftrightslide.join(imagegap)+'</nobr>'
							var iedom=document.all||document.getElementById
							if (iedom)
								document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+leftrightslide+'</span>')
							var actualwidth=''
							var cross_slide, ns_slide

							function fillup(){
							if (iedom){
								cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2
								cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3
								cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
								actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth
								cross_slide2.style.left=actualwidth+slideshowgap+"px"
							}
							else if (document.layers){
								ns_slide=document.ns_slidemenu.document.ns_slidemenu2
								ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
								ns_slide.document.write(leftrightslide)
								ns_slide.document.close()
								actualwidth=ns_slide.document.width
								ns_slide2.left=actualwidth+slideshowgap
								ns_slide2.document.write(leftrightslide)
								ns_slide2.document.close()
								}
								lefttime=setInterval("slideleft()",30)
							}
							window.onload=fillup

							function slideleft(){
								if (iedom){
									if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
										cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
									else
										cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"

									if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
										cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
									else
										cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"

								}
								else if (document.layers){
									if (ns_slide.left>(actualwidth*(-1)+8))
										ns_slide.left-=copyspeed
									else
										ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

									if (ns_slide2.left>(actualwidth*(-1)+8))
										ns_slide2.left-=copyspeed
									else
										ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
								}
							}


							if (iedom||document.layers){
								with (document){
									document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
									if (iedom){
										write('<div style="position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">')
										write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onmouseover="copyspeed=0" onmouseout="copyspeed=slidespeed">')
										write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>')
										write('<div id="test3" style="position:absolute;left:-1000px;top:0px"></div>')
										write('</div></div>')
									}
									else if (document.layers){
										write('<ilayer width="+sliderwidth+" height="+sliderheight+" name="ns_slidemenu" bgcolor="+slidebgcolor+">')
										write('<layer left="0" top="0" onmouseover="copyspeed=0" onmouseout="copyspeed=slidespeed" name="ns_slidemenu2"></layer>')
										write('<layer left="0" top="0" onmouseover="copyspeed=0" onmouseout="copyspeed=slidespeed" name="ns_slidemenu3"></layer>')
										write('</ilayer>')
									}
									document.write('</td></table>')
								}
							}
					</script> 
				</section>

				<br><br><br>
				<!--Vista rapida-->
				<h1 align="center">Lo más Reciente</h1>
				<br>
				<?php  

					$conexion = mysqli_connect("localhost", "Fernando", "Cuauhtli", "b17_21017364_CuerpoAcademico");

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
					          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Ulquiorra.png" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              	<strong class="d-inline-block mb-2 text-primary">Producción</strong>
					              	<h3 class="mb-0">
					                	<?php echo $reg['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg['autor']); ?></div>
					              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg['nombre']."&autor=".$reg['autor']."' class='btn btn-danger'>Ver mas</a>";
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
					          	<img class="card-img-right flex-auto d-none d-md-block" src="pictures/Kiokay.png" alt="Card image cap" width="200" height="200">
					            <div class="card-body d-flex flex-column align-items-start">
					              <strong class="d-inline-block mb-2 text-primary">Producción</strong>
					              	<h3 class="mb-0">
					                	<?php echo $reg2['nombre']; ?>
					              	</h3>
					              	<div class="mb-1 text-muted"><?php echo nombre($reg2['autor']); ?></div>
					              	<?php 
					              	echo "<a href='produccion_ind.php/?nombre=".$reg2['nombre']."&autor=".$reg2['autor']."' class='btn btn-danger'>Ver mas</a>";
					              	?>
					            </div>
				          	</div>
				        </div>
				    </div>

			    <?php 
			    		}
			    	}//Llave del while
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