<?php
	session_start();
	include('php/sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PCA-Servicios adicionales</title>
		<!---->		
		<!-- Bootstrap -->
		<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">
		<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
		<script src="js/views/funciones.js"></script>
		<!---->
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
										<a href="">Consultar Datos Servicios adicionales</a>
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
							<div class="text-center sub-titulo-form textos-medios  mb-4">Servicios adicionales</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalcacceso();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivacacceso();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchCacceso" type="text" onkeyup="doSearch('tabla_cacceso', 'searchCacceso')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>					  	
						  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="nmostrar_cacceso" id="nmostrar_cacceso">
												<option>20</option>
												<option>40</option>
												<option>60</option>
												<option>Todos</option>
											</select>
										</div>&nbsp;&nbsp;
										<h4 class="text-right pt-3 mr-2">registros</h4>
									</div>
									<div class="col-6 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<h4 class="mr-2">Filtrar por:</h4>
											<figure class="mr-2 pt-1"><a href="exportar/condicion_acceso/cacceso_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/condicion_acceso/cacceso_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/condicion_acceso/cacceso_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager2"></ul>									
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_cacceso" class="table">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="atraccion_todos" onclick="marcar(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Precio</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>																					
											</tr>
										</thead>
										<tbody id="tbody_sadicionales">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section> 
					</div>		  
				</div>
			</section>
			<!--MODALES-->
			<!--Modal agregar atracci&oacute;n-->
			<div class="modal" id="addModalCacceso" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar condici&oacute;n acceso</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre atraccion</h4></div>
								<div class="col-10"><input type="text" id="txtAddCacceso" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
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
							<div class="px-3"><input type="button" id="btnGuardarCacceso" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar condicion de acceso-->
			<div class="modal" id="upModalCacceso" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar condici&oacute;n de acceso</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIdCacceso"> 
								<div class="col-2 pt-2"><h4>Nombre condici&oacute;n acceso</h4></div>
								<div class="col-10"><input type="text" id="txtupCacceso" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							<div class="mb-3">						
								<input type="file" id="file2_condicion" accept=".jpg,.png" />
								<br>
								<div id="result2">El archivo es valido</div>
								<br>
								<img id="img2_condicion" width="400" height="260" />
							</div>
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarCacceso" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar atracciones--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalCacceso">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar condiciones de acceso</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADCacceso();" value="Guardar"></div><!--id="btnADCacceso"--> 
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
			var select = document.getElementById('nmostrar_cacceso');
			select.addEventListener('change', function(){
				restaurar_paginacion('myPager2');				
				var selectedOption = this.options[select.selectedIndex];
				$('#tbody_cacceso').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:selectedOption.text});
			});
			//
			$(document).ready(function(){
				cargar_datos_sadicionales();
			});
			//
			document.getElementById("file_condicion").addEventListener("change",openImage,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("file2_condicion").addEventListener("change",openImage2,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			$('#btnGuardarCacceso').click(function(){
				//Toma el archivo elegido por el input 
				var value = document.getElementById("file").files[0];     
				var nombre = $("#txtAddCacceso").val();
				if(nombre != '' && value.size != 0){
					console.log('GUADA CONDICION');
					let img_ext = value.name;
					img_ext = img_ext.toUpperCase(); 
					var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
					//
					adicionarCacceso(nombre, extension_img[1]);
				}else{
					alert('Llene todos los campos');
				}		
			});
			//
			$('#btnActualizarCacceso').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#txtupIdCacceso").val();
				var nombre_a = $("#txtupCacceso").val();	
				//
				if(nombre_a != '' && imagen_a != '' && r_imagen == 'El archivo es valido'){
					let str_base64 = document.getElementById("img2_condicion").src;
					let imagen = str_base64.split(',');			
					if(imagen[0] == "data:image/jpeg;base64"){
						console.log("base64");////////////////////////////
						var imagen_a = document.getElementById("file2").files[0];
						let img_ext = imagen_a.name;
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
						//						
						actualizarCacceso(id_a,nombre_a, extension_img[1], imagen[1]);
					}else{
						console.log("Acceso 222222");/////////////////////////////
						actualizarCacceso2(id_a,nombre_a);
					}		
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			//			
		</script>	
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  	</body>
</html>