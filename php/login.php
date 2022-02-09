<?php
session_start();

include_once('db.php');
//include_once('sesion.php');

extract($_REQUEST);






$query="SELECT password from account where name='".trim($usuario)."'";
$res = pg_query($conexion, $query);


$arr_password  = pg_fetch_all($res);

//print_r($arr_password[0]['password']);



if(count($arr_password)>0){

    $existingHashFromDb=$arr_password[0]['password'];

    $hashToStoreInDb = password_hash($passwd, PASSWORD_BCRYPT);
    $isPasswordCorrect = password_verify($passwd, $existingHashFromDb);

    echo" <pre><pre>";

    if($isPasswordCorrect===true){
        //echo "Contraseña correcta";
        //Sesion correcta genero token

        require_once '../main.php'; 

        $token = $llamar_token->generarToken();
        print_r($token->id);
        $_SESSION['usuario']=$usuario;
        $_SESSION['idusuario']=$token->id;
        $_SESSION['accessToken']=$token->accessToken->token; // ['accessToken']['token'];
        $_SESSION['contentToken']=$token->contentToken->token;  //  ['contentToken']['token'];
        $_SESSION['refreshToken']=$token->refreshToken->token; // ['refreshToken']['token'];

        header('Location: ../inicio_pca2.php');

    }else{
        //echo "Contraseña incorrecta";
        header('Location: ../index.php?m=ci');
    }

    #print_r($isPasswordCorrect);

    
}else{
        //echo"Usuario no existe!!";

        	
        header('Location: ../index.php?m=di');
}




?>