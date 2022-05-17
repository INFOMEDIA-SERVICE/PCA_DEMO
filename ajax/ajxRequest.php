<?php
session_start();
    /**
     * Solicitudes y respuestas con Atracciones
     * User: Alfonso Atencio
     * Date: 01/30/2022
     * Time: 17:22
     */

    require_once '../main.php'; 
    
    //Tipo de peticion
    //$op = addslashes($_POST['op']);
    extract($_REQUEST);
    //
    //$token = $llamar_token->generarToken();
    $tokenRefresh = $llamar_token->refreshToken();
    $token=$_SESSION['accessToken'];
    $headers[] = 'Authorization: Bearer '.$token;
    $headers[] = 'Content-Type: application/json'; 
    //var toke = localStorage.getItem('accessToken');
	//var contenToke = localStorage.getItem('contenToken');
    switch ($op) {
        case 1://Servicio Cargar datos atracciones - by:Alfonso
            //
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/atraccion?incluirImagen=true';
                $rDatos = $consumo->Get($url, $headers); 
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>$rDatos]);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;

        case 2://Servicio Cargar datos condiciones - by:Nicolás
            //
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
                $condiDatos = $consumo->get($url, $headers); 
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;      

        case 3://Guardar datos atracciones
            //
            $anombre = addslashes($_POST['nombre']);
            $aimagen = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']);
            //
            $array['nombre'] = $anombre;
            $array['imagen']['formato'] = $aextension;
            $array['imagen']['datosBase64'] = $aimagen;                        
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccion';
            $rGuardar = $consumo->Post($url, $headers, $array);
            //
            if($rGuardar->message == 'Se ha creado la atraccion'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;

        case 4://Sin definir
            $tokenRefresh = $llamar_token->refreshToken();

            /*echo "<br><br> ##### <pre>";
            print_r($tokenRefresh);
            echo "</pre>";*/
        break;

        case 5://Actualiza nombre e imagen de la atraccion
            $a_id = addslashes($_POST['id']);
            $a_nombre = addslashes($_POST['nombre']);
            $a_base = addslashes($_POST['base']);
            $a_extension = addslashes($_POST['extension']);
            //
            $array2['idAtraccion'] = $a_id;
            $array2['imagen']['datosBase64'] = $a_base;
            $array2['imagen']['formato'] = $a_extension;
            $array2['nombre'] = $a_nombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccion';
            $rActualizar_base = $consumo->Patch($url, $headers, $array2);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 6://Buscar disponibilidad boleta
            //tibosBoleta
            $fecha=date('d-m-Y');

            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/disponibilidad?fecha='.$fecha;
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
                
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;

        case 7://Actualiza nombre de la atraccion
            $id_a = addslashes($_POST['id']);
            $nombre_a = addslashes($_POST['nombre']);
            //
            $array3['idAtraccion'] = $id_a;
            $array3['nombre'] = $nombre_a;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccion';
            $rActualizar_base = $consumo->Patch($url, $headers, $array3);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 8://Actualiza estado atracciones
            $si = 0;
            $no = 0;
            $id_c = Array();
            $id_check = json_decode($_POST['id']);
            //
            foreach ($id_check as $clave => $valor) {
                $id_c = explode("-", $valor);
                $id_at = $id_c[2];
                $estado_at = ($id_c[1]=='ACTIVO') ? 'INACTIVO' : 'ACTIVO';            
                //
                $array4['estado'] = $estado_at;
                $array4['idAtraccion'] = $id_at;
                //
                $url = 'http://20.44.111.223:80/api/boleteria/atraccionEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array4);
                if($rActualizar_base->message == 'Se ha cambiado el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;

        case 9://Buscar cliente para la boleta
            if ($token != ''){
                $array5['tipoIdentificacion']=$tipo_identificacion;
                $array5['numeroIdentificacion']=$numero_documento;
                //
                $url = 'http://20.44.111.223:80/api/gestionClientes/cliente?tipoIdentificacion='.$tipo_identificacion.'&numeroIdentificacion='.$numero_documento;
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->GetParam($url, $headers,$array5); 
                //
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;

        case 10://Cargar datos servicio adicional
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicional';
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
                
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            } 
        break;
        
        case 11:
            $arr_nombres=explode(" ",$nombre);
            $nombresN=$arr_nombres[0];
            $apellidosN=$arr_nombres[1];
            $array['email']=$email;
            $array['telefono']=$telefono;
            #$array['estado']='ACTIVO';
            $array['fechaNacimiento']='01-01-1920';
            $array['tipoIdentificacion']=$tipo_identificacion;
            $array['numeroIdentificacion']=$numero_documento;
            $array['primerNombre']=$nombresN;
            $array['primerApellido']=$apellidosN;

            //
            $url = 'http://20.44.111.223:80/api/gestionClientes/cliente';
            //$rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
            $rGuardar = $consumo->Post($url, $headers, $array);
            if($rGuardar->message == 'Se ha creado el cliente'){
            echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]);
            }else{
            echo json_encode(['sts'=>'NO','resultado'=>$rGuardar]);
            }

        break;

        case 12://Guarda reserva de la boleta
            $fecha_actual=date('d-m-Y');            
            
            $array7['fecha']=$fecha_actual;
            $array7['tipoIdentificacion']=$tipo_identificacion;
            $array7['numeroIdentificacion']=$numero_documento;
            $array7['boletas']= json_decode($boletas);            
            //
            $url = 'http://20.44.111.223:80/api/boleteria/reserva';
            $rGuardar = $consumo->Post($url, $headers, $array7);
            //
            if($rGuardar->message == 'Se ha creado la reserva'){
                echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]); 
            }else{
                echo json_encode(['sts'=>'NO','resultado'=>$rGuardar]);
            } 
        break;

        case 13://Guarda reserva servicio adicional          
            $array8['idReserva']=$idreserva;            
            $array8['serviciosAdicionales']= json_decode($adicionales);            
            //
            $url = 'http://20.44.111.223:80/api/boleteria/reservaServicioAdicional';
            $rGuardar = $consumo->Post($url, $headers, $array8);
            //
            if($rGuardar->message == 'Se han agregado los servicios adicionales a la reserva'){
                echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]); 
            }else{
                echo json_encode(['sts'=>'NO','resultado'=>$rGuardar]);
            } 
        break;

        case 14://Buscar reserva
            $fecha_hoy=date('d-m-Y');
            if ($token != '' && $numero_identificacion!='' && $tipo_identificacion!='') {
                $url = "http://20.44.111.223:80/api/boleteria/buscarReserva?filter=cliente.identificacion.numero%3A%27".$numero_identificacion."%27%20and%20cliente.identificacion.tipo%3A%27".$tipo_identificacion."%27%20and%20fecha%3A%27".$fecha_hoy."%27";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers);                 
                
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos[0]]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene reserva']);            
                }            
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;                

        case 15://OBTIENE LOS CASILLEROS
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/casilleros';                
                $rDatos = $consumo->Get($url, $headers);                 
                if ($rDatos != '') {
                    
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                } 
            }else {
                    die('Se produjo un Error al generar el Token');
            }        
        break;

        case 16://Actualiza estado condicion de acceso
            $si = 0;
            $no = 0;
            $id_c = Array();
            $id_check = json_decode($_POST['id']);
            //
            foreach ($id_check as $clave => $valor) {
                $id_c = explode("-", $valor);
                $id_at = $id_c[2];
                $estado_at = ($id_c[1]=='ACTIVO') ? 'INACTIVO' : 'ACTIVO';            
                //
                $array9['estado'] = $estado_at;
                $array9['idCondicionAcceso'] = $id_at;
                //
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAccesoEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array9);
                if($rActualizar_base->message == 'Se ha cambiado el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;

        case 17://Actualiza solo nombre condicion acceso
            $id_c = addslashes($_POST['id']);
            $nombre_c = addslashes($_POST['nombre']);
            //
            $array10['idCondicionAcceso'] = $id_c;
            $array10['nombre'] = $nombre_c;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rActualizar_base = $consumo->Patch($url, $headers, $array10);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 18://Actualiza imagen y nombre condicion de acceso
            $a_id = addslashes($_POST['id']);
            $a_nombre = addslashes($_POST['nombre']);
            $a_base = addslashes($_POST['base']);
            $a_extension = addslashes($_POST['extension']);
            //
            $array11['idCondicionAcceso'] = $a_id;
            $array11['imagen']['datosBase64'] = $a_base;
            $array11['imagen']['formato'] = $a_extension;
            $array11['nombre'] = $a_nombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rActualizar_base = $consumo->Patch($url, $headers, $array11);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 19://Guardar condicion de acceso
            $anombre = addslashes($_POST['nombre']);
            $aimagen = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']);
            //
            $array12['estado'] = 'ACTIVO';
            $array12['imagen']['datosBase64'] = $aimagen;
            $array12['imagen']['formato'] = $aextension;
            $array12['nombre'] = $anombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rGuardar = $consumo->Post($url, $headers, $array12);
            if($rGuardar->message == 'Se ha creado la condicion de acceso'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;

        case 20://OBTIENE CONDICION DE ACCESO
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso?incluirImagen=true';                
                $rDatos = $consumo->Get($url, $headers);                 
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            }else{
                die('Se produjo un Error al generar el Token');
            }       
        break;

        case 21://Buscar reserva
            $fecha_hoy=date('d-m-Y');
            if ($token != '' && $numero_identificacion!='' && $tipo_identificacion!='') {
                $url = "http://20.44.111.223:80/api/boleteria/buscarReserva?filter=cliente.identificacion.numero%3A%27".$numero_identificacion."%27%20and%20cliente.identificacion.tipo%3A%27".$tipo_identificacion."%27%20and%20fecha%3A%27".$fecha_hoy."%27";
                $rDatos = $consumo->Get($url, $headers);                 
                
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene reserva']);            
                }            
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;

        case 22://Guarda visitante          
            /*$array['estado'] = 'ACTIVO';
            $array['imagen']['datosBase64'] = $aimagen;
            $array['imagen']['formato'] = $aextension;
            $array['nombre'] = $anombre;*/

            $arr_nombres=explode(" ",$nombre);            

            if($token!='' && $nombre!='' && $apellido!='' && $fecha_nacimiento!='' && $idreserva!='' && $idboleta!=''){
                $array13['nombre'] = $nombre;
                $array13['apellido']=$apellido;
                $array13['idReserva']=$idreserva;
                $array13['idBoleta']=$idboleta;

                $ar_fecha=explode("-",$fecha_nacimiento);
                $nueva_fecha_nacimiento=$ar_fecha[2]."-".$ar_fecha[1]."-".$ar_fecha[0];
                $array13['fechaNacimiento']=$nueva_fecha_nacimiento;

                if($tipo_identificacion!='' ){
                    $array13['tipoIdentificacion']=$tipo_identificacion;
                }
                if($numero_identificacion!=''){
                    $array13['numeroIdentificacion']=$numero_identificacion;
                }
                //
                $url = 'http://20.44.111.223:80/api/boleteria/visitante';
                $rGuardar = $consumo->Post($url, $headers, $array13);
                //
                if($rGuardar->message == 'Se ha creado el visitante'){
                    echo json_encode(['sts'=>'OK','resultado'=>'Se ha creado el visitante']); 
                }else{
                    echo json_encode(['sts'=>'NO']);
                }
            }else{
                echo "datos_incompletos";
            }           
        break;

        case 23://Busca reserva
            if ($token != '' && $idboleta!='') {
                $url = "http://20.44.111.223/api/boleteria/buscarReserva?filter=boletas.id%3A%27".$idboleta."%27";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
            
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene visitante']);            
                }            
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;
        
        case 24://Guarda condicion de acceso 
            $id_co = addslashes($_POST['id_con']);
            $id_at = addslashes($_POST['id_atra']);
            //            
            $array14['idAtraccion'] = $id_at;
            $array14['idCondicionAcceso'] = $id_co;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccionCondicionAcceso';
            $rGuardar = $consumo->Post($url, $headers, $array14);
            //
            if($rGuardar->message == 'Se ha agregado la condicion de acceso'){
                echo json_encode(['sts'=>'OK']); 
            }else if($rGuardar->message == 'La atraccion ya tiene esta condicion de acceso'){
                echo json_encode(['sts'=>'RPT']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }
        break;

        case 25://Busca condicion de acceso de la atraccion
            if ($token != '') {
                $id_a = addslashes($_POST['id']);
                $url = 'http://20.44.111.223:80/api/boleteria/atraccion?idAtraccion='.$id_a;
                $rDatos = $consumo->Get($url, $headers); 
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;

        case 26://Elimina condicion de acceso de la atraccion
            $id_co = addslashes($_POST['id_del_con']);
            $id_at = addslashes($_POST['id_del_atra']);
            //            
            $array15['idAtraccion'] = $id_at;
            $array15['idCondicionAcceso'] = $id_co;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccionCondicionAcceso';
            $rEliminar = $consumo->Delete($url, $headers, $array15);
            if($rEliminar->message == 'Se ha removido la condicion de acceso'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }
        break;
        //Servicio Cargar datos "Servicios adicionales" - by:Alfonso
        case 27:
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicional?incluirImagen=true';
                $rDatos = $consumo->Get($url, $headers); 
                
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;
        //Obtiene las categorias del serivicio adicional
        case 28: 
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/categoriaServicio?incluirImagen=true';                
                $rDatos = $consumo->Get($url, $headers);                 
                if ($rDatos != '') {

                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }

            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;
        //Guarda categorias para servicios adicionales
        case 29: 
            $anombre = addslashes($_POST['nombre']);
            //
            $array16['nombre'] = $anombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/categoriaServicio';
            $rGuardar = $consumo->Post($url, $headers, $array16);
            if($rGuardar->message == 'Se ha creado la categoria de servicio'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;
        //Actualiza nombre de la categoria del servicio adicional
        case 30: 
            $cat_id = addslashes($_POST['id']);
            $cat_nombre = addslashes($_POST['nombre']);
            //
            $array17['idCategoriaServicio'] = $cat_id;
            $array17['nombre'] = $cat_nombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/categoriaServicio';
            $rActualizar_base = $consumo->Patch($url, $headers, $array17);
            //
            if($rActualizar_base->message == 'Se han actualizado los datos'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;
        //Activa/desactiva categoria del servicio adicional
        case 31:
            $si = 0;
            $no = 0;
            $id_c = Array();
            $id_check = json_decode($_POST['id']);
            //
            foreach ($id_check as $clave => $valor) {
                $id_v = explode("-", $valor);
                $id_sc = $id_v[2];
                $estado_sc = ($id_v[1]=='ACTIVO') ? 'INACTIVO' : 'ACTIVO';            
                //
                $array18['idCategoriaServicio'] = $id_sc;
                $array18['estado'] = $estado_sc;                
                //                
                $url = 'http://20.44.111.223:80/api/boleteria/categoriaServicioEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array18);
                //
                if($rActualizar_base->message == 'Se ha cambiado el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;
        //Guarda servicio adicional
        case 32:            
            //
            $sdnombre = addslashes($_POST['nombre']);
            $sdprecio = addslashes($_POST['precio']);
            $sdidcateg = addslashes($_POST['idcateg']);
            $sdimagen = addslashes($_POST['imagen']);
            $sdextension = addslashes($_POST['extension']);
            //
            $array19['nombre'] = $sdnombre;
            $array19['precio'] = $sdprecio;
            $array19['idCategoriaServicio'] = $sdidcateg;
            $array19['imagen']['formato'] = $sdextension;
            $array19['imagen']['datosBase64'] = $sdimagen;         
            //
            $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicional';
            $rGuardar = $consumo->Post($url, $headers, $array19);
            if($rGuardar->message == 'Se ha creado el servicio'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;
        //Actualiza servicio adicional
        case 33: 
            $sa_id = addslashes($_POST['id']);
            $sa_nombre = addslashes($_POST['nombre']);
            $sa_precio = addslashes($_POST['precio']);
            $sa_idcat = addslashes($_POST['idcat']);
            $sa_base = addslashes($_POST['base']);
            $sa_extension = addslashes($_POST['extension']);
            //
            $array20['idServicioAdicional'] = $sa_id;
            if($sa_nombre != '0'){ $array20['nombre'] = $sa_nombre; }
            if($sa_extension != '0'){ 
                $array20['imagen']['formato'] = $sa_extension;
                $array20['imagen']['datosBase64'] = $sa_base;             
            }
            if($sa_precio != 0){ $array20['precio'] = $sa_precio; }
            if($sa_idcat != 0){ $array20['idCategoriaServicio'] = $sa_idcat; }
            //
            $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicional';
            $rActualizar_base = $consumo->Patch($url, $headers, $array20);
            //
            if($rActualizar_base->message == 'Se han actualizado los datos'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;
        //Activa/Desactiva servicio adicional
        case 34:
            $si = 0;
            $no = 0;
            $id_c = Array();
            $id_check = json_decode($_POST['id']);
            //
            foreach ($id_check as $clave => $valor) {
                $id_sav = explode("-", $valor);
                $id_sa = $id_sav[2];
                $estado_sa = ($id_sav[1]=='ACTIVO') ? 'INACTIVO' : 'ACTIVO';            
                //
                $array21['idServicioAdicional'] = $id_sa;
                $array21['estado'] = $estado_sa;                
                //
                $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicionalEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array21);
                if($rActualizar_base->message == 'Se ha cambiando el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;
        //Carga recepcion del pago
        case 35: 
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/recepcionPago';                
                $rDatos = $consumo->Get($url, $headers);
                $r35 = isset($rDatos->message) ? 0 : 1;
                if ($r35 == 1){
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'msg'=>$rDatos->message]);
                }

            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;
        //Cargar datos "Metodo de pago" - by:Alfonso
        case 36:
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/metodoPago';
                $rDatos = $consumo->Get($url, $headers); 
                $r36 = isset($rDatos->message) ? 0 : 1;
                if ($r36 == 1){
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'msg'=>$rDatos->message]);
                }
            } else {
                die('Se produjo un Error al generar el Token');
            }       
        break;
        //Guarda Recepcion de pago
        case 37: 
            $pnombre = addslashes($_POST['nombre']);
            //
            $array22['nombre'] = $pnombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/recepcionPago';
            $rGuardar = $consumo->Post($url, $headers, $array22);
            if($rGuardar->message == 'Se ha creado la recepcion de pago'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;
        //Guarda metodo de pago
        case 38: 
            /*
            {
              "nombre": "string",
              "cuentaDestino": "string",
              "tipo": "EFECTIVO",
              "requiereDatosAutorizacion": true,
              "recepcionPago": [
                0
              ]
            }
            */ 
            //
            $pmnombre = addslashes($_POST['nombre']);
            $pmcuenta = addslashes($_POST['cuenta']);
            $pmtipo = addslashes($_POST['tipo']);
            $pmrecep = addslashes($_POST['recep']);
            $pmchk = addslashes($_POST['chk']);
            //
            $array23['nombre'] = $pmnombre;
            $array23['cuentaDestino'] = $pmcuenta;
            $array23['tipo'] = $pmtipo;
            $array23['requiereDatosAutorizacion'] = $pmchk;
            $array23['recepcionPago'] = json_decode($pmrecep); 
            //
            $url = 'http://20.44.111.223:80/api/boleteria/metodoPago';
            $rGuardar = $consumo->Post($url, $headers, $array23);
            print_r($rGuardar);
            if($rGuardar->message == 'Se ha creado el metodo de pago'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;
        //Actualiza nombre de la recepcion de pago
        case 39: 
            $pm_id = addslashes($_POST['id']);
            $pm_nombre = addslashes($_POST['nombre']);
            //
            $array24['idRecepcionPago'] = $pm_id;
            $array24['nombre'] = $pm_nombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/recepcionPago';
            $rActualizar_pm = $consumo->Patch($url, $headers, $array24);
            //
            if($rActualizar_pm->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;
        //Activa/Desactiva recepcion de pago
        case 40:
            $si = 0;
            $no = 0;
            $id_c = Array();
            $id_check = json_decode($_POST['id']);            
            //
            foreach ($id_check as $clave => $valor) {
                $id_v = explode("-", $valor);
                $id_sc = $id_v[2];
                $estado_sc = ($id_v[1]=='ACTIVO') ? 'INACTIVO' : 'ACTIVO';            
                //
                $array25['idRecepcionPago'] = $id_sc;
                $array25['estado'] = $estado_sc;                
                //                
                $url = 'http://20.44.111.223:80/api/boleteria/recepcionPagoEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array25);
                //
                if($rActualizar_base->message == 'Se ha cambiado el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;
        //Actualiza servicio adicional
        case 41:  //data: { op: '41', id: id, nombre: nombre, : cuentad, : tipo, : recepcion, : chk },
            $pm_id = addslashes($_POST['id']);
            $pm_nombre = addslashes($_POST['nombre']);
            $pm_cuentad = addslashes($_POST['cuentad']);
            $pm_tipo = addslashes($_POST['tipo']);
            $pm_base = addslashes($_POST['recepcion']);
            $pm_extension = addslashes($_POST['chk']);
            //
            $array20['idServicioAdicional'] = $pm_id;
            if($pm_nombre != '0'){ $array20['nombre'] = $pm_nombre; }
            if($pm_extension != '0'){ 
                $array20['imagen']['formato'] = $pm_extension;
                $array20['imagen']['datosBase64'] = $pm_base;             
            }
            if($pm_cuentad != 0){ $array20['precio'] = $pm_cuentad; }
            if($pm_tipo != 0){ $array20['idCategoriaServicio'] = $pm_tipo; }
            //
            $url = 'http://20.44.111.223:80/api/boleteria/metodoPago';
            $rActualizar_base = $consumo->Patch($url, $headers, $array20);
            //
            if($rActualizar_base->message == 'Se han actualizado los datos'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;
        //
        default:
            echo 'No se seleccionó ninguna opción';
    }
//
?>
