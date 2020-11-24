<?php

    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
    }

    if ($Mensaje=="UNR") {
        echo '<script>alert("Usted no se encuentra registrado en el sistema")</script>';
    } else if ($Mensaje=="EVC") {
        echo '<script>alert("La contraseña ingresada no coincide con la del sistema")</script>';
    } else if ($Mensaje=="EVD") {
        echo '<script>alert("El documento ingresado es incorrecto")</script>';
    } else if ($Mensaje=="CA") {
        echo '<script>alert("La contraseña se ha actualizado correctamente")</script>';
    } else if ($Mensaje=="ECA") {
        echo '<script>alert("La contraseña no se actualizo correctamente, intentelo nuevamente")</script>';
    } else if ($Mensaje=="SC") {
        echo '<script>alert("Sesión cerrada exitosamente")</script>';
    }

?>

<!DOCTYPE html PUBLIC>

<html>

    <head>
        <?php
            include 'Static/HeadP.html';
        ?>
    </head>

    <body>

        <section>

            <form class="form_Style" name="Login" method="post" action="LoginDB">
                <p class="txt_Titulo">Ingreso</p>
                <div>
                    <label>Documento:</label>
                    <input type="number" name="usuario" id="usuario" placeholder="Documento usuario" required/>
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña usuario" required/>
                </div>
                <div class="Boton_Style">
                    <button type="submit">Iniciar sesión</button>
                </div>
                <p class="txt_Parrafo">¿Olvido su contraseña? <a href="Usuario/RecuperarContraseña">Presione aquí</a></p>
            </form>

        </section>

    </body>

</html>