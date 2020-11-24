<?php

    $Comp_Soat = comprobarFechaDocumento($DatosVehiculo[3]);

    if ($Comp_Soat == 5) {
        echo '<script>alert("El Soat se vence en cinco (5) días")</script>';
    } elseif ($Comp_Soat == 4) {
        echo '<script>alert("El Soat se vence en cuatro (4) días")</script>';
    } elseif ($Comp_Soat == 3) {
        echo '<script>alert("El Soat se vence en tres (3) días")</script>';
    } elseif ($Comp_Soat == 2) {
        echo '<script>alert("El Soat se vence en dos (2) días")</script>';
    } elseif ($Comp_Soat == 1) {
        echo '<script>alert("El Soat se vence en un (1) día")</script>';
    } elseif ($Comp_Soat == 0) {
        echo '<script>alert("El Soat se vence hoy")</script>';
    } elseif ($Comp_Soat == (-1)) {
        echo '<script>alert("El Soat se encuentra vencido")</script>';
    }

    $Comp_Tecno = comprobarFechaDocumento($DatosVehiculo[4]);

    if ($Comp_Tecno == 5) {
        echo '<script>alert("La tecnomecánica se vence en cinco (5) días")</script>';
    } elseif ($Comp_Tecno == 4) {
        echo '<script>alert("La tecnomecánica se vence en cuatro (4) días")</script>';
    } elseif ($Comp_Tecno == 3) {
        echo '<script>alert("La tecnomecánica se vence en tres (3) días")</script>';
    } elseif ($Comp_Tecno == 2) {
        echo '<script>alert("La tecnomecánica se vence en dos (2) días")</script>';
    } elseif ($Comp_Tecno == 1) {
        echo '<script>alert("La tecnomecánica se vence en un (1) día")</script>';
    } elseif ($Comp_Tecno == 0) {
        echo '<script>alert("La tecnomecánica se vence hoy")</script>';
    } elseif ($Comp_Tecno == (-1)) {
        echo '<script>alert("La tecnomecánica se encuentra vencida")</script>';
    }

    $Comp_Actual = comprobarFechaDocumento($DatosVehiculo[5]);

    if ($Comp_Actual == 5) {
        echo '<script>alert("El seguro actual se vence en cinco (5) días")</script>';
    } elseif ($Comp_Actual == 4) {
        echo '<script>alert("El seguro actual se vence en cuatro (4) días")</script>';
    } elseif ($Comp_Actual == 3) {
        echo '<script>alert("El seguro actual se vence en tres (3) días")</script>';
    } elseif ($Comp_Actual == 2) {
        echo '<script>alert("El seguro actual se vence en dos (2) días")</script>';
    } elseif ($Comp_Actual == 1) {
        echo '<script>alert("El seguro actual se vence en un (1) día")</script>';
    } elseif ($Comp_Actual == 0) {
        echo '<script>alert("El seguro actual se vence hoy")</script>';
    } elseif ($Comp_Actual == (-1)) {
        echo '<script>alert("El seguro actual se encuentra vencido")</script>';
    }

    $Comp_ContrActual = comprobarFechaDocumento($DatosVehiculo[6]);

    if ($Comp_ContrActual == 5) {
        echo '<script>alert("El seguro contractual se vence en cinco (5) días")</script>';
    } elseif ($Comp_ContrActual == 4) {
        echo '<script>alert("El seguro contractual se vence en cuatro (4) días")</script>';
    } elseif ($Comp_ContrActual == 3) {
        echo '<script>alert("El seguro contractual se vence en tres (3) días")</script>';
    } elseif ($Comp_ContrActual == 2) {
        echo '<script>alert("El seguro contractual se vence en dos (2) días")</script>';
    } elseif ($Comp_ContrActual == 1) {
        echo '<script>alert("El seguro contractual se vence en un (1) día")</script>';
    } elseif ($Comp_ContrActual == 0) {
        echo '<script>alert("El seguro contractual se vence hoy")</script>';
    } elseif ($Comp_ContrActual == (-1)) {
        echo '<script>alert("El seguro contractual se encuentra vencido")</script>';
    }

?>