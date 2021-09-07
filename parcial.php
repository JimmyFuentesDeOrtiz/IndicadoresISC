<?php
include('head.php');
$infPer = $_GET["infPer"];
$datos = explode('_', $infPer);
$op = 1;
if (sizeof($datos) == 2) {
    $unPeri = getUnPeriodo($datos[0], $datos[1]);
} else if (sizeof($datos) == 4) {
    $op = $datos[3];
    $unPeri = $datos;
}
$nvlPar = getNivelParcial($op, $unPeri[0], $unPeri[1], $unPeri[2]);
$infoParcial = getInfoParcial($unPeri[0], $unPeri[1], $unPeri[2]);
$noPar = getNumParcialSem($unPeri[0], $unPeri[1]);
$infoAreas = getInfoAreas($unPeri[0], $unPeri[1], $unPeri[2])
?>
<div class="especialidad">
    <div class="contenedor-texto topmargin-xs">
        <div class="t-malla container">
            <h2 class="text-center" style="color:#5f5f5f !important;">SEMESTRE <?php echo ($unPeri[0] == 1 ? 'ENERO-JUNIO' : 'AGOSTO-DICIEMBRE') . ' ' . $unPeri[1]; ?></h2>
            <p class="text-center" style="color:#5f5f5f !important;">INDICADORES DE NIVEL DE DESEMPEÑO<br><?php echo '' . ($unPeri[2] == 1 ? 'PRIMER PARCIAL' : ($unPeri[2] == 2 ? 'SEGUNDO PARCIAL' : 'TERCER PARCIAL')) . '' ?> <br>INGENIERÍA  EN  SISTEMAS  COMPUTACIONALES</p>
        </div>
        <div class="text-center">
            <?php
            echo '<a class="text-center btn btn-outline-primary" href="parcial.php?infPer=' . $unPeri[0] . '_' . $unPeri[1] . '_' . $unPeri[2] . '_1">ISIC-PROM</a>
            <a class="text-center btn btn-outline-primary" href="parcial.php?infPer=' . $unPeri[0] . '_' . $unPeri[1] . '_' . $unPeri[2] . '_2">ISIC-AREAS</a>
            
            <div class="btn-group">
                <button type="button" class="btn btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                PARCIAL
                </button>
                <div class="dropdown-menu">';
            for ($i = 0; $i < sizeof($noPar); $i++) {
                echo '<a class="dropdown-item" href="parcial.php?infPer=' . $unPeri[0] . '_' . $unPeri[1] . '_' . $noPar[$i] . '_' . $op . '">' . ($noPar[$i] == 1 ? 'PRIMER PARCIAL' : ($noPar[$i] == 2 ? 'SEGUNDO PARCIAL' : 'TERCER PARCIAL')) . '</a>';
            }
            echo ' 
                </div>
            </div>
            <a class="text-center btn btn-primary" href="generarExcelPar.php?infPer=' . $unPeri[0] . '_' . $unPeri[1] . '_' . $unPeri[2] . '"><i class="bi bi-download"></i></a>';
            ?>
        </div>
        <?php
        if ($op != 1) {
            $k = 0;
            $tablaUlt[0][0] = 0;
            $sumatot = 0;
            $promtot = 0;
            $estuEvaltot = 0;
            $cantAsig = 0;
            $eje = $nvlPar[0][2];
            $tablaUlt[$k][0] = $eje;
            $flag = 1;
            if (is_array($nvlPar)) {
                for ($i = 0; $i < sizeof($nvlPar); $i++) {
                    $cantAsig ++;
                    if ($flag == 1) {
                        $flag = 0;
                        $sumatot = 0;
                        $promtot = 0;
                        $estuEvaltot = 0;
                        $cantAsig = 0;
                        echo '
            <div>
            <div class="malla">
                <div class="table-responsive">
                    <table>
                        <tr style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);">
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>CLAVE GRUPO</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE ASIGNATURA</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE DEL EJE</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE DEL DOCENTE</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>SUMA DE CALIFICACIONES</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>PROMEDIO DE CALIFICACIONES</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>TOTAL DE ESTUDIANTES EVALUADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>TOTAL DE GRUPO</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE APROBACIÓN</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE REPROBACIÓN</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS UNIDAD 1</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS UNIDAD 2</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS UNIDAD 1</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS UNIDAD 2</b></p>
                                </div>
                            </th>
                        </tr>';
                    }
                    echo '<tr>';
                    for ($j = 0; $j < sizeof($nvlPar[$i]); $j++) {
                        echo'<td style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="' . (($nvlPar[$i][13] != '') ? 'color:#ff0000' : 'color:#5f5f5f') . ' !important;"><b>' . $nvlPar[$i][$j] . (($j == 9 || $j == 11) ? '%' : '') . '</b></p>
                                </div>
                            </td>';
                        switch ($j) {
                            case 4:
                                $sumatot += $nvlPar[$i][$j];
                                break;
                            case 5:
                                $promtot += $nvlPar[$i][$j];
                                break;
                            case 6:
                                $estuEvaltot += $nvlPar[$i][$j];
                                break;
                        }
                    }
                    echo '</tr>';
                    if ($i < sizeof($nvlPar) - 1) {
                        if ($eje != $nvlPar[$i + 1][2]) {
                            $eje = $nvlPar[$i + 1][2];
                            $flag = 1;
                            echo '<tr>';
                            for ($j = 0; $j < 4; $j++) {
                                echo'<td></td>';
                            }
                            echo '
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $sumatot . '</b></td>
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . bcdiv($promtot / ($cantAsig + 1), 1, 2) . '</b></td>
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $estuEvaltot . '</b></td>
                            </tr>
                            </table>    
                        </div>
                    </div>
                </div>';
                            $tablaUlt[$k][1] = bcdiv($promtot / ($cantAsig + 1), 1, 2);
                            $k++;
                            $tablaUlt[$k][0] = $eje;
                        }
                    } else {
                        echo '<tr>';
                        for ($j = 0; $j < 4; $j++) {
                            echo'<td></td>';
                        }
                        echo '
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $sumatot . '</b></td>
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . bcdiv($promtot / ($cantAsig + 1), 1, 2) . '</b></td>
                                <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $estuEvaltot . '</b></td>
                            </tr>
                            </table>    
                        </div>
                    </div>
                </div>';
                        $tablaUlt[$k][1] = bcdiv($promtot / ($cantAsig + 1), 1, 2);
                        $k++;
                    }
                }
            }

            echo '<div class="malla">
        <div class="table-responsive">
            <table>
                <tr style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);">
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>NOMBRE DEL EJE</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>PROMEDIO</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>TOTAL DE ESTUDIANTES EVALUADOS</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>APROBADOS POR PARCIAL</b></p>
                        </div>
                    </th>

                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>% DE APROBACIÓN</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>REPROBADOS POR PARCIAL</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>% DE REPROBACIÓN</b></p>
                        </div>
                    </th>

                </tr>';
            $promtot = 0;
            for ($i = 0; $i < sizeof($infoAreas); $i++) {
                echo '<tr>';
                for ($j = 0; $j < sizeof($tablaUlt); $j++) {
                    if ($tablaUlt[$j][0] == $infoAreas[$i][0]) {
                        echo'<td style="border: 1px solid rgba(0, 0, 0);">
                            <div class="mb-1 semestres text-center" >
                                <p style="color:#5f5f5f !important;"><b>' . $tablaUlt[$j][0] . '</b></p>
                            </div>
                        </td>
                        <td style="border: 1px solid rgba(0, 0, 0);">
                            <div class="mb-1 semestres text-center" >
                                <p style="color:#5f5f5f !important;"><b>' . $tablaUlt[$j][1] . '</b></p>
                            </div>
                        </td>';
                        $promtot += $tablaUlt[$j][1];
                    }
                }
                for ($j = 1; $j < sizeof($infoAreas[0]); $j++) {
                    echo'<td style="border: 1px solid rgba(0, 0, 0); ' . (($j == 5 && $infoAreas[$i][$j] > 30) ? 'background: rgba(250, 0, 0, .3);' : '') . '">
                            <div class="mb-1 semestres text-center" >
                                <p style="' . (($j == 5 && $infoAreas[$i][$j] > 30) ? 'color:#ff0000' : 'color:#5f5f5f') . ' !important;"><b>' . (($j == 3 || $j == 5) ? bcdiv($infoAreas[$i][$j], 1, 2) . '%' : $infoAreas[$i][$j]) . '</b></p>
                            </div>
                        </td>';
                }
                echo '</tr>';
            }
            $promtot /= sizeof($infoAreas);
            echo '</tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#5f5f5f !important;"><b>' . $promtot . '</b></p>
                        </div>
                    </td>
                </tr>';
            echo '</table>    
                </div>
            </div> ';
        } else {
            echo '
            <div>
            <div class="malla">
                <div class="table-responsive">
                    <table>
                        <tr style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);">
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>CLAVE GRUPO</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE ASIGNATURA</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE DEL EJE</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>NOMBRE DEL DOCENTE</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>SUMA DE CALIFICACIONES</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>PROMEDIO DE CALIFICACIONES</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>TOTAL DE ESTUDIANTES EVALUADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>TOTAL DE GRUPO</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE APROBACIÓN</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS POR PARCIAL</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE REPROBACIÓN</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS UNIDAD 1</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS UNIDAD 2</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS UNIDAD 1</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS UNIDAD 2</b></p>
                                </div>
                            </th>
                        </tr>';
            $sumatot = 0;
            $promtot = 0;
            $estuEvaltot = 0;
            for ($i = 0; $i < sizeof($nvlPar); $i++) {
                echo '<tr>';
                for ($j = 0; $j < sizeof($nvlPar[$i]); $j++) {
                    echo'<td style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="' . (($nvlPar[$i][13] != '') ? 'color:#ff0000' : 'color:#5f5f5f') . ' !important;"><b>' . $nvlPar[$i][$j] . (($j == 9 || $j == 11) ? '%' : '') . '</b></p>
                                </div>
                            </td>';
                    switch ($j) {
                        case 4:
                            $sumatot += $nvlPar[$i][$j];
                            break;
                        case 5:
                            $promtot += $nvlPar[$i][$j];
                            break;
                        case 6:
                            $estuEvaltot += $nvlPar[$i][$j];
                            break;
                    }
                }
                echo '</tr>';
            }
            echo '<tr>';
            for ($i = 0; $i < 4; $i++) {
                echo'<td></td>';
            }
            echo '
                        <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $sumatot . '</b></td>
                        <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . bcdiv($promtot / sizeof($nvlPar), 1, 2) . '</b></td>
                        <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $estuEvaltot . '</b></td>
                    </tr>
                    </table>    
                </div>
            </div>
        </div>';
            echo '
            <div class="malla">
        <div class="table-responsive">
            <table>
                <tr style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);">
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>Matrícula Oficial </b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>Matrícula evaluada en asignaturas de estructura genérica y de especialidad</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>Promedio</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>No. Estudiantes Aprobados</b></p>
                        </div>
                    </th>

                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>Porcentaje de Aprobación</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>No. Estudiantes Reprobados</b></p>
                        </div>
                    </th>
                    <th style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#000000 !important;"><b>Porcentaje de Reprobación</b></p>
                        </div>
                    </th>

                </tr>
                <tr>';
            for ($j = 0; $j < sizeof($infoParcial); $j++) {
                if ($j == 2) {
                    echo'<td style="border: 1px solid rgba(0, 0, 0);">
                            <div class="mb-1 semestres text-center" >
                                <p style="color:#5f5f5f !important;"><b>' . bcdiv($promtot / sizeof($nvlPar), 1, 2) . '</b></p>
                            </div>
                        </td>';
                }
                echo'<td style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#5f5f5f !important;"><b>' . $infoParcial[$j] . (($j == 3 || $j == 5) ? '%' : '') . '</b></p>
                        </div>
                    </td>';
            }
            echo '</tr>
            </table>    
        </div>
    </div> ';
        }
        ?>
    </div>
</div>
<?php include('footer.php'); ?>