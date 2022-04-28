function subirFileHistorial(){
    var file = document.getElementById("historial");
    if (file.files.length == 0) {
        document.getElementById("imgHistorial").src = "img/upload_file.png";
    }
    else {
        document.getElementById("imgHistorial").src = "img/uploaded.png";
    }
}

function subirFileCV(){
    var file = document.getElementById("cv");
    if (file.files.length == 0) {
        document.getElementById("imgCV").src = "img/upload_file.png";
    }
    else {
        document.getElementById("imgCV").src = "img/uploaded.png";
    }
}

function subirFileCURP(){
    var file = document.getElementById("curp");
    if (file.files.length == 0) {
        document.getElementById("imgCURP").src = "img/upload_file.png";
    }
    else {
        document.getElementById("imgCURP").src = "img/uploaded.png";
    }
}

function subirFileINE(){
    var file = document.getElementById("ine");
    if (file.files.length == 0) {
        document.getElementById("imgINE").src = "img/upload_file.png";
    }
    else {
        document.getElementById("imgINE").src = "img/uploaded.png";
    }
}