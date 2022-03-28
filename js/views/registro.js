function consultar_reserva(){

    var tipo_documento=$("#tipo_documento").val();
    var numero_documento=$("#numero_documento").val();

    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '21',tipo_identificacion:tipo_documento,numero_identificacion:numero_documento},
        dataType: 'json',
        async: false, 
        type: 'POST',
        //async: false,
        success: function(r2) { 
            
            console.log(r2['resultado'])

             var str_remp='';
            
            $.each(r2['resultado'], function(index, datos) {


                $("#div_cliente").html('<h3>Cliente: '+datos['cliente']['nombreCompleto']+'</h2>');
                $("#div_fecha_reserva").html('<h3>Fecha Reserva: '+datos['fecha']+'<h3>')

                str_remp+= ' <div class=" pr-2 " ><h2>Numero reserva: '+datos['id']+'</h2></div><br> ';

                $.each(datos['boletas'], function(index, datos2) {

                    str_remp+=' <div class="sombra2 panel3_2 boleta-add"  style="margin-top: 12px;" >   <div class="pt-3 d-flex   pr-2 " style="justify-content: space-between">   <img src="http://20.44.111.223/api/contenido/imagen/' + datos2['tipoBoleta']['imagenId'] + '" width="120" height="90" style="border-radius:10px;"  alt=""> <div class="p-2 centrado"> <h2 class="pt-2">'+datos2['tipoBoleta']['nombre']+'</h2>  </div> <div class="p-2 centrado"><h2>'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+' - '+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+' Años </h2></div> <div class="p-2 centrado"> <h2>$'+datos2['tipoBoleta']['precio'].toLocaleString()+'</h2> </div>  <div class="p-2 centrado">'; 
                    
                    console.log(datos2['visitante']);

                    if(datos2['visitante']!=undefined){

                        str_remp+='<img src="imagenes/chulito.jpg" idreserva="'+datos['id']+'"  idboleta="'+datos2['id']+'" edadInicial="'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+'" edadFinal="'+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+'" class="centrado pointer verVisitante" width="50" height="50" style="border-radius:10px;"  alt="">  </div>  </div> </div> ';

                    }else{

                        str_remp+='<img src="imagenes/agregar.jpg" idreserva="'+datos['id']+'"  idboleta="'+datos2['id']+'"  edadInicial="'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+'" edadFinal="'+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+'" class="centrado pointer agregar" width="70" height="70" style="border-radius:10px;"  alt="">  </div>  </div> </div> ';

                    }
                });
                
                str_remp+='<div class=" panel3_2 boleta-add"  style="margin-top: 12px;" ></div>';
                //console.log(str_remp)
            });

            $("#boletas").html(str_remp)


            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                //alert("Cliente creado exitosamente")                                          
               
            }else{
                alert("Error al crear el cliente")
            }
        }        
    }); 


}


function registrarBoleta(){

    var idreserva=$("#idreservaR").val();
    var idboleta=$("#idboletaR").val();

    //alert("idreserva:"+idreserva+" , idboleta:"+idboleta);
     


    var nombre=$("#nombreR").val();
    var apellido=$("#apellidoR").val();

    var tipo_documento= $("#tipo_documentoR").val();
    var numero_documento=$("#numero_documentoR").val();
    var fecha_nacimiento=$("#fecha_nacimientoR").val();
    var altura=$("#alturaR").val();
    if(nombre!='' && apellido!='' && fecha_nacimiento!='' && altura>0 ){


        if(altura>0 && altura<=270){
            
        }else{
            alert("La altura ingresada no es valida!")
        }

       // alert("Ingresaste: nombre:"+nombre+" , apellido:"+apellido+" , tipo_documento:"+tipo_documento+" , numero_documento:"+numero_documento+" , fecha_nacimiento:"+fecha_nacimiento);



        $.ajax({        
            url: "ajax/ajxRequest2.php",
            data: { op: '22',tipo_identificacion:tipo_documento,numero_identificacion:numero_documento,nombre:nombre,apellido:apellido,fecha_nacimiento:fecha_nacimiento,idreserva:idreserva,idboleta:idboleta,altura:altura},
            dataType: 'json',
            async: false, 
            type: 'POST',
            //async: false,
            success: function(r2) { 
                
                console.log(r2)
    
    
                if (r2.sts == 'OK') {               
                    alert(r2.resultado);
                    $(".close").click();
                    consultar_reserva();                                          
                   
                }else{
                    alert("Error al crear el cliente")
                }
            }        
        });



    }else{
        alert("Nombre , apellido , fecha nacimiento y altura son obligatorios!!");
        return(false);
    }
}


function visitante(){

    var idboleta=$("#idboletaV").val();

    if(idboleta!=''){
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '23',idboleta:idboleta},
            dataType: 'json',
            async: false, 
            type: 'POST',
            //async: false,
            success: function(r2) { 
                
                //console.log(r2)


                $.each(r2['resultado'], function(index, datos) {

                    $.each(datos['boletas'], function(index, datos2) {

                        if(datos2['id']==idboleta){
                            console.log(datos2['visitante']);

                             $("#nombreV").val(datos2['visitante']['nombre']);
                             $("#nombreV").attr('readonly', true);
                             $("#apellidoV").val(datos2['visitante']['apellido']);
                             $("#apellidoV").attr('readonly', true);
                             $("#tipo_documentoV").val(datos2['visitante']['tipoIdentificacion']);
                             $("#tipo_documentoV").prop('disabled', 'disabled');
                             $("#numero_documentoV").val(datos2['visitante']['numeroIdentificacion']);
                             $("#numero_documentoV").attr('readonly', true);
                             $("#fecha_nacimientoV").val(datos2['visitante']['fechaNacimiento']);
                             $("#fecha_nacimientoV").attr('readonly', true);
                             $("#alturaV").val(datos2['visitante']['estaturaCm']);
                             $("#alturaV").attr('readonly', true);

                        }

                    });

                    


                });   
    
    
                /*var nombre=$("#nombreR").val();
                var apellido=$("#apellidoR").val();

                var tipo_documento= $("#tipo_documentoR").val();
                var numero_documento=$("#numero_documentoR").val();
                var fecha_nacimiento=$("#fecha_nacimientoR").val();*/
            }        
        });
    }

}

function validar_fecha(edadInicial,edadFinal,fecha_nacimiento){




    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '24',edadInicial:edadInicial,edadFinal:edadFinal,fecha_nacimiento:fecha_nacimiento},
        dataType: 'json',
        async: false, 
        type: 'POST',
        //async: false,
        success: function(r2) { 
            console.log(r2)

            if(r2.sts == 'OK'){
                $("#alertaFechaNacimiento").html("Edad aplica para el pasaporte!")
                $("#registrar").show();
            }else{
                $("#alertaFechaNacimiento").html('<h3 style="color:#FF0000";>'+r2.resultado+'</h3>');
                $("#registrar").hide();
            }
        }        
    });

}