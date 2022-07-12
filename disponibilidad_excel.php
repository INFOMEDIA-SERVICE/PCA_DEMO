<?php 
session_start();
include('php/sesion.php');
header("Pragma: public");
header("Expires: 0");
$filename = "disponibilidadesNoInsertadad.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

#print_r($_SESSION['csv_disponibilidad']);

?>


<table>
<thead>
<h2>Disponibilidades no creadas</h2>
<tr>
    <th> Fecha </th>
    <th> Tipo Boleta </th>
    <th> Cantidad </th>
    <th> Estado </th>
    <th> Motivo </th>
</tr>
</thead>
<tbody>

<?php 

    foreach ($_SESSION['csv_disponibilidad'] as $key  ) {  ?>

    <tr>
        <td> <?php echo $key['fecha']; ?> </td>
        <td> <?php echo $key['tipoBoleta']; ?></td>
        <td> <?php echo $key['cantidad']; ?></td>
        <td> No insertada </td>
        <td>Ya se encuentra registrada una disponibilidad de este tipo de boleta en la fecha especificada</td>
    </tr>
         
    <?php }

    $_SESSION['csv_disponibilidad']='';

?>

 
 
</tbody>
</table>