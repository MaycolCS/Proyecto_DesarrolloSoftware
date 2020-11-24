<?php

    $Usuario = $_POST['usuario'];
    $Password = $_POST['contraseña'];

    $Nombre = "";
    $Apellido = "";
    $Documento = 0;
    $Msj = "Login";

    include 'Funciones.php';

    $conexion = conexionBD();

    $estaDocumento = estaDocumento($Usuario);

    $sql = "";
    if ($estaDocumento == TRUE) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($Usuario) == number_format($fila['Documento'])) {
                $Password = md5($Password, FALSE);
                if ($Password == $fila['Contraseña']) {
                    $Nombre = $fila['Nombre'];
                    $Apellido = $fila['Apellido'];
                    $Documento = $fila['Documento'];
                    $IP = getRealIP();
                    $sql = "UPDATE usuario Set Sesion=TRUE, IP='$IP' WHERE Documento='$Documento'";
                } else {
                    header("Location: Login.php? msj=EVC");
                    exit();
                }
            }
        }
        if ($Documento==0) {
            header("Location: Login.php? msj=EVD");
            exit();
        } else {
            mysqli_query($conexion, $sql);
            mysqli_close($conexion);
            header("Location: MainPage? cc=$Documento&msj=$Msj");
            exit();
        }
    } else {
        header("Location: Login? msj=UNR");
        exit();
    }

?>