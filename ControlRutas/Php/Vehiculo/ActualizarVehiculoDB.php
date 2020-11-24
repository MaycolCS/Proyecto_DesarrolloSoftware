<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }
    
    /* Aqui empieza el código */

    $Placa= $_GET['pl'];
    $Conductor = $_POST['Conductor'];
    if ($Conductor == "NULL") {
        $Conductor = NULL;
    }
    $Soat= $_POST['Soat'];
    $Tecno= $_POST['Tecno'];
    $Actual= $_POST['Actual'];
    $Contractual= $_POST['Contractual'];
    
    $conn = conexionBD();
    $sql = "UPDATE vehiculo Set Conductor='$Conductor', Soat='$Soat', Tecno='$Tecno', Actual='$Actual', Contractual='$Contractual', Usuario='$Documento' WHERE Placa='$Placa'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OAVE");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EAVE");
        exit();
    }

?>