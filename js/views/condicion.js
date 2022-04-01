//Variables Globales
var myArray = new Array();
var nRegistros;  

  
function cargar_datos_condicion(){
    console.log('Cargar datos'); 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '20' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                if(typeof r2.resultado.status === 'undefined'){
                    console.log('CORRECTO 200');                
                    var str_remp;
                    var option = '<option value="0">Seleccione una condici\u00F3n</option>';
                    $.each(r2.resultado, function(m, n) {
                        //console.log(n);
                        //var img_ext = atracciones.imagenUrl;
                        //var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
                        //var ext_comilla = "'"+extension_img[1]+"'";
                        if(n.estado == 'ACTIVO'){ option += '<option value="' + n.id + '">' + n.nombre + '</option>'; }
                        var atraccion_comilla = "'"+n.nombre+"'";
                        var idCheck = n.nombre+'-'+n.estado+'-'+n.id;
                        var btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upCacceso('+ n.id +','+ atraccion_comilla +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        var ver_imagen = '<img id="imagenc' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
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
                            '</tr>';				
                    });				             
                    $("#tbody_cacceso").html(str_remp);
                    $('#condicion_mostrar').html(option); 
                    restaurar_paginacion('myPager2');
                    $('#tbody_cacceso').pageMe({pagerSelector:'#myPager2',showPrevNext:true,hidePageNumbers:false,perPage:20});

                }else{
                    console.log(r2.resultado.status);
                }                                            
               
            }
        }        
    });    
}
//
function abreModalcacceso(){
    limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
    $('#addModalCacceso').modal('show'); // abrir modal agregar condición de acceso 
} 
//
function abreModalActiDesactivacacceso(){ 
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
        $("#p_cant_condicion").html("No se ha seleccionado ninguna condici\u00F3n de acceso");               
    }else{
        if(x == 1){
            $("#p_cant_condicion").html("Est\u00E1 seguro de Activar/Desactivar "+x+" condici\u00F3n de acceso?"); 
        }else{
            $("#p_cant_condicion").html("Est\u00E1 seguro de Activar/Desactivar "+x+" condici\u00F3n de accesos?"); 
        }
        
    }
    //
    $('#estadoModalCacceso').modal('show'); // abrir modal actualizar estado atraccion    		
}
//
function upCacceso(id_u, nombre_u, ext_img){
    limpiarGuardarC('txtupCacceso', 'file2_condicion', 'result2_condicion', 'img2_condicion');
    var ximagen = "imagenc"+id_u;
    g_ext = ext_img;
    console.log(id_u+' - '+ximagen);
    document.getElementById("img2_condicion").src = $("#"+ximagen).attr('src');
    console.log(ximagen);			
    $("#txtupIdCacceso").val(id_u);
    $("#txtupCacceso").val(nombre_u);
    $('#upModalCacceso').modal('show'); // abrir modal  
} 
//
function openImage_condicion() { //Esta función validaría una imágen  
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
                        error.msg+= 'La extensión del archivo no es válida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La im\u00E1gen no puede ocupar m\u00F3s de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                document.getElementById("result_condicion").innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result_condicion").innerHTML = "El archivo es v\u00E1lido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img_condicion").src = e.target.result;
                        console.log();
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result_condicion").innerHTML = "El archivo est\u00E1 da\u00F1ado";
                    document.getElementById("img_condicion").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona');
    }
}	
//
function openImage2_condicion() { //Esta funcion validara una imagen  
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
                        error.msg+= 'La extension del archivo no es valida.<br>';
                    }  
                    break;
                }  
            }  
            if(file.size > maxSize) {
                error.state = true;
                error.msg += 'La imagen no puede ocupar más de '+maxSize/1048576+' MB.';
            }  
            if(error.state) {
                input.value = '';
                document.getElementById("result2_condicion").innerHTML = error.msg;
                return;
            }else{
                if(file.size > 0){
                    document.getElementById("result2_condicion").innerHTML = "El archivo es valido";
                    //
                    var reader = new FileReader();  
                    reader.onload = function(e) {
                        document.getElementById("img2_condicion").src = e.target.result;							
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result2_condicion").innerHTML = "El archivo esta danado";
                    document.getElementById("img2_condicion").src = "";
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
        adicionarCacceso(nombre, extension_img[1]);
    }else{
        alert('Llene todos los campos');
    }		
});*/
//
function adicionarCacceso(nombre, ext){
    let str_base64 = document.getElementById("img_condicion").src;
    let imagen = (ext == 'JPG') ? str_base64.substring(23) : str_base64.substring(22);
    //
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '19', nombre: nombre, imagen: imagen, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalCacceso').modal('hide'); // oculta modal agregar atraccion
                limpiarGuardarC('txtAddCacceso', 'file_condicion', 'result_condicion', 'img_condicion');
				cargar_datos_condicion();              
            }else{
                alert('Error al guardar');
            }
        }        
    });    
}
//
function btnADCacceso(){ 
    //
    if(myArray.length){     
        $.ajax({         
            url: "ajax/ajxRequest.php",
            data: { op: '16', id: JSON.stringify(myArray) },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado SI '+r.stsSi+', No'+r.stsNo);
                    $('#estadoModalCacceso').modal('hide'); // se oculta modal                
                    cargar_datos_condicion();              
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
function limpiarGuardarC(txt, fil, resul, imagen){
    txt = '#'+txt;
    fil = '#'+fil;
    $(txt).val(''); // Limpia campo nombre atraccion
    $(fil).val(''); //
    document.getElementById(resul).innerHTML = "Esperando archivo...";
    document.getElementById(imagen).value = "Sin_imagen.png";
    document.getElementById(imagen).src = "imagenes/Sin_imagen.png";    
}
//
function actualizarCacceso(id, nombre, ext, base64){
    ext = ext.toUpperCase();   //Convierte a mayuscula    
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '18', id: id, nombre: nombre, base: base64, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalCacceso').modal('hide'); // se oculta modal                
                cargar_datos_condicion();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
function actualizarCacceso2(id, nombre){
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '17', id: id, nombre: nombre },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                alert('Actualizado');
                $('#upModalCacceso').modal('hide'); // se oculta modal                
                cargar_datos_condicion();              
            }else{
                alert('Error al actualizar');
            }
        }        
    });   
}
//
/*const d = document;
$main = d.querySelector("main");
$link = d.querySelector(".link");

async function loadAtraccion(url){
    try{
        let res = await fetch(url);
        json = await res.json();

        console.log(json);
    }catch(err){

    }
}
d.addEventListener("DOMCcontentLoaded",e=> loadAtraccion("http://20.44.111.223:80/api/boleteria/atraccion?incluirImagen=true"));*/
//
//Fin lineas
//