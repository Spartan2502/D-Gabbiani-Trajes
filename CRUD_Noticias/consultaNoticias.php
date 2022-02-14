<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Consulta de Trajes.</title>
		<meta charset="utf-8">
		<link rel="icon" href="img/D' Gabbiani.png">
		<link rel="stylesheet" href="css/main.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	</head>
	<body>
		<?php
			//include('index.php');
			include('database.php');
			$folio="";
		?>	
	<!-- Navbar -->
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<img src="img/D' Gabbiani.png" alt="logo" width="55px">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav" style="justify-content: space-between;">
				<div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link"  href="./AltaRevistas.php">Estado de Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="">Consultar Traje</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./cambiosNoticias.php">Modificar Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./bajaRevistas.php">Eliminar Traje</a>
					</li>
					
				</ul>
				</div>
				<div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="./menu.php">Volver</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../cerrar.php">Cerrar sesión</a>
					</li>
				</ul>
				</div>
			</div>
		</div>
	</nav>
	
	<!-- Fin de navbar -->
	
	<section>
		<div class="contact1">
			<div class="container-contact1">
				<div class="contact1-pic js-tilt" data-tilt>
					<img src="img/consultar.png" alt="IMG">
				</div>
				
				<form class="contact1-form validate-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<span class="contact1-form-title">
						Consultar Traje
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="folio" id="folio" placeholder="ingresa el folio a buscar">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn"  type="submit" name="buscar" id="buscar" value="Consultar una noticia">
							<span>
								Consultar Traje
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>

                    <div class="mt-4"></div>
                    <div class="container-contact1-form-btn">
						<button class="contact1-form-btn" type="submit" id="todo" name="todo" value="Mostrar todas las noticias">
							<span>
								Mostrar Todo
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</form>

				<!-- php  -->
				<?php
					$db = new Database();
			if (isset($_REQUEST['buscar'])){
				//echo "Si entro a buscar una clave!!!";
				$folio=isset($_REQUEST['folio']) ? $_REQUEST['folio'] :  null;

				$query = $db->connect()->prepare('select * FROM rentas where folio = :folio');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['folio' => $folio]);
								$row = $query->fetch();
								if($query -> rowCount() <= 0){
									echo "<br /><br /><h2>No existe ese número de clave.</h2>";
								}elseif ($query -> rowCount() > 0){
									print ("<br/><br/><br/>");
									print ("Datos del registro.");
									print ("<br/><br/><hr/><br/>");
									print ("<table class='table table-striped'>\n");
										print ("<tr>\n");
											print ("<th>Id</th>\n");
											print ("<td>".$row['folio']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Cliente</th>\n");
											print ("<td>" . $row['nombre_cliente'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Descripcion</th>\n");
											print ("<td>" . $row['descripcion'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>fecha apartado</th>\n");
											print ("<td>" . $row['fecha_apartado'] . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>fecha entrega</th>\n");
											print ("<td>" .$row['fecha_entrega']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>estado renta</th>\n");
											print ("<td>" . $row['estado_renta'] . "</td>\n");
										print ("</tr>\n");
									print ("</table>\n");
									print ("<br /><hr />");
				} 
			}
			if (isset($_REQUEST['todo'])){

				$query = $db->connect()->prepare('select * FROM rentas order by folio desc');
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$query->execute();
				//$row = $query->fetch();
				if($query -> rowCount() > 0){
					print ("<br/><br/><br/>");
					print ("Listado de noticias registradas.");
					print ("<br/><br/><hr/><br/>");
					print ("<table class='table table-striped'>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>folio</th>\n");
						print ("<th>cliente</th>\n");
						print ("<th>descripcion</th>\n");
						print ("<th>fecha apartado</th>\n");
						print ("<th>fecha entrega</th>\n");
						print ("<th>estado renta</th>\n");
						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						print ("<tr>\n");
						print ("<td>" . $row['folio'] . "</td>\n");
						print ("<td>" . $row['nombre_cliente'] . "</td>\n");
						print ("<td>" . $row['descripcion'] . "</td>\n");
						print ("<td>" . $row['fecha_apartado'] . "</td>\n");
						print ("<td>" . $row['fecha_entrega'] . "</td>\n");
						print ("<td>" . $row['estado_renta'] . "</td>\n");
						print ("</tr>\n");
					}
					print ("</table>\n");
				}
				else
					print ("No hay registros disponibles");
			}
			//mysqli_close($conexion);
		?>
				<!-- php -->
			</div>
		</div>
	</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>
