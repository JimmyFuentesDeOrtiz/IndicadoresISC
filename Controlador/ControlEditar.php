<?php

include("../Config/Conexion.php");
$con = conectar();

$opGlobal = $_POST['opGlobal'];

switch ($opGlobal):
    case 1://Editar parcial de grupo
        $clavGPar = $_POST['clavGPar'];
        $semestrePar = $_POST['semestrePar'];
        $clavOriPar = $_POST['clavOriPar'];
        $semOriPar = $_POST['semOriPar'];
        $asignaturaPar = $_POST['asignaturaPar'];
        $docentePar = $_POST['docentePar'];
        $sumaPar = $_POST['sumaPar'];
        $evalPar = $_POST['evalPar'];
        $grupoPar = $_POST['grupoPar'];
        $aprobPar = $_POST['aprobPar'];
        $aprobU1Par = $_POST['aprobU1Par'];
        $aprobU2Par = $_POST['aprobU2Par'];
        $stmt = $con->prepare("call indicadores_isc.sp_editNivelDesempeño(?,?,?,?,?,?,?,?,?,?,?,?)");
        if ($aprobU2Par != '')
            $stmt->bind_param("ssiisiiiiiii", $clavGPar, $clavOriPar, $semestrePar, $semOriPar, $asignaturaPar, $docentePar, $sumaPar, $evalPar, $grupoPar, $aprobPar, $aprobU1Par, $aprobU2Par);
        else {
            $aprobU2Par = -1;
            $stmt->bind_param("ssiisiiiiiii", $clavGPar, $clavOriPar, $semestrePar, $semOriPar, $asignaturaPar, $docentePar, $sumaPar, $evalPar, $grupoPar, $aprobPar, $aprobU1Par, $aprobU2Par);
        }$aux = "Parcial";
        break;

    case 2://Admin Eje - Asignatura
        switch ($_POST['opEjeAsi']) {

            case 1://Editar Eje
                $idEje = $_POST['idEje'];
                $nomEje = $_POST['nomEje'];
                $stmt = $con->prepare("call indicadores_isc.sp_editEje(?,?)");
                $stmt->bind_param("is", $idEje, $nomEje);
                break;
            case 2://Editar Asignatura
                $clavAsig = $_POST['clavAsig'];
                $clavOriAsig = $_POST['clavOriAsig'];
                $nombAsig = $_POST['nombAsig'];
                $ejeAsi = $_POST['ejeAsi'];
                $stmt = $con->prepare("call indicadores_isc.sp_editAsignatura(?,?,?,?)");
                $stmt->bind_param("sssi", $clavAsig, $clavOriAsig, $nombAsig, $ejeAsi);
                break;
        }
        $aux = "EjeAsignaturas";
        break;

    case 3://Admin Periodos e Info
        switch ($_POST['opOtros']) {

            case 1://Editar periodo semestral/parcial
                $idSem = $_POST['idSem'];
                $anioSem = $_POST['anioSem'];
                $periSem = $_POST['periSem'];
                $parSem = $_POST['parSem'];
                $matriSemAdd = $_POST['matriSem'];
                $aproSemAdd = $_POST['aproSem'];
                $stmt = $con->prepare("call indicadores_isc.sp_editSemestre(?,?,?,?,?,?)");
                $stmt->bind_param("iiiiii", $idSem, $periSem, $anioSem, $parSem, $matriSemAdd, $aproSemAdd);
                break;

            case 2://Editar datos finales x eje
                $ejeInfoEje = $_POST['ejeInfoEje'];
                $semInfoEje = $_POST['semInfoEje'];
                $evalInfoEje = $_POST['evalInfoEje'];
                $aprobInfoEje = $_POST['aprobInfoEje'];
                $ejeOriEje = $_POST['ejeOriEje'];
                $periOriEje = $_POST['periOriEje'];
                $stmt = $con->prepare("call indicadores_isc.sp_editInfoEje(?,?,?,?,?,?)");
                $stmt->bind_param("iiiiii", $ejeInfoEje, $ejeOriEje, $semInfoEje, $periOriEje, $evalInfoEje, $aprobInfoEje);
                break;

            case 3://Editar matricula
                $idMat = $_POST['idMat'];
                $matriMat = $_POST['matriMat'];
                $evalMat = $_POST['evalMat'];
                $stmt = $con->prepare("call indicadores_isc.sp_editMatriInfo(?,?,?)");
                $stmt->bind_param("iii", $idMat, $matriMat, $evalMat);
                break;

            case 4://Editar informacion finales
                include("./Controlador.php");
                $perFin = $_POST['perFin'];
                $anioFin = $_POST['anioFin'];
                $aprobInfFin = $_POST['aprobInfFin'];
                $matriFin = $_POST['matriFin'];
                $grupoFin = getListaFinalCambiar($anioFin, $perFin);
                for ($i = 0; $i < (sizeof($grupoFin) - 1); $i++) {
                    $stmt = $con->prepare("call indicadores_isc.sp_editInfoFinal(?,?,?,?,?)");
                    $stmt->bind_param("siiii", $grupoFin[$i], $perFin, $anioFin, $aprobInfFin, $matriFin);
                    $stmt->execute();
                    $stmt->close();
                }
                $stmt = $con->prepare("call indicadores_isc.sp_editInfoFinal(?,?,?,?,?)");
                $stmt->bind_param("siiii", $grupoFin[(sizeof($grupoFin) - 1)], $perFin, $anioFin, $aprobInfFin, $matriFin);
                break;
        }
        $aux = "PeriodosInfo";
        break;

    case 4://Editar grupo finales
        $clavGFin = $_POST['clavGFin'];
        $asignaturaFin = $_POST['asignaturaFin'];
        $anioFin = $_POST['anioFin'];
        $periFin = $_POST['periFin'];
        $sumaFin = $_POST['sumaFin'];
        $promFin = $_POST['promFin'];
        $evalFin = $_POST['evalFin'];
        $aprobFin = $_POST['aprobFin'];
        $claveOriFin = $_POST['claveOriFin'];
        $perOriFin = $_POST['perOriFin'];
        $anioOriFin = $_POST['anioOriFin'];
        $stmt = $con->prepare("call indicadores_isc.sp_editNivelFinal(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssiiiisidii", $clavGFin, $claveOriFin, $periFin, $perOriFin, $anioFin, $anioOriFin, $asignaturaFin, $sumaFin, $promFin, $evalFin, $aprobFin);
        $aux = "Final";
        break;

endswitch;
$stmt->execute();
$stmt->close();
header("Location: ../Admin" . $aux . ".php");
?>

