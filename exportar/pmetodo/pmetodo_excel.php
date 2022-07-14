<?php
   session_start();
   /**
    * Exportar con excel para Categoria del servicio adicional
    * User: Alfonso Atencio
    * Date: 05/Mayo/2022
    * Time: 14:30
    */

   require_once '../../main.php'; 

   header("Content-type: application/vnd.ms-excel charset=UTF-8"); 
   header("Content-Disposition: attachment; Filename=Metodo_de_pago.xls");
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
            $url = 'http://20.44.111.223:80/api/boleteria/metodoPago';
            $rDatos = $consumo->Get($url, $headers);            
        } else {
            die('Se produjo un Error al generar el Token');
        }       
      ?>
 
      <h3>Metodo de pago</h3>
      <table border="0">
         <thead>							  
            <tr>               
               <th><h4>Id</h4></th>
               <th><h4>Nombre</h4></th>
               <th><h4>Cuenta</h4></th>
               <th><h4>Tipo</h4></th>
               <th><h4>Autorizaci&oacute;n</h4></th>
               <th><h4>Recepeci&oacute;n pago</h4></th>
               <!--<th><h4>Creado Por</h4></th>
               <th><h4>Fecha Creación</h4></th>
               <th><h4>Modificado Por</h4></th>
               <th><h4>Fecha Modificaci&oacute;n</h4></th>-->
               <th><h4>Estado</h4></th>               										
            </tr>
         </thead>
         <tbody>
         <?php
            if ($rDatos != '') {
               foreach ($rDatos as $clave => $valor){
                  $recep_pago = "";
                  foreach ($valor->recepcionPago as $key => $value){
                     $recep_pago .= $value->nombre."<br/>";                                                            
                  }
                  $requiereauto = $valor->requiereDatosAutorizacion == 1 ? $requiereauto = "Si" : "No";               
                  $modificado = isset($valor->modificadoPor) ? $valor->modificadoPor : '';
                  $fmodificado = isset($valor->fechaModificado) ? $valor->fechaModificado : '';
                  echo '<tr>'; 
                  echo '<td>'.$valor->id.'</td>';
                  echo '<td>'.$valor->nombre.'</h4></td>';
                  //'<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                  echo '<td>'.$valor->cuentaDestino.'</td>';
                  echo '<td>'.$valor->tipo.'</td>';
                  echo '<td>'.$requiereauto.'</td>';
                  echo '<td>'.$recep_pago.'</td>';
                  /*echo '<td>'.$valor->creadoPor.'</td>';
                  echo '<td>'.$valor->fechaCreado.'</td>';
                  echo '<td>'.$modificado.'</td>';
                  echo '<td>'.$fmodificado.'</td>';*/
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
