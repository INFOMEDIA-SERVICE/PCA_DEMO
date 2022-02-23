<?php
	session_start();
	include('php/sesion.php');
	//global $paginar = 1;
?>
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
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
		<!---->
		<!-- Bootstrap -->
		<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">
		<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

		<!--Datatable-->
		<!--<link rel="stylesheet" type="text/css" href="css/dataTables.min.css"/>	
		<script type="text/javascript" charset="utf8"  src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8"  src="js/views/atracciones.js"></script>-->
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/popper.min.js"></script> 
		<script src="js/bootstrap-4.4.1.js"></script>

 	</head>
  	<body>
  		<!-- body code goes here -->	 
		<main>
			<section class="container-fluid pl-lg-0">
		 		<div class="row d-flex">
			 		<div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					
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
										<a href="javascript:;" onclick="abreModalatraccion();"><h4 class="mr-2">Adicionar:</h4></a>
							   			<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
							   		</div>
								</div>
								<div class="col-3 d-flex justify-content-center">
									<div class="d-flex align-items-center">
									<a href="javascript:;" onclick="abreModalActiDesactivaatraccion();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
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
								<table id="tabla_atraccion" class="table">
									<thead>							  
										<tr class="row ">
											<th class="col-1 text-center"><h2>Editar</h2></th>
											<th class="col-1 text-center"><h2><input type="checkbox" onclick="marcar(this);"></h2></th>
											<th class="col-1 text-center"><h2>Id</h2></th>
											<th class="col-1 text-center"><h2>Nombre</h2></th>
											<th class="col-2 text-center"><h2>Imagen</h2></th>
											<th class="col-1 text-center"><h2>Creado Por</h2></th>
											<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
											<th class="col-1 text-center"><h2>Modificado Por</h2></th>
											<th class="col-1 text-center"><h2>Fecha ModificaciÃ³n</h2></th>
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
								<ul class="pagination pagination-lg pager" id="myPager"></ul>
								<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>
							</div>
					  	</section>	 
					</div>		  
				</div>
			</section>
			<!--MODALES-->
			<!--Modal agregar atracci&oacute;n-->
			<div class="modal" id="addModalAtraccion" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar atracciones</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre atraccion</h4></div>
								<div class="col-10"><input type="text" id="txtAddAtraccion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>					
							<div class="mb-3">
								<input type="file" id="file" accept=".jpg,.png"/>								
								<br>
								<div id="result"><h4>Esperando archivo...</h4></div>								
								<br>
								<img id="img" width="400" height="260"/>
							</div>
						</div>
						<div class="modal-footer">							
							<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" onclick="btnGuardarAtraccion()">Guardar</button>-->
							<div class="px-3"><input type="button" id="btnGuardarAtraccion" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar atracci&oacute;n-->
			<div class="modal" id="upModalAtraccion" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar atracciones</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIdAtraccion"> 
								<div class="col-2 pt-2"><h4>Nombre atracci&oacute;n</h4></div>
								<div class="col-10"><input type="text" id="txtupAtraccion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							<div class="mb-3">						
								<input type="file" id="file2" accept=".jpg,.png" />
								<br>
								<div id="result2">El archivo es valido</div>
								<br>
								<img id="img2" width="400" height="260" />
							</div>
						</div>
						<div class="modal-footer">					
							<!--<input type="button"  class="btn btn-default" data-dismiss="modal" value="Cerrar">
							<input type="button" onclick="btnActualizarAtraccion()" class="btn btn-info" value="Actualizar">-->							
							<div class="px-3"><input type="submit" id="btnActualizarAtraccion" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar atracciones--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalAtraccion">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar atracciones</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<!--<table align="center">
								<thead>							  
									<tr>
										<th><h2>Id</h2></th>
										<th><h2>Nombre</h2></th>
										<th><h2>Estado</h2></th>																					
									</tr>
								</thead>
								<tbody id="tbody_modal_atraccion">	
									
								</tboby>	
							</table>-->
							<h3 id="p_cant"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADAtraccion();" value="Guardar"></div><!--id="btnADAtraccion"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>
					<!--</div>-->
					</div>
				</div>
			</div>
			<!--/////////////-->
			<!---->			
	  	</main>
	  	<script>
			//cargar_datos();
			$.fn.pageMe = function(opts){
				console.log(opts);
				var $this = this,
					defaults = {
						perPage: 7,
						showPrevNext: false,
						hidePageNumbers: false
					},
					settings = $.extend(defaults, opts);
				
				var listElement = $this.find('tbody');
				var perPage = settings.perPage; 
				var children = listElement.children();
				var pager = $('.pager');
				
				if (typeof settings.childSelector!="undefined") {
					children = listElement.find(settings.childSelector);
				}
				
				if (typeof settings.pagerSelector!="undefined") {
					pager = $(settings.pagerSelector);
				}
				
				var numItems = children.length;
				var numPages = Math.ceil(numItems/perPage);

				pager.data("curr",0);
				
				if (settings.showPrevNext){
					$('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
				}
				
				var curr = 0;
				while(numPages > curr && (settings.hidePageNumbers==false)){
					$('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
					curr++;
				}
				
				if (settings.showPrevNext){
					$('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
				}
				
				pager.find('.page_link:first').addClass('active');
				pager.find('.prev_link').hide();
				if (numPages<=1) {
					pager.find('.next_link').hide();
				}
				pager.children().eq(1).addClass("active");
				
				children.hide();
				children.slice(0, perPage).show();
				
				pager.find('li .page_link').click(function(){
					var clickedPage = $(this).html().valueOf()-1;
					goTo(clickedPage,perPage);
					return false;
				});
				pager.find('li .prev_link').click(function(){
					previous();
					return false;
				});
				pager.find('li .next_link').click(function(){
					next();
					return false;
				});
				
				function previous(){
					var goToPage = parseInt(pager.data("curr")) - 1;
					goTo(goToPage);
				}
				
				function next(){
					goToPage = parseInt(pager.data("curr")) + 1;
					goTo(goToPage);
				}
				
				function goTo(page){
					var startAt = page * perPage,
						endOn = startAt + perPage;
					
					children.css('display','none').slice(startAt, endOn).show();
					
					if (page>=1) {
						pager.find('.prev_link').show();
					}
					else {
						pager.find('.prev_link').hide();
					}
					
					if (page<(numPages-1)) {
						pager.find('.next_link').show();
					}
					else {
						pager.find('.next_link').hide();
					}
					
					pager.data("curr",page);
					pager.children().removeClass("active");
					pager.children().eq(page+1).addClass("active");
				
				}
			};
			$(document).ready(function(){
				cargar_datos();	
				$('#tbody_atraccion').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});
			
			});
			//
			document.getElementById("file").addEventListener("change",openImage,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("file2").addEventListener("change",openImage2,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			$('#btnGuardarAtraccion').click(function(){
				//Toma el archivo elegido por el input 
				var value = document.getElementById("file").files[0];     
				var nombre = $("#txtAddAtraccion").val();
				if(nombre != '' && value.size != 0){
					let img_ext = value.name;
					img_ext = img_ext.toUpperCase(); 
					var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
					//
					adicionarAtracciones(nombre, extension_img[1]);
				}else{
					alert('Llene todos los campos');
				}		
			});
			//
			$('#btnActualizarAtraccion').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#txtupIdAtraccion").val();
				var nombre_a = $("#txtupAtraccion").val();	
				//
				if(nombre_a != '' && imagen_a != '' && r_imagen == 'El archivo es valido'){
					let str_base64 = document.getElementById("img2").src;
					let imagen = str_base64.split(',');			
					if(imagen[0] == "data:image/jpeg;base64"){
						console.log("base64");////////////////////////////
						var imagen_a = document.getElementById("file2").files[0];
						let img_ext = imagen_a.name;
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
						//						
						actualizarAtracciones(id_a,nombre_a, extension_img[1], imagen[1]);
					}else{
						console.log("URL");/////////////////////////////
						actualizarAtracciones2(id_a,nombre_a);
					}		
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			//
			function marcar(source){
				checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
				for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles				
					if(checkboxes[i].type == "checkbox"){ //solo si es un checkbox entramos					
						checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)
					}
				}
			}		
		</script>	
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  	</body>
</html>