<?php
    
    $Documento=$_GET['cc'];

    include '../Funciones.php';

    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login.php");
        exit();
    }
    
    /* Aqui empieza el código */

    $Vehiculo = $_POST['Vehiculo'];
    if ($Placa == "SinSelección") {
        header("Location: IngresarTanqueada.php? cc=$Documento&msj=ESV");
        exit();
    }
    $Recibo = $_POST['Recibo'];
    $Fecha = $_POST['Fecha'];
    $Valor = $_POST['Valor'];
    $Galones = $_POST['Galones'];
    $Nota = $_POST['Nota'];
    if ($Nota == "") {
        $Nota = NULL;
    }
    
    $conn = conexionBD();
    $sql = "INSERT INTO tanqueada (Vehiculo,Recibo,Fecha,Valor,Galones,Nota,Usuario) VALUES ('$Vehiculo','$Recibo','$Fecha','$Valor','$Galones','$Nota','$Documento')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORT");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERT");
        exit();
    }
    

?>