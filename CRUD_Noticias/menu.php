<!DOCTYPE html> 
<html lang="es">
	<head>
		<title>Administración de Noticias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	</head>
	<body>
		<?php
			//include('index.php');
			include('database.php');
		?>

<div class="container">
    <div class="row">
      <div class="col-md-4">
	  <div class="list-group">
  <a href="menu.php" class="list-group-item list-group-item-action active" aria-current="true">
  Administración de Trajes
  </a>
  <a href="AltaRevistas.php" class="list-group-item list-group-item-action">Agregar Traje</a>
  <a href="consultaNoticias.php" class="list-group-item list-group-item-action">Consultar Traje</a>
  <a href="cambiosNoticias.php" class="list-group-item list-group-item-action">Modificar Traje</a>
  <a href="bajaRevistas.php" class="list-group-item list-group-item-action">Eliminar Traje</a>
  <a href="../cerrar.php" class="list-group-item list-group-item-action">Cerrar sesión</a>
</div>
      </div>
	  <div class="col-8">
	  <label class="form-label">LISTADO DE TRAJES REGISTRADOS</label>
		<?php
			$db = new Database();
			$query = $db->connect()->prepare('select * FROM rentas order by clave desc');
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$query->execute();
				//$row = $query->fetch();
				if($query -> rowCount() > 0){
					print ("<hr/>");
					print ("<table class='table table-striped'>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>Id</th>\n");
						print ("<th>Clave</th>\n");
						print ("<th>Título</th>\n");
						print ("<th>Texto</th>\n");
						print ("<th>Fecha</th>\n");
						print ("<th>Categoría</th>\n");
						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						print ("<tr>\n");
						print ("<td>" . $row['id'] . "</td>\n");
						print ("<td>" . $row['clave'] . "</td>\n");
						print ("<td>" . $row['titulo'] . "</td>\n");
						print ("<td>" . $row['texto'] . "</td>\n");
						print ("<td>" . $row['fecha'] . "</td>\n");
						print ("<td>" . $row['categoria'] . "</td>\n");
						print ("</tr>\n");
					}
					print ("</table>\n");
					print ("<form method='POST' action='Reportes_PDF/reportes.php'>"); 
					print ("<button type='submit' class='btn btn-primary'>Genera reporte</button>");
					print ("</form>"); 
				}
				else
					print ("No hay registros disponibles");
		?>
	  </div><!--class="col-8"-->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>
