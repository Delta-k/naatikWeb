<?php

	$pdo = new PDO('mysql:host=localhost;dbname=2005B_01', 'u2005_01', 'Q$Tcbo%2nW1K', array(
	 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	 	PDO::ATTR_EMULATE_PREPARES => false
	 ));

     $nombreError = null;
     $apellidoError = null;
     $universidadError = null;
     $carreraError = null;
     $semestreError = null;
     $promedioError = null;
     $departamentoError = null;

	if (!empty($_POST)) {
		$nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $universidad = $_POST["universidad"];
        $carrera = $_POST["carrera"];
        $semestre = $_POST["semestre"];
        $promedio = $_POST["promedio"];
        $departamento = $_POST["departamento"];

		try {
			// Iniciar transaccion
			$pdo->beginTransaction();

			// Subir query a la base de datos
			$sql = "INSERT INTO Intern (nombre, apellido, universidad, carrera, semestre, promedio, idDepartamento) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array($nombre, $apellido, $universidad, $carrera, $semestre, $promedio, $departamento));

			// Comprometer los cambios
			$pdo->commit();

			header('Location: index.php');
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
	    <meta charset="utf-8">
	    <link href=	"../styles/bootstrap.min.css" rel="stylesheet">
		<link rel="icon" href="img/logo-naatik-3.png">
	</head>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Agregar un departamento nuevo</h3>
		   		</div>

				<form class="form-horizontal" action="create.php" method="post">

					<div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
						<label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="nombre" type="text"  placeholder="nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (($nombreError != null)) ?>
					      		<span class="help-inline"><?php echo $nombreError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($apellidoError)?'error':'';?>">
						<label class="control-label">Apellido</label>
					    <div class="controls">
					      	<input name="apellido" type="text"  placeholder="apellido" value="<?php echo !empty($apellido)?$apellido:'';?>">
					      	<?php if (($apellidoError != null)) ?>
					      		<span class="help-inline"><?php echo $apellidoError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($universidadError)?'error':'';?>">
						<label class="control-label">Universidad</label>
					    <div class="controls">
					      	<input name="universidad" type="text"  placeholder="Universidad" value="<?php echo !empty($universidad)?$universidad:'';?>">
					      	<?php if (($universidadError != null)) ?>
					      		<span class="help-inline"><?php echo $universidadError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($carreraError)?'error':'';?>">
						<label class="control-label">Carrera</label>
					    <div class="controls">
					      	<input name="carrera" type="text"  placeholder="Carrera" value="<?php echo !empty($carrera)?$carrera:'';?>">
					      	<?php if (($carreraError != null)) ?>
					      		<span class="help-inline"><?php echo $carreraError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($semestreError)?'error':'';?>">
						<label class="control-label">Semestre</label>
					    <div class="controls">
					      	<input name="semestre" type="number" min="1" max="12" step="1"  placeholder="1-12" value="<?php echo !empty($semestre)?$semestre:'';?>">
					      	<?php if (($semestreError != null)) ?>
					      		<span class="help-inline"><?php echo $semestreError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($promedioError)?'error':'';?>">
						<label class="control-label">Promedio</label>
					    <div class="controls">
					      	<input name="promedio" type="number" min="0" max="100" step="1"  placeholder="1-100" value="<?php echo !empty($promedio)?$promedio:'';?>">
					      	<?php if (($promedioError != null)) ?>
					      		<span class="help-inline"><?php echo $promedioError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($departamentoError)?'error':'';?>">
                        <label class="control-label">Departamento</label>
                        <div class="controls">
                            <select name="departamento" id="departamento">
                                <option value="" disabled selected>Seleccione una opción...</option>
                                <?php
                                    $query = 'SELECT * FROM Departamento';
                                    foreach ($pdo->query($query) as $row) {
                                        if ($row['nombre'] == $departamento)
                                            echo "<option value = '" . $row['idDepartamento'] . "'>" . $row["nombre"] . "</option>";
                                        else
                                            echo "<option value = " . $row["idDepartamento"] . ">" . $row["nombre"] . "</option>";
                                    }
                                ?>
                            </select>
                            <?php if (($departamentoError != null)) ?>
					      		<span class="help-inline"><?php echo $departamentoError;?></span>
                        </div>
                    </div>


					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
