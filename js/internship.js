function subirFileHistorial(){
    var file = document.getElementById("historial");
    if (file.files.length === 0) {
        document.getElementById("imgHistorial").src = "/../img/upload_file.png";
    }
    else {
        document.getElementById("imgHistorial").src = "/../img/uploaded.png";
    }
}
