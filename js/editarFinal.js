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

datosModalFin = function (grupo, sumCalif, prom, totEstu, aprob, periodoF, año, asigF){
    $('#clavGFin').val(grupo);
    $('#sumaFin').val(sumCalif);
    $('#promFin').val(prom);
    $('#evalFin').val(totEstu);
    $('#aprobFin').val(aprob);
    $('#periFin').val(periodoF);
    $('#anioFin').val(año);
    $('#asignaturaFin').val(asigF);
    $('#claveOriFin').val(grupo);
    $('#anioOriFin').val(año);
    $('#perOriFin').val(periodoF);
};
