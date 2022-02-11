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
						<a class="nav-link" href="#">Modificar Renta</a>
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
				
				<form class="contact1-form validate-form">
					<span class="contact1-form-title">
						Modificar Renta
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="number" placeholder="Folio de renta a modificar">
						<span class="shadow-input1"></span>
					</div>

                    <div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								Buscar Clave
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
					
                    <div class="mt-4"></div>

					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="number" placeholder="" disabled>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Name is required">
						<input class="input1" type="text" name="name" placeholder="Cliente" disabled>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Description is required">
						<textarea class="input1" name="textarea" placeholder="Descripción de la prenda"></textarea>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Date is required">
						<label for="fecha" class="form-label">Fecha de apartado</label>
						<input class="input1" type="text" name="number" placeholder="" disabled>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Date is required">
						<label for="fecha" class="form-label">Fecha de Entrega</label>
						<input type="date" 
						class="form-control input1" 
						id="fecha"  
						name ="fecha" 
						value="">
						
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate = "Date is required">
						<label for="fecha" class="form-label">Fecha de devoluación</label>
						<input class="input1" type="text" name="number" placeholder="" disabled>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Date is required">
						<label for="fecha" class="form-label">Monto de la Renta</label>
						<input class="input1" type="text" name="number" placeholder="" disabled>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								Generar Cambio
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>