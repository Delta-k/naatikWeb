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
		$sql = 'SELECT c.idContacto AS idContacto, c.nombre AS nombre, c.apellido AS apellido, 
				c.asunto AS asunto, c.correo AS correo, c.telefono AS telefono, 
                c.mensaje AS mensaje, c.fecha AS fecha, d.nombre AS departamento
				FROM Contacto c, Departamento d 
				WHERE c.idDepartamento = d.idDepartamento AND idContacto = ?;';
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
		    		<h3>Detalles del contacto</h3>
		    	</div>

	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">id</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['idContacto'];?>
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
					    <label class="control-label">apellido</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['apellido'];?>
						    </label>
					    </div>
					</div>


					<div class="control-group">
						<label class="control-label">Asunto</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['asunto'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Mensaje</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['mensaje'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Correo</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['correo'];?>
						    </label>
					    </div>
					</div>

                    <div class="control-group">
						<label class="control-label">Teléfono</label>
					    <div class="controls">
					      	<label class="checkbox">
						    	<?php echo $data['telefono'];?>
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
