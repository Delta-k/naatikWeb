<?php
    //require_once 'database.php';

    $pdo = new PDO('mysql:host=localhost;dbname=2005B_01', 'u2005_01', 'Q$Tcbo%2nW1K', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ));

    $nombre = NULL;
    $apellido = NULL;
    $universidad = NULL;
    $carrera = NULL;
    $semestre = NULL;
    $promedio = NULL;
    $idDepartamento = NULL;

    if (!empty($_POST)) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $universidad = $_POST["universidad"];
        $carrera = $_POST["carrera"];
        $semestre = $_POST["semestre"];
        $promedio = $_POST["promedio"];
        $idDepartamento = $_POST["departamento"];

        mkdir("uploads/" . $nombre . "_" . $apellido . "/", 0700, true);
        $target_dir = "uploads/" . $nombre . "_" . $apellido . "/"; 
        $target_file_historial = $target_dir . basename($_FILES["historial"]["name"]);
        $target_file_cv = $target_dir . basename($_FILES["cv"]["name"]);
        $target_file_curp = $target_dir . basename($_FILES["curp"]["name"]);
        $target_file_ine = $target_dir . basename($_FILES["ine"]["name"]);

        try {
            // Subir archivos a la carpeta uploads
            move_uploaded_file($_FILES["historial"]["tmp_name"], $target_file_historial);
            move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file_cv);
            move_uploaded_file($_FILES["curp"]["tmp_name"], $target_file_curp);
            move_uploaded_file($_FILES["ine"]["tmp_name"], $target_file_ine);


            // Iniciar transaccion
            $pdo->beginTransaction();

            // Subir query a la base de datos
            $sql = "INSERT INTO Intern (nombre, apellido, universidad, carrera, semestre, promedio, idDepartamento) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $nombre,
                $apellido,
                $universidad,
                $carrera,
                $semestre,
                $promedio,
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/internship.css">
    <script src="./js/internship.js"></script>
    <title>Naatik</title>
