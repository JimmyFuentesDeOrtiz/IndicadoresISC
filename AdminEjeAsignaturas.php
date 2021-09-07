<?php
include('./headAdmin.php');
$ejeA = getEjesAdmin();
$asigA = getAsignaturaAdmin();
$pagina1 = 'active';
include('AdminSidebar.php');
?>
<div class="admon">
    <div class="container">
        <h2>Ejes y Asignaturas</h2>
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'tab1')" id="defaultOpen"><i class="bi bi-file-earmark-person-fill"></i>Eje</button>
            <button class="tablinks" onclick="openCity(event, 'tab2')"><i class="bi bi-book-fill"></i>Asignaturas</button>
        </div>
        <div id="tab1" class="tabcontent">
            <div id="titulo">
                <h6><b>Ejes disponibles</b><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalAddEje"><i class="bi bi-plus-circle"></i>Agregar</button></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>
                        <th>
                            <div class="modal topmargin-sm" id="myModalAddEje">
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
                                                    <label for="nomEjeAdd" style="color:black;">Titulo de Eje:</label>
                                                    <input type="text" class="form-control" id="nomEjeAdd" placeholder="Ingresa el nombre del eje" name="nomEjeAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opEjeAsiAdd" name="opEjeAsiAdd" value="1">
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="2">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Aceptar</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($ejeA); $i++) {
                        echo '
                        <tr>
                            <td>' . $ejeA[$i][0] . '</td>
                            <td>' . $ejeA[$i][1] . '</td>
                            <td>
                            <div class="btn-group">
                                <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#myModalEje" onclick="datosModalEje(\'' . $ejeA[$i][0] . '\', \'' . $ejeA[$i][1] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                    <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=2*' . $ejeA[$i][0] . '*1"><i class="bi bi-trash-fill"></i>Eliminar</a>
                                </div>
                                </div>
                                <div class="modal topmargin-sm" id="myModalEje">
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
                                                        <label for="nomEje" style="color:black;">Titulo de Eje:</label>
                                                        <input type="text" class="form-control" id="nomEje" placeholder="Ingresa el nombre del eje" name="nomEje" required>
                                                        <div class="valid-feedback">Valido.</div>
                                                        <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="idEje" name="idEje">
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="opEjeAsi" name="opEjeAsi" value="1">
                                                    </div>
                                                    <div class="form-group" style="display:none">
                                                        <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="2">
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
            <div id="titulo">
                <h6><b>Asignaturas disponibles</b><button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModalAddAsig"><i class="bi bi-plus-circle"></i>Agregar</button></h6>
            </div>
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Eje</th>
                        <th>
                            <div class="modal topmargin-sm" id="myModalAddAsig">
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
                                                    <label for="clavAsigAdd" style="color:black;">Clave de Asignatura:</label>
                                                    <input type="text" class="form-control" id="clavAsigAdd" placeholder="Ingresa la clave de asignatura" name="clavAsigAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombAsigAdd" style="color:black;">Nombre de Asignatura:</label>
                                                    <input type="text" class="form-control" id="nombAsigAdd" placeholder="Ingresa el nombre de la asignatura" name="nombAsigAdd" required>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="from-group">
                                                    <label for="ejeAsiAdd" style="color:black;">Eje:</label>
                                                    <select id="ejeAsiAdd" name="ejeAsiAdd" class="custom-select mb-3 form-control" required>
                                                        <option selected>-Selecciona-</option>';
                                                        <?php
                                                        for ($j = 0; $j < sizeof($ejeA); $j++) {
                                                            echo '<option value="' . $ejeA[$j][0] . '">' . $ejeA[$j][1] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="valid-feedback">Valido.</div>
                                                    <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opEjeAsiAdd" name="opEjeAsiAdd" value="2">
                                                </div>
                                                <div class="form-group" style="display:none">
                                                    <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="2">
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
                    for ($i = 0; $i < sizeof($asigA); $i++) {
                        echo '<tr>
                                <td>' . $asigA[$i][0] . '</td>
                                <td>' . $asigA[$i][1] . '</td>
                                <td>' . $asigA[$i][3] . '</td>
                                <td> 
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#myModalAsig" onclick="datosModalAsig(\'' . $asigA[$i][0] . '\', \'' . $asigA[$i][1] . '\', \'' . $asigA[$i][2] . '\');"><i class="bi bi-pencil-square"></i>Editar</a>
                                        <a class="dropdown-item" href="Controlador/ControlBorrar.php?id=2*' . $asigA[$i][0] . '*2"><i class="bi bi-trash-fill"></i>Eliminar</a>
                                    </div>
                                    </div>
                                    <div class="modal topmargin-sm" id="myModalAsig">
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
                                                            <label for="clavAsig" style="color:black;">Clave de Asignatura:</label>
                                                            <input type="text" class="form-control" id="clavAsig" placeholder="Ingresa la clave de asignatura" name="clavAsig" required>
                                                            <div class="valid-feedback">Valido.</div>
                                                            <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombAsig" style="color:black;">Nombre de Asignatura:</label>
                                                            <input type="text" class="form-control" id="nombAsig" placeholder="Ingresa el nombre de la asignatura" name="nombAsig" required>
                                                            <div class="valid-feedback">Valido.</div>
                                                            <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                        </div>
                                                        <div class="from-group">
                                                            <label for="ejeAsi" style="color:black;">Eje:</label>
                                                            <select id="ejeAsi" name="ejeAsi" class="custom-select mb-3 form-control" required>
                                                                <option selected>-Selecciona-</option>';

                        for ($j = 0; $j < sizeof($ejeA); $j++) {
                            echo '<option value="' . $ejeA[$j][0] . '">' . $ejeA[$j][1] . '</option>';
                        }
                        echo '
                                                            </select>
                                                            <div class="valid-feedback">Valido.</div>
                                                            <div class="invalid-feedback">Por favor verifique los campos.</div>
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="clavOriAsig" name="clavOriAsig">
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="opEjeAsi" name="opEjeAsi" value="2">
                                                        </div>
                                                        <div class="form-group" style="display:none">
                                                            <input type="text" class="form-control" id="opGlobal" name="opGlobal" value="2">
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
        <script type="text/javascript" src="js/tabs.js"></script>
    </div>
</div>
</div>
<?php include('AdminFooter.php') ?>
<!--JS Local-->
<script type="text/javascript" src="js/editarEjeAsignatura.js?1.0.0"></script>
</body>

</html>