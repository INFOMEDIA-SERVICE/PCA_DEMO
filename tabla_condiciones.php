<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PCA-Atracciones</title>
	<!---->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<!--<script src="js/jquery-3.4.1.min.js"></script>--><!--Este es el JQUERY original que viene la plantilla-->
	<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
	<!---->
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<!--Datatable-->
	<link rel="stylesheet" type="text/css" href="css/dataTables.min.css"/>	
	<script type="text/javascript" charset="utf8"  src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8"  src="js/views/condicion.js"></script> <!--Conexión con el js especifico para cada tabla-->
	
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>

  </head>
  <body>
  	<!-- body code goes here -->
	  <!--
    <header>
	 	<nav class="color-cabezera container-fluid">
			<div class="row">
				<div class="col-lg-1 col-md-2 col-2 pl-0">
					<figure class="color-menu"><img src="imagenes/open-menu.png"></figure>
				</div>
				<div class="col-lg-2 col-3 d-flex align-items-center">
				    <figure class="pt-3">
					 <img src="imagenes/LOGO_BLANCO.png" class="img-fluid">
					</figure>
				</div>
				<div class="col-lg-5 d-lg-flex align-items-center d-none">
					<input type="text" class="mr-2" value="Buscar">
					<figure class="pt-3"><img src="imagenes/s.png"></figure>
				</div>
				<div class="col-lg-4 col-7  d-flex align-items-center justify-content-end">
					<div class="text-white mr-3 pt-3">9:30 A.M.</div>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/Notificaciones.png"></figure>
					<figure class="text-white mr-3  pt-3"><img src="imagenes/Linea 1.png"></figure>
					<div class="login mt-2">MB<div>
				</div>
			</div>
		</nav> 
	 </header>-->
	 <main>
	  	
		 <section class="container-fluid pl-lg-0">
		 	<div class="row d-flex">
			 	<div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					<!--<figure class="sub-menues mb-3 mt-2"><img src="imagenes/Imagen-7.png"></figure>-->
					<!--<div class="panel1 sombra">
						<div class="row">
							<div class="col-6 col-lg-12">
								<div class="row">
									<div class="col-3 col-lg-12 text-center">
									<div class="c-verde mb-1">CXC</div>
						<P class="mb-3 d-none d-lg-block">Cuentas</P>
								</div>
								<div class="col-3  col-lg-12">
									<div class="c-morado mb-1">PV</div>
						<P class="mb-3 d-none d-lg-block">Proveedores</P>
								</div>
								<div class="col-3  col-lg-12">
								<div class="c-naranja mb-1">RC</div>
						<P class="mb-4 d-none d-lg-block">Recaudos</P>
								</div>
								<div class="col-3  col-lg-12">
								    <div class="d-flex justify-content-center mb-2 align-items-end">
							<div class="puntos mr-1"></div>
							<div class="puntos mr-1"></div>
							<div class="puntos"></div>
										
						</div>
									<figure class="d-none d-lg-block"><img src="imagenes/Trazado 34.png"></figure>
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
								<figure class="mb-1"><img src="imagenes/adjust.png"></figure>
						<p class="mb-3 d-none d-lg-block">Configuración</p>
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
					
					</div>-->
				</div>
				  <div class="panel3 sombra">
				  	<div class="fondo-pesta">
					     <div class="row pr-0 pl-0 ml-0 mr-0">
								<div class="col-md-3 col-6 pes-act ">
							<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
								<a href="">Consultar Datos Atracciones</a>
							</div>
						</div>
						
						<div class="col-md-3 col-6 pes-act-inv d-flex justify-content-center">
							<div class="d-flex align-items-center cerrar mr-3 ">
								<div class="text-left"><a>Consultar Datos Condiciones de Acceso</a></div>
							</div>
							<figure class="d-flex align-items-center pt-3"><img src="imagenes/Linea 5.png"></figure>
						</div>
					
					
							 <div class="col-md-6 col-0 pes-act-inv3"></div>
					   </div>
					</div>
				   <section class="px-3 pt-3">
					  
						<div class="text-center sub-titulo-form textos-medios  mb-4">Consultar Atracciones</div>
					  <div class="border rounded p-3 mb-4">
								<div class="row">
					  	<div class="col-md-5 mb-3 mb-md-0">
						 	<div class="row">
								<div class="col-3"><h4 class="text-right pt-3">Filtrar por:</h4></div> 
							    <div class="col-9">
								    <div class="caja">
										 <select>
										<option>Nombre</option>
									</select>
									</div>
								</div> 
							</div>
						 </div> 
						<div class="col-md-5 mb-3 mb-md-0">
						  	<div class="row">
								<div class="col-8">
									<input type="text" class="campo" value="Que quieres consultar">
								</div>
								<div class="col-4 d-flex align-items-center">
								<div><h4 class="pt-1 pr-2">Agregar Filtro</h4></div>
									<div class="f-icono mr-2"><img src="imagenes/+.png"></div>
								</div>
							</div>
						  </div> 
						
					  </div>
							</div>
					  		
					
					 </section>
					  <section class="px-3 mb-3">
					  	<div class="row">
							<div class="col-2 d-flex justify-content-center">
								<div class="d-flex align-items-center">
								   <h4 class="mr-2">Actualizar:</h4>
							   <figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>
							  
							   </div>

							</div>
							<div class="col-3 d-flex justify-content-center">
								<div class="d-flex align-items-center">
								   <h4 class="mr-2">Activar / Desactivar selectos:</h4>
							   <figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
							  
							   </div>

							</div>
						 <div class="col-2 d-flex justify-content-center">
						  	<div class="d-flex align-items-center">
							 	<h4 class="mr-2">Filtrar por:</h4>
							 <figure class="mr-2 pt-1"><img src="imagenes/pdf.png"></figure>
							 <figure class="mr-2 pt-1"><img src="imagenes/file-word.png"></figure>
						     <figure class="pt-1"><img src="imagenes/file-excel.png"></figure>
							 </div>
						  </div>
						  <div class="col-3 d-flex align-items-center justify-content-center">
						  	<h4 class="text-right pt-3 mr-2">Filtrar por:</h4>
							  <div class="caja" style="width: 100px">
										 <select>
										<option>10</option>
									</select>
									</div>
						  </div>
						  <div class="col-2 d-flex align-items-center justify-content-end">
						  	<h4 class="mr-2 pt-2">1 <a href=""> 2 3 4</a></h4>
							  <div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div>
						  </div>
					  </div>
					  </section>
					  <section class="px-3">
					  	<div>
						  	<table id="tabla_atraccion" class="table table-hover">
								<thead>							  
									<tr class="row ">
										<th class="col-1 text-center"><h2>Editar</h2></th>
										<th class="col-1 text-center"><h2><input type="checkbox"></h2></th>
										<th class="col-1 text-center"><h2>Id</h2></th>
										<th class="col-1 text-center"><h2>Nombre</h2></th>
										<th class="col-2 text-center"><h2>Imagen</h2></th>
										<th class="col-1 text-center"><h2>Creado Por</h2></th>
										<th class="col-1 text-center"><h2>Fecha Creación</h2></th>
										<th class="col-1 text-center"><h2>Modificado Por</h2></th>
										<th class="col-1 text-center"><h2>Fecha Modificación</h2></th>
										<th class="col-1 text-center"><h2>Estado</h2></th>
										<th class="col-1 text-center"><h2>Condiciones Acceso</h2></th>										
									</tr>
								</thead>
								<tbody id="tbody_atraccion">	
									<!--<tr class="row py-3">
										<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox"></h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>1</h2></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>Sierra Nevada</h4></td>
										<td class="col-2 d-flex align-items-center justify-content-center"><img src="imagenes/atraccion.jpg" width="50%" height="50%" ></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario1</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario2</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>Activo</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/+.png"></div></td>										
									</tr>	
									<tr class="row py-3">
										<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox"></h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>2</h2></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>Coco Loco</h4></td>
										<td class="col-2 d-flex align-items-center justify-content-center"><img src="imagenes/atraccion.jpg" width="50%" height="50%"></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario1</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario2</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><h4>Activo</h4></td>
										<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/+.png"></div></td>										
									</tr>-->
								</tboby>	
							</table>
						</div>
					  </section>	 
					  
					  
				   </div>		  
				</div>
			 </div>
		 </section>
	  </main>
	  <script>
			cargar_condicion();//Nos conecta con el js condicion.js donde se pinta la tabla
			/*$(document).ready(function(){
			  //$('#tabla_atraccion').DataTable();
				$('#tabla_atraccion').DataTable({
					"language": { "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" }
				});
			});*/
			
			
		</script>	
	<!-- <footer class="color-pie container-fluid">
	  	 	<section class="row">
		    	 <figure class="col-3 col-lg-1 home-pie d-flex align-items-center"><img src="imagenes/home-run.png"></figure>
				 <div class="col-9 col-lg-11 d-flex align-items-center justify-content-end">Estado</div>
		    </section>
	  </footer> -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  </body>
</html>