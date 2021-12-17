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