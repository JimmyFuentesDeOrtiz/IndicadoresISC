<?php
function conectar() {
    $mysqli_hostname = "127.0.0.1:3308";
    $mysqli_user = "root";
    $mysqli_password = "";
    $mysqli_database = "indicadores_isc";
    $bd = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("Could not connect database");
    mysqli_select_db($bd, $mysqli_database) or die("Could not select database");
    $bd->query("SET NAMES 'utf8'");
    return $bd;
}
?>