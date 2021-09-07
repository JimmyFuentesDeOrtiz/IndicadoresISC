<?php
include("./Controlador/Controlador.php");
$peri = getPeriodo();
$numFinales = getNumFinales();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!--Componente galeria-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
        <!--BootStrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--ICONOS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!--Tipografia-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;700&display=swap" rel="stylesheet">
        <!--CSS Local-->
        <link rel="stylesheet" type="text/css" href="css/investigacion.css?1.0.0" />
        <link rel="stylesheet" type="text/css" href="css/login.css?1.0.0" />
        <link rel="stylesheet" href="css/index.css" />
        <link rel="stylesheet" href="css/peisc.css" />
        <link rel="stylesheet" href="css/asociaciones.css" />
        <link rel="stylesheet" href="css/acreditacion.css?1.0.0" />
        <link rel="stylesheet" href="css/organigrama.css?1.0.0">
        <link rel="stylesheet" href="css/asesorias.css">
        <link rel="stylesheet" href="css/complementarias.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="css/especialidad.css" />
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/servicios.css?1.0.0" />
        <link rel="stylesheet" type="text/css" href="css/historialEspecialidad.css?1.0.0" />
        <link rel="stylesheet" href="css/particula.css?1.0.0">
        <!--iconos de la plataforma fontawesome-->
        <link rel="icon" type="image/png" href="img/icono.png" />
        <title>Indicadores</title>
    </head>

    <body>
        <nav id="menu" class="navbar navbar-expand-lg fixed-top ">
            <div class="container">
                <a class="navbar-brand" target="_blank" href="http://www.itsoeh.edu.mx/front/">
                    <img src="img/logos/itsoeh-isic.png?1.0.0" alt="logo" class="logo-itsoeh-sup">
                </a>
                <div id="hamburger">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="top-line"></span>
                        <span class="middle-line"></span>
                        <span class="bottom-line"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="tabs navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php?1.0.0"><span class="tab-text">Inicio</span></a></li>
                        <li class="nav-item">
                            <div class="dropdown-local">
                                <div class="nav-link"><span class="tab-text">Semestre</span></div>
                                <div class="dropdown-content">
                                    <?php
                                    for ($i = 0; $i < sizeof($peri); $i++) {
                                        echo '<a href="parcial.php?infPer=' . $peri[$i][0] . '_' . $peri[$i][1] . '">' . $peri[$i][1] . ' ' . ($peri[$i][0] == 1 ? 'ENERO-JUNIO' : 'AGOSTO-DICIEMBRE') . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown-local">
                                <div class="nav-link"><span class="tab-text">Finales</span></div>
                                <div class="dropdown-content">
                                    <?php
                                    for ($i = 0; $i < sizeof($numFinales); $i++) {
                                        echo '<a href="finales.php?infPer=' . $numFinales[$i][0] . '_' . $numFinales[$i][1] . '">' . $numFinales[$i][1] . ' ' . ($numFinales[$i][0] == 1 ? 'ENERO-JUNIO' : 'AGOSTO-DICIEMBRE') . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>