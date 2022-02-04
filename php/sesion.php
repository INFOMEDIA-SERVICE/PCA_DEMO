<?php
//session_start();

if(isset( $_SESSION['usuario'] )){
    //Comprobamos si esta definida la sesión 'tiempo'.
        if(isset($_SESSION['tiempo']) ) {

            //Tiempo en segundos para dar vida a la sesión.
            //$inactivo = 1200;//20min en este caso.
            $inactivo=18000;//variable global
            //Calculamos tiempo de vida inactivo.
            $vida_session = time() - $_SESSION['tiempo'];

                //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
                if($vida_session > $inactivo)
                {
                    //Removemos sesión.
                    session_unset();
                    //Destruimos sesión.
                    session_destroy();              
                    //Redirigimos pagina.
                    header("Location: index.php");

                    exit();
                }
        } else {
            //Activamos sesion tiempo.
            $_SESSION['tiempo'] = time();
        }
}else{
    header('Location: index.php');
}

?>