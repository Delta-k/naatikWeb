<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link href="styles/bootstrap.min.css" rel="stylesheet">
	    <script src="bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Base de datos CLIENTES</h3>
    		</div>

			<div class="row">


				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>							
							<th>idContacto</th>
		                	<th>Nombre	</th>
		                	<th>Apellido</th>
							<th>Telefono</th>
							<th>Correo</th>
							<th>Asunto</th>
							<th>Mensaje </th>
                        	<th>Fecha</th>
                        	<th>idDepartamento</th>

		                </tr>
		            </thead>

					
					

		            <tbody>
		              	<?php
							include 'database.php';
						 	$pdo = Database::connect();
							$sql = 'SELECT c.idContacto AS id, c.nombre AS nombre, c.apellido AS apellido, c.telefono AS telefono, c.correo AS correo, 
									c.asunto AS asunto, c.mensaje AS mensaje, c.fecha AS fecha, d.nombre AS departamento  
									FROM contacto c, departamento d 
									WHERE c.idDepartamento = d.idDepartamento;';
							foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
									echo '<td>'. $row['id'] . '</td>';
									echo '<td>'. $row['nombre'] . '</td>';
									echo '<td>'. $row['apellido'] . '</td>';
									echo '<td>'. $row['telefono'] . '</td>';
									echo '<td>'. $row['correo'] . '</td>';
									echo '<td>'. $row['asunto'] . '</td>';
									echo '<td>'. $row['mensaje'] . '</td>';
									echo '<td>'. $row['fecha'] . '</td>';
									echo '<td>'. $row['departamento'] . '</td>';
									echo '<td>';
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
