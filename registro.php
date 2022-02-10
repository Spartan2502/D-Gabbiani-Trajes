<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registrarse</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="css/estiloFormUsuarios.css" rel="stylesheet">
		<link rel="icon" href="img/D' Gabbiani.png">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"/>
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    </head>
    <body>

		<!-- PHP -->
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
		<!-- Fin de PHP -->



  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong">
  <div class="container-fluid">
    <img src="img/D' Gabbiani.png" width="58" height="54" alt="">

    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
    <i class="bi bi-list"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tienda de Accesorios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="false">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- Fin de navbar -->
 <div class="mt-4"></div>
			<!-- Formulario de registro -->
	<section>
		<div class="wrapper">
		<div class="title">Registrarse</div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

					<div class="field">
					<input type="text" name="id" value ="<?php echo $numero;?>" disabled/>	
					</div>

					<div class="field">
					<input type="text" name="nombre" required/>
					<label>Nombre</label>	
					</div>

					<div class="field">
					<input type="text" name="apaterno" required/>
					<label>Apellido Paterno</label>	
					</div>

					<div class="field">
					<input type="text" name="amaterno" required/>
					<label>Apellido Materno</label>	
					</div>

					<div class="field">
					<input type="text" name="email" required/>
					<label>E-mail</label>
					</div>

					<div class="field">
					<input type="password" name="clave" required/>
					<label>Password</label>	
					</div>

					<div class="field">
					<input type="hidden" name="nivel" value="1" required/>
					</div>

					<div class="field">
					<input type="submit" name="enviar" value="Enviar datos"/>	
					</div>
			</form>
		</div>
	</section>
			<!-- Fin de Formulario de registro -->


			<!-- PHP -->
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

		<!-- Fin de PHP -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>