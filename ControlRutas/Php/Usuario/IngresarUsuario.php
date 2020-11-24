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

    if($Mensaje=="ESROL") {
        echo '<script>alert("Recuerde que debe seleccionar el rol")</script>';
    } else if($Mensaje=="EUR") {
        echo '<script>alert("El documento ya se encuentra registrado")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);


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
            <form class="form_Style" method="post" action="IngresarUsuarioDB? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Registro usuario</p>
                <div>
                    <label>Cédula:</label>
                    <input type="number" name="Cédula" id="Cédula" placeholder="Documento de identidad" required/>
                </div>
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="Nombre" id="Nombre" placeholder="Nombre" required/>
                </div>
                <div>
                    <label>Apellido:</label>
                    <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" required/>
                </div>
                <div>
                    <label>Celular:</label>
                    <input type="number" name="Celular" id="Celular" placeholder="Número de celular" required/>
                </div>
                <div>
                    <label>Correo:</label>
                    <input type="text" name="email" id="email" placeholder="Correo electrónico" required/>
                </div>
                <div>
                    <label>Rol:</label>
                    <select name="Rol" id="Rol">
                        <option selected value="SinSelección">Elige una opción</option>
                        <option value="Oficina">Oficina</option>
                        <option value="Conductor">Conductor</option>
                        <option value="Administrador">Administrador</option>
                    </select>
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