<?php
	require '../database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT i.idIntern AS idIntern, i.nombre AS nombre, i.apellido AS apellido, 
				i.universidad AS universidad, i.carrera AS carrera, i.semestre AS semestre, 
                i.promedio AS promedio, i.fecha AS fecha, d.nombre AS departamento
				FROM Intern i, Departamento d 
				WHERE i.idDepartamento = d.idDepartamento AND idIntern = ?;';
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
		    		<h3>Detalles del Interno</h3>
		    	</div>

	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">id</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['idIntern'];?>
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
                    
                
					<div class="control-group">
					    <label class="control-label">Apellido</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['apellido'];?>
						    </label>
					    </div>
					</div>


					<div class="control-group">
						<label class="control-label">Universidad</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['universidad'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Carrera</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['carrera'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Semestre</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['semestre'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Promedio</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['promedio'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Fecha</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['fecha'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Departamento</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['departamento'];?>
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
