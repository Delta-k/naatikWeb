<?php

	// $pdo = new PDO('mysql:host=localhost;dbname=2005B_01', 'u2005_01', 'Q$Tcbo%2nW1K', array(
	// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	// 	PDO::ATTR_EMULATE_PREPARES => false
	// ));
	// $nombreError = NULL
	// $nombre = NULL;

	// if (!empty($_POST)) {
	// 	$nombre = $_POST["nombre"];

	// 	try {
	// 		// Iniciar transaccion
	// 		$pdo->beginTransaction();

	// 		// Subir query a la base de datos
	// 		$sql = "INSERT INTO Departamento (nombre) VALUES (?)";
	// 		$stmt = $pdo->prepare($sql);
	// 		$stmt->execute(array($nombre));

	// 		// Comprometer los cambios
	// 		$pdo->commit();

	// 		header('Location: index.php');
	// 		die();
	// 	}

	// 	catch(Exception $e){
	// 		// Mostrar el mensaje de error
	// 		echo $e->getMessage();
	// 		// Retirar los cambios
	// 		$pdo->rollBack();
	// 	}
	// }
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
