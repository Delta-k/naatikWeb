function subirFileHistorial(){
    var file = document.getElementById("historial");
    if (file.files.length == 0) {
        document.getElementById("imgHistorial").src = "img/upload_file.png";
        document.getElementById('buttonHA').style.display = 'none';
        document.getElementById('borrarHA').style.display = 'none';
        document.getElementById('img_files_ha').style.width = '100%';
    }
    else {
        document.getElementById("imgHistorial").src = "img/uploaded.png";
        document.getElementById("buttonHA").style.display = "inline";
        document.getElementById("borrarHA").style.display = "inline";
        document.getElementById('img_files_ha').style.width = '50%';
    }
}

function vaciarHA(){
    document.getElementById("historial").value = null;
    subirFileHistorial();
}


function subirFileCV(){
    var file = document.getElementById("cv");
    if (file.files.length == 0) {
        document.getElementById("imgCV").src = "img/upload_file.png";
        document.getElementById('buttonCV').style.display = 'none';
        document.getElementById('borrarCV').style.display = 'none';
        document.getElementById('img_files_cv').style.width = '100%';
    }
    else {
        document.getElementById("imgCV").src = "img/uploaded.png";
        document.getElementById('buttonCV').style.display = 'inline';
        document.getElementById('borrarCV').style.display = 'inline';
        document.getElementById('img_files_cv').style.width = '50%';
    }
}

function vaciarCV(){
    document.getElementById("cv").value = null;
    subirFileCV();
}


function subirFileCURP(){
    var file = document.getElementById("curp");
    if (file.files.length == 0) {
        document.getElementById("imgCURP").src = "img/upload_file.png";
        document.getElementById('buttonCURP').style.display = 'none';
        document.getElementById('borrarCURP').style.display = 'none';
        document.getElementById('img_files_curp').style.width = '100%';
    }
    else {
        document.getElementById("imgCURP").src = "img/uploaded.png";
        document.getElementById('buttonCURP').style.display = 'inline';
        document.getElementById('borrarCURP').style.display = 'inline';
        document.getElementById('img_files_curp').style.width = '50%';
    }
}

function vaciarCURP(){
    document.getElementById("curp").value = null;
    subirFileCURP();
}


function subirFileINE(){
    var file = document.getElementById("ine");
    if (file.files.length == 0) {
        document.getElementById("imgINE").src = "img/upload_file.png";
        document.getElementById('buttonINE').style.display = 'none';
        document.getElementById('borrarINE').style.display = 'none';
        document.getElementById('img_files_ine').style.width = '100%';
    }
    else {
        document.getElementById("imgINE").src = "img/uploaded.png";
        document.getElementById('buttonINE').style.display = 'inline';
        document.getElementById('borrarINE').style.display = 'inline';
        document.getElementById('img_files_ine').style.width = '50%';
    }
}

function vaciarINE(){
    document.getElementById("ine").value = null;
    subirFileINE();
}


function checarFiles(){
    var fileINE = document.getElementById("ine");
    var fileCURP = document.getElementById("curp");
    var fileCV = document.getElementById("cv");
    var fileHA = document.getElementById("historial");

    if (fileINE.files.length == 0) {
        document.getElementById("imgINE").src = "img/upload_error.png";
    }
    if (fileCURP.files.length == 0) {
        document.getElementById("imgCURP").src = "img/upload_error.png";
    }
    if (fileCV.files.length == 0){
        document.getElementById("imgCV").src = "img/upload_error.png";
    }
    if (fileHA.files.length == 0) {
        document.getElementById("imgHistorial").src = "img/upload_error.png";
    }

}