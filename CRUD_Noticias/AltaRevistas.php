<!DOCTYPE html>

<html lang="es">
	<head>
		<title>Capturar datos en Revista</title>
		<meta charset="UTF-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">
		<link rel="icon" href="img/D' Gabbiani.png">
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
		
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<img src="img/D' Gabbiani.png" alt="logo" width="55px">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Estado de Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./consultaNoticias.php">Consultar Traje</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./cambiosNoticias.php">Modificar Renta</a>
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
					<img src="img/agregar.png" alt="IMG">
				</div>
				
				<form class="contact1-form validate-form">
					<span class="contact1-form-title">
						Agregar Renta
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="number" placeholder="Folio">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "date is required">
						<input class="input1" type="text" name="date" placeholder="Fecha de apartado">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Name is required">
						<input class="input1" type="text" name="name" placeholder="Nombre del cliente">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Description is required">
						<textarea class="input1" name="textarea" placeholder="Descripción de la prenda"></textarea>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate="Date is required">
						<label for="tipo" class="form-label">Fecha de entrega</label>
						<label for="fecha" class="form-label"></label>
						<input type="date" 
						class="form-control input1" 
						id="fecha"  
						name ="fecha" 
						value="">
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Amount is required">
						<input class="input1" type="text" name="number" placeholder="Monto de la renta">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Advance is required">
						<input class="input1" type="text" name="number" placeholder="Anticipo">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "For paid is required">
						<input class="input1" type="text" name="number" placeholder="Por pagar">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input">
						<label for="categoria" class="form-label">Estado de Renta</label>
						<select class="input1" aria-label="Default select example" name="categoria" id="categoria">
							<option class="input1" selected>Selecciona una categoría</option>
							<option value="Rentado"
							<?php 
							if($categoria=="Rentado") 
							echo "selected" 
							?>Rentado</option>
							<option value="Entrado"
							<?php 
							if($categoria=="Entregado") 
							echo "selected" 
							?>Entregado</option>
							<option value="Entregado"
							<?php 
							if($categoria=="Apartado") 
							echo "selected" 
							?>Apartado</option>
						</select>
					</div><!--class="mb-3"-->
					
					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								Generar Renta
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</section>
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