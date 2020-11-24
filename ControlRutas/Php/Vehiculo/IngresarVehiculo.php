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
            <form class="form_Style" method="post" action="IngresarVehiculoDB? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Registro véhiculo</p>
                <div>
                    <label>Placa:</label>
                    <input type="text" name="Placa" id="Placa" placeholder="Placa del vehículo" required/>
                </div>
                <div>
                    <label>Número interno:</label>
                    <input type="number" name="NumInterno" id="NumInterno" placeholder="Número interno del vehículo" required/>
                </div>
                <div>
                    <label>Conductor:</label>
                    <select name="Conductor" id="Conductor">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($aux_cant_conductores < $cant_conductores) {?>
                            <option value="<?php echo $conductores[$aux_cant_conductores] ;?>"><?php echo $conductores[$aux_cant_conductores+1] ;?> <?php echo $conductores[$aux_cant_conductores+2] ;?></option>
                            <?php
                            $aux_cant_conductores = $aux_cant_conductores+3;
                        }
                        ?>
                    </select>
                </div>
                </br><p class="txt_Normal">Ingrese las fechas de vencimiento de los siguientes documentos</p></br>
                <div>
                    <label>Soat:</label>
                    <input type="date" name="Soat" id="Soat" required/>
                </div>
                <div>
                    <label>Tecnomecánica:</label>
                    <input type="date" name="Tecno" id="Tecno" required/>
                </div>
                <div>
                    <label>Seg. actual:</label>
                    <input type="date" name="Actual" id="Actual" required/>
                </div>
                <div>
                    <label>Seg. contractual:</label>
                    <input type="date" name="Contractual" id="Contractual" required/>
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