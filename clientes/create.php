<?php

	$pdo = new PDO('mysql:host=localhost;dbname=2005B_01', 'u2005_01', 'Q$Tcbo%2nW1K', array(
	 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	 	PDO::ATTR_EMULATE_PREPARES => false
	 ));

     $nombreError = null;
     $apellidoError = null;
     $asuntoError = null;
     $mensajeError = null;
     $correoError = null;
     $telefonoError = null;
     $departamentoError = null;

	if (!empty($_POST)) {
		$nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $asunto = $_POST["asunto"];
        $mensaje = $_POST["mensaje"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $departamento = $_POST["departamento"];

		try {
			// Iniciar transaccion
			$pdo->beginTransaction();

			// Subir query a la base de datos
			$sql = "INSERT INTO Contacto (nombre, apellido, asunto, mensaje, correo, telefono, idDepartamento) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array($nombre, $apellido, $asunto, $mensaje, $correo, $telefono, $departamento));

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
	</head>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Agregar un cliente nuevo</h3>
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

                    <div class="control-group <?php echo !empty($asuntoError)?'error':'';?>">
						<label class="control-label">Asunto</label>
					    <div class="controls">
					      	<input name="asunto" type="text"  placeholder="Asunto" value="<?php echo !empty($asunto)?$asunto:'';?>">
					      	<?php if (($asuntoError != null)) ?>
					      		<span class="help-inline"><?php echo $asuntoError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($mensajeError)?'error':'';?>">
						<label class="control-label">Mensaje</label>
					    <div class="controls">
					      	<input name="mensaje" type="text"  placeholder="Mensaje" value="<?php echo !empty($mensaje)?$mensaje:'';?>">
					      	<?php if (($mensajeError != null)) ?>
					      		<span class="help-inline"><?php echo $mensajeError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($correoError)?'error':'';?>">
						<label class="control-label">Correo</label>
					    <div class="controls">
					      	<input name="correo" type="email" value="<?php echo !empty($correo)?$correo:'';?>">
					      	<?php if (($correoError != null)) ?>
					      		<span class="help-inline"><?php echo $correoError;?></span>
					    </div>
					</div>

                    <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
						<label class="control-label">Teléfono</label>
					    <div class="controls">
					      	<input name="telefono" type="number"  value="<?php echo !empty($telefono)?$telefono:'';?>">
					      	<?php if (($telefonoError != null)) ?>
					      		<span class="help-inline"><?php echo $telefonoError;?></span>
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
