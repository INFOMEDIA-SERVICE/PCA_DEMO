<?php
    class Consumir
    {
        /**
        * Todos vamos a consumir esta clase al llamar las APIs PCA - By: Alfonso - 05-Febrero-2022
        */
        public function Post($url, $headers, $array)
        {
            //Enviando POST
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            curl_close($ch);
                
            return json_decode($result);           
        }
        //
        public function Get($url, $headers){
            //
            //Enviamos datos para recibir respuesta de 
            $ch = curl_init($url); 
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

        public function GetParam($url, $headers, $array){
            //
            //Enviamos datos para recibir respuesta de 
            $ch = curl_init($url); 
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
            //
            $result = curl_exec($ch);
            curl_close($ch);
            
            $result = json_decode($result);
            //print_r($result->status); exit;
            return($result);                           
        }
        //
        public function Patch($url, $headers, $array){
            //Enviando PATCH
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            curl_close($ch);
                
            return json_decode($result);    
        }        
    }
?>