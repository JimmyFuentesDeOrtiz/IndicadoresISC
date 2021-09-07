<?php

// Declaramos la librería
require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("./Controlador/Controlador.php");
$infPer = $_GET["infPer"];
$unPeri = explode('_', $infPer);
$nvlPar = getNivelParcial(1, $unPeri[0], $unPeri[1], $unPeri[2]);
$infoParcial = getInfoParcial($unPeri[0], $unPeri[1], $unPeri[2]);

$spread = new Spreadsheet();
$spread
        ->getProperties()
        ->setCreator("SISTEMA DE INDICADORES DE NIVEL DE DESEMPENIO")
        ->setTitle('Nivel de desempeño ISC')
        ->setSubject('Reporte')
        ->setDescription('Archivo creado con los de la App Web')
        ->setCategory('Categoría Excel');
$spread->setActiveSheetIndex(0);
$sheet = $spread->getActiveSheet();
$sheet->setTitle("ISIC-PROM");

for ($i = 7; $i < 11; $i++) {
    $sheet->mergeCells("A" . $i . ":L" . $i);
}
$sheet->getStyle('A7:A10')->getFont('Arial')->setBold(true)->setSize(12);
$sheet->getStyle('A7:A10')->getAlignment()->setHorizontal('center');

$sheet->setCellValue("A7", ("SEMESTRE " . (($unPeri[0] == 1) ? 'ENERO - JUNIO' : 'AGOSTO - DICIEMBRE')) . ' ' . $unPeri[1]);
$sheet->setCellValue("A8", "INDICADORES DE NIVEL DE DESEMPEÑO");
$sheet->setCellValue("A9", ($unPeri[2] == 1 ? 'PRIMER PARCIAL' : ($unPeri[2] == 2 ? 'SEGUNDO PARCIAL' : 'TERCER PARCIAL')));
$sheet->setCellValue("A10", "INGENIERÍA  EN  SISTEMAS  COMPUTACIONALES");


$sheet->getStyle('A14:P14')->getAlignment()->setHorizontal('center')->setWrapText(true);
$sheet->getStyle('A14:P14')->getAlignment()->setVertical('center');
$sheet->getStyle('A14:P14')->getFont()->setBold(true)->setSize(11);
$sheet->getStyle('A14:P14')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('A14:P14')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$celdas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P'];
for ($i = 0; $i < sizeof($celdas); $i++) {
    $sheet->getColumnDimension($celdas[$i])->setAutoSize(true);
    $sheet->getStyle($celdas[$i] . '14')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '14')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}

