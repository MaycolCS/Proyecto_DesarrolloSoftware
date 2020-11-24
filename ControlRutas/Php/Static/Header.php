<html>
    <body>
        <header>
            <nav id="menuWR">
                <input type="checkbox" id="mostrar_menuWR">
                <label for="mostrar_menuWR"><img src="../../Images/Iconos/icono-menu.png" width="45vh" heigth="45ex" title="Menú"></label>
                <ul>
                    <img src="../../Images/background_MM.png">
                    <li>
                        <a role="link" aria-selected="true" href="../MainPage? cc=<?php echo $Documento; ?>" title="Página principal">Inicio</a>
                    </li>
                    <li>
                        <a role="link" aria-selected="true" href="../CerrarSesion? cc=<?php echo $Documento; ?>" title="Cerrar sesión">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>

            <nav class="div_BarraSuperiorPrincipal">
                <li class="div_BarraSuperiorInternos">
                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="../MainPage? cc=<?php echo $Documento; ?>" title="Inicio">Inicio</a>
                </li>
                <li class="div_BarraSuperiorInternos">
                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Viajes</a>
                    <div class="div_BarraSuperiorLista">
                        <?php
                        if (esConductor($Documento) or esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Viaje/IngresarViaje? cc=<?php echo $Documento; ?>">Registrar viaje</a>
                            </div>
                        <?php
                        }?>
                        <div class="div_BarraSuperiorInternosLista">
                            <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Viaje/ConsultaViajes? cc=<?php echo $Documento; ?>">Consultar viaje</a>
                        </div>
                        <?php
                        if (esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Viaje/EliminarViaje? cc=<?php echo $Documento; ?>">Eliminar viaje</a>
                            </div>
                        <?php
                        }?>
                    </div>
                </li>
                <li class="div_BarraSuperiorInternos">
                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Vehiculo</a>
                    <div class="div_BarraSuperiorLista">
                        <?php
                        if (esOficina($Documento) or esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Vehiculo/IngresarVehiculo? cc=<?php echo $Documento; ?>">Registrar vehiculo</a>
                            </div>
                        <?php
                        }?>
                        <div class="div_BarraSuperiorInternosLista">
                            <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Vehiculo/ConsultaVehiculo? cc=<?php echo $Documento; ?>">Consultar vehiculo</a>
                        </div>
                        <?php
                        if (esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Vehiculo/EliminarVehiculo? cc=<?php echo $Documento; ?>">Eliminar vehiculo</a>
                            </div>
                        <?php
                        }?>
                    </div>
                </li>
                <li class="div_BarraSuperiorInternos">
                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Tanqueadas</a>
                    <div class="div_BarraSuperiorLista">
                        <?php
                        if (esOficina($Documento) or esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Tanqueada/IngresarTanqueada? cc=<?php echo $Documento; ?>">Registrar tanqueada</a>
                            </div>
                        <?php
                        }?>
                        <div class="div_BarraSuperiorInternosLista">
                            <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Tanqueada/ConsultaTanqueadas? cc=<?php echo $Documento; ?>">Consultar tanqueada</a>
                        </div>
                        <?php
                        if (esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Tanqueada/EliminarTanqueada? cc=<?php echo $Documento; ?>">Eliminar tanqueada</a>
                            </div>
                        <?php
                        }?>
                    </div>
                </li>
                <?php
                if (esOficina($Documento) or esAdministrador($Documento)) {?>
                    <li class="div_BarraSuperiorInternos">
                        <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Empresas</a>
                        <div class="div_BarraSuperiorLista">
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Empresa/IngresarEmpresa? cc=<?php echo $Documento; ?>">Registrar empresa</a>
                            </div>
                            <?php
                            if (esAdministrador($Documento)) {?>
                                <div class="div_BarraSuperiorInternosLista">
                                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Empresa/EliminarEmpresa? cc=<?php echo $Documento; ?>">Eliminar empresa</a>
                                </div>
                            <?php
                            }?>
                        </div>
                    </li>
                    <li class="div_BarraSuperiorInternos">
                        <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Recorridos</a>
                        <div class="div_BarraSuperiorLista">
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Recorrido/IngresarRecorrido? cc=<?php echo $Documento; ?>">Registrar recorrido</a>
                            </div>
                            <?php
                            if (esAdministrador($Documento)) {?>
                                <div class="div_BarraSuperiorInternosLista">
                                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Empresa/EliminarRecorrido? cc=<?php echo $Documento; ?>">Eliminar recorrido</a>
                                </div>
                            <?php
                            }?>
                        </div>
                    </li>
                    
                <?php
                }?>
                <?php
                if (esOficina($Documento) or esAdministrador($Documento)) {?>
                    <li class="div_BarraSuperiorInternos">
                        <a class="a_BarraSuperior" role="link" aria-selected="true" href="">Usuarios</a>
                        <div class="div_BarraSuperiorLista">
                            <?php
                            if (esAdministrador($Documento)) {?>
                                <div class="div_BarraSuperiorInternosLista">
                                    <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Usuario/IngresarUsuario? cc=<?php echo $Documento; ?>">Registrar usuario</a>
                                </div>
                            <?php
                            }?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Usuario/ConsultarUsuario? cc=<?php echo $Documento; ?>">Consultar usuario</a>
                            </div>
                            <?php
                            if (esAdministrador($Documento)) {?>
                            <div class="div_BarraSuperiorInternosLista">
                                <a class="a_BarraSuperior" role="link" aria-selected="true" href="../Usuario/EliminarUsuario? cc=<?php echo $Documento; ?>">Eliminar usuario</a>
                            </div>
                            <?php
                            }?>
                        </div>
                    </li>
                <?php
                }?>
            </nav>
        </header>
    </body>
</html>