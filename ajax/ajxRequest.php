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
            //print_r($token);
            //echo "</br>";
            print_r($token->accessToken->token);
            //print_r($token->contentToken->token);
            //print_r($token->refreshToken->token);
            //
            if ($token->id != '') {
                //
                $headers = array();
                //$headers = ['Authorization: Bearer '.$token->accessToken->token];
                $headers[] = 'Authorization: Bearer '.$token->accessToken->token;
                $headers[] = 'Content-Type: application/json';
                //
                //Enviamos datos para recibir respuesta de 
                $ch = curl_init('http://20.44.111.223:80/api/boleteria/atraccion'); 
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
                //
                $result = curl_exec($ch);
                curl_close($ch);
                //$result = json_decode($result);
                echo "<br><br>";
                print_r($result); exit;                      
                //
                /*var settings3 = {
					"url": "http://20.44.111.223:80/api/boleteria/atracciones",
					//"url": "http://20.44.111.223:80/api/boleteria/tiposBoleta?incluirImagen=true",
					"method": "GET",
					"async": false,
					"timeout": 0,
					"headers": {
						"Authorization": "Bearer "+localStorage.getItem('accessToken')
					},
				}; */
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
