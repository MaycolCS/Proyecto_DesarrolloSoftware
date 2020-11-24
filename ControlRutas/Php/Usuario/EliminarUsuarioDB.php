<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    $Usuario= $_POST['usuario'];

    $conn = conexionBD();
    $sql = "DELETE FROM usuario WHERE Documento='$Usuario'";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OBU");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EBU");
        exit();
    }

?>