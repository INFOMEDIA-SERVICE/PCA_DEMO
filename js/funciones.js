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


   function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
    };
   

   function validarToken(){

		var token = localStorage.getItem('accessToken');
		var token_refresh= localStorage.getItem('refreshToken');

		const fecha = new Date();
		var epoch = fecha.getTime();

		var str = epoch;
		str = str.toString();
		//console.log("Original data: ",str);
		str = str.slice(0, -3);
		epoch_int = parseInt(str);
		//console.log("After truncate: ",str);


		var desencript_token= parseJwt(token);

		var expira= desencript_token['exp'];

		var expira_int=parseInt(expira)

		//console.log(desencript_token)

		console.log('esta:'+epoch_int+'es mayor que esta:'+expira_int+'?');

		if(epoch_int>=expira_int){
			console.log("Expiro el token");

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
			  	
			  	localStorage.setItem('accessToken',response['accessToken']['token'] )
				localStorage.setItem('contentToken',response['contentToken']['token'] )


			})



		}else{
			console.log("Token valido");
		}

		


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