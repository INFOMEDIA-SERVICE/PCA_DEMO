<?php

    class Atracciones
    {
        public function cargarAtracciones($token){
            //            
            $headers = array();
            $header[] = 'Authorization: Bearer '.$token->accessToken->token;
            $headers[] = 'Content-Type: application/json';
            //
            //Enviamos datos para recibir respuesta de 
            $ch = curl_init('http://20.44.111.223:80/api/boleteria/atraccion?incluirImagen=true'); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
            //
            $result = curl_exec($ch);
            curl_close($ch);
            
            $result = json_decode($result);
            //print_r($result->status); exit;
            return($result);                           
        }
        //
        function guardarAtraccion($anom, $abase64, $aext, $token){
            //$array = ['estado'=>'ACTIVO', ['imagen']'datosBase64' => $abase64 'formato' => $aext), 'nombre'  => $anom ];
            //$array = array('estado' => 'ACTIVO', [imagen] => array('datosBase64' => $abase64, 'formato' => $aext), 'nombre'  => $anom);
            $array['estado'] = 'ACTIVO';
            $array['imagen']['datosBase64'] = $abase64;
            $array['imagen']['formato'] = $aext;
            $array['nombre'] = $anom;
                        
            print_r(json_encode($array)); 
            //
            $headers = array();
            $headers[] = 'Authorization: Bearer '.$token->accessToken->token;
            $headers[] = 'Content-Type: application/json';
            //
            //Enviamos datos para recibir respuesta de 
            $ch = curl_init('http://20.44.111.223:80/api/boleteria/atraccion'); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
            //
            $result = curl_exec($ch);
            curl_close($ch);
            
            $result = json_decode($result);
            return($result);
            //
            /*"url": "http://20.44.111.223:80/api/boleteria/atraccion",
				"method": "PATCH",
				"async": false,
				"timeout": 0,
				"headers": {
					"Authorization": "Bearer "+token,
					"Content-Type": "application/json"
				},
				"data": JSON.stringify({
					"idAtraccion": id,
					"imagen": {
						"datosBase64": base64,
						"formato": ext
					},
					"nombre": nombre
				})				               
			};*/
        }
    }
?>