function retornarDatosBoleta(idboleta){
    var json_boletas_nombres=localStorage.getItem('boletas_nombres');
    var arr_boletas_nombres= JSON.parse(json_boletas_nombres);

    console.log('arr_boletas_nombres *****')
    console.log(arr_boletas_nombres)
    var reto='';
    arr_boletas_nombres.forEach(function(boleta, index) {
        
        if(boleta['id']==idboleta){
          reto= boleta
        }

       
     });

     return(reto);

  } 

function cargar_datos_taquilla(filtro){
    console.log('Cargar datos'); 

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
                        console.log('CORRECTO 200');
                        console.log(r2)                
                        var str_remp='';
    
                        let productos = [];
    
                        //localStorage.setItem('boletas_nombres',JSON.stringify(r2['resultado']))
                        //console.log();
                        $.each(r2.resultado, function(m, n) {
    
                            n.cant_taquilla=0;
                            n.tipo_producto="boleta";
    
                            let nuevaLongitud = productos.push(n)
    
                                str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
                        
                            });
                            
                            //console.log('array_productos')
    
                            //console.log(productos);
    
                            localStorage.setItem('boletas_nombres',JSON.stringify(productos))
                            
                            str_remp=str_remp+'</div> '
    
                            //console.log(str_remp);
                            $("#boletas").html(str_remp);
                    }else{
                        console.log(r2.resultado.status);
                    }                                            
                   
                }
            }        
        });


    }else{
        //console.log("El array tiene datos")

        console.log("filtro:"+filtro)


        str_remp ='';
        $.each(info_boletas, function(m, n) {
    
            if(filtro!=undefined){

                if( n.nombre.toLowerCase().includes(filtro.toLowerCase()) ){
                    //console.log("Coincide con:"+n.nombre)
    
                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
    
                }

            }else{
                str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
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
            url: "ajax/ajxRequest.php",
            data: { op: '10' },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r2) {            
                if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                    if(typeof r2.resultado.status === 'undefined'){
                        console.log('CORRECTO 200');
                        console.log(r2)                
                        var str_remp='';
    
                        let productos = [];
    
                         
                        $.each(r2.resultado, function(m, n) {
    
                            n.cant_taquilla=0;
                            n.tipo_producto="adicional";
    
                            let nuevaLongitud = productos.push(n)
    
                                str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"    idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
                        
                            });
                            
                            //console.log('array_productos')
    
                            //console.log(productos);
    
                            localStorage.setItem('adicionales_nombres',JSON.stringify(productos))
                            
                            str_remp=str_remp+'</div> '
    
                            //console.log(str_remp);
                            $("#boletas").html(str_remp);
                    }else{
                        console.log(r2.resultado.status);
                    }                                            
                   
                }
            }        
        });

    }else{

        console.log("filtro ***:"+filtro)

        var str_remp='';
        $.each(info_adicionales, function(m, n) {

            if(filtro!=undefined){

                if( n.nombre.toLowerCase().includes(filtro.toLowerCase()) ){

                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"    idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';

                }

            }else{

                    str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye adicional-info informacion" idadicional="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 adicional-add"    idadicional="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
            }
    
            
                
            

                
        
        });

            str_remp=str_remp+'</div> '

            //console.log(str_remp);
            $("#boletas").html(str_remp);

    }

    
    
}

function validar_cliente(tipo_documento,numero_documento){
    console.log("Validare el cliente");
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '9',tipo_identificacion:tipo_documento,numero_documento:numero_documento },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) { 
            
            

            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log(r2['resultado'][0])

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
                
                            console.log("id:"+r3.id)
                            
                
                            if (r3.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                alert("Cliente tiene Reserva")                                          
                               
                            }else{
                                //alert("Error al crear la reserva")
                            }
                        }        
                    });

                   
                }else{
                    //console.log(r2.resultado.status);
                    console.log("No encontrado")
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

console.log("identificacion_cliente:"+identificacion_cliente+" , tipo_identificacion_cliente:"+tipo_identificacion_cliente);

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
        type: 'POST',
        //async: false,
        success: function(r2) { 

            console.log("Creo el clinete")
            
            console.log(r2)

            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                alert("Cliente creado exitosamente")                                          
               
            }else{
                alert("Error al crear la reserva")
            }
        }        
    }); 


}else{
    alert("Cliente ya existe");
}




}






function pagar(){

    //alert("Entroo")
    //valida si el cliente existe, de lo contrario lo crea
    crear_cliente();

    var url="exportar/reserva/reserva_pdf.php";


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


    var arr_adicionales= JSON.parse( localStorage.getItem('adicionales_nombres'));

    let new_array_adicionales=[];

    $.each(arr_adicionales, function(index, datos) {


        let new_sub_array=[];
        var c=0;
        if(datos['cant_taquilla']>0){
           
            new_array_adicionales.push({cantidad: datos['cant_taquilla'], idServicioAdicional: datos['id']});
 

        }

    });





    console.log("longitud array completo")

    console.log(new_array.length)

    if(new_array.length==0){
        //solo envio adicionales, entonces debo capturar la reserva


    }else{
        console.log("Paso por aca")
        //lanzo la peticion de crear la reserva
        var numero_documento = $("#numero_documento").val();
        var tipo_documento   = $("#tipo_documento").val();

        var boletas_enviar=JSON.stringify(new_array)

        console.log(new_array)

        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '12',tipo_identificacion:tipo_documento,numero_documento:numero_documento,boletas:JSON.stringify(new_array)},
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r2) {
                
                
                
                console.log(r2)
    
                if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                    alert(r2.resultado.message+" "+r2.resultado.id) 

                    
                    
                    console.log("new_array_adicionales")
                    console.log(new_array_adicionales)

                    if(new_array_adicionales.length>0){

                        $.ajax({        
                            url: "ajax/ajxRequest.php",
                            data: { op: '13',idreserva:r2.resultado.id,adicionales:JSON.stringify(new_array_adicionales) },
                            dataType: 'json',
                            type: 'POST',
                            //async: false,
                            success: function(r3) { 
                    
                                
                                
                                console.log(r3)
                    
                                if (r3.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                    alert(r3.resultado.message) 
                                    window.open(url+'?idreserva='+r2.resultado.id, '_blank');
                                    location.reload();
                                    location.reload();                                      
                                   
                                }else{
                                    alert("Error al crear la reserva")
                                    location.reload();
                                }
                            }        
                        });

                    }else{
                        window.open(url+'?idreserva='+r2.resultado.id, '_blank');
                        location.reload();
                    }

                   
                }else{
                    alert(r2.resultado.message)
                }
            }        
        });



    }




    
    



}