<?php
    
    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
    }

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    if($Mensaje=="ESE") {
        echo '<script>alert("Recuerde que debe seleccionar al usuario")</script>';
    }

    $datosUsuario = datosUsuario($Documento);
    
    /* Aqui empieza el código */

    $vehiculos = listaVehiculos();
    $cant_vehiculos = count($vehiculos);
    $aux_cant_vehiculos = 0;
    $Vehiculo = "";
    if (isset($_POST['Vehiculo'])) {
        $Vehiculo = $_POST['Vehiculo'];
        $DatosVehiculo = datosVehiculo($Vehiculo);
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

            <p class="txt_Titulo">Sistema de control</p>
            <p class="txt_Normal">Administrador: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
            

            <?php
            if ($Vehiculo == "") {?>
                <form class="form_Style" method="post" action="EliminarVehiculo.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Eliminar vehículo</p>
                    <div>
                        <label>Vehículo:</label>
                        <select name="Vehiculo" id="Vehiculo">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_vehiculos < $cant_vehiculos) {?>
                                <option value="<?php echo $vehiculos[$aux_cant_vehiculos] ;?>"><?php echo $vehiculos[$aux_cant_vehiculos] ;?></option>
                                <?php
                                $aux_cant_vehiculos = $aux_cant_vehiculos+1;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            <?php
            } else {?>
                <form id="ingresoviaje" class="form_Style" method="post" action="EliminarVehiculoDB.php? cc=<?php echo $Documento; ?>&Veh=<?php echo $Vehiculo; ?>">
                    <p class="txt_Titulo">Eliminar vehículo</p>
                    <div>
                        <label>Placa:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[0] ;?>"/>
                    </div>
                    <div>
                        <label>Interno:</label>
                        <input readonly=»readonly» value="<?php echo $DatosVehiculo[1] ;?>"/>
                    </div>
                    <div>
                        <label>Conductor:</label>
                        <input readonly=»readonly» value="<?php echo datosUsuario($DatosVehiculo[2])[0];echo " "; echo datosUsuario($DatosVehiculo[2])[1];?>"/>
                    </div>
                    
                    <div class="Boton_Style">
                        <button type="submit">Eliminar</button>
                    </div>
                </form>
            <?php
            }?>

        </section>

        <?php
            include '../Static/Footer.html';
        ?>

    </body>

</html>