<?php
include('./headAdmin.php');
$nvlParA = getNivelParcialAdmin();
$infoSem = getSemestreAdmin();
$asigA = getAsignaturaAdmin();
$doceA = getDocenteAdmin();
$pagina0 = 'active';
include('AdminSidebar.php');
?>
<div class="admon">
    <div class="container">
        <h2>Parcial de grupos</h2>
        <div class="sec-buscador">
            <div class="columna">
                <h4>Buscar por contenido</h4>
            </div>
            <div class="columna"><input class="form-control" id="myInput" type="text" placeholder="Ej. 'Asignatura: Calculo Integral'... "></div>
        </div>
        <br>
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th>Semestre</th>
                    <th>Evaluados</th>
                    <th>Grupo</th>
                    <th><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal1AddPar"><i class="bi bi-plus-circle"></i></button>
                        <div class="modal" id="myModal1AddPar">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header-->
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:darkslategrey;">Agregar</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate action="Controlador/ControlAgregar.php" method="POST">
                                            <div class="form-group">
                                                <label for="clavGParAdd" style="color:black;">Clave de grupo:</label>
                                                <input type="text" class="form-control" id="clavGParAdd" placeholder="Ingresa la clave de grupo" name="clavGParAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="semestreParAdd" style="color:black;">Periodo:</label>
                                                <select id="semestreParAdd" name="semestreParAdd" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($infoSem); $i++) {
                                                        echo '<option value="' . $infoSem[$i][0] . '">' . $infoSem[$i][2] . ' ' . (($infoSem[$i][1] == 1) ? 'ENE - JUN' : 'AGO - DIC') . (($infoSem[$i][3]) == 1 ? ' 1er.' : (($infoSem[$i][3]) == 2 ? ' 2do.' : ' 3er.')) . 'Parcial</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asignaturaParAdd" style="color:black;">Asignatura:</label>
                                                <select id="asignaturaParAdd" name="asignaturaParAdd" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($asigA); $i++) {
                                                        echo '<option value="' . $asigA[$i][0] . '">' . $asigA[$i][1] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="docenteParAdd" style="color:black;">Docente:</label>
                                                <select id="docenteParAdd" name="docenteParAdd" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>
                                                    <?php
                                                    for ($i = 0; $i < sizeof($doceA); $i++) {
                                                        echo '<option value="' . $doceA[$i][0] . '">' . $doceA[$i][2] . ' ' . $doceA[$i][3] . ' ' . $doceA[$i][4] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Suma</span>
                                                </div>
                                                <input type="text" class="form-control" id="sumaParAdd" placeholder="Suma de Calificaciones" name="sumaParAdd" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Evaluados</span>
                                                </div>
                                                <input type="text" class="form-control" id="evalParAdd" placeholder="Total Evaluados" name="evalParAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Grupo</span>
                                                </div>
                                                <input type="text" class="form-control" id="grupoParAdd" placeholder="Tamaño de Grupo" name="grupoParAdd" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aprobados</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobParAdd" placeholder="Aprobados por parcial" name="aprobParAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">U1</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobU1ParAdd" placeholder="Aprobados U1" name="aprobU1ParAdd" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">U2</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobU2ParAdd" placeholder="Aprobados U2" name="aprobU2ParAdd">
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="1">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                for ($i = 0; $i < sizeof($nvlParA); $i++) {
                    echo '
                        <tr>
                            <td>Periodo: ' . (($nvlParA[$i][14]==1)?'ENE-JUN':'AGO-DIC') . '<br>
                            Año: ' . $nvlParA[$i][15] . '<br>
                            Parcial: ' . $nvlParA[$i][16] . '</td>
                            <td>Evaluados: ' . $nvlParA[$i][8] . '<br>
                            Grupo: ' . $nvlParA[$i][9] . '<br>
                            Aprobados: ' . $nvlParA[$i][10] . '</td>
                            <td>Grupo: ' . $nvlParA[$i][0] . '<br>
                            Asignatura: ' . $nvlParA[$i][2] . '<br>
                            Eje: ' . $nvlParA[$i][4] . '</td>';
                    echo '<td> 
                            <div class="btn-group">
                                <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#myModal1Par" onclick="datosModalPar(\'' . $nvlParA[$i][0] . '\', \'' . $nvlParA[$i][1] . '\', \'' . $nvlParA[$i][5] . '\', \'' . $nvlParA[$i][7] . '\', \'' . $nvlParA[$i][8] . '\', \'' . $nvlParA[$i][9] . '\', \'' . $nvlParA[$i][10] . '\', \'' . $nvlParA[$i][11] . '\', \'' . $nvlParA[$i][12] . '\', \'' . $nvlParA[$i][13] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=1*' . $nvlParA[$i][0] . '*' . $nvlParA[$i][13] . '"><i class="bi bi-trash-fill"></i>Eliminar</a>    
                                </div>
                            </div>
                        <!-- The Modal -->
                        <div class="modal" id="myModal1Par">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header-->
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:darkslategrey;">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate action="Controlador/ControlEditar.php" enctype="multipart/form-data" method="POST">
                                            <div class="form-group">
                                                <label for="clavGPar" style="color:black;">Clave de grupo:</label>
                                                <input type="text" class="form-control" id="clavGPar" placeholder="Ingresa la clave de grupo" name="clavGPar" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="semestrePar" style="color:black;">Periodo:</label>
                                                <select id="semestrePar" name="semestrePar" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>';
                                                    for ($j = 0; $j < sizeof($infoSem); $j++) {
                                                        echo '<option value="' . $infoSem[$j][0] . '">' . $infoSem[$j][2] . ' ' . (($infoSem[$j][1] == 1) ? 'ENE - JUN' : 'AGO - DIC') . (($infoSem[$j][3]) == 1 ? ' 1er.' : (($infoSem[$j][3]) == 2 ? ' 2do.' : ' 3er.')) . 'Parcial</option>';
                                                    }
                                                echo '
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asignaturaPar" style="color:black;">Asignatura:</label>
                                                <select id="asignaturaPar" name="asignaturaPar" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>';
                                                    for ($j = 0; $j < sizeof($asigA); $j++) {
                                                        echo '<option value="' . $asigA[$j][0] . '">' . $asigA[$j][1] . '</option>';
                                                    }
                                                    echo '
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="docentePar" style="color:black;">Docente:</label>
                                                <select id="docentePar" name="docentePar" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>';
                                                    for ($j = 0; $j < sizeof($doceA); $j++) {
                                                        echo '<option value="' . $doceA[$j][0] . '">' . $doceA[$j][2] . ' ' . $doceA[$j][3] . ' ' . $doceA[$j][4] . '</option>';
                                                    }
                                                    echo '
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Suma</span>
                                                </div>
                                                <input type="text" class="form-control" id="sumaPar" placeholder="Suma de Calificaciones" name="sumaPar" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Evaluados</span>
                                                </div>
                                                <input type="text" class="form-control" id="evalPar" placeholder="Total Evaluados" name="evalPar" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Grupo</span>
                                                </div>
                                                <input type="text" class="form-control" id="grupoPar" placeholder="Tamaño de Grupo" name="grupoPar" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aprobados</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobPar" placeholder="Aprobados por parcial" name="aprobPar" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">U1</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobU1Par" placeholder="Aprobados U1" name="aprobU1Par" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">U2</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobU2Par" placeholder="Aprobados U2" name="aprobU2Par">
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="clavOriPar" name="clavOriPar" value="1">
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="semOriPar" name="semOriPar" value="1">
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="1">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('AdminFooter.php') ?>
<!--JS Local-->
<script type="text/javascript" src="js/editarParcial.js"></script>
<script type="text/javascript" src="js/buscadorTablas.js?1.0.0"></script>
</body>

</html>