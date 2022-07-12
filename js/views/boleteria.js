//Variables Globales
var myArray = new Array();
var nRegistros;

function cargar_datos_boleteria(size,page){
    console.log('Cargar datos boletas'); 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '33' , size:size,page:page},
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    console.log(r2)
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                       var boleta_comilla = "'"+n.nombre+"'";
                       var descripcion_comilla = "'"+n.descripcion+"'";
                       var precio_comilla =  n.precio;
                        var idCheck = n.nombre+'-'+n.estado+'-'+n.id;
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upBoleta('+ n.id +','+ boleta_comilla +','+ descripcion_comilla +','+ precio_comilla +','+ n.categoriaEdad.id +','+ n.categoriaEstatura.id +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        var btnCondicion = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/+.png" class="img-fluid title="Condiciones de acceso" onclick="abreModalServiciosAdicionales('+ n.id +','+ boleta_comilla +');"></a>' : '<img src="imagenes/+.png" class="img-fluid title="Agregar condiciones">';

                        var btnAtracciones = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/+.png" class="img-fluid title="Atracciones" onclick="abreModalAtracciones('+ n.id +','+ boleta_comilla +');"></a>' : '<img src="imagenes/+.png" class="img-fluid title="Agregar Atracciones">';

                        var ver_imagen = '<img id="imagen' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" class="boleta" name="'+idCheck+'"> / '+ n.id +'</h4></td>'+
                                
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.descripcion +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>$'+ n.precio.toLocaleString() +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaEdad.nombre +': '+n.categoriaEdad.edadInicial+' - '+n.categoriaEdad.edadFinal+' </h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaEstatura.nombre +': '+n.categoriaEstatura.estaturaCmMin+' - '+n.categoriaEstatura.estaturaCmMax
                                +' </h4></td>'+
                                '<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnCondicion +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnAtracciones +'</div></td>'+										
                            '</tr>';				
                    });				             
                    $("#tbody_atraccion").html(str_remp); 
                     
                    $("#cant_pags").html("Pag. "+r2.pag_consulta+" de: "+r2.cant_pags)

                    $.ajax({        
                        url: "ajax/ajxRequest2.php",
                        data: { op: '34' },
                        dataType: 'json',
                        type: 'POST',
                        //async: false,
                        success: function(r2) {            
                            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                                if(typeof r2.resultado.status === 'undefined'){
                                    console.log('CORRECTO 200');                
                                    let selectEdad ='<select name="categoriaEdad" class="selectAltura" id="categoriaEdad" > <option value="">Seleccione</option>';

                                    let upSelectEdad ='<select name="upCategoriaEdad" class="selectAltura" id="upCategoriaEdad" > <option value="">Seleccione</option>';

                                    $.each(r2.resultado.categoriaEdad, function(m, n) {
                                        selectEdad+=' <option value="'+n.id+'" >'+n.nombre+': '+n.edadInicial+' - '+n.edadFinal+' Años </option> ';
                                        upSelectEdad+=' <option value="'+n.id+'" >'+n.nombre+': '+n.edadInicial+' - '+n.edadFinal+' Años </option> ';
                                    });

                                    selectEdad+='</select>';
                                    upSelectEdad+='</select>';


                                    let selectEstatura ='<select name="categoriaEstatura" class="selectAltura" id="categoriaEstatura" > <option value="">Seleccione</option>';
                                    let upSelectEstatura ='<select name="upCategoriaEstatura" class="selectAltura" id="upCategoriaEstatura" > <option value="">Seleccione</option>';

                                    $.each(r2.resultado.categoriaEstatura, function(m, n) {
                                        selectEstatura+=' <option value="'+n.id+'" >'+n.nombre+': '+n.estaturaCmMin+' - '+n.estaturaCmMax+' CM </option> ';
                                        upSelectEstatura+=' <option value="'+n.id+'" >'+n.nombre+': '+n.estaturaCmMin+' - '+n.estaturaCmMax+' CM </option> ';
                                    });

                                    selectEstatura+='</select>';
                                    upSelectEstatura+='</select>';

                                    $("#divSelectEdad").html(selectEdad)
                                    $("#divUpSelectEdad").html(upSelectEdad)
                                    $("#divSelectEstatura").html(selectEstatura)
                                    $("#divUpSelectEstatura").html(upSelectEstatura)
                                                                        
                    
                                }else{
                                    console.log(r2.resultado.status);
                                }                                            
                               
                            }
                        }        
                    });

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}

