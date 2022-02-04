<?php
        /**
         * Archivo global del proyecto.
         * User: Alfonso Atencio
         * Date: 30-Enero-2022
         * Time: 17:54
         */

        //Cargando todas las clases
        spl_autoload_register(function ($file) {
            include "class/$file.php";
        });

        $atrac = new Atracciones();
        $condi = new Condiciones();
        $llamar_token = new ConsumoServicio();
        

        //
    ?>