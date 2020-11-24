<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $Usuario= $_GET['uc'];
    $Nombre= $_POST['Nombre'];
    $Apellido= $_POST['Apellido'];
    $Celular= $_POST['Celular'];
    $Correo= $_POST['email'];
    $Rol = $_POST['Rol'];
    if ($Rol == "SinSelección") {
        header("Location: IngresarUsuario? cc=$Documento&msj=ESROL");
        exit();
    }
    
    $conn = conexionBD();    
    $sql = "UPDATE usuario Set Nombre='$Nombre', Apellido='$Apellido', Celular='$Celular', Correo='$Correo', Rol='$Rol' WHERE Documento='$Usuario'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OAU");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EAU");
        exit();
    }

?>