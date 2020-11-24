<?php

    $Code = $_POST['codeVer'];
    $Usuario = $_POST['usuario'];
    $Password = $_POST['contraseña'];

    include '../Funciones.php';

    $conexion = conexionBD();

    $estaDocumento = estaDocumento($Usuario);

    $sql = "";
    $Doc = FALSE;
    if ($estaDocumento == TRUE) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($Usuario) == number_format($fila['Documento'])) {
                $Doc = TRUE;
                $Password = md5($Password, FALSE);
                if (number_format($Code) == number_format($fila['RC'])) {
                    $sql = "UPDATE usuario Set Contraseña='$Password', RC=NULL, Sesion=FALSE, IP=NULL WHERE Documento='$Usuario'";
                } else {
                    header("Location: RecuperarContraseña? msj=ECR");
                    exit();
                }
            }
        }
        if ($Doc==FALSE) {
            header("Location: RecuperarContraseña? msj=EDR");
            exit();
        } else {
            if (mysqli_query($conexion, $sql)) {
                mysqli_close($conexion);
                header("Location: ../Login.php? msj=CA");
                exit();
            } else {
                mysqli_close($conn);
                header("Location: ../Login.php? cc=$Documento&msj=ECA");
                exit();
            }
        }
    } else {
        header("Location: ../Login.php? msj=UNR");
        exit();
    }

?>