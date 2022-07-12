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
		<title>PCA-Boletería</title>
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
	 <style>
		 .selectAltura {
			display:block;
			height:40px;
			width:263px!important;
			padding: 0.1em!important;
			color:#707070 ;	
		}

		.input_pag {
			height:30px;
			width:32px!important;
		}
	 </style>
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
								<div style="cursor:pointer" id="tab_boletas" tipo="boletas" class="active col-3 pes-act tabb">
									<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
										<h3 id="ntab_boletas" class="txttab">Boletas</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_cedad" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_edad">Condición Edad</h3>
										</div>
									</div>
								<!-- <figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure> -->
								</div>

								<div style="cursor:pointer" id="tab_cestatura" tipo="estatura" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_estatura">Condición Estatura</h3>
										</div>
									</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
								</div>
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_atracciones"><!--ATRACCIONES-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Consultar Boletas</div>
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
											<a href="javascript:;" onclick="abreModalActiDesactivaBoletas();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
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
										<select name="cant_reg_boleteria" id="cant_reg_boleteria">
												<option value="10">10</option>
												<option value="20">20</option>
												<option value="30">30</option>
												<option value="40">40</option>
												<option value="50">50</option>
												<option value="60">60</option>
												<option value="70">70</option>
												<option value="80">80</option>
												<option value="90">90</option>
												<option value="100">100</option> 
												<option value="todos">Todos</option>
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
										<h4 id="cant_pags"> </h4><input type="numeric" class="input_pag" id="input_pag"> <a href="javascript:;"><img src="imagenes/ir.png" class='img-fluid title=" editar"="'  id="irPagina"></a>								
									</div>
								</div>
							</section>
							<section class="px-3">
								<div class="table-responsive">
									<table id="tabla_atraccion" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="atraccion_todos" onclick="marcar_atracciones(this);">/ID</h2></th>
												
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Descripción</h2></th>
												<th class="col-1 text-center"><h2>Precio</h2></th>
												<th class="col-1 text-center"><h2>Condición Edad</h2></th>
												<th class="col-1 text-center"><h2>Condición Estatura</h2></th>
												<th class="col-2 text-center"><h2>Imagen</h2></th>
												
												<th class="col-1 text-center"><h2>Estado</h2></th>
												<th class="col-1 text-center"><h2>Servicios Adicionales</h2></th>
												<th class="col-1 text-center"><h2>Atracciones</h2></th>										
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
					  	<section class="px-3 pt-3" id="panel_CEdad"><!--CONDICION DE ACCESO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Categoria Edad</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalEdad();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaEdad();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchCEdad" type="text" onkeyup="doSearch('tabla_cedad', 'searchCEdad')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
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
									<table id="tabla_cedad" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="condicion_todos" onclick="marcar_cacceso(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Edad Minima</h2></th>
												<th class="col-1 text-center"><h2>Edad Maxima</h2></th>
												
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>																					
											</tr>
										</thead>
										<tbody id="tbody_cedad">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>


						  <section class="px-3 pt-3" id="panel_CEstatura"><!--CONDICION DE ACCESO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Categoria Estatura</div>
					  		<div class="border rounded p-3 mb-4">
								<div class="row">
									<div class="col-2 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalEstatura();"><h4 class="mr-2">Adicionar:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/add.png"></figure>							  
										</div>
									</div>
									<div class="col-3 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											<a href="javascript:;" onclick="abreModalActiDesactivaEstatura();"><h4 class="mr-2">Activar / Desactivar selectos:</h4></a>
											<figure class="mr-2 pt-1"><img src="imagenes/union.png"></figure>
										</div>
									</div>
									<div class="col-2"></div>
									<div class="col-5 d-flex justify-content-center">
										<div class="d-flex align-items-center">
											Buscar:&nbsp;&nbsp;&nbsp;<input id="searchCEstatura" type="text" onkeyup="doSearch('tabla_cestatura', 'searchCEstatura')" class="campo" value="Que quieres consultar" onclick = "if(this.value=='Que quieres consultar') this.value=''">
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
									<table id="tabla_cestatura" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="estatura_todos" onclick="marcar_cestatura(this);"></h2></th>
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-1 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-center"><h2>Estatura Minima</h2></th>
												<th class="col-1 text-center"><h2>Estatura Maxima</h2></th>
												
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificación</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>																					
											</tr>
										</thead>
										<tbody id="tbody_cestatura">	
											
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
							<h2 class="modal-title">Adicionar Boletas</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre Boleta</h4></div>
								<div class="col-10"><input type="text" id="nombreBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Descripción</h4></div>
								<div class="col-10"><input type="text" id="descripcionBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Precio</h4></div>
								<div class="col-10"><input type="text" id="precioBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Categoria Edad</h4></div>
								<div class="col-10" id="divSelectEdad">
									
									<select name="categoriaEdad" class="selectAltura" id="categoriaEdad" >
										<option value="">Seleccione</option>
										<option value="">Niños 1-18 años</option>
									</select>

								</div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Categoria Estatura</h4></div>
								<div class="col-10" id="divSelectEstatura">
									
									<select name="categoriaEdad" class="selectAltura" id="categoriaEdad" >
										<option value="">Seleccione</option>
										<option value="">Niños 1-18 años</option>
									</select>

								</div>
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
							 
							<div class="px-3"><input type="button" id="btnGuardarBoleta" value="Guardar"></div>
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
							<h2 class="modal-title">Actualizar boletas</h2>
							<button type="button" id="btnCerrarAtraccionX" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="idBoletaUp"> 
								<div class="col-2 pt-2"><h4>Nombre boleta</h4></div>
								<div class="col-10"><input type="text" id="upNombreBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Descripción</h4></div>
								<div class="col-10"><input type="text" id="upDescripcionBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Precio</h4></div>
								<div class="col-10"><input type="text" id="upPrecioBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Categoria Edad</h4></div>
								<div class="col-10" id="divUpSelectEdad">
									
									<select name="categoriaEdad" class="selectAltura" id="categoriaEdad" >
										<option value="">Seleccione</option>
										<option value="">Niños 1-18 años</option>
									</select>

								</div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Categoria Estatura</h4></div>
								<div class="col-10" id="divUpSelectEstatura">
									
									<select name="categoriaEdad" class="selectAltura" id="categoriaEdad" >
										<option value="">Seleccione</option>
										<option value="">Niños 1-18 años</option>
									</select>

								</div>
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
							<div class="px-3"><input type="submit" id="btnActualizarBoleta" value="Actualizar"></div>
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
							<h2 class="modal-title">Activar/Desactivar Boletas</h2>
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
								<div class="px-3"><input type="button" onclick="btnEstadoBoletas();" value="Guardar"></div><!--id="btnADAtraccion"--> 
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
						<!--<div class="modal-content">-->
						<div class="modal-header">
							<input type="hidden"  id="idTipoBoleta_SA">
							<h2 class="modal-title">Servicios Adicionales de la Boleta</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-4">
									<h4>Nombre Boleta</h4>
									<input type="text" id="txtAtraccion_condicion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px" disabled>
								</div>
  								<div class="col-sm-4">
  									<h4>Servicio Adicional</h4>
  									<div class="caja">
										<select type="text" name="servicio_adicional_select" id="servicio_adicional_select"></select>
									</div>
								</div>								
								<div class="col-sm-4">
									<br>
									<input type="button" onclick="btnAddBoleta_ServicioAdicional();" value="Guardar">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">									
									<table id="tabla_atraccion_condicion" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-4 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-right"><h2>Eliminar</h2></th>																						
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
								<h2 class="modal-title">Eliminar Servicios Adicionales de la Boleta</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
							<input type="hidden"  id="txtBorrarAC">						
								<h3 id="del_ca"></h3>
							</div>					
							<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnDelBoleta_ServicioAdicional();" value="Eliminar"></div><!--id="btnADAtraccion"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>					
					</div>
				</div>
			</div>



			<div class="modal" id="condicionAtraccion" tabindex="-1" style="overflow-y: scroll;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<!--<div class="modal-content">-->
						<div class="modal-header">
							<input type="hidden"  id="idTipoBoleta_AT">
							<h2 class="modal-title">Atracciones de la Boleta</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-4">
									<h4>Nombre Boleta</h4>
									<input type="text" id="txtBoleta_Atraccion" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px" disabled>
								</div>
  								<div class="col-sm-4">
  									<h4>Atracciones</h4>
  									<div class="caja">
										<select type="text" name="atracciones_select" id="atracciones_select"></select>
									</div>
								</div>								
								<div class="col-sm-4">
									<br>
									<input type="button" onclick="btnAddBoleta_Atracciones();" value="Guardar">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">									
									<table id="tabla_atraccion_condicion" class="table" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Id</h2></th>
												<th class="col-4 text-center"><h2>Nombre</h2></th>
												<th class="col-1 text-right"><h2>Eliminar</h2></th>																						
											</tr>
										</thead>
										<tbody id="tbody_boleta_atraccion">
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
			<div class="modal" id="BorrarModalBoletaAtraccion" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">			
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title">Eliminar Atracciones de la Boleta</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
							<input type="hidden"  id="txtBorrarAT">						
								<h3 id="del_ba"></h3>
							</div>					
							<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnDelBoleta_Atraccion();" value="Eliminar"></div><!--id="btnADAtraccion"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>					
					</div>
				</div>
			</div>

			<!--MODALES CONDICIONES-->
			<!--Modal agregar Condicion de Edad-->
			<div class="modal" id="addModalCEdad" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Condición de Edad</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Nombre condición edad</h4></div>
								<div class="col-10"><input type="text" id="txtAddCEdad" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Edad Inicial</h4></div>
								<div class="col-10"><input type="text" id="edadMinimaAdd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Edad Final</h4></div>
								<div class="col-10"><input type="text" id="edadMaximaAdd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>					
							 
						</div>
						<div class="modal-footer">
							<div class="px-3"><input type="button" id="btnGuardarCEdad" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar condicion de Edad-->
			<div class="modal" id="upModalCEdad" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar condición de Edad</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIdCEdad"> 
								<div class="col-2 pt-2"><h4>Nombre condición Edad</h4></div>
								<div class="col-10"><input type="text" id="txtupCEdad" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Edad Mínima</h4></div>
								<div class="col-10"><input type="text" id="EdadMinimaUpd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Edad Máxima</h4></div>
								<div class="col-10"><input type="text" id="EdadMaximaUpd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							 
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarCEdad" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar Condicion de Edad--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalCEdad">
				<div class="modal-dialog">
					<div class="modal-content">			
					<!--<div class="modal-dialog modal-dialog-scrollable" role="document">-->
						<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Activar/Desactivar condiciones de Edad</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">						
							<h3 id="p_cant_edad"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnEstadoEdad();" value="Guardar"></div><!--id="btnADCacceso"--> 
								<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
							</div>
						</div>
					<!--</div>-->
					</div>
				</div>
			</div>


			<!--MODALES CONDICIONES-->
			<!--Modal agregar Condicion de ESTATURA-->
			<div class="modal" id="addModalCEstatura" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Adicionar Condición de Estatura</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">
							<div class="row mb-4">
								
								<div class="col-2 pt-2"><h4>Nombre condición Estatura</h4></div>
								<div class="col-10"><input type="text" id="txtAddCEstatura" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							
							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Estatura Mínima</h4></div>
								<div class="col-10"><input type="text" id="estaturaMinimaAdd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>

							<div class="row mb-4">
								<div class="col-2 pt-2"><h4>Estatura Máxima</h4></div>
								<div class="col-10"><input type="text" id="estaturaMaximaAdd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>
							</div>
							 
						</div>
						<div class="modal-footer">
							<div class="px-3"><input type="button" id="btnGuardarCEstatura" value="Guardar"></div>
							<div><input type="button" data-dismiss="modal" value="Cerrar"></div>
						</div>
					</div>
				</div>
			</div> 
			<!--Modal actualizar condicion de acceso-->
			<div class="modal" id="upModalCEstatura" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar condición de Estatura</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIdCEstatura"> 
								<div class="col-2 pt-2"><h4>Nombre condición Estatura</h4></div>
								<div class="col-10"><input type="text" id="txtupCEstatura" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Estatura Mínima</h4></div>
								<div class="col-10"><input type="text" id="EstaturaMinimaUpd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								 
								<div class="col-2 pt-2"><h4>Estatura Máxima</h4></div>
								<div class="col-10"><input type="text" id="EstaturaMaximaUpd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarCEstatura" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
			<!--Modal Activar/Desactivar Condicion de acceso--><!--tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"-->
			<div class="modal" tabindex="-1" id="estadoModalCEstatura">
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
							<h3 id="p_cant_estatura"></h3>
						</div>					
						<div class="modal-footer">							
								<div class="px-3"><input type="button" onclick="btnEstadoEstatura();" value="Guardar"></div><!--id="btnADCacceso"--> 
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
			 
			//		
			$(document).ready(function(){
				$('#panel_CEdad').hide(); //muestro mediante id
				$('#panel_CEstatura').hide();
                cargar_datos_boleteria();
				cargar_datos_atracciones();
				cargar_datos_servicio_adicional();
				cargar_datos_condicion_edad();
				cargar_datos_condicion_estatura();
				$('#servicio_adicional_select').on('change', function (){
			        console.log('pulso');
			        var id = $("#idTipoBoleta_SA").val();
			        cargar_datos_bs(id);
			    });	
							
			});
			//
			document.getElementById("file").addEventListener("change",openImage,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
			//
			document.getElementById("file2").addEventListener("change",openImage2,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo al actualizar 
			//
			
			//
			$('#btnGuardarBoleta').click(function(){
				//Toma el archivo elegido por el input 
				var value               = document.getElementById("file").files[0];
				var sin_imagen          = document.getElementById("result").innerHTML;    
				var nombre              = $("#nombreBoleta").val();
				var descripcion         = $("#descripcionBoleta").val();
				var precio              = $("#precioBoleta").val();
				var idcategoriaEdad     = $("#categoriaEdad").val(); 
				var idcategoriaEstatura = $("#categoriaEdad").val(); 

				if(nombre != '' && descripcion!='' && precio!='' && idcategoriaEdad!='' && idcategoriaEstatura!='' ){
					if(sin_imagen != "Esperando archivo..."){
						let img_ext = value.name;
						img_ext = img_ext.toUpperCase(); 
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD
						//
						adicionarBoletas(nombre, descripcion, precio, idcategoriaEdad,idcategoriaEstatura, extension_img[1]);
					}else{
						alert('Escoga una imagen JPG o PNG');
					}
				}else{
					alert('Escriba el nombre de la Atraccion');
				}		
			});
			//
			$('#btnActualizarBoleta').click(function(){
				var r_imagen = document.getElementById("result2").innerHTML;	
				var id_a = $("#idBoletaUp").val();
				var nombre_a =$("#upNombreBoleta").val();
    			var descripcion_a = $("#upDescripcionBoleta").val();
    			var precio_a=$("#upPrecioBoleta").val();
    			var categoriaEdad_a = $("#upCategoriaEdad").val();
    			var categoriaEstatura_a= $("#upCategoriaEstatura").val();
    			  
				//
				if(nombre_a != '' && imagen_a != '' && descripcion_a!='' && precio_a!='' && categoriaEdad_a!='' && categoriaEstatura_a!=''){
					let str_base64 = document.getElementById("img2").src;
					let imagen = str_base64.split(',');	
					console.log('IMAGEN: '+imagen[0]);		
					if(imagen[0] == "data:image/jpeg;base64" || imagen[0] == 'data:image/png;base64'){

						console.log("paso por el 1");
						//return(false);
						//console.log("base64: " imagen[0]);////////////////////////////
						var imagen_a = document.getElementById("file2").files[0];
						let img_ext = imagen_a.name;
						var extension_img = img_ext.split('.'); // Saco la extension para guardarla en la BD 
						console.log('EXTENSION: '+extension_img[1]);
						//						
						actualizarBoletas2(id_a,nombre_a,descripcion_a,precio_a,categoriaEdad_a,categoriaEstatura_a, extension_img[1], imagen[1]);
					}else{
						console.log("paso por el 2");
						//return(false);
						console.log("URL");/////////////////////////////
						actualizarBoletas2(id_a,nombre_a,descripcion_a,precio_a,categoriaEdad_a,categoriaEstatura_a,'null','null');
					}		
				}else{
					alert('Llene todos los campos, para actualizar');
				}		
			});
			$('#cant_reg_boleteria').change(function(){
				 	
					  
					 var cant_reg_boleteria =$("#cant_reg_boleteria").val();
					 var page=1;
					 if(    cant_reg_boleteria!=''){
						 
						 
							 cargar_datos_boleteria( cant_reg_boleteria,page);
							 
					 }else{
						 alert('Por favor complete todos los campos!');
					 }		
				  });
 
 
				  $('#irPagina').click(function(){
					  
					   
					  var cant_reg_boleteria=$("#cant_reg_boleteria").val();
					  var page= $("#input_pag").val() ;
					  //alert("page:"+page);
					  //return(false);
					  if(  page!='' && cant_reg_boleteria!=''){
						  
						  
						cargar_datos_boleteria(cant_reg_boleteria,page);
							  
					  }else{
						  alert('Por favor complete todos los campos!');
					  }		
				   });
			//
			$(document).on("click", ".tabb", function(){		
				var id=$(this).attr('id');
				var tipo=$(this).attr('tipo');
				if(id=='tab_boletas'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass( "pes-act-inv" )
						$(this).addClass("active pes-act")
						$("#tab_cedad").removeClass("active pes-act")
						$("#tab_cedad").addClass( "pes-act-inv" )
						$("#tab_cestatura").removeClass("active pes-act")
						$("#tab_cestatura").addClass( "pes-act-inv" )
						//
						$("#ntab_edad").removeClass("txttab");
						$("#ntab_estatura").removeClass("txttab");
						$("#ntab_boletas").addClass("txttab");
						//
						$('#panel_CEdad').hide();
						$('#panel_CEstatura').hide();
						$('#panel_atracciones').show();
					}
				}else if(id=='tab_cedad'){
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass('pes-act-inv')
						$(this).addClass("active pes-act")
						$("#tab_boletas").removeClass("active pes-act")
						$("#tab_boletas").addClass( "pes-act-inv" )
						$("#tab_cestatura").removeClass("active pes-act")
						$("#tab_cestatura").addClass( "pes-act-inv" )
						//
						$("#ntab_boletas").removeClass("txttab");
						$("#ntab_estatura").removeClass("txttab");
						$("#ntab_edad").addClass("txttab");
						//
						$('#panel_atracciones').hide();
						$('#panel_CEstatura').hide();
						$('#panel_CEdad').show();
					}				
				}else if( id=='tab_cestatura' ){
					
					if( $(this).hasClass("pes-act-inv") ){
						$(this).removeClass('pes-act-inv')
						$(this).addClass("active pes-act")

						$("#tab_boletas").removeClass("active pes-act")
						$("#tab_boletas").addClass( "pes-act-inv" )
						$("#tab_cedad").removeClass("active pes-act")
						$("#tab_cedad").addClass( "pes-act-inv" )
						//
						$("#ntab_boletas").removeClass("txttab");
						$("#ntab_edad").removeClass("txttab");
						$("#ntab_estatura").addClass("txttab");
						//
						$('#panel_atracciones').hide();
						$('#panel_CEdad').hide();
						$('#panel_CEstatura').show();
						
					}

				}				
			});

			//
			//<<<<<<<<<<<<<<<<<<<<<<<<<CONDICION EDAD>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//	
			$('#btnGuardarCEdad').click(function(){
				//Toma el archivo elegido por el input 
				     
				var nombre = $("#txtAddCEdad").val();
				var edadMinima = $("#edadMinimaAdd").val();
				var edadMaxima = $("#edadMaximaAdd").val();

				if(nombre != '' && edadMinima!='' && edadMaxima!=''){
					 
					
						adicionarCEdad(nombre, edadMinima, edadMaxima);
					 	
				}else{
					alert('Por favor complete todos los campos!');
				}		
			});

			$('#btnActualizarCEdad').click(function(){
				 	
				var id_a = $("#txtupIdCEdad").val();
				var nombre_a = $("#txtupCEdad").val();
				var edadMinima_a = $("#EdadMinimaUpd").val();
				var edadMaxima_a =$("#EdadMaximaUpd").val();	
				//
				if(nombre_a != '' && edadMinima_a != '' && edadMaxima_a!=''){
					 
						actualizarCEdad(id_a,nombre_a,edadMinima_a,edadMaxima_a);
							
				}else{
					
					console.log("nombre_a:"+nombre_a+" , edadMinima_a:"+edadMinima_a+" , edadMaxima_a:"+edadMaxima_a)

					alert('Llene todos los campos, para actualizar');
				}		
			});


			//
			//<<<<<<<<<<<<<<<<<<<<<<<<<CONDICION ESTATURA>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			//	
			$('#btnGuardarCEstatura').click(function(){
				//Toma el archivo elegido por el input 
				     
				var nombre = $("#txtAddCEstatura").val();
				var estaturaMinima = $("#estaturaMinimaAdd").val();
				var estaturaMaxima = $("#estaturaMaximaAdd").val();

				if(nombre != '' && estaturaMinima!='' && estaturaMaxima!=''){
					 
					
						adicionarCEstatura(nombre, estaturaMinima, estaturaMaxima);
					 	
				}else{
					alert('Por favor complete todos los campos!');
				}		
			});

			$('#btnActualizarCEstatura').click(function(){
				 	
				var id_a = $("#txtupIdCEstatura").val();
				var nombre_a = $("#txtupCEstatura").val();
				var estaturaMinima_a = $("#EstaturaMinimaUpd").val();
				var estaturaMaxima_a =$("#EstaturaMaximaUpd").val();	
				//
				if(nombre_a != '' && estaturaMinima_a != '' && estaturaMaxima_a!=''){
					 
						actualizarCEstatura(id_a,nombre_a,estaturaMinima_a,estaturaMaxima_a);
							
				}else{
					
					alert('Llene todos los campos, para actualizar');
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