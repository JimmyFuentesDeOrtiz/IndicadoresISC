// Disable form submissions if there are invalid fields
aux = 0;
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

datosModalPar = function (claveGrupo, claveAsig, docente, sumCalif, totalEstEval, totalGroup, aprobadosXParcial, aprobadosU1, aprobadosU2, semestre) {
    $('#clavGPar').val(claveGrupo);
    $('#asignaturaPar').val(claveAsig);
    $('#docentePar').val(docente);
    $('#sumaPar').val(sumCalif);
    $('#evalPar').val(totalEstEval);
    $('#grupoPar').val(totalGroup);
    $('#aprobPar').val(aprobadosXParcial);
    $('#aprobU1Par').val(aprobadosU1);
    $('#aprobU2Par').val(aprobadosU2);
    $('#semestrePar').val(semestre);
    $('#clavOriPar').val(claveGrupo);
    $('#semOriPar').val(semestre);
    $('#opGlobal').val(1);
};

