<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    $Empresa= $_GET['emp'];
    $Origen= $_GET['org'];
    $Destino= $_GET['dst'];
    $Recorrido= $_POST['Recorrido'];

    $conn = conexionBD();
    $sql = "DELETE FROM recorrido WHERE Empresa='$Empresa',Origen='$Origen',Destino='$Destino',Recorrido='$Recorrido'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=OBR");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=EBR");
        exit();
    }

?>