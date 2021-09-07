<?php

include("./Config/Conexion.php");
$con = conectar();
if (!$con) {
    die("no se pudo conectar");
}

function getPeriodo() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getPeriodo();");
    $stmt->execute();
    $stmt->bind_result($periodo, $año, $parcial, $idsem);
    $i = 0;
    while ($stmt->fetch()) {
        $peri[$i][0] = $periodo;
        $peri[$i][1] = $año;
        $peri[$i][2] = $parcial;
        $peri[$i][3] = $idsem;
        $i++;
    }
    $stmt->close();
    return $peri;
}

function getUnPeriodo($per, $anio) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getUnPeriodo(?, ?);");
    $stmt->bind_param("ii", $per, $anio);
    $stmt->execute();
    $stmt->bind_result($periodo, $año, $parcial, $idsem);
    $i = 0;
    while ($stmt->fetch()) {
        $unPeri[0] = $periodo;
        $unPeri[1] = $año;
        $unPeri[2] = $parcial;
        $unPeri[3] = $idsem;
        $i++;
    }
    $stmt->close();
    return $unPeri;
}

function getNivelParcial($op, $per, $anio, $par) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNivelParcial(?, ?, ?, ?);");
    $stmt->bind_param("iiii", $op, $per, $anio, $par);
    $stmt->execute();
    $stmt->bind_result($claveGrupo, $asignatura, $eje, $docente, $sumCalif, $promedio, $totalEstEval, $totalGroup, $aprobadosXParcial, $porcentajeAprob, $reprobadosXParcial, $porcentajeReprob, $aprobadosU1, $reprobadosU1, $aprobadosU2, $reprobadosU2);
    $i = 0;
    $nvlPar [0][0]=0;
    while ($stmt->fetch()) {
        $nvlPar[$i][0] = $claveGrupo;
        $nvlPar[$i][1] = $asignatura;
        $nvlPar[$i][2] = $eje;
        $nvlPar[$i][3] = $docente;
        $nvlPar[$i][4] = $sumCalif;
        $nvlPar[$i][5] = bcdiv($promedio, 1, 2);
        $nvlPar[$i][6] = $totalEstEval;
        $nvlPar[$i][7] = $totalGroup;
        $nvlPar[$i][8] = $aprobadosXParcial;
        $nvlPar[$i][9] = bcdiv($porcentajeAprob, 1, 2);
        $nvlPar[$i][10] = $reprobadosXParcial;
        $nvlPar[$i][11] = bcdiv($porcentajeReprob, 1, 2);
        $nvlPar[$i][12] = $aprobadosU1;
        $nvlPar[$i][13] = '';
        $nvlPar[$i][13] = $aprobadosU2;
        $nvlPar[$i][14] = $reprobadosU1;
        $nvlPar[$i][15] = '';
        $nvlPar[$i][15] = $reprobadosU2;
        $i++;
    }
    $stmt->close();
    return $nvlPar;
}

function getInfoParcial($per, $anio, $par) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getInfoParcial(?, ?, ?);");
    $stmt->bind_param("iii", $per, $anio, $par);
    $stmt->execute();
    $stmt->bind_result($matricula, $matriculaEval, $aprobados, $porcentajeAprob, $reprobados, $porcentajeReprob);
    $i = 0;
    while ($stmt->fetch()) {
        $infoPeri[0] = $matricula;
        $infoPeri[1] = $matriculaEval;
        $infoPeri[2] = $aprobados;
        $infoPeri[3] = bcdiv($porcentajeAprob, 1, 2);
        $infoPeri[4] = $reprobados;
        $infoPeri[5] = bcdiv($porcentajeReprob, 1, 2);
        $i++;
    }
    $stmt->close();
    return $infoPeri;
}

function getNumParcialSem($per, $anio) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNumParcialSem(?, ?);");
    $stmt->bind_param("ii", $per, $anio);
    $stmt->execute();
    $stmt->bind_result($parcial);
    $i = 0;
    while ($stmt->fetch()) {
        $noPar[$i] = $parcial;
        $i++;
    }
    $stmt->close();
    return $noPar;
}

function getInfoAreas($per, $anio, $par) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getInfoAreas(?, ?, ?);");
    $stmt->bind_param("iii", $per, $anio, $par);
    $stmt->execute();
    $stmt->bind_result($Nombre, $estEval, $aprobados, $porArob, $reprobados, $porRerob);
    $i = 0;
    $infoAr [0][0]=0;
    while ($stmt->fetch()) {
        $infoAr[$i][0] = $Nombre;
        $infoAr[$i][1] = $estEval;
        $infoAr[$i][2] = $aprobados;
        $infoAr[$i][3] = $porArob;
        $infoAr[$i][4] = $reprobados;
        $infoAr[$i][5] = $porRerob;
        $i++;
    }
    $stmt->close();
    return $infoAr;
}

