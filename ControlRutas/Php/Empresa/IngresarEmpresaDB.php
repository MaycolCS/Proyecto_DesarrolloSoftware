<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $NitEmpresa= $_POST['nitEmpresa'];
    $NombreEmpresa= $_POST['nombreEmpresa'];
    $CiudadEmpresa= $_POST['ciudadEmpresa'];
    
    if (estaEmpresa($NombreEmpresa, $NitEmpresa, $CiudadEmpresa)) {
        header("Location: IngresarEmpresa? cc=$Documento&msj=ERA");
        exit();
    }
    
    $conn = conexionBD();
    $sql = "INSERT INTO empresa (Nit,Nombre,Ciudad,Usuario) VALUES ('$NitEmpresa','$NombreEmpresa','$CiudadEmpresa','$Documento')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORE");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERE");
        exit();
    }

?>