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

	<!-- php  -->
		<?php 
			
			include('database.php');
			$folio ="";
			$fechaA="";
			$cliente = "";
			$descripcion = "";
			$fechaE = "";
			$fechaD = "";
			$monto = "";
			$anticipo = "";
			$adeudo = "";
			$estado = "";
			
			$db = new Database();
			$query = $db->connect()->prepare('select max(folio) as maximo FROM rentas');
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
				$folio = test_entrada($_POST["folio"]);
				$fechaA = test_entrada($_POST["fechaA"]);
				$cliente = test_entrada($_POST["cliente"]);
				$descripcion = test_entrada($_POST["descripcion"]);
				$fechaE = test_entrada($_POST["fechaE"]);
				$monto = test_entrada($_POST["monto"]);
				$anticipo = test_entrada($_POST["anticipo"]);
				$adeudo = test_entrada($_POST["adeudo"]);
				$estado = test_entrada($_POST["estado"]);
				$campos = array();

				
				if($cliente == ""){
					array_push($campos, "debes proporcionar el nombre del cliente");
				}
				if($descripcion == ""){
					array_push($campos, "Proporciona una descripcion de la prenda");
				}
				if($fechaE==""){
					array_push($campos, "Selecciona una fecha de entrega");
				}
				if($monto==""){
					array_push($campos, "Ingresa el  monto de la renta");
				}
				if($anticipo==""){
					array_push($campos, "Se necesita un anticipo del cliente");
				}
				if($estado==""){
				array_push($campos, "Debes elegir un estado de la renta!!!");
				}
				if ( is_numeric($monto) ) {
				} else {
					array_push($campos, "Monto debe ser un numero");
				}
				if ( is_numeric($anticipo) ) {
				} else {
					array_push($campos, "Anticipo debe ser un numero");
				}
				if ( is_numeric($adeudo) ) {
				} else {
					array_push($campos, "El adeudo debe ser un numero");
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
			<div class="collapse navbar-collapse" id="navbarNav" style="justify-content: space-between;">
				<div>
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
					<img src="img/agregar.png" alt="IMG">
				</div>
				
				<form class="contact1-form validate-form" method="POST" 
						autocomplete="on"
						action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<span class="contact1-form-title">
						Agregar Renta
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<label for="folio">Folio</label>	
						<input class="input1" type="text"name="folio" id="folio" value="<?php echo $numero; ?>" readonly>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "date is required">
						<label for="fechaA">Fecha de Apartado</label>
						<input class="input1" type="text" name="fechaA" id="fechaA" value="<?php echo date(" d/m/Y"); ?>" readonly>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Client Name is required">
						<label for="name">Nombre Cliente</label>	
						<input class="input1" type="text" name="cliente" id="cliente" placeholder="Nombre del cliente" value="<?php echo $cliente; ?>" required>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Description is required">
						<label for="description">Descripción de la prenda</label>
						<textarea class="input1" name="descripcion" id="descripcion" placeholder="Descripción de la prenda" value="<?php echo $descripcion?>"></textarea>
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate="Date is required">
						<label for="tipo" class="form-label">Fecha de entrega</label>
						<label for="fecha" class="form-label"></label>
						<input type="date" 
						class="form-control input1" 
						id="fechaE"  
						name ="fechaE" 
						value="<?php echo $fechaE; ?>">
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Amount is required">
						<label for="price">Monto de la renta</label>	
						<input class="input1" type="text" name="monto" id="monto" value="<?php echo $monto?>" placeholder="Monto de la renta">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "Advance is required">
					<label for="advance">Anticipo</label>
						<input class="input1" type="text" name="anticipo" id="anticipo" value="<?php echo $anticipo?>"placeholder="Anticipo">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input" data-validate = "For paid is required">
					<label for="debit">Adeudo</label>
						<input class="input1" type="text" name="adeudo" id="adeudo" value="<?php echo $adeudo ?> "placeholder="Por pagar">
						<span class="shadow-input1"></span>
					</div>
					
					<div class="wrap-input1 validate-input">
						<label for="categoria" class="form-label">Estado de Renta</label>
						<select class="input1" aria-label="Default select example" name="estado" id="estado">
							<option class="input1" selected>Selecciona una categoría</option>
							<option value="Rentado"
							<?php 
							if($estado=="Rentado") 
							echo "selected" 
							?>>Rentado</option>
							<option value="Entrado"
							<?php 
							if($estado=="Entregado") 
							echo "selected" 
							?>>Entregado</option>
							<option value="Entregado"
							<?php 
							if($estado=="Apartado") 
							echo "selected" 
							?>>Apartado</option>
						</select>
					</div><!--class="mb-3"-->
					
					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn" type="submit" name="enviar" id="enviar"> 
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

				$query = $db->connect()->prepare('SELECT folio FROM rentas WHERE folio = :folio');
				$query->execute(['folio' => $folio]);
				$row = $query->fetch(PDO::FETCH_NUM);
				if($query -> rowCount() <= 0){
					$folio=$_POST['folio'];
					$fechaA = date("Y-m-d"); ;
					$cliente=$_POST['cliente'];
					$descripcion=$_POST['descripcion'];
					$fechaE=$_POST['fechaE'];
					$fechaD= date("Y-m-d",strtotime($fechaE."+ 5 days"));
					$monto=$_POST['monto'];
					$anticipo=$_POST['anticipo'];
					$adeudo=$_POST['adeudo'];
					$deber=$monto-$anticipo;
					$estado=$_POST['estado'];

					$insert="insert into rentas(fecha_apartado,nombre_cliente,descripcion,fecha_entrega,fecha_devolucion,monto_renta,anticipo,pago,saldo_pendiente,pago_total,estado_renta) values (:fechaA,:cliente,:descripcion,:fechaE,:fechaD,:monto,:anticipo,:anticipo,:deber,:monto,:estado)";
					$insert = $db->connect()->prepare($insert);
					$insert->bindParam(':fechaA',$fechaA,PDO::PARAM_STR);
					$insert->bindParam(':cliente',$cliente,PDO::PARAM_STR);
					$insert->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
					$insert->bindParam(':fechaE',$fechaE,PDO::PARAM_STR);
					$insert->bindParam(':fechaD',$fechaD,PDO::PARAM_STR);
					$insert->bindParam(':monto',$monto,PDO::PARAM_INT);
					$insert->bindParam(':anticipo',$anticipo,PDO::PARAM_INT);
					$insert->bindParam(':adeudo',$adeudo,PDO::PARAM_INT);
					$insert->bindParam(':deber',$deber,PDO::PARAM_INT);
					$insert->bindParam(':estado',$estado,PDO::PARAM_STR);
					$insert->execute();
					if (!$query){
						echo "Error:",$sql->errorInfo();
					}

					echo"<br/><br/>Los datos fueron registrados con exito";
					print ("<br/><hr/><br/>");
					print ("<table class='table table-striped'>\n");
						print ("<tr>\n");
						print ("<th>Fecha de apartado</th>\n");
						print ("<td>" . $fechaA . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
							print ("<th>Cliente</th>\n");
							print ("<td>" . $cliente. "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
						print ("<th>Fecha de devolucion</th>\n");
						print ("<td>" . $fechaD . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Fecha de entrega</th>\n");
						print ("<td>"  .$fechaA . "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
							//$variable = utf8_decode($variable);
						print ("</tr>\n");
						print ("<tr>\n");
							print ("<th>Anticipo</th>\n");
							print ("<td>" .$anticipo. "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
							print ("<th>Monto</th>\n");
							print ("<td>" .$monto. "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
							print ("<th>Saldo pendiente</th>\n");
							print ("<td>" .$deber. "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
					print ("</table>\n");
					print ("<hr />");					


					echo "<br> El Traje FUE DADO	DE ALTA.";
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