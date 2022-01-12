<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.4.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
    <style>
::placeholder{
    color:gray;
}
    </style>
</head>
<body>
<form name="Recuperación" action="" method="POST" style="width:300px;margin:8% 40%">
    <div>
        <h1 style="font-size:18px;padding:10px;text-align:center;">Recuperación de contraseña</h1>
        <h2 style="font-size:15px;padding:10px;text-align:center;">Ingrese la dirección de correo electrónico utilizada para crear su cuenta de Qustodio a continuación:</h2>
        <input id="correo" type="email" placeholder="Correo" style=" border:1px solid #DEDEDE; border-radius: 10px; width: 100%; padding: 1em 2em">
        <div style="background-color:#ECECEC;padding:30px 0px 30px 5px;margin:10px 0px 30px 0px;">
            <input name="codigo" class="mb-4 type="text" placeholder="Código" id="captcha" style="text-align:center;border:1px solid #DEDEDE; border-radius: 10px; width:100px;height:50px;margin-left:95px;margin-top:0px;" >
            <input type="image" src="captcha.php"  style="display:flex; border-radius: 10px; width:150px;height:50px;margin-left:70px;">
<?php 
    if (!empty($_POST['codigo'])){
        $codigo=$_POST['codigo'];
        if($codigo==$_SESSION['img_number']) {

        }else{
            echo '<div style="margin-left:90px;margin-top:10px;"> codigo erroneo </div>';   
        }
    }else{
        echo '<div style="margin-left:40px;margin-top:10px;"> Digita el codigo para validar </div>';   
    }
?>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;text-align:center;background-color:#74cc0d;">Recuperar</button>
    </div>
</form>
</body>
</html>