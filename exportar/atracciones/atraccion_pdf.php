<?php
    session_start();
    /**
    * Exportar con Word para Atracciones
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
      $url = 'http://20.44.111.223:80/api/boleteria/atraccion?incluirImagen=true';
      $rDatos = $consumo->Get($url, $headers);            
    }else {
        die('Se produjo un Error al generar el Token');
    }       
    $codigoHTML='
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">    
    <head>
        <meta charset="Windows-1252" />
    </head>    
    <body>       
        <h3>Atracciones</h3>
        <table border="0">
            <thead>							  
                <tr>               
                <th><h4>Id</h4></th>
                <th><h4>Nombre</h4></th>
                <!--<th class="col-2 text-center"><h4>Imagen</h4></th>-->
                <th><h4>Creado Por</h4></th>
                <th><h4>Fecha Creación</h4></th>
                <th><h4>Modificado Por</h4></th>
                <th><h4>Fecha Modificaci&oacute;n</h4></th>
                <th><h4>Estado</h4></th>               										
                </tr>
            </thead>
            <tbody>';
            if ($rDatos != '') {
               foreach ($rDatos as $clave => $valor) {
                    $codigoHTML.='
                    <tr>                 
                        <td>'.$valor->id.'</td>
                        <td>'.$valor->nombre.'</td>
                        <td>'.$valor->creadoPor.'</td>
                        <td>'.$valor->fechaCreado.'</td>
                        <td>'.$valor->modificadoPor.'</td>
                        <td>'.$valor->fechaModificado.'</td>
                        <td>'.$valor->estado.'</h4></td>
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
    $dompdf->stream("Atracciones.pdf");
    //$dompdf->stream("niceshipest", array("Attachment" => 0));
?>