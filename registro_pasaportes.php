<?php
session_start();
include('php/sesion.php');
$edad_adulto=$_SESSION['edad_adulto'];
#echo " edad adulto: $edad_adulto";
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
    <title>Taquilla</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">

	<style>
		.centrado {
			margin: auto;
			
			text-align: center;
			padding: 0px !important;
		}

		.derecha {
			margin: auto;
			
			text-align: right;
			padding: 0px !important;
		}

		.cmn-divfloat {
			position: fixed !important;
			bottom: 45px;
			right: 15px;
			display: none;
		}
		.cmn-btncircle {
			width: 40px !important;
			height: 40px !important;
			padding: 6px 0px;
			border-radius: 15px;
			font-size: 18px;
			text-align: center;
		}

		.eye{
			
			z-index: 1;
			position: absolute;
			left:80%;
		}

		.txttab { color: #097BDC; }

		.heaven{
			
			
			z-index: 300;
		}

        .caja_inline {
            display: inline-block;
            width: 100px;
        }

		.selectAltura {
			display:block;
			height:30px;
			width:200px!important;
			padding: 0.1em!important;
			color:#707070 ;	
		}

		.tipo_pago_check{
			background:#FFFFFF; 
			border: #D4D4D4 solid 1px; 
			border-radius: 10px;
		}

        .pointer {
			cursor: pointer;
		}
	

		

	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
	<script src="js/funciones.js"></script>

	<script src="js/views/registro.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>
	<script>

	var modal = document.getElementById("myModal");
	var btn = document.getElementsByClassName("btnModal");
	var span = document.getElementsByClassName("close")[0];
	var body = document.getElementsByTagName("body")[0];

		

	$(document).on("click", ".check", function(){
        
		 
		$("#miModal").modal("show");

		var idboleta=$(this).attr('idboleta');

		var info_boletas= JSON.parse( localStorage.getItem('boletas_nombres'));

		console.log(info_boletas);

		var str_remp='';

		info_boletas.forEach(function(datos, index) { 


			console.log(datos);
			if(idboleta== datos['id'] ){
				console.log("Encontre la boleta"+datos['id']);

				str_remp=str_remp+' <div class="centrado" ><h2>'+datos['nombre']+'</h2></div>	<table class="table-bordered" >	<tr> <td > <h3>Precio:  </h3> </td> <td colspan="2" class="centrado" > <h4>$'+datos['precio'].toLocaleString() +'</h4></td> </tr> <tr> <td > <h3>Descripcion:  </h3> </td> <td colspan="2" class="centrado" > <h4>'+datos['descripcion']+'</h4></td> </tr> <tr> <td > <h3> Categoria Edad:  </h3> </td> <td colspan="2" class="centrado" > <h4> De '+datos['categoriaEdad']['edadInicial']+' a '+datos['categoriaEdad']['edadFinal']+' a??os</h4></td> </tr> </table><br><br> <div  ><h2> Atracciones </h2></div> <table class="table-bordered"> ';
				
				datos['atracciones'].forEach(function(datos2, index2) {

					str_remp=str_remp+' <tr> <td colspan="2"> '+datos2['nombre']+'</td> <td> <img src="http://20.44.111.223/api/contenido/imagen/' + datos2['imagenId'] + '" width="100" height="100" style="border-radius:10px;" class=" " alt=""> </td> </tr> ';
					
				});
				
				str_remp=str_remp+'</table> ';

			}

		});

		$("#contenidoModal").html(str_remp)

	 });


	 $(document).on("click", "#close", function(){


		$("#idreservaR").val("");
		$("#idboletaR").val("");
		$("#nombreR").val("");
		$("#apellidoR").val("");
		$("#tipo_documentoR").val("");
		$("#numero_documentoR").val("");
		$("#fecha_nacimientoR").val("");
        $("#alturaR").val('');
		$("#miModal").modal("hide");
  
	 });

	 $(document).on("click", "#close2", function(){

		$("#miModal2").modal("hide");

	});

	 
	 $(document).on("click", ".agregar", function(){
        
		let idreserva=$(this).attr('idreserva');
		let idboleta =$(this).attr('idboleta');
		let edadInicial=$(this).attr('edadInicial');
		let edadFinal=$(this).attr('edadFinal');
		let estaturaCmMin=$(this).attr('estaturaCmMin');
		let estaturaCmMax=$(this).attr('estaturaCmMax');
		let casillas_disponibles=$(this).attr('casillas_disponibles');
		let pasaporteNombre=$(this).attr('pasaporteNombre');
		let edadMayoria='<?=$edad_adulto?>';
		let identificacion=$(this).attr('identificacioncliente');
 

		$("#PasaporteN").html(pasaporteNombre);
		$("#idreservaR").val(idreserva);
		$("#idboletaR").val(idboleta);
		$("#edadInicialR").val(edadInicial);
		$("#edadFinalR").val(edadFinal);
		$("#estaturaCmMinR").val(estaturaCmMin)
		$("#estaturaCmMaxR").val(estaturaCmMax)
		$("#casillas_disponiblesR").val(casillas_disponibles)
		$("#edadMayoriaR").val(edadMayoria)
		 
		//alert("idreserva:"+idreserva+" , idboleta:"+idboleta);
		$("#miModal").modal("show");

		if( parseInt(edadInicial)>= parseInt(edadMayoria) ){

			validarCompradorRegistro(idreserva,identificacion);
			 
			//alert("puedes ingresar los mismos datos del comprador");
			
		}else{
			$("#div_datos_comprador").hide();
		}

		console.log("casillas_disponibles:"+casillas_disponibles)

		if(casillas_disponibles!=''){

			var array_casillas_disponibles= casillas_disponibles.split(',');

			console.log("array_casillas:")
			console.log(array_casillas_disponibles)

			if(array_casillas_disponibles.length>0){
				
				
				$("#div_lockers").show();
			
			
			
			}else{
				console.log("No tiene casillas por asignar");
			}

		}

		


		

	 });


	 $(document).on("click", ".verVisitante", function(){
        var idreserva=$(this).attr('idreserva');
		var idboleta =$(this).attr('idboleta');
		var pasaporteNombre=$(this).attr('pasaporteNombre');

		$("#idreservaV").val(idreserva);
		$("#idboletaV").val(idboleta);
		$("#PasaporteV").html(pasaporteNombre);
		$("#miModal2").modal("show");
		visitante();

		

	 });


	$(document).on("click", ".regresar", function(){
		window.location.href="inicio_pca2.php";
	});

	$(document).on("click", "#imprimirBoleta", function(){

		let idreserva=$("#idreservaV").val();
		let idboleta=$("#idboletaV").val();
		let nombre=$("#nombreV").val();
		let apellido=$("#apellidoV").val();

		let url_pdf="exportar/reserva/reserva_boleta_pdf.php";

		window.open(url_pdf+'?idreserva='+idreserva+'&idboleta='+idboleta+'&nombre='+nombre+'&apellido='+apellido,  '_blank');

	});



	$(document).on("blur", "#fecha_nacimientoR", function(){

		var fecha_nacimiento=$(this).val()
		var edadInicial=$("#edadInicialR").val();
		var edadFinal=$("#edadFinalR").val();

	//	alert("edadInicial:"+edadInicial+" , edadFinal:"+edadFinal+" , fecha_nacimiento:"+fecha_nacimiento)
		validar_fecha(edadInicial,edadFinal,fecha_nacimiento)
	});


	$(document).on("blur", "#alturaR", function(){

		var altura=$(this).val()
		var estaturaCmMin=$("#estaturaCmMinR").val();
		var estaturaCmMax=$("#estaturaCmMaxR").val();

		console.log("altura:"+altura+" , estaturaCmMin:"+estaturaCmMin+" , estaturaCmMax:"+estaturaCmMax)

		//alert("edadInicial:"+edadInicial+" , edadFinal:"+edadFinal+" , fecha_nacimiento:"+fecha_nacimiento)
		validar_estatura(altura,estaturaCmMin,estaturaCmMax)
	});

	 


	$('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

	

	$(document).on("click", "#agregarDatosComprador", function(){
		if( $('#agregarDatosComprador').prop('checked') ) {
			asignarCompradorRegistro();
		}else{
			$("#nombreR").val('')
			$("#apellidoR").val('')
			$("#tipo_documentoR").val('')
			$("#numero_documentoR").val('')
		}
	});

	$(document).on("click", "#restablecer", function(){
		localStorage.clear();
		location.reload();
	});


	window.onload = function () {


	localStorage.clear();


	$("#contenido_taquilla").show();

	}

	</script>
  </head>
  <body>
  	

	<header>
		<nav class="color-cabezera container-fluid">
		   <div class="row justify-content-between">
			   
			   <div class="col-lg-1 col-3 d-flex align-items-center">
				   <figure class="pt-3">
					<img src="imagenes/LOGO_BLANCO.png" class="img-fluid">
				   </figure>
			   </div>
			   <div class="d-flex justify-content-start">
				   <div class="px-2 pt-3 ">

				   <select class="selectAltura" id="tipo_documento" >
					   <option value="">Tipo de Documento</option>
					   <option value="CC" >C??dula Ciudadan??a</option>
					   <option value="CE">C??dula Extranjer??a</option>
					   <option value="PAS">Pasaporte</option>
				   </select>
					   
				   
				
				</div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="numero_documento" placeholder="N??mero de Documento" style="height: 30px;"></div>
				   
				   <div class="px-2 pt-3 "><input type="button" onclick="consultar_reserva();" class="boton_campo" style="width: 100%" value="CONSULTAR" id="pagar"></div>
			   </div>
			   <div class="d-flex align-items-center justify-content-end">
				   <div style="background: #012E4B" class="py-3 px-2"><img src="imagenes/back.svg" alt=""/></div>
			 </div>
		   </div>
	   </nav> 
	</header>
	 
	 <main>
		<div class="container"> 
			<div class="row w-100 align-items-center">
			  <div class="col text-center">
				
	  
				<div id="fecha" class=""> </div>
	  
			  </div>	
			</div>
		
		
		  </div>
		 <section class="container-fluid pl-lg-0" id="contenido_taquilla" style="display:none;">
		 	<div class="row d-flex hide" >

				<div class="col-lg-1 order-last order-lg-first d-flex flex-column">
					<figure class="sub-menues mb-3 mt-2 regresar"   style="background-color:#0A4970;cursor:pointer;"><img src="imagenes/Imagen-7.png"></figure>
					<div class="panel1 sombra">
						<div class="row">
							<div class="col-6 col-lg-12">
								<div class="row">
									<div class="col-3 col-lg-12 text-center">
									<div class="c-verde mb-1">CL</div>
						<P class="mb-3 d-none d-lg-block">Clientes</P>
								</div>
								
								
								
								</div>
							</div>
							
						</div>
					
					</div>
				</div>
			 	 
				<div class="col-lg-10 pt-2 d-flex">
				  <div class="panel3 sombra">

				  	<div class="pr-2 derecha" > <a id="restablecer" href="#">Restablecer</a> </div>
                    
                    <div class=" pr-2 centrado" id="div_cliente" ><h1>Consultar Reserva Boletas </h1></div>
                        
                    
                        
                    <div class=" pr-2 centrado" id="div_fecha_reserva"> </div>

					<div class=" pr-2 centrado" id="div_instrucciones"> </div>
				  	
				   
					  <div class="row no-gutters pt-3" id="boletas">

					  
					  	
                      <!-- <div class=" pr-2 " ><h2>Idreserva: s2d4f4-4rfd45-y7ju8j</h2></div><br>

                        <div class="sombra2 panel3_2 boleta-add" idboleta="1" style="margin-top: 12px;" >         
                             
                                <div class="pt-3 d-flex   pr-2 " style="justify-content: space-between"> 
                                    <img src="http://20.44.111.223/api/contenido/imagen/d911ecda-32dd-45b6-8939-f4d677e510af" width="120" height="90" style="border-radius:10px;"  alt=""> 
                                    <div class="p-2 centrado"> 
                                        <h2 class="pt-2">Pase Full Access Adulto</h2> 
                                    </div>
                                    <div class="p-2 centrado">
                                            <h2>$100.000</h2>
                                    </div> 
                                    <div class="p-2 centrado">   
                                    <img src="imagenes/chulito.jpg" class="centrado pointer" width="50" height="50" style="border-radius:10px;"  alt=""> 
                                    </div>  
                                </div> 
                            
                                 
                        </div><br><br><br>

                        <div class="sombra2 panel3_2 boleta-add" idboleta="1" style="margin-top: 12px;">         
                             
                                <div class="pt-3 d-flex   pr-2 " style="justify-content: space-between"> 
                                    <img src="http://20.44.111.223/api/contenido/imagen/d911ecda-32dd-45b6-8939-f4d677e510af" width="120" height="90" style="border-radius:10px;"  alt=""> 
                                    <div class="p-2 centrado"> 
                                        <h2 class="pt-2">Pase Full Access Adulto</h2> 
                                    </div>
                                    <div class="p-2 centrado">
                                            <h2>$100.000</h2>
                                    </div> 
                                    <div class="p-2 centrado">   
                                    <img src="imagenes/agregar.jpg" class="centrado pointer" width="70" height="70" style="border-radius:10px;"  alt=""> 
                                    </div>  
                                </div> 
                            
                                 
                        </div> -->
						    
					  </div>
					  
				   </div>		  
				</div>
				
			 </div>

			<div id="miModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Contenido del modal -->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" id="contenidoModal">
						
					<form>

					<div class="form-group" >
						<h2 id="PasaporteN"></h2>
					</div>

					<div class="form-group " id="div_datos_comprador" style="display:none">
						<label for="numero_documento" id="label_lockers">Mismos datos del comprador?</label>
						<input type="checkbox" class="" id="agregarDatosComprador" >
						
					</div>

					<div class="form-group">
						<label for="nombreR">Nombres:*</label>
						<input type="email" class="form-control" id="nombreR" aria-describedby="emailHelp" placeholder="Nombres">
						
					</div>
					<div class="form-group">
						<label for="apellidoR">Apellidos:*</label>
						<input type="email" class="form-control" id="apellidoR" aria-describedby="emailHelp" placeholder="Apellidos">
						
					</div>

					<div class="form-group">
						<label for="fecha_nacimiento">Fecha Nacimiento:*</label>
						<input type="date" id="fecha_nacimientoR" class="form-control" name="trip-start"  min="1920-01-01" >
						<small id="alertaFechaNacimiento" class="form-text text-muted"></small>	
					</div>
					<div class="form-group">
						<label for="apellidoR">Estatura:</label>
						<input type="number"  class="form-control solo-numero" id="alturaR" aria-describedby="emailHelp" placeholder="Estatura (cm ej:150)">

						<small id="alertaEstatura" class="form-text text-muted"></small>	
						
					</div>

					<div class="form-group">
						<label for="tipo_documento">Tipo Documento</label>
						<select class="selectAltura" id="tipo_documentoR" >
							<option value="">Tipo de Documento</option>
							<option value="CC" >Cedula Ciudadania</option>
							<option value="CE">Cedula Estranjeria</option>
							<option value="PAS">Pasaporte</option>
							<option value="TI">Tarjeta de Identidad</option>
						</select>
						
					</div>

					<div class="form-group">
						<label for="numero_documento">N??mero Documento:</label>
						<input type="email" class="form-control" id="numero_documentoR" aria-describedby="emailHelp" placeholder="N??mero documento">
						
					</div>


					<div class="form-group " id="div_lockers" style="display:none">
						<label for="numero_documento" id="label_lockers">Asignar locker:</label>
						<input type="checkbox" class="" id="agregarLockerR" >
						
					</div>


					

					

					<input type="hidden" id="idreservaR" value="">
					<input type="hidden" id="idboletaR" value="">
					<input type="hidden" id="edadInicialR" value="">
					<input type="hidden" id="edadFinalR" value="">
					<input type="hidden" id="estaturaCmMinR" value="">
					<input type="hidden" id="estaturaCmMaxR" value="">
					<input type="hidden" id="casillas_disponiblesR" value="">
					<input type="hidden" id="edadMayoriaR" value="">

					<input type="button" onclick="registrarBoleta();" class="boton_campo" style="width: 100%" value="REGISTRAR" id="registrar">
					</form>

						
					</div>
					
					</div>
				</div>
			</div>


			<div id="miModal2" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Contenido del modal -->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="close2" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" id="contenidoModal">
						
					<form>
					<div class="form-group">
						<h2 id="PasaporteV"></h2>
					</div>
					<div class="form-group" >
						<input type="button"   class="boton_campo30"  value="IMPRIMIR BOLETA" id="imprimirBoleta">
					</div>
					<div class="form-group">
						<label for="nombreR">Nombres:*</label>
						<input type="email" class="form-control" id="nombreV" aria-describedby="emailHelp" placeholder="Nombres">
						
					</div>
					<div class="form-group">
						<label for="apellidoV"*>Apellidos:</label>
						<input type="email" class="form-control" id="apellidoV" aria-describedby="emailHelp" placeholder="Apellidos">
						
					</div>
					<div class="form-group">
						<label for="tipo_documentoV">Tipo Documento</label>
						<select class="selectAltura" id="tipo_documentoV" >
							<option value="">Tipo de Documento</option>
							<option value="CC" >Cedula Ciudadania</option>
							<option value="CE">Cedula Estranjeria</option>
							<option value="PAS">Pasaporte</option>
							<option value="TI">Tarjeta de Identidad</option>
						</select>
						
					</div>

					<div class="form-group">
						<label for="numero_documentoV">Numero Documento:</label>
						<input type="email" class="form-control" id="numero_documentoV" aria-describedby="emailHelp" placeholder="Numero documento">
						
					</div>

					<div class="form-group">
						<label for="fecha_nacimientoV">Fecha Nacimiento:*</label>
					<input type="email" id="fecha_nacimientoV" class="form-control"  >
					</div>

					<div class="form-group">
						<label for="apellidoV">Estatura CM:</label>
						<input type="number"  class="form-control solo-numero" id="alturaV" aria-describedby="emailHelp" placeholder="altura (cm ej:150)">
						
					</div>

					<div class="form-group" id="divCasillaAsignada" style="display:none">
						<label for="" id="CasillaAsignada"></label>
						 
					</div>

					<input type="hidden" id="idreservaV" value="">
					<input type="hidden" id="idboletaV" value="">

					
					<!-- <input type="button" onclick="registrarBoleta();" class="boton_campo" style="width: 100%" value="REGISTRAR" id="registrar"> -->
					</form>

						
					</div>
					
					</div>
				</div>
			</div>
		 </section>
	  </main>
	   

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>