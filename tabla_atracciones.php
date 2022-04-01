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
		<script src="js/views/funciones.js"></script>
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
								<div style="cursor:pointer" id="tab_atracciones" tipo="boletas" class="active col-3 pes-act tabb">
									<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
										<h3 id="ntab_boletas" class="txttab">Atracciones</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_cacceso" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_adicionales">Condiciones de acceso</h3>
										</div>
									</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
							</div>
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_atracciones">					  
							<div class="text-center sub-titulo-form textos-medios  mb-4">Consultar Atracciones</div>
					  		<div class="border rounded p-3 mb-4">
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
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchTerm" type="text" onkeyup="doSearch('tabla_atraccion', 'searchTerm')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>
					  	  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="nmostrar" id="nmostrar">
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
											<figure class="mr-2 pt-1"><a href="exportar/atracciones/atraccion_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/atracciones/atraccion_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/atracciones/atraccion_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager"></ul>
										<!--<div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div>-->
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_atraccion" class="table">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="atraccion_todos" onclick="marcar_atracciones(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>
												<th class="col-1 text-center"><h2>Condiciones Acceso</h2></th>										
											</tr>
										</thead>
										<tbody id="tbody_atraccion">
											<!--Se llena la tabla-->
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>
					  	</section>
					  	<section class="px-3 pt-3" id="panel_Cacceso">					
							<div class="text-center sub-titulo-form textos-medios  mb-4">Condici&oacute;n de acceso</div>
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
												<th class="col-1 text-center"><h2><input type="checkbox" name="condicion_todos" onclick="marcar_cacceso(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>																					
											</tr>
										</thead>
										<tbody id="tbody_cacceso">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>
					</div>		  
				</div>
			</section>
			<!--MODALES ATRACCIONES-->
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
			<div class="modal" id="estadoModalAtraccion" tabindex="-1">
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
			<!--Modal Condiciones de la Atracion-->
			<div class="modal" id="condicionModalAcceso" tabindex="-1" style="overflow-y: scroll;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<input type="hidden"  id="txtIdAtraccion_condicion">
							<h2 class="modal-title">Condiciones de las atracci&oacute;n</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-4">
									<h4>Nombre atraccion</h4>
									<input type="text" id="txtAtraccion_condicion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px" disabled>
								</div>
  								<div class="col-sm-4">
  									<h4>Condicion acceso</h4>
  									<div class="caja">
										<select type="text" name="condicion_mostrar" id="condicion_mostrar"></select>
									</div>
								</div>								
								<div class="col-sm-4">
									<br>
									<input type="button" onclick="btnAddAtraccion_condicion();" value="Guardar">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">									
									<table id="tabla_atraccion_condicion" class="table">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-2 text-center"><h2>Eliminar</h2></th>																						
											</tr>
										</thead>
										<tbody id="tbody_atraccion_condicion">
											<!--Se llena la tabla-->
										</tboby>	
									</table>											
								</div>
							</div>													
						</div>			
						<div class="modal-footer">							
								<div class="px-3"></div>
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>
					<!--</div>-->
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
								<div class="px-3"><input type="button" onclick="btnDelAtraccion_condicion();" value="Eliminar"></div><!--id="btnADAtraccion"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<!--MODALES CONDICIONES-->
			<!--Modal agregar atracci&oacute;n-->
			<div class="modal" id="addModalCacceso" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar atracciones</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre condici&oacute;n acceso</h4></div>
								<div class="col-10"><input type="text" id="txtAddCacceso" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>					
							<div class="mb-3">
								<input type="file" id="file_condicion" accept=".jpg,.png"/>								
								<br>
								<div id="result_condicion"><h4>Esperando archivo...</h4></div>								
								<br>
								<img id="img_condicion" width="400" height="260"/>
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
								<div id="result2_condicion">El archivo es valido</div>
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
							<h3 id="p_cant_condicion"></h3>
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
			var select = document.getElementById('nmostrar');
			select.addEventListener('change', function(){
				restaurar_paginacion('myPager');				
				var selectedOption = this.options[select.selectedIndex];
				var Mostrar = selectedOption.text == 'Todos' ? 1000000 : selectedOption.text;
				$('#tbody_atraccion').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar});				
			});
			//
			var select_condicion = document.getElementById('nmostrar_cacceso');
			select_condicion.addEventListener('change', function(){
				restaurar_paginacion('myPager2');				
				var selectedOption2 = this.options[select_condicion.selectedIndex];
				var Mostrar2 = selectedOption2.text == 'Todos' ? 1000000 : selectedOption2.text;
				$('#tbody_cacceso').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar2});
			});
			//		
			$(document).ready(function(){
				$('#panel_Cacceso').hide(); //muestro mediante id
				cargar_datos();
				cargar_datos_condicion();
				$('#condicion_mostrar').on('change', function (){
			        console.log('pulso');
			        var id = $("#txtIdAtraccion_condicion").val();
			        cargar_datos_ac(id);
			    });	
							
			});
			//
			document.getElementById("file").addEventListener("change",openImage,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("file2").addEventListener("change",openImage2,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			document.getElementById("file_condicion").addEventListener("change",openImage_condicion,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("file2_condicion").addEventListener("change",openImage2_condicion,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			$('#btnGuardarAtraccion').click(function(){
				//Toma el archivo elegido por el input 
				var value = document.getElementById("file").files[0];
				var sin_imagen = document.getElementById("result").innerHTML;    
				var nombre = $("#txtAddAtraccion").val();
				if(nombre != ''){
					if(sin_imagen != "Esperando archivo..."){
						let img_ext = value.name;
						img_ext = img_ext.toUpperCase(); 
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
						//
						adicionarAtracciones(nombre, extension_img[1]);
					}else{
						alert('Escoga una imagen JPG o PNG');
					}
				}else{
					alert('Escriba el nombre de la Atraccion');
				}		
			});
			//
			$('#btnActualizarAtraccion').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#txtupIdAtraccion").val();
				var nombre_a = $("#txtupAtraccion").val();	
				//
				if(nombre_a != '' && imagen_a != ''){
					let str_base64 = document.getElementById("img2").src;
					let imagen = str_base64.split(',');	
					console.log('IMAGEN: '+imagen[0]);		
					if(imagen[0] == "data:image/jpeg;base64" || imagen[0] == 'data:image/png;base64'){
						//console.log("base64: " imagen[0]);////////////////////////////
						var imagen_a = document.getElementById("file2").files[0];
						let img_ext = imagen_a.name;
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
						console.log('EXTENSION: '+extension_img[1]);
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
			$(document).on("click", ".tabb", function(){		
				var id=$(this).attr('id');
				var tipo=$(this).attr('tipo');
				if(id=='tab_atracciones'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass( "pes-act-inv" )
						$(this).addClass("active pes-act")
						$("#tab_cacceso").removeClass("active pes-act")
						$("#tab_cacceso").addClass( "pes-act-inv" )
						//
						$("#ntab_adicionales").removeClass("txttab");
						$("#ntab_boletas").addClass("txttab");
						//
						$('#panel_Cacceso').hide();
						$('#panel_atracciones').show();
					}
				}else if(id=='tab_cacceso'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass('pes-act-inv')
						$(this).addClass("active pes-act")
						$("#tab_atracciones").removeClass("active pes-act")
						$("#tab_atracciones").addClass( "pes-act-inv" )
						//
						$("#ntab_boletas").removeClass("txttab");
						$("#ntab_adicionales").addClass("txttab");
						//
						$('#panel_atracciones').hide();
						$('#panel_Cacceso').show();
					}				
				}else if( $(this).hasClass("pes-act") ){				
				}				
			});
			//
			//<<<<<<<<<<<<<<<<<<<<<<<<<CONDICION ACCESO>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//			
			$('#btnGuardarCacceso').click(function(){
				//Toma el archivo elegido por el input 
				var value = document.getElementById("file_condicion").files[0];
				var sin_imagen = document.getElementById("result_condicion").innerHTML;     
				var nombre = $("#txtAddCacceso").val();
				if(nombre != ''){
					if(sin_imagen != "Esperando archivo..."){
						let img_ext = value.name;
						img_ext = img_ext.toUpperCase(); 
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
						//
						adicionarCacceso(nombre, extension_img[1]);
					}else{
						alert('Escoga una imagen JPG o PNG');
					}	
				}else{
					alert('Escriba el nombre de la Condici\u00F3n acceso');
				}		
			});
			//
			$('#btnActualizarCacceso').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#txtupIdCacceso").val();
				var nombre_a = $("#txtupCacceso").val();	
				//
				if(nombre_a != '' && imagen_a != ''){
					let str_base64 = document.getElementById("img2_condicion").src;
					let imagen = str_base64.split(',');			
					if(imagen[0] == "data:image/jpeg;base64" || imagen[0] == 'data:image/png;base64'){
						var imagen_a = document.getElementById("file2_condicion").files[0];
						let img_ext = imagen_a.name;
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
						//						
						actualizarCacceso(id_a,nombre_a, extension_img[1], imagen[1]);
					}else{
						actualizarCacceso2(id_a,nombre_a);
					}		
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