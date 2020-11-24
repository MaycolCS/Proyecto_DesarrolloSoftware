<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $Placa= $_POST['Placa'];
    if (estaVehiculo($Placa)) {
        header("Location: IngresarVehiculo? cc=$Documento&msj=EVSER");
        exit();
    }
    $NumInterno= $_POST['NumInterno'];
    $Conductor = $_POST['Conductor'];
    if ($Conductor == "SinSelección") {
        $Conductor = NULL;
    }
    $Soat= $_POST['Soat'];
    $Tecno= $_POST['Tecno'];
    $Actual= $_POST['Actual'];
    $Contractual= $_POST['Contractual'];
    
    $conn = conexionBD();
    $sql = "INSERT INTO vehiculo (Placa,NumInterno,Conductor,Soat,Tecno,Actual,Contractual,Usuario) VALUES ('$Placa', '$NumInterno', '$Conductor', '$Soat', '$Tecno', '$Actual', '$Contractual', '$Documento')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORVE");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERVE");
        exit();
    }

?>