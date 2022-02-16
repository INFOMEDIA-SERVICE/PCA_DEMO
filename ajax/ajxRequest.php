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
                print_r($condiDatos);
                exit;
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

            if ($token != '') {
                $url = 'http://20.44.111.223:80/api/boleteria/tipoBoleta?incluirImagen=true';
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

        default:
            echo 'No se seleccionó ninguna opción';
    }
//
?>
