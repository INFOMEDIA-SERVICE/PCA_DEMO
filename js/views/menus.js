//Variables Globales
var myArray_precepcion = new Array();
var aDatos = new Array();
var aDatosSub = new Array();
var nRegistros;  

  
function cargar_datos_menus(){

    let str_remp; 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '54' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA 
                i = 0;              
                var select_menus = ' <select class="selectAltura" name="menuPadre" id="menuPadre" > ';
                var select_menus_add = ' <select class="selectAltura" name="menuPadreAdd" id="menuPadreAdd" > ';
                $.each(r2.resultado, function(m, n) {
                    aDatos[i] = n.nombre;
                     
                    i++;
                    if(n.estado == 'ACTIVO'){ 
                        select_menus += '<option value="' + n.id + '">' + n.nombre + '</option>'; 
                        select_menus_add += '<option value="' + n.id + '">' + n.nombre + '</option>'; 
                    }
                    var nombre_comilla = "'"+n.nombre+"'";
                    var idCheck = 'precep'+'-'+n.estado+'-'+n.id;
                    var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/editar.png" class="img-fluid title="Editar" onclick="upMenu('+ n.id +','+ nombre_comilla +');"></a>' : '<img src="imagenes/editar_no.png" class="img-fluid title="Editar">';
                    var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                    str_remp += '<tr class="row py-3">' +
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div>'+ btnEditar +'</div></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>' + n.estado + '</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                									
                        '</tr>';				
                });   
                select_menus+='</select>';
                select_menus_add+='</select>'; 
                $("#menu_padre").html(select_menus);
                $("#menuPadreAddDiv").html(select_menus_add)                                    
            }else{
                str_remp += '<tr class="row py-3">' +
                            '<td  colspan="10" class="justify-content-center">'+ r2.msg +'</td>'+                                                                                                     
                            '</tr>';        
            }
            $("#tbody_menus").html(str_remp);
                 
                 
        }        
    });    
}

function cargar_datos_subMenus(){

    let str_remp; 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '57' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA 
                i = 0;              
                var option; // = '<option value="0">Seleccione recepci\u00F3n pago</option>';
                $.each(r2.resultado, function(m, n) {
                    aDatosSub[i] = n.nombre;
                    i++;
                    if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                    var nombre_comilla = "'"+n.nombre+"'";
                    var idCheck = 'precep'+'-'+n.estado+'-'+n.id;
                    var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/editar.png" class="img-fluid title="Editar" onclick="upSubMenu('+ n.id +','+ nombre_comilla +');"></a>' : '<img src="imagenes/editar_no.png" class="img-fluid title="Editar">';
                    var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                    str_remp += '<tr class="row py-3">' +
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div>'+ btnEditar +'</div></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4> Taquilla </h4></td>'+
                            '<td class="col-2 d-flex align-items-center justify-content-center"><h4>' + n.menuInfo.url + '</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>' + n.estado + '</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                            //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                									
                        '</tr>';				
                });                                        
            }else{
                str_remp += '<tr class="row py-3">' +
                            '<td  colspan="10" class="justify-content-center">'+ r2.msg +'</td>'+                                                                                                     
                            '</tr>';        
            }
            $("#tbody_subMenus").html(str_remp);
                 
                 
        }        
    });    
}
//
function abreModalMenus(){
     
    $('#addModalMenu').modal('show'); // abrir modal agregar condición de acceso 
} 


function abreModalSubMenus(){
     
    $('#addModalSubMenu').modal('show'); // abrir modal agregar condición de acceso 
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
function upMenu(id_pm, nombre_pm){
    limpiarGuardarPrecepcion('txtupMenu');    
    //    
    $("#txtupIdMenu").val(id_pm);
    $("#txtupMenu").val(nombre_pm);
    $('#upModalMenu').modal('show'); // abrir modal  
}

function upSubMenu(id_pm, nombre_pm){
    limpiarGuardarPrecepcion('txtupMenu');    
    //    
    $("#txtupIdSubMenu").val(id_pm);
    $("#txtupSubMenu").val(nombre_pm);
    $('#upModalSubMenu').modal('show'); // abrir modal  
}
//
function adicionarMenu(nombre){
    let respr = nombres_igual(nombre, aDatos);
    if(respr == 0){
        $.ajax({        
            url: "ajax/ajxRequest2.php",
            data: { op: '55', nombre: nombre },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    //alert('Guardo');
                    $('#addModalMenu').modal('hide'); // oculta modal agregar atraccion
                    limpiarGuardarPrecepcion('nombreMenu');
    				cargar_datos_menus();              
                }else{
                    alert('Error al guardar');
                }
            }        
        });
    }else{
        alert('El nombre de la recepci\u00F3n: '+nombre+', ya existe');
    }    
}



function adicionarSubMenu(nombre,url,idMenuPadre){
    let respr = nombres_igual(nombre, aDatosSub);
    if(respr == 0){
        $.ajax({        
            url: "ajax/ajxRequest2.php",
            data: { op: '58', nombre: nombre, url:url, idMenuPadre:idMenuPadre },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    //alert('Guardo');
                    $('#addModalSubMenu').modal('hide'); // oculta modal agregar atraccion
                    limpiarGuardarPrecepcion('subMenuAdd');
                    limpiarGuardarPrecepcion('urlSubMenuAdd');
    				cargar_datos_subMenus();              
                }else{
                    alert('Error al guardar');
                }
            }        
        });
    }else{
        alert('El nombre de la recepci\u00F3n: '+nombre+', ya existe');
    }    
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
function actualizarMenu(id, nombre){
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '56', id: id, nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalMenu').modal('hide'); // se oculta modal                
                cargar_datos_menus();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
