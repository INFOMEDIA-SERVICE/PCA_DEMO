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
            $token = $llamar_token->ConsumoServicio();
            //print_r($token);
            //echo "</br>";
            //print_r($token->accessToken->token);
            //print_r($token->contentToken->token);
            //print_r($token->refreshToken->token);
            //
            if ($token->id != '') {
                //
                $token = $token->mensaje;
                //
                //Armando array para recibir datos de 
                $array = ['t'=>"getInfoCliente", 'documento'=>$documento, 'token'=>$token];
                $array = http_build_query($array, '', '&');
                //
                //Enviamos datos para recibir respuesta de 
                $ch = curl_init('https://');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
                //
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result);                      
                //
                if ($result->error == 0) {/* **************************************** */
                        
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
