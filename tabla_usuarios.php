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
										<h3 id="ntab_boletas" class="txttab">Usuarios</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_scategoria" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_adicionales"> Roles</h3>
										</div>
									</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
							</div>
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_sadicionales"><!--SECTION METODO PAGO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Listado de Usuarios</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalPmetodo();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaPmetodo();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchSadicional" type="text" onkeyup="doSearch('tabla_pmetodo','searchSadicional')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
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
											<figure class="mr-2 pt-1"><a href="exportar/pmetodo/pmetodo_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/pmetodo/pmetodo_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/pmetodo/pmetodo_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager_pmetodo"></ul>
										<!--<div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div>-->
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_pmetodo" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="pmetodo_todos" onclick="marcar_pmetodo(this);"></h2></th>
												 <th class="col-1 text-center"><h2>Id</h2></th> 
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												 
												<th class="col-1 text-center"><h2>Creado Por</h2></th>  
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>  
												<th class="col-1 text-center"><h2>Modificado Por</h2></th> 
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th> 
																			
											</tr>
										</thead>
										<tbody id="tbody_pmetodo">
											<!--Se llena la tabla-->
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>
					  	</section>
					  	<section class="px-3 pt-3" id="panel_scategoria"><!--SECTION RECEPCION PAGO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Listado Roles</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalPrecepcion();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaPrecepcion();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchScategoria" type="text" onkeyup="doSearch('tabla_precepcion', 'searchScategoria')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
										</div>
									</div>													
					  			</div>
							</div>					  	
						  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="nmostrar_precepcion" id="nmostrar_precepcion">
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
											<figure class="mr-2 pt-1"><a href="exportar/precepcion/precepcion_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/precepcion/precepcion_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/precepcion/precepcion_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>								
									<div class="col-3 d-flex align-items-center justify-content-end">
										<ul class="pagination pagination-lg pager mr-2 pt-2" id="myPager_precepcion"></ul>									
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_precepcion" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="precepcion_todos" onclick="marcar_precepcion(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Menu Padre</h2></th>
												<th class="col-2 text-center"><h2>Nombre</h2></th>
                                                <th class="col-2 text-center"><h2>Url</h2></th>
											</tr>
										</thead>
										<tbody id="tbody_precepcion">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>
					</div>		  
				</div>
			</section>
			<!--MODALES METODO PAGO-->
			<!--Modal agregar metodo de pago-->
			<div class="modal" id="addModalPmetodo" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar M&eacute;todo de pago</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Nombre m&eacute;todo pago</h4></div>
									<div class="col-10"><input type="text" id="txtAddPMnombre" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-12 pt-2"><h4>Cuenta destino</h4></div>
									<div class="col-10"><input type="text" id="txtAddPMcuentad" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-12 pt-2"><h4>Tipo</h4></div>
									<div class="col-10">
										<div class="caja">
											<select type="text" name="select_pmtipo" id="select_pmtipo">
												<option value="EFECTIVO">EFECTIVO</option>
												<option value="DATAFONO">DATAFONO</option>
												<!--<option value="3">Opción 3</option>-->
											</select>
										</div>
									</div>
								</div>										
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Recepci&oacute;n pago</h4></div>
									<div class="col-10">
										<div class="">
											<select type="text" name="select_precepcion" id="select_precepcion" multiple data-value="{{select_precepcion}}"></select>
										</div>
									</div>
									<br>
									<div class="col-12 pt-2"><h4>Datos de autorizaci&oacute;n</h4></div>
									<div class="col-10"><input type="checkbox" name="chkAddPMautorizado" id="chkAddPMautorizado" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
								</div>
							</div>
						</div>
						<div class="modal-footer">							
							<div class="px-3"><input type="button" id="btnGuardarPmetodo" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div>
			<!--Actualiza metodo de pago-->
			<div class="modal" id="upModalPmetodo" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar M&eacute;todo de pago</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden"  id="txtUpIdPmetodo">
							<div class="row">
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Nombre m&eacute;todo pago</h4></div>
									<div class="col-10"><input type="text" id="txtUpPMnombre" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-12 pt-2"><h4>Cuenta destino</h4></div>
									<div class="col-10"><input type="text" id="txtUpPMcuentad" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
									<br>
									<div class="col-12 pt-2"><h4>Tipo</h4></div>
									<div class="col-10">
										<div class="caja">
											<select type="text" name="select_up_pmtipo" id="select_up_pmtipo">
												<option value="EFECTIVO">EFECTIVO</option>
												<option value="DATAFONO">DATAFONO</option>
												<!--<option value="3">Opción 3</option>-->
											</select>
										</div>
									</div>
								</div>										
								<div class="col-sm-6">
									<div class="col-12 pt-2"><h4>Recepci&oacute;n pago</h4></div>
									<div class="col-10">
										<div class="">
											<select type="text" name="select_up_precepcion" id="select_up_precepcion" multiple data-value="{{select_up_precepcion}}"></select>
										</div>
									</div>
									<br>
									<div class="col-12 pt-2"><h4>Datos de autorizaci&oacute;n</h4></div>
									<div class="col-10"><input type="checkbox" name="chkUpPMautorizado" id="chkUpPMautorizado" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
								</div>
							</div>
						</div>
						<div class="modal-footer">							
							<div class="px-3"><input type="button" onclick="btnActualizarPmetodo();" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div>			
			<!--Modal Activar/Desactivar Metodo de pago--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" id="estadoModalPmetodo" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">					
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar M&eacute;todo de pago</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant_pmetodo"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADPmetodo();" value="Guardar"></div>
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
			<!--MODALES RECEPCION PAGO-->
			<!--Modal agregar recepcion pago-->
			<div class="modal" id="addModalPrecepcion" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Recepci&oacute;n de pago</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre recepci&oacute;n</h4></div>
								<div class="col-10"><input type="text" id="txtAddPrecepcion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>							
						</div>
						<div class="modal-footer">
							<div class="px-3"><input type="button" id="btnGuardarPrecepcion" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar scategoria-->
			<div class="modal" id="upModalPrecepcion" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar recepci&oacute;n de pago</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIPrecepcion"> 
								<div class="col-2 pt-2"><h4>Nombre recepci&oacute;n</h4></div>
								<div class="col-10"><input type="text" id="txtupPrecepcion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>							
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarPrecepcion" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar Recepcion de pago--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalPrecepcion">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar Recepci&oacute;n de pago</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant_precepcion"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnADPrecepcion();" value="Guardar"></div><!--id="btnADCacceso"--> 
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
				restaurar_paginacion('myPager_pmetodo');				
				var selectedOption = this.options[cant_sadicional.selectedIndex];
				var Mostrar_sadicional = selectedOption.text == 'Todos' ? 1000000 : selectedOption.text;
				$('#tbody_pmetodo').pageMe({pagerSelector:'#myPager_pmetodo',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar_sadicional});				
			});
			//
			var cant_precepcion = document.getElementById('nmostrar_precepcion');
			cant_precepcion.addEventListener('change', function(){
				restaurar_paginacion('myPager_precepcion');				
				var selectedOption2 = this.options[cant_scategoria.selectedIndex];
				var Mostrar_scategoria = selectedOption2.text == 'Todos' ? 1000000 : selectedOption2.text;
				$('#tbody_precepcion').pageMe({pagerSelector:'#myPager_precepcion',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar_scategoria});
			});
			//		
			$(document).ready(function(){
				$('#panel_scategoria').hide(); //muestro mediante id
				cargar_datos_pmetodo();
				cargar_datos_precepcion();
				console.log('No afueraaaaaaaaaaaaa');						
			});
			//
			$('#btnGuardarPmetodo').click(function(){ 
				let nombre = $("#txtAddPMnombre").val();
				let cuentad = $("#txtAddPMcuentad").val();
				let tipo = $("#select_pmtipo").val();
				let idrecepcion = [...$("#select_precepcion :selected")].map(e => e.value); //$("#select_precepcion").val();				
				let chk = $('#chkAddPMautorizado').prop('checked'); //$("#chkAddPMautorizado").val();
				//											
				if(nombre != ''){
					if(cuentad != ''){
						if(tipo != ''){
							adicionarPmetodo(nombre, cuentad, tipo, idrecepcion, chk);
						}else{
							alert('Seleccione el tipo');
						}
					}else{
						alert('Digite la cuenta');
					}
				}else{
					alert('Digite el nombre del m\u00E9todo de pago');
				}		
			});
			//
			/*$('#btnActualizarPmetodo').click(function(){
				let pm_id = $("#txtUpIdPmetodo").val(); console.log(pm_id);
				let pm_nombre = $("#txtUpPMnombre").val();
				let pm_cuentad = $("#txtUpPMcuentad").val();
				let pm_tipo = $("#select_up_pmtipo").val();
				let pm_idrecepcion = [...$("#select_up_precepcion :selected")].map(e => e.value); //$("#select_precepcion").val();				
				let pm_chk = $('#chkUpPMautorizado').prop('checked'); //$("#chkAddPMautorizado").val();	
				//
				//let nombre_sa2 = $("#txtupSadicional2").val();
				//let precio_sa2 = $("#txtupPrecio2").val();
				//let idcateg_sa2 = $("#selectup_sadicional2").val();
				//
				if(pm_nombre != ''){
					if(pm_cuentad != ''){
						if(pm_tipo != ''){
							//if(imagen_sa != ''){								
								//if(nombre_sa == nombre_sa2){ nombre_sa = 0; }
								//if(precio_sa == precio_sa2){ precio_sa = 0; }
								//if(idcateg_sa == idcateg_sa2){ idcateg_sa= 0; }																		
								//						
								actualizarPmetodo(pm_id, pm_nombre, pm_cuentad, pm_tipo, pm_idrecepcion, pm_chk); 										
							//}else{

							//}
						}else{
							alert('Seleccione la categoria, para actualizar');
						}
					}else{						
						alert('Digite el precio, para actualizar');
					}		
				}else{
					alert('Digite el nombre, para actualizar');
				}		
			});*/
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
			//<<<<<<<<<<<<<<<<<<<<<<<<<RECEPCION PAGO>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//			
			$('#btnGuardarPrecepcion').click(function(){
				let nombre = $("#txtAddPrecepcion").val();
				if(nombre != ''){					
					adicionarPrecepcion(nombre);					
				}else{
					alert('Escriba el nombre de la Categoria servicio adicional');
				}		
			});
			//
			$('#btnActualizarPrecepcion').click(function(){
				let id_pm = $("#txtupIPrecepcion").val();
				let nombre_pm = $("#txtupPrecepcion").val();	
				//
				if(nombre_pm != ''){
					actualizarPrecepcion(id_pm,nombre_pm);
							
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