<?php

include("../Config/Conexion.php");
$con = conectar();
$id = $_GET["id"];
$datos = explode('*', $id);

switch ($datos[0]):
    case 1: // Borrar un parcial de un grupo
        $stmt = $con->prepare("call indicadores_isc.sp_deleteGrupoParcial(?,?)");
        $stmt->bind_param("si", $datos[1], $datos[2]);
        $aux = "Parcial";
        break;

    case 2://Admin Eje - Asignatura
        switch ($datos[2]) {

            case 1://Borrar Eje
                $stmt = $con->prepare("call indicadores_isc.sp_deleteEje(?)");
                $stmt->bind_param("i", $datos[1]);
                break;
            case 2://Borrar Asignatura
                $stmt = $con->prepare("call indicadores_isc.sp_deleteAsignatura(?)");
                $stmt->bind_param("s", $datos[1]);
                break;
        }
        $aux = "EjeAsignaturas";
        break;

    case 3://Admin Periodos e Info
        switch ($datos[1]) {

            case 1://Borrar periodo semestral/parcial
                $stmt = $con->prepare("call indicadores_isc.sp_deleteSemestre(?)");
                $stmt->bind_param("i", $datos[2]);
                break;

            case 2://Borrar datos finales x eje
                $stmt = $con->prepare("call indicadores_isc.sp_deleteInfoEje(?,?)");
                $stmt->bind_param("ii", $datos[2], $datos[3]);
                break;

            case 3://Borrar matricula
                $stmt = $con->prepare("call indicadores_isc.sp_deleteMatriInfo(?)");
                $stmt->bind_param("i", $datos[2]);
                break;
            case 4://Borrar info Final
                include("./Controlador.php");
                $grupoFin = getListaFinalCambiar($datos[2], $datos[3]);
                for ($i = 0; $i < (sizeof($grupoFin) - 1); $i++) {
                    $stmt = $con->prepare("call indicadores_isc.sp_deleteInfoFinal(?,?,?)");
                    $stmt->bind_param("sii", $grupoFin[$i], $datos[3], $datos[2]);
                    $stmt->execute();
                    $stmt->close();
                }
                $stmt = $con->prepare("call indicadores_isc.sp_deleteInfoFinal(?,?,?)");
                $stmt->bind_param("sii", $grupoFin[(sizeof($grupoFin) - 1)], $datos[3], $datos[2]);
                break;
        }
        $aux = "PeriodosInfo";
        break;

    case 4: // Borrar un grupo final
        $stmt = $con->prepare("call indicadores_isc.sp_deleteNivelFinal(?,?,?)");
        $stmt->bind_param("sii", $datos[1], $datos[2], $datos[3]);
        $aux = "Final";
        break;
endswitch;
$stmt->execute();
$stmt->close();
header("Location: ../Admin" . $aux . ".php");
?>
