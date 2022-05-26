$.fn.pageMe = function(opts){
    console.log(opts);
    var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;//.find('tbody');
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.length;
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link"><div class="f-icono mr-2"><img src="imagenes/Imagen-7.png"></div></a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link"><div class="f-icono mr-2"><img src="imagenes/Imagen 6.png"></div></a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
    pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
    
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
        pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};
//
function restaurar_paginacion(pagina){
    const elemento = document.querySelector("#"+pagina);
    elemento.innerHTML = "";
}
//
function doSearch(tabla,txtBuscar){
    const tableReg = document.getElementById(tabla);
    const searchText = document.getElementById(txtBuscar).value.toLowerCase();
    let total = 0;

    // Recorremos todas las filas con contenido de la tabla
    for (let i = 1; i < tableReg.rows.length; i++) {
        // Si el td tiene la clase "noSearch" no se busca en su cntenido
        if (tableReg.rows[i].classList.contains("noSearch")) {
            continue;
        }

        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length && !found; j++) {
            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                found = true;
                total++;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }
    console.log('Cuantos pulsos');   
    // mostramos las coincidencias
    /*const lastTR=tableReg.rows[tableReg.rows.length-1];
    const td=lastTR.querySelector("td");
    lastTR.classList.remove("hide", "red");
    if (searchText == "") {
        lastTR.classList.add("hide");
    } else if (total) {
        td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");
    } else {
        lastTR.classList.add("red");
        td.innerHTML="No se han encontrado coincidencias";
    }*/
}
//
function marcar_atracciones(source){
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles        				
        if(checkboxes[i].type == "checkbox"){ //solo si es un checkbox entramos
            if(checkboxes[i].name == "condicion_todos"){ break; }				
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}
//
function marcar_cacceso(source){
    sw = 0;
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
        if(checkboxes[i].name == "condicion_todos"){ sw = 1; }                      
        if(checkboxes[i].type == "checkbox" && sw == 1){ //solo si es un checkbox entramos y si es "condicion_todos(sw==1)"
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}

function marcar_cestatura(source){
    sw = 0;
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
        if(checkboxes[i].name == "estatura_todos"){ sw = 1; }                      
        if(checkboxes[i].type == "checkbox" && sw == 1){ //solo si es un checkbox entramos y si es "condicion_todos(sw==1)"
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}
//
function marcar_sadicionales(source){
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles                       
        if(checkboxes[i].type == "checkbox"){ //solo si es un checkbox entramos
            if(checkboxes[i].name == "scategoria_todos"){ break; }               
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}
//
function marcar_scategoria(source){
    sw = 0;
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
        if(checkboxes[i].name == "scategoria_todos"){ sw = 1; }                      
        if(checkboxes[i].type == "checkbox" && sw == 1){ //solo si es un checkbox entramos y si es "condicion_todos(sw==1)"
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}
//
function marcar_precepcion(source){
    sw = 0;
    checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
        if(checkboxes[i].name == "precepcion_todos"){ sw = 1; }                      
        if(checkboxes[i].type == "checkbox" && sw == 1){ //solo si es un checkbox entramos y si es "condicion_todos(sw==1)"
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamo (Marcar/Desmarcar Todos)            
        }
    }
}
//Quita comillas("") a los valores de un Array
function quitar_comilla(arr){
    let fin = Array();
    arr.forEach(element => {//Para cada valor del array
        element.split(",").forEach(elm => {//Lo divido en 2 por la coma y para cada uno de los resultados
        fin.push(parseFloat(elm));//Lo meto en el array fin haciéndole un parse a float para evitar comillas
        });
    });
    return(fin);
}