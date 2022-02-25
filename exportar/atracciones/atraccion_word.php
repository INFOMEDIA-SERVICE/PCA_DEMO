<?php
   session_start();
   /**
    * Exportar con Word para Atracciones
    * User: Alfonso Atencio
    * Date: 02/25/2022
    * Time: 09:18
    */

   require_once '../../main.php'; 

   header("Content-type: application/vnd.ms-word");
   header("Content-Disposition: attachment; Filename=Atracciones.doc");
?>
 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 
   <head>
      <meta charset="Windows-1252" />
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
 
      <h1>Ejemplo de archivo de Word generado mediante PHP!</h1>
      <p>Este es un archivo de ejemplo donde se demuestran las posibilidades para generar archivos DOC din&aacute;micamente.</p>

      <table class="table">
         <thead>							  
            <tr class="row ">               
               <th class="col-1 text-center"><h2>Id</h2></th>
               <th class="col-1 text-center"><h2>Nombre</h2></th>
               <!--<th class="col-2 text-center"><h2>Imagen</h2></th>-->
               <th class="col-1 text-center"><h2>Creado Por</h2></th>
               <th class="col-1 text-center"><h2>Fecha Creacion</h2></th>
               <th class="col-1 text-center"><h2>Modificado Por</h2></th>
               <th class="col-1 text-center"><h2>Fecha Modificaci&oacute;n</h2></th>
               <th class="col-1 text-center"><h2>Estado</h2></th>               										
            </tr>
         </thead>
         <tbody>
            <?php
               if ($rDatos != '') {
                  foreach ($rDatos as $clave => $valor) {
                     print_r($valor->id); 
                     echo 'td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ $valor->id +'</h4></td>';
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+  $valor->nombre +'</h4></td>';
                     //'<td class="col-2 d-flex align-items-center justify-content-center">' + ver_imagen + '</td>'+
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+  $valor->creadoPor +'</h4></td>';
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+  $valor->fechaCreado +'</h4></td>';
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+  $valor->modificadoPor +'</h4></td>';
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+  $valor->fechaModificado +'</h4></td>';
                     echo '<td class="col-1 d-flex align-items-center justify-content-center"><h4>'+ $valor->estado +'</h4></td>';	
                  }
               } else {                
                  //echo json_encode(['sts'=>'NO']);
               }
               
               /*<tr class="row py-3">
                  <td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/edit.png" class="img-fluid"></div></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4><input type="checkbox"></h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>1</h2></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>Sierra Nevada</h4></td>
                  <td class="col-2 d-flex align-items-center justify-content-center"><img src="imagenes/atraccion.jpg" width="50%" height="50%" ></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario1</h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>usuario2</h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>21-02-2022 10:00:00</h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><h4>Activo</h4></td>
                  <td class="col-1 d-flex align-items-center justify-content-center"><div class="f-icono mr-2"><img src="imagenes/+.png"></div></td>										
               </tr>*/
            ?>
           
         </tboby>	
      </table>							

   </body>
 
</html>