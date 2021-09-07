<?php
include('./headAdmin.php');
$infoSem = getSemestreAdmin();
$asigA = getAsignaturaAdmin();
$doceA = getDocenteAdmin();

$lvlFinA = getNivelFinalAdmin();
$pagina3 = 'active';
include('AdminSidebar.php');
?>
<div class="admon">
    <div class="container">
        <h2>Indicadores Finales</h2>
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
                    <th>Calificaciones</th>
                    <th>Grupo</th>
                    <th><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalAddFin"><i class="bi bi-plus-circle"></i></button>
                        <div class="modal" id="myModalAddFin">
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
                                                <label for="clavGFinAdd" style="color:black;">Clave de grupo:</label>
                                                <input type="text" class="form-control" id="clavGFinAdd" placeholder="Ingresa la clave de grupo" name="clavGFinAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asignaturaFinAdd" style="color:black;">Asignatura:</label>
                                                <select id="asignaturaFinAdd" name="asignaturaFinAdd" class="custom-select mb-3 form-control" required>
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
                                                <label for="clavGFinAdd" style="color:black;">Año:</label>
                                                <input type="text" class="form-control" id="anioFinAdd" placeholder="Ingresa el año" name="anioFinAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="periFinAdd" style="color:black;">Periodo:</label>
                                                <select id="periFinAdd" name="periFinAdd" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>
                                                    <option value="1">Enero - Junio</option>
                                                    <option value="2">Agosto - Diciembre</option>
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Suma</span>
                                                </div>
                                                <input type="text" class="form-control" id="sumaFinAdd" placeholder="Suma de calificaciones" name="sumaFinAdd" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Promedio</span>
                                                </div>
                                                <input type="text" class="form-control" id="promFinAdd" placeholder="Promedio asignatura" name="promFinAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Evaluados</span>
                                                </div>
                                                <input type="text" class="form-control" id="evalFinAdd" placeholder="Total evaluados" name="evalFinAdd" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aprobados</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobFinAdd" placeholder="Aprobados por parcial" name="aprobFinAdd" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="4">
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
                for ($i = 0; $i < sizeof($lvlFinA); $i++) {
                    echo '
                        <tr>
                            <td>Periodo: ' . (($lvlFinA[$i][6])==1?'ENE-JUN':'AGO-DIC') . '<br>
                            Año: ' . $lvlFinA[$i][7] . '</td>
                                
                            <td>Suma: ' . $lvlFinA[$i][2] . '<br>
                            Evaluados: ' . $lvlFinA[$i][4] . '<br>
                            Promedio: ' . $lvlFinA[$i][3] . '</td>
                                
                            <td>Grupo: ' . $lvlFinA[$i][0] . '<br>
                            Asignatura: ' . $lvlFinA[$i][1] . '</td>
                            <td> 
                            <div class="btn-group">
                                <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#myModalFin" onclick="datosModalFin(\'' . $lvlFinA[$i][0] . '\', \'' . $lvlFinA[$i][2] . '\', \'' . $lvlFinA[$i][3] . '\', \'' . $lvlFinA[$i][4] . '\', \'' . $lvlFinA[$i][5] . '\', \'' . $lvlFinA[$i][6] . '\', \'' . $lvlFinA[$i][7] . '\', \'' . $lvlFinA[$i][8] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=4*' . $lvlFinA[$i][0] . '*' . $lvlFinA[$i][6] . '*' . $lvlFinA[$i][7] . '"><i class="bi bi-trash-fill"></i>Eliminar</a>    
                                </div>
                            </div>
                        <!-- The Modal -->
                        <div class="modal" id="myModalFin">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header-->
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="color:darkslategrey;">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate action="Controlador/ControlEditar.php" method="POST">
                                            <div class="form-group">
                                                <label for="clavGFin" style="color:black;">Clave de grupo:</label>
                                                <input type="text" class="form-control" id="clavGFin" placeholder="Ingresa la clave de grupo" name="clavGFin" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asignaturaFin" style="color:black;">Asignatura:</label>
                                                <select id="asignaturaFin" name="asignaturaFin" class="custom-select mb-3 form-control" required>
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
                                                <label for="anioFin" style="color:black;">Año:</label>
                                                <input type="text" class="form-control" id="anioFin" placeholder="Ingresa el año" name="anioFin" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="periFin" style="color:black;">Periodo:</label>
                                                <select id="periFin" name="periFin" class="custom-select mb-3 form-control" required>
                                                    <option selected>-Selecciona-</option>
                                                    <option value="1">Enero - Junio</option>
                                                    <option value="2">Agosto - Diciembre</option>
                                                </select>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Suma</span>
                                                </div>
                                                <input type="text" class="form-control" id="sumaFin" placeholder="Suma de calificaciones" name="sumaFin" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Promedio</span>
                                                </div>
                                                <input type="text" class="form-control" id="promFin" placeholder="Promedio asignatura" name="promFin" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Evaluados</span>
                                                </div>
                                                <input type="text" class="form-control" id="evalFin" placeholder="Total evaluados" name="evalFin" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aprobados</span>
                                                </div>
                                                <input type="text" class="form-control" id="aprobFin" placeholder="Aprobados por parcial" name="aprobFin" required>
                                                <div class="valid-feedback">Valido.</div>
                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="claveOriFin" name="claveOriFin">
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="perOriFin" name="perOriFin">
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="anioOriFin" name="anioOriFin">
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="4">
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
<script type="text/javascript" src="js/editarFinal.js"></script>
<script type="text/javascript" src="js/buscadorTablas.js?1.0.0"></script>
</body>

</html>