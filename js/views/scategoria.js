//Variables Globales
var myArray = new Array();
var scDatos = new Array();
var nRegistros;  

  
function cargar_datos_scategoria(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '28' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    let i = 0;                                   
                    let str_remp;
                    let option = '<option value="0">Seleccione una categoria</option>';
                    $.each(r2.resultado, function(m, n) {
                        scDatos[i] = n.nombre;
                        i++;
                        if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        let atraccion_comilla = "'"+n.nombre+"'";
                        let idCheck = 'categ'+'-'+n.estado+'-'+n.id;
                        let btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/editar.png" class="img-fluid title="Editar" onclick="upScategoria('+ n.id +','+ atraccion_comilla +');"></a>' : '<img src="imagenes/editar_no.png" class="img-fluid title="Editar">';
                        let ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div>'+ btnEditar +'</div></td>'+
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
                    $("#tbody_scategoria").html(str_remp);
                    $('#select_sadicional').html(option);
                    $('#selectup_sadicional').html(option);
                    restaurar_paginacion('myPager_scategoria');
                    $('#tbody_scategoria').pageMe({pagerSelector:'#myPager_scategoria',showPrevNext:true,hidePageNumbers:false,perPage:20});

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}
//
function abreModalScategoria(){
    limpiarGuardarCatServicio('txtAddScategoria');
    $('#addModalScategoria').modal('show'); // abrir modal agregar condición de acceso 
} 
//
function abreModalActiDesactivaScategoria(){
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].name != 'scategoria_todos'){ //solo si es un checkbox entramos y si es true 
            let cadena = checkboxes[i].name;
            let arr = cadena.split('-');
            if(arr[0] == 'categ'){                
                myArray[x] = checkboxes[i].name;
                x++; 
            }                     
        }
    }    
    if(x == 0){
        $("#p_cant_scategoria").html("No se ha seleccionado ninguna categoria del serivicio adicional");               
    }else{
        if(x == 1){
            $("#p_cant_scategoria").html("Est\u00E1 seguro de Activar/Desactivar "+x+" categoria del serivicio adicional?"); 
        }else{
            $("#p_cant_scategoria").html("Est\u00E1 seguro de Activar/Desactivar "+x+" categoria del serivicio adicional?"); 
        }        
    }
    //
    $('#estadoModalScategoria').modal('show'); // abrir modal actualizar estado atraccion    		
}
//
function upScategoria(id_cat, nombre_cat){
    limpiarGuardarCatServicio('txtAddScategoria');    
    console.log(id_cat);    
    $("#txtupIdScategoria").val(id_cat);
    $("#txtupScategoria").val(nombre_cat);
    $('#upModalScategoria').modal('show'); // abrir modal  
}
//
function adicionarScategoria(nombre){
    let respr = nombres_igual(nombre, scDatos);
    if(respr == 0){
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '29', nombre: nombre },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    //alert('Guardo');
                    $('#addModalScategoria').modal('hide'); // oculta modal agregar atraccion
                    limpiarGuardarCatServicio('txtAddScategoria');
    				cargar_datos_scategoria();              
                }else{
                    alert('Error al guardar');
                }
            }        
        });
    }else{
        alert('El nombre de la categoria del servicio: '+nombre+', ya existe');
    }
}
//
function btnADCscategoria(){
    //
    if(myArray.length){ 
        console.log(JSON.stringify(myArray));    
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '31', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalScategoria').modal('hide'); // se oculta modal                
                    cargar_datos_scategoria();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n de acceso');
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
function limpiarGuardarCatServicio(txt){
    txt = '#'+txt;    
    $(txt).val(''); // Limpia campo nombre Categoria del servicio adicional     
}
//
function actualizarScategoria(id, nombre){
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '30', id: id, nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalScategoria').modal('hide'); // se oculta modal                
                cargar_datos_scategoria();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
