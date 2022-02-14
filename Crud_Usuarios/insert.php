<?php 
	include_once 'database.php';
	$db = new Database();
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$telefono=$_POST['telefono'];
		$ciudad=$_POST['ciudad'];
		$correo=$_POST['correo'];

		if(!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($ciudad) && !empty($correo) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$db->connect()->prepare('INSERT INTO clientes(nombre,apellidos,telefono,ciudad,correo) VALUES(:nombre,:apellidos,:telefono,:ciudad,:correo)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellidos' =>$apellidos,
					':telefono' =>$telefono,
					':ciudad' =>$ciudad,
					':correo' =>$correo
				));
				header('Location: menu.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/insert.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<div class="signupSection">
    <div class="info">
      <h2>Nuevo Cliente</h2>
      <i class="bi bi-file-person icon"></i>
      <p>Confeccionamos para ti momentos inolvidables desde 1990</p>
    </div>
    <form action="#" method="POST" class="signupForm" name="signupform">
      <h2>Nuevo Registro</h2>
      <ul class="noBullet">
        <li>
          <label for="name"></label>
          <input type="text" class="inputFields" id="name" name="name" placeholder="Nombre" value="" required/>
        </li>
        <li>
          <label for="last_name"></label>
          <input type="text" class="inputFields" id="last_name" name="last_name" placeholder="Apellidos" value="" required/>
        </li>
        <li>
          <label for="phone"></label>
          <input type="text" class="inputFields" id="phone" name="phone" placeholder="Teléfono" value="" required/>
        </li>
        <li>
          <label for="city"></label>
          <input type="text" class="inputFields" id="city" name="city" placeholder="Cuidad" value="" required/>
        </li>
        <li>
          <label for="email"></label>
          <input type="email" class="inputFields" id="email" name="email" placeholder="Correo electrónico" value="" required/>
        </li>
        <li id="center-btn">
          <input type="submit" id="join-btn" name="save" alt="save" value="Guardar">
        </li>
      </ul>
    </form>
  </div>
</body>
</html>
