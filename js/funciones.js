function printImg() {
	pwin = window.open(document.getElementById("BoletaDescarga").src,"_blank");
	pwin.onload = function () {window.print();}
  }

  function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
	 if ((new Date().getTime() - start) > milliseconds) {
	  break;
	 }
	}
   }
   
   function demo() {
	 console.log('Taking a break...');
	 sleep(2000);
	 console.log('Two second later');
   }
   

   function validarToken(){

		var token = localStorage.getItem('accessToken');
		var token_refresh= localStorage.getItem('refreshToken');

		console.log("accessToken"+token)
		console.log("refreshToken"+token_refresh);

		//return(false);

		var settings2 = {
            "url": "http://20.44.111.223:80/api/boleteria/tiposBoleta?incluirImagen=true",
            "method": "GET",
            "async": false,
            "timeout": 0,
            "headers": {
              "Authorization": "Bearer "+token
            },
          };

          

          $.ajax(settings2).done(function (response2) {
            console.log("validarToken ok");
            console.log(response2);
            
          }).fail(function (jqXHR, textStatus) {

			console.log(jqXHR)

			if(jqXHR['responseJSON']['error']=='Unauthorized'){
				console.log("Genere un nuevo token!!")
				//genero el nuevo token

				var settings = {
					"url": "http://20.44.111.223:80/api/auth/refreshtoken",
					"method": "POST",
					"async": false,
					"timeout": 0,
					"headers": {
					  "Content-Type": "application/json"
					},
					"data": JSON.stringify({
						"refreshToken": token_refresh
					}),
				};

				$.ajax(settings).done(function (response) {
					console.log(response);
				  console.log(response['token']);
				  localStorage.setItem('accessToken',response['token'] )
				  
  
				  if(response['accessToken']['token']!=''){
					  
				  }
  
			})


			}
	   });


   }
   

function tomarImagenPorSeccion(div,nombre) {
	var img='';
	html2canvas(document.querySelector("#" + div)).then(canvas => {
		var img = canvas.toDataURL();
		console.log(img);

		$("#divqr").html('<div id="divimagen"><img id="BoletaDescarga" src=" '+img+'" width="250" height="60" ></div><br>')
		//$("#divqr2").append('<a download="boleta.jpg" href="'+img+'">Descargar Boleta</a>')
		

		 
	});	

	 
}


function tomarImagenPorSeccion2(div,nombre) {
	
	html2canvas(document.querySelector("#" + div)).then(canvas => {
		var img = canvas.toDataURL();
		console.log(img);

		 
		$("#divqr2").append('<a download="boleta.jpg" href="'+img+'">Descargar Boleta</a>')

		$("#generar").hide();
		

		 
	});	

	 
}