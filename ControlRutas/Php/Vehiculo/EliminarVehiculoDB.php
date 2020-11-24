<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    $Vehiculo= $_GET['Veh'];

    $conn = conexionBD();
    $sql = "DELETE FROM vehiculo WHERE Placa='$Vehiculo'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OBVeh");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EBVeh");
        exit();
    }

?>