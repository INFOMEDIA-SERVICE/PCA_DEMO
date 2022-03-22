<?php
session_start();
include('php/sesion.php');
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
			width: 100%;
			text-align: center;
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
	

		

	</style>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
	<script src="js/funciones.js"></script>

	<script src="js/views/taquilla.js"></script>

	<script>

	var modal = document.getElementById("myModal");
	var btn = document.getElementsByClassName("btnModal");
	var span = document.getElementsByClassName("close")[0];
	var body = document.getElementsByTagName("body")[0];

		function recalcular_cambio(){
			/* calculo el cambio */
		var sum_ef=$("#suma_efectivo").attr('acumulado');
		var sum_ta=$("#suma_tarjeta").attr('acumulado');

		var valor_total_suma= parseInt(sum_ef)+parseInt(sum_ta);

		var sumatoria_productos=$("#sumatoria_total").attr('val_sum');

		var cambio= parseFloat(valor_total_suma)-parseFloat(sumatoria_productos);
		

		if(cambio==0){

			$("#cambio").html('<h2>Cambio: <span class="badge bg-success">$'+cambio.toLocaleString()+'</span></h2>')

		}else if(cambio>0){

			$("#cambio").html('<h2>Cambio: <span class="badge bg-danger">$'+cambio.toLocaleString()+'</span></h2>')

		}else if (cambio<0){

			$("#cambio").html('<h2>Cambio: <span class="badge bg-light text-dark">$'+cambio.toLocaleString()+'</span></h2>')

		}

		
		}

	$(document).on("click", ".informacion", function(){
        
		 
		$("#miModal").modal("show");

		var idboleta=$(this).attr('idboleta');

		var info_boletas= JSON.parse( localStorage.getItem('boletas_nombres'));

		console.log(info_boletas);

		var str_remp='';

		info_boletas.forEach(function(datos, index) { 


			console.log(datos);
			if(idboleta== datos['id'] ){
				console.log("Encontre la boleta"+datos['id']);

				str_remp=str_remp+' <div class="centrado" ><h2>'+datos['nombre']+'</h2></div>	<table class="table-bordered" >	<tr> <td > <h3>Precio:  </h3> </td> <td colspan="2" class="centrado" > <h4>$'+datos['precio'].toLocaleString() +'</h4></td> </tr> <tr> <td > <h3>Descripcion:  </h3> </td> <td colspan="2" class="centrado" > <h4>'+datos['descripcion']+'</h4></td> </tr> <tr> <td > <h3> Categoria Edad:  </h3> </td> <td colspan="2" class="centrado" > <h4> De '+datos['categoriaEdad']['edadInicial']+' a '+datos['categoriaEdad']['edadFinal']+' años</h4></td> </tr> </table><br><br> <div  ><h2> Atracciones </h2></div> <table class="table-bordered"> ';
				
				datos['atracciones'].forEach(function(datos2, index2) {

					str_remp=str_remp+' <tr> <td colspan="2"> '+datos2['nombre']+'</td> <td> <img src="http://20.44.111.223/api/contenido/imagen/' + datos2['imagenId'] + '" width="100" height="100" style="border-radius:10px;" class=" " alt=""> </td> </tr> ';
					
				});
				
				str_remp=str_remp+'</table> ';

			}

		});

		$("#contenidoModal").html(str_remp)

	 });


	 $(document).on("click", ".close", function(){
        
		$("#miModal").modal("hide");
  
	 });

	 $(document).on("keyup", "#filtrarBoletas", function(){

		var filtro = $("#filtrarBoletas").val();
        
		$(".active").each(function(index) {
			
			var tipo = $(this).attr('tipo');
			
			if(tipo=='boletas'){
				cargar_datos_taquilla(filtro);
			}else if(tipo=='adicionales'){
				console.log("Entro a los adicionales!!")
				cargar_adicionales(filtro)
			}
		});

	 });


	 $(document).on("click", ".eliminar_boleta", function(){
        
		var boletas_nombres=JSON.parse( localStorage.getItem('boletas_nombres'));

		var idboletaB=$(this).attr('id');

		let new_array=[];

		var nuevo_valor=0;

		$.each(boletas_nombres, function(index, datos) {

			if(datos['id']==idboletaB){

				datos['cant_taquilla']-=1;
				nuevo_valor=datos['cant_taquilla'];

			}

			let nuevaLongitud = new_array.push(datos)

		});

		localStorage.setItem("boletas_nombres",JSON.stringify(new_array));

		var sumatoria_total=$("#sumatoria_total").attr('val_sum')

		var sumatoria_pro= $(this).attr('sumatoria_producto');

		var restar= $(this).attr('precio_unidad')

		var valor_nuevo= parseInt(sumatoria_total)-parseInt(restar)

		var valor_nuevo_producto= parseInt(sumatoria_pro)-parseInt(restar)

		

		$(this).attr('sumatoria_producto',valor_nuevo_producto)
		$("#sumatoria_total").attr('val_sum', valor_nuevo )
		$("#sumatoria_total").html('$'+ valor_nuevo.toLocaleString() )

		var info_boletas= JSON.parse( localStorage.getItem('boletas_nombres'));

		var cantidad_actual=$(this).attr('cantidad');

		var cantidad_nueva = parseInt(cantidad_actual)-1;

		$.each(info_boletas, function(index, datos) {

			

			if(datos['id']== idboletaB ){

				var precioB=datos['precio'];

				$("#unidad_producto_"+datos['tipo_producto']+'_'+idboletaB).html(''+cantidad_nueva+' Unidad / $'+precioB.toLocaleString()+' / Units')

				$("#sumatoria_producto_"+datos['tipo_producto']+'_'+idboletaB).html('$'+valor_nuevo_producto.toLocaleString());

				recalcular_cambio();

				if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
				}
			}

		});

		$(this).attr('cantidad',cantidad_nueva)

		if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
		}
		 
  
	 });


	 $(document).on("click", ".eliminar_adicional", function(){
        
		var adicionales_nombres=JSON.parse( localStorage.getItem('adicionales_nombres'));

		var idadicionalB=$(this).attr('id');

		let new_array=[];

		var nuevo_valor=0;

		$.each(adicionales_nombres, function(index, datos) {

			if(datos['id']==idadicionalB){

				datos['cant_taquilla']-=1;
				nuevo_valor=datos['cant_taquilla'];

			}

			let nuevaLongitud = new_array.push(datos)

		});

		localStorage.setItem("adicionales_nombres",JSON.stringify(new_array));

		var sumatoria_total=$("#sumatoria_total").attr('val_sum')

		var sumatoria_pro= $(this).attr('sumatoria_producto');

		var restar= $(this).attr('precio_unidad')


		var valor_nuevo= parseInt(sumatoria_total)-parseInt(restar)

		var valor_nuevo_producto= parseInt(sumatoria_pro)-parseInt(restar)

		$(this).attr('sumatoria_producto',valor_nuevo_producto)

		$("#sumatoria_total").attr('val_sum', valor_nuevo )
		$("#sumatoria_total").html('$'+ valor_nuevo.toLocaleString() )


		var info_boletas= JSON.parse( localStorage.getItem('adicionales_nombres'));

		var cantidad_actual=$(this).attr('cantidad');

		var cantidad_nueva = parseInt(cantidad_actual)-1;

		$.each(info_boletas, function(index, datos) {

			if(datos['id']== idadicionalB ){

				var precioB=datos['precio'];

				$("#unidad_producto_"+datos['tipo_producto']+'_'+idadicionalB).html(''+cantidad_nueva+' Unidad / $'+precioB.toLocaleString()+' / Units')

				$("#sumatoria_producto_"+datos['tipo_producto']+'_'+idadicionalB).html('$'+valor_nuevo_producto.toLocaleString());

				recalcular_cambio();

				if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
				}
			}

		});

		$(this).attr('cantidad',cantidad_nueva)	

		if(nuevo_valor==0){
					$(this).parent().parent().parent().parent().remove();
		}
		
		 
  
	 });







