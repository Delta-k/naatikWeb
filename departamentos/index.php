<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link href="../styles/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Base de datos DEPARTAMENTOS</h3>

    		</div>

			<div class="row">
				<a href="create.php" class="btn btn-success">Agregar un Departamento</a>
				<a class="btn" href="../clientes/index.php">Clientes</a>
				<a class="btn" href="../internos/index.php">Internos</a>
			</div>

			<div class="row">


				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>							
							<th>id</th>
		                	<th>Nombre	</th>
		                </tr>
		            </thead>


		            <tbody>
		              	<?php
							include '../database.php';
						 	$pdo = Database::connect();
							$sql = 'SELECT idDepartamento, nombre 
									FROM Departamento;';
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
									echo '<td>'. $row['idDepartamento'] . '</td>';
									echo '<td>'. $row['nombre'] . '</td>';
									echo '<td>';
										echo '<a class="btn" href="read.php?id='.$row['idDepartamento'].'">Detalles</a>';
										echo '&nbsp;';
										echo '<a class="btn btn-success" href="update.php?id='.$row['idDepartamento'].'">Actualizar</a>';
										echo '&nbsp;';
										echo '<a class="btn btn-danger" href="delete.php?id='.$row['idDepartamento'].'">Eliminar</a>';
									echo '</td>';
								echo '</tr>';
							}
							Database::disconnect();
					  	?>
				    </tbody>
	            </table>

	    	</div>


			
	    </div> <!-- /container -->
	</body>
</html>
