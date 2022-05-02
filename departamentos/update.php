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
        $idDepartamentoError = null;
        $nombreError = null;
		// keep track post values
        $idDepartamento = $_POST["idDepartamento"];
        $nombre = $_POST["nombre"];

		/// validate input
		$valid = true;

        if(empty($idDepartamento)) {
            $idDepartamentoError = "Por favor escribe un id de departamento";
            $valid = false;
        }

		if (empty($nombre)) {
			$nombreError = 'Por favor escribe un nombre';
			$valid = false;
		}


		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Departamento SET idDepartamento = ?, nombre = ?
                    WHERE idDepartamento = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($idDepartamento, $nombre, $id));
			Database::disconnect();
			header("Location: index.php");
		}

	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Departamento where idDepartamento = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        $idDepartamento = $data["idDepartamento"];
        $nombre = $data["nombre"];
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
		    		<h3>Actualizar datos de un departamento</h3>
		    	</div>

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="POST">

                        <div class="control-group <?php echo !empty($idDepartamentoError)?'error':'';?>">
                            <label class="control-label">Departamento</label>
                            <div class="controls">
                                <input name="idDepartamento" type="number" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
                                <?php if (!empty($idDepartamentoError)): ?>
                                    <span class="help-inline"><?php echo $idDepartamentoError;?></span>
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
                            

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
