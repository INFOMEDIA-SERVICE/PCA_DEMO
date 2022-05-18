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
		<script src="js/views/empresa.js"></script>
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
            <input type="email" class="form-control" id="nombre" placeholder="Nombre empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Teléfono</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="telefono" placeholder="Teléfono empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="direccion" placeholder="direccion empresa">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Razón Social</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="razon_social" placeholder="Razon social de la empresa">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Términos y condiciones</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="terminos_condiciones" rows="4" placeholder="T & C"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Resolución Dian</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="resolucion" placeholder="Resolución dian">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Decimales</label>
            <div class="col-sm-10">
            <input type="numeric" class="form-control" id="decimales" placeholder="decimales">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Edad Mayoría de edad</label>
            <div class="col-sm-10">
            <input type="numeric" class="form-control" id="edadAdulto" placeholder="Edad Adulto">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Formato moneda</label>
            <div class="col-sm-10">
            <select name="formato_moneda" id="formato_moneda">
                <option value="" >Seleccione una opcion</option>
                <option value="pe">Pesos</option>
                <option value="do">Dólares</option>
            </select>
             </div>
        </div>


        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Cuenta Administrador</label>
            <div class="col-sm-10" id="selectAdmin">
             
             </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Correo Electrónico Remitente</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="email_remitente" placeholder="email desde el que se envian los correos">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Logo Empresa</label>
            <div class="col-sm-10">
                <input type="file" id="file" accept=".jpg,.png"/>								
                <br>
                <div id="result"><h4>Esperando archivo...</h4></div>								
                <br>
                <img id="img" width="400" height="260"/>
            </div>
        </div>

        




 
        <div class="form-group row">
            <div class="col-sm-10">
            <input type="button" style="width: 60%" value="Guardar Cambios" id="guardar">
            </div>
        </div>
        </form>
			<!--/////////////-->
			<!---->			
	  	</main>
	  	<script>

            $(document).on("click", "#guardar", function(){
                guardarDatosEmpresa()

            });
			
			//
			document.getElementById("file").addEventListener("change",openImage,false); //Anadimos un evento al input para que se dispare cuando el usuario seleccione otro archivo  
		 
                cargarSelectAdmin();
                cargarDatosEmpresa();
             
			//			
		</script>	
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<!--<script src="../js/jquery-3.4.1.min.js"></script>-->	
  	</body>
</html>