$sheet->getStyle('A14:P14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

$sheet->setCellValue("A14", " CLAVE \n GRUPO ");
$sheet->setCellValue("B14", "NOMBRE ASIGNATURA");
$sheet->setCellValue("C14", "NOMBRE DEL EJE");
$sheet->setCellValue("D14", "NOMBRE DEL DOCENTE");
$sheet->setCellValue("E14", "SUMA DE\nCALIFICACIONES");
$sheet->setCellValue("F14", "PROMEDIO DE\nCALIFICACIONES");
$sheet->setCellValue("G14", "TOTAL DE ESTUDIANTES\nEVALUADOS POR PARCIAL");
$sheet->setCellValue("H14", "TOTAL DE GRUPO");
$sheet->setCellValue("I14", "APROBADOS\nPOR PARCIAL");
$sheet->setCellValue("J14", "% DE\n APROBACIÓN ");
$sheet->setCellValue("K14", "REPROBADOS POR\nPARCIAL");
$sheet->setCellValue("L14", "% DE\n REPROBACIÓN ");
$sheet->setCellValue("M14", " APROBADOS \nUNIDAD 1");
$sheet->setCellValue("N14", " APROBADOS \nUNIDAD 2");
$sheet->setCellValue("O14", " REPROBADOS \nUNIDAD 1");
$sheet->setCellValue("P14", " REPROBADOS \nUNIDAD 2");

///////////////////////////////////////////////////////////////////

$sumatot = 0;
$promtot = 0;
$estuEvaltot = 0;
$filaAct = 14;
for ($i = 0; $i < sizeof($nvlPar); $i++) {
    $filaAct ++;
    $sheet->getStyle('E' . $filaAct . ':P' . $filaAct)->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getAlignment()->setVertical('center');
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFont()->setSize(11);
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    if ($nvlPar[$i][13] != '') {
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }

    for ($j = 0; $j < sizeof($nvlPar[$i]); $j++) {

        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->setCellValue($celdas[$j] . '' . $filaAct, '' . $nvlPar[$i][$j] . (($j == 9 || $j == 11) ? '%' : ''));

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
}
$filaAct++;

$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getAlignment()->setHorizontal('center');
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFont()->setBold(true)->setSize(11);
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('F' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('F' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

$sheet->setCellValue($celdas[4] . '' . ($filaAct), $sumatot);
$sheet->setCellValue($celdas[5] . '' . ($filaAct), bcdiv($promtot / sizeof($nvlPar), 1, 2));
$sheet->setCellValue($celdas[6] . '' . ($filaAct), $estuEvaltot);

$filaAct += 5;
////////////////////////////////////////////////////////////////


$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getAlignment()->setHorizontal('center')->setWrapText(true);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getAlignment()->setVertical('center');
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFont('Arial')->setBold(true)->setSize(18);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

for ($i = 1; $i < 8; $i++) {
    $sheet->getStyle($celdas[$i] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . ($filaAct + 1))->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . ($filaAct + 1))->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}
$sheet->setCellValue("B" . $filaAct, "Matrícula\nOficial");
$sheet->setCellValue("C" . $filaAct, "Matrícula evaluada en\nasignaturas de estructura\ngenérica y de especialidad");
$sheet->setCellValue("D" . $filaAct, "Promedio");
$sheet->setCellValue("E" . $filaAct, "No.\nEstudiantes\nAprobados");
$sheet->setCellValue("F" . $filaAct, "Porcentaje\nde\nAprobación");
$sheet->setCellValue("G" . $filaAct, "No.\nEstudiantes\nReprobados");
$sheet->setCellValue("H" . $filaAct, "Porcentaje de\nReprobación");

$filaAct++;

$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getAlignment()->setHorizontal('center');
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFont('Arial')->setSize(18);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


$sheet->setCellValue("B" . $filaAct, $infoParcial[0]);
$sheet->setCellValue("C" . $filaAct, $infoParcial[1]);
$sheet->setCellValue("D" . $filaAct, bcdiv($promtot / sizeof($nvlPar), 1, 2));
$sheet->setCellValue("E" . $filaAct, $infoParcial[2]);
$sheet->setCellValue("F" . $filaAct, $infoParcial[3] . '%');
$sheet->setCellValue("G" . $filaAct, $infoParcial[4]);
$sheet->setCellValue("H" . $filaAct, $infoParcial[5] . '%');


////////////////////////////////////////////////////////////////////////////////////////
//Hoja 2
$nvlPar = getNivelParcial(2, $unPeri[0], $unPeri[1], $unPeri[2]);
$infoAreas = getInfoAreas($unPeri[0], $unPeri[1], $unPeri[2]);

$spread->createSheet(1);
$spread->setActiveSheetIndex(1);
$sheet = $spread->getActiveSheet();
$sheet->setTitle("ISIC-AREAS");

for ($i = 6; $i < 10; $i++) {
    $sheet->mergeCells("A" . $i . ":L" . $i);
}
$sheet->getStyle('A6:A9')->getFont('Arial')->setBold(true)->setSize(12);
$sheet->getStyle('A6:A9')->getAlignment()->setHorizontal('center');

$sheet->setCellValue("A6", ("SEMESTRE " . (($unPeri[0] == 1) ? 'ENERO - JUNIO' : 'AGOSTO - DICIEMBRE')) . ' ' . $unPeri[1]);
$sheet->setCellValue("A7", "INDICADORES DE NIVEL DE DESEMPEÑO");
$sheet->setCellValue("A8", ($unPeri[2] == 1 ? 'PRIMER PARCIAL' : ($unPeri[2] == 2 ? 'SEGUNDO PARCIAL' : 'TERCER PARCIAL')));
$sheet->setCellValue("A9", "INGENIERÍA  EN  SISTEMAS  COMPUTACIONALES");

$k = 0;
$filaAct = 11;
$cantAsig = 0;
$eje = "";
$tablaUlt[$k][0] = $eje;

for ($i = 0; $i < sizeof($nvlPar); $i++) {
    $cantAsig++;
    if ($eje != $nvlPar[$i][2]) {
        $sumatot = 0;
        $promtot = 0;
        $estuEvaltot = 0;
        $cantAsig = 0;
        $eje = $nvlPar[$i][2];
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getAlignment()->setHorizontal('center')->setWrapText(true);
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getAlignment()->setVertical('center');
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        for ($j = 0; $j < sizeof($celdas); $j++) {
            $sheet->getColumnDimension($celdas[$j])->setAutoSize(true);
            $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

        $sheet->setCellValue("A" . $filaAct, " CLAVE \n GRUPO ");
        $sheet->setCellValue("B" . $filaAct, "NOMBRE ASIGNATURA");
        $sheet->setCellValue("C" . $filaAct, "NOMBRE DEL EJE");
        $sheet->setCellValue("D" . $filaAct, "NOMBRE DEL DOCENTE");
        $sheet->setCellValue("E" . $filaAct, "SUMA DE\nCALIFICACIONES");
        $sheet->setCellValue("F" . $filaAct, "PROMEDIO DE\nCALIFICACIONES");
        $sheet->setCellValue("G" . $filaAct, "TOTAL DE ESTUDIANTES\nEVALUADOS POR PARCIAL");
        $sheet->setCellValue("H" . $filaAct, "TOTAL DE GRUPO");
        $sheet->setCellValue("I" . $filaAct, "APROBADOS\nPOR PARCIAL");
        $sheet->setCellValue("J" . $filaAct, "% DE\n APROBACIÓN ");
        $sheet->setCellValue("K" . $filaAct, "REPROBADOS POR\nPARCIAL");
        $sheet->setCellValue("L" . $filaAct, "% DE\n REPROBACIÓN ");
        $sheet->setCellValue("M" . $filaAct, " APROBADOS \nUNIDAD 1");
        $sheet->setCellValue("N" . $filaAct, " APROBADOS \nUNIDAD 2");
        $sheet->setCellValue("O" . $filaAct, " REPROBADOS \nUNIDAD 1");
        $sheet->setCellValue("P" . $filaAct, " REPROBADOS \nUNIDAD 2");
    }

    $filaAct ++;
    $sheet->getStyle('E' . $filaAct . ':P' . $filaAct)->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getAlignment()->setVertical('center');
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFont()->setSize(11);
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    if ($nvlPar[$i][13] != '') {
        $sheet->getStyle('A' . $filaAct . ':P' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }
    if ($nvlPar[$i][11] > 30) {
        $sheet->getStyle('L' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFB0B0');
        $sheet->getStyle('L' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }

    for ($j = 0; $j < sizeof($nvlPar[$i]); $j++) {

        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->setCellValue($celdas[$j] . '' . $filaAct, '' . $nvlPar[$i][$j] . (($j == 9 || $j == 11) ? '%' : ''));

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
    if ($i < sizeof($nvlPar) - 1) {
        if ($eje != $nvlPar[$i + 1][2]) {
            $filaAct++;

            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFont()->setBold(true)->setSize(11);
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('F' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('F' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

            $sheet->setCellValue($celdas[4] . '' . ($filaAct), $sumatot);
            $sheet->setCellValue($celdas[5] . '' . ($filaAct), bcdiv($promtot / ($cantAsig + 1), 1, 2));
            $sheet->setCellValue($celdas[6] . '' . ($filaAct), $estuEvaltot);

            $tablaUlt[$k][0] = $eje;
            $tablaUlt[$k][1] = bcdiv($promtot / ($cantAsig + 1), 1, 2);
            $k++;
            $filaAct += 3;
        }
    } else {

        $filaAct++;

        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('F' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('F' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $filaAct . ':G' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

        $sheet->setCellValue($celdas[4] . '' . ($filaAct), $sumatot);
        $sheet->setCellValue($celdas[5] . '' . ($filaAct), bcdiv($promtot / ($cantAsig + 1), 1, 2));
        $sheet->setCellValue($celdas[6] . '' . ($filaAct), $estuEvaltot);

        $tablaUlt[$k][0] = $eje;
        $tablaUlt[$k][1] = bcdiv($promtot / ($cantAsig + 1), 1, 2);
        $filaAct += 4;
    }
}

////////////////////////////////////////////////////////////////////////////////////////

$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getAlignment()->setHorizontal('center')->setWrapText(true);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getAlignment()->setVertical('center');
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFont('Arial')->setBold(true)->setSize(12);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

for ($i = 1; $i < 8; $i++) {
    $sheet->getStyle($celdas[$i] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . ($filaAct + 1))->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '' . ($filaAct + 1))->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}
$sheet->setCellValue("B" . $filaAct, "NOMBRE DEL EJE");
$sheet->setCellValue("C" . $filaAct, "PROMEDIO");
$sheet->setCellValue("D" . $filaAct, "TOTAL DE\nESTUDIANTES\nEVALUADOS");
$sheet->setCellValue("E" . $filaAct, "APROBADOS\nPOR PARCIAL");
$sheet->setCellValue("F" . $filaAct, "% DE\nAPROBACIÓN");
$sheet->setCellValue("G" . $filaAct, "REPROBADOS\nPOR PARCIAL");
$sheet->setCellValue("H" . $filaAct, "% DE\nREPROBACIÓN");

$filaAct++;
$promtot = 0;
for ($i = 0; $i < sizeof($infoAreas); $i++) {
    $posceldas = 1;
    $sheet->getStyle('C' . $filaAct . ':H' . $filaAct)->getAlignment()->setHorizontal('center');
    $sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getFont('Arial')->setSize(12);
    $sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle('B' . $filaAct . ':H' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    for ($j = 0; $j < sizeof($tablaUlt); $j++) {
        if ($tablaUlt[$j][0] == $infoAreas[$i][0]) {
            $sheet->getStyle($celdas[$posceldas] . '' . ($filaAct))->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle($celdas[$posceldas] . '' . ($filaAct))->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->setCellValue($celdas[$posceldas] . "" . $filaAct, $tablaUlt[$j][0]);
            $posceldas++;
            $sheet->setCellValue($celdas[$posceldas] . "" . $filaAct, $tablaUlt[$j][1]);
            $promtot += $tablaUlt[$j][1];
            $posceldas++;
        }
    }
    if ($infoAreas[$i][5] > 30) {
        $sheet->getStyle('H' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFB0B0');
        $sheet->getStyle('H' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }
    for ($j = 1; $j < sizeof($infoAreas[0]); $j++) {
        $sheet->getStyle($celdas[$posceldas] . '' . ($filaAct))->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($celdas[$posceldas] . '' . ($filaAct))->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->setCellValue($celdas[$posceldas] . "" . $filaAct, (($j == 3 || $j == 5) ? bcdiv($infoAreas[$i][$j], 1, 2) . '%' : $infoAreas[$i][$j]));
        $posceldas++;
    }
    $filaAct++;
}

$sheet->getStyle('C' . $filaAct)->getAlignment()->setHorizontal('center');
$sheet->getStyle('C' . $filaAct)->getFont('Arial')->setBold(true)->setSize(12);
$sheet->getStyle('C' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$promtot /= sizeof($infoAreas);
$sheet->setCellValue('C' . $filaAct, bcdiv($promtot, 1, 2));


////////////////////////////////////////////////////////////////////////////////////////

$nomArchiv = ($unPeri[2] == 1 ? '1er.PARCIAL_' : ($unPeri[2] == 2 ? '2do.PARCIAL_' : '3er.PARCIAL_')) . ($unPeri[0] == 1 ? 'ENE-JUN' : 'AGO-DIC') . '_' . $unPeri[1] . '_SISTEMAS_COMPUTACIONALES';
$fileName = $nomArchiv . ".xlsx";
# Crear un "escritor"
$writer = new Xlsx($spread);
# Le pasamos la ruta de guardado

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
$writer->save('php://output');
?>