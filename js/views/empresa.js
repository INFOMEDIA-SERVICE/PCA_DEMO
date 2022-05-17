function openImage() { //Esta funcion validaria una imagen  
    try{			
        var input = this;
        var file = input.files[0];
        var fileName = input.value;
        var maxSize = 1048576; //bytes
        var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones validas
        console.log(file.size);
        var error = {
            state: false,
            msg: ''
        };        
        if(this.files && file) {  
            for (var i = fileName.length-1; i >= 0; i--) {  
                if (fileName[i] == '.') {  
                    var ext = fileName.substring(fileName[i],fileName.length);  
                    if (!extensions.test(ext)) {
                        error.state = true;
                        error.msg+= 'La extensión del archivo no es válida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La imágen no puede ocupar más de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                document.getElementById("result").innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result").innerHTML = "El archivo es valido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img").src = e.target.result;
                        console.log();
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result").innerHTML = "El archivo est&aacute; da&ntilde;ado";
                    document.getElementById("img").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona');
    }
}


function cargarDatosEmpresa(){

    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '26' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');  
                    
                    console.log(r2)
                     
                    $("#nit").val(r2.resultado.nit);
                    $("#nombre").val(r2.resultado.nombre);
                    $("#telefono").val(r2.resultado.telefono)
                    $("#direccion").val(r2.resultado.direccion)
                    $("#razon_social").val(r2.resultado.razonSocial)
                    $("#terminos_condiciones").val(r2.resultado.terminosCondiciones)
                    $("#resolucion").val(r2.resultado.resolucionDian)
                    $("#decimales").val(r2.resultado.decimales)
                    $("#formato_moneda").val(r2.resultado.formatoMoneda)
                    $("#email_remitente").val(r2.resultado.emailRemitente)
                    $("#edadAdulto").val(r2.resultado.edadAdulto);


                    src="http://20.44.111.223/api/contenido/imagen/"+ r2.resultado.logoImagenId;
                    
                    $('#img').attr('src', src);
                    
                    

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });

}

function cargarSelectAdmin(){

    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '28'  },
        dataType: 'json',
        async: false, 
        type: 'POST',
        //async: false,
        success: function(r2) { 

            //console.log("Creo el clinete")
            
            console.log(r2)

             $("#selectAdmin").html(r2.resultado)
        }        
    }); 

}


function guardarDatosEmpresa(){


                    let nit=$("#nit").val();
                    let nombre=$("#nombre").val();
                    let telefono=$("#telefono").val()
                    let direccion=$("#direccion").val()
                    let razonSocial=$("#razon_social").val()
                    let terminosCondiciones=$("#terminos_condiciones").val()
                    let resolucionDian=$("#resolucion").val()
                    let decimales=$("#decimales").val()
                    let formatoMoneda=$("#formato_moneda").val()
                    let emailRemitente=$("#email_remitente").val()
                    let accountAdminId=$("#accountAdminId").val();
                    let edadAdulto=$("#edadAdulto").val();

                    var v_imagen = document.getElementById("result").innerHTML;
		            if(nombre != '' && nit!='' && telefono!='' && direccion!='' && razonSocial!='' && terminosCondiciones!='' && resolucionDian!='' && decimales!='' && formatoMoneda!='' && emailRemitente!=''  && v_imagen == 'El archivo es valido'){ 

                        var value = document.getElementById("file").files[0];
                        let img_ext = value.name;
                        var extension_img = img_ext.split('.');

                        //guardarDatosEmpresa(nombre, extension_img[1]);

                        let str_base64 = document.getElementById("img").src;
                        let imagen = str_base64.split(','); //Elimino el "data:image/jpeg;base64," de la cadena
                        extension = extension_img[1].toUpperCase();   //Convierte a mayuscula 
                        
                        console.log(str_base64);
                        console.log(imagen);


                        $.ajax({        
                            url: "ajax/ajxRequest2.php",
                            data: { op: '27',nit:nit,nombre:nombre,telefono:telefono,direccion:direccion,razonSocial:razonSocial,terminosCondiciones:terminosCondiciones,resolucionDian:resolucionDian,decimales:decimales,formatoMoneda:formatoMoneda,emailRemitente:emailRemitente,formato:extension, datosBase64:imagen[1],accountAdminId:accountAdminId,edadAdulto:edadAdulto},
                            dataType: 'json',
                            async: false, 
                            type: 'POST',
                            //async: false,
                            success: function(r2) { 
                    
                                //console.log("Creo el clinete")
                                
                                console.log(r2)
                    
                                if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                    alert("Datos Guardados Exitosamente!")                                          
                                   
                                }else{
                                    alert("Error al guardar")
                                }
                            }        
                        }); 


                    }	

}