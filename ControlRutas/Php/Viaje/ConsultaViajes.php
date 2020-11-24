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

    if($Mensaje=="ESV") {
        echo '<script>alert("Recuerde que debe seleccionar el vehículo")</script>';
    } else if($Mensaje=="CSD") {
        echo '<script>alert("La consulta realizada no tiene datos registrados en el momento")</script>';
    }
    
    /* Aqui empieza el código */
    if (esConductor($Documento)) {
        if (!tieneConductorVehiculo($Documento)) {
            header("Location: ../MainPage.php? cc=$Documento&msj=CSVA");
            exit();
        } else {
            $Vehiculo = datosVehiculoConductor($Documento)[0]. " - ". datosVehiculoConductor($Documento)[1];
        }
    } else {
        $vehiculos = listaVehiculos();
        $cant_vehiculos = count($vehiculos);
        $aux_cant_vehiculos = 0;
    }

    $datosUsuario = datosUsuario($Documento);

    $empresas = listaEmpresas();
    $cant_empresas = count($empresas);
    $aux_cant_empresas = 0;

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

            <p class="txt_Titulo">Sistema de control de viajes</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
            <form class="form_Style" method="post" action="ConsultaViajesDB.php? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Consulta viajes</p>
                <?php
                if (esConductor($Documento)) {?>
                    <div>
                        <label>Vehículo:</label>
                        <input readonly=»readonly» value="<?php echo $Vehiculo ;?>"/>
                    </div>
                <?php
                } else {?>
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
                <?php
                }?>
                <div>
                    <label>Empresa:</label>
                    <select name="Empresa" id="Empresa">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($aux_cant_empresas < $cant_empresas) {?>
                            <option value="<?php echo $empresas[$aux_cant_empresas] ;?>"><?php echo $empresas[$aux_cant_empresas+1] ;?></option>
                            <?php
                            $aux_cant_empresas = $aux_cant_empresas+2;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label>Fecha inicio:</label>
                    <input type="date" name="FechaInicio" id="FechaInicio" placeholder="Fecha inicio de consulta" required/>
                </div>
                <div>
                    <label>Fecha fin:</label>
                    <input type="date" name="FechaFin" id="FechaFin" placeholder="Fecha fin de consulta" required/>
                </div>
                <div class="Boton_Style">
                    <button type="submit">Consultar</button>
                </div>
            </form>

        </section>

        <?php
            include '../Static/Footer.html';
        ?>

    </body>

</html>