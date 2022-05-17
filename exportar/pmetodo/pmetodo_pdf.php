<?php
    session_start();
    /**
    * Exportar con PDF para Metodo de pago
    * User: Alfonso Atencio
    * Date: 02/25/2022
    * Time: 14:30
    */
    require_once '../../lib/dompdf/autoload.inc.php'; 
    require_once '../../main.php'; 

    $tokenRefresh = $llamar_token->refreshToken();
    $token=$_SESSION['accessToken'];
    $headers[] = 'Authorization: Bearer '.$token;
    $headers[] = 'Content-Type: application/json'; 
    //
    if ($token != '') {
      $url = 'http://20.44.111.223:80/api/boleteria/metodoPago';
      $rDatos = $consumo->Get($url, $headers);            
    }else {
        die('Se produjo un Error al generar el Token');
    }       
    $codigoHTML='
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">    
    <head>
        <meta charset="UTF-8" />
    </head>    
    <body>       
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
               <th><h4>Fecha Creacion</h4></th>
               <th><h4>Modificado Por</h4></th>
               <th><h4>Fecha Modificaci&oacute;n</h4></th>-->
               <th><h4>Estado</h4></th>                                                     
            </tr>
            </thead>
            <tbody>';
            if ($rDatos != '') {
               foreach ($rDatos as $clave => $valor) {
                    $recep_pago = "";
                    foreach ($valor->recepcionPago as $key => $value){
                        $recep_pago .= $value->nombre."<br/>";                                                            
                    }
                    $requiereauto = $valor->requiereDatosAutorizacion == 1 ? $requiereauto = "Si" : "No";
                    $modificado = isset($valor->modificadoPor) ? $valor->modificadoPor : '';
                    $fmodificado = isset($valor->fechaModificado) ? $valor->fechaModificado : '';
                    $codigoHTML.='
                    <tr>                 
                        <td>'.$valor->id.'</td>
                        <td>'.$valor->nombre.'</h4></td>;                  
                        <td>'.$valor->cuentaDestino.'</td>;
                        <td>'.$valor->tipo.'</td>;
                        <td>'.$requiereauto.'</td>;
                        <td>'.$recep_pago.'</td>;                  
                        <td>'.$valor->estado.'</h4></td>;
                    </tr>';    	
               }              
            }else {
                $codigoHTML.='                
                <tr>
                    <td colspan="7">No se encontraron datos<td>
                </tr>';
            }
            $codigoHTML.='
            </tboby>	
        </table>
    </body>
    </html>';
    use Dompdf\Dompdf; 
    $dompdf = new Dompdf();

    // Load HTML content 
    $dompdf->loadHtml($codigoHTML); 
     
    // Load html file 
    //$html = file_get_contents("index_pdf.html"); 
    //$dompdf->loadHtml($html); 
     
    //$dompdf->setPaper('A4', 'landscape'); 

    $dompdf->render(); 
    $dompdf->stream("Metodo_de_pago.pdf");
    //$dompdf->stream("niceshipest", array("Attachment" => 0));
?>