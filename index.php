<?php
include('head.php');
?>
<div class="especialidad">
    <div class="contenedor-texto topmargin-xs">
        <div class="t-malla container">
            <br>
            <h2 class="text-center" style="color:#5f5f5f !important;">Sistema de indicadores de<br>nivel de desmpeño</h2>
            <h3 class="text-center" style="color:#5f5f5f !important;"><b>Ingeniería en Sistemas Computacionales</b></h3>
            <p class="text-center" style="color:#5f5f5f !important;">INDICADORES DE NIVEL DE DESEMPEÑO PARCIALES<br>INDICADORES FINALES</p>
        </div>
        <div class="text-center">
            <ul class="list-inline">
                <li class="list-inline-item footer-menu">
                    <a class="text-center btn btn-outline-primary " href="AdminParcial.php" ><i class="bi bi-arrow-bar-right"></i> Gestionar <i class="bi bi-arrow-bar-left"></i></a>
                    <!--<a class="text-center btn btn-outline-primary " href="Admin.php" data-toggle="modal" data-target="#myModal1"><i class="bi bi-arrow-bar-right"></i> Gestionar <i class="bi bi-arrow-bar-left"></i></a>-->
                </li>
            </ul>
            <div class="modal fade topmargin-xs" id="myModal1">
                <div class="modal-dialog">
                    <div class="login modal-content">
                        <!-- Modal Header -->
                        <button type="button" class="close ml-auto p-3" data-dismiss="modal" style="outline:none;">&times;</button>
                        <div class="col-12 user-img">
                            <img src="img/logos/logo-isic.png" />
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="col-12" action="AdminInicio.php?1.0.0" method="POST" name="logi">
                                <div class="p-3">
                                    <div class="form-group" id="user-group">
                                        <input class="form-control" id="admin" type="text" placeholder="Administador" name="admin" />
                                    </div>
                                    <div class="form-group" id="contrasena-group">
                                        <input class="form-control" id="pass" type="password" placeholder="Password" name="pass" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-info">Iniciar sesión</button>
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
