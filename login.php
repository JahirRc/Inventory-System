<?php
  session_start();

  if(isset($_SESSION['user'])) header('Location: dashboard-final.php');

  $error_message = '';
  if($_POST){
    include('database/connection.php');

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

  $query = "SELECT * FROM usuarios";
  $r = mysqli_query($con,$query);
  $filas = mysqli_fetch_array($r);

    $usuario_existe = false;
    foreach($r as $user){
      $upass = $user['contrasena'];
      
      if($usuario == $user['usuario'] && $contrasena == $upass /*password_verify($contrasena, $upass)*/ && $user['id_cargo'] == 1){
        $usuario_existe = true;
        $_SESSION['user'] = $user;
        header('Location: dashboard-final.php');
        break;
      }else if($usuario == $user['usuario'] && $contrasena == $upass /*password_verify($contrasena, $upass)*/ && $user['id_cargo'] == 2){
        $usuario_existe = true;
        $_SESSION['user'] = $user;
        header('Location: dashboard-usuario-final.php');
        break;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/login.css">
  
  <script src="js/login.js" defer></script>

  <title>Iniciar Sesión</title>
</head>
<body>

  <form action="" method="POST" id="stripe-login">
    <section class="login">

      <div class="wrapper">
        <img src="images/logo.png" class="login__logo">

        <h1 class="login__title">Iniciar Sesión</h1>
    
        <label class="login__label">
          <span>Usuario</span>
          <input type="text" name="usuario" class="input" autocomplete="off">
        </label>
  
        <label class="login__label">
          <span>Contraseña</span>
          <input name="contrasena" type="password" class="input">
        </label>
  
        <div class="login__icons">
          <button type="button" onclick="location.href='https://www.facebook.com/profile.php?id=100064087088584'" class="icons__button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1024px-Facebook_Logo_%282019%29.png" alt="facebok">
          </button>
  
          <button type="button" class="icons__button">
            <img src="./images/google-icon.png" alt="facebok">
          </button>
  
          <button type="button" class="icons__button">
            <img src="./images/apple-icon.png" alt="facebok">
          </button>
        </div>
      </div>

      <div class="wrapper" style="padding-top: 1rem;">
        <button type="submit" href="index.php" class="login__button" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"/>
          </svg>
        </button>
  
        <a href="programador.php" target="_blank" rel="noopener noreferrer" class="login__link">Desarrollador</a>
        <a href="#" class="login__link">Versión 1.1</a>
      </div>

    </section>

    <section class="wallpaper"></section>
</form>
  
</body>
</html>