function upBoleta(id_u, nombre_u, descripcion_u, precio_u, idcategoriaEdad,idcategoriaEstatura, ext_img){
    limpiarGuardar('txtupAtraccion', 'file2', 'result2', 'img2');
    var ximagen = "imagen"+id_u;
    g_ext = ext_img;
    console.log(g_ext);
    document.getElementById("img2").src = $("#"+ximagen).attr('src');
    console.log(ximagen);			
    $("#idBoletaUp").val(id_u);
    $("#upNombreBoleta").val(nombre_u);
    $("#upDescripcionBoleta").val(descripcion_u);
    $("#upPrecioBoleta").val(precio_u);
    $("#upCategoriaEdad").val(idcategoriaEdad);
    $("#upCategoriaEstatura").val(idcategoriaEstatura);
    $('#upModalAtraccion').modal('show'); // abrir modal  
} 

function limpiarGuardarBoletas(){
    
     $("#nombreBoleta").val('');
	 $("#descripcionBoleta").val('');
	 $("#precioBoleta").val('');
	 $("#categoriaEdad").val(''); 
	 $("#categoriaEdad").val(''); 

    document.getElementById("result").innerHTML = "Esperando archivo...";
    document.getElementById("img").value = "Sin_imagen.png";
    document.getElementById("img").src = "imagenes/Sin_imagen.png";   
}


function adicionarBoletas(nombre, descripcion, precio, idcategoriaEdad, idcategoriaEstatura, ext){
    let str_base64 = document.getElementById("img").src;
    let imagen = str_base64.substring(23);
    //console.log(imagen);
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '32', nombre: nombre, descripcion:descripcion,precio:precio,idcategoriaEdad:idcategoriaEdad, idcategoriaEstatura:idcategoriaEstatura, imagen: imagen, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalAtraccion').modal('hide'); // oculta modal agregar atraccion
                limpiarGuardarBoletas();
				cargar_datos_boleteria();              
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}

function actualizarBoletas2(id, nombre,descripcion,precio,idcategoriaEdad,idcategoriaEstatura, ext, base64){
    ext = ext.toUpperCase();   //Convierte a mayuscula 
    console.log(id);
    console.log(nombre);
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '35', id: id, nombre: nombre, descripcion:descripcion, precio:precio, idcategoriaEdad:idcategoriaEdad,idcategoriaEstatura:idcategoriaEstatura, ext:ext, base64:base64 },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalAtraccion').modal('hide'); // se oculta modal                
                cargar_datos_boleteria();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}

function abreModalAtracciones(id_con, nombre_con){
    $("#idTipoBoleta_AT").val(id_con);
    $("#txtBoleta_Atraccion").val(nombre_con);
    cargar_datos_bat(id_con);
    $('#condicionAtraccion').modal('show'); // abrir modal actualizar estado atraccion 
}


function abreModalServiciosAdicionales(id_con, nombre_con){
    $("#idTipoBoleta_SA").val(id_con);
    $("#txtAtraccion_condicion").val(nombre_con);
    cargar_datos_bs(id_con);
    $('#condicionModalAcceso').modal('show'); // abrir modal actualizar estado atraccion 
}


