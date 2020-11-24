<?php

    include '../Funciones.php';

    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
    }
    $Usuario=0;
    if (isset($_POST['usuario'])) {
        $Usuario=$_POST['usuario'];
        if (validacionUsuario_RC($Usuario)==TRUE){
            echo '<script>alert("Hemos enviado a su correo electronico el código de autenticación.")</script>';
        } else {
            echo '<script>alert("Usted no se encuentra registrado en el sistema, contactese con el administrador del sistema.")</script>';
        }
        
    }

    if ($Mensaje=="UNR") {
        echo '<script>alert("Usted no se encuentra registrado en el sistema")</script>';
    } else if ($Mensaje=="EVC") {
        echo '<script>alert("La contraseña ingresada no coincide con la del sistema")</script>';
    } else if ($Mensaje=="ECR") {
        echo '<script>alert("El código de verificación no era el correcto")</script>';
    } else if ($Mensaje=="EDR") {
        echo '<script>alert("El documento no coincidio con el del sistema")</script>';
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

        <section>

            <?php
                if ($Usuario==0) {?>
                    <form class="form_Style" method="post" action="RecuperarContraseña?#stepcot">
                        <p class="txt_Titulo">Cambiar contraseña</p>
                        </br><p class="txt_Normal">Ingrese su documento y le enviaremos a su correo electónico un código para confirmar que es usted</p></br>
                        <div>
                            <label>Documento:</label>
                            <input type="number" name="usuario" id="usuario" placeholder="Documento usuario" required/>
                        </div>
                        <div class="Boton_Style">
                            <button type="submit">Enviar</button>
                        </div>
                    </form>
                    <form class="form_Style" action="../Login">
                        <div class="Boton_Style">
                            <button type="submit">Volver</button>
                        </div>
                    </form>
                <?php
                } else {?>
                    <form id="stepcot" class="form_Style" method="post" action="RecuperarContraseñaDB" accept-charset="utf-8">
                    <p class="txt_Titulo">Cambiar contraseña</p>
                    <div>
                        <label>Código:</label>
                        <input type="number" name="codeVer" id="codeVer" placeholder="Código de verificación" required/>
                    </div>
                    <div>
                        <label>Documento:</label>
                        <input type="number" name="usuario" id="usuario" placeholder="Documento usuario" required/>
                    </div>
                    <div>
                        <label>Contraseña:</label>
                        <input type="password" name="contraseña" id="contraseña" placeholder="Nueva contraseña usuario" required/>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Cambiar</button>
                    </div>
                    </form>
                <?php
                }?>

        </section>

    </body>

</html>