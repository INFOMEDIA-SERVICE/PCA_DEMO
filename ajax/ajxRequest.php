<?php
    /**
     * Solicitudes y respuestas con Atracciones
     * User: Alfonso Atencio
     * Date: 01/30/2022
     * Time: 17:22
     */

    require_once '../main.php'; 
    
    //Tipo de peticion
    $op = addslashes($_POST['op']); 
    //var toke = localStorage.getItem('accessToken');
	//var contenToke = localStorage.getItem('contenToken');
    switch ($op) {
        case 1://Servicio Cargar datos atracciones - by:Alfonso
            //
            $token = $llamar_token->generarToken();
            //
            if ($token->id != '') {
                $rDatos = $atrac->cargarAtracciones($token); 
                
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
            $token = $llamar_token->generarToken();
            //
            if ($token->id != '') {
                $condiDatos = $condi->cargarCondiciones($token); 
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
            $token = $llamar_token->generarToken();
            //
            $anombre = addslashes($_POST['nombre']);
            $aimagen = addslashes($_POST['imagen']);
            $aextension = addslashes($_POST['extension']); 
            $rGuardar = $atrac->guardarAtraccion($anombre, $aimagen, $aextension, $token);
        break;
        
        default:
            echo 'No se seleccion� ninguna opci�n';
    }
//
?>