function abreModalActiDesactivaBoletas(){ 
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].className=='boleta'){ //solo si es un checkbox entramos y si es true 
            myArray[x] = checkboxes[i].name;
            x++;          
        }
    }    
    if(x == 0){
        //$("#tbody_modal_atraccion").html(" ");
        $("#p_cant").html("No se ha seleccionado ninguna boleta");               
    }else{
        //$("#tbody_modal_atraccion").html(str_remp2);
        if(x == 1){
            $("#p_cant").html("Est\u00E1 seguro de Activar/Desactivar "+x+" atracci\u00F3n?"); 
        }else{
            $("#p_cant").html("Est\u00E1 seguro de Activar/Desactivar "+x+" atracciones?"); 
        }
        
    }
    //
    $('#estadoModalAtraccion ').modal('show'); // abrir modal actualizar estado atraccion    		
}


function btnEstadoBoletas(){ 
    //
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '41', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalAtraccion').modal('hide'); // se oculta modal                
                    cargar_datos_boleteria();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna atraccion');
    } 
}


function cargar_datos_servicio_adicional(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '36' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                   
                    var option = '<option value="0">Seleccione un servicio adicional</option>';
                    $.each(r2.resultado, function(m, n) {
                        
                        if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        				
                    });				             
                    
                    $('#servicio_adicional_select').html(option); 
                    
                   

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}



function cargar_datos_atracciones(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '1' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                   
                    var option = '<option value="0">Seleccione una Atraccion</option>';
                    $.each(r2.resultado, function(m, n) {
                        
                        if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        				
                    });				             
                    
                    $('#atracciones_select').html(option); 
                    
                   

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}


function cargar_datos_condicion_edad(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '37' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    //var option = '<option value="0">Seleccione un servicio adicional</option>';
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                      //  if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        var edad_comilla = "'"+n.nombre+"'";
                        var idCheck = n.nombre+'-'+n.estado+'-'+n.id;
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upCEdad('+ n.id +','+ edad_comilla +', '+n.edadInicial+' , '+n.edadFinal+');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" class="edad" name="'+idCheck+'"></h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.edadInicial +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.edadFinal +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                									
                            '</tr>';				
                    });				             
                    $("#tbody_cedad").html(str_remp);
                    //$('#condicion_mostrar').html(option); 
                    restaurar_paginacion('myPager2');
                    $('#tbody_cedad').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:20});

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}


function cargar_datos_condicion_estatura(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '44' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    //var option = '<option value="0">Seleccione un servicio adicional</option>';
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                      //  if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        var estatura_comilla = "'"+n.nombre+"'";
                        var idCheck = n.nombre+'-'+n.estado+'-'+n.id;
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upCEstatura('+ n.id +','+ estatura_comilla +' , '+n.estaturaCmMin+' , '+n.estaturaCmMax+');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" class="estatura" name="'+idCheck+'"></h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estaturaCmMin +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estaturaCmMax +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                									
                            '</tr>';				
                    });				             
                    $("#tbody_cestatura").html(str_remp);
                    //$('#condicion_mostrar').html(option); 
                    restaurar_paginacion('myPager2');
                    $('#tbody_cestatura').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:20});

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}


