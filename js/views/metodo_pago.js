//Variables Globales
var myArray = new Array();
var nRegistros;

  
function cargar_datos_pmetodo(){
    // 
    var str_remp;
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '36' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                                 
                $.each(r2.resultado, function(m, n) {
                    //console.log(n);                    
                    var recepcionp = '';
                    var myArray_recepcionp = new Array();
                    $.each(n.recepcionPago, function(y, x) {
                        recepcionp += x.nombre + "<br/>";
                        myArray_recepcionp[y] = x.id;                                             
                    });                    
                    let nombre_comilla = "'"+n.nombre+"'";
                    let tipo_comilla = "'"+n.tipo+"'";
                    let idCheck = 'sadi'+'-'+n.estado+'-'+n.id;
                    let btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upPmetodo('+ n.id +','+ nombre_comilla +','+ n.cuentaDestino +','+ tipo_comilla +','+ n.requiereDatosAutorizacion +', '+ JSON.stringify(myArray_recepcionp) +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                    let ver_imagen = '<img id="imagen' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                    str_remp += '<tr class="row py-3">' +
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                            '<td class="col-2 d-flex align-items-center justify-content-center"><h4>'+ n.cuentaDestino +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.tipo +'</h4></td>'+
                            '<td class="col-2 d-flex align-items-center justify-content-center">' + n.requiereDatosAutorizacion + '</td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ recepcionp +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['creadoPor'] +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['fechaCreado'] +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['modificadoPor'] +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['fechaModificado'] +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                										
                        '</tr>';				
                });                       
            }else{
                    str_remp += '<tr class="row py-3">' +
                                '<td  colspan="10" class="justify-content-center">'+ r2.msg +'</td>'+                                                                                                     
                                '</tr>';        
            }
            $("#tbody_pmetodo").html(str_remp);
            restaurar_paginacion('myPager_pmetodo');                     
            $('#tbody_pmetodo').pageMe({pagerSelector:'#myPager_pmetodo',showPrevNext:true,hidePageNumbers:false,perPage:20});    
        }        
    });    
}
//
function abreModalPmetodo(){
    limpiarModalPmetodo('txtAddAtraccion', 'file', 'result', 'img');
    $('#addModalPmetodo').modal('show'); // abrir modal agregar atraccion 
} 
//
function abreModalActiDesactivaSadicional(){
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].name != 'sadicionales_todos'){ //solo si es un checkbox entramos y si es true 
            let cadena = checkboxes[i].name;
            let arr = cadena.split('-');
            if(arr[0] == 'sadi'){              
                myArray[x] = checkboxes[i].name;
                x++;
            }
        }
    }    
    if(x == 0){
        $("#p_cant_sadicional").html("No se ha seleccionado ning\u00FAn servicio adicional");               
    }else{
        //$("#tbody_modal_atraccion").html(str_remp2);
        if(x == 1){
            $("#p_cant_sadicional").html("Est\u00E1 seguro de Activar/Desactivar "+x+" servicio adicional?"); 
        }else{
            $("#p_cant_sadicional").html("Est\u00E1 seguro de Activar/Desactivar "+x+" servicios adicionales?"); 
        }
        
    }
    //
    $('#estadoModalSadicional').modal('show'); // abrir modal actualizar estado atraccion    		
}
//
function upPmetodo(id_pm, nombre_pm, cuentad_pm, tipo_pm, requiereauto_pm, arr_precepcion){
    //limpiarModalPmetodo('txtupSadicional', 'fileup_sadicional', 'result2', 'imgup_sadicional');
    //			
    $("#txtupIdPmetodo").val(id_pm);
    $("#txtUpPMnombre").val(nombre_pm);
    $("#txtUpPMcuentad").val(cuentad_pm);
    $("#select_up_pmtipo").val(tipo_pm);
    $("#select_up_precepcion").val(arr_precepcion);
    $('#chkUpPMautorizado').prop('checked', requiereauto_pm);
    //Copia
    //$("#txtupIdSadicional2").val(idsa);
    //$("#txtupSadicional2").val(nombresa);
    //$("#txtupPrecio2").val(preciosa);
    //$("#selectup_sadicional2").val(idcategosa);
    //
    $('#upModalPmetodo').modal('show'); // abrir modal  
} 
//
function adicionarPmetodo(nombre, cuenta, tipo, recep, chk){
    let sin_idrecepcion = quitar_comilla(recep);
    //
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '38', nombre: nombre, cuenta: cuenta, tipo: tipo, recep: JSON.stringify(sin_idrecepcion), chk: chk }, //JSON.stringify(recep)
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                $('#addModalPmetodo').modal('hide'); // oculta modal agregar atraccion                
				cargar_datos_pmetodo();              
            }else{
                alert('Error al guardar');
            }
        }        
    });   
}
//
function btnADSadicional(){ 
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '34', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalSadicional').modal('hide'); // se oculta modal                
                    cargar_datos_pmetodo();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna atraccion');
    } 
}
//
$('#btnDesactivarAtraccion').click(function(){
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
function limpiarModalPmetodo(txt, fil, resul, imagen){
    txt = '#'+txt;
    fil = '#'+fil;
    $(txt).val(''); // Limpia campo nombre atraccion
    $(fil).val(''); //    
}
//
/*function actualizarPmetodo(id, nombre, cuentad, tipo, recepcion, chk){
    if(nombre == 0 && cuentad == 0 && tipo == 0 && recepcion == 0 && chk == 0){
        alert('No hay cambios para actualizar');        
    }else{
        if(ext != 0){ ext = ext.toUpperCase(); }   //Convierte a mayuscula, si no llega a cero(0)    
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '41', id: id, nombre: nombre, cuentad: cuentad, tipo: tipo, recepcion: recepcion, chk: chk },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    $('#upModalSadicional').modal('hide'); // se oculta modal                
                    cargar_datos_pmetodo();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        });   
    }    
}*/
//
//Fin lineas
//