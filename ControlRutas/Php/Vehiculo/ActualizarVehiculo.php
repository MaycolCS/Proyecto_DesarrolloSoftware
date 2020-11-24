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

    if($Mensaje=="EVSER") {
        echo '<script>alert("El vehículo ya se encuentra registrado")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);

    $conductores = listaConductores();
    $cant_conductores = count($conductores);
    $aux_cant_conductores = 0;

    $Placa = $_GET['pl'];
    $DatosVehiculo = datosVehiculo($Placa);

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
            <form class="form_Style" method="post" action="ActualizarVehiculoDB? cc=<?php echo $Documento; ?>&pl=<?php echo $DatosVehiculo[0] ;?>">
                <p class="txt_Titulo">Actualizar véhiculo</p>
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
                    <select name="Conductor" id="Conductor">
                        <option selected value="<?php echo $DatosVehiculo[2] ;?>"><?php echo datosUsuario($DatosVehiculo[2])[0]; echo " "; echo datosUsuario($DatosVehiculo[2])[1];?></option>
                        <?php
                        while ($aux_cant_conductores < $cant_conductores) {
                            if ($DatosVehiculo[2] == $conductores[$aux_cant_conductores]) {?>
                                <option value="NULL">Sin conductor</option>
                            <?php
                            } else {?>
                                <option value="<?php echo $conductores[$aux_cant_conductores] ;?>"><?php echo $conductores[$aux_cant_conductores+1] ;?> <?php echo $conductores[$aux_cant_conductores+2] ;?></option>
                            <?php
                            }
                            $aux_cant_conductores = $aux_cant_conductores+3;
                        }
                        ?>
                    </select>
                </div>
                </br><p class="txt_Normal">Ingrese las fechas de vencimiento de los siguientes documentos</p></br>
                <div>
                    <label>Soat:</label>
                    <input type="date" name="Soat" id="Soat" value="<?php echo $DatosVehiculo[3] ;?>" required/>
                </div>
                <div>
                    <label>Tecnomecánica:</label>
                    <input type="date" name="Tecno" id="Tecno" value="<?php echo $DatosVehiculo[4] ;?>" required/>
                </div>
                <div>
                    <label>Seg. actual:</label>
                    <input type="date" name="Actual" id="Actual" value="<?php echo $DatosVehiculo[5] ;?>" required/>
                </div>
                <div>
                    <label>Seg. contractual:</label>
                    <input type="date" name="Contractual" id="Contractual" value="<?php echo $DatosVehiculo[6] ;?>" required/>
                </div>
                
                <div class="Boton_Style">
                    <button type="submit">Guardar</button>
                </div>
            </form>

        </section>

        <?php
            include '../Static/Footer.html';
        ?>

    </body>

</html>