<?php
    require_once '../../lib/dompdf/autoload.inc.php';  
    use Dompdf\Dompdf; 
    $dompdf = new Dompdf();

    // Load HTML content 
     $dompdf->loadHtml('<h1>Welcome to niceshipest.com</h1>'); 
     
    // Load html file 
    //$html = file_get_contents("index_pdf.html"); 
    //$dompdf->loadHtml($html); 
     
    //$dompdf->setPaper('A4', 'landscape'); 

    $dompdf->render(); 
    $dompdf->stream("Atracciones.pdf");
    //$dompdf->stream("niceshipest", array("Attachment" => 0));
?>