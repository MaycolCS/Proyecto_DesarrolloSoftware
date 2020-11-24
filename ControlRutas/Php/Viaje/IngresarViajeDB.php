<?php
    
    $Documento=$_GET['cc'];

    include '../Funciones.php';

    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login.php");
        exit();
    }
    
    /* Aqui empieza el código */

    $Empresa= $_GET['emp'];
    $Origen= $_GET['org'];
    $Destino= $_GET['dst'];
    $Vehiculo= "";
    if (esConductor($Documento)) {
        $Vehiculo = datosVehiculoConductor($Documento)[0];
    } elseif (esAdministrador($Documento)) {
        $Vehiculo= $_POST['Vehiculo'];
        if ($Vehiculo == "SinSelección") {
            header("Location: IngresarViaje.php? cc=$Documento&msj=ESJ&emp=$Empresa&org=$Origen&dst=$Destino");
            exit();
        }
    }
    $Fecha = $_POST['Fecha'];
    $Jornada = $_POST['Jornada'];
    $Recorrido = $_POST['Recorrido'];
    $idRecorrido = id_Recorrido($Empresa,$Origen,$Destino,$Recorrido);
    $Nota = $_POST['Nota'];
    if ($Nota == "") {
        $Nota = NULL;
    }

    if ($Jornada == "SinSelección") {
        header("Location: IngresarViaje.php? cc=$Documento&msj=ESJ&emp=$Empresa&org=$Origen&dst=$Destino");
        exit();
    } else if ($Recorrido == "SinSelección") {
        header("Location: IngresarViaje.php? cc=$Documento&msj=ESR&emp=$Empresa&org=$Origen&dst=$Destino");
        exit();
    }
    
    $conn = conexionBD();
    $sql = "INSERT INTO viaje (Vehiculo,Recorrido,Fecha,Jornada,Nota,Usuario) VALUES ('$Vehiculo','$idRecorrido','$Fecha','$Jornada','$Nota','$Documento')";
    mysqli_query($conn, $sql);
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ORV");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../MainPage.php? cc=$Documento&msj=ERV");
        exit();
    }

?>