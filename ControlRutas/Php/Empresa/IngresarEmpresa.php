<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }    


    $Departamento = 0;
    $count_Ciudad = 0;
    $count_Ciudad_Aux = 1;

    include '../Dpto_Ciudades.php';

    if (isset($_POST['Departamento'])) {
        if ($_POST['Departamento'] == "SinSelección") {
            echo '<script>alert("¡Recuerde que debe seleccionar el departamento!")</script>';
        }
        else {
            $Departamento=$_POST['Departamento'];
            $count_Ciudad = count($Ciudades[$Departamento]);
        }
    }

    $count_Depto = count($Departamentos);
    $count_Depto_Aux = 1;

    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
        if ($Mensaje == "CVC") {
            $Departamento = 0;
            $count_Ciudad = 0;
            $count_Ciudad_Aux = 1;
            $count_Depto_Aux = 1;
            echo '<script>alert("¡Recuerde que debe seleccionar la ciudad!")</script>';
        }
        if ($Mensaje == "ERA") {
            $Departamento = 0;
            $count_Ciudad = 0;
            $count_Ciudad_Aux = 1;
            $count_Depto_Aux = 1;
            echo '<script>alert("¡La empresa ya se encuentra registrada!")</script>';
        }
    }

    if($Mensaje=="EEDB") {
        echo '<script>alert("El nombre de la empresa ya se encuentra registrado")</script>';
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    /*$empresas = listaEmpresas();
    $cant_empresas = count($empresas);
    $aux_cant_empresas = 0;*/

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
            if ($Departamento==0) {?>
            <form class="form_Style" method="post" action="IngresarEmpresa? cc=<?php echo $Documento; ?>">
                <p class="txt_Subtitulo">Seleccione el departamento de la empresa</p>
                <div>
                    <label>Departamento:</label>
                    <select name="Departamento" id="Departamento">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($count_Depto_Aux <= $count_Depto) {?>
                            <option value="<?php echo $count_Depto_Aux ;?>"><?php echo $Departamentos[$count_Depto_Aux] ;?></option>
                            <?php
                            $count_Depto_Aux = $count_Depto_Aux+1;
                        }
                        ?>
                    </select>
                </div>
                <div class="Boton_Style">
                    <button type="submit">Filtrar</button>
                </div>
            </form>
            <?php
            } else {?>
            <form class="form_Style" method="post" action="IngresarEmpresaDB? cc=<?php echo $Documento; ?>" accept-charset="utf-8">
                <p class="txt_Titulo">Registro empresa</p>
                <div>
                    <label>Nit:</label>
                    <input type="number" name="nitEmpresa" id="nitEmpresa" placeholder="Número de nit" required/>
                </div>  
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="nombreEmpresa" id="nombreEmpresa" placeholder="Nombre empresa" required/>
                </div>
                <div>
                    <label>Ciudad:</label>
                    <select name="ciudadEmpresa" id="ciudadEmpresa">
                        <option selected value="SinSelección">Elige una opción</option>
                        <?php
                        while ($count_Ciudad_Aux <= $count_Ciudad) {?>
                            <option value="<?php echo $Ciudades[$Departamento][$count_Ciudad_Aux];?>"><?php echo $Ciudades[$Departamento][$count_Ciudad_Aux] ;?></option>
                            <?php
                            $count_Ciudad_Aux = $count_Ciudad_Aux+1;
                        }
                        ?>
                    </select>
                </div>                  
                <div>
                    <button type="submit">Enviar</button>
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