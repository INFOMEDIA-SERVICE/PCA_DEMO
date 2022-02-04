<?php

    class Condiciones
    {
        public function cargarCondiciones($token){
            //
            $headers = array();
            $headers[] = 'Authorization: Bearer '.$token->accessToken->token;
            $headers[] = 'Content-Type: application/json';
            //
            //Enviamos datos para recibir respuesta de 
            $ch = curl_init('http://20.44.111.223:80/api/boleteria/condicionAcceso'); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
            //
            $result = curl_exec($ch);
            curl_close($ch);
            
            $result = json_decode($result);
            return($result);
        }
    }
?>