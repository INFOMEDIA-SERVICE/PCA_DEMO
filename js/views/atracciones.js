//Variables Globales

  
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
                var str_remp;
				$.each(r2.resultado, function(m, n) {
					console.log(n);
					//var img_ext = atracciones.imagenUrl;
					//var extension_img = img_ext.split('.'); // Saco la extensión para guardarla en la BD
					//var ext_comilla = "'"+extension_img[1]+"'";
					//var atraccion_comilla = "'"+atracciones.nombre+"'";
                    str_remp += '<tr class="row py-3">' +
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox"></h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.id +'</h2></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.nombre +'</h4></td>'+
                            '<td class="col-2 d-flex align-items-center justify-content-center"><img src="imagenes/atraccion.jpg" width="50%" height="50%" ></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.creadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaCreado +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.modificadoPor +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.fechaModificado +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ n.estado +'</h4></td>'+
                            '<td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/+.png"></div></td>'+										
                        '</tr>';								

					//var btnEditar = '<a href="javascript:;" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar" onclick="upAtraccion('+ atracciones.id +','+ atraccion_comilla +','+ ext_comilla +' );">&#xE254;</i></a>';
					//var btnEliminar = '<a href="javascript:;" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Desactivar" onclick="delAtraccion('+ atracciones.id +','+ atraccion_comilla +');">&#xE872;</i></a>';
					//var btnActivar = '<a href="javascript:;" class="activar" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Activar" onclick="activar_Atraccion('+ atracciones.id +','+ atraccion_comilla +');">restore</i></a>';
					//var dlt_boton = '<button id="edit-category" class="btn btn-danger" type="button" title="Editar" class="boton">Eliminar</button>';
					//var ver_imagen = '<img id="imagen' + atracciones.id+'" src="http://20.44.111.223' + atracciones.imagenUrl + '?t='+contenToke +'" width="40" height="40" />';
					//
					//if(atracciones.estado == 'ACTIVO'){
						//str_remp=str_remp+'<tr><td>'+ atracciones.id +'</td><td>'+ atracciones.nombre +'</td><td>'+ ver_imagen +'</td><td>'+ atracciones.estado +'</td><td>'+ btnEditar + ' ' + btnEliminar +'</td></tr>';
					//}else{
						//str_remp=str_remp+'<tr><td>'+ atracciones.id +'</td><td>'+ atracciones.nombre +'</td><td>'+ ver_imagen +'</td><td>'+ atracciones.estado +'</td><td>'+ btnActivar +'</td></tr>';
					//}
				}); 
				//str_remp=str_remp+'</tbody>';              
				$("#tbody_atraccion").html(str_remp);                                             
               
            }
        }        
    });
    /*var toke = localStorage.getItem('accessToken');
    console.log(toke);
    if(toke != ""){
        console.log('2');
        var settings3 = {
            "url": "http://20.44.111.223:80/api/boleteria/atracciones",
            //"url": "http://20.44.111.223:80/api/boleteria/tiposBoleta?incluirImagen=true",
            "method": "GET",
            "async": false,
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer "+localStorage.getItem('accessToken')
            },
        };
        $.ajax(settings3).done(function (response) {
            $("#datatablesSimple").dataTable().fnDestroy();
            var str_remp;
            //'<a class="dropdown-item" href="javascript:;" onclick="redirArea(' + n.id + ',3);">Contabilidad</a>' editEmployeeModal - deleteEmployeeModal
            response.forEach(function(atracciones, index) {
                console.log(atracciones);
                var atraccion_comilla = "'"+atracciones.nombre+"'";
                var btnEditar = '<a href="javascript:;" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar" onclick="upAtraccion('+ atracciones.id +','+ atraccion_comilla +');">&#xE254;</i></a>';
                var btnEliminar = '<a href="javascript:;" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Desactivar" onclick="delAtraccion('+ atracciones.id +','+ atraccion_comilla +');">&#xE872;</i></a>';
                var btnActivar = '<a href="javascript:;" class="activar" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Activar" onclick="activar_Atraccion('+ atracciones.id +','+ atraccion_comilla +');">restore</i></a>';
                //var dlt_boton = '<button id="edit-category" class="btn btn-danger" type="button" title="Editar" class="boton">Eliminar</button>';
                var ver_imagen = '<img src"' + atracciones.prototype +'" width="30" height="30" />';
                //
                if(atracciones.estado == 'ACTIVO'){
                    str_remp=str_remp+'<tr><td>'+ atracciones.id +'</td><td>'+ atracciones.nombre +'</td><td>'+ ver_imagen +'</td><td>'+ atracciones.estado +'</td><td>'+ btnEditar + ' ' + btnEliminar +'</td></tr>';
                }else{
                    str_remp=str_remp+'<tr><td>'+ atracciones.id +'</td><td>'+ atracciones.nombre +'</td><td>'+ ver_imagen +'</td><td>'+ atracciones.estado +'</td><td>'+ btnActivar +'</td></tr>';
                }
            }); 
            str_remp=str_remp+'</tbody>';              
            $("#cargar_tbody").html(str_remp);
            $('#datatablesSimple').DataTable({                    
                //"responsive": true,
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" },
                "order": [],
                "paging": true,
                //"processing": true,
                'serverMethod': 'post',
                //"ajax": "http://20.44.111.223:80/api/boleteria/atracciones",
                dom: 'lBfrtip',
                buttons: [
                'excel', 'csv', 'pdf', 'print', 'copy',
                ],
                "lengthMenu": [[25, 50, -1], [25, 50, "All"]]                            
            });
        });
    }*/
}
//Fin function
//