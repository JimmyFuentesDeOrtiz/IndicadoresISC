<?php

// Declaramos la librería
require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("./Controlador/Controlador.php");
$infPer = $_GET["infPer"];
$unPeri = explode('_', $infPer);
$nvlFin = getNivelFinal($unPeri[0], $unPeri[1]);
$infoFin = getInfoFinal($unPeri[0], $unPeri[1]);

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
$sheet->setTitle("ISIC-OK");

for ($i = 7; $i < 11; $i++) {
    $sheet->mergeCells("A" . $i . ":J" . $i);
}
$sheet->getStyle('A7:A10')->getFont('Arial')->setBold(true)->setSize(12);
$sheet->getStyle('A7:A10')->getAlignment()->setHorizontal('center');

$sheet->setCellValue("A7", ("SEMESTRE " . (($unPeri[0] == 1) ? 'ENERO - JUNIO' : 'AGOSTO - DICIEMBRE')) . ' ' . $unPeri[1]);
$sheet->setCellValue("A8", "INDICADORES DE NIVEL DE DESEMPEÑO");
$sheet->setCellValue("A9", "INDICADORES FINALES");
$sheet->setCellValue("A10", "INGENIERÍA  EN  SISTEMAS  COMPUTACIONALES");


$sheet->getStyle('A14:J14')->getAlignment()->setHorizontal('center')->setWrapText(true);
$sheet->getStyle('A14:J14')->getAlignment()->setVertical('center');
$sheet->getStyle('A14:J14')->getFont()->setBold(true)->setSize(11);
$sheet->getStyle('A14:J14')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('A14:J14')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$celdas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
for ($i = 0; $i < sizeof($celdas); $i++) {
    $sheet->getColumnDimension($celdas[$i])->setAutoSize(true);
    $sheet->getStyle($celdas[$i] . '14')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($celdas[$i] . '14')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}

$sheet->getStyle('A14:J14')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

$sheet->setCellValue("A14", " CLAVE \n GRUPO ");
$sheet->setCellValue("B14", "NOMBRE ASIGNATURA");
$sheet->setCellValue("C14", "NOMBRE DEL EJE");
$sheet->setCellValue("D14", "SUMA DE\nCALIFICACIONES");
$sheet->setCellValue("E14", "PROMEDIO DE\nCALIFICACIONES");
$sheet->setCellValue("F14", "TOTAL DE ESTUDIANTES\nEVALUADOS POR ASIGNATURA");
$sheet->setCellValue("G14", "APROBADOS POR ASIGNATURA");
$sheet->setCellValue("H14", "% DE\nAPROBACIÓN");
$sheet->setCellValue("I14", "REPROBADOS\nPOR ASIGNATURA");
$sheet->setCellValue("J14", "% DE\nREPROBACIÓN");

///////////////////////////////////////////////////////////////////

$sumatot = 0;
$promtot = 0;
$estuEvaltot = 0;
$filaAct = 14;
for ($i = 0; $i < sizeof($nvlFin); $i++) {
    $filaAct ++;
    $sheet->getStyle('D' . $filaAct . ':J' . $filaAct)->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A' . $filaAct . ':J' . $filaAct)->getAlignment()->setVertical('center');
    $sheet->getStyle('A' . $filaAct . ':J' . $filaAct)->getFont()->setSize(11);
    $sheet->getStyle('A' . $filaAct . ':J' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle('A' . $filaAct . ':J' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    if ($nvlFin[$i][4] < 70) {
        $sheet->getStyle('E' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFB0B0');
        $sheet->getStyle('E' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }
    if ($nvlFin[$i][9] > 30) {
        $sheet->getStyle('J' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFB0B0');
        $sheet->getStyle('J' . $filaAct)->getFont()->getColor()->setRGB('FF0000');
    }

    for ($j = 0; $j < sizeof($nvlFin[$i]); $j++) {

        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($celdas[$j] . '' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->setCellValue($celdas[$j] . '' . $filaAct, '' . $nvlFin[$i][$j] . (($j == 7 || $j == 9) ? '%' : ''));

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
}
$filaAct++;

$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getAlignment()->setHorizontal('center');
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getFont()->setBold(true)->setSize(11);
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('E' . $filaAct)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('D' . $filaAct . ':F' . $filaAct)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('BCBCBC');

$sheet->setCellValue($celdas[3] . '' . ($filaAct), $sumatot);
$sheet->setCellValue($celdas[4] . '' . ($filaAct), bcdiv($promtot / sizeof($nvlFin), 1, 2));
$sheet->setCellValue($celdas[5] . '' . ($filaAct), $estuEvaltot);

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


$sheet->setCellValue("B" . $filaAct, $infoFin[0]);
$sheet->setCellValue("C" . $filaAct, $infoFin[1]);
$sheet->setCellValue("D" . $filaAct, bcdiv($promtot / sizeof($nvlFin), 1, 2));
$sheet->setCellValue("E" . $filaAct, $infoFin[2]);
$sheet->setCellValue("F" . $filaAct, $infoFin[3] . '%');
$sheet->setCellValue("G" . $filaAct, $infoFin[4]);
$sheet->setCellValue("H" . $filaAct, $infoFin[5] . '%');

$nomArchiv = 'INDICADORES_FINALES_' . ($unPeri[0] == 1 ? 'ENE-JUN' : 'AGO-DIC') . '_' . $unPeri[1] . '_SISTEMAS_COMPUTACIONALES';
$fileName = $nomArchiv . ".xlsx";
# Crear un "escritor"
$writer = new Xlsx($spread);
# Le pasamos la ruta de guardado

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
$writer->save('php://output');
?>