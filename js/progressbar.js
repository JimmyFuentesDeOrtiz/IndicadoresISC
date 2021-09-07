$(document).ready(function (Firefox) {
    var i = 0;
    if (i == 0) {
        i = 1;
        var elem1 = document.getElementById("myBar1");
        var elem2 = document.getElementById("myBar2");
        var elem3 = document.getElementById("myBar3");
        var elem4 = document.getElementById("myBar4");
        var elem5 = document.getElementById("myBar5");
        var elem6 = document.getElementById("myBar6");
        var width = 10;
        var chrome = 8902;
        var edge = 3389;
        var firefox = 3320;
        var suma = chrome + edge + firefox;
        var valor1 = (chrome / suma) * 100;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= valor1) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem1.style.width = width + "%";
                elem1.innerHTML = width + "%";
            }
        }

    }
});
