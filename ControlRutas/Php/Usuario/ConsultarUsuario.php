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
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    $usuarios = listaUsuarios();
    $cant_usuarios = count($usuarios);
    $aux_cant_usuarios = 0;

    $UsuarioConsulta="";
    if (isset($_POST['usuario'])) {
        $UsuarioConsulta = $_POST['usuario'];
        $DatosUsuarioConsulta = datosUsuario($UsuarioConsulta);
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
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style"></div>
                
            <?php
            if ($UsuarioConsulta=="") {?>
                <form class="form_Style" method="post" action="ConsultarUsuario.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Consultar usuario</p>
                    <div>
                        <label>Usuario:</label>
                        <select name="usuario" id="usuario">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_usuarios < $cant_usuarios) {?>
                                <option value="<?php echo $usuarios[$aux_cant_usuarios] ;?>"><?php echo $usuarios[$aux_cant_usuarios+1] ;?> <?php echo $usuarios[$aux_cant_usuarios+2] ;?></option>
                                <?php
                                $aux_cant_usuarios = $aux_cant_usuarios+3;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Consultar</button>
                    </div>
                </form>
            <?php
            } else {?>
                <form class="form_Style" method="post" action="ActualizarUsuario.php? cc=<?php echo $Documento; ?>&uc=<?php echo $UsuarioConsulta ;?>">
                    <p class="txt_Titulo">Consultar usuario</p>
                    <div>
                        <label>Nombre:</label>
                        <input readonly=»readonly» value="<?php echo $DatosUsuarioConsulta[0] ;?>"/>
                    </div>
                    <div>
                        <label>Apellido:</label>
                        <input readonly=»readonly» value="<?php echo $DatosUsuarioConsulta[1] ;?>"/>
                    </div>
                    <div>
                        <label>Celular:</label>
                        <input readonly=»readonly» value="<?php echo $DatosUsuarioConsulta[2] ;?>"/>
                    </div>
                    <div>
                        <label>Correo:</label>
                        <input readonly=»readonly» value="<?php echo $DatosUsuarioConsulta[3] ;?>"/>
                    </div>
                    <div>
                        <label>Rol:</label>
                        <input readonly=»readonly» value="<?php echo $DatosUsuarioConsulta[4] ;?>"/>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Actualizar</button>
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