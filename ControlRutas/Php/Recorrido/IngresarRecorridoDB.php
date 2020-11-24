<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $Empresa= $_POST['Empresa'];
    $Origen = $_POST['Origen'];
    $Destino = $_POST['Destino'];
    $Recorrido = $_POST['Recorrido'];

    if ($Empresa == "SinSelección") {
        header("Location: IngresarRecorrido.php? cc=$Documento&msj=ESE");
        exit();
    } else if (estaRecorrido($Empresa,$Origen,$Destino,$Recorrido)) {
        header("Location: IngresarRecorrido.php? cc=$Documento&msj=REDB");
        exit();
    }
    
    $conn = conexionBD();
    $sql = "INSERT INTO recorrido (Empresa,Origen,Destino,Recorrido,Usuario) VALUES ('$Empresa','$Origen','$Destino','$Recorrido','$Documento')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORR");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERR");
        exit();
    }

?>