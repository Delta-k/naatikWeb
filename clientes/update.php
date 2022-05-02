<?php

	require '../database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: index.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
        $idContactoError = null;
        $nombreError = null;
        $apellidoError = null;
        $asuntoError = null;
        $correoError = null;
        $telefonoError = null;
        $mensajeError = null;
        $fechaError = null;
        $idDepartamentoError = null;
		// keep track post values
        $idContacto = $_POST["idContacto"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $asunto = $_POST["asunto"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $mensaje = $_POST["mensaje"];
        $fecha = $_POST["fecha"];
        $idDepartamento   = $_POST["idDepartamento"];

		/// validate input
		$valid = true;

		if (empty($idContacto)) {
			$idContactoError = 'Por favor escribe un id de Contacto';
			$valid = false;
		}

		if (empty($nombre)) {
			$nombreError = 'Por favor escribe un nombre';
			$valid = false;
		}

        if (empty($apellido)) {
			$apellidoError = 'Por favor escribe un apellido';
			$valid = false;
		}

        if (empty($asunto)) {
			$asuntoError = 'Por favor escribe un asunto';
			$valid = false;
		}

        if(empty($correo)) {
            $correoError = "Por favor escribe un correo";
            $valid = false;
        }

        if(empty($telefono)) {
            $telefonoError = "Por favor escribe un telefono";
            $valid = false;
        }

        if(empty($mensaje)) {
            $mensajeError = "Por favor escribe un mensaje";
            $valid = false;
        }

        if(empty($fecha)) {
            $fechaError = "Por favor escribe una fecha";
            $valid = false;
        }

        if(empty($idDepartamento)) {
            $idDepartamentoError = "Por favor escribe un id de departamento";
            $valid = false;
        }

		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Contacto set idContacto = ?, nombre = ?, apellido =?, 
                        asunto = ?, correo = ?, telefono = ?, mensaje = ?, fecha = ?,
                        idDepartamento = ?
                    WHERE idContacto = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($idContacto, $nombre, $apellido, $asunto, $correo, $telefono, $mensaje, $fecha, $idDepartamento, $id));
			Database::disconnect();
			header("Location: index.php");
		}

	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Contacto where idContacto = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        $idContacto = $data["idContacto"];
        $nombre = $data["nombre"];
        $apellido = $data["apellido"];
        $asunto = $data["asunto"];
        $correo = $data["correo"];
        $telefono = $data["telefono"];
        $mensaje = $data["mensaje"];
        $fecha = $data["fecha"];
        $idDepartamento = $data["idDepartamento"];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"../styles/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
    	<div class="container">
    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Actualizar datos de un cliente</h3>
		    	</div>

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="POST">

					  <div class="control-group <?php echo !empty($idContactoError)?'error':'';?>">
					    <label class="control-label">ID</label>
					    <div class="controls">
					      	<input name="idContacto" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($idContactoError)): ?>
					      		<span class="help-inline"><?php echo $idContactoError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (!empty($nombreError)): ?>
					      		<span class="help-inline"><?php echo $nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
                      
                      <div class="control-group <?php echo !empty($apellidoError)?'error':'';?>">
					    <label class="control-label">Apellido</label>
					    <div class="controls">
					      	<input name="apellido" type="text" placeholder="Apellido" value="<?php echo !empty($apellido)?$apellido:'';?>">
					      	<?php if (!empty($apellidoError)): ?>
					      		<span class="help-inline"><?php echo $apellidoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($asuntoError)?'error':'';?>">
					    <label class="control-label">Asunto</label>
					    <div class="controls">
					      	<input name="asunto" type="text" placeholder="Asunto" value="<?php echo !empty($asunto)?$asunto:'';?>">
					      	<?php if (!empty($asuntoError)): ?>
					      		<span class="help-inline"><?php echo $asuntoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
                      
                      <div class="control-group <?php echo !empty($correoError)?'error':'';?>">
					    <label class="control-label">Correo</label>
					    <div class="controls">
					      	<input name="correo" type="email" placeholder="Correo" value="<?php echo !empty($correo)?$correo:'';?>">
					      	<?php if (!empty($correoError)): ?>
					      		<span class="help-inline"><?php echo $correoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
					    <label class="control-label">Teléfono</label>
					    <div class="controls">
					      	<input name="telefono" type="number" placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
					      	<?php if (!empty($telefonoError)): ?>
					      		<span class="help-inline"><?php echo $telefonoError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($mensajeError)?'error':'';?>">
					    <label class="control-label">Mensaje</label>
					    <div class="controls">
					      	<input name="mensaje" type="text" placeholder="Mensaje" value="<?php echo !empty($mensaje)?$mensaje:'';?>">
					      	<?php if (!empty($mensajeError)): ?>
					      		<span class="help-inline"><?php echo $mensajeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($fechaError)?'error':'';?>">
					    <label class="control-label">Fecha</label>
					    <div class="controls">
					      	<input name="fecha" type="datetime" placeholder="Fecha" value="<?php echo !empty($fecha)?$fecha:'';?>">
					      	<?php if (!empty($fechaError)): ?>
					      		<span class="help-inline"><?php echo $fechaError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
                      
						<div class="control-group <?php echo !empty($idDepartamentoError)?'error':'';?>">
					    	<label class="control-label">Departamento</label>
					    	<div class="controls">
                            	<select name ="idDepartamento">
                                    <option value="">Selecciona un departamento</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM Departamento';
	 				   						foreach ($pdo->query($query) as $row) {
	 				   							if ($row['idDepartamento']==$idDepartamento)
                        	   						echo "<option selected value='" . $row['idDepartamento'] . "'>" . $row['nombre'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['idDepartamento'] . "'>" . $row['nombre'] . "</option>";
					   						}
					   						Database::disconnect();
					  					?>

                                </select>
					      	<?php if (!empty($idDepartamentoError)): ?>
					      		<span class="help-inline"><?php echo $idDepartamentoError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
