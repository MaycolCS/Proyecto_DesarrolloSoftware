<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $Usuario= $_POST['Cédula'];
    if (estaDocumento($Usuario)) {
        header("Location: IngresarUsuario? cc=$Documento&msj=EUR");
        exit();
    }
    $Nombre= $_POST['Nombre'];
    $Apellido= $_POST['Apellido'];
    $Celular= $_POST['Celular'];
    $Correo= $_POST['email'];
    $Rol = $_POST['Rol'];
    if ($Rol == "SinSelección") {
        header("Location: IngresarUsuario? cc=$Documento&msj=ESROL");
        exit();
    }
    $Contraseña= rand(1000,20000);
    
    $conn = conexionBD();
    $sql = "INSERT INTO usuario (Documento, Nombre, Apellido, Celular, Correo, Rol, Contraseña) VALUES ('$Usuario', '$Nombre', '$Apellido', '$Celular', '$Correo', '$Rol', '$Contraseña')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORU");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERU");
        exit();
    }

?>