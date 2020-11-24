<?php

    function conexionBD() {
        $conexion = mysqli_connect('localhost','root','','controlrutas');
        return $conexion;
    }

    function conexionBDUsuario() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM usuario";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function listaUsuarios() {
        $datos = conexionBDUsuario();
        $listaUsuarios = array();
        while($fila = mysqli_fetch_array($datos)) {
            array_push($listaUsuarios, $fila['Documento']);
            array_push($listaUsuarios, $fila['Nombre']);
            array_push($listaUsuarios, $fila['Apellido']);
        }
        return $listaUsuarios;
    }

    function estaDocumento($Documento) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Documento']) == number_format($Documento)) {
                return TRUE;
                break;
            }
        }
        return FALSE;
    }

    function SesionUsuario($Documento) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Documento'] == $Documento) {
                if ($fila['Sesion'] == TRUE) {
                    if ($fila['IP'] == getRealIP()) {
                        return TRUE;
                        break;
                    }
                }
            }
        }
        return FALSE;
    }

    function esAdministrador($Documento) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Documento']) == number_format($Documento)) {
                if ($fila['Rol'] == "Administrador") {
                    return TRUE;
                    break;
                }
            }
        }
        return FALSE;
    }

    function esOficina($Documento) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Documento']) == number_format($Documento)) {
                if ($fila['Rol'] == "Oficina") {
                    return TRUE;
                    break;
                }
            }
        }
        return FALSE;
    }

    function esConductor($Documento) {
        $datos = conexionBDUsuario();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Documento']) == number_format($Documento)) {
                if ($fila['Rol'] == "Conductor") {
                    return TRUE;
                    break;
                }
            }
        }
        return FALSE;
    }

    function listaConductores() {
        $datos = conexionBDUsuario();
        $datosConductores = array();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Rol'] == "Conductor") {
                array_push($datosConductores, $fila['Documento']);
                array_push($datosConductores, $fila['Nombre']);
                array_push($datosConductores, $fila['Apellido']);
            }
        }
        return $datosConductores;
    }

    function datosUsuario($Documento) {
        $datos = conexionBDUsuario();
        $datosUsuario = array();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Documento']) == number_format($Documento)) {
                array_push($datosUsuario, $fila['Nombre']);
                array_push($datosUsuario, $fila['Apellido']);
                array_push($datosUsuario, $fila['Celular']);
                array_push($datosUsuario, $fila['Correo']);
                array_push($datosUsuario, $fila['Rol']);
                break;
            }
        }
        return $datosUsuario;
    }

    function conexionBDEmpresa() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM empresa";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function listaEmpresas() {
        $datos = conexionBDEmpresa();
        $datosEmpresa = array();
        while($fila = mysqli_fetch_array($datos)) {
            array_push($datosEmpresa, $fila['Nit']);
            array_push($datosEmpresa, $fila['Nombre']);
        }
        return $datosEmpresa;
    }

    function nombreEmpresa($Nit) {
        $datos = conexionBDEmpresa();
        $nombreEmpresa = "";
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($Nit) == number_format($fila['Nit'])) {
                $nombreEmpresa = $fila['Nombre'];
                break;
            }
        }
        return $nombreEmpresa;
    }

    function estaEmpresa($Empresa, $Nit, $Ciudad) {
        $datos = conexionBDEmpresa();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Nit'] == $Nit) {
                if ($fila['Ciudad'] == $Ciudad) {
                    return TRUE;
                    break;
                }
            }
        }
        return FALSE;
    }

    function datosEmpresa($Empresa) {
        $datos = conexionBDEmpresa();
        $datosEmpresa = array();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Nit']) == number_format($Empresa)) {
                array_push($datosEmpresa, $fila['Nit']);
                array_push($datosEmpresa, $fila['Nombre']);
                array_push($datosEmpresa, $fila['Ciudad']);
                break;
            }
        }
        return $datosEmpresa;
    }

    function conexionBDRecorridos() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM recorrido";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function listaOrigenes($empresa) {
        $datos = conexionBDRecorridos();
        $datosRecorridos = array();
        while($fila = mysqli_fetch_array($datos)) {
            if ($empresa == $fila['Empresa']) {
                array_push($datosRecorridos, $fila['Origen']);
            }
        }
        return $datosRecorridos;
    }

    function listaDestinos($empresa,$origen) {
        $datos = conexionBDRecorridos();
        $datosRecorridos = array();
        while($fila = mysqli_fetch_array($datos)) {
            if ($empresa == $fila['Empresa']) {
                if ($origen == $fila['Origen']) {
                    array_push($datosRecorridos, $fila['Destino']);
                }
            }
        }
        return $datosRecorridos;
    }

    function listaRecorridos($empresa,$origen,$destino) {
        $datos = conexionBDRecorridos();
        $datosRecorridos = array();
        while($fila = mysqli_fetch_array($datos)) {
            if ($empresa == $fila['Empresa']) {
                if ($origen == $fila['Origen']) {
                    if ($destino == $fila['Destino']) {
                        array_push($datosRecorridos, $fila['Recorrido']);
                    }
                }
            }
        }
        return $datosRecorridos;
    }

    function estaRecorrido($empresa,$origen,$destino,$recorrido) {
        $datos = conexionBDRecorridos();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Empresa']) == number_format($Empresa)) {
                if ($origen == $fila['Origen']) {
                    if ($destino == $fila['Destino']) {
                        if ($destino == $fila['Recorrido']) {
                            return TRUE;
                            break;
                        }
                    }
                }
            }
        }
        return FALSE;
    }

    function id_Recorrido($empresa,$origen,$destino,$recorrido) {
        $id_recorrido = 0;
        $datos = conexionBDRecorridos();
        while($fila = mysqli_fetch_array($datos)) {
            if ($empresa == $fila['Empresa']) {
                if ($origen == $fila['Origen']) {
                    if ($destino == $fila['Destino']) {
                        if ($recorrido == $fila['Recorrido']) {
                            $id_recorrido = $fila['Id'];
                        }
                    }
                }
            }
        }
        return $id_recorrido;
    }

    function datos_Recorrido($id) {
        $datosRecorridos = array();
        $datos = conexionBDRecorridos();
        while($fila = mysqli_fetch_array($datos)) {
            if ($id == $fila['Id']) {
                array_push($datosRecorridos, $fila['Empresa']);
                array_push($datosRecorridos, $fila['Origen']);
                array_push($datosRecorridos, $fila['Destino']);
                array_push($datosRecorridos, $fila['Recorrido']);
            }
        }
        return $datosRecorridos;
    }

    function conexionBDViaje() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM viaje";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function estaViaje($Id) {
        $datos = conexionBDViaje();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Id'] == $Id) {
                return TRUE;
                break;
            }
        }
        return FALSE;
    }

    function datosViaje($Id) {
        $datos = conexionBDViaje();
        $datosViaje = array();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Id']) == number_format($Id)) {
                array_push($datosViaje, nombreEmpresa(datos_Recorrido($fila['Recorrido'])[0]));
                array_push($datosViaje, $fila['Vehiculo']);
                array_push($datosViaje, datos_Recorrido($fila['Recorrido'])[1]);
                array_push($datosViaje, datos_Recorrido($fila['Recorrido'])[2]);
                array_push($datosViaje, $fila['Fecha']);
                array_push($datosViaje, $fila['Jornada']);
                array_push($datosViaje, datos_Recorrido($fila['Recorrido'])[3]);
                array_push($datosViaje, $fila['Nota']);
                break;
            }
        }
        return $datosViaje;
    }

    function conexionBDVehiculo() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM vehiculo";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function listaVehiculos() {
        $datos = conexionBDVehiculo();
        $listaPlacas = array();
        while($fila = mysqli_fetch_array($datos)) {
            array_push($listaPlacas, $fila['Placa']);
        }
        return $listaPlacas;
    }

    function estaVehiculo($Placa) {
        $datos = conexionBDVehiculo();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Placa'] == $Placa) {
                return TRUE;
                break;
            }
        }
        return FALSE;
    }

    function tieneConductorVehiculo($Documento) {
        $datos = conexionBDVehiculo();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Conductor'] == $Documento) {
                return TRUE;
                break;
            }
        }
        return FALSE;
    }

    function datosVehiculo($Placa) {
        $datos = conexionBDVehiculo();
        $datosVehiculo = array();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Placa'] == $Placa) {
                array_push($datosVehiculo, $fila['Placa']);
                array_push($datosVehiculo, $fila['NumInterno']);
                array_push($datosVehiculo, $fila['Conductor']);
                array_push($datosVehiculo, $fila['Soat']);
                array_push($datosVehiculo, $fila['Tecno']);
                array_push($datosVehiculo, $fila['Actual']);
                array_push($datosVehiculo, $fila['Contractual']);
                break;
            }
        }
        return $datosVehiculo;
    }

    function datosVehiculoConductor($Documento) {
        $datos = conexionBDVehiculo();
        $datosVehiculoConductor = array();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Conductor']) == number_format($Documento)) {
                array_push($datosVehiculoConductor, $fila['Placa']);
                array_push($datosVehiculoConductor, $fila['NumInterno']);
                break;
            }
        }
        return $datosVehiculoConductor;
    }

    function conexionBDTanqueada() {
        $conexion = conexionBD();
        $consulta = "SELECT * FROM tanqueada";
        $datos = mysqli_query($conexion, $consulta);
        return $datos;
    }

    function estaTanqueada($Id) {
        $datos = conexionBDTanqueada();
        while($fila = mysqli_fetch_array($datos)) {
            if ($fila['Id'] == $Id) {
                return TRUE;
                break;
            }
        }
        return FALSE;
    }

    function datosTanqueada($Id) {
        $datos = conexionBDTanqueada();
        $datosTanqueada = array();
        while($fila = mysqli_fetch_array($datos)) {
            if (number_format($fila['Id']) == number_format($Id)) {
                array_push($datosTanqueada, $fila['Vehiculo']);
                array_push($datosTanqueada, $fila['Recibo']);
                array_push($datosTanqueada, $fila['Fecha']);
                array_push($datosTanqueada, $fila['Valor']);
                array_push($datosTanqueada, $fila['Galones']);
                array_push($datosTanqueada, $fila['Nota']);
                break;
            }
        }
        return $datosTanqueada;
    }

    function validacionUsuario_RC($Documento) {
        $conexion = conexionBD();
        $estaDocumento = estaDocumento($Documento);
        $sql = "";
        if ($estaDocumento == TRUE) {
            $datos = conexionBDUsuario();
            while($fila = mysqli_fetch_array($datos)) {
                if (number_format($Documento) == number_format($fila['Documento'])) {
                    $NumAlt = rand(1000,20000);
                    $sql = "UPDATE usuario set RC='$NumAlt' WHERE Documento='$Documento'";
                    
                    $Destinatario = datosUsuario($Documento)[3];
                    $Asunto = "Código de verificación";
                    $Subject = utf8_decode($Asunto);
                    $descripcionUsuario = "Su código para la validación en la página de control de rutas es ". $NumAlt;
                    $Contenido = utf8_decode($descripcionUsuario) . "\n\n";
                    $Contenido .= "Gracias por confiar en nosotros";
                    mail($Destinatario, $Subject, $Contenido);

                    mysqli_query($conexion, $sql);
                    mysqli_close($conexion);
                    return TRUE;
                }
            }
            mysqli_query($conexion, $sql);
            mysqli_close($conexion);
        } else {
            return FALSE;
        }
    }
    
    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

    function comprobarFechaDocumento($Fecha) {
        $Año = number_format($Fecha[0].$Fecha[1].$Fecha[2].$Fecha[3]);
        $Mes = number_format($Fecha[5].$Fecha[6]);
        $Dia = number_format($Fecha[8].$Fecha[9]);

        if ($Año == date('Y')) {
            if ($Mes == date('m')) {
                if (($Dia-5) == date('d')) {
                    return 5;
                } elseif (($Dia-4) == date('d')) {
                    return 4;
                } elseif (($Dia-3) == date('d')) {
                    return 3;
                } elseif (($Dia-2) == date('d')) {
                    return 2;
                } elseif (($Dia-1) == date('d')) {
                    return 1;
                } elseif ($Dia == date('d')) {
                    return 0;
                } elseif ($Dia < date('d')) {
                    return (-1);
                }
            } elseif (($Mes-1) == date('m')) {
                if (($Mes == "01") or ($Mes == "03") or ($Mes == "05") or ($Mes == "07") or ($Mes == "08") or ($Mes == "10") or ($Mes == "12")) {
                    if (date('d') == 27) {
                        if ($Dia == 01) {
                            return 5;
                        }
                    } elseif (date('d') == 28) {
                        if ($Dia == 01) {
                            return 4;
                        } elseif ($Dia == 02) {
                            return 5;
                        }
                    } elseif (date('d') == 29) {
                        if ($Dia == 01) {
                            return 3;
                        } elseif ($Dia == 02) {
                            return 4;
                        } elseif ($Dia == 03) {
                            return 5;
                        }
                    } elseif (date('d') == 30) {
                        if ($Dia == 01) {
                            return 2;
                        } elseif ($Dia == 02) {
                            return 3;
                        } elseif ($Dia == 03) {
                            return 4;
                        } elseif ($Dia == 04) {
                            return 5;
                        }
                    } elseif (date('d') == 31) {
                        if ($Dia == 01) {
                            return 1;
                        } elseif ($Dia == 02) {
                            return 2;
                        } elseif ($Dia == 03) {
                            return 3;
                        } elseif ($Dia == 04) {
                            return 4;
                        } elseif ($Dia == 05) {
                            return 5;
                        }
                    }
                } elseif (($Mes == "04") or ($Mes == "06") or ($Mes == "09") or ($Mes == "11")) {
                    if (date('d') == 26) {
                        if ($Dia == 01) {
                            return 5;
                        }
                    } elseif (date('d') == 27) {
                        if ($Dia == 01) {
                            return 4;
                        } elseif ($Dia == 02) {
                            return 5;
                        }
                    } elseif (date('d') == 28) {
                        if ($Dia == 01) {
                            return 3;
                        } elseif ($Dia == 02) {
                            return 4;
                        } elseif ($Dia == 03) {
                            return 5;
                        }
                    } elseif (date('d') == 29) {
                        if ($Dia == 01) {
                            return 2;
                        } elseif ($Dia == 02) {
                            return 3;
                        } elseif ($Dia == 03) {
                            return 4;
                        } elseif ($Dia == 04) {
                            return 5;
                        }
                    } elseif (date('d') == 30) {
                        if ($Dia == 01) {
                            return 1;
                        } elseif ($Dia == 02) {
                            return 2;
                        } elseif ($Dia == 03) {
                            return 3;
                        } elseif ($Dia == 04) {
                            return 4;
                        } elseif ($Dia == 05) {
                            return 5;
                        }
                    }
                } elseif ($Mes == 02) {
                    if (date('L') == 1) {
                        if (date('d') == 25) {
                            if ($Dia == 01) {
                                return 5;
                            }
                        } elseif (date('d') == 26) {
                            if ($Dia == 01) {
                                return 4;
                            } elseif ($Dia == 02) {
                                return 5;
                            }
                        } elseif (date('d') == 27) {
                            if ($Dia == 01) {
                                return 3;
                            } elseif ($Dia == 02) {
                                return 4;
                            } elseif ($Dia == 03) {
                                return 5;
                            }
                        } elseif (date('d') == 28) {
                            if ($Dia == 01) {
                                return 2;
                            } elseif ($Dia == 02) {
                                return 3;
                            } elseif ($Dia == 03) {
                                return 4;
                            } elseif ($Dia == 04) {
                                return 5;
                            }
                        } elseif (date('d') == 29) {
                            if ($Dia == 01) {
                                return 1;
                            } elseif ($Dia == 02) {
                                return 2;
                            } elseif ($Dia == 03) {
                                return 3;
                            } elseif ($Dia == 04) {
                                return 4;
                            } elseif ($Dia == 05) {
                                return 5;
                            }
                        }
                    } else {
                        if (date('d') == 24) {
                            if ($Dia == 01) {
                                return 5;
                            }
                        } elseif (date('d') == 25) {
                            if ($Dia == 01) {
                                return 4;
                            } elseif ($Dia == 02) {
                                return 5;
                            }
                        } elseif (date('d') == 26) {
                            if ($Dia == 01) {
                                return 3;
                            } elseif ($Dia == 02) {
                                return 4;
                            } elseif ($Dia == 03) {
                                return 5;
                            }
                        } elseif (date('d') == 27) {
                            if ($Dia == 01) {
                                return 2;
                            } elseif ($Dia == 02) {
                                return 3;
                            } elseif ($Dia == 03) {
                                return 4;
                            } elseif ($Dia == 04) {
                                return 5;
                            }
                        } elseif (date('d') == 28) {
                            if ($Dia == 01) {
                                return 1;
                            } elseif ($Dia == 02) {
                                return 2;
                            } elseif ($Dia == 03) {
                                return 3;
                            } elseif ($Dia == 04) {
                                return 4;
                            } elseif ($Dia == 05) {
                                return 5;
                            }
                        }
                    }
                }
            } elseif ($Mes < date('m')) {
                return -1;
            }
        }
        return FALSE;
    }

?>