<?php
    //require_once 'database.php';

    $pdo = new PDO('mysql:host=localhost;dbname=2005B_01', 'u2005_01', 'Q$Tcbo%2nW1K', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ));

    $nombre = NULL;
    $apellido = NULL;
    $correo = NULL;
    $telefono = NULL;
    $idDepartamento = NULL;
    $asunto = NULL;
    $mensaje = NULL;

    if (!empty($_POST)) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $idDepartamento = $_POST["departamento"];
        $asunto = $_POST["asunto"];
        $mensaje = $_POST["mensaje"];


        try {
            // Iniciar transaccion
            $pdo->beginTransaction();

            // Subir query a la base de datos
            $sql = "INSERT INTO Contacto (nombre, apellido, asunto, mensaje, correo, telefono, idDepartamento) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $nombre,
                $apellido,
                $asunto,
                $mensaje,
                $correo,
                $telefono,
                $idDepartamento
                )
            );

            // Comprometer los cambios
            $pdo->commit();

            header('Location: retro.html');
            die();
        }

        catch(Exception $e){
            // Mostrar el mensaje de error
            echo $e->getMessage();
            // Retirar los cambios
            $pdo->rollBack();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/contacto.css">
    <title>Contacto</title>
</head>
<body>
    <h1 class="naatik-name">Naatik</h1>
    <div class="Contacto">
        <h1>El primer paso a tu solución...</h1>
        
        <div class="form">
            <form action="" method="POST">
                <div class="row">
                    <div class="tam50 izquierda">
                        <label for="nombre" class="required">Nombre(s) </label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="tam50 derecha">
                        <label for="apellido" class="required">Apellido(s) </label>
                        <input type="text" name="apellido" id="apellido" required>
                    </div>
                </div>
                <div class="row">
                    <div class="tam50 izquierda">
                        <label for="correo" class="required">Correo </label>
                        <input type="email" name="correo" id="correo" required>
                    </div>
                    <div class="tam50 derecha">
                        <label for="telefono" class="required">Número telefónico </label>
                        <input type="number" name="telefono" id="telefono" required>
                    </div>
                </div>
                <div class="row">
                    <div class="tam50 izquierda">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="departamento">
                        <option value="" disabled selected>Seleccione una opción...</option>
                            <?php
                                $query = 'SELECT * FROM Departamento';
                                foreach ($pdo->query($query) as $row) {
                                    if ($row['idDepartamento'] == $idDepartamento)
                                        echo "<option value = '" . $row['idDepartamento'] . "'>" . $row["nombre"] . "</option>";
                                    else
                                        echo "<option value = " . $row["idDepartamento"] . ">" . $row["nombre"] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="tam50 derecha">
                        <label for="asunto" class="required">Asunto </label>
                        <input type="text" name="asunto" id="asunto" required>
                    </div>
                </div>
                <div class="row">
                    <div class="tam100">
                        <label for="mensaje" class="required">Mensaje </label>
                        <textarea name="mensaje" id="mensaje" required></textarea>
                    </div>
                </div>
                <div class="row required">
                    <p id="post-asterisk"><em> Campos obligatorios</em></p>
                    <p id=asterisk>*</p>
                </div>
                <div class="row">
                    <div class="botones">
                        <input type="submit" value="Enviar" class="boton enviar">
                        <!-- <input type="button" value="Cancelar" class="boton cancelar"> -->
                        <button type="button" class="boton cancelar" onclick="mostrarIndex()">Cancelar</button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</body>
<script src="./js/contacto.js"></script>
</html>
