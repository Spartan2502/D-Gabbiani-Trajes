<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <!-- CSS only -->
    <link rel="icon" href="img/D' Gabbiani.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
  </head>
<body>

<?php
// session_destroy()
		session_start();
		include('database.php');
		$usuario=$password="";

		if(isset($_SESSION['rol'])){
			switch($_SESSION['rol']){
				case 1:
          header('location: ./CRUD_Noticias/menu.php');
					break;

				case 2:
					header('location: ./user.php');
					break;
				default:
			}
		}

		if(isset($_POST['username']) && isset($_POST['password'])){
				$username = $_POST['username'];
				$password = $_POST['password'];

				$db = new Database();
				$sql = "SELECT * FROM usuarios WHERE email =:username";
				
				$stmt = $db->connect()->prepare($sql);
				
				$stmt->execute(['username' => $username]);
				$result = $stmt->fetch();
				
				if (!empty($result) && password_verify($password, $result["clave"])){
					// validar rol
					$rol = $result[6];
					$_SESSION['rol'] = $rol;

					switch($_SESSION['rol']){
						case 1:
              header('location: ./CRUD_Noticias/menu.php');
              break;
			
						case 2:
              header('location: ./user.php');
              break;
			
						default:
					}
				
				}else{
					// no existe el usuario
					echo '<script language="javascript">alert("Datos incorrectos!!!");</script>';
				}
				}	
		?>

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
          <a class="nav-link" href="usuarios.php" tabindex="-1" aria-disabled="true">Registrarse</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- Fin de navbar -->


<section>
  <div class="wrapper">
    <div class="title">Iniciar Sesión</div>
<!-- form login -->
    <form action="" method="post">

      <div class="field">
        <input type="text" name="username" required>
        <label for="uname">Email Address</label>
      </div>

      <div class="field">
        <input type="password" name="password" required>
        <label for="psw">Password</label>
      </div>

      <div class="pass-link"><a href="#">Forgot password?</a></div>

      <div class="field">
        <input type="submit" value="Login">
      </div>

      <div class="signup-link">Not a member? <a href="usuarios.php">Signup now</a></div>
    </form>
    <!-- form login -->
  </div>
</section>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>