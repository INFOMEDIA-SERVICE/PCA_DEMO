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
         
        $rDatos = $consumo->Get($url, $headers); 

        //print_r($rDatos);exit;
        


        $url2 = 'http://20.44.111.223:80/api/boleteria/reservaServicioAdicional?idReserva='.$idreserva;
         
        $rDatos2 = $consumo->Get($url2, $headers); 
        
        if ($rDatos != '') {
            
            $idreserva=$rDatos->id;
            $nombre_cliente=$rDatos->cliente->nombreCompleto;
            $primerNombre=$rDatos->cliente->primerNombre;
            $fecha_reserva=$rDatos->fecha;
            $documento_reserva=$rDatos->cliente->identificacion->tipo.' '.$rDatos->cliente->identificacion->numero; 

            $array_detalle=array();

            $cont_boletas=0;

            foreach ($rDatos->boletas as $key ) {

                $cont_boletas++;
                $array_detalle[$key->tipoBoleta->id]['cantidad']++;
                $array_detalle[$key->tipoBoleta->id]['idtipoBoleta']=$key->tipoBoleta->id;
                $array_detalle[$key->tipoBoleta->id]['precio']+=$key->tipoBoleta->precio;
                $array_detalle[$key->tipoBoleta->id]['nombre']= $key->tipoBoleta->nombre;
                
                if($idboleta==$key->id){
                    $visitantePN=$key->visitante->nombre;
                    $visitanteNC=$key->visitante->nombre.' '.$key->visitante->apellido;
                    $visitanteTP=$key->tipoBoleta->nombre;
                }

            }
            if($cont_boletas>1){
                $cont_boletas.=" Invitados ";
            }else{
                $cont_boletas.=" Invitado ";
            }

        } else {                
             
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

         

    } else {
        die('Se produjo un Error al generar el Token');
    }  

    


        

    

    use Dompdf\Dompdf; 
    
    $dompdf = new Dompdf();


    include('../../lib/phpqrcode/qrlib.php'); 
 
    $codesDir = "codes/";
    
   // $html.='<table width="100%" style="text-align:center;"> <tr> <td style="text-align:center;"> <img src="../../imagenes/pca_pdf.png"  width="100" height="70"> </td> </tr>  ';

    
    
    foreach ($rDatos->boletas as $key ) {

        if($idboleta==$key->id){

           /* echo"<pre>";
            print_r($key);
            echo"</pre>";exit;*/
             

            $codeFile= $key->id.".png";

            $rest = substr($key->id, -9);

            QRcode::png($key->id, $codesDir.$codeFile, "H", 3); 

             

            if($key->visitante->reservaCasilla->casilla->id!=''){
                //$locker=' <br> Locker: '.$key->visitante->reservaCasilla->casilla->id ;
                $locker=$key->visitante->reservaCasilla->casilla->id ;
            }else{
                $locker='';
            }

            $clave_parque=$key->visitante->codigo;
            $img=' <img class="img-thumbnail "  width="130" height="130" src="'.$codesDir.$codeFile.'" /> ';

            //$html.=' <tr> <td width="100%" style="text-align:center;" >'.$key->tipoBoleta->nombre.' <br> Boleta valida para: <br> '.$fecha_reserva.' <br> '.$nombre.' '.$apellido.' '.$locker.' <br>  Clave del parque: '.$key->visitante->codigo.' <br> # Boleta: '.$rest.' <img class="img-thumbnail "  width="140" height="140" src="'.$codesDir.$codeFile.'" /> <br> <span class="El-cdigo-QR-te-servir-para-identificarte-e-ingresar-al-parque">El código QR te servirá para identificarte e ingresar al parque</span> </td>  <td style="text-align:center;" width="40%"></td> </tr>  ';
       

        }

        
    
    }

    

    $html.='</table> <script> window.print(); </script> ';


   

    
    

    $html=' 
    <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PCA_RegistroCompletado</title>
<style id="applicationStylesheet" type="text/css">
     
@page {
    margin-left: 0.1cm;
    margin-right: 0.1cm;
    margin-top: 0.1cm;
    margin-bottom : 0.1cm;
}
    
