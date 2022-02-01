<?php
extract($_REQUEST);



if(  isset($_REQUEST['m']) ){

	if($m=="di"){
		$mensaje='<div class="alert alert-danger" role="alert">
		Usuario no Existe!!
		</div>';
	}else if($m=="ci"){
		$mensaje='<div class="alert alert-danger" role="alert">
		Contraseña incorrecta!!
		</div>';
	} 

}else{
	$mensaje="";
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Untitled Document</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/funciones.js"></script>

	<script>

	$(document).on("click", "#login", function(){

		var usuario = $("#usuario").val();

		var passwd  = $("#passwd").val();

		if(usuario=="" || passwd==""){
			alert("Datos incompletos");
			return(false);
		}else{
			document.getElementById("formulario").submit();
		}
       
		/*


		var settings = {
            "url": "http://20.44.111.223:80/api/auth/token",
            "method": "POST",
            "async": false,
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json"
            },
            "data": JSON.stringify({
              "password": passwd,
              "username": usuario
            }),
          };

          $.ajax(settings).done(function (response) {
			  	console.log(response);
				console.log(response['accessToken']['token']);
				localStorage.setItem('accessToken',response['accessToken']['token'] )
				localStorage.setItem('refreshToken',response['refreshToken']['token'] )

				if(response['accessToken']['token']!=''){
					alert("Login Exitoso!!")
					window.location.href = "inicio_pca.html";
				}

          }).fail(function (jqXHR, textStatus) {
               if(jqXHR['responseJSON']['message']=='Bad credentials'){
				   alert("Datos invalidos")
			   }
          }); */

		console.log("usuario:"+usuario+" passwd:"+passwd);
       

  	});
	</script>
  </head>
  <body class="fondo-login d-flex justify-content-center">
  	<!-- body code goes here -->
	  <main class="container-fluid">
	  <form action="php/login.php" id="formulario" method="post" >
	  	<div class="container-sm">
		<div class="row panel-login">
	   		 <div class="col-md-6 f-login2 d-flex flex-column justify-content-center mt-3 mt-md-0">
	   		 <figure class="text-center mb-5"><img src="imagenes/logo-blanco-login.png" class="img-fluid"></figure>
			<div class="align-self-end cont-text-login">
				  <h2 class="text-white text-login1">Toda la gestión<br>
De su compañía en <br>
un solo lugar</h2>
				 <h5 class="text-white text-login2">La herramienta más intuitiva para gestionar
Las tareas cotidianas y específicas de su
empresa.</h5>
				 </div>	
	        </div>
			<div class="col-md-6 f-form-logi  mb-3 mb-md-0">
				<figure class="text-center mb-5"><img src="imagenes/logo-color-login.png" class="img-fluid"></figure>
				<?php print_r($mensaje); ?>
				<div class="d-flex mb-2">
					<div class="mr-5 color-text-login"><a>Entrar</a></div>
				<!--	<div class="color-text-login"><a>Registrate</a></div> -->
				</div>
				 <div class="d-flex mb-4">
								 <div class="barra2" style="width: 10%; background: #176291; height: 2px"></div>
								<div class="barra" style="width: 28%; height: 1px"></div>
							</div>
				<div class="mb-4 textos-azules">
					<input type="text" name="usuario" id="usuario" style="background: #F5F6F8; border:1px solid #DEDEDE; border-radius: 10px; width: 90%;margin-left:0%; padding: 1em 2em" placeholder="Usuario">
				</div>
				<div class="mb-4">
					<input id="passwd" name="passwd" type="password" style=" border:1px solid #DEDEDE; border-radius: 10px; width:90%;margin-left:0%; padding: 1em 2em" placeholder="Contraseña" class="contrasena">
				</div>
				<div class="mb-5">
					<input type="button" id="login" value="Entrar" class="px-5 py-3">
				</div>
			<!--	
				<div class="mb-4 textos-azules"><h3>Inicie sesión con…</h3></div>
				<div class="d-flex">
					<figure><img src="imagenes/social_facebook.png"></figure>
					<figure><img src="imagenes/social_google.jpg"></figure>
					<figure><img src="imagenes/social_aplee.jpg"></figure> 
				</div>  
				-->
				<h4 class="color-text-login subraya"><a>He olvidado mi contraseña</a></h4>
			</div>
	   </div>
   </div>
</form>
	  </main>
   
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="../js/jquery-3.4.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
	<script src="js/bootstrap-4.4.1.js"></script>
  </body>
</html>