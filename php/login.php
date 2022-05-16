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


        $query2="SELECT * from configuracion_general_empresa ";
        $res2 = pg_query($conexion, $query2);
        $arr_empresa  = pg_fetch_all($res2);

        $_SESSION['decimales']=$arr_empresa[0]['decimales'];  
        $_SESSION['direccion']=$arr_empresa[0]['direccion'];   
        $_SESSION['email_remitente']=$arr_empresa[0]['email_remitente'];   
        $_SESSION['formato_moneda']=$arr_empresa[0]['formato_moneda'];   
        $_SESSION['logo_imagen_id']=$arr_empresa[0]['logo_imagen_id'];   
        $_SESSION['nit']=$arr_empresa[0]['nit'];   
        $_SESSION['nombre']=$arr_empresa[0]['nombre'];   
        $_SESSION['razon_social']=$arr_empresa[0]['razon_social'];  
        $_SESSION['resolucion_dian']=$arr_empresa[0]['resolucion_dian'];  
        $_SESSION['telefono']=$arr_empresa[0]['telefono'];   
        $_SESSION['terminos_condiciones'] =$arr_empresa[0]['terminos_condiciones']; 
        $_SESSION['url']=$arr_empresa[0]['url'];  
        $_SESSION['account_admin_id']=$arr_empresa[0]['account_admin_id'];   
        $_SESSION['edad_adulto'] =$arr_empresa[0]['edad_adulto']; 

        #print_r($arr_empresa[0] );exit;

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