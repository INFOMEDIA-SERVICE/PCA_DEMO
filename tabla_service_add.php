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
		<!-- Bootstrap -->
		<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">
		<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
		<script src="js/views/funciones.js"></script>
				
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
								<div style="cursor:pointer" id="tab_sadicionales" tipo="boletas" class="active col-3 pes-act tabb">
									<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
										<h3 id="ntab_boletas" class="txttab">Servicios adicionales</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_scategoria" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_adicionales">Categoria servicio</h3>
										</div>
									</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
							</div>
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_sadicionales"><!--SECTION SERVICIO ADICIONAL-->					  
							<div class="text-center sub-titulo-form textos-medios  mb-4">Consultar Servicios adicionales</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalSadicional();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaSadicional();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchSadicional" type="text" onkeyup="doSearch('tabla_sadicionales','searchSadicional')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>
					  	  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="nmostrar_sadicional" id="nmostrar_sadicional">
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
											<figure class="mr-2 pt-1"><a href="exportar/sadicionales/sadicionales_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/sadicionales/sadicionales_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/sadicionales/sadicionales_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager_sadicional"></ul>
										<!--<div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div>-->
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_sadicionales" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="sadicionales_todos" onclick="marcar_sadicionales(this);"></h2></th>
												<!--<th class="col-1 text-center"><h2>Id</h2></th>-->
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Precio</h2></th>
												<th class="col-1 text-center"><h2>Categoria</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>							
											</tr>
										</thead>
										<tbody id="tbody_sadicionales">
											<!--Se llena la tabla-->
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>
					  	</section>
					  	<section class="px-3 pt-3" id="panel_scategoria"><!--SECTION DE LAS CATEGORIAS DEL SERVICIO-->					
							<div class="text-center sub-titulo-form textos-medios  mb-4">Categoria del servicio adicional</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalScategoria();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaScategoria();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchScategoria" type="text" onkeyup="doSearch('tabla_scategoria', 'searchScategoria')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>					  	
						  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="nmostrar_scategoria" id="nmostrar_scategoria">
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
											<figure class="mr-2 pt-1"><a href="exportar/scategoria/scategoria_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/scategoria/scategoria_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/scategoria/scategoria_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager_scategoria"></ul>									
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_scategoria" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="scategoria_todos" onclick="marcar_scategoria(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>
											</tr>
										</thead>
										<tbody id="tbody_scategoria">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>
					</div>		  
				</div>
			</section>
			<!--MODALES SADICIONALES-->
			<!--Modal agregar servicio adicional-->
			<div class="modal" id="addModalSadicionales" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Servicio adicional</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Nombre servicio adicional</h4></div>
									<div class="col-10"><input type="text" id="txtAddSadicional" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-2 pt-2"><h4>Precio</h4></div>
									<div class="col-10"><input type="text" id="txtAddPrecio" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-2 pt-2"><h4>Categoria</h4></div>
									<div class="col-10">
										<div class="caja">
											<select type="text" name="select_sadicional" id="select_sadicional"></select>
										</div>
									</div>
								</div>										
								<div class="col-sm-6">
									<input type="file" id="file_sadicional" accept=".jpg,.png"/>								
									<br>
									<div id="result"><h4>Esperando archivo...</h4></div>								
									<br>
									<img id="img" width="360" height="220"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">							
							<div class="px-3"><input type="button" id="btnGuardarSadicionales" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal actualizar servicio adicional-->
			<div class="modal" id="upModalSadicional" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Servicio adicional</h2>
							<button type="button" id="btnCerrarSadicionalX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<input type="hidden"  id="txtupIdSadicional"> 
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Nombre servicio adicional</h4></div>
									<div class="col-10"><input type="text" id="txtupSadicional" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<input type="hidden"  id="txtupSadicional2">
									<br>
									<div class="col-2 pt-2"><h4>Precio</h4></div>
									<div class="col-10"><input type="text" id="txtupPrecio" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<input type="hidden"  id="txtupPrecio2">
									<br>
									<div class="col-2 pt-2"><h4>Categoria</h4></div>
									<div class="col-10">
										<div class="caja">
											<select type="text" name="selectup_sadicional" id="selectup_sadicional"></select>
											<input type="hidden"  id="selectup_sadicional2">
										</div>
									</div>
								</div>										
								<div class="col-sm-6">
									<input type="file" id="fileup_sadicional" accept=".jpg,.png" />
								<br>
								<div id="result2">El archivo es valido</div>								
									<br>
									<img id="imgup_sadicional" width="360" height="220"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">							
							<div class="px-3"><input type="button" id="btnActualizarSadicional" value="Actualizar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar servicio adicional--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" id="estadoModalSadicional" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">					
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar servicio adicional</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant_sadicional"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADSadicional();" value="Guardar"></div>
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<!--Modal Borrar Condiciones de la atraccion-->
			<div class="modal" id="BorrarModalAtraccion_condicion" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">			
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title">Eliminar condici&oacute;n atracci&oacute;n</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
							<input type="hidden"  id="txtBorrarAC">						
								<h3 id="del_ca"></h3>
							</div>					
							<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnDelAtraccion_condicion();" value="Eliminar"></div>
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<!--MODALES SCATEGORIA-->
			<!--Modal agregar scategorias-->
			<div class="modal" id="addModalScategoria" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar categorias del servicio</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre categoria</h4></div>
								<div class="col-10"><input type="text" id="txtAddScategoria" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>							
						</div>
						<div class="modal-footer">
							<div class="px-3"><input type="button" id="btnGuardarScategoria" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar scategoria-->
			<div class="modal" id="upModalScategoria" tabindex="-1" role="dialog">
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
								<input type="hidden"  id="txtupIdScategoria"> 
								<div class="col-2 pt-2"><h4>Nombre categoria</h4></div>
								<div class="col-10"><input type="text" id="txtupScategoria" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>							
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarScategoria" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar scategoria--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalScategoria">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar categoria del servicio adicional</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant_scategoria"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADCscategoria();" value="Guardar"></div><!--id="btnADCacceso"--> 
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
			var cant_sadicional = document.getElementById('nmostrar_sadicional');
			cant_sadicional.addEventListener('change', function(){
				restaurar_paginacion('myPager_sadicional');				
				var selectedOption = this.options[cant_sadicional.selectedIndex];
				var Mostrar_sadicional = selectedOption.text == 'Todos' ? 1000000 : selectedOption.text;
				$('#tbody_sadicional').pageMe({pagerSelector:'#myPager_sadicional',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar_sadicional});				
			});
			//
			var cant_scategoria = document.getElementById('nmostrar_scategoria');
			cant_scategoria.addEventListener('change', function(){
				restaurar_paginacion('myPager_scategoria');				
				var selectedOption2 = this.options[cant_scategoria.selectedIndex];
				var Mostrar_scategoria = selectedOption2.text == 'Todos' ? 1000000 : selectedOption2.text;
				$('#tbody_scategoria').pageMe({pagerSelector:'#myPager_scategoria',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar_scategoria});
			});
			//		
			$(document).ready(function(){
				$('#panel_scategoria').hide(); //muestro mediante id
				cargar_datos_sadicionales();
				cargar_datos_scategoria();						
			});
			//
			document.getElementById("file_sadicional").addEventListener("change",openImageAddSadicional,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("fileup_sadicional").addEventListener("change",openImageUpSadicional,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			$('#btnGuardarSadicionales').click(function(){
				//Toma el archivo elegido por el input 
				let value = document.getElementById("file_sadicional").files[0];
				let sin_imagen = document.getElementById("result").innerHTML;    
				let nombre = $("#txtAddSadicional").val();
				let precio = $("#txtAddPrecio").val();
				let idcategoria = $("#select_sadicional").val();
				if(nombre != ''){
					if(precio != ''){
						if(sin_imagen != "Esperando archivo..."){
							let img_ext = value.name;
							img_ext = img_ext.toUpperCase(); 
							var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
							//
							adicionarSadicional(nombre, extension_img[1], precio, idcategoria);
						}else{
							alert('Escoga una imagen JPG o PNG');
						}
					}else{
						alert('Escriba el precio del servicio adicional');
					}
				}else{
					alert('Digite el nombre del servicio adicional');
				}		
			});
			//
			$('#btnActualizarSadicional').click(function(){
				let imagen_sa = document.getElementById("result2").innerHTML;	
				let id_sa = $("#txtupIdSadicional").val();
				let nombre_sa = $("#txtupSadicional").val();
				let precio_sa = $("#txtupPrecio").val();
				let idcateg_sa = $("#selectup_sadicional").val();	
				//
				let nombre_sa2 = $("#txtupSadicional2").val();
				let precio_sa2 = $("#txtupPrecio2").val();
				let idcateg_sa2 = $("#selectup_sadicional2").val();
				//
				if(nombre_sa != ''){
					if(precio_sa != ''){
						if(idcateg_sa != ''){
							if(imagen_sa != ''){
								let str_base64 = document.getElementById("imgup_sadicional").src; 
								let imagen = str_base64.split(',');	
								//console.log('IMAGEN: '+imagen[0]);
								if(nombre_sa == nombre_sa2){ nombre_sa = 0; }
								if(precio_sa == precio_sa2){ precio_sa = 0; }
								if(idcateg_sa == idcateg_sa2){ idcateg_sa= 0; }		
								if(imagen[0] == "data:image/jpeg;base64" || imagen[0] == 'data:image/png;base64'){									
									var imagen_a = document.getElementById("fileup_sadicional").files[0];
									let img_ext = imagen_a.name;
									var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD									
									//console.log('EXTENSION: '+extension_img[1]);
									//						
									actualizarSadicional(id_sa, nombre_sa, precio_sa, idcateg_sa, extension_img[1], imagen[1]);   //(id, nombre, precio, idcat, ext, base64)
								}else{
									actualizarSadicional(id_sa, nombre_sa, precio_sa, idcateg_sa);
								}								
							}else{

							}
						}else{
							alert('Seleccione la categoria, para actualizar');
						}
					}else{						
						alert('Digite el precio, para actualizar');
					}		
				}else{
					alert('Digite el nombre, para actualizar');
				}		
			});
			//
			$(document).on("click", ".tabb", function(){
				console.log('Pulsó');		
				var id=$(this).attr('id');
				var tipo=$(this).attr('tipo');
				if(id=='tab_sadicionales'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass( "pes-act-inv" )
						$(this).addClass("active pes-act")
						$("#tab_scategoria").removeClass("active pes-act")
						$("#tab_scategoria").addClass( "pes-act-inv" )
						//
						$("#ntab_adicionales").removeClass("txttab");
						$("#ntab_boletas").addClass("txttab");
						//
						$('#panel_scategoria').hide();
						$('#panel_sadicionales').show();
					}
				}else if(id=='tab_scategoria'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass('pes-act-inv')
						$(this).addClass("active pes-act")
						$("#tab_sadicionales").removeClass("active pes-act")
						$("#tab_sadicionales").addClass( "pes-act-inv" )
						//
						$("#ntab_boletas").removeClass("txttab");
						$("#ntab_adicionales").addClass("txttab");
						//
						$('#panel_sadicionales').hide();
						$('#panel_scategoria').show();
					}				
				}else if( $(this).hasClass("pes-act") ){				
				}				
			});
			//
			//<<<<<<<<<<<<<<<<<<<<<<<<<CATEGORIA SERVICIO ADICIONAL>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//			
			$('#btnGuardarScategoria').click(function(){				   
				let nombre = $("#txtAddScategoria").val();
				if(nombre != ''){					
					adicionarScategoria(nombre);					
				}else{
					alert('Escriba el nombre de la Categoria servicio adicional');
				}		
			});
			//
			$('#btnActualizarScategoria').click(function(){
				let id_a = $("#txtupIdScategoria").val();
				let nombre_a = $("#txtupScategoria").val();	
				//
				if(nombre_a != ''){
					actualizarScategoria(id_a,nombre_a);
							
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			//			
			//			
		</script>	
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  	</body>
</html>