<?php
session_start();
include('php/sesion.php');
/*echo" <pre> ";
print_r($_SESSION);
echo" </pre> ";*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abacox inicio</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
			a{
			text-decoration:none;
			color:black;
			margin:0px;
			padding:0px;
		}
		li{
			margin-left:5px;
			padding:0px;
		}
		ul{
			margin:0px;
			padding:0px;
		}
		.pointer {
			cursor: pointer;
		}
		ul, ol{
			list-style:none;
		}
		#nav li ul{
			margin-left:5px;
			display:none;
			
		}
		#nav li:hover>ul{
			display: block;
		}
		.administracion #controlador #primer:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba1:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba2:hover{
			margin-bottom:300px;
		}
		.administracion #controlador #prueba3:hover{
			margin-bottom:300px;
		}
		hr{
			margin:0px;
			width:200px;
			size:30px;
			color:white;
		}
	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
	<script src="js/views/taquilla.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/atracciones.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/condicion.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/casillero.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/sadicionales.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/scategoria.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/metodo_pago.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/boleteria.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/disponibilidad.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/recepcion_pago.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/menus.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/usuarios.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/funciones.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="css/dataTables.min.css"/>	
	<script type="text/javascript" charset="utf8"  src="js/jquery.dataTables.min.js"></script>-->
	<link rel="stylesheet" href="css/main.css">

	<script>

function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora

    horaImprimible = hora + " : " + minuto + " : " + segundo

	$("#Hora").html(horaImprimible)

    //document.form_reloj.reloj.value = horaImprimible

    setTimeout("mueveReloj()",1000)
}

	$(document).on("click", "#taquilla", function(){

		window.location.href="taquilla.php";
		
	});

	$(document).on("click", "#registro", function(){

	window.location.href="registro_pasaportes.php";

	});

	$(document).on("click", "#configuracion", function(){

	$("#contenido").load("menu_crud.html")
	//window.location.href="menu_crud.html";

	});

	</script>
  </head>
  <body onload="mueveReloj()">
  	<!-- body code goes here -->
    <header>
	 	<nav class="color-cabezera container-fluid" style="padding:0px;position:fixed;z-index:1;">
			<div class="row">
				<div class="col-lg-2 col-3 d-flex align-items-center" >
					<!-- <button style="border:none;background:none;margin-right:15px;padding:0px;"  type="button" -->
					<button style="border-color:#0A4970;margin-right:15px;padding:0px;border:none;"  type="button"
					data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
					aria-controls="offcanvasScrolling"
					><img style="width:10px;padding:15px;padding-bottom:20px;padding-top:20px;" class="color-menu" src="imagenes/open-menu.png" alt=""></button>
				
					<div style="background-color:#0A4970;padding:0px;margin:0px;height:537px;width:300px;"
						class="offcanvas offcanvas" tabindex="-1"
						data-bs-scroll="true" data-bs-backdrop="false"
						id="offcanvasScrolling"	aria-labelledby="offcanvasScrolling'">
					<button type="button" id="btnCerrar" data-bs-dismiss="offcanvas" aria-label="Close" style="margin-left:250px;background:none;border:none;margin-top:10px;" ><img src="imagenes/close-colorblanco.png" style="width:10px;"></button>	


						<div class="offcanvas-header">					
						<ul style="list-style-type:none;align-items:left" id="nav" class="administracion"> 
							<div style="width:500px;margin-left:0px;" id="controlador">
							<ul>
										<li>
											<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:20px;margin-right:80px; color:white;">Taquilla</h6></a><hr> 
											<ul>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Usuarios</h6></a><hr> 
												</li>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Perfiles</h6></a><hr>
												</li>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Notificaciones</h6></a><hr>
												</li>
											</ul>
										</li>
										<li>
											<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Configuraci??n</h6></a><hr>
											<ul>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Usuarios</h6></a><hr> 
												</li>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Perfiles</h6></a><hr>
												</li>
												<li>
													<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Notificaciones</h6></a><hr>
												</li>
											</ul>
										</li>
										<li>
											<a href=""><img src="imagenes/flecha-derecha-colorblanco.png" style="width:20px;position:absolute;margin-left:180px;margin-top:5px;"><h6 class="offcanvas-title" style="margin-top:10px;margin-right:80px; color:white;">Perifericos</h6></a><hr>
										</li>
									</ul>
							</div>	
						</ul>
							
					</div>
				</div>
					<!-- Men?? Tipo Hamburguesa inicio -->

				    <figure class="pt-3">
					 <img src="imagenes/LOGO_BLANCO.png" class="img-fluid">
					</figure>
				</div>
				<div class="col-lg-5 d-lg-flex align-items-center d-none" style="margin-left:100px;">
					<input type="text" class="mr-2" value="Buscar">
					<figure class="pt-3"><img src="imagenes/s.png"></figure>
				</div>
				<div class="col-lg-4 col-7  d-flex align-items-center justify-content-end">
					<div class="text-white mr-3 pt-3" id="Hora">9:30 A.M.</div>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/Notificaciones.png"></figure>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/L??nea 1.png"></figure>
					<div class="login mt-2">MB<div>
				</div>
			</div>
		</nav> 
	 </header>
	 <main>
	  	<section class="container-fluid">
		  <article class="d-lg-flex align-items-md-end pt-3 pb-3 ">
		 	 <div class="nombre"><h1 class="pr-3 text-center">Hola Miguel!</h1></div>
			<h3 class="pb-1 text-center">Tengo muchas cosas que decirte:</h3>
		  </article>	  
		 </section>
		 <section class="container-fluid pl-lg-0">
		 	<div class="row">
			 	<div class="col-lg-1 order-last order-lg-first">
					<div class="panel1 sombra">
						<div class="row">
							<div class="col-6 col-lg-12">
								<div class="row">
								<div class="col-3 col-lg-12 text-center pointer" id="taquilla">
									<div class="c-verde mb-1">T</div>
									<P class="mb-3 d-none d-lg-block">Taquilla</P>
								</div>
								<div class="col-3  col-lg-12 pointer">
									<div class="c-morado mb-1">P</div>
									<P class="mb-3 d-none d-lg-block">Parqueadero</P>
								</div>
								<div class="col-3  col-lg-12 pointer" id="registro">
									<div class="c-naranja mb-1">RP</div>
									<P class="mb-4 d-none d-lg-block">Registo<br>Pasaportes</P>
								</div>
								<div class="col-3  col-lg-12">
								    <div class="d-flex justify-content-center mb-2 align-items-end">
							<div class="puntos mr-1"></div>
							<div class="puntos mr-1"></div>
							<div class="puntos"></div>
										
						</div>
									<figure class="d-none d-lg-block pointer"><img class="pointer" src="imagenes/Trazado 34.png"></figure>
								</div>
								</div>
							</div>
							<div class="col-6 col-lg-12">
								<div class="row">
								    <div class="col-3 col-lg-12">
								 <figure class="mb-1 text-center"><img src="imagenes/settings.png"></figure>
						<p class="mb-3 d-none d-lg-block">Herramientas</p>
								</div>
								<div class="col-3 col-lg-12">
								<figure class="mb-1"><img id="configuracion" class="pointer" src="imagenes/adjust.png"></figure>
						<p class="mb-3 d-none d-lg-block">Configuraci??n</p>
								</div>
								<div class="col-3 col-lg-12">
								 <figure class="mb-1"><img src="imagenes/lifebuoy.png"></figure>
						<p class="mb-5 d-none d-lg-block">Ayuda</p>
								</div>
								<div class="col-3 col-lg-12">
								 <div class="d-flex justify-content-center mb-2">
							<div class="puntos mr-1"></div>
							<div class="puntos mr-1"></div>
							<div class="puntos"></div>
						</div>
								</div>
								</div>
							</div>
						</div>
					
					</div>
				</div>
				<div class="col justify-content-md-center" id="contenido">
					 
				<!-- <div class="col-lg-11 "> -->
				    <div class="row">	
						<div class="col-lg-4">
						<div class="panel2 sombra mb-3">
							<figure class="text-right"><img src="imagenes/update.png"></figure>
							<h2>Panel de Notificaciones</h2>
							<div class="notificacion sombra2 mb-3">
								<h4 class="textos-azules">Titulo Notificaci??n</h4>
								<div class="d-flex">
									<div class="circulo-naranja mr-2"></div>
									<p class="textos-azules">15 mar 2020 / 02:08 pm</p>
								</div>
							</div>
							<div class="sombra2 mb-3 notificacion2 ">
							   <div class="row">
										<div class="col-7">
									<h4 class="textos-medios">Titulo Notificaci??n</h4>
								<div class="d-flex">
									<div class="circulo-verde mr-2"></div>
									<p class="textos-azules">15 mar 2020 / 02:08 pm</p>
								</div>
								</div>
								<div class="col-5 d-flex align-items-center justify-content-lg-end">
									<h4><a href="">Ver</a></h4>
								</div>
								</div>
							</div>
							<div class="sombra2 mb-3 notificacion2">
							   <div class="row">
										<div class="col-7">
									<h4 class="textos-medios">Titulo Notificaci??n</h4>
								<div class="d-flex">
									<div class="circulo-naranja mr-2"></div>
									<p class="textos-azules">15 mar 2020 / 02:08 pm</p>
								</div>
								</div>
								<div class="col-5 d-flex align-items-center justify-content-lg-end">
									<h4><a href="">Ver</a></h4>
								</div>
								</div>
							</div>
							<div class="notificacion sombra2 mb-3">
								<h4 class="textos-azules">Titulo Notificaci??n</h4>
								<div class="d-flex">
									<div class="circulo-morado mr-2"></div>
									<p class="textos-azules">15 mar 2020 / 02:08 pm</p>
								</div>
							</div>
						<div class="sombra2 mb-3 notificacion2">
							   <div class="row">
										<div class="col-7">
									<h4 class="textos-medios">Titulo Notificaci??n</h4>
								<div class="d-flex">
									<div class="circulo-azul mr-2"></div>
									<p class="textos-azules">15 mar 2020 / 02:08 pm</p>
								</div>
								</div>
								<div class="col-5 d-flex align-items-center justify-content-lg-end">
									<h4><a href="">Ver</a></h4>
								</div>
								</div>
							</div>
							<div class="d-flex justify-content-center">
								<div class="circulo-borde mr-2"></div>
								<h5 class="text-uppercase mr-3">tipo 1</h5>
								<div class="circulo-borde-naranja mr-2"></div>
								<h5 class="text-uppercase mr-3">tipo 2</h5>
								<div class="circulo-borde-azul mr-2"></div>
								<h5 class="text-uppercase mr-3">tipo 3</h5>
								<div class="circulo-borde-morado mr-2"></div>
								<h5 class="text-uppercase mr-3">tipo 4</h5>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-none d-lg-block">
						<div class="panel2 sombra mb-3">
							<div class="d-flex justify-content-end">
								<div class="d-flex pt-3 mr-2 m-0 p-0">
							<div class="puntos mr-1"></div>
							<div class="puntos mr-1"></div>
							<div class="puntos"></div>
						</div>
							   <figure><img src="imagenes/Fullscreen Icon.png"></figure>
							</div>
							<div class="row">
								<div class="col-md-4 col-3">
									<div class="bloque-verde"></div>
								</div>
								<div class="col-md-8 col-9  d-flex flex-column">
									<div class="numero">32</div>
									<div class="sub-titulo mb-3">Datos</div>
									<h2>Panel de datos</h2>
								</div>
							</div>
						</div>
						<div class="panel2 sombra mb-3">
							<div class="d-flex justify-content-end">
								<div class="d-flex pt-3 mr-2 m-0 p-0">
									<div class="puntos mr-1"></div>
									<div class="puntos mr-1"></div>
									<div class="puntos"></div>
								</div>
							   <figure><img src="imagenes/Fullscreen Icon.png"></figure>
							</div>
							<h2>Panel de Estad??sticas</h2>
						     <div class="text-center mb-2"><img src="imagenes/Values.png" class="img-fluid"></div>
							<div class="d-flex justify-content-center">
								<div class="circulo-borde mr-2"></div>
								<h5 class="text-uppercase mr-3">dato 1</h5>
								<div class="circulo-borde-morado mr-2"></div>
								<h5 class="text-uppercase mr-3">dato 2</h5>
								<div class="circulo-borde-azul mr-2"></div>
								<h5 class="text-uppercase mr-3">dato 3</h5>
							</div>
						</div>
					</div>
					<div class="col-lg-4 d-none d-lg-block">
						<div class="panel2 sombra mb-3">
							<div class="d-flex justify-content-end">
								<div class="d-flex pt-3 mr-2 m-0 p-0">
							<div class="puntos mr-1"></div>
							<div class="puntos mr-1"></div>
							<div class="puntos"></div>
						</div>
							   <figure><img src="imagenes/Fullscreen Icon.png"></figure>
							</div>
							<div class="row">
								<div class="col-md-4 col-3">
									<div class="bloque-verde2"></div>
								</div>
								<div class="col-md-8 col-9  d-flex flex-column">
									<div class="numero">72</div>
									<div class="sub-titulo mb-3">Datos</div>
									<h2>Panel de datos</h2>
								</div>
							</div>
						</div>
						<div class="panel2 sombra mb-3">
							<div class="d-flex justify-content-end">
								<div class="d-flex pt-3 mr-2 m-0 p-0">
									<div class="puntos mr-1"></div>
									<div class="puntos mr-1"></div>
									<div class="puntos"></div>
								</div>
							   <figure><img src="imagenes/Fullscreen Icon.png"></figure>
							</div>
							<h2>Panel de Opciones</h2>
						    <div class="row pr-3 pl-3 mb-3">
							     <div class="col-4 opcion sombra2 text-center bg-white"><h4><a href="">Opci??n 1</a></h4></div>
								 <div class="col-4 opcion2 sombra2 text-center bg-inav-op"><h4><a href="">Opci??n 1</a></h4></div>
								 <div class="col-4 opcion3 sombra2 text-center bg-inav-op"><h4><a href="">Opci??n 1</a></h4></div>
							</div>
						     <h4 class="textos-bold">Datos 1</h4>
							 <div class="d-flex mb-3">
								 <div class="barra2" style="width: 70%; background: #FF715B"></div>
								<div class="barra" style="width: 30%"></div>
							</div>
							 <h4 class="textos-bold">Datos 2</h4>
							 <div class="d-flex mb-3">
								 <div class="barra2" style="width: 30%; background:#0496FF"></div>
								<div class="barra" style="width: 70%"></div>
							</div>
							 <h4 class="textos-bold">Datos 3</h4>
							 <div class="d-flex mb-3">
								 <div class="barra2" style="width: 70%; background: #6665DD;"></div>
								<div class="barra" style="width: 30%"></div>
							</div>
							 <h4 class="textos-bold">Datos 4</h4>
							 <div class="d-flex  mb-3">
								 <div class="barra2" style="width: 95%; background:#34D1BF"></div>
								<div class="barra" style="width: 15%"></div>
							</div>
							 <h4 class="textos-bold">Datos 5</h4>
							 <div class="d-flex">
								 <div class="barra2" style="width: 10%; background: #FF715B"></div>
								<div class="barra" style="width: 90%"></div>
							</div>
						</div>
						</div>
				  	</div>	  
				</div>
			 </div>
		 </section>
	  </main>
	 <footer class="color-pie container-fluid">
	  	 	<section class="row">
		    	 <figure class="col-3 col-lg-1 home-pie d-flex align-items-center"><img src="imagenes/home-run.png"></figure>
				 <div class="col-9 col-lg-11 d-flex align-items-center justify-content-end">Estado</div>
		    </section>
	  </footer> 

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<!--<script src="js/jquery-3.4.1.min.js"></script>-->

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>