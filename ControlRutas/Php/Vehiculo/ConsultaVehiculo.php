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

    if($Mensaje=="ESP") {
        echo '<script>alert("Recuerde que debe seleccionar la placa del vehículo")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);

    $listaPlacas = listaVehiculos();
    $cant_placas = count($listaPlacas);
    $aux_cant_placas = 0;

    $Placa="";
    if (isset($_POST['Vehiculo'])) {
        if ($_POST['Vehiculo'] == "SinSelección") {
            header("Location: ConsultaVehiculo.php? cc=$Documento&msj=ESP");
            exit();
        } else {
            $Placa = $_POST['Vehiculo'];
            $DatosVehiculo = datosVehiculo($Placa);

            include '../Static/comp_fechas.php';
        }
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

            <p class="txt_Titulo">Sistema de control de tanqueadas</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
            <?php
            if ($Placa=="") {?>
                <form class="form_Style" method="post" action="ConsultaVehiculo.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Consulta vehículo</p>
                    <div>
                        <label>Vehiculo:</label>
                        <select name="Vehiculo" id="Vehiculo">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_placas < $cant_placas) {?>
                                <option value="<?php echo $listaPlacas[$aux_cant_placas]; ?>"><?php echo $listaPlacas[$aux_cant_placas]; ?></option>
                                <?php
                                $aux_cant_placas = $aux_cant_placas+1;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Consultar</button>
                    </div>
                </form>
            <?php
            } else {?>
                <?php if (!esConductor($Documento)) {?>
                    <form class="form_Style" method="post"  action="ActualizarVehiculo.php? cc=<?php echo $Documento; ?>&pl=<?php echo $DatosVehiculo[0] ;?>">
                <?php
                } else {?>
                    <form class="form_Style">
                <?php
                }?>
                    <p class="txt_Titulo">Consulta vehículo</p>
                    <div>
                        <label>Placa:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[0] ;?>"/>
                    </div>
                    <div>
                        <label>Número interno:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[1] ;?>"/>
                    </div>
                    <div>
                        <label>Conductor:</label>
                        <input readonly=»readonly» value="<?php echo datosUsuario($DatosVehiculo[2])[0]; echo " "; echo datosUsuario($DatosVehiculo[2])[1];?>"/>
                    </div>
                    <div>
                        <label>Soat:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[3] ;?>"/>
                    </div>
                    <div>
                        <label>Tecnomecánica:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[4] ;?>"/>
                    </div>
                    <div>
                        <label>Seg. actual:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[5] ;?>"/>
                    </div>
                    <div>
                        <label>Seg. contractual:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[6] ;?>"/>
                    </div>
                    <?php if (!esConductor($Documento)) {?>
                        <div class="Boton_Style">
                            <button type="submit">Actualizar</button>
                        </div>
                    <?php
                    }?>
                </form>
            <?php    
            }?>

        </section>

        <?php
            include '../Static/Footer.html';
        ?>

    </body>

</html>