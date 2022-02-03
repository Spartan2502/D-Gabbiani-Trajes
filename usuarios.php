<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alta de usuarios del sistema</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="css/estiloFormUsuarios.css" rel="stylesheet">
    </head>
    <body>
		<?php
			$nombre="";
			$apaterno="";
			$amaterno="";
			$email="";
			$pass_cifrado="";
			$nivel="";
			$clave="";
			include('database.php');
			$db = new Database();
			$query = $db->connect()->prepare('select max(id) as maximo from usuarios');
			
			$query->execute();
			$row = $query->fetch();
			$numero=$row["maximo"];
			$numero++;
			
			function quitarEspacios($data){
				$data= trim($data);
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$clave=quitarEspacios($_POST["clave"]);
				$nombre=quitarEspacios($_POST["nombre"]);
				$apaterno=quitarEspacios($_POST["apaterno"]);
				$amaterno=quitarEspacios($_POST["amaterno"]);
				$email=quitarEspacios($_POST["email"]);
				$nivel=quitarEspacios($_POST["nivel"]);
			}
		?>
		 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Regresar a la página</a>
            </div>
			<div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="login.php">Ingresar a la aplicación</a>
            </div>
            </div>
        </div>
        </nav>
		<form method="POST" 
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<fieldset>
				<legend>Registro de usuarios</legend>
			<label>No. de Registro:</label><br/>
			<input type="text" name="id" value ="<?php echo $numero;?>" disabled/>
			<label>Nombre:</label>
			<input type="text" name="nombre" required/>
			<label>Apellido Paterno:</label>
			<input type="text" name="apaterno" required/>
			<label>Apellido Materno:</label>
			<input type="text" name="amaterno" required/>
			<label>E-mail:</label>
			<input type="text" name="email" required/>
			<label>Clave o Password:</label>
			<input type="password" name="clave" required/>
			<label>Nivel:</label>
			
			<select name="nivel" id="nivel" 
				style="margin-bottom:10px;
					width:100%;
					padding:10px;
					-webkit-box-sizing:border-box;
					-moz-box-sizing:border-box;
					box-sizing:border-box;
					border:1px solid #ccc;">
				<option selected>Selecciona el nivel</option>
				<option value="1"
					<?php if($nivel=="1") echo "selected" ?>>1
				</option>
				<option value="2"
					<?php if($nivel=="2") echo "selected" ?>>2
				</option>
				<option value="3" 
					<?php if($nivel=="3") echo "selected" ?>>3
				</option>
			</select>
			
			<input type="submit" name="enviar" value="Enviar datos"/>
			</fieldset>
		</form>
		<?php 
			if(isset($_REQUEST['enviar'])){
				$pass_cifrado = 
				password_hash($clave,PASSWORD_DEFAULT,array("cost">=10));
				
				$query = $db->connect()->prepare('select email from usuarios where email=:email');
				$query->execute(['email' => $email]);
				$row = $query->fetch(PDO::FETCH_NUM);
				if($query -> rowCount() <= 0){
					//echo 'entro al if del insert!!!';
					$nombre=$_POST['nombre'];
					$apaterno=$_POST['apaterno'];
					$amaterno=$_POST['amaterno'];
					$email=$_POST['email'];
					$nivel =$_POST['nivel'];
					$clave =$_POST['clave'];
					$insert="insert into usuarios(nombre,apaterno,amaterno,email,nivel,clave) values (:nombre,:apaterno,:amaterno,:email,:nivel,:clave)";
					$insert = $db->connect()->prepare($insert);
					$insert->bindParam(':nombre',$nombre,PDO::PARAM_STR, 25);
					$insert->bindParam(':apaterno',$apaterno,PDO::PARAM_STR, 25);
					$insert->bindParam(':amaterno',$amaterno,PDO::PARAM_STR,25);
					$insert->bindParam(':email',$email,PDO::PARAM_STR,25);
					$insert->bindParam(':nivel',$nivel,PDO::PARAM_STR);
					$insert->bindParam(':clave',$pass_cifrado,PDO::PARAM_STR);
					$insert->execute();
					if (!$query){
						echo "Error:",$sql->errorInfo();
					}
				
					echo "<br/><br/>El usuario fue dado de alta!!!";
					echo "<h2>Datos capturados:</h2>";
					echo "Número de registro: ".$numero."<br/>";
					echo "Nombre: ".$_REQUEST['nombre']."<br/>";
					echo "Apellido paterno: ".$_REQUEST['apaterno']."<br/>";
					echo "Apellido materno: ".$_REQUEST['amaterno']."<br/>";
					echo "E-mail: ".$_REQUEST['email']."<br/>";
					echo "Nivel: ".$_REQUEST['nivel']."<br/>";
				}else if($query -> rowCount() > 0){
					echo "<br/>YA EXISTE UN USUARIO CON ESE E-MAIL";
				}
				$query->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
					$query = null; // obligado para cerrar la conexión
					$db = null;
			}
		?>
    </body>
</html>