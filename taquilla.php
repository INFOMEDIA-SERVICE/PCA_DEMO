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

		.heaven{
			
			
			z-index: 300;
		}

		.selectAltura {
			display:block;
			height:30px;
			width:200px;
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

$(document).on("click", ".boleta-add", function(){
        

		// alert("idboleta"+$(this).attr("idtipoBoleta"));
 
		 var boletas_carrito= localStorage.getItem('boletas_carrito');
 
 
		 //var boleta_local= localStorage.getItem('idtipoBoleta_'+$(this).attr("idtipoBoleta"));
 
		 if(boletas_carrito==null || boletas_carrito==undefined){
 
		   var arr_boletas_carrito=Array();
 
		   var indice=$(this).attr("idboleta")
 
		   if(indice>0){
			 console.log("indice -1")
			 console.log(indice)
 
			 arr_boletas_carrito[indice]=1;
 
			 console.log("arr_boletas_carrito -1")
 
			 console.log(arr_boletas_carrito)
 
			 var json_boletas_carrito=JSON.stringify(arr_boletas_carrito);
 
			 console.log("json_boletas_carrito -1")
			 console.log(json_boletas_carrito)
			 
			 localStorage.setItem('boletas_carrito',json_boletas_carrito);
 
			 console.log("paso por el if")
 
		   }
 
		   
		 }else{
 
		   var arr_boletas_carrito = JSON.parse(boletas_carrito);
		   if(arr_boletas_carrito[$(this).attr("idboleta")]==null){
			 arr_boletas_carrito[$(this).attr("idboleta")]=1;
		   }else{
			 arr_boletas_carrito[$(this).attr("idboleta")]++;
		   }
		  
		   
		   var json_boletas_carrito=JSON.stringify(arr_boletas_carrito);
		   
		   localStorage.setItem('boletas_carrito',json_boletas_carrito);
		   console.log("paso por el else")
		 }
 
		 console.log("actual")
		 console.log(localStorage.getItem('boletas_carrito'));
 
		 var arr_recorrer= JSON.parse( localStorage.getItem('boletas_carrito'));
 
		 console.log("arr_recorrer")
 
		 console.log(arr_recorrer);
 
		 /*modal.style.display = "block";
				 body.style.position = "static";
				 body.style.height = "100%";
				 body.style.overflow = "hidden";*/
 
		 
 
		   var cont=1;
 
		   var long= 0;
		   console.log("arr_recorrer"+arr_recorrer)
		   if(arr_recorrer!=null){
 
 
			 arr_recorrer.forEach(function(cant, idbo) {
			   if(cant>0){
				 long++;
			   }
			 });
 
			 console.log("long:"+long)
 
		   var str_div=''
 
		   var sumatoria=0;
		   var sumatoria_sub=0;
 
		 arr_recorrer.forEach(function(cant, idbo) {
		   //width="100" height="100"
 
		   
 
 
			 if(cont==1){
			   //str_div=str_div+'<table class="table">  ';
			 }
 
			 if(cant!=null && cant!=0){
			   console.log("idboleta:"+idbo+" cant:"+cant);
			   var datosBoleta=retornarDatosBoleta(idbo);
			   console.log(datosBoleta)
 
			 sumatoria+=parseFloat(cant)*parseFloat(datosBoleta['precio'])
			 sumatoria_sub=parseFloat(cant)*parseFloat(datosBoleta['precio'])

			 
 
			  // str_div=str_div+'<tr id="tr_bol_'+idbo+'" class="productos">  <td><img <img src="http://20.44.111.223/api/contenido/imagen/' + datosBoleta['imagenId'] + '" //width="100" height="60" ></td> <td> <b>'+datosBoleta['nombre']+'</b> <br> $'+datosBoleta['precio']+' </td> <td> <input type="button" style="width : 30px;" class="restar" id="'+idbo+'" value="-" ><input type="text" style="width : 30px;" id="inp_car'+idbo+'" value="'+cant+'"><input type="button" style="width : 30px;" class="sumar" id="'+idbo+'" value="+" > </td> <td><a  class="btn  eliminar_producto" id="'+datosBoleta['id']+'" > <img src="eliminar.png" width="20" height="20" > </a></td>  </tr>'


			   str_div=str_div+'<div class="px-2">	 <div class="row no-gutters" style="border-bottom: #D8D4C1 solid 1px;">						 <div class="col-7">	  <h3 class="textos-medios pt-2">'+datosBoleta['nombre']+'</h3>	  	<div class="d-flex">			 	<p class="textos-azules pt-1" style="font-size: 10px;">'+cant+' Unidad / $'+datosBoleta['precio'].toLocaleString()+' / Units</p>						 	</div>	 </div>	 <div class="col-5 d-flex align-items-center justify-content-lg-end no-gutters">			   <div class="row no-gutters justify-content-end">	 <div class="col-12" style="text-align: right"><img src="imagenes/menos.svg" width="20%" alt=""></div>	 <div class="col-12" style="font-size: 18px; text-align: right">$'+sumatoria_sub.toLocaleString()+'</div> 	</div>	  </div>	 </div>	 	</div>'
 
			   if(cont==long){
				 console.log("paso por el final, cont:"+cont+" , long:"+long)
				// str_div=str_div+'</table>';
				str_div=str_div+'<div style="background: #EEEEFF" class="p-2 d-flex justify-content-between">    <div class="pt-2">TOTAL</div>    <div style="font-size: 24px;">$'+sumatoria.toLocaleString()+'</div></div>'
				// str_div=str_div+' <br> <div style="text-align:right" ><a class="btn eliminar_todo derecha"><span class="derecha">Vaciar carrito <img src="trash2.jpg" width="20" height="20" > </span></a></div><br> <hr class="bg-success border-2 border-top border-success"> <span class="derecha"><h3 id="div_subtotal">Subtotal $'+sumatoria.toLocaleString()+'  </h3></span> <br><a  class="btn btn-primary irapagar"  style="border-style:none;background-color:rgb(131, 204, 22);;margin-left:350px;border-radius:20px;height:30px;width:130px;font-size:13px;padding-top:5px;"><b>Ir a pagar</b></a>';
			   }
 
			   cont++;
 
			 }
			 
		 });
 
 
		   }
		   
 
		   
 
 
		 
 
		   $("#div_productos").html(str_div)
 
		 
 
		// if( ;  )
 });

	$(document).on("click", ".regresar", function(){
		window.location.href="inicio_pca2.php";
	});

	$(document).on("click", "#restablecer", function(){
		//alert("Holi")
		localStorage.clear();
		location.reload();
	});

/*	function iniciar_proceso(){
	//$(document).on("click", "#iniciar", function(){

		validarToken();

		//return(false);

		//alert("Proceso de compra iniciado con exito")

		$("#contenido_taquilla").show();

		

		$("#iniciar").hide();

		const f = new Date();

		//$("#fecha").html('<h3>Fecha reserva: <span class="badge bg-secondary">'+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+'</span></h3> <div id="mi_tabla" class="container"> <table class="table table-hover   tableFixHead">  <tr> <td align="left"> Tipo Documento: <select   id="tipo_doc" > <option value="">Seleccione una opcion</option><option value="cc">Cedula Ciudadania</option><option value="ce">Cedula Extranjeria</option><option value="pa">Pasaporte</option> </select> </td><td align="left"> Numero documento:  <input type="text" id="numero_documento" ></td> </tr> <tr> <td align="left"> Nombres: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="nombres" > </td><td align="left"> Apellidos: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="apellidos" ></td> </tr> </table></div>')
         // console.log("Token"+localStorage.getItem('accessToken'))

		  var settings2 = {
            "url": "http://20.44.111.223:80/api/boleteria/tipoBoleta?incluirImagen=true",
            "method": "GET",
            "async": false,
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+localStorage.getItem('accessToken')
            },
          };

          

          $.ajax(settings2).done(function (response2) {
            console.log("Boletas");
            console.log(response2);
            var str_remp=' ';
            //$("#boletas").html('<div  class="row col-auto bg-danger p-5 text-center" ><div class="col-sm-3">');
              var cont=1;
            
            localStorage.setItem('boletas_nombres',JSON.stringify(response2))

            response2.forEach(function(boleta, index) {
                console.log(boleta);

				str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img  src="data:image/jpeg;base64, '+boleta['imagenBase64']+'" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+boleta['nombre']+'</h4> <div><h2>$'+boleta['precio'].toLocaleString()+'</h2></div> </div>     </div>      </div>';

                // str_remp=str_remp+'<div class="col-sm-3"><div class="card" style="width: 14rem;border-radius:26px;box-shadow:2px 2px 2px 1px rgb(235, 235, 235);border-style: none;"><img src="data:image/jpeg;base64, '+boleta['imagenBase64']+'" style="border-radius:20px;padding:10px 10px;" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title" style="font-size:16px;padding-bottom:7px;padding-top:0px;">'+boleta['nombre']+'</h5><p class="card-text"style="font-size:10px;">'+boleta['descripcion']+'</p> <h1 style="font-size:20px;display:contents;">$'+boleta['precio'].toLocaleString()+'</h1> <a  class="btn btn-primary btnModal" idtipoBoleta="'+boleta['id']+'" style="border-style:none;background-color:rgb(131, 204, 22);;margin-left:180px;border-radius:20px;height:30px;width:80px;font-size:13px;padding-top:5px;">Comprar</a> </div> </div> </div>';

                 cont++;

            });
            str_remp=str_remp+'</div> '
            $("#boletas").html(str_remp);
          });

	}*/


	window.onload = function () {

	//alert("Hola magola 2")
	//$("#iniciar").click();

	//iniciar_proceso();


	$("#contenido_taquilla").show();

		

	$("#iniciar").hide();

	cargar_datos_taquilla();



	}

	</script>
  </head>
  <body>
  	<!-- body code goes here -->
	  <!-- <header>
		<nav style="background-color:#009fd0;">
		   <div class="row justify-content-between">
			   
			   <div class="col-lg-1 col-3 d-flex align-items-center">
				   <figure class="pt-3">
					<img src="imagenes/logo_pca_color.png" style="width:40px;margin-left:20px;">
				   </figure>
			   </div>
			   <div class="d-flex justify-content-start">
				   <div class="px-2 pt-3 "><input type="text" class="campo" value="Tipo de Documento" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" value="Número de Documento" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" value="Nombre" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" value="Email" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" value="Teléfono" style="height: 30px;"></div>
			   </div>
			   <div class="d-flex align-items-center justify-content-end">
				   <div style="background: #009fd0" class="py-3 px-2"><img src="imagenes/back.svg" alt=""/></div>
			 </div>
		   </div>
	   </nav> 
	</header> -->

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
					   <option value="">Seleccione</option>
					   <option value="cc" >Cedula Ciudadania</option>
					   <option value="ce">Cedula Estranjeria</option>
					   <option vlaue="pa">Pasaporte</option>
				   </select>
					   
				   
				
				</div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="numero_documento" placeholder="Número de Documento" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="nombre" placeholder="Nombre" style="height: 30px;"></div>
				   <div class="px-2 pt-3 "><input type="text" class="campo" id="apellido" placeholder="Email" style="height: 30px;"></div>
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
								<div class="active col-2 pes-act">
							<div class="text-center d-flex align-items-center align-self-center justify-content-center cerrar">
								<a href="">Pasaportes</a>
							</div>
						</div>
						
						<div class="col-2 pes-act-inv d-flex justify-content-center">
							<div class="d-flex align-items-center cerrar mr-3 ">
								<div class="text-left"><a>Lockers</a></div>
							</div>
							<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
						</div>
							 <div class="col-3 pes-act-inv d-flex justify-content-center" style="border-radius: 0px;">
							<div class="d-flex align-items-center cerrar mr-3 ">
								<div class="text-left"><a>Otros Servicios</a></div>
							</div>
							<figure class="d-flex align-items-center pt-3"><img src="imagenes/Línea 5.png"></figure>
						</div>
							 <div class="col-1 pes-act-inv3">
							 
							 </div>
					
					
							 <div class="col-md-4 col-0 pes-act-inv3">
							 	<div class="d-flex justify-content-end pt-3">
								 	<div><input type="text" class="campo" value="Buscar" style="height: 30px;"></div>
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
									<div class="p-1 d-flex justify-content-between" style="background:#FFFFFF; border: #D4D4D4 solid 1px; border-radius: 10px;">
									<div style="font-size: 12px;">Efectivo</div>
									<div style="font-size: 16px;">$10,378,200</div>
										</div>
									<div class="d-flex justify-content-between pt-3">
										<div style="font-size: 12px;">Tarjeta</div>
									<div style="font-size: 16px;">$10,378,200</div>
									</div>
									
								</div>
								
								<div class="text-right pt-5"><input type="button" style="width: 100%" value="PAGAR"></div>
							</div>
							<div class="col-lg-4">
								<div class="row no-gutters">
									<div class="p-1 col-4 text-center"><img src="imagenes/1.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/2.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/3.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/4.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/5.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/6.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/7.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/8.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/9.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/0.jpg" width="100%" alt=""/></div>
									<div class="p-1 col-4 text-center"><img src="imagenes/x.jpg" width="100%" alt=""/></div>
								</div>
							</div>
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