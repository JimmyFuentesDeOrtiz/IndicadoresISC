<?php
include('head.php');
$infPer = $_GET["infPer"];
$unPeri = explode('_', $infPer);
$nvlFin = getNivelFinal($unPeri[0], $unPeri[1]);
$infoFin = getInfoFinal($unPeri[0], $unPeri[1]);
?>
<div class="especialidad">
    <div class="contenedor-texto topmargin-xs">
        <div class="t-malla container">
            <h2 class="text-center" style="color:#5f5f5f !important;">SEMESTRE <?php echo ($unPeri[0] == 1 ? 'ENERO-JUNIO' : 'AGOSTO-DICIEMBRE') . ' ' . $unPeri[1]; ?></h2>
            <p class="text-center" style="color:#5f5f5f !important;">INDICADORES DE NIVEL DE DESEMPEÑO<br>INDICADORES FINALES<br>INGENIERÍA EN SISTEMAS COMPUTACIONALES</p>
        </div>
        <div class="text-center">
            <?php
            echo '<a class="text-center btn btn-primary " href="generarExcelFinal.php?infPer=' . $unPeri[0] . '_' . $unPeri[1] . '"><i class="bi bi-download"></i></a>';
            ?>
        </div>
        <?php
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
                                    <p style="color:#000000 !important;"><b>TOTAL DE ESTUDIANTES EVALUADOS POR ASIGNATURA</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>APROBADOS POR ASIGNATURA</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE APROBACIÓN</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>REPROBADOS POR ASIGNATURA</b></p>
                                </div>
                            </th>
                            <th style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#000000 !important;"><b>% DE REPROBACIÓN</b></p>
                                </div>
                            </th>
                        </tr>';
        $sumatot = 0;
        $promtot = 0;
        $estuEvaltot = 0;
        for ($i = 0; $i < sizeof($nvlFin); $i++) {
            echo '<tr>';
            for ($j = 0; $j < sizeof($nvlFin[0]); $j++) {
                echo'<td style="border: 1px solid rgba(0, 0, 0);">
                                <div class="mb-1 semestres text-center" >
                                    <p style="color:#5f5f5f !important;"><b>' . $nvlFin[$i][$j] . (($j == 7 || $j == 9) ? '%' : '') . '</b></p>
                                </div>
                            </td>';
                switch ($j) {
                    case 3:
                        $sumatot += $nvlFin[$i][$j];
                        break;
                    case 4:
                        $promtot += $nvlFin[$i][$j];
                        break;
                    case 5:
                        $estuEvaltot += $nvlFin[$i][$j];
                        break;
                }
            }
            echo '</tr>';
        }
        echo '<tr>
                <td></td>
                <td></td>
                <td></td>
                        <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . $sumatot . '</b></td>
                        <td style="background: rgba(160, 160, 160); border: 1px solid rgba(0, 0, 0);"><b>' . bcdiv($promtot / sizeof($nvlFin), 1, 2) . '</b></td>
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
        for ($j = 0; $j < sizeof($infoFin); $j++) {
            if ($j == 2) {
                echo'<td style="border: 1px solid rgba(0, 0, 0);">
                            <div class="mb-1 semestres text-center" >
                                <p style="color:#5f5f5f !important;"><b>' . bcdiv($promtot / sizeof($nvlFin), 1, 2) . '</b></p>
                            </div>
                        </td>';
            }
            echo'<td style="border: 1px solid rgba(0, 0, 0);">
                        <div class="mb-1 semestres text-center" >
                            <p style="color:#5f5f5f !important;"><b>' . $infoFin[$j] . (($j == 3 || $j == 5) ? '%' : '') . '</b></p>
                        </div>
                    </td>';
        }
        echo '</tr>
            </table>    
        </div>
    </div> ';
        ?>
    </div>
</div>
<?php include('footer.php'); ?>