.tab_centro {
    border: 1px solid #000;
}

p{
    font-size: 8px;
}

b{
    font-size: 9px;
}


#borderDemo {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 98%;
height: 381px;

}

#borderDemo2 {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 50%;
height: 20px;
transform: translate(60px);

}

#borderDemo3 {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 80%;

height: 40px;
margin-top: 30px;
padding: 10px;

transform: translate(20px,10px);
}



#borderDemo4 {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
background-color: rgb(255, 255, 255);
margin-top: -40px;
margin-left: -30px;
padding: 10px;
transform: translate(10px,12px);

}
#borderDemo4_2 {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
background-color: rgb(255, 255, 255);
margin-top: -40px;
margin-left: 50px;
padding: 10px;
transform: translate(20px,10px);
}

#borderDemo4_3 {
    border: 3px solid #000000;
    border-radius: 10px 10px 10px 10px;
    background-color: rgb(255, 255, 255);
    margin-top: -40px;
    margin-left: 50px;
    padding: 10px;

    transform: translate(20px,12px);
    
    }

#borderDemo5 {
border: 2px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 80%;
height: 20px;

margin-right: 50px;
margin-top: -12px;
transform: translate(20px);

}

#borderDemo6 {

width: 100%;
transform: translate(15px);
margin-top: -15px;

}


#borderDemo5_2 {
border: 2px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 80px;
height: 20px;

margin-right: 50px;
margin-top: 3px;
transform: translate(-5px,-11px);

}

#borderDemo5_3 {
    border: 2px solid #000000;
    border-radius: 10px 10px 10px 10px;
    width: 50px;
    height: 20px;
    margin-top: -15px;
    transform: translate(1px); 
    
    }

#borderDemo6_2 {

width: 100%;
transform: translate(65px);
margin-top: -25px;

}

#borderDemo6_3 {

    width: 100%;
    transform: translate(70px);
    margin-top: -15px;
    
    }

#borderDemo3_2 {
border: 3px solid #000000;
border-radius: 10px 10px 10px 10px;
width: 80%;

height: 40px;
margin-top: 30px;
padding: 10px;

transform: translate(20px,10px);
}


