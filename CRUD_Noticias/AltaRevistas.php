<!DOCTYPE html>

<html lang="es">
	<head>
		<title>Capturar datos en Revista</title>
		<meta charset="UTF-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	</head>
	<body>
		<?php 
			
			//include('index.php');
			include('database.php');
			$clave=$titulo=$texto=$categoria=$tipo="";
			
			$db = new Database();
			$query = $db->connect()->prepare('select max(id) as maximo FROM noticias');
			$query->execute();
			$row = $query->fetch();
			$numero=$row["maximo"];
			$numero++;

			function test_entrada($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$clave = test_entrada($_POST["clave"]);
			  $titulo = test_entrada($_POST["titulo"]);
				$texto = test_entrada($_POST["texto"]);
				$categoria = test_entrada($_POST["categoria"]);
				$tipo = test_entrada($_POST["tipo"]);
				$campos = array();

				if($categoria==""){
				array_push($campos, "Debes elegir una categoría para el Traje!!!");
				}
				
				if($titulo == ""){
					array_push($campos, "El campo titulo no pude estar vacío");
				}

				if($clave == "" || strlen($clave) >= 4){
					array_push($campos, "El campo clave no puede estar vacío, ni tener mas de 3 caracteres.");
				}
				
				if(count($campos) > 0){
					echo "<div class='error'>";
					for($i = 0; $i < count($campos); $i++){
						echo "<li>".$campos[$i]."</i>";
					}
				}else{
					echo "<div class='correcto'>
							Datos correctos";
				}
				echo "</div>";
			}
		?>
		
		<div class="container">
  		<div class="row">
    		<div class="col-4">
					<div class="list-group">
						<a href="menu.php" class="list-group-item list-group-item-action active" aria-current="true">
							Administración de Trajes
						</a>
						<a href="AltaRevistas.php" class="list-group-item list-group-item-action">Agregar traje</a>
						<a href="consultaNoticias.php" class="list-group-item list-group-item-action">Consultar traje</a>
						<a href="cambiosNoticias.php" class="list-group-item list-group-item-action">Modificar traje</a>
						<a href="bajaRevistas.php" class="list-group-item list-group-item-action">Eliminar traje</a>
						<a href="#" class="list-group-item list-group-item-action">Cerrar sesión</a>
					</div>
    		</div>
    		<div class="col-8">
					<form method="POST" 
						autocomplete="on"
						action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Número de registro:</label>
								<input type="text" class="form-control" id="id"  value="<?php echo $numero;?>" name ="id" disabled>
						</div>
						<div class="mb-3">
							<label for="clave" class="form-label">Clave de traje:</label>
								<input type="text" 
								class="form-control" 
								id="clave"  
								value="<?php echo $clave;?>" 
								name ="clave" 
								placeholder="3 caracteres"/>
						</div>

						<div class="mb-3">
							<label for="titulo" class="form-label">Nombre del traje:</label>
								<input type="text" 
								class="form-control" 
								id="titulo"  
								value="<?php echo $titulo;?>" 
								name ="titulo" 
								placeholder="Nombre del Traje">
						</div>

						<div class="mb-3">
								<label for="texto" class="form-label">Descripcion del traje:</label>
								<textarea class="form-control" 
								id="texto" name="texto" 
								rows="3"
								value="<?php echo $texto;?>"></textarea>
						</div>

						<div class="mb-3">
							<label for="fecha" class="form-label">Fecha:</label>
								<input type="date" 
								class="form-control" 
								id="fecha"  
								name ="fecha" 
								value="<?php echo date("Y-m-d");?>">
						</div>
						<div class="mb-3">
							<label for="tipo" class="form-label">Tipo de traje:</label>
							<div class="form-check">
								<input class="form-check-input" 
									type="radio" 
									name="tipo" 
									value="Nuevo" 
									id="tipol"
									<?php 
										if($tipo=="Nuevo") 
											echo "checked" 
									?> checked>Nuevo
									<label class="form-check-label" for="tipol">
										Nuevo
									</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" 
									type="radio" 
									name="tipo"
									value="Semi-Nuevo" 
									id="tipon"
									<?php 
										if($tipo=="Semi-Nuevo") 
											echo "checked" 
									?>>
								<label class="form-check-label" for="tipon">
									Semi-Nuevo
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" 
									type="radio" 
									name="tipo" 
									value="Usado" 
									id="tipoi"
									<?php 
										if($tipo=="Usado") 
											echo "checked" 
									?>>
								<label class="form-check-label" for="tipoi">
								Usado
								</label>
							</div><!--class="form-check"-->	  
						</div><!--class="mb-3"-->
						<div class="mb-3">
							<label for="categoria" class="form-label">Categoría del traje:</label>
							<select class="form-select" aria-label="Default select example" name="categoria" id="categoria">
								<option selected>Selecciona una categoría</option>
								<option value="Ceremonial"
									<?php 
									if($categoria=="Ceremonial") 
										echo "selected" 
									?>>Ceremonial</option>
								<option value="Charro"
									<?php 
									if($categoria=="Charro") 
										echo "selected" 
									?>>Charro</option>
								<option value="Gala"
									<?php 
									if($categoria=="Gala") 
										echo "selected" 
									?>>Gala</option>
							</select>
						</div><!--class="mb-3"-->
						<div class="mb-3">
							<button type="submit" class="btn btn-primary" name ="enviar">Enviar datos.</button>
						</div>
					</form>	
    		</div><!--div class="col-8"-->
    		<div class="col">
    		</div><!--class="col"-->
  		</div><!--class="row"-->
	</div><!--class="container"-->
		<?php
			if (isset($_REQUEST['enviar'])){
				$query = $db->connect()->prepare('SELECT clave FROM noticias WHERE clave = :clave');
				$query->execute(['clave' => $clave]);
				$row = $query->fetch(PDO::FETCH_NUM);
				if($query -> rowCount() <= 0){
					//echo 'entro al if del insert!!!';
					$clave=$_POST['clave'];
					$titulo=$_POST['titulo'];
					$tipo=$_POST['tipo'];
					$texto=$_POST['texto'];
					$fecha =$_POST['fecha'];
					$categoria =$_POST['categoria'];
					$insert="insert into noticias(clave,titulo,tipo,texto,fecha,categoria) values (:clave,:titulo,:tipo,:texto,:fecha,:categoria)";
					$insert = $db->connect()->prepare($insert);
					$insert->bindParam(':clave',$clave,PDO::PARAM_STR, 25);
					$insert->bindParam(':titulo',$titulo,PDO::PARAM_STR, 25);
					$insert->bindParam(':tipo',$tipo,PDO::PARAM_STR,25);
					$insert->bindParam(':texto',$texto,PDO::PARAM_STR,25);
					$insert->bindParam(':fecha',$fecha,PDO::PARAM_STR);
					$insert->bindParam(':categoria',$categoria,PDO::PARAM_STR);
					$insert->execute();
					if (!$query){
						echo "Error:",$sql->errorInfo();
					}
					echo "<br> El Traje FUE DADO	DE ALTA.";
					echo "<br><h2>Datos de entrada:</h2>";
					echo "Clave: ".$_POST['clave'];
					echo "<br>";
					echo "Título: ".$_POST['titulo'];
					echo "<br>";
					echo "Tipo: ".$_REQUEST['tipo'];
					echo "<br>";
					echo "Texto: ".$_REQUEST['texto'];
					echo "<br>";
					echo "Fecha: ".$_REQUEST['fecha'];
					echo "<br>";
					echo "Categoría: ".$_REQUEST['categoria'];
					}else if ($query -> rowCount() > 0){
						echo "<br> YA EXISTE UN TRAJE CON ESA CLAVE.";
					}
					$query->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
					$query = null; // obligado para cerrar la conexión
					$db = null;
			}
		?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>