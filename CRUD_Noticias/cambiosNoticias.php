<!DOCTYPE html>
<html lang="es">
  <head>
     <title>Cambio en los datos de las Trajes</title>
	 <meta charset="utf-8">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	 <link rel="icon" href="img/D' Gabbiani.png">
	 <link rel="stylesheet" href="css/main.css">
	</head>
	 <body>


		<?php
			//include('index.php');
			include('./database.php');
			$db = new Database();
			$folio="";

			function test_entrada($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$folio = test_entrada($_POST["folio"]);
			}
		?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<img src="img/D' Gabbiani.png" alt="logo" width="55px">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="./AltaRevistas.php">Estado de Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./consultaNoticias.php">Consultar Traje</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" disabled>Modificar Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./bajaRevistas.php">Eliminar Traje</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Fin de navbar -->
	
	<section>
		<div class="contact1">
			<div class="container-contact1">
				<div class="contact1-pic js-tilt" data-tilt>
					<img src="img/modificar.png" alt="IMG">
				</div>
				
				<form class="contact1-form validate-form" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<span class="contact1-form-title">
						Modificar Renta
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="folio" placeholder="Folio de renta a modificar">
						<span class="shadow-input1"></span>
					</div>

                    <div class="container-contact1-form-btn">
						<button class="contact1-form-btn" type="submit" name ="buscar" id="buscar" value="Buscar folio">
							<span>
								Buscar Clave
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>

					<!-- php -->
					<?php
				if(isset($_REQUEST['buscar'])){
					$clave=isset($_REQUEST['folio']) ? $_REQUEST['folio'] : null;

					$query = $db->connect()->prepare('select * FROM rentas where folio = :folio');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['folio' => $folio]);
								$row = $query->fetch();
								if($query -> rowCount() > 0){

							
							echo
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Folio:</label>
									<input type="text" class="form-control" value="'.$row['folio'].'" disabled/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Cliente:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="titulo" value ="'.$row['nombre_cliente'].'"/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Texto de la noticia:</label>
									<textarea class="form-control" name="texto" rows="5" cols="40">'.$row['texto'].'</textarea>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Fecha de publicación:</label>
									<input type="date" class="form-control" name="fecha" value ="'.$row['fecha'].'">
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Categoría:</label>
									<select class="form-select" aria-label="Default select example" name="categoria" id="categoria">
										<option value="'.$row['categoria'].'">'.$row['categoria'].'</option>
										 <option value="Clasificado">Clasificado</option>
										 <option value="Deportes">Deportes</option>
										 <option value="Policiaco">Policiaco</option>
										 <option value="Principal">Principal</option>
									</select>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Tipo de noticias:</label>
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Local"'.$isCheckedL.' />Local
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Nacional"'.$isCheckedN.' />Nacional
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Internacional"'.$isCheckedI.' />Internacional
								</div>'.
								'<div class="mb-3">
									<button type="submit" class="btn btn-primary" name="cambiar">Cambiar datos</button>
								</div>';
						}else if ($query -> rowCount() <= 0){
							echo "no existe esa clave de Noticia.";
						}		 
				}//if(isset($_REQUEST[''buscar]))
				
				if(isset($_REQUEST['cambiar'])){ 

					$clave=$_POST['clave'];
					$titulo=$_POST['titulo'];
					$tipo=$_POST['tipo'];
					$texto=$_POST['texto'];
					$fecha =$_POST['fecha'];
					$categoria =$_POST['categoria'];
					
					$sql = "UPDATE noticias SET clave=?, titulo=?, texto=?, fecha=?, categoria=?, tipo=? WHERE clave=?";
					$stmt= $db->connect()->prepare($sql);
					$stmt->execute([$clave, $titulo, $texto, $fecha, $categoria, $tipo, $clave]);

					
					$row = $stmt->fetch();
					if($stmt->rowCount() > 0){
						echo"<br/><br/>Los datos fueron modificados con exito";
						print ("<br/><br/><hr/><br/>");
						print ("<table class='table table-striped'>\n");
							print ("<tr>\n");
								print ("<th>Clave</th>\n");
								print ("<td>" . $clave . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Título</th>\n");
								print ("<td>" . $_REQUEST['titulo'] . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Texto</th>\n");
								print ("<td>" . $texto . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Categoría</th>\n");
								print ("<td>" . $categoria . "</td>\n");
								//$variable = utf8_decode($variable);
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Fecha</th>\n");
								print ("<td>" .$fecha. "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Tipo</th>\n");
								print ("<td>" .$tipo. "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
						print ("</table>\n");
						print ("<br /><hr />");
					}else if ($consulta->rowCount()<=  0){
						echo "No se actualizó el registro!!!";
					}
				}
			?>
			<!-- php -->
				</form>
			</div>
		</div>
	</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>