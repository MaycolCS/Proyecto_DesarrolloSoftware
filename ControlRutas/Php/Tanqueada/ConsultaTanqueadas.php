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
    } else if($Mensaje=="CSD") {
        echo '<script>alert("La consulta realizada no tiene datos registrados en el momento")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);

    $listaPlacas = listaVehiculos();
    $cant_placas = count($listaPlacas);
    $aux_cant_placas = 0;

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
            <form class="form_Style" method="post" action="ConsultaTanqueadasDB.php? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Consulta tanqueadas</p>
                <div>
                    <label>Placa:</label>
                    <select name="Placa" id="Placa">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($aux_cant_placas < $cant_placas) {?>
                            <option value="<?php echo $listaPlacas[$aux_cant_placas] ;?>"><?php echo $listaPlacas[$aux_cant_placas] ;?></option>
                            <?php
                            $aux_cant_placas = $aux_cant_placas+1;
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