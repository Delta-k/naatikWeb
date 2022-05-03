<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link href="../styles/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Base de datos INTERNOS</h3>

    		</div>

			<div class="row">
				<a href="create.php" class="btn btn-success">Agregar un Intern</a>
				<a class="btn" href="../clientes/index.php">Clientes</a>
				<a class="btn" href="../departamentos/index.php">Departamentos</a>
			</div>

			<div class="row">


				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>							
							<th>id</th>
		                	<th>Nombre	</th>
		                	<th>Apellido</th>
							<th>Carrera</th>
                        	<th>Promedio</th>
                            <th>Fecha</th>
                        	<th>Departamento</th>

		                </tr>
		            </thead>


		            <tbody>
		              	<?php
							include '../database.php';
						 	$pdo = Database::connect();
							$sql = 'SELECT i.idIntern AS id, i.nombre AS nombre, i.apellido AS apellido, 
									i.carrera AS carrera, i.promedio AS promedio, i.fecha AS fecha, 
									d.nombre AS departamento  
									FROM Intern i, Departamento d 
									WHERE i.idDepartamento = d.idDepartamento
                                    ORDER BY idIntern;';
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
									echo '<td>'. $row['id'] . '</td>';
									echo '<td>'. $row['nombre'] . '</td>';
									echo '<td>'. $row['apellido'] . '</td>';
									echo '<td>'. $row['carrera'] . '</td>';
                                    echo '<td>'. $row['promedio'] . '</td>';
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
