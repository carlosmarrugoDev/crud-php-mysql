<?php

    $conexion = mysqli_connect("localhost", "root", "", "jugadores");

    if($conexion){
        echo 'Conexion establecida';
    } else {
        echo 'Conexion no establecida';
    }
