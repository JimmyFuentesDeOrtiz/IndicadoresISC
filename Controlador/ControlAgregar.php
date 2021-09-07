<?php

include("../Config/Conexion.php");
$con = conectar();
$opGlobal = $_POST['opGlobal'];

switch ($opGlobal):

    case 1://Agregar grupo a parcial
        $clavGPar = $_POST['clavGParAdd'];
        $semestrePar = $_POST['semestreParAdd'];
        $asignaturaPar = $_POST['asignaturaParAdd'];
        $docentePar = $_POST['docenteParAdd'];
        $sumaPar = $_POST['sumaParAdd'];
        $evalPar = $_POST['evalParAdd'];
        $grupoPar = $_POST['grupoParAdd'];
        $aprobPar = $_POST['aprobParAdd'];
        $aprobU1Par = $_POST['aprobU1ParAdd'];
        $aprobU2Par = $_POST['aprobU2ParAdd'];
        $stmt = $con->prepare("call indicadores_isc.sp_addNivelDesempeño(?,?,?,?,?,?,?,?,?,?)");
        if ($aprobU2Par != '')
            $stmt->bind_param("sisiiiiiii", $clavGPar, $semestrePar, $asignaturaPar, $docentePar, $sumaPar, $evalPar, $grupoPar, $aprobPar, $aprobU1Par, $aprobU2Par);
        else {
            $aprobU2Par = -1;
            $stmt->bind_param("sisiiiiiii", $clavGPar, $semestrePar, $asignaturaPar, $docentePar, $sumaPar, $evalPar, $grupoPar, $aprobPar, $aprobU1Par, $aprobU2Par);
        }
        $aux = "Parcial";
        break;

    case 2://Admin Eje - Asignatura
        switch ($_POST['opEjeAsiAdd']) {

            case 1://Agregar Eje
                $nomEje = $_POST['nomEjeAdd'];
                $stmt = $con->prepare("call indicadores_isc.sp_addEje(?)");
                $stmt->bind_param("s", $nomEje);
                break;
            case 2://Agregar Asignatura
                $clavAsig = $_POST['clavAsigAdd'];
                $nombAsig = $_POST['nombAsigAdd'];
                $ejeAsi = $_POST['ejeAsiAdd'];
                $stmt = $con->prepare("call indicadores_isc.sp_addAsignatura(?,?,?)");
                $stmt->bind_param("ssi", $clavAsig, $nombAsig, $ejeAsi);
                break;
        }
        $aux = "EjeAsignaturas";
        break;

    case 3://Admin Periodos e Info
        switch ($_POST['opOtrosAdd']) {

            case 1://Agregar periodo semestral/parcial
                $anioSem = $_POST['anioSemAdd'];
                $periSem = $_POST['periSemAdd'];
                $parSem = $_POST['parSemAdd'];
                $matriSemAdd = $_POST['matriSemAdd'];
                $aproSemAdd = $_POST['aproSemAdd'];
                $stmt = $con->prepare("call indicadores_isc.sp_addSemestre(?,?,?,?,?)");
                $stmt->bind_param("iiiii", $periSem, $anioSem, $parSem, $matriSemAdd, $aproSemAdd);
                break;
            
            case 2://Agregar datos finales x eje
                $ejeInfoEje = $_POST['ejeInfoEjeAdd'];
                $semInfoEje = $_POST['semInfoEjeAdd'];
                $evalInfoEje = $_POST['evalInfoEjeAdd'];
                $aprobInfoEje = $_POST['aprobInfoEjeAdd'];
                $stmt = $con->prepare("call indicadores_isc.sp_addInfoEje(?,?,?,?)");
                $stmt->bind_param("iiii", $ejeInfoEje, $semInfoEje, $evalInfoEje, $aprobInfoEje);
                break;
            
            case 3://Agregar matricula
                $matriMat = $_POST['matriMatAdd'];
                $evalMat = $_POST['evalMatAdd'];
                $stmt = $con->prepare("call indicadores_isc.sp_addMatriInfo(?,?)");
                $stmt->bind_param("ii", $matriMat, $evalMat);
                break;
            
        }
        $aux = "PeriodosInfo";
        break;

    case 4://Agregar grupo a finales
        include("./Controlador.php");
        $clavGFin = $_POST['clavGFinAdd'];
        $asignaturaFin = $_POST['asignaturaFinAdd'];
        $anioFin = $_POST['anioFinAdd'];
        $periFin = $_POST['periFinAdd'];
        $sumaFin = $_POST['sumaFinAdd'];
        $promFin = $_POST['promFinAdd'];
        $evalFin = $_POST['evalFinAdd'];
        $aprobFin = $_POST['aprobFinAdd'];
        $matFin = getMatriToNewFinal($periFin, $anioFin);
        $stmt = $con->prepare("call indicadores_isc.sp_addNivelFinal(?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("siisidiiii", $clavGFin, $periFin, $anioFin, $asignaturaFin, $sumaFin, $promFin, $evalFin, $aprobFin, $matFin[0][0], $matFin[0][1]);
        $aux = "Final";
        break;

endswitch;
$stmt->execute();
$stmt->close();
header("Location: ../Admin" . $aux . ".php");
?>