$(document).on("click", ".boleta-add", function(){

		var arr_recorrer= JSON.parse( localStorage.getItem('boletas_nombres'));
		var indice=$(this).attr("idboleta")
		let new_array=[];

		$.each(arr_recorrer, function(index, datos) {
		   //console.log(datos)
 
		   	if(datos['id']==indice){
			   //console.log("Encontre la boleta"+datos['id'])
			   datos['cant_taquilla']+=1;	
			}
 
			 let nuevaLongitud = new_array.push(datos)
			 
		 });

		 localStorage.setItem("boletas_nombres",JSON.stringify(new_array));

		 var arr_pintar= JSON.parse( localStorage.getItem('boletas_nombres'));

		 var arr_pintarAdd= JSON.parse( localStorage.getItem('adicionales_nombres'));

		 var long_val=0;

		 var pinta_adicionales=1;

		 if(arr_pintarAdd==null){
			pinta_adicionales=0;
		 }else{
			long_val=arr_pintarAdd.length;
		 }

		 

		 var validacion=0;

		 if(long_val>0){

		 }else{
			 validacion=1;
		 }

		 var str_div='';
		 var sumatoria=0;
		 var sumatoria_sub=0;
		 var cont=1;

		 var long=arr_pintar.length;

		 $.each(arr_pintar, function(index, datos) {

			if(datos['cant_taquilla']>0){

				sumatoria+=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
				sumatoria_sub=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])

			 	str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datos['nombre']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;" id="unidad_producto_'+datos['tipo_producto']+'_'+datos['id']+'">'+datos['cant_taquilla']+' Unidad / $'+datos['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" id="'+datos['id']+'" tipo_producto="'+datos['tipo_producto']+'"  class="eliminar_boleta" precio_unidad="'+datos['precio']+'" sumatoria_producto="'+sumatoria_sub+'" id="'+datos['id']+'" cantidad="'+datos['cant_taquilla']+'" style="cursor:pointer" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right" id="sumatoria_producto_'+datos['tipo_producto']+'_'+datos['id']+'">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>';

			}


			if(cont==long && validacion==1){

				str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;" id="sumatoria_total" val_sum="'+sumatoria+'"  >$'+sumatoria.toLocaleString()+'</div></div>'

			}

			cont++;

		 });

		 if(pinta_adicionales==1){

			cont=1;

		long=arr_pintarAdd.length;



		 $.each(arr_pintarAdd, function(index, datos) {

			if(datos['cant_taquilla']>0){

				sumatoria+=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
				sumatoria_sub=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
				str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datos['nombre']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;" id="unidad_producto_'+datos['tipo_producto']+'_'+datos['id']+'">'+datos['cant_taquilla']+' Unidad / $'+datos['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" id="'+datos['id']+'" tipo_producto="'+datos['tipo_producto']+'"  class="eliminar_adicional" precio_unidad="'+datos['precio']+'" sumatoria_producto="'+sumatoria_sub+'" id="'+datos['id']+'" cantidad="'+datos['cant_taquilla']+'" style="cursor:pointer" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right" id="sumatoria_producto_'+datos['tipo_producto']+'_'+datos['id']+'">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>';

			}

			if(cont==long){
				str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;" id="sumatoria_total" val_sum="'+sumatoria+'"  >$'+sumatoria.toLocaleString()+'</div></div>'
			}

			cont++;

		});

		 }
 
		$("#div_productos").html(str_div)
 
		recalcular_cambio();
 
		
 });


 $(document).on("click", ".adicional-add", function(){

var arr_recorrer= JSON.parse( localStorage.getItem('adicionales_nombres'));
var indice=$(this).attr("idadicional")
let new_array=[];

$.each(arr_recorrer, function(index, datos) {

	   if(datos['id']==indice){
	   datos['cant_taquilla']+=1;	
	}

	 let nuevaLongitud = new_array.push(datos)
	 
 });

 localStorage.setItem("adicionales_nombres",JSON.stringify(new_array));






 var arr_pintar= JSON.parse( localStorage.getItem('boletas_nombres'));

 var arr_pintarAdd= JSON.parse( localStorage.getItem('adicionales_nombres'));

	var long_val=arr_pintarAdd.length;

	var validacion=0;

	if(long_val>0){

	}else{
		validacion=1;
	}

		 var str_div='';
		 var sumatoria=0;
		 var sumatoria_sub=0;
		 var cont=1;

		 var long=arr_pintar.length;

		 console.log("long: "+long)

		 $.each(arr_pintar, function(index, datos) {

			if(datos['cant_taquilla']>0){

				sumatoria+=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
				sumatoria_sub=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])

			 	str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datos['nombre']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;" id="unidad_producto_'+datos['tipo_producto']+'_'+datos['id']+'">'+datos['cant_taquilla']+' Unidad / $'+datos['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" id="'+datos['id']+'" tipo_producto="'+datos['tipo_producto']+'"  class="eliminar_boleta" precio_unidad="'+datos['precio']+'" sumatoria_producto="'+sumatoria_sub+'" id="'+datos['id']+'" cantidad="'+datos['cant_taquilla']+'" style="cursor:pointer" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right" id="sumatoria_producto_'+datos['tipo_producto']+'_'+datos['id']+'">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>';

			}


			if(cont==long && validacion==1){

				str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;" id="sumatoria_total" val_sum="'+sumatoria+'"  >$'+sumatoria.toLocaleString()+'</div></div>'

			}

			cont++;

		 });

 cont=1;

 long=arr_pintarAdd.length;


 $.each(arr_pintarAdd, function(index, datos) {

	if(datos['cant_taquilla']>0){

		sumatoria+=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])
		sumatoria_sub=parseFloat(datos['cant_taquilla'])*parseFloat(datos['precio'])

		 str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datos['nombre']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;" id="unidad_producto_'+datos['tipo_producto']+'_'+datos['id']+'">'+datos['cant_taquilla']+' Unidad / $'+datos['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" id="'+datos['id']+'" tipo_producto="'+datos['tipo_producto']+'"  class="eliminar_adicional" precio_unidad="'+datos['precio']+'" sumatoria_producto="'+sumatoria_sub+'" id="'+datos['id']+'" cantidad="'+datos['cant_taquilla']+'" style="cursor:pointer" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right" id="sumatoria_producto_'+datos['tipo_producto']+'_'+datos['id']+'">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>';

	}


	if(cont==long){

		str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;" id="sumatoria_total" val_sum="'+sumatoria+'"  >$'+sumatoria.toLocaleString()+'</div></div>'

	}

	cont++;

 });


