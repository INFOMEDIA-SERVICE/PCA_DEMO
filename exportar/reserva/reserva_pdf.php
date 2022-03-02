<?php
    session_start();
    require_once '../../lib/dompdf/autoload.inc.php';  
    require_once '../../main.php'; 

    $tokenRefresh = $llamar_token->refreshToken();
    $token=$_SESSION['accessToken'];
    $headers[] = 'Authorization: Bearer '.$token;
    $headers[] = 'Content-Type: application/json'; 


    if ($token != '') {
        $url = 'http://20.44.111.223:80/api/boleteria/reserva?idReserva=9e9ecd5b-c1f6-49cb-88bd-f8ace50be67f';
        //$rDatos = $atrac->cargarAtracciones($token);
        $rDatos = $consumo->Get($url, $headers); 
        /*echo "<pre>";
        print_r($rDatos);
        echo "</pre>";exit;*/
        
        if ($rDatos != '') {
            //echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]);
            $idreserva=$rDatos->id;
            $nombre_cliente=$rDatos->cliente->nombreCompleto;
            $fecha_reserva=$rDatos->fecha;
            $documento_reserva=$rDatos->cliente->identificacion->tipo.' '.$rDatos->cliente->identificacion->numero; 
        } else {                
            //echo json_encode(['sts'=>'NO']);
        }

    } else {
        die('Se produjo un Error al generar el Token');
    }  


    //exit;

    use Dompdf\Dompdf; 
    $dompdf = new Dompdf();

    $html='<h1 style="text-align:center;">PARQUE CARIBE AVENTURA</h1><hr width="100%"> <h2>Datos Reserva</h2><br> <table width="100%"> <tr><td width="50%">Numero de reserva</td><td width="50%">'.$idreserva.'</td></tr>  <tr><td width="50%">Fecha Reserva</td><td width="50%">'.$fecha_reserva.'</td></tr> <tr><td width="50%">Cliente:</td><td width="50%">'.$nombre_cliente.'</td></tr>  <tr><td width="50%">Documento:</td><td width="50%">'.$documento_reserva.'</td></tr> </table> <hr width="100%"> <h2>Detalle pasaportes</h2><br>';



    include('../../lib/phpqrcode/qrlib.php'); 
 
    $codesDir = "codes/";
    
    $html.='<table width="100%"> <tr> <td width="60%" ><b>Pasaporte</b></td> <td width="40%" style="text-align:center;"><b>Valor</b></td> </tr>';
    
    foreach ($rDatos->boletas as $key ) {

        $codeFile= $key->id.".png";

        #$codeFile = date('d-m-Y-h-i-s').'.png';
        QRcode::png($key->id, $codesDir.$codeFile, "H", 5); 
       // $html= '<img class="img-thumbnail" src="'.$codesDir.$codeFile.'" />';

        
        $html.=' <tr> <td width="60%" >'.$key->tipoBoleta->nombre.' <br> <img class="img-thumbnail" src="'.$codesDir.$codeFile.'" /> </td>  <td style="text-align:center;" width="40%">$'.$key->tipoBoleta->precio.'</td> </tr> <tr></tr> ';

    
   

    

    //echo $html;
    //echo "<br>";
    
    
       
    }

    $html.='</table> <script> window.print(); </script> ';


    echo $html;exit;



    // Load HTML content 
     $dompdf->loadHtml($html); 
     
    // Load html file 
    //$html = file_get_contents("index_pdf.html"); 
    //$dompdf->loadHtml($html); 
     
    //$dompdf->setPaper('A4', 'landscape'); 

    $dompdf->render(); 
    $dompdf->stream("Atracciones.pdf");
    //$dompdf->stream("niceshipest", array("Attachment" => 0));
?>