<?php
   session_start();
   /**
    * Exportar con Word para Atracciones
    * User: Alfonso Atencio
    * Date: 02/25/2022
    * Time: 09:18
    */

   require_once '../../main.php'; 

   header("Content-Type: application/vnd.ms-word; charset=UTF-8");
   header("Content-Disposition: attachment; Filename=Atracciones.doc");
?>
 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 
   <head>
      <meta charset="UTF-8"/>
   </head>
 
   <body>
      <?php
         $tokenRefresh = $llamar_token->refreshToken();
         $token=$_SESSION['accessToken'];
         $headers[] = 'Authorization: Bearer '.$token;
         $headers[] = 'Content-Type: application/json'; 
         //
         if ($token != '') {
            $url = 'http://20.44.111.223:80/api/boleteria/atraccion?incluirImagen=true';
            $rDatos = $consumo->Get($url, $headers);            
        } else {
            die('Se produjo un Error al generar el Token');
        }       
      ?>
 
      <h3>Atracciones</h3>
      <table border="0">
         <thead>							  
            <tr>               
               <th><h4>Id</h4></th>
               <th><h4>Nombre</h4></th>
               <!--<th class="col-2 text-center"><h4>Imagen</h4></th>-->
               <th><h4>Creado Por</h4></th>
               <th><h4>Fecha Creacion</h4></th>
               <th><h4>Modificado Por</h4></th>
               <th><h4>Fecha Modificaci&oacute;n</h4></th>
               <th><h4>Estado</h4></th>               										
            </tr>
         </thead>
         <tbody>
         <?php
            if ($rDatos != '') {
               foreach ($rDatos as $clave => $valor) {
                  //print_r($valor->id);
                  echo '<tr>'; 
                  echo '<td>'.$valor->id.'</td>';
                  echo '<td>'.$valor->nombre.'</h4></td>';
                  //'<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                  echo '<td>'.$valor->creadoPor.'</td>';
                  echo '<td>'.$valor->fechaCreado.'</td>';
                  echo '<td>'.$valor->modificadoPor.'</td>';
                  echo '<td>'.$valor->fechaModificado.'</td>';
                  echo '<td>'.$valor->estado.'</h4></td>';
                  echo '</tr>';	
               }
            } else {                
               echo '<tr>';
               echo '<td colspan="7">No se encontraron datos<td>';
               echo '</tr>';
            }           
         ?>
           
         </tboby>	
      </table>							

   </body>
 
</html>