    function retornarDatosBoleta(idboleta){
        var json_boletas_nombres=localStorage.getItem('boletas_nombres');
        var arr_boletas_nombres= JSON.parse(json_boletas_nombres);

        //console.log('arr_boletas_nombres *****')
        //console.log(arr_boletas_nombres)
        var reto='';
        arr_boletas_nombres.forEach(function(boleta, index) {
            
            if(boleta['id']==idboleta){
            reto= boleta
            }

        
        });

        return(reto);

    } 

    function cargar_datos_taquilla(filtro){
    // console.log('Cargar datos'); 

        var info_boletas= JSON.parse( localStorage.getItem('boletas_nombres'));

        if(info_boletas==null){
            //console.log("El array esta vacio")

            $.ajax({        
                url: "ajax/ajxRequest.php",
                data: { op: '6' },
                dataType: 'json',
                type: 'POST',
                //async: false,
                success: function(r2) {            
                    if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                        if(typeof r2.resultado.status === 'undefined'){
                            //console.log('CORRECTO 200');
                            //console.log(r2)                
                            var str_remp='';
        
                            let productos = [];
        
                            //localStorage.setItem('boletas_nombres',JSON.stringify(r2['resultado']))
                            //console.log();
                            $.each(r2.resultado, function(m, n) {

                                //console.log(n)
        
                                n.tipoBoleta.cant_taquilla=0;
                                n.tipoBoleta.tipo_producto="boleta";
                                n.tipoBoleta.cantidadDisponible=n.cantidadDisponible;
        
                                let nuevaLongitud = productos.push(n.tipoBoleta)
        
                                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.tipoBoleta.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.tipoBoleta.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.tipoBoleta.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.tipoBoleta.nombre +'</h4> <div><h2>$'+n.tipoBoleta.precio.toLocaleString()+'</h2></div> <div><h2>Cantidad disponible: <span class="badge bg-success">'+n.tipoBoleta.cantidadDisponible+'</span></h2></div> </div>     </div>      </div>';
                            
                                });
                                
                                //console.log('array_productos')
        
                                //console.log(productos);
        
                                localStorage.setItem('boletas_nombres',JSON.stringify(productos))
                                
                                str_remp=str_remp+'</div> '
        
                                //console.log(str_remp);
                                $("#boletas").html(str_remp);
                        }else{
                            //console.log(r2.resultado.status);
                        }                                            
                    
                    }
                }        
            });


            $.ajax({        
                url: "ajax/ajxRequest2.php",
                data: { op: '31' },
                dataType: 'json',
                type: 'POST',
                //async: false,
                success: function(r2) {            
                    if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                        
                        //console.log(r2);

                        let str_select='<select name="metodos_pago" id="metodos_pago" class="selectAltura2"> <option value="0">Seleccione m??todo Pago</option>';

                        let mediosPago= [];

                        $.each(r2.resultado, function(m, n) {

                            str_select+=' <option value="'+n.id+'" requiereDatosAutorizacion="'+n.requiereDatosAutorizacion+'" >'+n.nombre+'</option> ';

                            let nuevaLongitud = mediosPago.push(n)

                        });

                        str_select+='</select> <br>      ';


                     

                        $("#metodo_pago_select").html(str_select)

                        localStorage.setItem('metodosPago',JSON.stringify(mediosPago))
                        

                                                                 
                    
                    }
                }        
            });


        }else{
            //console.log("El array tiene datos")

            //console.log("filtro:"+filtro)


            str_remp ='';
            $.each(info_boletas, function(m, n) {
        
                if(filtro!=undefined){

                    if( n.nombre.toLowerCase().includes(filtro.toLowerCase()) ){
                        //console.log("Coincide con:"+n.nombre)
        
                        str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> <div><h2>Cantidad disponible: <span class="badge bg-success">'+n.cantidadDisponible+'</span></h2></div> </div>     </div>      </div>';
        
                    }

                }else{
                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> <div><h2>Cantidad disponible: <span class="badge bg-success">'+n.cantidadDisponible+'</span></h2></div> </div>     </div>      </div>';
                }

                

            

                    
            
                });
                
                //console.log('array_productos')

                //console.log(productos);

                
                
                str_remp=str_remp+'</div> '

                //console.log(str_remp);
                $("#boletas").html(str_remp);


            }


            
    }


    function cargar_adicionales(filtro){

        var info_adicionales= JSON.parse( localStorage.getItem('adicionales_nombres'));

        if(info_adicionales==null){

            $.ajax({        
                url: "ajax/ajxRequest2.php",
                data: { op: '10' },
                dataType: 'json',
                type: 'POST',
                //async: false,
                success: function(r2) {            
                    if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                        if(typeof r2.resultado.status === 'undefined'){
                        // console.log('CORRECTO 200');
                        // console.log(r2)                
                            var str_remp='';
        
                            let productos = [];
        
                            
                            $.each(r2.resultado, function(m, n) {
        
                                n.cant_taquilla=0;
                                n.tipo_producto="adicional";
        
                                let nuevaLongitud = productos.push(n)

                                
        
                                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"  idtipo_servicio="'+n.categoriaServicio.id+'"  idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div>       ';

                                    if(n.categoriaServicio.id==1){
                                    // console.log("Lo encontre?:"+n.nombre)

                                        str_remp=str_remp+'<div><h2>Cantidad disponible: <span class="badge bg-success">'+n.disponibilidadCasilleros.disponibles+'</span></h2></div>';

                                        
                                    }
                                    
                                    str_remp=str_remp+'</div>     </div>      </div>';


                                
                            
                                });
                                
                                //console.log('array_productos')
        
                                //console.log(productos);
        
                                localStorage.setItem('adicionales_nombres',JSON.stringify(productos))
                                
                                str_remp=str_remp+'</div> '
        
                                //console.log(str_remp);
                                $("#boletas").html(str_remp);
                        }else{
                        // console.log(r2.resultado.status);
                        }                                            
                    
                    }
                }        
            });

        }else{

        // console.log("filtro ***:"+filtro)

            var str_remp='';
            $.each(info_adicionales, function(m, n) {

                if(filtro!=undefined){

                    if( n.nombre.toLowerCase().includes(filtro.toLowerCase()) ){

                        str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"    idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> ';

                        if(n.categoriaServicio.id==1){                    

                            str_remp=str_remp+'<div><h2>Cantidad disponible: <span class="badge bg-success">'+n.disponibilidadCasilleros.disponibles+'</span></h2></div>';

                            
                        }
                        
                        str_remp=str_remp+'</div>     </div>      </div>';

                    }

                }else{

                        str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"    idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> ';

                        if(n.categoriaServicio.id==1){

                            str_remp=str_remp+'<div><h2>Cantidad disponible: <span class="badge bg-success">'+n.disponibilidadCasilleros.disponibles+'</span></h2></div>';

                            
                        }

                        str_remp=str_remp+' </div>     </div>      </div>';
                }
        
                
                    
                

                    
            
            });

                str_remp=str_remp+'</div> '

                //console.log(str_remp);
                $("#boletas").html(str_remp);

        }

        
        
    }

    function validar_cliente(tipo_documento,numero_documento){
        //console.log("Validare el cliente");
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '9',tipo_identificacion:tipo_documento,numero_documento:numero_documento },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r2) { 
                
                

                if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                    if(typeof r2.resultado.status === 'undefined'){
                        //console.log(r2['resultado'][0])

                        var nombre=r2['resultado'][0]['nombreCompleto'];

                        var email =r2['resultado'][0]['email'];

                        var telefono= r2['resultado'][0]['telefono'];

                        var identificacion_cliente=r2['resultado'][0]['identificacion']['numero'];

                        $("#nombre").val(nombre);
                        $("#email").val(email);
                        $("#telefono").val(telefono);

                        $("#numero_documento").attr('readonly', true);
                        $("#tipo_documento").attr('readonly', true);
                        $("#nombre").attr('readonly', true);
                        $("#email").attr('readonly', true);
                        $("#telefono").attr('readonly', true);

                        localStorage.setItem('identificacion_cliente',identificacion_cliente)
                        localStorage.setItem('tipo_identificacion_cliente',tipo_documento)

                        //Aqui consulto si tiene una reserva para el dia de hoy

                        $.ajax({        
                            url: "ajax/ajxRequest.php",
                            data: { op: '14',tipo_identificacion:tipo_documento,numero_identificacion:numero_documento },
                            dataType: 'json',
                            type: 'POST',
                            //async: false,
                            success: function(r3) { 
                    
                            //  console.log(r3.resultado.id)
                                localStorage.setItem("idreserva", r3.resultado.id)
                                
                    
                                if (r3.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                    //alert("Cliente tiene Reserva")                                          
                                
                                }else{
                                    //alert("Error al crear la reserva")
                                }
                            }        
                        });

                    
                    }else{
                        //console.log(r2.resultado.status);
                    // console.log("No encontrado")
                        $("#numero_documento").attr('readonly', false);
                        $("#tipo_documento").attr('readonly', false);
                        $("#nombre").attr('readonly', false);
                        $("#email").attr('readonly', false);
                        $("#telefono").attr('readonly', false);

                        $("#nombre").val('');
                        $("#email").val('');
                        $("#telefono").val('');
                    }                                            
                
                }else{
                    
                }
            }        
        }); 



    }


    function crear_cliente(){



        var identificacion_cliente=localStorage.getItem('identificacion_cliente');
    var tipo_identificacion_cliente=localStorage.getItem('tipo_identificacion_cliente');

    //console.log("identificacion_cliente:"+identificacion_cliente+" , tipo_identificacion_cliente:"+tipo_identificacion_cliente);

    if(identificacion_cliente==null && tipo_identificacion_cliente==null){
        //alert("Debo crear el cliente***")

        //console.log("Entraaaaaaa *****")

        var numero_documento = $("#numero_documento").val();
        var tipo_documento = $("#tipo_documento").val();
        var nombre = $("#nombre").val();
        var email = $("#email").val();
        var telefono = $("#telefono").val();

        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '11',tipo_identificacion:tipo_documento,numero_documento:numero_documento,nombre:nombre,email:email,telefono:telefono },
            dataType: 'json',
            async: false, 
            type: 'POST',
            //async: false,
            success: function(r2) { 

                //console.log("Creo el clinete")
                
                console.log(r2)

                if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                    //alert("Cliente creado exitosamente")                                          
                
                }else{
                    alert("Error al crear el cliente")
                }
            }        
        }); 


    }else{
        //alert("Cliente ya existe");
    }




    }






    function pagar(){

        //alert("Entroo")
        //valida si el cliente existe, de lo contrario lo crea
        crear_cliente();

        var url_pdf="exportar/reserva/reserva_pdf2.php";


        //armo los arrays que voy a enviar

        var arr_boletas= JSON.parse( localStorage.getItem('boletas_nombres'));

        let new_array=[];

        $.each(arr_boletas, function(index, datos) {


            let new_sub_array=[];
            var c=0;
            if(datos['cant_taquilla']>0){
            
                new_array.push({cantidad: datos['cant_taquilla'], idTipoBoleta: datos['id']});
    
            }

        });

        let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));
        let array_medios_pago=[];

        $.each(metodosPago, function(index, datos) {
            if(datos['valorPago']>0){

                if(datos['numeroAutorizacion']>0 && datos['ultimosDigitos']>0){
                    array_medios_pago.push({idMetodoPago: datos['id'], valor: datos['valorPago'],numeroAutorizacion:datos['numeroAutorizacion'], ultimosDigitos:datos['ultimosDigitos'] });
                }else{
                    array_medios_pago.push({idMetodoPago: datos['id'], valor: datos['valorPago']});
                }
            
                
    
            }
        });


        console.log(array_medios_pago);
         




        var arr_adicionales= JSON.parse( localStorage.getItem('adicionales_nombres'));

        let new_array_adicionales=[];

        var cont_lockers=0;

        $.each(arr_adicionales, function(index, datos) {


            let new_sub_array=[];
            var c=0;
            if(datos['cant_taquilla']>0){

            
                new_array_adicionales.push({cantidad: datos['cant_taquilla'], idServicioAdicional: datos['id']});
    
                if(datos['categoriaServicio']['id']==1){
                    cont_lockers=datos['cant_taquilla'];
                }

            }

        });


        //console.log("Esta a punto de reservar :"+cont_lockers+" Lockers")

        //return(false);

    // console.log("longitud array completo")

    // console.log(new_array.length)

        if(new_array.length==0 ){
            //solo envio adicionales, entonces debo capturar la reserva
            if(new_array_adicionales.length>0){
                var idreserva=localStorage.getItem('idreserva')
                //console.log("Reserva:"+idreserva)
                if(idreserva!="undefined"){

                    $.ajax({        
                        url: "ajax/ajxRequest2.php",
                        data: { op: '13',idreserva:idreserva,adicionales:JSON.stringify(new_array_adicionales),cont_lockers:cont_lockers },
                        dataType: 'json',
                        async: false, 
                        type: 'POST',
                        //async: false,
                        success: function(r3) { 

                            if (r3.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                //alert(r3.resultado.message) 
                                window.open(url_pdf+'?idreserva='+idreserva, '_blank');
                                location.reload();
                                location.reload();                                      
                            
                            }else{
                                alert("Error al crear la reserva")
                                location.reload();
                            }
                        }        
                    }); 


                }else{
                    alert("No se puede continuar con la venta ya que el usuario no tiene una reserva");
                    return(false);
                }
            }


        }else{
        // console.log("Paso por aca")
            //lanzo la peticion de crear la reserva
            var numero_documento = $("#numero_documento").val();
            var tipo_documento   = $("#tipo_documento").val();

            var boletas_enviar=JSON.stringify(new_array)

        // console.log(new_array)

            $.ajax({        
                url: "ajax/ajxRequest2.php",
                data: { op: '12',tipo_identificacion:tipo_documento,numero_documento:numero_documento,boletas:JSON.stringify(new_array),pagos: JSON.stringify(array_medios_pago)},
                dataType: 'json',
                async: false, 
                type: 'POST',
                //async: false,
                success: function(r2) {
                    
                    
                    
                    //console.log(r2)
        
                    if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                        //alert(r2.resultado.message+" "+r2.resultado.id) 

                        
                        
                    // console.log("new_array_adicionales")
                    // console.log(new_array_adicionales)

                        if(new_array_adicionales.length>0){

                            $.ajax({        
                                url: "ajax/ajxRequest2.php",
                                data: { op: '13',idreserva:r2.resultado.id,adicionales:JSON.stringify(new_array_adicionales),cont_lockers:cont_lockers },
                                dataType: 'json',
                                type: 'POST',
                                async: false, 
                                //async: false,
                                success: function(r3) { 
                        
                                    
                                    
                                //  console.log(r3)
                        
                                    if (r3.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                        //alert("Reserva: "+r2.resultado.id+" A nombre de:"+$("#nombre").val()+" Creada con exito!") 
                                        window.open(url_pdf+'?idreserva='+r2.resultado.id, '_blank');
                                        location.reload();
                                        //location.reload();                                      
                                    
                                    }else{
                                        alert("Error al crear la reserva")
                                        //location.reload();
                                    }
                                }        
                            });

                        }else{
                            //alert("Reserva: "+r2.resultado.id+" A nombre de:"+$("#nombre").val()+" Creada con exito!")           
                            window.open(url_pdf+'?idreserva='+r2.resultado.id, '_blank');
                            location.reload();
                        }

                    
                    }else{
                        alert(r2.resultado.message)
                    }
                }        
            });



        }




        
        



    }


function listarMetodosPago(){


    let metodosPago= JSON.parse( localStorage.getItem('metodosPago'));

    let strMediosPago='<table class="table"> <tbody>';

    $.each(metodosPago, function(index, datos) {

        //console.log(datos);

        if(datos['valorPago']>0){
            console.log("Imprimo:")
            console.log(datos)

            strMediosPago+='<tr> <td>'+datos['nombre']+'</td> <td> <span class="badge badge-success rounded-pill">$'+datos['valorPago'].toLocaleString()+'</span> </td> <td><img src="imagenes/menos.svg" id="'+datos['id']+'"   class="eliminarMedioPago" style="cursor:pointer"   alt=""></td> </tr>'


        }//if >0

    });

    strMediosPago+='</tbody> </table> <div class="text-right pt-5" id="btn-pagar" ></div> ';

    $("#divMediosPago").html(strMediosPago);

    



}