function cargar_datos_bs(id){   //boletas - Servicios adicionales 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '38', id: id},
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA
                var str_remp = "";                
                if(typeof r2.resultado.status === 'undefined'){                                  
                    var str_remp;
                    $.each(r2.resultado[0]['serviciosAdicionales'], function(m, n) {                        
                        var atraccion_comilla = "'"+n.nombre+"'";
                        var btnCondicion = '<a href="javascript:;"><img src="imagenes/union.png" class="img-fluid title="Condiciones de acceso" onclick="abreBorarModalServicioAdicional('+ n.id +','+ atraccion_comilla +');"></a>';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-4 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-right justify-content-center"><div class="f-icono mr-2">'+ btnCondicion +'</div></td>'+                                       
                            '</tr>';                
                    });                          
                    $("#tbody_atraccion_condicion").html(str_remp);
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}


function cargar_datos_bat(id){   //boletas - Atracciones 
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '38', id: id},
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA
                var str_remp = "";                
                if(typeof r2.resultado.status === 'undefined'){                                  
                    var str_remp;
                    $.each(r2.resultado[0]['atracciones'], function(m, n) {                        
                        var atraccion_comilla = "'"+n.nombre+"'";
                        var btnCondicion = '<a href="javascript:;"><img src="imagenes/union.png" class="img-fluid title="Condiciones de acceso" onclick="abreBorarModalAtraccion('+ n.id +','+ atraccion_comilla +');"></a>';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-4 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-right justify-content-center"><div class="f-icono mr-2">'+ btnCondicion +'</div></td>'+                                       
                            '</tr>';                
                    });                          
                    $("#tbody_boleta_atraccion").html(str_remp);
                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}



function btnAddBoleta_ServicioAdicional(){
    var id_servicio = $('#servicio_adicional_select').val();
    var id_boleta = $('#idTipoBoleta_SA').val();
    if(id_servicio != 0){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '39', id_servicio: id_servicio, id_boleta: id_boleta },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    
                    cargar_datos_bs(id_boleta);                    
                }else if(r.sts == 'RPT'){
                    alert('La condicion est\u00E1 agregada');                            
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ningun servicio');
    } 
}


function btnAddBoleta_Atracciones(){
    var id_atraccion = $('#atracciones_select').val();
    var id_boleta = $('#idTipoBoleta_AT').val();
    if(id_atraccion != 0){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '42', id_atraccion: id_atraccion, id_boleta: id_boleta },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    
                    cargar_datos_bat(id_boleta);                    
                }else if(r.sts == 'RPT'){
                    alert('La condicion est\u00E1 agregada');                            
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna atraccion');
    } 
}

function abreBorarModalServicioAdicional(id, nombre){
    $("#txtBorrarAC").val(id);
    $("#del_ca").html("Est\u00E1 seguro de Eliminar el servicio adicional: "+nombre+" ?"); 
    $('#BorrarModalAtraccion_condicion').modal('show'); // abrir modal borrar condicion de la atraccion 
}

function abreBorarModalAtraccion(id, nombre){
    $("#txtBorrarAT").val(id);
    $("#del_ba").html("Está seguro de Eliminar la atraccion: "+nombre+" ?"); 
    $('#BorrarModalBoletaAtraccion').modal('show'); // abrir modal borrar condicion de la atraccion 
}


function btnDelBoleta_ServicioAdicional(){
    console.log('elimiar');
    var id_del_servicio_adicional = $('#txtBorrarAC').val();
    var id_del_boleta = $('#idTipoBoleta_SA').val();
    if(id_del_servicio_adicional != 0){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '40', id_del_servicio_adicional: id_del_servicio_adicional, id_del_boleta: id_del_boleta },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Eliminado');
                    $('#BorrarModalAtraccion_condicion').modal('hide'); // se oculta modal
                    
                    cargar_datos_bs(id_del_boleta);
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n');
    } 
}


function btnDelBoleta_Atraccion(){
    console.log('elimiar');
    var id_del_atraccion = $('#txtBorrarAT').val();
    var id_del_boleta = $('#idTipoBoleta_AT').val();
    if(id_del_atraccion != 0){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '43', id_del_atraccion: id_del_atraccion, id_del_boleta: id_del_boleta },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Eliminado');
                    $('#BorrarModalBoletaAtraccion').modal('hide'); // se oculta modal
                    
                    cargar_datos_bat(id_del_boleta);
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n');
    } 
}


function abreModalEdad(){
    console.log('Modal edad');
    //limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
    $('#addModalCEdad').modal('show'); // abrir modal agregar condición de acceso 
} 

function abreModalEstatura(){
    console.log('Modal estatura');
    //limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
    $('#addModalCEstatura').modal('show'); // abrir modal agregar condición de acceso 
} 


function adicionarCEdad(nombre, edadMinima,edadMaxima){
  
    //
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '45', nombre: nombre, edadMinima:edadMinima,edadMaxima:edadMaxima },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalCEdad').modal('hide'); // oculta modal agregar atraccion
                //limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
				cargar_datos_condicion_edad();              
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}


