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

datosModalEje = function (idEje, nomEje){
    $('#idEje').val(idEje);
    $('#nomEje').val(nomEje);
    $('#opEjeAsi').val(1);
};

datosModalAsig = function (AS_ClaveAsignatura, AS_NombreAsignatura, AS_Area){
    $('#clavAsig').val(AS_ClaveAsignatura);
    $('#clavOriAsig').val(AS_ClaveAsignatura);
    $('#nombAsig').val(AS_NombreAsignatura);
    $('#ejeAsi').val(AS_Area);
    $('#opEjeAsi').val(2);
};