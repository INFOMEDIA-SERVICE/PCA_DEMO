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
			 
        <form>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nit Empresa</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="NIT Empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="Nombre empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Teléfono</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="Teléfono empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="direccion empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Razón Social</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="Razon social de la empresa">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Terminos y condiciones</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="T & C"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Resolución Dian</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="Resolución dian">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Decimales</label>
            <div class="col-sm-10">
            <input type="numeric" class="form-control" id="nit" placeholder="decimales">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Formato moenda</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="formato moneda">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email Remitente</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="nit" placeholder="email desde el que se envian los correos">
            </div>
        </div>





         
        <fieldset class="form-group">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
            <div class="col-sm-10">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                <label class="form-check-label" for="gridRadios1">
                    First radio
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                <label class="form-check-label" for="gridRadios2">
                    Second radio
                </label>
                </div>
                <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                <label class="form-check-label" for="gridRadios3">
                    Third disabled radio
                </label>
                </div>
            </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-sm-2">Checkbox</div>
            <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck1">
                <label class="form-check-label" for="gridCheck1">
                Example checkbox
                </label>
            </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
        </form>
			<!--/////////////-->
			<!---->			
	  	</main>
	  	<script>
			var select = document.getElementById('nmostrar_casillero');
			select.addEventListener('change', function(){
				restaurar_paginacion('myPager3');				
				var selectedOption = this.options[select.selectedIndex];
				$('#tbody_caccion').pageMe({pagerSelector:'#myPager3',showPrevNext:true,hidePageNumbers:false,perPage:selectedOption.text});
			});
			//
			$(document).ready(function(){
				cargar_datos_casillero();
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
		</script>	
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  	</body>
</html>