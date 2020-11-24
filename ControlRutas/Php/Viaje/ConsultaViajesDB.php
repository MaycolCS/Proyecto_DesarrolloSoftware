<?php
    
    $Documento=$_GET['cc'];
    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
    }

    include '../Funciones.php';

    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login.php");
        exit();
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    $Vehiculo= "";
    if (esConductor($Documento)) {
        $Vehiculo = datosVehiculo($Documento)[0];
    } else {
        $Vehiculo= $_POST['Vehiculo'];
        if ($Vehiculo == "SinSelección") {
            header("Location: ConsultaViajes.php? cc=$Documento&msj=ESV");
            exit();
        }
    }
    $FechaInicio=$_POST['FechaInicio'];
    $FechaFin=$_POST['FechaFin'];
    $Empresa=$_POST['Empresa'];
    
    $Cont_Viajes = 0;

    $datos = conexionBDViaje();
    while($fila = mysqli_fetch_array($datos)) {
        if ($fila['Vehiculo'] == $Vehiculo) {
            if (datos_Recorrido($fila['Recorrido'])[0] == $Empresa) {
                if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                    $Cont_Viajes = $Cont_Viajes+1;
                }
            }
        }
    }
    if ($Cont_Viajes == 0) {
        header("Location: ConsultaViajes.php? cc=$Documento&msj=CSD");
        exit();
    }

    
    
?>

<!DOCTYPE html PUBLIC>

<html>

    <head>
        <?php
            include '../Static/Head.html';
        ?>
    </head>

    <body>

        <?php
            include '../Static/Header.php';
        ?>

        <section>

            <p class="txt_Titulo">Control de viajes</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>

            <p class="txt_Subtitulo">Vehiculo: <?php echo $Vehiculo; ?></p>
            <p class="txt_Normal">Empresa: <?php echo nombreEmpresa($Empresa); ?></p>
            
            <div id="lista_WR">
                <p class="txt_Subtitulo">Detalle de viajes</p>
                <?php
                $datos = conexionBDViaje();
                while($fila = mysqli_fetch_array($datos)) {
                    if (datos_Recorrido($fila['Recorrido'])[0] == $Empresa) {
                        if ($fila['Vehiculo'] == $Vehiculo) {
                            if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                                ?><ul>
                                    <li>Fecha: <?php echo $fila['Fecha'];?>
                                        <ul>
                                            <?php
                                            if (esAdministrador($Documento)) {?>
                                                <li>Id: <?php echo $fila['Id'];?></li>
                                                <li>Usuario: <?php echo $fila['Usuario'];?></li>
                                            <?php
                                            }
                                            ?>
                                            <li>Origen: <?php echo datos_Recorrido($fila['Recorrido'])[1];?></li>
                                            <li>Destino: <?php echo datos_Recorrido($fila['Recorrido'])[2];?></li>
                                            <li>Jornada: <?php echo $fila['Jornada'];?></li>
                                            <li>Recorrido: <?php echo datos_Recorrido($fila['Recorrido'])[3];?></li>
                                            <?php
                                            if ($fila['Nota'] != NULL) {?>
                                                <li>Nota: <?php echo $fila['Nota'];?></li>
                                                <?php
                                            }?>
                                        </ul>
                                    </li>
                                </ul>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </div>
            <div id="tabla_NWR">
                <div class="div_Style"></div>
                <p class="txt_Subtitulo">Detalle de viajes</p>
                <table id="table_viaje">
                    <tr>
                        <?php
                        if (esAdministrador($Documento)) {?>
                            <th>Id</th>
                            <th>Usuario</th>
                        <?php
                        }
                        ?>
                        <th>Fecha</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Jornada</th>
                        <th>Recorrido</th>
                        <th>Nota</th>
                    </tr>
                <?php
                $datos = conexionBDViaje();
                while($fila = mysqli_fetch_array($datos)) {
                    if (datos_Recorrido($fila['Recorrido'])[0] == $Empresa) {
                        if ($fila['Vehiculo'] == $Vehiculo) {
                            if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                                ?><tr>
                                    <?php
                                    if (esAdministrador($Documento)) {?>
                                        <td><?php echo $fila['Id'];?></td>
                                        <td><?php echo $fila['Usuario'];?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?php echo $fila['Fecha'];?></td>
                                    <td><?php echo datos_Recorrido($fila['Recorrido'])[1];?></td>
                                    <td><?php echo datos_Recorrido($fila['Recorrido'])[2];?></td>
                                    <td><?php echo $fila['Jornada'];?></td>
                                    <td><?php echo datos_Recorrido($fila['Recorrido'])[3];?></td>
                                    <td><?php echo $fila['Nota'];?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                ?>
                </table>
            </div>
            
        </section>

        <?php
            include '../Static/Footer.html';
        ?>

    </body>

</html>