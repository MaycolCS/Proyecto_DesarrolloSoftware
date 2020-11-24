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
    
    $UsuarioConsulta=$_GET['uc'];
    $DatosUsuarioConsulta = datosUsuario($UsuarioConsulta);

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
            <form class="form_Style" method="post" action="ActualizarUsuarioDB? cc=<?php echo $Documento; ?>&uc=<?php echo $UsuarioConsulta ;?>">
                <p class="txt_Titulo">Registro usuario</p>
                <div>
                    <label>Cédula:</label>
                    <input readonly=»readonly» value="<?php echo $UsuarioConsulta ;?>"/>
                </div>
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="Nombre" id="Nombre" placeholder="Nombre" value="<?php echo $DatosUsuarioConsulta[0] ;?>" required/>
                </div>
                <div>
                    <label>Apellido:</label>
                    <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" value="<?php echo $DatosUsuarioConsulta[1] ;?>" required/>
                </div>
                <div>
                    <label>Celular:</label>
                    <input type="number" name="Celular" id="Celular" placeholder="Número de celular" value="<?php echo $DatosUsuarioConsulta[2] ;?>" required/>
                </div>
                <div>
                    <label>Correo:</label>
                    <input type="text" name="email" id="email" placeholder="Correo electrónico" value="<?php echo $DatosUsuarioConsulta[3] ;?>" required/>
                </div>
                <div>
                    <label>Rol:</label>
                    <select name="Rol" id="Rol">
                        <option selected value="<?php echo $DatosUsuarioConsulta[4] ;?>"><?php echo $DatosUsuarioConsulta[4] ;?></option>
                        <?php 
                        if ($DatosUsuarioConsulta[4] != "Oficina") {?>
                            <option value="Oficina">Oficina</option>
                        <?php
                        }?>
                        <?php 
                        if ($DatosUsuarioConsulta[4] != "Conductor") {?>
                            <option value="Conductor">Conductor</option>
                        <?php
                        }?>
                        
                        <?php 
                        if ($DatosUsuarioConsulta[4] != "Administrador") {?>
                            <option value="Administrador">Administrador</option>
                        <?php
                        }?>
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