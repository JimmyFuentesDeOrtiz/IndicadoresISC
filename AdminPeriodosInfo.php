<?php
include('./headAdmin.php');
$semestreA = getSemestreAdmin();
$matriInfo = getMatriInfo();
$infoEjeA = getInfoEjeAdmin();
$ejeA = getEjesAdmin();
$listaPFin = getListaPerFin();
$pagina2 = 'active';
include('AdminSidebar.php');
?>
<div class="admon">
    <div class="container">
        <h2>Periodos</h2>
        <!--Tabla de especialidad: Sección 1-->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'tab1')" id="defaultOpen"><i class="bi bi-calendar-check"></i>Periodos/Parciales</button>
            <button class="tablinks" onclick="openCity(event, 'tab2')"><i class="bi bi-bar-chart-steps"></i>Datos finales eje</button>
            <button class="tablinks" onclick="openCity(event, 'tab3')"><i class="bi bi-info-circle"></i>Informacion extra finales</button>
            <button class="tablinks" onclick="openCity(event, 'tab4')"><i class="bi bi-people-fill"></i>Matricula Oficial</button>
        </div>
        <div id="tab1" class="tabcontent">
            <div id="titulo">
                <h6><b>Periodos/Parciales disponibles</b></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>Año</th>
                        <th>Periodo</th>
                        <th>Parcial</th>
                        <th><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalAddSemestre"><i class="bi bi-plus-circle"></i></button>
                            <div class="modal" id="myModalAddSemestre">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header-->
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="color:darkslategrey;">Agregar</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form class="needs-validation" novalidate action="Controlador/ControlAgregar.php" enctype="multipart/form-data" method="POST">
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opOtrosAdd" name="opOtrosAdd" value="1">
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="anioSemAdd" style="color:black;">Año:</label>
                                                    <input type="text" class="form-control" id="anioSemAdd" placeholder="Ingresa el año" name="anioSemAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="periSemAdd" style="color:black;">Periodo:</label>
                                                    <select id="periSemAdd" name="periSemAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>
                                                        <option value="1">Enero - Junio</option>
                                                        <option value="2">Agosto - Diciembre</option>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="parSemAdd" style="color:black;">Parcial:</label>
                                                    <select id="parSemAdd" name="parSemAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>
                                                        <option value="1">Primer parcial</option>
                                                        <option value="2">Segundo parcial</option>
                                                        <option value="2">Tercer parcial</option>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="matriSemAdd" style="color:black;">Matricula Oficial / Evaluada:</label>
                                                    <select id="matriSemAdd" name="matriSemAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>
                                                        <?php
                                                        for ($i = 0; $i < sizeof($matriInfo); $i++) {
                                                            echo '<option value="' . $matriInfo[$i][0] . '">' . $matriInfo[$i][1] . ' / ' . $matriInfo[$i][2] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="aproSemAdd" style="color:black;">Aprobados:</label>
                                                    <input type="text" class="form-control" id="aproSemAdd" placeholder="Alumnos aprobados en el parcial" name="aproSemAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
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
                <tbody>
                    <tr>
                        <?php
                        for ($i = 0; $i < sizeof($semestreA); $i++) {
                            echo '<tr>
                                    <td>' . $semestreA[$i][2] . '</td>
                                    <td>' . ($semestreA[$i][1] == 1 ? 'ENE - JUN' : 'AGO - DIC') . '</td>
                                    <td>' . ($semestreA[$i][3] == 1 ? '1er.' : ($semestreA[$i][3] == 2 ? '2do.' : '3er')) . ' Parcial</td>
                                    <td> 
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#myModalSem" onclick="datosModalSem(\'' . $semestreA[$i][0] . '\', \'' . $semestreA[$i][1] . '\', \'' . $semestreA[$i][2] . '\', \'' . $semestreA[$i][3] . '\', \'' . $semestreA[$i][4] . '\', \'' . $semestreA[$i][5] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                            <a class = "dropdown-item" href = "Controlador/ControlBorrar.php?id=3*1*' . $semestreA[$i][0] . '"><i class = "bi bi-trash-fill"></i>Eliminar</a>
                                        </div>
                                    </div>
                                            
                                        <div class="modal" id="myModalSem">
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
                                                            <div class="form-group" style="display:none">
                                                                <input type="text" class="form-control" id="opOtros" name="opOtros" value="1">
                                                            </div>
                                                            <div class="form-group" style="display:none">
                                                                <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
                                                            </div>
                                                            <div class="form-group" style="display:none">
                                                                <input type="text" class="form-control" id="idSem" name="idSem">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="anioSem" style="color:black;">Año:</label>
                                                                <input type="text" class="form-control" id="anioSem" placeholder="Ingresa el año" name="anioSem" required>
                                                                <div class="valid-feedback">Valido.</div>
                                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="periSem" style="color:black;">Periodo:</label>
                                                                <select id="periSem" name="periSem" class="custom-select mb-3 form-control" required>
                                                                    <option selected>-Selecciona-</option>
                                                                    <option value="1">Enero - Junio</option>
                                                                    <option value="2">Agosto - Diciembre</option>
                                                                </select>
                                                                <div class="valid-feedback">Valido.</div>
                                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="parSem" style="color:black;">Parcial:</label>
                                                                <select id="parSem" name="parSem" class="custom-select mb-3 form-control" required>
                                                                    <option selected>-Selecciona-</option>
                                                                    <option value="1">Primer parcial</option>
                                                                    <option value="2">Segundo parcial</option>
                                                                    <option value="2">Tercer parcial</option>
                                                                </select>
                                                                <div class="valid-feedback">Valido.</div>
                                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="matriSem" style="color:black;">Matricula Oficial y Evaluada:</label>
                                                                <select id="matriSem" name="matriSem" class="custom-select mb-3 form-control" required>
                                                                    <option selected>-Selecciona-</option>';
                            for ($j = 0; $j < sizeof($matriInfo); $j++) {
                                echo '<option value="' . $matriInfo[$j][0] . '">' . $matriInfo[$j][1] . ' / ' . $matriInfo[$j][2] . '</option>';
                            }
                            echo '
                                                                </select>
                                                                <div class="valid-feedback">Valido.</div>
                                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="aproSem" style="color:black;">Aprobados:</label>
                                                                <input type="text" class="form-control" id="aproSem" placeholder="Alumnos aprobados en el parcial" name="aproSem" required>
                                                                <div class="valid-feedback">Valido.</div>
                                                                <div class="invalid-feedback">Por favor verifique los campos.</div>
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
        <div id="tab2" class="tabcontent">
            <!--Tabla de especialidad: Sección 2-->
            <div id="titulo">
                <h6><b>Datos finales de parcial por Eje</b></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Nombre Eje</th>
                        <th>Evaluados</th>
                        <th>Aprobados</th>
                        <th><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalInfoEjeAdd"><i class="bi bi-plus-circle"></i></button>
                            <div class="modal topmargin-xs" id="myModalInfoEjeAdd">
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
                                                    <label for="ejeInfoEjeAdd" style="color:black;">Eje:</label>
                                                    <select id="ejeInfoEjeAdd" name="ejeInfoEjeAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>
                                                        <?php
                                                        for ($j = 0; $j < sizeof($ejeA); $j++) {
                                                            echo '<option value="' . $ejeA[$j][0] . '">' . $ejeA[$j][1] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="semInfoEjeAdd" style="color:black;">Periodo:</label>
                                                    <select id="semInfoEjeAdd" name="semInfoEjeAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>
                                                        <?php
                                                        for ($j = 0; $j < sizeof($semestreA); $j++) {
                                                            echo '<option value="' . $semestreA[$j][0] . '">' . $semestreA[$j][2] . ' ' . (($semestreA[$j][1] == 1) ? 'ENE - JUN' : 'AGO - DIC') . (($semestreA[$j][3]) == 1 ? ' 1er.' : (($semestreA[$j][3]) == 2 ? ' 2do.' : ' 3er.')) . 'Parcial</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Evaluados</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="evalInfoEjeAdd" placeholder="Total Evaluados" name="evalInfoEjeAdd" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Aprobados</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="aprobInfoEjeAdd" placeholder="Estudiantes aprobados" name="aprobInfoEjeAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opOtrosAdd" name="opOtrosAdd" value="2">
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
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
                <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($infoEjeA); $i++) {
                        echo '<tr>
                                        <td>
                                        Periodo:' . (($infoEjeA[$i][5] == 1) ? 'ENE - JUN' : 'AGO - DIC') . '<br>
                                        Año: ' . $infoEjeA[$i][6] . '<br>
                                        Parcial: ' . $infoEjeA[$i][7] . '
                                        </td>
                                        <td>' . $infoEjeA[$i][0] . '</td>
                                        <td>' . $infoEjeA[$i][1] . '</td>
                                        <td>' . $infoEjeA[$i][2] . '</td>
                                        <td>
                                        <div class="btn-group">
                                        <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#myModalInfoEje" onclick="datosModalInfoEje(\'' . $infoEjeA[$i][1] . '\', \'' . $infoEjeA[$i][2] . '\', \'' . $infoEjeA[$i][3] . '\', \'' . $infoEjeA[$i][4] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                            <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=3*2*' . $infoEjeA[$i][3] . '*' . $infoEjeA[$i][4] . '"><i class="bi bi-trash-fill"></i>Eliminar</a>
                                        </div>
                                        </div>
                                            <div class="modal topmargin-sm" id="myModalInfoEje">
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
                                                                    <label for="ejeInfoEje" style="color:black;">Eje:</label>
                                                                    <select id="ejeInfoEje" name="ejeInfoEje" class="custom-select mb-3 form-control" required>
                                                                        <option selected>-Selecciona-</option>';
                        for ($j = 0; $j < sizeof($ejeA); $j++) {
                            echo '<option value="' . $ejeA[$j][0] . '">' . $ejeA[$j][1] . '</option>';
                        }
                        echo '
                                                                    </select>
                                                                    <div class="valid-feedback">Valido.</div>
                                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="semInfoEje" style="color:black;">Periodo:</label>
                                                                    <select id="semInfoEje" name="semInfoEje" class="custom-select mb-3 form-control" required>
                                                                        <option selected>-Selecciona-</option>';
                        for ($j = 0; $j < sizeof($semestreA); $j++) {
                            echo '<option value="' . $semestreA[$j][0] . '">' . $semestreA[$j][2] . ' ' . (($semestreA[$j][1] == 1) ? 'ENE - JUN' : 'AGO - DIC') . (($semestreA[$j][3]) == 1 ? ' 1er.' : (($semestreA[$j][3]) == 2 ? ' 2do.' : ' 3er.')) . 'Parcial</option>';
                        }
                        echo '
                                                                    </select>
                                                                    <div class="valid-feedback">Valido.</div>
                                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Evaluados</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="evalInfoEje" placeholder="Total Evaluados" name="evalInfoEje" required>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Aprobados</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="aprobInfoEje" placeholder="Estudiantes aprobados" name="aprobInfoEje" required>
                                                                    <div class="valid-feedback">Valido.</div>
                                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                                </div>
                                                                <div class="form-group" style="display:none">
                                                                    <input type="text" class="form-control" id="ejeOriEje" name="ejeOriEje">
                                                                </div>
                                                                <div class="form-group" style="display:none">
                                                                    <input type="text" class="form-control" id="periOriEje" name="periOriEje">
                                                                </div>
                                                                <div class="form-group" style="display:none">
                                                                    <input type="text" class="form-control" id="opOtros" name="opOtros" value="2">
                                                                </div>
                                                                <div class="form-group" style="display:none">
                                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
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
        <div id="tab3" class="tabcontent">
            <div id="titulo">
                <h6><b>Informacion extra finales</b></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Aprobados</th>
                        <th>Matricula</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        for ($i = 0; $i < sizeof($listaPFin); $i++) {
                            echo '<tr>
                                    <td>Periodo: ' . ($listaPFin[$i][0] == 1 ? 'ENE - JUN' : 'AGO - DIC') . '<br>
                                        Año: ' . $listaPFin[$i][1] . '</td>
                                    <td>' . $listaPFin[$i][2] . '</td>
                                    <td>Oficial: ' . $listaPFin[$i][4] . '<br>
                                        Evaluada: ' . $listaPFin[$i][5] . '</td>
                                    <td> 
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#myModalInfFin" onclick="datosModalInfFin(\'' . $listaPFin[$i][0] . '\', \'' . $listaPFin[$i][1] . '\', \'' . $listaPFin[$i][2] . '\', \'' . $listaPFin[$i][3] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                            <a class = "dropdown-item" href = "Controlador/ControlBorrar.php?id=3*4*' . $listaPFin[$i][1] . '*' . $listaPFin[$i][0] . '"><i class = "bi bi-trash-fill"></i>Eliminar</a>
                                        </div>
                                    </div> 
                                    <div class="modal" id="myModalInfFin">
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
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="opOtros" name="opOtros" value="4">
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="perFin" name="perFin">
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="anioFin" name="anioFin">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="aprobInfFin" style="color:black;">Total Aprobados:</label>
                                                            <input type="text" class="form-control" id="aprobInfFin" placeholder="Ingresa el numero de aprobados" name="aprobInfFin" required>
                                                            <div class="valid-feedback">Valido.</div>
                                                            <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="matriFin" style="color:black;">Matricula Oficial / Evaluada:</label>
                                                            <select id="matriFin" name="matriFin" class="custom-select mb-3 form-control" required>
                                                                <option selected>-Selecciona-</option>';
                            for ($j = 0; $j < sizeof($matriInfo); $j++) {
                                echo '<option value = "' . $matriInfo[$j][0] . '">' . $matriInfo[$j][1] . ' / ' . $matriInfo[$j][2] . '</option > ';
                            }
                            echo '
                                                            </select>
                                                            <div class="valid-feedback">Valido.</div>
                                                            <div class="invalid-feedback">Por favor verifique los campos.</div>
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
        <div id="tab4" class="tabcontent">
            <!--Tabla de especialidad: Sección 3-->
            <div id="titulo">
                <h6><b>Matricula Oficial</b></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>Matrícula Oficial</th>
                        <th>Matrícula evaluada en asignaturas de estructura genérica y de especialidada</th>
                        <th><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalInfoEje2Add"><i class="bi bi-plus-circle"></i></button>
                            <div class="modal topmargin-xs" id="myModalInfoEje2Add">
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
                                                    <label for="matriMatAdd" style="color:black;">Matricula Oficial:</label>
                                                    <input type="text" class="form-control" id="matriMatAdd" placeholder="Matricula Oficial" name="matriMatAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="evalMatAdd" style="color:black;">Matrícula evaluada:</label>
                                                    <input type="text" class="form-control" id="evalMatAdd" placeholder="Matrícula evaluada" name="evalMatAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opOtrosAdd" name="opOtrosAdd" value="3">
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
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
                <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($matriInfo); $i++) {
                        echo '<tr>
                                <td>' . $matriInfo[$i][1] . '</td>
                                <td>' . $matriInfo[$i][2] . '</td>
                                <td>
                                <div class="btn-group">
                                <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#myModalMatriInfo" onclick="datosModalMatriInfo(\'' . $matriInfo[$i][0] . '\', \'' . $matriInfo[$i][1] . '\', \'' . $matriInfo[$i][2] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=3*3*' . $matriInfo[$i][0] . '"><i class="bi bi-trash-fill"></i>Eliminar</a>
                                </div>
                                </div>
                                <div class="modal" id="myModalMatriInfo">
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
                                                        <label for="matriMat" style="color:black;">Matricula Oficial:</label>
                                                        <input type="text" class="form-control" id="matriMat" placeholder="Matricula Oficial" name="matriMat" required>
                                                        <div class="valid-feedback">Valido.</div>
                                                        <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="evalMat" style="color:black;">Matrícula evaluada:</label>
                                                        <input type="text" class="form-control" id="evalMat" placeholder="Matrícula evaluada" name="evalMat" required>
                                                        <div class="valid-feedback">Valido.</div>
                                                        <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="idMat" name="idMat">
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="opOtros" name="opOtros" value="3">
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="3">
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
    <script type="text/javascript" src="js/tabs.js"></script>
</div>
</div>
</div>
<?php include('AdminFooter.php') ?>
<!--JS Local-->
<script type="text/javascript" src="js/editarPeriodosInfo.js"></script>
</body>

</html>