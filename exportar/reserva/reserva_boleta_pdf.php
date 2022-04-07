<?php
//use PHPMailer\PHPMailer\PHPMailer;
    ini_set("memory_limit", "800M"); 
    ini_set("max_execution_time", "800");
    session_start();
    require_once '../../lib/dompdf/autoload.inc.php';  
    require_once '../../main.php';
    error_reporting(0); 

    extract($_REQUEST);

    

    $tokenRefresh = $llamar_token->refreshToken();
    $token=$_SESSION['accessToken'];
    $headers[] = 'Authorization: Bearer '.$token;
    $headers[] = 'Content-Type: application/json'; 
    $fecha_actual=date('Y-m-d h:i:s A');


    if ($token != '') {
        $url = 'http://20.44.111.223:80/api/boleteria/reserva?idReserva='.$idreserva;
        //$rDatos = $atrac->cargarAtracciones($token);
        $rDatos = $consumo->Get($url, $headers); 
        /*echo "<pre>";
        print_r($rDatos);
        echo "</pre>";exit;*/


        $url2 = 'http://20.44.111.223:80/api/boleteria/reservaServicioAdicional?idReserva='.$idreserva;
        //$rDatos = $atrac->cargarAtracciones($token);
        $rDatos2 = $consumo->Get($url2, $headers); 
        
        if ($rDatos != '') {
            //echo json_encode(['sts'=>'OK', 'resultado'=>$rDatos]);
            $idreserva=$rDatos->id;
            $nombre_cliente=$rDatos->cliente->nombreCompleto;
            $fecha_reserva=$rDatos->fecha;
            $documento_reserva=$rDatos->cliente->identificacion->tipo.' '.$rDatos->cliente->identificacion->numero; 

            $array_detalle=array();

            foreach ($rDatos->boletas as $key ) {

                
                $array_detalle[$key->tipoBoleta->id]['cantidad']++;
                $array_detalle[$key->tipoBoleta->id]['idtipoBoleta']=$key->tipoBoleta->id;
                $array_detalle[$key->tipoBoleta->id]['precio']+=$key->tipoBoleta->precio;
                $array_detalle[$key->tipoBoleta->id]['nombre']= $key->tipoBoleta->nombre;               

            }

        } else {                
            //echo json_encode(['sts'=>'NO']);
        }

        if($rDatos2 !=''){
            $array_detalle_adicionales=array();
            foreach ($rDatos2 as $key ) {

                $array_detalle_adicionales[$key->servicioAdicional->id]['cantidad']=$key->cantidad;
                $array_detalle_adicionales[$key->servicioAdicional->id]['idServicioAdicional']=$key->servicioAdicional->id;
                $array_detalle_adicionales[$key->servicioAdicional->id]['precio']+= ($key->servicioAdicional->precio*$key->cantidad);
                $array_detalle_adicionales[$key->servicioAdicional->id]['nombre']= $key->servicioAdicional->nombre; 

            }


        }

        /*echo "<pre>";
        print_r($rDatos2);
        echo "</pre>";*/

    } else {
        die('Se produjo un Error al generar el Token');
    }  

    


                /*echo"<pre>";
                print_r($array_detalle);
                echo"</pre>";
                echo"<pre>";
                print_r($array_detalle_adicionales);
                echo"</pre>";*/

    //exit;

    

    use Dompdf\Dompdf; 
    
    $dompdf = new Dompdf();
    

    $html=' 
    <style> 

    .center2 {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
      }

    @page {
		margin-left: 1.5cm;
		margin-right: 0.1cm;
        margin-top: 0.1cm;
        margin-bottom : 0.1cm;
	}

    h1 { font-size: 80% }  
    h2 { font-size: 80% }  
    td { font-size: 80% } 
    p  { font-size: 70% } 
    </style>';

   /*
    
    $html.='<h1 style="text-align:center;"> PARQUE CARIBE AVENTURA</h1>
    <hr width="100%"> 

    <table width="100%">
        <tr>
            <td style="text-align:center;" width="100%">Nit: 830031632-9</td>
        </tr>

        <tr>
            <td style="text-align:center;" width="100%"><b>Reserva No.</b>    '.$idreserva.'  </td>
        </tr>

        <tr>
            <td style="text-align:center;" width="100%"><b>Fecha:</b> '.$fecha_actual.'  </td>
        </tr>

        <tr>
            <td style="text-align:center;" width="100%"><b>Cliente: </b>'.$nombre_cliente.' - '.$documento_reserva.' </td>
        </tr>
    </table>

    

    <h2 style="text-align:center;">Detalle de su compra</h2> 
    
    
    <table width="100%" > 
    <tr>
        <td width="33%" style="text-align:left;"><b>Descripción</b></td>
        <td width="33%" style="text-align:center;"><b>Cantidad</b></td>
        <td width="33%" style="text-align:right;"><b>Valor</b></td>
    </tr>  ';
    $sum_total=0;
    foreach ($array_detalle as $key)  {
        if($key['precio']>0){
        $html.=' <tr> 
        <td width="33%" style="text-align:left;">'.$key['nombre'].'</td>
        <td width="33%" style="text-align:center;">'.$key['cantidad'].'</td>
        <td width="33%" style="text-align:right;">$'. number_format($key['precio']) .'</td>
        </tr> ';
        $sum_total+=$key['precio'];
        }
    }

    foreach ($array_detalle_adicionales as $key)  {

        if($key['precio']>0){

            $html.=' <tr> 
        <td width="33%" style="text-align:left;">'.$key['nombre'].'</td>
        <td width="33%" style="text-align:center;">'.$key['cantidad'].'</td>
        <td width="33%" style="text-align:right;">$'.number_format($key['precio']).'</td>
        </tr> ';
        $sum_total+=$key['precio'];

        }
        
    }
    $html.=' <tr> 
    <td colspan="2" width="66%" ><b>TOTAL</b></td>
    
    
    <td width="33%" style="text-align:right;">$'.number_format($sum_total).'</td>
    </tr> </table> 

  
    
    <h2 style="text-align:center;">Terminos y condiciones</h2>

    <table width="100%">
        <tr>
            <td><p> Todos los precios incluyen valor del servicio y están en pesos colombianos<br>Lorem ipsum dolor sit amet consectetur adipiscing elit, imperdiet justo rhoncus auctor praesent phasellus ultrices, eu fermentum integer tempus sociosqu placerat. Leo vitae faucibus velit a suscipit quam fames inceptos parturient natoque volutpat ridiculus tristique pellentesque dapibus neque, dis taciti magnis massa varius dictumst in vivamus id platea libero sodales rhoncus nunc enim. Pharetra imperdiet magna laoreet nascetur varius aliquam fringilla aliquet, consequat nulla vitae ligula torquent eleifend dignissim quisque a, magnis cursus primis senectus porttitor massa netus.</p></td>
        </tr>
    </table>
    
    
    <div style="page-break-after:always;"></div>';*/
    


    

    include('../../lib/phpqrcode/qrlib.php'); 
 
    $codesDir = "codes/";
    
    $html.='<table width="100%" style="text-align:center;"> <tr> <td style="text-align:center;"> <img src="../../imagenes/pca_pdf.png"  width="100" height="70"> </td> </tr>  ';

    
    
    foreach ($rDatos->boletas as $key ) {

        if($idboleta==$key->id){

            /*echo "<pre>";
            print_r($key);
            echo "</pre>";*/


            $codeFile= $key->id.".png";

            $rest = substr($key->id, -9);

            QRcode::png($key->id, $codesDir.$codeFile, "H", 3); 

            $html.=' <tr> <td width="100%" style="text-align:center;" >'.$key->tipoBoleta->nombre.' <br> Boleta valida para: <br> '.$fecha_reserva.' <br> '.$nombre.' '.$apellido.' <br> # Locker: '.$key->visitante->reservaCasilla->casilla->id.' - Cod: '.$key->visitante->codigo.' <br> # Boleta: '.$rest.' <img class="img-thumbnail "  width="140" height="140" src="'.$codesDir.$codeFile.'" /> <br> <span class="El-cdigo-QR-te-servir-para-identificarte-e-ingresar-al-parque">
            El código QR te servirá para identificarte e ingresar al parque
            </span> </td>  <td style="text-align:center;" width="40%"></td> </tr>  ';
       

        }

        
    
    }

    

    $html.='</table> <script> window.print(); </script> ';


    #echo $html;exit;

    #include("../../lib/mailer/src/PHPMailer.php");

    

    
    
    /*try{

        $mail= new PHPMailer();

        echo "Hola";

    }catch(Exception $e){

    }

    exit;*/

   // exit;

    // Load HTML content 
     $dompdf->loadHtml($html); 

     #echo" prueba 33344444 ";exit;
     
    // Load html file 
    //$html = file_get_contents("index_pdf.html"); 
    //$dompdf->loadHtml($html); 
     
    //$dompdf->setPaper('A4', 'landscape');
    $dompdf->setPaper('A7', 'portrait');
    //$dompdf->set_paper(array(0, 0, 595, 841), 'portrait');

    $dompdf->render(); 
    #$dompdf->stream("Atracciones.pdf");
    $dompdf->stream("niceshipest", array("Attachment" => 0));
?>