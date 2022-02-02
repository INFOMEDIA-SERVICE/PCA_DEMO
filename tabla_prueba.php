<?php
	//require_once "main.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PCA - Atracciones</title>				
		<!---->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="js/jquery-3.4.1.min.js"></script>--><!--Este es el JQUERY original que viene la plantilla-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

		<!-- Bootstrap -->
		<link href="css/bootstrap-4.4.1.css" rel="stylesheet">

		<!------------/-CSS-/---------------->
		<link rel="stylesheet" type="text/css" href="css/main.css">

		<!--Datatable-->
		<link rel="stylesheet" type="text/css" href="css/dataTables.min.css"/>	
		<script type="text/javascript" charset="utf8"  src="js/jquery.dataTables.min.js"></script>
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!--<script src="js/popper.min.js"></script>-->
		<!--<script src="js/bootstrap-4.4.1.js"></script>-->

		<script type="text/javascript" charset="utf8"  src="js/views/atracciones.js"></script>		
	<!---->					
	</head>
	<body>
		<!-- body code goes here -->    
		<main>	  	
			<section>
				<div class="panel3 sombra">					
					<section class="px-3 pt-3">					  
						<div class="text-center sub-titulo-form textos-medios mb-4">Atracciones</div>
							<div class="border rounded p-3 mb-4">
								<div class="row">
									
									<div class="col-md-5 mb-3 mb-md-0">
										<div class="row">											
											<div class="col-12 d-flex text-right">
												<div class="text-right"><h class="pt-1 pr-2">Agregar Atracción</h4></div>
												<div class="f-icono mr-2"><img src="imagenes/+.png"></div>
											</div>
										</div>
									</div> 
								
							</div>									
					</section>
					<section class="px-3 mb-3">
						<div class="row">
							<div class="col-md-4 col-6 d-flex justify-content-center">
								<div class="d-flex align-items-center">
									<h4 class="mr-2">Filtrar por:</h4>
									<figure class="mr-2 pt-1"><img src="imagenes/pdf.png"></figure>
									<figure class="mr-2 pt-1"><img src="imagenes/file-word.png"></figure>
									<figure class="pt-1"><img src="imagenes/file-excel.png"></figure>
								</div>
							</div>
							<div class="col-md-4 col-6 d-flex align-items-center justify-content-center">
								<h4 class="text-right pt-3 mr-2">Filtrar por:</h4>
								<!--name="tabla_atraccion_length"-->
								<div class="caja" style="width: 100px">
									<select>
										<option>10</option>
									</select>
								</div>
							</div>
							<div class="col-md-4 d-flex align-items-center justify-content-end">
								<h4 class="mr-2 pt-2">1 <a href=""> 2 3 4</a></h4>
								<div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div>
							</div>
						</div>
					</section>
					<section class="px-3">
					<row id="sele">	
						<table id="tabla_atraccion" class="table table-border">
							<thead>
							  	<tr>
									<th scope="col"></th>
									<!--<th scope="col">#</th>-->
									<th scope="col">First</th>
									<th scope="col">Last</th>
									<th scope="col">Handle</th>
							  	</tr>
							</thead>
							<tbody>
							  	<tr>
									<th><img src="imagenes/editar.png" alt="editar" width="40" height="40"></th>
									<!--<th>1</th>-->
									<td>Mark</td>
									<td>Otto</td>
									<td>@mdo</td>
							 	 </tr>
							  	<tr>
									<th><img src="imagenes/editar.png" alt="editar" width="40" height="40"></th>
									<!--<th>2</th>-->
									<td>Jacob</td>
									<td>Thornton</td>
									<td>@fat</td>
							  	</tr>							  
							</tbody>
						</table>
						
						<!--<div class="row">
							<div class="col-1"></div>
							<div class="col-3">
								<div class="text-center"><h2>Nombre<h2></div>
							</div>
							<div class="col-3">
								<h2 class="text-center">Apellido<h2>
							</div>
							<div class="col-3">
								<h2 class="text-center">Perfil<h2>
							</div>
								<div class="col-2">
								<h2 class="text-center">Estado<h2>
							</div>
						</div>
						<div class="row py-3">
							<div class="col-1"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></div>
								<div class="col-3">
									<div class="text-center"><h4>Andres</h4></div>
							
								</div>
								<div class="col-3  d-flex align-items-center justify-content-center">
									<h4>Cervantes</h4>
								</div>
								<div class="col-3 d-flex align-items-center justify-content-center">
								<h4>Cliente admin</h4>
							</div>
							<div class="col-2 d-flex align-items-center justify-content-center">
								<h4>Activo</h4>
							</div>
						</div>-->
					</row>
					</section>						  
				</div>
			</section>
		</main>	
		<script>
			cargar_datos();			
			$(document).ready(function(){
			  //$('#tabla_atraccion').DataTable();
				$('#tabla_atraccion').DataTable({
					"language": { "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" }
				});
			});
			
			//
			//document.label.innerHTML = "";
			//var content   = document.createElement('tabla_atraccion_wrapper');
			//var content = document.getElementById('sele').innerHTML;
			//console.log(content);
		</script>	
	</body>	
</html>