</style>
</head>
<body>';

    $html.='<div id="borderDemo">
    <table width="100%" style="text-align:center;"> 
        <tr> 
            <td style="text-align:center;"> 
                <img src="../../imagenes/pca_pdf.png"  width="100" height="60"> 
            </td> 
        </tr>

        <tr>
            <td> <p> Hola, '.$visitantePN.' ¡Vamos! <br>
                Todo esta listo para tu visita</p></td>
        </tr>

        <tr>
            <td style="text-align:center;">
                <b>Fecha Visita '.$fecha_reserva.'</b>
            </td> 
        </tr>
        

        <tr>
            <td> <p> Recuerda presentar este QR en los Totems de ingreso al parque</p></td>
        </tr>

        <tr style="text-align:center;">
            <td style="text-align:center;"> 
                <table  width="50%"  ALIGN="center" style="text-align:center;"  > 
                    <tr>
                        <td class="tab_centro"><p>Nombre</p></td>
                        <td  class="tab_centro"colspan="2"><p>'.$visitanteNC.'</p></td>
                    </tr>
                </table> 
                
            </td>
        </tr>

        <tr>
            <td style="text-align:center;">
                '.$img.'
            </td>
        </tr>

        <tr>
            <td> <b> El código QR te servirá para <br>identificarte e ingresar al parque</b></td>
        </tr>

        

        

       
         

        </table>
        </div>

        <div style="page-break-after:always;"></div>

        <div id="borderDemo">
    <table width="100%" style="text-align:center;"> 

        <!-- Aqui genero nueva pagina -->
        
        <tr> 
            <td style="text-align:center;"> <div id="borderDemo2" style="text-align:center;"> <b>TUS PRODUCTOS</b></div>  </td>  
        </tr>

        <tr>

            <td style="text-align:center;">
                <div id="borderDemo3" >
                    <table>
                        <tr>
                            <td  > <div id="borderDemo4" style="text-align:center;"> <img src="../../imagenes/incon_pasaporte.png"  width="50" height="60"> </div> </td>
                            <td  style="text-align:center;" class="td_up"> 
                                <div id="borderDemo6" style="text-align:center;"> 
                                    <b>TIPO</b> 
                                </div> 
                            </td>
                            <td colspan="2" > <div id="borderDemo5" style="text-align:center;"> <b>'.$visitanteTP.'</b> </div> </td>
                        </tr>
                    </table>
                </div>
            
            </td>

        </tr>';

        #$locker=23;

        if($locker!=''){
            $html.='<tr>

            <td style="text-align:center;">
                <div id="borderDemo3_2" >
                    <table>
                        <tr>

                            <td colspan="2" > <div id="borderDemo5_2" style="text-align:center;"> <b>'.$visitanteNC.'</b> </div>
                             <div id="borderDemo5_2" style="text-align:center;"> <b>'.$locker.'</b> </div>  </td>
                            
                            <td  style="text-align:center;" class="td_up"> 
                                <div id="borderDemo6_2" style="text-align:center;"> 
                                    <b>NOMBRE</b> 
                                </div> <br>
                                <div id="borderDemo6_2" style="text-align:center;"> 
                                    <b>NÚMERO</b> 
                                </div>
                            </td>
                            

                            <td  > <div id="borderDemo4_2" style="text-align:center;"> <img src="../../imagenes/incon_locker.png"  width="50" height="60"> </div> </td>
                        </tr>
                    </table>
                </div>
            
            </td>

        </tr>';

        }else{

        }


        if($locker!=''){

            $html.='<tr>

            <td style="text-align:center;">
                <div id="borderDemo3" >
                    <table>
                        <tr>
                            <td  > <div id="borderDemo4" style="text-align:center;"> <img src="../../imagenes/incon_contrs.png"  width="50" height="60"> </div> </td>
                            <td  style="text-align:center;" class="td_up"> 
                                <div id="borderDemo6" style="text-align:center;"> 
                                    <b>TU CONTRASEÑA</b> 
                                </div> 
                            </td>
                            <td colspan="2" > <div id="borderDemo5" style="text-align:center;"> <b>'.$clave_parque.'</b> </div> </td>
                        </tr>
                    </table>
                </div>
            
            </td>

        </tr>';

        }else{

            $html.='<tr>

            <td style="text-align:center;">
                <div id="borderDemo3_2" >
                    <table>
                        <tr>

                            <td colspan="2" > <div id="borderDemo5_3" style="text-align:center;"> <b>'.$clave_parque.'</b> </div> </td>
                            
                            <td  style="text-align:center;" class="td_up"> 
                                <div id="borderDemo6_3" style="text-align:center;"> 
                                    <b>TU CONTRASEÑA<b> 
                                </div> 
                            </td>
                            

                            <td  > <div id="borderDemo4_3" style="text-align:center;"> <img src="../../imagenes/incon_contrs.png"  width="50" height="60"> </div> </td>
                        </tr>
                    </table>
                </div>
            
            </td>

        </tr>';

        }

        

        
    
   $html.=' </table>

    <br><br><br>

</div>
</body>';

  
    
//echo $html;exit;
    
/* <tr>
            <td style="text-align:center;">

                <table  width="60%"  ALIGN="center" style="text-align:center;"  > 
                    <tr>
                        <td  > <img src="../../imagenes/incon_calendar-modified.png"  width="50" height="50"> <br> 
                            <b> '.$fecha_reserva.' </b> </td>
                        <td  > <img src="../../imagenes/incon_invitados-modified.png"  width="60" height="50">
                        <br>
                            <b> '.$cont_boletas.' </b> </td>
                        <td  > <img src="../../imagenes/incon_hora-modified.png"  width="60" height="50">
                        <br>
                            <b> 12:00 PM   </b> </td>
                    </tr>
                </table>

            </td>
        </tr> */

    
 #print_r($html);exit;
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

    sleep(3);
    echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
?>