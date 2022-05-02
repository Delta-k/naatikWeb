<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link href="../styles/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Base de datos CLIENTES</h3>

    		</div>

			<div class="row">
				<a class="btn" href="../internos/index.php">Internos</a>
				<a class="btn" href="../departamentos/index.php">Departamentos</a>
			</div>

			<div class="row">


				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>							
							<th>id</th>
		                	<th>Nombre	</th>
		                	<th>Apellido</th>
							<th>Asunto</th>
                        	<th>Fecha</th>
                        	<th>Departamento</th>

		                </tr>
		            </thead>


		            <tbody>
		              	<?php
							include '../database.php';
						 	$pdo = Database::connect();
							$sql = 'SELECT c.idContacto AS id, c.nombre AS nombre, c.apellido AS apellido, 
									c.asunto AS asunto, c.mensaje AS mensaje, c.fecha AS fecha, 
									d.nombre AS departamento  
									FROM Contacto c, Departamento d 
									WHERE c.idDepartamento = d.idDepartamento;';
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
									echo '<td>'. $row['id'] . '</td>';
									echo '<td>'. $row['nombre'] . '</td>';
									echo '<td>'. $row['apellido'] . '</td>';
									echo '<td>'. $row['asunto'] . '</td>';
									echo '<td>'. $row['fecha'] . '</td>';
									echo '<td>'. $row['departamento'] . '</td>';
									echo '<td>';
										echo '<a class="btn" href="read.php?id='.$row['id'].'">Detalles</a>';
										echo '&nbsp;';
										echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Actualizar</a>';
										echo '&nbsp;';
										echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Eliminar</a>';
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