function adicionarCEstatura(nombre, estaturaMinima,estaturaMaxima){
  
    //
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '46', nombre: nombre, estaturaMinima:estaturaMinima,estaturaMaxima:estaturaMaxima },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalCEstatura').modal('hide'); // oculta modal agregar atraccion
                //limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
				cargar_datos_condicion_estatura();              
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}

function upCEdad(id_u, nombre_u, edadInicial_u,edadFinal_u){
    		
    $("#txtupIdCEdad").val(id_u);
    $("#txtupCEdad").val(nombre_u);
    $("#EdadMinimaUpd").val(edadInicial_u);
    $("#EdadMaximaUpd").val(edadFinal_u);
    $('#upModalCEdad').modal('show'); // abrir modal  
}

function upCEstatura(id_u, nombre_u, estaturaInicial_u,estaturaFinal_u){
    		
    $("#txtupIdCEstatura").val(id_u);
    $("#txtupCEstatura").val(nombre_u);
    $("#EstaturaMinimaUpd").val(estaturaInicial_u);
    $("#EstaturaMaximaUpd").val(estaturaFinal_u);
    $('#upModalCEstatura').modal('show'); // abrir modal  
}

function actualizarCEdad(id, nombre, edadInicial,edadFinal){
     
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '47', id: id, nombre: nombre, edadInicial:edadInicial,edadFinal:edadFinal },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalCEdad').modal('hide'); // se oculta modal                
                cargar_datos_condicion_edad();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}

function actualizarCEstatura(id, nombre, estaturaInicial,estaturaFinal){
     
    $.ajax({        
        url: "ajax/ajxRequest2.php",
        data: { op: '49', id: id, nombre: nombre, estaturaInicial:estaturaInicial,estaturaFinal:estaturaFinal },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalCEstatura').modal('hide'); // se oculta modal                
                cargar_datos_condicion_estatura();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}


function abreModalActiDesactivaEdad(){ 
    console.log('Modal edad activar/Desactivar');
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].className=='edad'){ //solo si es un checkbox entramos y si es true 
            
            myArray[x] = checkboxes[i].name;
            x++;          
        }
    }    
    if(x == 0){
        $("#p_cant_edad").html("No se ha seleccionado ninguna condición de Edad");               
    }else{
        if(x == 1){
            $("#p_cant_edad").html("Está seguro de Activar/Desactivar "+x+" condición de Edad?"); 
        }else{
            $("#p_cant_edad").html("Está seguro de Activar/Desactivar "+x+" condición de Edad?"); 
        }
        
    }
    //
    $('#estadoModalCEdad').modal('show'); // abrir modal actualizar estado atraccion    		
}

function abreModalActiDesactivaEstatura(){ 
    console.log('Modal estatura activar/Desactivar');
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].className=='estatura'){ //solo si es un checkbox entramos y si es true 
            
            myArray[x] = checkboxes[i].name;
            x++;          
        }
    }    
    if(x == 0){
        $("#p_cant_estatura").html("No se ha seleccionado ninguna condición de Estatura");               
    }else{
        if(x == 1){
            $("#p_cant_estatura").html("Está seguro de Activar/Desactivar "+x+" condición de Estatura?"); 
        }else{
            $("#p_cant_estatura").html("Está seguro de Activar/Desactivar "+x+" condición de Estatura?"); 
        }
        
    }
    //
    $('#estadoModalCEstatura').modal('show'); // abrir modal actualizar estado atraccion    		
}

function btnEstadoEdad(){ 
    //
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '48', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalCEdad').modal('hide'); // se oculta modal                
                    cargar_datos_condicion_edad();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n de acceso');
    } 
}

function btnEstadoEstatura(){ 
    //
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest2.php",
            data: { op: '50', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalCEstatura').modal('hide'); // se oculta modal                
                    cargar_datos_condicion_estatura();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n de acceso');
    } 
}