<?php

    include 'Funciones.php';
    
    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: Login");
        exit();
    }
    
    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
    }
    
    /* Aqui empieza el código */

    if($Mensaje=="Login") {
        echo '<script>alert("Inicio de sesión exitosamente")</script>';
    } else if($Mensaje=="ORV") {
        echo '<script>alert("El viaje se registro correctamente")</script>';
    } else if($Mensaje=="ERV") {
        echo '<script>alert("El viaje no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="ORT") {
        echo '<script>alert("La tanqueada se registro correctamente")</script>';
    } else if($Mensaje=="ERT") {
        echo '<script>alert("La tanqueada no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="ORE") {
        echo '<script>alert("La empresa se registro correctamente")</script>';
    } else if($Mensaje=="ORE") {
        echo '<script>alert("La empresa no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="ORR") {
        echo '<script>alert("El recorrido se registro correctamente")</script>';
    } else if($Mensaje=="ERR") {
        echo '<script>alert("El recorrido no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="ORU") {
        echo '<script>alert("El usuario se registro correctamente")</script>';
    } else if($Mensaje=="ORU") {
        echo '<script>alert("El usuario no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="ORVE") {
        echo '<script>alert("El vehículo se registro correctamente")</script>';
    } else if($Mensaje=="ERVE") {
        echo '<script>alert("El vehículo no se registro correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBE") {
        echo '<script>alert("La empresa se borró correctamente")</script>';
    } else if($Mensaje=="EBE") {
        echo '<script>alert("La empresa no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBR") {
        echo '<script>alert("El recorrido se borró correctamente")</script>';
    } else if($Mensaje=="EBR") {
        echo '<script>alert("El recorrido no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBT") {
        echo '<script>alert("La tanqueada se borró correctamente")</script>';
    } else if($Mensaje=="EBT") {
        echo '<script>alert("La tanqueada no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBU") {
        echo '<script>alert("El usuario se borró correctamente")</script>';
    } else if($Mensaje=="EBU") {
        echo '<script>alert("El usuario no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBV") {
        echo '<script>alert("El viaje se borró correctamente")</script>';
    } else if($Mensaje=="EBV") {
        echo '<script>alert("El viaje no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OBVeh") {
        echo '<script>alert("El vehículo se borró correctamente")</script>';
    } else if($Mensaje=="EBVeh") {
        echo '<script>alert("El vehículo no se borró correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="CSVA") {
        echo '<script>alert("Usted no tiene asignado un vehículo en el sistema")</script>';
    } else if($Mensaje=="OAVE") {
        echo '<script>alert("El vehículo se actualizo correctamente")</script>';
    } else if($Mensaje=="EAVE") {
        echo '<script>alert("El vehículo no se actualizo correctamente, intentelo nuevamente")</script>';
    } else if($Mensaje=="OAU") {
        echo '<script>alert("El usuario se actualizo correctamente")</script>';
    } else if($Mensaje=="EAU") {
        echo '<script>alert("El usuario no se actualizo correctamente, intentelo nuevamente")</script>';
    }

    $datosUsuario = datosUsuario($Documento);

    if (esConductor($Documento) and $Mensaje=="Login") {
        $DatosVehiculo = datosVehiculo(datosVehiculoConductor($Documento)[0]);
        include 'Static/comp_fechas.php';
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

        <header>
            <nav id="menuWR">
                <input type="checkbox" id="mostrar_menuWR">
                <label for="mostrar_menuWR"><img src="../Images/Iconos/icono-menu.png" width="45ex" title="Menú"></label>
                <ul>
                    <img src="../Images/background_MM.png">
                    <li>
                        <a role="link" aria-selected="true" href="MainPage? cc=<?php echo $Documento; ?>" title="Página principal">Inicio</a>
                    </li>
                    <li>
                        <a role="link" aria-selected="true" href="CerrarSesion? cc=<?php echo $Documento; ?>" title="Cerrar sesión">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>
            <nav class="div_BarraSuperiorPrincipal">
                <li class="div_BarraSuperiorInternos">
                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="CerrarSesion? cc=<?php echo $Documento; ?>" title="Cerrar sesión">Cerrar sesión</a>
                </li>
            </nav>
        </header>


        <section>

            <p class="txt_Titulo">Sistema de control</p>
            <p class="txt_Normal">Usuario: <?php echo$datosUsuario[0] ?> <?php echo$datosUsuario[1] ?></p>
            <div class="div_Style">
                <p class="txt_Subtitulo">Viajes</p>
                <?php
                if (esConductor($Documento) or esAdministrador($Documento)) {?>
                    <article class="article_50">
                        <a class="botones_main" href="Viaje/IngresarViaje? cc=<?php echo$Documento ?>">
                            Ingresar viaje
                        </a>
                    </article>
                <?php
                }?>
                <article class="article_50">
                    <a class="botones_main" href="Viaje/ConsultaViajes? cc=<?php echo$Documento ?>">
                        Consultar viajes
                    </a>
                </article>
                <?php
                if (esAdministrador($Documento)) {?>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Viaje/EliminarViaje? cc=<?php echo$Documento ?>">
                                Eliminar viaje
                            </a>
                        </p>
                    </article>
                <?php
                }?>
            </div>
            <div class="div_Style">
                <p class="txt_Subtitulo">Vehiculo</p>
                <?php
                if (esAdministrador($Documento) or esOficina($Documento)) {?>
                    <article class="article_50">
                        <a class="botones_main" href="Vehiculo/IngresarVehiculo? cc=<?php echo$Documento ?>">
                            Ingresar vehículo
                        </a>
                    </article>
                <?php
                }?>
                <article class="article_50">
                    <a class="botones_main" href="Vehiculo/ConsultaVehiculo? cc=<?php echo$Documento ?>">
                        Consultar vehículo
                    </a>
                </article>
                <?php
                if (esAdministrador($Documento)) {?>
                    <article class="article_50">
                        <a class="botones_main" href="Vehiculo/EliminarVehiculo? cc=<?php echo $Documento; ?>">
                            Eliminar vehículo
                        </a>
                    </article>
                <?php
                }?>
            </div>
            <div class="div_Style">
                <p class="txt_Subtitulo">Tanqueadas</p>
                <?php
                if (esAdministrador($Documento) or esOficina($Documento)) {?>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Tanqueada/IngresarTanqueada? cc=<?php echo$Documento ?>">
                                Ingresar tanqueada
                            </a>
                        </p>
                    </article>
                <?php
                }?>
                <article class="article_50">
                    <p>
                        <a class="botones_main" href="Tanqueada/ConsultaTanqueadas? cc=<?php echo$Documento ?>">
                            Consultar tanqueadas
                        </a>
                    </p>
                </article>
                <?php
                if (esAdministrador($Documento)) {?>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Tanqueada/EliminarTanqueada? cc=<?php echo$Documento ?>">
                                Eliminar tanqueada
                            </a>
                        </p>
                    </article>
                <?php
                }?>
            </div>
            <?php
            if (esAdministrador($Documento) or esOficina($Documento)) {?>
                <div class="div_Style">
                    <p class="txt_Subtitulo">Empresas</p>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Empresa/IngresarEmpresa? cc=<?php echo$Documento ?>">
                                Registrar empresa
                            </a>
                        </p>
                    </article>
                    <?php
                    if (esAdministrador($Documento)) {?>
                        <article class="article_50">
                            <p>
                                <a class="botones_main" href="Empresa/EliminarEmpresa? cc=<?php echo$Documento ?>">
                                    Eliminar empresa
                                </a>
                            </p>
                        </article>
                    <?php
                    }?>
                </div>
                <div class="div_Style">
                    <p class="txt_Subtitulo">Recorridos</p>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Recorrido/IngresarRecorrido? cc=<?php echo$Documento ?>">
                                Registrar recorrido
                            </a>
                        </p>
                    </article>
                    <?php
                    if (esAdministrador($Documento)) {?>
                        <article class="article_50">
                            <p>
                                <a class="botones_main" href="Recorrido/EliminarRecorrido? cc=<?php echo$Documento ?>">
                                    Eliminar Recorrido
                                </a>
                            </p>
                        </article>
                    <?php
                    }?>
                </div>
            <?php
            }?>
            
            <?php
            if (esAdministrador($Documento) or esOficina($Documento)) {?>
                <div class="div_Style">
                    <p class="txt_Subtitulo">Usuarios</p>
                    <?php
                    if (esAdministrador($Documento)) {?>
                        <article class="article_50">
                            <p>
                                <a class="botones_main" href="Usuario/IngresarUsuario? cc=<?php echo$Documento ?>">
                                    Registrar usuario
                                </a>
                            </p>
                        </article>
                    <?php
                    }
                    ?>
                    <article class="article_50">
                        <p>
                            <a class="botones_main" href="Usuario/ConsultarUsuario? cc=<?php echo$Documento ?>">
                                Consultar usuario
                            </a>
                        </p>
                    </article>
                    <?php
                    if (esAdministrador($Documento)) {?>
                        <article class="article_50">
                            <p>
                                <a class="botones_main" href="Usuario/EliminarUsuario? cc=<?php echo$Documento ?>">
                                    Eliminar usuario
                                </a>
                            </p>
                        </article>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>

        </section>

        <?php
            include 'Static/Footer.html';
        ?>

    </body>

</html>