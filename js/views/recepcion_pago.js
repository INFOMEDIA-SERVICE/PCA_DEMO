//Variables Globales
var myArray_precepcion = new Array();
var nRegistros;  

  
function cargar_datos_precepcion(){
    let str_remp; 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '35' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA               
                var option; // = '<option value="0">Seleccione recepci\u00F3n pago</option>';
                $.each(r2.resultado, function(m, n) {
                    //console.log(n);
                    if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                    var nombre_comilla = "'"+n.nombre+"'";
                    var idCheck = 'precep'+'-'+n.estado+'-'+n.id;
                    var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upPrecepcion('+ n.id +','+ nombre_comilla +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                    var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                    str_remp += '<tr class="row py-3">' +
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                            '<td class="col-2 d-flex align-items-center justify-content-center">' + n.estado + '</td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                									
                        '</tr>';				
                });                                        
            }else{
                str_remp += '<tr class="row py-3">' +
                            '<td  colspan="10" class="justify-content-center">'+ r2.msg +'</td>'+                                                                                                     
                            '</tr>';        
            }
            $("#tbody_precepcion").html(str_remp);
                $('#select_precepcion').html(option);
                $('#select_up_precepcion').html(option);
                restaurar_paginacion('myPager_precepcion');
                $('#tbody_scategoria').pageMe({pagerSelector:'#myPager_precepcion',showPrevNext:true,hidePageNumbers:false,perPage:20}); 
        }        
    });    
}
//
function abreModalPrecepcion(){
    limpiarGuardarPrecepcion('txtAddPrecepcion');
    $('#addModalPrecepcion').modal('show'); // abrir modal agregar condición de acceso 
} 
//
function abreModalActiDesactivaPrecepcion(){
    var x = 0;
    var str_remp2;
    myArray_precepcion = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].name != 'precepcion_todos'){ //solo si es un checkbox entramos y si es true 
            let cadena = checkboxes[i].name;
            let arr = cadena.split('-');
            if(arr[0] == 'precep'){                
                myArray_precepcion[x] = checkboxes[i].name;
                x++; 
            }                     
        }
    }    
    if(x == 0){
        $("#p_cant_precepcion").html("No se ha seleccionado ninguna recepci\u00F3n de pago");               
    }else{
        if(x == 1){
            $("#p_cant_precepcion").html("Est\u00E1 seguro de Activar/Desactivar "+x+" recepci\u00F3n de pago?"); 
        }else{
            $("#p_cant_precepcion").html("Est\u00E1 seguro de Activar/Desactivar "+x+" recepci\u00F3n de pago?"); 
        }        
    }
    //
    $('#estadoModalPrecepcion').modal('show'); // abrir modal actualizar estado atraccion    		
}
//
function upPrecepcion(id_pm, nombre_pm){
    limpiarGuardarPrecepcion('txtupIPrecepcion');    
    //    
    $("#txtupIPrecepcion").val(id_pm);
    $("#txtupPrecepcion").val(nombre_pm);
    $('#upModalPrecepcion').modal('show'); // abrir modal  
}
//
function adicionarPrecepcion(nombre){
    //
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '37', nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalPrecepcion').modal('hide'); // oculta modal agregar atraccion
                limpiarGuardarPrecepcion('txtAddPrecepcion');
				cargar_datos_precepcion();              
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}
//
function btnADPrecepcion(){
    //
    if(myArray_precepcion.length){ 
        console.log(JSON.stringify(myArray_precepcion));    
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '40', id: JSON.stringify(myArray_precepcion) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalPrecepcion').modal('hide'); // se oculta modal                
                    cargar_datos_precepcion();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna recepci\u00F3n de pago');
    } 
}
//
$('#btnDesactivarCacceso').click(function(){
    var id_d = $("#txtDelIdAtraccion").val();
    if(id_d == '' || id_d == null || typeof id_d == 'undefined'){
        console.log('No tiene permsiso para desactivar');
    }else{
        desactivarAtraccion(id_d);
    }		
});
//
$('#btnActivarAtraccion').click(function(){
    var id_activar = $("#txtActIdAtraccion").val();
    if(id_activar == '' || id_activar == null || typeof id_activar == 'undefined'){
        console.log('No tiene permsiso para Acivar');
    }else{
        activarAtraccion(id_activar);
    }		
});
//
function limpiarGuardarPrecepcion(txt){
    txt = '#'+txt;    
    $(txt).val(''); // Limpia campo nombre Categoria del servicio adicional     
}
//
function actualizarPrecepcion(id, nombre){
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '39', id: id, nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalPrecepcion').modal('hide'); // se oculta modal                
                cargar_datos_precepcion();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
