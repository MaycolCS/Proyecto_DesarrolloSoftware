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
        echo '<script>alert("Recuerde que debe seleccionar la empresa")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    $empresas = listaEmpresas();
    $cant_empresas = count($empresas);
    $aux_cant_empresas = 0;

    $Empresa="";
    if (isset($_POST['Empresa'])) {
        $Empresa = $_POST['Empresa'];
        $DatosEmpresa = datosEmpresa($Empresa);
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
            if ($Empresa=="") {?>
                <form class="form_Style" method="post" action="EliminarEmpresa? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Eliminar empresa</p>
                <div>
                    <label>Empresa:</label>
                    <select name="Empresa" id="Empresa">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($aux_cant_empresas < $cant_empresas) {?>
                            <option value="<?php echo $empresas[$aux_cant_empresas] ;?>"><?php echo $empresas[$aux_cant_empresas+1] ;?></option>
                            <?php
                            $aux_cant_empresas = $aux_cant_empresas+2;
                        }
                        ?>
                    </select>
                </div>
                <div class="Boton_Style">
                    <button type="submit">Continuar</button>
                </div>
            </form>
            <?php
            } else {?>
                <form class="form_Style" method="post"  action="EliminarEmpresaDB.php? cc=<?php echo $Documento; ?>&emp=<?php echo $Empresa ;?>">
                    <p class="txt_Titulo">Consulta vehículo</p>
                    <div>
                        <label>Nit:</label>
                        <input readonly=»readonly» value="<?php echo $DatosEmpresa[0] ;?>"/>
                    </div>
                    <div>
                        <label>Nombre:</label>
                        <input readonly=»readonly» value="<?php echo $DatosEmpresa[1] ;?>"/>
                    </div>
                    <div>
                        <label>Ciudad:</label>
                        <input readonly=»readonly» value="<?php echo $DatosEmpresa[2] ;?>"/>
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