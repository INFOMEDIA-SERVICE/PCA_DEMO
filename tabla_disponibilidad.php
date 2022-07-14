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
		<title>PCA-Disponibilidad</title>
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
										<h3 id="ntab_boletas" class="txttab">Crear Disponibilidad</h3>
									</div>
								</div>							
								<div style="cursor:pointer" id="tab_cedad" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabb" style="border-radius: 0px;">
									<div class="d-flex align-items-center cerrar mr-3 ">
										<div class="text-left">
											<h3  id="ntab_edad">Buscar Disponibilidad</h3>
										</div>
									</div>
								<!-- <figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure> -->
								</div>

								 
								<div class="col-md-6 col-0 pes-act-inv3"></div>
					   		</div>
						</div>
				   		<section class="px-3 pt-3" id="panel_atracciones"><!--ATRACCIONES-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Disponibilidad Boletas</div>

					  		<div class="border rounded p-3 mb-4">
								<div class="row">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Boleta</label>
                                    <div class="col-sm-10" id="div_select_tipo_boleta">
                                        <selec id="select_tipo_boleta"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Desde</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" id="fecha_desde"  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Hasta</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" id="fecha_hasta"  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Cantidad </label>
                                    <div class="col-sm-10">
                                    <input type="numeric" class="form-control" id="cantidad"  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    <input type="button" style="width: 60%" value="Agregar" id="btnAgregar">
                                    </div>
                                    <div class="col-sm-10" id="div_resultado"></div>
                                </div>												
					  			</div>
							</div>
					  	  	 
							 
					  	</section>
					  	<section class="px-3 pt-3" id="panel_CEdad"><!--CONDICION DE ACCESO-->
							<div class="text-center sub-titulo-form textos-medios  mb-4">Buscar Disponibilidades</div>
					  		<div class="border rounded p-3 mb-4">
                              <div class="row">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Boleta</label>
                                    <div class="col-sm-10" id="div_select_tipo_boleta2">
                                        <selec id="select_tipo_boleta2"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Desde</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" id="fecha_desde2"  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Hasta</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" id="fecha_hasta2"  >
                                    </div>
                                </div>
                                 
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    <input type="button" style="width: 60%" value="Buscar" id="btnBuscar">
                                    </div>
                                     
                                </div>												
					  			</div>
							</div>					  	
						  	<section class="px-3 mb-3">
						  		<div class="row">
								  	<div class="col-3 d-flex align-items-center justify-content-center">
										<h4 class="text-right pt-3 mr-2">Mostrar:</h4>
										<div class="caja" style="width: 100px">
											<select name="cant_reg_disponibilidad" id="cant_reg_disponibilidad">
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
											<figure class="mr-2 pt-1"><a href="exportar/condicion_acceso/cacceso_pdf.php"><img src="imagenes/pdf.png"></a></figure>
											<figure class="mr-2 pt-1"><a href="exportar/condicion_acceso/cacceso_word.php"><img src="imagenes/file-word.png"></a></figure>
											<figure class="pt-1"><a href="exportar/condicion_acceso/cacceso_excel.php"><img src="imagenes/file-excel.png"></a></figure>
										</div>
									</div>
									
									
									<div class="col-3 d-flex align-items-center justify-content-end">
										<h4 id="cant_pags"> </h4><input type="numeric" class="input_pag" id="input_pag"> <a href="javascript:;"><img src="imagenes/ir.png" class='img-fluid title=" editar"="'  id="irPagina"></a>								
									</div>
								</div>
							</section>
							<section class="px-3">
								<div>
									<table id="tabla_cedad" class="table_peq" style="border-collapse: unset !important;">
										<thead>							  
											<tr class="row ">
												<th class="col-1 text-center"><h2>Editar</h2></th>
												<th class="col-1 text-center"><h2><input type="checkbox" name="condicion_todos" onclick="marcar_cacceso(this);"></h2>/ID</th>
												 
												<th class="col-1 text-center"><h2>Tipo Boleta</h2></th>
												<th class="col-1 text-center"><h2>Fecha</h2></th>
												<th class="col-1 text-center"><h2>Cantidad Maxima</h2></th>
                                                <th class="col-1 text-center"><h2>Cantidad Reservada </h2></th>
                                                <th class="col-1 text-center"><h2>Cantidad Disponible</h2></th>
												<th class="col-1 text-center"><h2>Creado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Creación</h2></th>
												<th class="col-1 text-center"><h2>Modificado Por</h2></th>
												<th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
												<th class="col-1 text-center"><h2>Estado</h2></th>																					
											</tr>


                                             
										</thead>
										<tbody id="tbody_disponibilidades">	
											
										</tboby>	
									</table>								
									<!--<div><p id="ratracciones" style="font-size: 12px">n&uacute;meros de registros: 24</P> </div>-->
								</div>
						  	</section>	
					  	</section>


						     
					</div>		  
				</div>
			</section>
			 
			 
			 
			 


			 


            <!--Modal actualizar disponibilidad-->
			<div class="modal" id="upModalDisponibilidad" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Actualizar Disponibilidad</h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body mx-auto">                        
							<div class="row mb-4">
								<input type="hidden"  id="txtupIdDisponibilidad"> 
								<div class="col-2 pt-2"><h4>Tipo Boleta</h4></div>
								<div class="col-10"><input type="text" id="txtTipoBoleta" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Fecha</h4></div>
								<div class="col-10"><input type="text" id="txtFecha" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>

							<div class="row mb-4">
								  
								<div class="col-2 pt-2"><h4>Cantidad Máxima</h4></div>
								<div class="col-10"><input type="text" id="cantMaximaUpd" style="background: #fff; border:1px solid #BEBEBE; border-radius: 10px"></div>                            
							</div>
							 
						</div>
						<div class="modal-footer">					
							<div class="px-3"><input type="submit" id="btnActualizarDisponibilidad" value="Editar"></div>
							<div><input  type="button" data-dismiss="modal" value="Cerrar"></div>									
						</div>
					</div>
				</div>
			</div>
 		
	  	</main>
	  	<script>
			 
			/*var select_condicion = document.getElementById('nmostrar_cacceso');
			select_condicion.addEventListener('change', function(){
				restaurar_paginacion('myPager2');				
				var selectedOption2 = this.options[select_condicion.selectedIndex];
				var Mostrar2 = selectedOption2.text == 'Todos' ? 1000000 : selectedOption2.text;
				$('#tbody_cacceso').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:Mostrar2});
			});*/
			//		
			$(document).ready(function(){
				$('#panel_CEdad').hide(); //muestro mediante id
				$('#panel_CEstatura').hide();
                 
                cargar_datos_disponibilidad();

				$('#servicio_adicional_select').on('change', function (){
			        console.log('pulso');
			        var id = $("#idTipoBoleta_SA").val();
			        cargar_datos_bs(id);
			    });	
							
			});
			 
			
			//
			$('#btnAgregar').click(function(){
				//Toma el archivo elegido por el input 
				   
				var tipo_boleta         = $("#select_tipo_boleta").val();
				var fecha_desde         = $("#fecha_desde").val();
				var fecha_hasta         = $("#fecha_hasta").val();
				var cantidad            = $("#cantidad").val();  

                if(tipo_boleta!='' && fecha_desde!='' && fecha_hasta!='' && cantidad>0 ){
                    guardarDisponibilidad(tipo_boleta,fecha_desde,fecha_hasta,cantidad);
                }
					
			});
			//
			 
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

			 


				$('#btnActualizarDisponibilidad').click(function(){
				 	
					 var id = $("#txtupIdDisponibilidad").val();
					  
					 var cantidadMax =$("#cantMaximaUpd").val();	
					 //
					 if(id!='' && cantidadMax!=''){
						  
							 actualizarDisponibilidad(id,cantidadMax);
								 
					 }else{
						 
						 console.log("nombre_a:"+nombre_a+" , edadMinima_a:"+edadMinima_a+" , edadMaxima_a:"+edadMaxima_a)
	 
						 alert('Llene todos los campos, para actualizar');
					 }		
				 });


				 $('#cant_reg_disponibilidad').change(function(){
				 	
					var tipoBoleta = $("#select_tipo_boleta2").val();
					var fecha_desde = $("#fecha_desde2").val();
					var fecha_hasta = $("#fecha_hasta2").val();
					var cant_reg_disponibilidad=$("#cant_reg_disponibilidad").val();
					var page=1;
					if(  fecha_desde!='' && fecha_hasta!='' && cant_reg_disponibilidad!=''){
						
						
							buscarDisponibilidades(fecha_desde,fecha_hasta,tipoBoleta,cant_reg_disponibilidad,page);
							
					}else{
						alert('Por favor complete todos los campos!');
					}		
				 });


				 $('#irPagina').click(function(){
				 	
					 var tipoBoleta = $("#select_tipo_boleta2").val();
					 var fecha_desde = $("#fecha_desde2").val();
					 var fecha_hasta = $("#fecha_hasta2").val();
					 var cant_reg_disponibilidad=$("#cant_reg_disponibilidad").val();
					 var page= $("#input_pag").val() ;
					 //alert("page:"+page);
					 //return(false);
					 if(  fecha_desde!='' && fecha_hasta!='' && cant_reg_disponibilidad!=''){
						 
						 
							 buscarDisponibilidades(fecha_desde,fecha_hasta,tipoBoleta,cant_reg_disponibilidad,page);
							 
					 }else{
						 alert('Por favor complete todos los campos!');
					 }		
				  });



            $('#btnBuscar').click(function(){
				//Toma el archivo elegido por el input 
				     
				var tipoBoleta = $("#select_tipo_boleta2").val();
				var fecha_desde = $("#fecha_desde2").val();
				var fecha_hasta = $("#fecha_hasta2").val();

				if(  fecha_desde!='' && fecha_hasta!=''){
					 
					
						buscarDisponibilidades(fecha_desde,fecha_hasta,tipoBoleta);
					 	
				}else{
					alert('Por favor complete todos los campos!');
				}		
			});
 		
		</script>	
 
  	</body>
</html>