function getNumFinales() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNumFinales();");
    $stmt->execute();
    $stmt->bind_result($periodoF, $año);
    $i = 0;
    while ($stmt->fetch()) {
        $numFinal[$i][0] = $periodoF;
        $numFinal[$i][1] = $año;
        $i++;
    }
    $stmt->close();
    return $numFinal;
}

function getNivelFinal($per, $anio) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNivelFinal(?, ?);");
    $stmt->bind_param("ii", $per, $anio);
    $stmt->execute();
    $stmt->bind_result($grupo, $asig, $eje, $sumCalif, $prom, $totEstu, $aprob, $porAp, $reprob, $porReprob);
    $i = 0;
    while ($stmt->fetch()) {
        $lvlFin[$i][0] = $grupo;
        $lvlFin[$i][1] = $asig;
        $lvlFin[$i][2] = $eje;
        $lvlFin[$i][3] = $sumCalif;
        $lvlFin[$i][4] = $prom;
        $lvlFin[$i][5] = $totEstu;
        $lvlFin[$i][6] = $aprob;
        $lvlFin[$i][7] = bcdiv($porAp, 1, 2);
        $lvlFin[$i][8] = $reprob;
        $lvlFin[$i][9] = bcdiv($porReprob, 1, 2);
        $i++;
    }
    $stmt->close();
    return $lvlFin;
}

function getInfoFinal($per, $anio) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getInfoFinal(?, ?);");
    $stmt->bind_param("ii", $per, $anio);
    $stmt->execute();
    $stmt->bind_result($matricula, $matriculaEval, $aprobTotal, $porcentajeAprob, $reprobados, $porcentajeReprob);
    $i = 0;
    $infoFin[0] = 0;
    while ($stmt->fetch()) {
        $infoFin[0] = $matricula;
        $infoFin[1] = $matriculaEval;
        $infoFin[2] = $aprobTotal;
        $infoFin[3] = bcdiv($porcentajeAprob, 1, 2);
        $infoFin[4] = $reprobados;
        $infoFin[5] = bcdiv($porcentajeReprob, 1, 2);
        $i++;
    }
    $stmt->close();
    return $infoFin;
}

function getNivelParcialAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNivelParcialAdmin();");
    $stmt->execute();
    $stmt->bind_result($claveGrupo, $claveAsig, $asignatura, $AS_Area, $eje, $docente, $docenteN, $sumCalif, $totalEstEval, $totalGroup, $aprobadosXParcial, $aprobadosU1, $aprobadosU2, $semestre, $periodo, $año, $parcial);
    $i = 0;
    while ($stmt->fetch()) {
        $nvlParA[$i][0] = $claveGrupo;
        $nvlParA[$i][1] = $claveAsig;
        $nvlParA[$i][2] = $asignatura;
        $nvlParA[$i][3] = $AS_Area;
        $nvlParA[$i][4] = $eje;
        $nvlParA[$i][5] = $docente;
        $nvlParA[$i][6] = $docenteN;
        $nvlParA[$i][7] = $sumCalif;
        $nvlParA[$i][8] = $totalEstEval;
        $nvlParA[$i][9] = $totalGroup;
        $nvlParA[$i][10] = $aprobadosXParcial;
        $nvlParA[$i][11] = $aprobadosU1;
        $nvlParA[$i][12] = $aprobadosU2;
        $nvlParA[$i][13] = $semestre;
        $nvlParA[$i][14] = $periodo;
        $nvlParA[$i][15] = $año;
        $nvlParA[$i][16] = $parcial;
        $i++;
    }
    $stmt->close();
    return $nvlParA;
}

function getSemestreAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getSemestreAdmin();");
    $stmt->execute();
    $stmt->bind_result($idsem, $periodo, $año, $parcial, $matric, $aprobados);
    $i = 0;
    while ($stmt->fetch()) {
        $infoSem[$i][0] = $idsem;
        $infoSem[$i][1] = $periodo;
        $infoSem[$i][2] = $año;
        $infoSem[$i][3] = $parcial;
        $infoSem[$i][4] = $matric;
        $infoSem[$i][5] = $aprobados;
        $i++;
    }
    $stmt->close();
    return $infoSem;
}

function getAsignaturaAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getAsignaturaAdmin();");
    $stmt->execute();
    $stmt->bind_result($AS_ClaveAsignatura, $AS_NombreAsignatura, $AS_Area, $Nombre);
    $i = 0;
    while ($stmt->fetch()) {
        $asigA[$i][0] = $AS_ClaveAsignatura;
        $asigA[$i][1] = $AS_NombreAsignatura;
        $asigA[$i][2] = $AS_Area;
        $asigA[$i][3] = $Nombre;
        $i++;
    }
    $stmt->close();
    return $asigA;
}

function getDocenteAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getDocenteAdmin();");
    $stmt->execute();
    $stmt->bind_result($iddocente, $GradoAcademico, $Nombre, $APaterno, $AMaterno, $correo);
    $i = 0;
    while ($stmt->fetch()) {
        $doceA[$i][0] = $iddocente;
        $doceA[$i][1] = $GradoAcademico;
        $doceA[$i][2] = $Nombre;
        $doceA[$i][3] = $APaterno;
        $doceA[$i][4] = $AMaterno;
        $doceA[$i][5] = $correo;
        $i++;
    }
    $stmt->close();
    return $doceA;
}

function getEjesAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getEjesAdmin();");
    $stmt->execute();
    $stmt->bind_result($idareaConocimiento, $Nombre);
    $i = 0;
    while ($stmt->fetch()) {
        $ejeA[$i][0] = $idareaConocimiento;
        $ejeA[$i][1] = $Nombre;
        $i++;
    }
    $stmt->close();
    return $ejeA;
}

function getNivelFinalAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getNivelFinalAdmin();");
    $stmt->execute();
    $stmt->bind_result($grupo, $asig, $sumCalif, $prom, $totEstu, $aprob, $periodoF, $año, $asigF);
    $i = 0;
    while ($stmt->fetch()) {
        $lvlFinA[$i][0] = $grupo;
        $lvlFinA[$i][1] = $asig;
        $lvlFinA[$i][2] = $sumCalif;
        $lvlFinA[$i][3] = $prom;
        $lvlFinA[$i][4] = $totEstu;
        $lvlFinA[$i][5] = $aprob;
        $lvlFinA[$i][6] = $periodoF;
        $lvlFinA[$i][7] = $año;
        $lvlFinA[$i][8] = $asigF;
        $i++;
    }
    $stmt->close();
    return $lvlFinA;
}

function getMatriInfo() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getMatriInfo();");
    $stmt->execute();
    $stmt->bind_result($idMatriculaInfo, $matricula, $matriculaEval);
    $i = 0;
    while ($stmt->fetch()) {
        $matInfo[$i][0] = $idMatriculaInfo;
        $matInfo[$i][1] = $matricula;
        $matInfo[$i][2] = $matriculaEval;
        $i++;
    }
    $stmt->close();
    return $matInfo;
}

function getInfoEjeAdmin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getInfoEjeAdmin();");
    $stmt->execute();
    $stmt->bind_result($Nombre, $estEval, $aprobados, $idinfoeje, $periodo, $periodoS, $año, $parcial);
    $i = 0;
    while ($stmt->fetch()) {
        $infoEjeA[$i][0] = $Nombre;
        $infoEjeA[$i][1] = $estEval;
        $infoEjeA[$i][2] = $aprobados;
        $infoEjeA[$i][3] = $idinfoeje;
        $infoEjeA[$i][4] = $periodo;
        $infoEjeA[$i][5] = $periodoS;
        $infoEjeA[$i][6] = $año;
        $infoEjeA[$i][7] = $parcial;
        $i++;
    }
    $stmt->close();
    return $infoEjeA;
}

function getListaPerFin() {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getListaPerFin();");
    $stmt->execute();
    $stmt->bind_result($periodoF, $año, $aprobTotal, $matricula, $matriculaN, $matriculaEval);
    $i = 0;
    while ($stmt->fetch()) {
        $listPFin[$i][0] = $periodoF;
        $listPFin[$i][1] = $año;
        $listPFin[$i][2] = $aprobTotal;
        $listPFin[$i][3] = '';
        $listPFin[$i][3] = $matricula;
        if ($listPFin[$i][3] != '') {
            $listPFin[$i][4] = $matriculaN;
            $listPFin[$i][5] = $matriculaEval;
        } else {
            $listPFin[$i][4] = '';
            $listPFin[$i][5] = '';
        }
        $i++;
    }
    $stmt->close();
    return $listPFin;
}

function getListaFinalCambiar($anio, $peri) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getListaFinalCambiar(?,?);");
    $stmt->bind_param("ii", $anio, $peri);
    $stmt->execute();
    $stmt->bind_result($grupo);
    $i = 0;
    while ($stmt->fetch()) {
        $grupoFin[$i] = '';
        $grupoFin[$i] = $grupo;
        $i++;
    }
    $stmt->close();
    return $grupoFin;
}

function getMatriToNewFinal($peri, $anio) {
    global $con;
    $stmt = $con->prepare("call indicadores_isc.sp_getMatriToNewFinal(?,?);");
    $stmt->bind_param("ii", $peri, $anio);
    $stmt->execute();
    $stmt->bind_result($aprobTotal, $matricula);
    $i = 0;
    while ($stmt->fetch()) {
        $matFin[$i][0] = -1;
        $matFin[$i][0] = $aprobTotal;
        $matFin[$i][1] = -1;
        $matFin[$i][1] = $matricula;
        $i++;
    }
    $stmt->close();
    return $matFin;
}