$("#div_productos").html(str_div)

recalcular_cambio();


});

	$(document).on("click", ".regresar", function(){
		window.location.href="inicio_pca2.php";
	});

	$(document).on("click", ".borrar_num", function(){
		if( $("#div_efectivo").hasClass('tipo_pago_check')  ){

			var acumulado=$("#suma_efectivo").attr('acumulado');

			console.log('acumulado_antes:'+acumulado)

			var str2 = acumulado.substring(0, acumulado.length - 1);

			if(str2==''){
				console.log("llego al cero!!!!!")
				str2=0;
			}

			console.log('acumulado_despues:'+str2)

			$("#suma_efectivo").attr('acumulado',str2);

			$("#suma_efectivo").html('$'+str2.toLocaleString());

		}else if( $("#div_tarjeta").hasClass('tipo_pago_check')){

			var acumulado=$("#suma_tarjeta").attr('acumulado');

			console.log('acumulado_antes:'+acumulado)

			var str2 = acumulado.substring(0, acumulado.length - 1);

			if(str2==''){
				console.log("llego al cero!!!!!")
				str2=0;
			}

			console.log('acumulado_despues:'+str2)

			$("#suma_tarjeta").attr('acumulado',str2);

			$("#suma_tarjeta").html('$'+str2.toLocaleString());

		}

		recalcular_cambio();

	});

	$(document).on("click", ".numeros", function(){

		if( $("#div_efectivo").hasClass('tipo_pago_check')  ){

			var acumulado=$("#suma_efectivo").attr('acumulado');

			var new_acumulado='';

			if(acumulado=='0'){
				 new_acumulado = $(this).attr('id');
			}else{
				 new_acumulado=acumulado+''+$(this).attr('id');
			}

			new_acumulado=parseInt(new_acumulado)

			if(new_acumulado<0){
				new_acumulado=0;
			}

			$("#suma_efectivo").html('$'+ new_acumulado.toLocaleString() );
			$("#suma_efectivo").attr('acumulado', new_acumulado)



		}else if( $("#div_tarjeta").hasClass('tipo_pago_check')){


			var acumulado=$("#suma_tarjeta").attr('acumulado');

			var new_acumulado='';

			if(acumulado=='0'){
				 new_acumulado = $(this).attr('id');
			}else{
				 new_acumulado=acumulado+''+$(this).attr('id');
			}

			new_acumulado=parseInt(new_acumulado)

			if(new_acumulado<0){
				new_acumulado=0;
			}

			$("#suma_tarjeta").html('$'+ new_acumulado.toLocaleString() );
			$("#suma_tarjeta").attr('acumulado', new_acumulado)




		} else{
			alert("No selecciono ninguna")
		}


		recalcular_cambio()

		var num=$(this).attr('id');
	});

	$(document).on("click", "#restablecer", function(){
		localStorage.clear();
		location.reload();
	});

	$(document).on("click", ".tabbla", function(){
		
		$("#filtrarBoletas").val('')
		var id=$(this).attr('id');
		var tipo=$(this).attr('tipo');

		if(id=='tabboletas'){

			if( $(this).hasClass("pes-act-inv") ){
				$(this).removeClass( "pes-act-inv" )
				$(this).addClass('active pes-act')
				$("#tabadicionales").removeClass("active pes-act")
				$("#tabadicionales").addClass( "pes-act-inv" )

				$("#ntab_adicionales").removeClass("txttab");
				$("#ntab_boletas").addClass("txttab");

				cargar_datos_taquilla();
			}

		}else if(id=='tabadicionales') {

			if( $(this).hasClass("pes-act-inv") ){
				//click inicio
				$(this).removeClass( "pes-act-inv" )
				$(this).addClass('active pes-act')
				$("#tabboletas").removeClass("active pes-act")
				$("#tabboletas").addClass( "pes-act-inv" )

				$("#ntab_boletas").removeClass("txttab");
				$("#ntab_adicionales").addClass("txttab");

				cargar_adicionales();
				
			}else if( $(this).hasClass("pes-act") ){

			}

			

		}

		
		console.log("id:"+id)
	});

	$(document).on("click", "#pagar", function(){

		var sumatoria_total=$("#sumatoria_total").attr('val_sum');
		var tipo_documento=$("#tipo_documento").val();
		var numero_documento = $("#numero_documento").val();
		var nombre = $("#nombre").val();
		var email = $("#email").val()
		var telefono=$("#telefono").val();

		var suma_efectivo=$("#suma_efectivo").attr('acumulado');
		var suma_tarjeta=$("#suma_tarjeta").attr('acumulado');

		var total_ingreso=parseInt(suma_efectivo)+parseInt(suma_tarjeta);

		if(sumatoria_total==undefined || sumatoria_total==0  || total_ingreso<sumatoria_total ){
			alert("Valor ingresado no coincide!");
			return(false);
		}else{

			if(tipo_documento=='' || numero_documento=='' || nombre=='' || email=='' || telefono==''){
				alert("Complete los datos del cliente");
				return(false);
			}else{
				pagar();
			}


		}

		
	});

	$(document).on("click", "#div_efectivo", function(){

		var sumatoria_total =$("#sumatoria_total").attr('val_sum');

		var suma_tarjeta=$("#suma_tarjeta").attr('acumulado');

		if(suma_tarjeta>0){
			var valor_complementario= parseInt(sumatoria_total)-parseInt(suma_tarjeta);

			if(valor_complementario<0){
				valor_complementario=0;
			}

			$("#suma_efectivo").html('$'+valor_complementario.toLocaleString());
			$("#suma_efectivo").attr('acumulado',valor_complementario)
			recalcular_cambio();
		}else{

		}

		$("#div_efectivo").addClass("tipo_pago_check");
		$("#div_tarjeta").removeClass("tipo_pago_check");
	});


	$(document).on("click", "#div_tarjeta", function(){

		var sumatoria_total =$("#sumatoria_total").attr('val_sum');

		var suma_efectivo=$("#suma_efectivo").attr('acumulado');

		if(suma_efectivo>0){
			var valor_complementario= parseInt(sumatoria_total)-parseInt(suma_efectivo);

			if(valor_complementario<0){
				valor_complementario=0;
			}
			$("#suma_tarjeta").html('$'+valor_complementario.toLocaleString());
			$("#suma_tarjeta").attr('acumulado',valor_complementario)
			recalcular_cambio();
		}else{

		}

		$("#div_efectivo").removeClass("tipo_pago_check");
		$("#div_tarjeta").addClass("tipo_pago_check");
	});


	$(document).on("blur", "#numero_documento", function(){

		var tipo_documento=$("#tipo_documento").val();

		var numero_documento=$("#numero_documento").val();

		if(tipo_documento!='' && numero_documento!=''){

			validar_cliente(tipo_documento,numero_documento);

		}


	});


	window.onload = function () {


	localStorage.clear();


	$("#contenido_taquilla").show();

		

	$("#iniciar").hide();

	cargar_datos_taquilla();



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
					   <option value="CC" >Cedula Ciudadania</option>
					   <option value="CE">Cedula Estranjeria</option>
					   <option value="PAS">Pasaporte</option>
				   </select>
					   
				   
				
				</div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="numero_documento" placeholder="Número de Documento" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="nombre" placeholder="Nombre" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="email" placeholder="Email" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="telefono" placeholder="Teléfono" style="height: 30px;"></div>
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
				<a ><button type="button" class="btn btn-warning " id="iniciar" style="border-radius:0px 0px 10px 10px;color: white; background:rgb(255, 157, 0); border-bottom:5px solid rgb(233, 113, 0);margin-bottom:20px;">Iniciar proceso de compra</button></a>
	  
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
			 	 
				<div class="col-lg-7 pt-2 d-flex">
				  <div class="panel3 sombra">
				  	<div class="fondo-pesta">
					     <div class="row pr-0 pl-0 ml-0 mr-0">
							<div style="cursor:pointer" id="tabboletas" tipo="boletas" class="active col-2 pes-act tabbla">
								<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
									<h3 id="ntab_boletas" class="txttab">Pasaportes</h3>
								</div>
							</div>
						
							
							 <div style="cursor:pointer" id="tabadicionales" tipo="adicionales" class="col-3 pes-act-inv d-flex justify-content-center tabbla" 	style="border-radius: 0px;">
								<div class="d-flex align-items-center cerrar mr-3 ">
									<div class="text-left"><h3  id="ntab_adicionales">Otros Servicios</h3></div>
								</div>
								<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
							</div>
							 <div class="col-1 pes-act-inv3">
							 
							 </div>

							 <div class="col-1 pes-act-inv3">
							 
							 </div>

							 <div class="col-1 pes-act-inv3">
							 
							 </div>
					
					
							 <div class="col-md-4 col-0 pes-act-inv3">
							 	<div class="d-flex justify-content-end pt-3">
								 	<div><input type="text" class="campo" id="filtrarBoletas" placeholder="Buscar" style="height: 30px;"></div>
								 </div>
							 </div>
					   </div>
					</div>
				   
					  <div class="row no-gutters pt-3" id="boletas">
					  		 
						    
					  </div>
					  
				   </div>		  
				</div>
				<div class="col-lg-4 p-2">
					<div class="text-lg-right pb-2" style="font-size: 13px;"><a id="restablecer" href="#">Restablecer</a></div>
					<div class="panel3 sombra p-0" id="div_productos" style="background:#FFFCEF">
						 
					
						 
						 
						<div style="background: #EEEEFF"  class="p-2 d-flex justify-content-between">
							<div class="pt-2">TOTAL</div>
							<div style="font-size: 24px;">$0</div>
						</div>
					</div>
					<div class="panel3 sombra mt-3">
						<div class="d-flex p-1 justify-content-between no-gutters">
							<div class="col-lg-7 p-1">
								<div style="background: #EEEEFF; border-radius: 10px;" class="p-1 pb-3" >

									<div class="p-1 d-flex justify-content-between" style="cursor:pointer" class="metodo_pago" id="div_efectivo">
										<div style="font-size: 12px;">Efectivo</div>
										<div style="font-size: 16px;" id="suma_efectivo" acumulado="0">$0</div>
									</div>
									<div class="d-flex justify-content-between pt-3" style="cursor:pointer" class="metodo_pago" id="div_tarjeta">
										<div style="font-size: 12px;">Tarjeta</div>
										<div style="font-size: 16px;" id="suma_tarjeta" acumulado="0">$0</div>
									</div>

									
									
								</div>
								<br>
								<div class="d-flex justify-content-between " id="cambio">

									
									</div>
								
								<div class="text-right pt-5"><input type="button" style="width: 100%" value="PAGAR" id="pagar"></div>
							</div>
							<div class="col-lg-4">
								<div class="row no-gutters">
									<div class="p-1 col-4 text-center numeros" id="1"  style="cursor:pointer" ><img src="imagenes/1.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="2" style="cursor:pointer"><img src="imagenes/2.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="3" style="cursor:pointer"><img src="imagenes/3.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="4" style="cursor:pointer"><img src="imagenes/4.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="5"  style="cursor:pointer"><img src="imagenes/5.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="6"  style="cursor:pointer"><img src="imagenes/6.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="7"  style="cursor:pointer"><img src="imagenes/7.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="8"  style="cursor:pointer"><img src="imagenes/8.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center numeros" id="9"  style="cursor:pointer"><img src="imagenes/9.jpg" width="100% numeros" alt=""/></div>
									<div class="p-1 col-4 text-center"></div>
									<div class="p-1 col-4 text-center numeros" id="0" style="cursor:pointer"><img src="imagenes/0.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center borrar_num" style="cursor:pointer"><img src="imagenes/del.jpg" width="100%" alt=""/></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			 </div>

			<div id="miModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Contenido del modal -->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" id="contenidoModal">
						

						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
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