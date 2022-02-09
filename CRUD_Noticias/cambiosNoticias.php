<!DOCTYPE html>
<html lang="es">
  <head>
     <title>Cambio en los datos de las Trajes</title>
	 <meta charset="utf-8">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	 </head>
	 <body>
		<?php
			//include('index.php');
			include('database.php');
			$db = new Database();
			$clave="";
			function test_entrada($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$clave = test_entrada($_POST["clave"]);
			}
		?>
		<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="container">
				<div class="row">
				<div class="col-4">
				<div class="list-group">
					<a href="menu.php" class="list-group-item list-group-item-action active" aria-current="true">
					Administración de Trajes
					</a>
					<a href="AltaRevistas.php" class="list-group-item list-group-item-action">Agregar Traje</a>
					<a href="consultaNoticias.php" class="list-group-item list-group-item-action">Consultar Traje</a>
					<a href="cambiosNoticias.php" class="list-group-item list-group-item-action">Modificar Traje</a>
					<a href="bajaRevistas.php" class="list-group-item list-group-item-action">Eliminar Traje</a>
					<a href="#" class="list-group-item list-group-item-action">Cerrar sesión</a>
				</div>
    		</div>
					<div class="col-8">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Clave del traje a modificar:</label>
							<input type="text" class="form-control" id="clave"  name="clave" value="<?php echo $clave;?>">
						</div>
						<div class="mb-3">
							<input type="submit" class="btn btn-primary" name ="buscar" id="buscar" value="Buscar clave!!!"/>
						</div>
			<?php
				if(isset($_REQUEST['buscar'])){
					$clave=isset($_REQUEST['clave']) ? $_REQUEST['clave'] : null;

					$query = $db->connect()->prepare('select * FROM noticias where clave = :clave');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['clave' => $clave]);
								$row = $query->fetch();
								if($query -> rowCount() > 0){

							$isCheckedL = $row['tipo'] == 'Local' ? 'checked' : '';
							$isCheckedN = $row['tipo'] == 'Nacional' ? 'checked' : '';
							$isCheckedI = $row['tipo'] == 'Internacional' ? 'checked' : '';
							echo
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Clave del traje a modificar:</label>
									<input type="text" class="form-control" value="'.$row['clave'].'" disabled/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Título del Traje:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="titulo" value ="'.$row['titulo'].'"/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Texto del Traje:</label>
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
									<label for="exampleFormControlInput1" class="form-label">Tipo de Traje:</label>
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Local"'.$isCheckedL.' />Local
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Nacional"'.$isCheckedN.' />Nacional
									<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Internacional"'.$isCheckedI.' />Internacional
								</div>'.
								'<div class="mb-3">
									<button type="submit" class="btn btn-primary" name="cambiar">Cambiar datos</button>
								</div>';
						}else if ($query -> rowCount() <= 0){
							echo "no existe esa clave de Traje.";
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

					/*
					$consulta= 'update noticias set clave= : clave, titulo = :titulo, texto = :texto, fecha = :fecha, categoria = :categoria, tipo = :tipo where clave = :clave';
					$consulta = $db->connect()->prepare($consulta);
					$consulta->bindParam(':clave',$clave,PDO::PARAM_STR, 25);
					$consulta->bindParam(':titulo',$titulo,PDO::PARAM_STR, 25);
					$consulta->bindParam(':tipo',$tipo,PDO::PARAM_STR,25);
					$consulta->bindParam(':texto',$texto,PDO::PARAM_STR,25);
					$consulta->bindParam(':fecha',$fecha,PDO::PARAM_STR);
					$consulta->bindParam(':categoria',$categoria,PDO::PARAM_STR);
					$consulta->execute();
					*/
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
				}//boton cambiar
				//mysqli_close($conexion);
			?>
		</form><!--El form cierra hasta aquí por que los datos del reg.
				son parte del formulario-->
				</div> <!--class="col-8"-->
					<div class="col">
					</div>
				</div><!--class="row"-->
			</div><!--class="container"-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>