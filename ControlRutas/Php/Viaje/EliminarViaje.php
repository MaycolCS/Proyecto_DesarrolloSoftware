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

    $IdViaje = 0;
    if (isset($_POST['IdViaje'])) {
        if(!estaViaje($_POST['IdViaje'])) {
            echo '<script>alert("No existe ningun viaje con el ID consultado")</script>';
        } else {
            $IdViaje = $_POST['IdViaje'];
            $DatosViaje = datosViaje($IdViaje);
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

            <p class="txt_Titulo">Sistema de control</p>
            <p class="txt_Normal">Administrador: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
            

            <?php
            if ($IdViaje == 0) {?>
                <form class="form_Style" method="post" action="EliminarViaje.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Eliminar viaje</p>
                    <div>
                        <label>Id viaje:</label>
                        <input type="number" name="IdViaje" id="IdViaje" placeholder="Id del viaje" required/>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            <?php
            } else {?>
                <form id="ingresoviaje" class="form_Style" method="post" action="EliminarViajeDB.php? cc=<?php echo $Documento; ?>&idV=<?php echo $IdViaje; ?>">
                    <p class="txt_Titulo">Eliminar viaje</p>
                    <div>
                        <label>Id:</label>
                        <input readonly=»readonly» value="<?php echo $IdViaje ;?>"/>
                    </div>
                    <div>
                        <label>Empresa:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[0] ;?>"/>
                    </div>
                    <div>
                        <label>Vehiculo:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[1] ;?>"/>
                    </div>
                    <div>
                        <label>Origen:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[2] ;?>"/>
                    </div>
                    <div>
                        <label>Destino:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[3] ;?>"/>
                    </div>
                    <div>
                        <label>Fecha:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[4] ;?>"/>
                    </div>
                    <div>
                        <label>Jornada:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[5] ;?>"/>
                    </div>
                    <div>
                        <label>Recorrido:</label>
                        <input readonly=»readonly» value="<?php echo $DatosViaje[6] ;?>"/>
                    </div>
                    <div>
                        <label>Nota:</label>
                        <textarea readonly=»readonly» type="text" ><?php echo $DatosViaje[7] ;?></textarea>
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