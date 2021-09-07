(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

datosModalSem = function (idsem, periodo, anio, parcial, matric, aprobados){
    $('#idSem').val(idsem);
    $('#periSem').val(periodo);
    $('#anioSem').val(anio);
    $('#parSem').val(parcial);
    $('#matriSem').val(matric);
    $('#aproSem').val(aprobados);
};

datosModalInfoEje = function (estEval, aprobados, idinfoeje, periodo){
    $('#evalInfoEje').val(estEval);
    $('#aprobInfoEje').val(aprobados);
    $('#ejeInfoEje').val(idinfoeje);
    $('#ejeOriEje').val(idinfoeje);
    $('#semInfoEje').val(periodo);
    $('#periOriEje').val(periodo);
};

datosModalMatriInfo = function (idMatriculaInfo, matricula, matriculaEval){
    $('#idMat').val(idMatriculaInfo);
    $('#matriMat').val(matricula);
    $('#evalMat').val(matriculaEval);
};

datosModalInfFin = function (periodoF, año, aprobTotal, matricula){
    $('#aprobInfFin').val(aprobTotal);
    $('#matriFin').val(matricula);  
    $('#perFin').val(periodoF);
    $('#anioFin').val(año);
};