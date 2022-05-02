<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link href="bootstrap.min.css" rel="stylesheet">
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
                            <th>Universidad</th>
							<th>Carrera</th>
							<th>Semestre </th>
		                	<th>Nombre	</th>
		                	<th>Apellido</th>
							<th>Promedio</th>
                            <th>Fecha</th>
                            <th>idIntern</th>
                            <th>idDepartamento</th>
							

		                </tr>
		            </thead>

					
					

		            <tbody>
		              	<?php
					   	include 'database.php';
					   	$pdo = Database::connect();
					   	$sql = 'SELECT i.idIntern AS id,i.universidad AS universidad,i.carrera AS carrera,i.semestre AS semestre ,i.nombre AS nombre, i.apellido AS apellido, i.promedio AS promedio,d.nombre AS departamento
                                FROM Intern i, Departamento d 
                                WHERE i.idDepartamento = d.idDepartamento';
	 				   	foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
    					   	echo '<td>'. $row['nombreAlumno'] . '</td>';
    					  	echo '<td>'. $row['apellido'] . '</td>';
    					  	echo '<td>'. $row['semestre'] . '</td>';
    					  	echo '<td>'. $row['ca.carrera'] . '</td>';
    					  	echo '<td>'. $row['c.nombre'] . '</td>';

                            echo '<td>';    echo ($row['restriccionesAlimenticias'])?"SI":"NO"; echo'</td>';
                            echo '<td width=250>';
    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['idAlumno'].'">Actualizar</a>';
    					   	echo '&nbsp;';
    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['idAlumno'].'">Eliminar</a>';
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
