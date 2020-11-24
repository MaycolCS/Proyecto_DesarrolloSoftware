<?php

    $Documento=$_GET['cc'];

    include 'Funciones.php';

    $conexion = conexionBD();

    $sql = "UPDATE usuario Set Sesion=FALSE, IP=NULL WHERE Documento='$Documento'";

    mysqli_query($conexion, $sql);
    mysqli_close($conexion);

    header("Location: Login? msj=SC");
    exit();

?>