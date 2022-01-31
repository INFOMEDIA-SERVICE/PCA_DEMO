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
        $llamar_token = new Generar_token();
        //
    ?>