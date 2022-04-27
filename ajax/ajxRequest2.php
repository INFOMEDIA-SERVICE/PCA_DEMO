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

        case 2://Servicio Cargar datos condiciones - by:Nicolás
            //
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
                $condiDatos = $consumo->get($url, $headers); 
                //print_r($condiDatos);
                //exit;
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }

            } else {

                die('Se produjo un Error al generar el Token');
            }       
        break;      

        case 3:            
            //
            $anombre = addslashes($_POST['nombre']);
            $aimagen = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']);
            //
            $array['estado'] = 'ACTIVO';
            $array['imagen']['datosBase64'] = $aimagen;
            $array['imagen']['formato'] = $aextension;
            $array['nombre'] = $anombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/atraccion';
            //$rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
            $rGuardar = $consumo->Post($url, $headers, $array);
            //print_r($rGuardar);
            if($rGuardar->message == 'Se ha creado la atraccion'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }            
        break;

        case 4:
            $tokenRefresh = $llamar_token->refreshToken();

            /*echo "<br><br> ##### <pre>";
            print_r($tokenRefresh);
            echo "</pre>";*/
            break;


        case 5:
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

        case 6: 
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

        case 7:
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

        case 8:
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

        case 9:

            if ($token != '') {
                

                $array['tipoIdentificacion']=$tipo_identificacion;
                $array['numeroIdentificacion']=$numero_documento;

                $url = 'http://20.44.111.223:80/api/gestionClientes/cliente?tipoIdentificacion='.$tipo_identificacion.'&numeroIdentificacion='.$numero_documento;
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->GetParam($url, $headers,$array); 
                
                if ($rDatos != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO']);
                }

            } else {
                die('Se produjo un Error al generar el Token');
            }  



        break;

        case 10:

            $fecha_actual=date('d-m-Y');

            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/servicioAdicional';
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 

               # print_r($rDatos);#exit;

                $rDatos2=array();

                foreach ($rDatos as $key  ) {
                    //print_r($key->categoriaServicio->id); echo"<br>";

                    if($key->categoriaServicio->id==1){//casilleros

                        $url2 = 'http://20.44.111.223:80/api/boleteria/disponibilidadCasilleros?fecha='.$fecha_actual;
                        //$rDatos = $atrac->cargarAtracciones($token);
                        $disponibilidadCasilleros = $consumo->Get($url2, $headers); 

                        //print_r("Disaponibilidad casilleros: ");
                        //print_r($disponibilidadCasilleros);

                        $key->disponibilidadCasilleros=$disponibilidadCasilleros;

                        $rDatos2[]=$key;

                    }else{
                        $rDatos2[]=$key;
                    }


                }

                #print_r($rDatos2);

                //exit;
                
                if ($rDatos2 != '') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos2]); 
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
            $array['estado']='ACTIVO';
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
                echo json_encode(['sts'=>'NO']);
            } 
            


        break;

        case 12:

            $fecha_actual=date('d-m-Y');

            //echo "Fecha Actual:$fecha_actual";


           //print_r($boletas);
            
            $array['fecha']=$fecha_actual;
            $array['tipoIdentificacion']=$tipo_identificacion;
            $array['numeroIdentificacion']=$numero_documento;
            $array['boletas']= json_decode($boletas) ;
            

            
            //
            $url = 'http://20.44.111.223:80/api/boleteria/reserva';
            //$rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
            $rGuardar = $consumo->Post($url, $headers, $array);
            //print_r($rGuardar);
            if($rGuardar->message == 'Se ha creado la reserva'){
                echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]); 
            }else{
                echo json_encode(['sts'=>'NO','resultado'=>$rGuardar]);
            } 

        break;


        case 13:

          
            $array['idReserva']=$idreserva;
            
            $array['serviciosAdicionales']= json_decode($adicionales) ;
            
            //
            $url = 'http://20.44.111.223:80/api/boleteria/reservaServicioAdicional';
            //$rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
            $rGuardar = $consumo->Post($url, $headers, $array);
            //print_r($rGuardar);
            if($rGuardar->message == 'Se han agregado los servicios adicionales a la reserva'){

                if($cont_lockers>0){
                    $array2['idReserva']=$idreserva;
                    $array2['cantidad']=$cont_lockers;
                    $url2 = 'http://20.44.111.223:80/api/boleteria/reservaCasillas';
                    //$rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
                    $rGuardar2 = $consumo->Post($url2, $headers, $array2);
                }
                


                echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]); 
            }else{
                echo json_encode(['sts'=>'NO','resultado'=>$rGuardar]);
            } 

        break;


        case 14:

            $fecha_hoy=date('d-m-Y');
            if ($token != '' && $numero_identificacion!='' && $tipo_identificacion!='') {
                $url = "http://20.44.111.223:80/api/boleteria/buscarReserva?filter=cliente.identificacion.numero%3A%27".$numero_identificacion."%27%20and%20cliente.identificacion.tipo%3A%27".$tipo_identificacion."%27%20and%20fecha%3A%27".$fecha_hoy."%27";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
            
                #print_r($rDatos);exit;
                
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos[0]]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene reserva']);
            
                }
            
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;

                

        case 15: //OBTIENE LOS CASILLEROS
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

        case 16:
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
                $array5['estado'] = $estado_at;
                $array5['idCondicionAcceso'] = $id_at;
                //
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAccesoEstado';
                $rActualizar_base = $consumo->Patch($url, $headers, $array5);
                if($rActualizar_base->message == 'Se ha cambiado el estado'){
                    $si++;
                }else{
                   $no++;
                }
            }
            echo json_encode(['sts'=>'OK', 'stsNo'=>$no, 'stsSi'=>$si]);         
        break;

        case 17: //Actualiza solo nombre condicion acceso
            $id_c = addslashes($_POST['id']);
            $nombre_c = addslashes($_POST['nombre']);
            //
            $array6['idCondicionAcceso'] = $id_c;
            $array6['nombre'] = $nombre_c;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rActualizar_base = $consumo->Patch($url, $headers, $array6);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 18: //Actualiza imagen y nombre condicion de acceso
            $a_id = addslashes($_POST['id']);
            $a_nombre = addslashes($_POST['nombre']);
            $a_base = addslashes($_POST['base']);
            $a_extension = addslashes($_POST['extension']);
            //
            $array7['idCondicionAcceso'] = $a_id;
            $array7['imagen']['datosBase64'] = $a_base;
            $array7['imagen']['formato'] = $a_extension;
            $array7['nombre'] = $a_nombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rActualizar_base = $consumo->Patch($url, $headers, $array7);
            if($rActualizar_base->message == 'Se han realizado los cambios'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 19:            
            //
            $anombre = addslashes($_POST['nombre']);
            $aimagen = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']);
            //
            $array['estado'] = 'ACTIVO';
            $array['imagen']['datosBase64'] = $aimagen;
            $array['imagen']['formato'] = $aextension;
            $array['nombre'] = $anombre;
            //
            $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso';
            $rGuardar = $consumo->Post($url, $headers, $array);
            if($rGuardar->message == 'Se ha creado la condicion de acceso'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }
            
        break;

        case 20: //OBTIENE CONDICION DE ACCESO
            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/condicionAcceso?incluirImagen=true';                
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

        case 21:

            $fecha_hoy=date('d-m-Y');
            if ($token != '' && $numero_identificacion!='' && $tipo_identificacion!='') {
                $url = "http://20.44.111.223:80/api/boleteria/buscarReserva?filter=cliente.identificacion.numero%3A%27".$numero_identificacion."%27%20and%20cliente.identificacion.tipo%3A%27".$tipo_identificacion."%27%20and%20fecha%3A%27".$fecha_hoy."%27";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
            
                #print_r($rDatos);exit;
                
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene reserva']);
            
                }
            
            } else {
                die('Se produjo un Error al generar el Token');
            }
        break;


        case 22:            
            
            
            /*$array['estado'] = 'ACTIVO';
            $array['imagen']['datosBase64'] = $aimagen;
            $array['imagen']['formato'] = $aextension;
            $array['nombre'] = $anombre;*/

            $arr_nombres=explode(" ",$nombre);

            

            if($token!='' && $nombre!='' && $apellido!='' && $fecha_nacimiento!='' && $altura>0 && $idreserva!='' && $idboleta!=''){
                $array['nombre'] = $nombre;
                $array['apellido']=$apellido;
                $array['idReserva']=$idreserva;
                $array['idBoleta']=$idboleta;
                $array['estaturaCm']=$altura;

                $ar_fecha=explode("-",$fecha_nacimiento);

                $nueva_fecha_nacimiento=$ar_fecha[2]."-".$ar_fecha[1]."-".$ar_fecha[0];

                $array['fechaNacimiento']=$nueva_fecha_nacimiento;


                if($tipo_identificacion!='' ){
                    $array['tipoIdentificacion']=$tipo_identificacion;
                }

                if($numero_identificacion!=''){
                    $array['numeroIdentificacion']=$numero_identificacion;
                }

                //
                $url = 'http://20.44.111.223:80/api/boleteria/visitante';
                $rGuardar = $consumo->Post($url, $headers, $array);

                 

                $idvisitante=$rGuardar->id;

                if($idvisitante!=''){

                    if($reservarLocker==1){

                        $array_casillas_disponibles= explode(",",$casillas_disponibles);

                        if(count($array_casillas_disponibles)>0){

                            foreach ($array_casillas_disponibles as $key  ) {
                               $idcasilla=$key;
                            }

                            $array2['idVisitante'] = $idvisitante;
                            $array2['idCasilla']  = $idcasilla;
 
                            $url = 'http://20.44.111.223:80/api/boleteria/visitanteCasilla';
                            $asignarCasilla = $consumo->Patch($url, $headers, $array2);

                            //print_r($asignarCasilla);
                            

                        }

                    }


                }

                if($rGuardar->message == 'Se ha creado el visitante'){
                    echo json_encode(['sts'=>'OK','resultado'=>$rGuardar]); 
                }else{
                    echo json_encode(['sts'=>'NO']);
                }
                    

                


            }else{
                echo "datos_incompletos";
            }
            
            
        break;

        case 23:

            if ($token != '' && $idboleta!='') {
                $url = "http://20.44.111.223/api/boleteria/buscarReserva?filter=boletas.id%3A%27".$idboleta."%27";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 
            
                //print_r($rDatos);exit;
                
                if (count($rDatos)>0) {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No tiene visitante']);
            
                }
            
            } else {
                die('Se produjo un Error al generar el Token');
            }



        break;

        case 24:

            if($edadInicial>=0 && $edadFinal>0 && $fecha_nacimiento!=''){

                $fecha_actual=date("Y-m-d");

                $date1 = new DateTime($fecha_nacimiento);
                $date2 = new DateTime($fecha_actual);
                $diff = $date1->diff($date2);

                //print_r($diff);

                $edad_visitante=$diff->y;

                if($edad_visitante>=$edadInicial && $edad_visitante<=$edadFinal){
                    echo json_encode(['sts'=>'OK', 'resultado'=>"edad_aplica"]);
                }else{
                    echo json_encode(['sts'=>'NO', 'resultado'=>"La edad esta fuera del rango al permitido por el pasaporte ".$edadInicial." - ".$edadFinal]);
                }

               // echo json_encode(['sts'=>'OK', 'resultado'=>"El visitante tiene ".$edad_visitante." años"]); 



            }



        break;

        case 25:
            
            //
            $array2['idVisitante'] = $idvisitante;
            $array2['idcasilla']  = $idcasilla;
             
            //
            $url = 'http://20.44.111.223:80/api/boleteria/visitanteCasilla';
            $asignarCasilla = $consumo->Patch($url, $headers, $array2);

            print_r($asignarCasilla);

            if($asignarCasilla->message == ' '){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }           
        break;

        case 26:

            if ($token != ''  ) {
                $url = "http://20.44.111.223/api/configuracionGeneral/empresa";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers); 

                if ($rDatos!='') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No data']);
                }
            
            } else {
                die('Se produjo un Error al generar el Token');
            }


        break;

        case 27:

             
            //
            $array['nit'] = $nit;
            
            $array['nombre'] = $nombre;
            $array['telefono'] = $telefono;
            $array['direccion'] = $direccion;
            $array['razonSocial'] = $razonSocial;
            $array['terminosCondiciones'] = $terminosCondiciones;
            $array['resolucionDian'] = $resolucionDian;
            $array['decimales'] = $decimales;
            $array['formatoMoneda'] = $formatoMoneda;
            $array['emailRemitente'] = $emailRemitente;
            $array['logo']['datosBase64'] = $datosBase64;
            $array['logo']['formato'] = $formato;
            $array['accountAdminId']=$accountAdminId;
            //
            $url = 'http://20.44.111.223:80/api/configuracionGeneral/empresa';
            $rGuardar = $consumo->Post($url, $headers, $array);

            //print_r($rGuardar);exit;

            if($rGuardar->message == 'Datos guardados exitosamente'){
                echo json_encode(['sts'=>'OK']); 
            }else{
                echo json_encode(['sts'=>'NO']);
            }

        break;

        case 28:

            if ($token != ''  ) {
                $url = "http://20.44.111.223/api/auth/account";
                //$rDatos = $atrac->cargarAtracciones($token);
                $rDatos = $consumo->Get($url, $headers);
                
               // print_r($rDatos);exit;

                $select=' <select name="accountAdminId" id="accountAdminId" > <option value="'.$rDatos->id.'" >'.$rDatos->name.'</option> </select> ';

                if ($rDatos!='') {
                    echo json_encode(['sts'=>'OK', 'resultado'=>$select]); 
                } else {                
                    echo json_encode(['sts'=>'NO', 'resultado'=>'No data']);
                }
            
            } else {
                die('Se produjo un Error al generar el Token');
            }

        break;

        default:
            echo 'No se seleccionó ninguna opción';
    }
//
?>
