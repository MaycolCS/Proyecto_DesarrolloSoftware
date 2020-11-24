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
    $empresa = "";
    if (isset($_GET['emp'])) {
        $empresa=$_GET['emp'];
    } elseif (isset($_POST['Empresa'])) {
        if ($_POST['Empresa'] == "SinSelección") {
            $empresa = "";
        } else {
            $empresa=$_POST['Empresa'];
        }
    }

    $origenes = listaOrigenes($empresa);
    $cant_origenes = count($origenes);
    $aux_cant_origenes = 0;
    $origen = "";
    if (isset($_GET['org'])) {
        $origen=$_GET['org'];
    } elseif (isset($_POST['Origen'])) {
        if ($_POST['Origen'] == "SinSelección") {
            $origen = "";
        } else {
            $origen=$_POST['Origen'];
        }
    }

    $destinos = listaDestinos($empresa,$origen);
    $cant_destinos = count($destinos);
    $aux_cant_destinos = 0;
    $destino = "";
    if (isset($_POST['Destino'])) {
        if ($_POST['Destino'] == "SinSelección") {
            $destino = "";
        } else {
            $destino=$_POST['Destino'];
            
        }
    }

    $recorridos = listaRecorridos($empresa,$origen,$destino);
    $cant_recorridos = count($recorridos);
    $aux_cant_recorridos = 0;
    $recorrido = "";

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
            if ($empresa == "") {?>
                <form class="form_Style" method="post" action="EliminarRecorrido.php? cc=<?php echo $Documento; ?>">
                    <p class="txt_Titulo">Eliminar recorrido</p>
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
            } elseif ($origen == "") {?>
                <form class="form_Style" method="post" action="EliminarRecorrido.php? cc=<?php echo $Documento; ?>&emp=<?php echo $empresa; ?>">
                    <p class="txt_Titulo">Eliminar recorrido</p>
                    <div>
                        <label>Origen:</label>
                        <select name="Origen" id="Origen">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_origenes < $cant_origenes) {?>
                                <option value="<?php echo $origenes[$aux_cant_origenes] ;?>"><?php echo $origenes[$aux_cant_origenes] ;?></option>
                                <?php
                                $aux_cant_origenes = $aux_cant_origenes+1;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="Boton_Style">
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            <?php
            } elseif ($destino == "") {?>
                <form class="form_Style" method="post" action="EliminarRecorrido.php? cc=<?php echo $Documento; ?>&emp=<?php echo $empresa; ?>&org=<?php echo $origen; ?>">
                    <p class="txt_Titulo">Eliminar recorrido</p>
                    <div>
                        <label>Destino:</label>
                        <select name="Destino" id="Destino">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_destinos < $cant_destinos) {?>
                                <option value="<?php echo $destinos[$aux_cant_destinos] ;?>"><?php echo $destinos[$aux_cant_destinos] ;?></option>
                                <?php
                                $aux_cant_destinos = $aux_cant_destinos+1;
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
                <form class="form_Style" method="post" action="EliminarRecorridoDB.php? cc=<?php echo $Documento; ?>&emp=<?php echo $empresa; ?>&org=<?php echo $origen; ?>&dst=<?php echo $destino; ?>">
                    <p class="txt_Titulo">Eliminar recorrido</p>
                    <div>
                        <label>Recorrido:</label>
                        <select name="Recorrido" id="Recorrido">
                            <option selected value="SinSelección">Elige una opción</option>
                            <?php
                            while ($aux_cant_recorridos < $cant_recorridos) {?>
                                <option value="<?php echo $recorridos[$aux_cant_recorridos] ;?>"><?php echo $recorridos[$aux_cant_recorridos] ;?></option>
                                <?php
                                $aux_cant_recorridos = $aux_cant_recorridos+1;
                            }
                            ?>
                        </select>
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