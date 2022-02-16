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

function cargar_datos_taquilla(){
    console.log('Cargar datos'); 
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

                    localStorage.setItem('boletas_nombres',JSON.stringify(r2['resultado']))
                    //console.log();
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensi�n para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                        //var atraccion_comilla = "'"+atracciones.nombre+"'";
                        /*var ver_imagen = '<img id="imagen' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox"></h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h2></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/+.png"></div></td>'+										
                            '</tr>';*/
                            
                            

                            str_remp=str_remp+'<div class="col-lg-4 p-2 " > <div >   <img class="eye boleta-info informacion" idboleta="'+n.id+'" src="imagenes/info.png" align="right" style="cursor:pointer" width="15%" alt=""/> </div>  <div class="sombra2 panel2 boleta-add"    idboleta="'+n.id+'" style="padding: 0px;" >         <div style="background: #ffffff; height: 120px; border-radius: 20px 20px;"> <div class="pt-3 d-flex justify-content-end pr-2 centrado"> <img src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="150" height="130" style="border-radius:10px;" class="card-img-top" alt="">  </div> </div> <div class="p-2"> <h4 class="pt-2">'+n.nombre +'</h4> <div><h2>$'+n.precio.toLocaleString()+'</h2></div> </div>     </div>      </div>';
                    });				             
                    str_remp=str_remp+'</div> '

                    //console.log(str_remp);
                    $("#boletas").html(str_remp);
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
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

                    localStorage.setItem('identificacion_cliente',identificacion_cliente)
                   
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    }); 



}