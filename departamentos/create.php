<?php

	require '../database.php';

    $nombreError = null;


	if ( !empty($_POST)) {

		// keep track post values
		$nombre = $_POST['nombre'];

		// validate input
		$valid = true;

		if (empty($nombre)) {
			$nombre = 'Por favor escribe un nombre para el nuevo departamento';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Departamento (nombre) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nombre));
			Database::disconnect();
			header("Location: index.php");
		}
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


					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
