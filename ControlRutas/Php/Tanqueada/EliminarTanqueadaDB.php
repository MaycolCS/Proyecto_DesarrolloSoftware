<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    $Tanqueada= $_GET['idT'];

    $conn = conexionBD();
    $sql = "DELETE FROM tanqueada WHERE Id='$Tanqueada'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OBT");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EBT");
        exit();
    }

?>