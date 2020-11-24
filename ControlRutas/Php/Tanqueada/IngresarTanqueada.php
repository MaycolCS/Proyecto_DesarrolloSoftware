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
        echo '<script>alert("Recuerde que debe seleccionar la placa del vehículo")</script>';
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

            <p class="txt_Titulo">Sistema de control de tanqueadas</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
            <form class="form_Style" method="post" action="IngresarTanqueadaDB.php? cc=<?php echo $Documento; ?>">
                <p class="txt_Subtitulo">Ingreso tanqueada</p>
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
                <div>
                    <label>Recibo:</label>
                    <input type="number" name="Recibo" id="Recibo" placeholder="Número del recibo" required/>
                </div>
                <div>
                    <label>Fecha:</label>
                    <input type="date" name="Fecha" id="Fecha" placeholder="Fecha del viaje" required/>
                </div>
                <div>
                    <label>Valor:</label>
                    <input type="number" name="Valor" id="Valor" placeholder="Valor del recibo" required/>
                </div>
                <div>
                    <label>Galones:</label>
                    <input type="number" step="0.00000001" name="Galones" id="Galones" placeholder="Cantidad de galones" required/>
                </div>
                <div>
                    <label>Nota:</label>
                    <textarea type="text" name="Nota" id="Nota" placeholder="Si existe alguna nota adicional ingresela aquí"></textarea>
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