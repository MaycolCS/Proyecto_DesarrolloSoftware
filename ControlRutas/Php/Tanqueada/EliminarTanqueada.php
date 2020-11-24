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

    if($Mensaje=="ESE") {
        echo '<script>alert("Recuerde que debe seleccionar la empresa")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    $IdTanqueada = 0;
    if (isset($_POST['IdTanqueada'])) {
        if(!estaTanqueada($_POST['IdTanqueada'])) {
            echo '<script>alert("No existe ninguna tanqueada con el ID consultado")</script>';
        } else {
            $IdTanqueada = $_POST['IdTanqueada'];
            $DatosTanqueada = datosTanqueada($IdTanqueada);
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
            if ($IdTanqueada == 0) {?>
                <form class="form_Style" method="post" action="EliminarTanqueada.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Eliminar Tanqueada</p>
                    <div>
                        <label>Id Tanqueada:</label>
                        <input type="number" name="IdTanqueada" id="IdTanqueada" placeholder="Id de la tanqueada" required/>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            <?php
            } else {?>
                <form class="form_Style" method="post" action="EliminarTanqueadaDB.php? cc=<?php echo $Documento; ?>&idT=<?php echo $IdTanqueada; ?>">
                    <p class="txt_Titulo">Eliminar Tanqueada</p>
                    <div>
                        <label>Id:</label>
                        <input readonly=»readonly» value="<?php echo $IdTanqueada ;?>"/>
                    </div>
                    <div>
                        <label>Vehiculo:</label>
                        <input readonly=»readonly» value="<?php echo $DatosTanqueada[0] ;?>"/>
                    </div>
                    <div>
                        <label>Recibo:</label>
                        <input readonly=»readonly» value="<?php echo $DatosTanqueada[1] ;?>"/>
                    </div>
                    <div>
                        <label>Fecha:</label>
                        <input readonly=»readonly» value="<?php echo $DatosTanqueada[2] ;?>"/>
                    </div>
                    <div>
                        <label>Valor:</label>
                        <input readonly=»readonly» value="$ <?php echo $DatosTanqueada[3] ;?>"/>
                    </div>
                    <div>
                        <label>Galones:</label>
                        <input readonly=»readonly» value="<?php echo $DatosTanqueada[4] ;?>"/>
                    </div>
                    <div>
                        <label>Nota:</label>
                        <textarea readonly=»readonly» type="text" ><?php echo $DatosTanqueada[5] ;?></textarea>
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