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

    $Placa=$_POST['Placa'];
    if ($Placa == "SinSelección") {
        header("Location: ConsultaTanqueadas.php? cc=$Documento&msj=ESP");
        exit();
    }
    $FechaInicio=$_POST['FechaInicio'];
    $FechaFin=$_POST['FechaFin'];
    $Cont_Tanqueadas = 0;
    $valor_total_tanqueadas = 0;
    $datos = conexionBDTanqueada();
    while($fila = mysqli_fetch_array($datos)) {
        if ($fila['Vehiculo'] == $Placa) {
            if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                $Cont_Tanqueadas = $Cont_Tanqueadas+1;
                $valor_total_tanqueadas = $valor_total_tanqueadas + $fila['Valor'];
            }
        }
    }
    if ($Cont_Tanqueadas == 0) {
        header("Location: ConsultaTanqueadas.php? cc=$Documento&msj=CSD");
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

            <p class="txt_Titulo">Control de tanqueadas</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>

            <p class="txt_Subtitulo">Vehículo: <?php echo $Placa; ?></p>
            <p class="txt_Normal">Cantidad de tanqueadas: <?php echo$Cont_Tanqueadas ?></p>
            <p class="txt_Normal">Valor total de tanqueadas: $ <?php echo$valor_total_tanqueadas ?></p>
            <div id="lista_WR">
                <div class="div_Style"></div>
                <?php
                $datos = conexionBDTanqueada();
                while($fila = mysqli_fetch_array($datos)) {
                    if ($fila['Vehiculo'] == $Placa) {
                        if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                            ?><ul>
                                <li>Fecha: <?php echo $fila['Fecha'];?>
                                    <ul>
                                        <li>Recibo: <?php echo $fila['Recibo'];?></li>
                                        <li>Valor: $ <?php echo $fila['Valor'];?></li>
                                        <li>Galones: <?php echo $fila['Galones'];?></li>
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
                ?>
            </div>
            <div id="tabla_NWR">
                <table id="table_tanqueada">
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Recibo</th> 
                        <th>Valor</th>
                        <th>Galones</th>
                        <th>Nota</th>
                    </tr>
                <?php
                $datos = conexionBDTanqueada();
                while($fila = mysqli_fetch_array($datos)) {
                    if ($fila['Vehiculo'] == $Placa) {
                        if ($fila['Fecha'] <= $FechaFin and $fila['Fecha'] >= $FechaInicio) {
                            ?><tr>
                                <td><?php echo $fila['Id'];?></td>
                                <td><?php echo $fila['Usuario'];?></td>
                                <td><?php echo $fila['Fecha'];?></td>
                                <td><?php echo $fila['Recibo'];?></td>
                                <td>$ <?php echo $fila['Valor'];?></td>
                                <td><?php echo $fila['Galones'];?></td>
                                <td><?php echo $fila['Nota'];?></td>
                            </tr>
                            <?php
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