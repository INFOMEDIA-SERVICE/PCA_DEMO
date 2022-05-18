//Variables Globales
var myArray = new Array();
var nRegistros;

  
function cargar_datos(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '1' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                        var atraccion_comilla = "'"+n.nombre+"'";
                        var idCheck = n.nombre+'-'+n.estado+'-'+n.id;
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upAtraccion('+ n.id +','+ atraccion_comilla +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        var btnCondicion = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/+.png" class="img-fluid title="Condiciones de acceso" onclick="abreModalCondicion('+ n.id +','+ atraccion_comilla +');"></a>' : '<img src="imagenes/+.png" class="img-fluid title="Agregar condiciones">';
                        var ver_imagen = '<img id="imagen' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnCondicion +'</div></td>'+										
                            '</tr>';				
                    });				             
                    $("#tbody_atraccion").html(str_remp); 
                    restaurar_paginacion('myPager');                     
                    $('#tbody_atraccion').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:20});

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}
//
function cargar_datos_ac(id){    
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '25', id: id},
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA
                var str_remp = "";                
                if(typeof r2.resultado.status === 'undefined'){                                  
                    var str_remp;
                    $.each(r2.resultado[0]['condicionesAcceso'], function(m, n) {                        
                        var atraccion_comilla = "'"+n.nombre+"'";
                        var btnCondicion = '<a href="javascript:;"><img src="imagenes/union.png" class="img-fluid title="Condiciones de acceso" onclick="abreBorarModalCondicion('+ n.id +','+ atraccion_comilla +');"></a>';
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
//
function abreModalatraccion(){
    limpiarGuardar('txtAddAtraccion', 'file', 'result', 'img');
    $('#addModalAtraccion').modal('show'); // abrir modal agregar atraccion 
} 
//
function abreModalActiDesactivaatraccion(){ 
    var x = 0;
    var str_remp2;
    myArray = [];
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles    
        if(checkboxes[i].type == "checkbox" && checkboxes[i].checked == true && checkboxes[i].name != 'atraccion_todos'){ //solo si es un checkbox entramos y si es true 
            myArray[x] = checkboxes[i].name;
            x++;          
        }
    }    
    if(x == 0){
        //$("#tbody_modal_atraccion").html(" ");
        $("#p_cant").html("No se ha seleccionado ninguna atracci\u00F3n");               
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
//
function abreModalCondicion(id_con, nombre_con){
    $("#txtIdAtraccion_condicion").val(id_con);
    $("#txtAtraccion_condicion").val(nombre_con);
    cargar_datos_ac(id_con);
    $('#condicionModalAcceso').modal('show'); // abrir modal actualizar estado atraccion 
}
//
function abreBorarModalCondicion(id, nombre){
    $("#txtBorrarAC").val(id);
    $("#del_ca").html("Est\u00E1 seguro de Eliminar la condici\u00F3n de acceso: "+nombre+" ?"); 
    $('#BorrarModalAtraccion_condicion').modal('show'); // abrir modal borrar condicion de la atraccion 
}
//
function upAtraccion(id_u, nombre_u, ext_img){
    limpiarGuardar('txtupAtraccion', 'file2', 'result2', 'img2');
    var ximagen = "imagen"+id_u;
    g_ext = ext_img;
    console.log(g_ext);
    document.getElementById("img2").src = $("#"+ximagen).attr('src');
    console.log(ximagen);			
    $("#txtupIdAtraccion").val(id_u);
    $("#txtupAtraccion").val(nombre_u);
    $('#upModalAtraccion').modal('show'); // abrir modal  
} 
//
function openImage() { //Esta función validaría una imágen  
    try{			
        var input = this;
        var file = input.files[0];
        var fileName = input.value;
        var maxSize = 1048576; //bytes
        var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones válidas
        console.log(file.size);
        var error = {
            state: false,
            msg: ''
        };        
        if(this.files && file) {  
            for (var i = fileName.length-1; i >= 0; i--) {  
                if (fileName[i] == '.') {  
                    var ext = fileName.substring(fileName[i],fileName.length);  
                    if (!extensions.test(ext)) {
                        error.state = true;
                        error.msg+= 'La extensi\u00F3n del archivo no es v\u00E1lida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La im\u00E1gen no puede ocupar m\u00E1s de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                document.getElementById("result").innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result").innerHTML = "El archivo es v\u00E1lido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img").src = e.target.result;
                        console.log();
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result").innerHTML = "El archivo est\u00E1 da\u00F1ado";
                    document.getElementById("img").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona');
    }
}	
//
function openImage2() { //Esta funcion validara una imagen  
    try{
        console.log("Opem2");			
        var input = this;
        var file = input.files[0];
        var fileName = input.value;
        var maxSize = 1048576; //bytes
        var extensions = new RegExp(/.jpg|.jpeg|.png/i); //Extensiones validas			
        var error = {
            state: false,
            msg: ''
        };  
        if(this.files && file) {  
            for (var i = fileName.length-1; i >= 0; i--) {  
                if (fileName[i] == '.') {  
                    var ext = fileName.substring(fileName[i],fileName.length);  
                    if (!extensions.test(ext)) {
                        error.state = true;
                        error.msg+= 'La extensi\u00F3n del archivo no es v\u00E1lida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La imagen no puede ocupar m\u00E1s de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                //document.getElementById(resultado).innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result2").innerHTML = "El archivo es v\u00E1lido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img2").src = e.target.result;							
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result2").innerHTML = "El archivo esta da\u00F1ado";
                    document.getElementById("img2").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona abrir imagen actualizar');
    }
}	
//
/*$('#btnGuardarAtraccion').click(function(){
    //Toma el archivo elegido por el input 
    var value = document.getElementById("file").files[0];     
    var nombre = $("#txtAddAtraccion").val();
    if(nombre != '' && value.size != 0){
        let img_ext = value.name;
        img_ext = img_ext.toUpperCase(); 
        var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
        //
        adicionarAtracciones(nombre, extension_img[1]);
    }else{
        alert('Llene todos los campos');
    }		
});*/
//
function adicionarAtracciones(nombre, ext){
    let str_base64 = document.getElementById("img").src;
    let imagen = (ext == 'JPG') ? str_base64.substring(23) : str_base64.substring(22);
    //
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '3', nombre: nombre, imagen: imagen, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalAtraccion').modal('hide'); // oculta modal agregar atraccion                
				cargar_datos();              
            }else{
                alert('Error al guardar');
            }
        }        
    });   
}
//
/*$('#btnActualizarAtraccion').click(function(){
    var r_imagen = document.getElementById("result2").innerHTML;	
    var id_a = $("#txtupIdAtraccion").val();
    var nombre_a = $("#txtupAtraccion").val();	
    //
    if(nombre_a != '' && imagen_a != '' && r_imagen == 'El archivo es valido'){
        let str_base64 = document.getElementById("img2").src;
        let imagen = str_base64.split(',');			
        if(imagen[0] == "data:image/jpeg;base64"){
            console.log("base64");////////////////////////////
            var imagen_a = document.getElementById("file2").files[0];
            let img_ext = imagen_a.name;
            var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD 
            //						
            actualizarAtracciones(id_a,nombre_a, extension_img[1], imagen[1]);
        }else{
            console.log("URL");/////////////////////////////
            actualizarAtracciones2(id_a,nombre_a);
        }		
    }else{
        alert('Llene todos los campos, para actualizar');
    }		
});*/
//
function btnADAtraccion(){ 
    //
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '8', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalAtraccion').modal('hide'); // se oculta modal                
                    cargar_datos();              
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
function btnAddAtraccion_condicion(){
    var id_condicion = $('#condicion_mostrar').val();
    var id_atraccion = $('#txtIdAtraccion_condicion').val();
    if(id_condicion != 0){     
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '24', id_con: id_condicion, id_atra: id_atraccion },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    var id = $("#txtIdAtraccion_condicion").val();
                    cargar_datos_ac(id);                    
                }else if(r.sts == 'RPT'){
                    alert('La condicion est\u00E1 agregada');                            
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n');
    } 
}
//
function btnDelAtraccion_condicion(){
    console.log('elimiar');
    var id_del_condicion = $('#txtBorrarAC').val();
    var id_del_atraccion = $('#txtIdAtraccion_condicion').val();
    if(id_del_condicion != 0){     
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '26', id_del_con: id_del_condicion, id_del_atra: id_del_atraccion },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Eliminado');
                    $('#BorrarModalAtraccion_condicion').modal('hide'); // se oculta modal
                    var id = $("#txtIdAtraccion_condicion").val();
                    cargar_datos_ac(id);
                }else{
                    alert('Error al actualizar');
                }
            }        
        }); 
    }else{
        alert('No ha seleccionado ninguna condici\u00F3n');
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
function limpiarGuardar(txt, fil, resul, imagen){
    txt = '#'+txt;
    fil = '#'+fil;
    $(txt).val(''); // Limpia campo nombre atraccion
    $(fil).val(''); //
    document.getElementById(resul).innerHTML = "Esperando archivo...";
    document.getElementById(imagen).value = "Sin_imagen.png";
    document.getElementById(imagen).src = "imagenes/Sin_imagen.png";    
}
//
function actualizarAtracciones(id, nombre, ext, base64){
    ext = ext.toUpperCase();   //Convierte a mayuscula 
    
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '5', id: id, nombre: nombre, base: base64, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalAtraccion').modal('hide'); // se oculta modal                
                cargar_datos();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
function actualizarAtracciones2(id, nombre){
    console.log(id);
    console.log(nombre);
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '7', id: id, nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalAtraccion').modal('hide'); // se oculta modal                
                cargar_datos();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
//Fin lineas
//