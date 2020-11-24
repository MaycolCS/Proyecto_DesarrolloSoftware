<?php

    include '../Funciones.php';

    $Documento=$_GET['cc'];
    if (SesionUsuario($Documento) == FALSE) {
        header("Location: ../Login");
        exit();
    }

    $Mensaje="";
    if (isset($_GET['msj'])) {
        $Mensaje=$_GET['msj'];
        if($Mensaje=="ESE") {
            echo '<script>alert("Recuerde que debe seleccionar la empresa")</script>';
        } else if($Mensaje=="REDB") {
            echo '<script>alert("El recorrido ya se encuentra registrado en la base de datos")</script>';
        }
    }
    
    /* Aqui empieza el código */

    $datosUsuario = datosUsuario($Documento);
    
    $empresas = listaEmpresas();
    $cant_empresas = count($empresas);
    $aux_cant_empresas = 0;

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
            <form class="form_Style" method="post" action="IngresarRecorridoDB.php? cc=<?php echo $Documento; ?>">
                <p class="txt_Titulo">Registro recorrido</p>
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
                <div>
                    <label>Origen:</label>
                    <input type="text" name="Origen" id="Origen" placeholder="lugar de origen" required/>
                </div>
                <div>
                    <label>Destino:</label>
                    <input type="text" name="Destino" id="Destino" placeholder="lugar destino" required/>
                </div>
                <div>
                    <label>Recorrido:</label>
                    <textarea type="text" name="Recorrido" id="Recorrido" placeholder="Describa el recorrido" required/></textarea>
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