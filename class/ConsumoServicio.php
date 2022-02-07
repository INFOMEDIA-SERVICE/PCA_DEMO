<?php
    class ConsumoServicio
    {
        /**
        * Generar Token de los servicios PCA - By: Alfonso - 30-Enero-2022
        */
        public function generarToken()
        {
            //Armando array y pasarlo a JSON para recibir token
            $array = ['password'=>'$Info.2021', 'username'=>'infomedia'];
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';

            //Enviando POST
            $ch = curl_init('http://20.44.111.223:80/api/auth/token');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            curl_close($ch);
                
            return json_decode($result);           
        }
    }        
?>