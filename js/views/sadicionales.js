//Variables Globales
var myArray = new Array();
var nRegistros;

  
function cargar_datos_sadicionales(){
    console.log('Cargar datos sadicionales'); 
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '27' },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r2) {            
            if (r2.sts == 'OK') {//AQUI COMIENZA A PINTAR LA TABLA                
                //if(typeof r2.resultado.status === 'undefined'){
                    var str_remp;
                    $.each(r2.resultado, function(m, n) {
                        let atraccion_comilla = "'"+n.nombre+"'";
                        let idCheck = 'sadi'+'-'+n.estado+'-'+n.id;
                        let btnEditar = (n.estado == 'ACTIVO') ? '<a href="javascript:;"><img src="imagenes/edit.png" class="img-fluid title="Editar" onclick="upSadicional('+ n.id +','+ atraccion_comilla +','+ n.precio +','+ n.categoriaServicio['id'] +');"></a>' : '<img src="imagenes/edit.png" class="img-fluid title="Editar">';
                        let ver_imagen = '<img id="imagen' + n.id+'" src="http://20.44.111.223/api/contenido/imagen/' + n.imagenId + '" width="40" height="40" />';
                        str_remp += '<tr class="row py-3">' +
                                '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2">'+ btnEditar +'</div></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox" name="'+idCheck+'"></h4></td>'+
                                //'<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.precio +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['nombre'] +'</h4></td>'+
                                '<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['creadoPor'] +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['fechaCreado'] +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['modificadoPor'] +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.categoriaServicio['fechaModificado'] +'</h4></td>'+
                                '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+                                										
                            '</tr>';				
                    });				             
                    $("#tbody_sadicionales").html(str_remp); 
                    restaurar_paginacion('myPager_sadicional');                     
                    $('#tbody_sadicionales').pageMe({pagerSelector:'#myPager_sadicional',showPrevNext:true,hidePageNumbers:false,perPage:20});

                //}else{
                    //console.log(r2.resultado.status);
                //}                                            
               
            }
        }        
    });    
}
//
function abreModalSadicional(){
    limpiarModalSadicional('txtAddSadicional', 'txtAddPrecio', 'select_sadicional', 'file_sadicional', 'result', 'img');
    $('#addModalSadicionales').modal('show'); // abrir modal agregar atraccion 
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
function upSadicional(idsa, nombresa, preciosa, idcategosa){
    limpiarModalSadicional('txtupSadicional', 'txtupPrecio', 'selectup_sadicional', 'fileup_sadicional', 'result2', 'imgup_sadicional');
    var ximagen = "imagen"+idsa;
    document.getElementById("imgup_sadicional").src = $("#"+ximagen).attr('src');
    //			
    $("#txtupIdSadicional").val(idsa);
    $("#txtupSadicional").val(nombresa);
    $("#txtupPrecio").val(preciosa);
    $("#selectup_sadicional").val(idcategosa);
    //Copia
    $("#txtupIdSadicional2").val(idsa);
    $("#txtupSadicional2").val(nombresa);
    $("#txtupPrecio2").val(preciosa);
    $("#selectup_sadicional2").val(idcategosa);
    //
    $('#upModalSadicional').modal('show'); // abrir modal  
} 
//
function openImageAddSadicional() { //Esta función validaría una imágen  
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
function openImageUpSadicional() { //Esta funcion validara una imagen  
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
                        document.getElementById("imgup_sadicional").src = e.target.result;							
                    }
                    reader.readAsDataURL(this.files[0]);
                }else{
                    document.getElementById("result2").innerHTML = "El archivo esta da\u00F1ado";
                    document.getElementById("imgup_sadicional").src = "";
                }
            }								
        }
    }catch(err){
        alert('No funciona abrir imagen actualizar');
    }
}	
//
function adicionarSadicional(nombre, ext, precio, categ){
    let str_base64 = document.getElementById("img").src;
    let imagen = (ext == 'JPG') ? str_base64.substring(23) : str_base64.substring(22);
    //
    $.ajax({        
        url: "ajax/ajxRequest.php",
        data: { op: '32', nombre: nombre, precio: precio, idcateg: categ, imagen: imagen, extension: ext },
        dataType: 'json',
        type: 'POST',
        //async: false,
        success: function(r) { 
            console.log(r);           
            if (r.sts == 'OK') {
                //alert('Guardo');
                $('#addModalSadicionales').modal('hide'); // oculta modal agregar atraccion                
				cargar_datos_sadicionales();              
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
                    cargar_datos_sadicionales();              
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
function limpiarModalSadicional(txt, txt2, selec, fil, resul, imagen){
    txt = '#'+txt;
    txt2 = '#'+txt2;
    select = '#'+selec;
    fil = '#'+fil;
    $(txt).val(''); // Limpia campo nombre servicio adicional
    $(txt2).val('');
    $(select).val(0);
    $(fil).val(''); //
    document.getElementById(resul).innerHTML = "Esperando archivo...";
    document.getElementById(imagen).value = "Sin_imagen.png";
    document.getElementById(imagen).src = "imagenes/Sin_imagen.png";    
}
//
function actualizarSadicional(id, nombre, precio, idcat, ext=0, base64=0){
    if(nombre == 0 && precio == 0 && idcat == 0 && ext == 0){
        alert('No hay cambios para actualizar');        
    }else{
        if(ext != 0){ ext = ext.toUpperCase(); }   //Convierte a mayuscula, si no llega a cero(0)    
        $.ajax({        
            url: "ajax/ajxRequest.php",
            data: { op: '33', id: id, nombre: nombre, precio: precio, idcat: idcat, base: base64, extension: ext },
            dataType: 'json',
            type: 'POST',
            //async: false,
            success: function(r) { 
                console.log(r);           
                if (r.sts == 'OK') {
                    alert('Actualizado');
                    $('#upModalSadicional').modal('hide'); // se oculta modal                
                    cargar_datos_sadicionales();              
                }else{
                    alert('Error al actualizar');
                }
            }        
        });   
    }    
}
//
//Fin lineas
//