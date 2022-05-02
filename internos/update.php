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
        $idInternError = null;
        $nombreError = null;
        $apellidoError = null;
        $universidadError = null;
        $carreraError = null;
        $semestreError = null;
        $promedioError = null;
        $fechaError = null;
        $idDepartamentoError = null;
		// keep track post values
        $idIntern = $_POST["idIntern"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $universidad = $_POST["universidad"];
        $carrera = $_POST["carrera"];
        $semestre = $_POST["semestre"];
        $promedio = $_POST["promedio"];
        $fecha = $_POST["fecha"];
        $idDepartamento   = $_POST["idDepartamento"];

		/// validate input
		$valid = true;

		if (empty($idIntern)) {
			$idInternError = 'Por favor escribe un id de Interno';
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

        if (empty($universidad)) {
			$universidadError = 'Por favor escribe una universidad';
			$valid = false;
		}

        if(empty($carrera)) {
            $carreraError = "Por favor escribe una carrera";
            $valid = false;
        }

        if(empty($semestre)) {
            $semestreError = "Por favor escribe un semestre";
            $valid = false;
        }

        if(empty($promedio)) {
            $promedioError = "Por favor escribe un promedio";
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
			$sql = "UPDATE Intern SET idIntern = ?, nombre = ?, apellido =?, 
                        universidad = ?, carrera = ?, semestre = ?, promedio = ?, 
                        fecha = ?, idDepartamento = ?
                    WHERE idIntern = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($idIntern, $nombre, $apellido, $universidad, $carrera, 
                                $semestre, $promedio, $fecha, $idDepartamento, $id));
			Database::disconnect();
			header("Location: index.php");
		}

	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Intern where idIntern = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        $idIntern = $data["idIntern"];
        $nombre = $data["nombre"];
        $apellido = $data["apellido"];
        $universidad = $data["universidad"];
        $carrera = $data["carrera"];
        $semestre = $data["semestre"];
        $promedio = $data["promedio"];
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
		    		<h3>Actualizar datos de un interno</h3>
		    	</div>

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="POST">

					  <div class="control-group <?php echo !empty($idInternError)?'error':'';?>">
					    <label class="control-label">ID</label>
					    <div class="controls">
					      	<input name="idIntern" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($idInternError)): ?>
					      		<span class="help-inline"><?php echo $idInternError;?></span>
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

                      <div class="control-group <?php echo !empty($universidadError)?'error':'';?>">
					    <label class="control-label">Universidad</label>
					    <div class="controls">
					      	<input name="universidad" type="text" placeholder="Universidad" value="<?php echo !empty($universidad)?$universidad:'';?>">
					      	<?php if (!empty($universidadError)): ?>
					      		<span class="help-inline"><?php echo $universidadError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
                      
                      <div class="control-group <?php echo !empty($carreraError)?'error':'';?>">
					    <label class="control-label">Carrera</label>
					    <div class="controls">
					      	<input name="carrera" type="text" placeholder="Carrera" value="<?php echo !empty($carrera)?$carrera:'';?>">
					      	<?php if (!empty($carreraError)): ?>
					      		<span class="help-inline"><?php echo $carreraError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($semestreError)?'error':'';?>">
					    <label class="control-label">Semestre</label>
					    <div class="controls">
					      	<input name="semestre" type="number" placeholder="Semestre" value="<?php echo !empty($semestre)?$semestre:'';?>">
					      	<?php if (!empty($semestreError)): ?>
					      		<span class="help-inline"><?php echo $semestreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($promedioError)?'error':'';?>">
					    <label class="control-label">Promedio</label>
					    <div class="controls">
					      	<input name="promedio" type="number" placeholder="Promedio" value="<?php echo !empty($promedio)?$promedio:'';?>">
					      	<?php if (!empty($promedioError)): ?>
					      		<span class="help-inline"><?php echo $promedioError;?></span>
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
