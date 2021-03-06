<?php
	require '../database.php';
	$id = -1;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==-1) {
        header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT idDepartamento, nombre
				FROM Departamento
				WHERE idDepartamento = ?;';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href= "../styles/bootstrap.min.css" rel="stylesheet">
	    <script src= "js/bootstrap.min.js"></script>
	</head>

	<body>
    	<div class="container">

    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Detalles del Departamento</h3>
		    	</div>

	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">id</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['idDepartamento'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
                        <label class="control-label">Nombre</label>
					    <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['nombre'];?>
						    </label>
					    </div>
					</div>

				    <div class="form-actions">
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>