</head>
<body>
    <!-- Menu superior -->
    <div class="upper-nav">
        <div class="upper-nav-block">
            <a class="nav-items-upper">Lenguaje</a>
            <select id="lenguaje">
                <option value="Español">ES</option>
                <option value="Ingles">EN</option>
            </select>
            <a class="nav-items-upper" href="internship.php">Pasantías</a>
            <a class="nav-items-upper" href="https://www.masterchannel.com.mx/">Socios</a>
        </div>
    </div>

    <!-- Seccion de Sectores-->
    <div class="top">
        <div class="main-nav">
            <!--Aqui empieza la barra de navegación principal-->
            <a class="nav-items" href="index.html">Inicio</a>
            <a class="nav-items" href="nosotros.html">Nosotros</a>
            <a class="nav-items" href="sectores.html">Sectores </a>
            <a class="nav-items" href="servicios.html">Servicios</a>
            <a class="nav-items" href="contacto.php">Contacto</a>
        </div>
        <div class="top-text">
            <h1 class="apartado">Estancias para tesis <br> o servicio social</h1>
        </div>
    </div>
    <div class="caratula">
        <div class="joinus">
            <img src="img/hiring.png" alt="Únete al equipo">
        </div>
        <div class="descripcion">
            <p>
                Se solicitan estudiantes pasantes de la carrera de:
            </p>    
            <ul>
                <li>Ingeniería en Computación</li>
                <li>Ciencias de la Computación</li>
                <li>Sistemas Informáticos</li>
                <li>Otras carreras afines</li>
            </ul>
            <p>
                que cumplan con los siguientes requisitos y deseen desarrollar su tesis de licenciatura en la empresa Naatik A.I. Solutions, (www.naatik.ai, RFC: NAS200723T10, Registro RENIECyT-Conacyt 2000846), con desarrollo y seguimiento de actividades de manera remota.
            </p>
        </div>
    </div>
    <div class="detalles">
        <div class="beneficios">
            <h2>Beneficios</h2>
            <ul>
                <li>Asesoría por parte de personal experto a nivel nacional e internacional en el área de sistemas inteligentes.</li>
                <li>Acceso a programas e información técnica especializada.</li>
                <li>Desarrollo y seguimiento de actividades de manera totalmente remota (8 horas diarias).</li>
                <li>Participación en proyectos relacionados con inteligencia artificial.</li>
                <li>Excelente ambiente de trabajo.</li>
                <li>Crecimiento profesional</li>
            </ul>
        </div>
        <div class="actividades">
            <h2>Actividades generales a realizar</h2>
            <ul>
                <li>Análisis, diseño e implementación de soluciones de software.</li>
                <li>Visualización y análisis de datos.</li>
            </ul>
        </div>
        <div class="documentacion">
            <h2>Documentación Requerida</h2>
            <ul>
                <li>Copia de historial académico</li>
                <li>Currículum vitae Actualizado</li>
                <li>Copia de CURP </li>
                <li>Copia de INE </li>
            </ul>
        </div>
    </div>
    <div class="requisitos">
        <h2>Requisitos</h2>
        <div class="req1">
            <ul>
                <li>Ubicarse en el 20% de los mejores promedios de su generación.</li>
                <li>Interés en aplicaciones de Inteligencia Artificial, particularmente aprendizaje automático y ciencia de datos.</li>
                <li>Familiaridad con aplicaciones generales de minería y ciencia de datos.</li>
                <li>Experiencia en programación con librerías y paqueted de Python, R, Java, Matlab y C/C++.</li>
                <li>Conocimientos en Base de Datos (SQL, MySQL, Postgres, etc).</li>
            </ul>
        </div>
        <div class="req2">
            <ul>
                <li>Conocimientos en desarrollo de aplicaciones con tecnologías WEB (JavaScript, CSS y HTML; NodeJS, JSON/API RESTfull, Rest Web Services, Apache).</li>
                <li>Dominio del idioma inglés.</li>
                <li>Pasión por el interés y descubrimiento de patrones, creativida y proactividad, así como innovación en desarrollo y espíritu de servicio.</li>
                <li>Disponibilidad de medio tiempo o tiempo completo.</li>
                <li>Sexo indistinto, edad máxima 25 años.</li>
            </ul>
        </div>
    </div>

    <div class="aplica">
        <div class="row">
            <h2>¡Postúlate!</h2>
            <p>Únete al equipo de trabajo y conviértete en un profesional de la Ciencia de Datos</p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="info">
                <div class="row">
                    <div class="col1">
                        <label for="nombre" class="required">Nombre(s) </label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="col2">
                        <label for="apellido" class="required">Apellido(s) </label>
                        <input type="text" name="apellido" id="apellido" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col1">
                        <label for="universidad" class="required">Universidad </label>
                        <input type="text" name="universidad" id="universidad" required>
                    </div>

                    <div class="col2">
                        <label for="carrera" class="required">Carrera </label>
                        <input type="text" name="carrera" id="carrera" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col1a">
                        <label for="semestre" class="required">Semestre </label>
                        <input type="number" name="semestre" id="semestre" min="1" max="10" required>
                    </div>
                    <div class="col2a">
                        <label for="promedio" class="required">Promedio </label>
                        <input type="number" name="promedio" id="promedio" min="1" max="100" required>
                    </div>
                    <div class="col3a">
                        <label for="departamento" class="required">Departamento</label>
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
                </div>
            </div>
    
            <div class="inscribir">
                <div class="row">
                    <div class="col1">
                        <label for="historial" class="required ha">&nbsp; Historial académico:                   
                            <input type="file"
                            id="historial" name="historial"
                            accept="application/pdf" required>
                            <br>
                            <img src="img/upload_file.png" alt="Sube historial">
                        </label>
                        
                    </div>
                    <div class="col2">
                        <label for="cv" class="required cv">&nbsp; Curriculum Vitae: 
                            <input type="file"
                            id="cv" name="cv"
                            accept="application/pdf" required>
                            <br>
                            <img id="imgcv" src="img/upload_file.png" alt="Sube cv">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col1">
                        <label for="curp" class="required curp">&nbsp; CURP: 
                            <input type="file"
                            id="curp" name="curp"
                            accept="application/pdf" required>
                            <br>
                            <img src="img/upload_file.png" alt="Sube curp">
                        </label>
                    </div>
                    <div class="col2">
                        <label for="ine" class="required ine">&nbsp;INE: 
                            <input type="file"
                            id="ine" name="ine"
                            accept="application/pdf" required>
                            <br>
                            <img src="img/upload_file.png" alt="Sube INE">
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Enviar" name="submit" class="boton enviar">
            </div>
        </form>
    </div>

    <!-- Seccion de footer -->
    <div class="fix"></div>
    <footer>
        <table class="footer-content">
            <tr>
                <td class="footer-social">
                    <p>Encuéntranos en nuestras redes sociales</p>
                    <button id="face-button" onclick="location.href='https://www.google.com.mx/?hl=es-419'" type="button">
                        <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="42" height="40" rx="20" fill="#D5E2E4"/>
                            <path d="M24.4102 20L24.8769 17.1044H21.9589V15.2253C21.9589 14.4331 22.3665 13.6609 23.6734 13.6609H25V11.1956C25 11.1956 23.7961 11 22.6451 11C20.242 11 18.6712 12.3869 18.6712 14.8975V17.1044H16V20H18.6712V27H21.9589V20H24.4102Z" fill="#D3D6D8"/>
                        </svg>  
                    </button>
                    <button id="twitter-button" onclick="location.href='https://www.google.com.mx/?hl=es-419'" type="button">
                        <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="42" height="40" rx="20" fill="#D5E2E4"/>
                            <path d="M27.6777 17.0835C28.3027 16.6147 28.8652 16.0522 29.3027 15.396C28.7402 15.646 28.084 15.8335 27.4277 15.896C28.1152 15.4897 28.6152 14.8647 28.8652 14.0835C28.2402 14.4585 27.5215 14.7397 26.8027 14.896C26.1777 14.2397 25.334 13.8647 24.3965 13.8647C22.584 13.8647 21.1152 15.3335 21.1152 17.146C21.1152 17.396 21.1465 17.646 21.209 17.896C18.4902 17.7397 16.0527 16.4272 14.4277 14.4585C14.1465 14.9272 13.9902 15.4897 13.9902 16.1147C13.9902 17.2397 14.5527 18.2397 15.459 18.8335C14.9277 18.8022 14.3965 18.6772 13.959 18.4272V18.4585C13.959 20.0522 15.084 21.3647 16.584 21.6772C16.334 21.7397 16.0215 21.8022 15.7402 21.8022C15.5215 21.8022 15.334 21.771 15.1152 21.7397C15.5215 23.0522 16.7402 23.9897 18.1777 24.021C17.0527 24.896 15.6465 25.4272 14.1152 25.4272C13.834 25.4272 13.584 25.396 13.334 25.3647C14.7715 26.3022 16.4902 26.8335 18.3652 26.8335C24.3965 26.8335 27.6777 21.8647 27.6777 17.521C27.6777 17.3647 27.6777 17.2397 27.6777 17.0835Z" fill="#D3D6D8"/>
                        </svg>  
                    </button>
                    <button id="youtube-button" onclick="location.href='https://www.google.com.mx/?hl=es-419'" type="button">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="40" height="40" rx="20" fill="#D5E2E4"/>
                            <path d="M29.5821 15.1905C29.3521 14.3283 28.6744 13.6492 27.8139 13.4188C26.2542 13 20 13 20 13C20 13 13.7459 13 12.1861 13.4188C11.3256 13.6492 10.6479 14.3283 10.4179 15.1905C10 16.7534 10 20.0141 10 20.0141C10 20.0141 10 23.2749 10.4179 24.8378C10.6479 25.7 11.3256 26.3508 12.1861 26.5812C13.7459 27 20 27 20 27C20 27 26.2541 27 27.8139 26.5812C28.6744 26.3508 29.3521 25.7 29.5821 24.8378C30 23.2749 30 20.0141 30 20.0141C30 20.0141 30 16.7534 29.5821 15.1905ZM17.9545 22.9747V17.0536L23.1818 20.0142L17.9545 22.9747Z" fill="#D3D6D8"/>
                        </svg>                            
                    </button>
                </td>
                <td class="footer-menu">
                        <table class="footer-menu-table">
                            <tr>
                                <th>Sitio</th>
                                <th>Políticas</th>
                                <th>Contacto</th>
                            </tr>
                            <tr>
                                <td><a href="nosotros.html">Nosotros</a></td>
                                <td><a href="priv.html">Aviso de privacidad</a></td>
                                <td><a href="contacto.html">Agendar cita</a></td>
                            </tr>
                            <tr>
                                <td><a href="servicios.html">Servicios</a></td>
                                <td><a href="preguntasFrecuentes.html">Preguntas frecuentes</a></td>
                                <td><a href="internship.php">Internships</a></td>
                            </tr>
                            <tr>
                                <td><a href="sectores.html">Sectores</a></td>
                            </tr>
                            <tr>
                                <td><a href="contacto.php">Contacto</a></td>
                            </tr>
                        </table>
                </td>
            </tr>
        </table>
        <h4 class="rights">Naatik A.I. Solutions (C) Copyright 2021. Todos los derechos reservados</h2>
    </footer>
</body>
</html>
