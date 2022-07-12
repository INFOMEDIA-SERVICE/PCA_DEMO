//Variables Globales
var myArray = new Array();
var nRegistros;

 

function buscarDisponibilidades(fecha_desde,fecha_hasta,tipoBoleta,cant_reg_disponibilidad,page){

    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '52' , fecha_desde:fecha_desde,fecha_hasta:fecha_hasta,tipoBoleta:tipoBoleta,size:cant_reg_disponibilidad,page:page },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    //console.log(r2)
                    $.each(r2.resultado, function(m, n) {
                         
                        
                        var idCheck = n.id;
                        var boleta_comilla = "'"+n.tipoBoleta.nombre+"'";
                        var fecha_comilla = "'"+n.fecha+"'";
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upDisponibilidad('+ n.id +','+boleta_comilla+','+fecha_comilla+' , '+n.cantidadMax+');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
            
    
                        
                        str_remp += '<tr class="row py-3" style="height:50px;">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p><input type="checkbox" class="boleta" name="'+idCheck+'"> / '+ n.id +'</p></td>'+
                                
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+ n.tipoBoleta.nombre +'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+ n.fecha +'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+ n.cantidadMax +'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p> '+n.cantidadReservada+' </p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p> '+n.cantidadDisponible+' </p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+n.creadoPor+'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+n.fechaCreado+'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+n.modificadoPor+'</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>' + n.fechaModificado + '</p></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><p>'+ n.estado +'</p></td>'+ 									
                            '</tr>';				
                    });				             
                    $("#tbody_disponibilidades").html(str_remp);
                    
                    $("#cant_pags").html("Pag. "+r2.pag_consulta+" de: "+r2.cant_pags)
                   // restaurar_paginacion('myPager');                     
                   // $('#tbody_atraccion').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:20});
    
                     
    
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });

}

function cargar_datos_disponibilidad(){

    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '33' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    //console.log('CORRECTO 200');                
                   
                    var option = '<select id="select_tipo_boleta"><option value="0">Seleccione un Tipo de Boleta</option>';
                    var option2 = '<select id="select_tipo_boleta2"><option value="0">Seleccione un Tipo de Boleta</option>';
                    $.each(r2.resultado, function(m, n) {
                        
                        if(n.estado == 'ACTIVO'){ 
                            option += '<option value="' + n.id + '">' + n.nombre + '</option>';
                            option2 += '<option value="' + n.id + '">' + n.nombre + '</option>';
                         }
                        				
                    });				             
                    option+='</select>';
                    option2+='</select>';
                    $('#div_select_tipo_boleta').html(option); 
                    $('#div_select_tipo_boleta2').html(option2); 
                    
                   

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });
}

 


function guardarDisponibilidad(tipo_boleta,fecha_desde,fecha_hasta,cantidad){
    
    //console.log(imagen);
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '51', tipo_boleta:tipo_boleta,fecha_desde:fecha_desde,fecha_hasta:fecha_hasta,cantidad:cantidad },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            //console.log(r);           
           if (r.sts == 'OK') {
                //alert('Guardo');
                //$('#addModalAtraccion').modal('hide'); // oculta modal agregar atraccion
               // limpiarGuardarBoletas();
				//cargar_datos_boleteria(); 
                $("#div_resultado").html('') 
                alert("Disponibilidad creada con exito");   
                         
            }else  if (r.sts == 'CSV') {



                window.open("disponibilidad_excel.php", '_blank');

                $("#div_resultado").html('<br><br><div class="alert alert-danger" role="alert">Algunas disponibilidades no puedieron ser Asignadas, a continuación podra validarlas en el Excel que se acaba de descargar!! </div>')
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}

 
 
function upDisponibilidad(id_u, tipoBoleta,fecha,cantidadMax){
    		
    $("#txtupIdDisponibilidad").val(id_u);
    $("#txtTipoBoleta").val(tipoBoleta);
    $('#txtTipoBoleta').attr('readonly', true);
    $("#txtFecha").val(fecha);
    $('#txtFecha').attr('readonly', true);

    $("#cantMaximaUpd").val(cantidadMax);



    $('#upModalDisponibilidad').modal('show'); // abrir modal  
}

 

 

function actualizarDisponibilidad(id, cantidadMax){
     
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '53', id: id, cantidadMax:cantidadMax },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            //console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalDisponibilidad').modal('hide'); // se oculta modal                
                cargar_datos_disponibilidad();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}

 