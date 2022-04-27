function imprimirReserva(idreserva){

    let url_pdf="exportar/reserva/reserva_pdf.php";

    window.open(url_pdf+'?idreserva='+idreserva, '_blank');
}



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

                str_remp+= ' <div class=" pr-2 " ><h2>Numero reserva: '+datos['id']+'</h2>  </div><input type="button" onclick="imprimirReserva(\''+datos['id']+'\');" class="boton_campo2"  value="IMPRIMIR" id="imprimirReserva"><br> ';

               

                var str_casillas_reservadas='';

                let array_casillas_reservadas=[];

                var num_casillas_reservadas=0;

                $.each(datos['boletas'], function(index, datos4) {

                    if(datos4['visitante'] !=undefined){
                        if(datos4['visitante']['reservaCasilla'] !=undefined){
                            console.log("reservaCasilla:")
                            if(datos4['visitante']['reservaCasilla']['casilla']['id']!=''){
                                num_casillas_reservadas++;
                                //console.log("Casilla:"+datos4['visitante']['reservaCasilla']['casilla']['id']+" apartado por: "+datos4['visitante']['nombre'])

                                str_casillas_reservadas=str_casillas_reservadas+datos4['visitante']['reservaCasilla']['casilla']['id']+'|';
                                array_casillas_reservadas.push(datos4['visitante']['reservaCasilla']['casilla']['id'])
                            }
                        
                        }
                    }

                    /*if(datos2['visitante']['reservaCasilla']['casilla']['id']!=undefined){

                    }else{
                        console.log("Casilla:"+datos2['visitante']['reservaCasilla']['casilla']['id']+" apartado por: "+datos2['visitante']['nombre'])
                    }*/
                });
                console.log('array_casillas_reservadas');
                console.log(array_casillas_reservadas);
                let array_casillas_disponibles=[];

                if(datos['casillas']!='' && datos['casillas']!=undefined){

                    var num_casillas=0;
                    //var num_casillas_reservadas=0;

                    var str_casillas='';

                    $.each(datos['casillas'], function(index, datos3) {



                        num_casillas++;

                        if(array_casillas_reservadas.includes(datos3['casilla']['id'])){

                        }else{

                            str_casillas=str_casillas+datos3['casilla']['id']+'|';
                            //console.log("casillas")
                            //console.log(datos3)

                            

                            array_casillas_disponibles.push(datos3['casilla']['id'])

                        }
                        
                        
                    });

                }

                console.log('array_casillas_disponibles');
                console.log(array_casillas_disponibles)

                var casillas_disponibles =  array_casillas_disponibles.join();

                var num_casillas_final=num_casillas-num_casillas_reservadas;

                if(num_casillas>0){
                    str_remp+= '<div class=" panel3_2 " ><h2>Casillas disponibles: '+num_casillas_final+' - Casillas reservadas: '+num_casillas_reservadas+'</h2></div><br> ';
                }

                $.each(datos['boletas'], function(index, datos2) {

                    str_remp+=' <div class="sombra2 panel3_2 boleta-add"  style="margin-top: 12px;" >   <div class="pt-3 d-flex   pr-2 " style="justify-content: space-between">   <img src="http://20.44.111.223/api/contenido/imagen/' + datos2['tipoBoleta']['imagenId'] + '" width="120" height="90" style="border-radius:10px;"  alt=""> <div class="p-2 centrado"> <h2 class="pt-2">'+datos2['tipoBoleta']['nombre']+' # '+datos2['id'].substr(-6)+'</h2>  </div> <div class="p-2 centrado"><h2>'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+' - '+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+' Años </h2></div>  <div class="p-2 centrado"> <h2>'+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMin']+' - '+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMax']+' CM </h2> </div>    <div class="p-2 centrado"> <h2>$'+datos2['tipoBoleta']['precio'].toLocaleString()+'</h2> </div>  <div class="p-2 centrado">'; 
                    
                    //console.log(datos2['visitante']);

                    if(datos2['visitante']!=undefined){

                        str_remp+='<b>Ver Visitante</b><img src="imagenes/chulito.jpg" idreserva="'+datos['id']+'"  idboleta="'+datos2['id']+'" edadInicial="'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+'" edadFinal="'+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+'" estaturaCmMin="'+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMin']+'" estaturaCmMax="'+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMax']+'" pasaporteNombre="'+datos2['tipoBoleta']['nombre']+'" class="centrado pointer verVisitante" width="50" height="50" style="border-radius:10px;"  alt="">  </div>  </div> </div> ';

                    }else{

                        str_remp+='<b>Registar Visitante</b><img src="imagenes/agregar.jpg" idreserva="'+datos['id']+'"  idboleta="'+datos2['id']+'"  edadInicial="'+datos2['tipoBoleta']['categoriaEdad']['edadInicial']+'" edadFinal="'+datos2['tipoBoleta']['categoriaEdad']['edadFinal']+'" estaturaCmMin="'+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMin']+'" estaturaCmMax="'+datos2['tipoBoleta']['categoriaEstatura']['estaturaCmMax']+'" casillas_disponibles="'+casillas_disponibles+'" pasaporteNombre="'+datos2['tipoBoleta']['nombre']+'" class="centrado pointer agregar" width="70" height="70" style="border-radius:10px;"  alt="">  </div>  </div> </div> ';

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
     
    var url_pdf="exportar/reserva/reserva_boleta_pdf.php";

    var nombre=$("#nombreR").val();
    var apellido=$("#apellidoR").val();

    var tipo_documento= $("#tipo_documentoR").val();
    var numero_documento=$("#numero_documentoR").val();
    var fecha_nacimiento=$("#fecha_nacimientoR").val();
    var altura=$("#alturaR").val();
    var casillas_disponibles=$("#casillas_disponiblesR").val();

    var reservarLocker=0;

    if( $('#agregarLockerR').prop('checked') ) {
        reservarLocker=1;
    }

    

    if(nombre!='' && apellido!='' && fecha_nacimiento!='' && altura>0 ){


        if(altura>0 && altura<=270){
            
        }else{
            alert("La altura ingresada no es valida!")
        }

       // alert("Ingresaste: nombre:"+nombre+" , apellido:"+apellido+" , tipo_documento:"+tipo_documento+" , numero_documento:"+numero_documento+" , fecha_nacimiento:"+fecha_nacimiento);



        $.ajax({        
            url: "ajax/ajxRequest2.php",
            data: { op: '22',tipo_identificacion:tipo_documento,numero_identificacion:numero_documento,nombre:nombre,apellido:apellido,fecha_nacimiento:fecha_nacimiento,idreserva:idreserva,idboleta:idboleta,altura:altura,casillas_disponibles:casillas_disponibles,reservarLocker:reservarLocker},
            dataType: 'json',
            async: false, 
            type: 'POST',
            //async: false,
            success: function(r2) { 
                
                console.log(r2)
    
    
                if (r2.sts == 'OK') {    

                    window.open(url_pdf+'?idreserva='+idreserva+'&idboleta='+idboleta+'&nombre='+nombre+'&apellido='+apellido,  '_blank');
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

                             if(datos2['visitante']['reservaCasilla']!=undefined){
                                var casillaAsignada=datos2['visitante']['reservaCasilla']['casilla']['id'];
                                console.log("Casilla asignada:"+casillaAsignada)

                                $("#divCasillaAsignada").show();
                                $("#CasillaAsignada").html("Casilla asignada:"+casillaAsignada)
                             }else{
                                 $("#divCasillaAsignada").hide();
                                 $("#CasillaAsignada").html('');
                                 console.log("Fresco")
                             }

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


function validar_estatura(altura,estaturaCmMin,estaturaCmMax){

    console.log("prueba dos: "+altura+">="+estaturaCmMin+" && "+altura+"<="+estaturaCmMax)

    if( parseFloat(altura) >= parseFloat(estaturaCmMin) && parseFloat(altura) <= parseFloat(estaturaCmMax) ){
        
        $("#alertaEstatura").html("Estatura aplica para el pasaporte!")
        $("#registrar").show();
    }else{
        $("#alertaEstatura").html('<h3 style="color:#FF0000";>La estatura esta fuera del rango permitido por el pasaporte!</h3>');
        $("#registrar").hide();
    }

}