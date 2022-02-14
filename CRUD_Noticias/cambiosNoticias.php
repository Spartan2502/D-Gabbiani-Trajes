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
			<div class="collapse navbar-collapse" id="navbarNav" style="justify-content: space-between;">
				<div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link"  href="./AltaRevistas.php">Estado de Renta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link"  href="./consultaNoticias.php">Consultar Traje</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="">Modificar Renta</a>
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
					<img src="img/modificar.png" alt="IMG">
				</div>
				
				<form class="contact1-form validate-form" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<span class="contact1-form-title">
						Modificar Renta
					</span>
					
					<div class="wrap-input1 validate-input" data-validate = "Folio is required">
						<input class="input1" type="text" name="folio" id="folio" placeholder="Folio de renta a modificar" value="<?php echo $folio;?>">
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
					$folio=isset($_REQUEST['folio']) ? $_REQUEST['folio'] : null;

					$query = $db->connect()->prepare('select * FROM rentas where folio = :folio');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['folio' => $folio]);
								$row = $query->fetch();
								if($query -> rowCount() > 0){

							//$isCheckedL = $row['estado_renta'] == 'Apartado' ? 'checked' : '';
							//$isCheckedN = $row['estado_renta'] == 'Rentado' ? 'checked' : '';
							//$isCheckedI = $row['estado_renta'] == 'Devuelto' ? 'checked' : '';
							echo
							'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Folio de renta a modificar:</label>
							<input type="text" class="form-control" value="'.$row['folio'].'" readonly="readonly"/>
						</div>'.
						
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Nombre de cliente:</label>
							<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="nombre_cliente" value ="'.$row['nombre_cliente'].'"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Descripción de la prenda:</label>
							<textarea class="form-control" name="descripcion" rows="5" cols="40">'.$row['descripcion'].'</textarea>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Fecha de entrega:</label>
							<input type="date" class="form-control" name="fecha_entrega" value ="'.$row['fecha_entrega'].'">
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Fecha de devolución:</label>
							<input type="date" class="form-control" name="fecha_devolucion" value ="'.$row['fecha_devolucion'].'" readonly="readonly">
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Monto de la renta:</label>
							<input type="number" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="monto_renta" value ="'.$row['monto_renta'].'"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Anticipo:</label>
							<input type="number" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="anticipo" value ="'.$row['anticipo'].'" readonly="readonly"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Pago:</label>
							<input type="number" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="pago" value ="'.$row['pago'].'"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Saldo pendiente:</label>
							<input type="number" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="saldo_pendiente" value ="'.$row['saldo_pendiente'].'" readonly="readonly"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Pago total:</label>
							<input type="number" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="pago_total" value ="'.$row['pago_total'].'" readonly="readonly"/>
						</div>'.
						'<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Estado de la renta:</label>
							<select class="form-select" aria-label="Default select example" name="estado_renta" id="estado_renta">
								<option value="'.$row['estado_renta'].'">'.$row['estado_renta'].'</option>
								 <option value="Apartado">Apartado</option>
								 <option value="Entregado">Entregado</option>
								 <option value="Devuelto">Devuelto</option>
								 <option value="Cancelacion">Cancelación</option>
							</select>
						</div>'.
						// '<div class="mb-3">
						// 	<label for="exampleFormControlInput1" class="form-label">Tipo de noticias:</label>
						// 	<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Local"'.$isCheckedL.' />Local
						// 	<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Nacional"'.$isCheckedN.' />Nacional
						// 	<input type="radio" class="form-check-input" name="tipo" id="tipo" value ="Internacional"'.$isCheckedI.' />Internacional
						// </div>'.
						'<div class="mb-3">
							<button type="submit" class="btn btn-primary" name="cambiar">Cambiar datos</button>
						</div>';
				}else if ($query -> rowCount() <= 0){
					echo "No existe ese Folio de Renta.";
				}		 
				}


				//borrar de aqui
				if(isset($_REQUEST['cambiar'])){ 

					//$folio=$_POST['folio'];
					$folio=$_POST['folio'];		
					$nombre_cliente=$_POST['nombre_cliente'];
					$descripcion=$_POST['descripcion'];
					$fecha_entrega =$_POST['fecha_entrega'];
					$fecha_devolucion =date("Y-m-d",strtotime($fecha_entrega."+ 5 days")); 
					$monto_renta=$_POST['monto_renta'];
					$anticipo=$_POST['anticipo'];
					$pago=$_POST['pago'];
					$saldo_pendiente=$monto_renta-$anticipo-$pago;
					$pago_total =$anticipo+$pago;
					$estado_renta =$_POST['estado_renta'];
					
					$sql = "UPDATE rentas SET  nombre_cliente=?, descripcion=?, fecha_entrega=?, fecha_devolucion=?, monto_renta=?, anticipo=?, pago=?, saldo_pendiente=?, pago_total=?, estado_renta=? WHERE folio=?";
					$stmt= $db->connect()->prepare($sql);
					$stmt->execute([ $nombre_cliente, $descripcion, $fecha_entrega, $fecha_devolucion, $monto_renta, $anticipo, $pago, $saldo_pendiente, $pago_total, $estado_renta, $folio]);
						
					
					/*$consulta= 'update rentas set folio= : folio, nombre_cliente = :nombre_cliente, descripcion = :descripcion, fecha_entrega = :fecha_entrega, estado_renta = :estado_renta, monto_renta = :monto_renta, saldo_pendiente = :saldo_pendiente, pago_total = :pago_total where folio = :folio';
					$consulta = $db->connect()->prepare($consulta);
					$consulta->bindParam(':folio',$folio,PDO::PARAM_STR, 25);
					$consulta->bindParam(':nombre_cliente',$nombre_cliente,PDO::PARAM_STR, 25);
					$consulta->bindParam(':descripcion',$descripcion,PDO::PARAM_STR,25);
					$consulta->bindParam(':fecha_entrega',$fecha_entrega,PDO::PARAM_STR,25);
					$consulta->bindParam(':estado_renta',$estado_renta,PDO::PARAM_STR);
					$consulta->bindParam(':monto_renta',$monto_renta,PDO::PARAM_STR);
					$consulta->bindParam(':saldo_pendiente',$saldo_pendiente,PDO::PARAM_STR);
					$consulta->bindParam(':pago_total',$pago_total,PDO::PARAM_STR);
					$consulta->execute();
					*/

					$row = $stmt->fetch();
					if($stmt->rowCount() > 0){
						echo"<br/><br/>Los datos fueron modificados con exito";
						print ("<br/><br/><hr/><br/>");
						print ("<table class='table table-striped'>\n");
						print ("<tr>\n");
						print ("<th>Folio</th>\n");
						print ("<td>". $_REQUEST['folio']. "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						
						print ("<th>Nombre del cliente</th>\n");
						print ("<td>" . $_REQUEST['nombre_cliente'] . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Descripción</th>\n");
						print ("<td>" . $_REQUEST['descripcion'] . "</td>\n");
					//$variable = utf8_decode($variable);
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Fecha de entrega</th>\n");
						print ("<td>" .$_REQUEST['fecha_entrega']. "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Fecha de devolución</th>\n");
						print ("<td>" . $fecha_devolucion . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Monto de la renta</th>\n");
						print ("<td>".$_REQUEST['monto_renta']. "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Anticipo</th>\n");
						print ("<td>" . $_REQUEST['anticipo'] . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Pago</th>\n");
						print ("<td>" . $_REQUEST['pago'] . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Saldo Pendiente</th>\n");
						print ("<td>" .$saldo_pendiente . "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Pago total</th>\n");
						print ("<td>" .$pago_total. "</td>\n");
					print ("</tr>\n");
					print ("<tr>\n");
						print ("<th>Estado de la renta</th>\n");
						print ("<td>" . $_REQUEST['estado_renta'] . "</td>\n");
					print ("</tr>\n");
						print ("</table>\n");
						print ("<br /><hr />");
					}else if ($stmt->rowCount()<=  0){
						echo "No se actualizó el registro!!!";
					}
				}
				//hasta aqui
			?>
				</form>
			</div>
		</div>
	</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>