<?php
	require '../database.php';
	$id = 0;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "DELETE FROM Contacto WHERE idDepartamento = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));

		$sql = "DELETE FROM Intern WHERE idDepartamento = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));

		$sql = "DELETE FROM Departamento WHERE idDepartamento = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
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
			    	<h3>Eliminar un departamento</h3>
			    </div>

			    <form class="form-horizontal" action="delete.php" method="POST">
		    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-error">¿Estás seguro que quieres eliminar este departamento?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Si</button>
						<a class="btn" href="index.php">No</a>
					</div>
				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
