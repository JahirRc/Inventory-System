<?php
  session_start();
  if(!isset($_SESSION['user'])) header('location: login.php');
  include('database/connection.php');
  $user = $_SESSION['user'];

  $dni = "";
  $nombre_usuario = "";
  $apellido_usuario = "";
  $contrasena_usuario = "";
  $usuario_usuario = "";
  $cargo_usuario = "";

  $error = "";

  include("database/usuario/sql-usuario.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú Principal</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="css/dashboard-final.css">
        <link rel="stylesheet" href="css/registrar.css">

        <script src="js/jquery.js"></script>
    </head>

    <body>
        <!-- INICIO DECLARACIÓN SIDEBAR -->
        <div class="container">
            <?php
            if($user['id_cargo'] == 1){
                include('partials/sidebar-final.php');
            }else if($user['id_cargo'] == 2){
                include('partials/sidebar-final-usuario.php');
            }
            ?>
        <!-- FIN DE SIDEBAR -->

        <!-- INICIO DEL MAIN -->
        <main>
            <h1>Sistema de Inventario</h1>

            <!-- SECCIÓN DE FECHA -->
            <div class="date">
                <input type="date" 
                value="<?php $fecha = date_default_timezone_set('America/Lima'); 
                $fecha = date('Y-m-d');
                echo $fecha?>" disabled>
                
                <span style="var(--color-dark);";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $error; ?></span>
            </div>
            <!-- FIN DE SECCIÓN DE FECHA -->
            
            <!-- PRIMERA SECCIÓN DEL MAIN - FORMULARIO -->
            <div class="recent-sales">
                <h2>Registrar Usuario</h2>
                
                <!-- INICIO DE FORMULARIO -->
                <form action="registrar-usuario-final.php" method="POST" id="stripe-login">
                    <section class="login">
                        
                        <!-- ESPACIOS DE INGRESO DE DATOS -->
                        <div class="wrapper">

                            <!-- INGRESO DE CÓDIGO -->
                            <label class="login__label">
                                <span>Código</span>
                                <input type="text" placeholder="Identificador" class="input" name="dni" id="dni" autocomplete="off" 
                                value="<?php echo $dni;?>">
                            </label>
                            
                            <!-- INGRESO DE NOMBRE -->
                            <label class="login__label">
                                <span>Nombre</span>
                                <input type="text" class="input" name="nombre" id="nombre" autocomplete="off" 
                                value="<?php echo $nombre_usuario;?>">
                            </label>
                            
                            <!-- INGRESO DE APELLIDO -->
                            <label class="login__label">
                                <span>Apellido</span>
                                <input type="text" class="input" name="apellido" id="apellido" autocomplete="off" 
                                value="<?php echo $apellido_usuario;?>">
                            </label>
                            
                            <!-- INGRESO DE USUARIO -->
                            <label class="login__label">
                                <span>Usuario</span>
                                <input type="text" placeholder="Nombre de usuario" class="input" name="usuario" id="usuario" autocomplete="off" 
                                value="<?php echo $usuario_usuario;?>">
                            </label>
                                
                            <!-- INGRESO DE CONTRASEÑA -->
                            <label class="login__label">
                                <span>Contraseña</span>
                                <input type="text" class="input" name="contrasena" id="contrasena" autocomplete="off" 
                                value="<?php echo $contrasena_usuario;?>">
                            </label>
                            
                            <!-- INGRESO DE CARGO -->
                            <label class="login__label">
                                <span>Cargo</span>
                                <input type="text" placeholder="[1-admin, 2-trabajador]" class="input" name="cargo" id="cargo" 
                                autocomplete="off" value="<?php echo $cargo_usuario;?>">
                            </label>
                            
                            <!-- BOTÓN DE REGISTRAR USUARIO -->
                            <button type="submit" name="register_usuario" class="login__button">
                                <span>Registrar Usuario</span>
                            </button>
                            
                            <!-- BOTÓN DE EDITAR USUARIO -->
                            <button type="submit" name="update_usuario" class="login__button">
                                <span>Editar Usuario</span>
                            </button>
                            
                            <!-- BOTÓN DE BUSCAR USUARIO -->
                            <button type="submit" id="buscar" name="search_usuario" class="login__button"> 
                                <span>Buscar Usuario</span>
                            </button>
                            
                            <!-- BOTÓN DE ELIMINAR USUARIO -->
                            <button type="submit" name="delete_usuario" class="login__button">
                                <span>Eliminar Usuario</span>
                            </button>
                        </div>
                        <!-- FIN DE ESPACIO DE INGRESO DE DATOS -->
                        
                        <!-- ESPACIO PARA MOSTRAR EL ERROR -->
                        <!--<div class="wrapper" style="margin-top: 20px">
                            <span style="var(--color-dark);";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $error; ?></span>
                        </div>-->
                        <!-- FIN DE ESPACIO PARA MOSTRAR EL ERROR -->
                    </section>
                    <!-- FIN DE SECCIÓN FORMULARIO -->
                </form>
                <!--FIN DE FORMULARIO -->
            </div>
            <!-- FIN DE PRIMERA SECCIÓN DEL MAIN -->
        </main>
        <!-- FIN DEL MAIN (IZQUIERDA) -->
        

        <!-- INICIO DE SECCIÓN DERECHA (MODO OSCURO, PERFIL)-->
        <div class="right">
            <?php
            include('partials/top.php') ?>
        </div>
        <!-- FIN DE SECCIÓN IZQUIERDA -->


        <!-- INICIO DE USUARIOS RECIENTES -->
        <div class="recent-activity">
            <h2>Usuarios Recientes</h2>
            <div class="activity">
                <?php
                $query = "SELECT * FROM usuarios ORDER BY fecha_creado DESC LIMIT 4";
                $r = mysqli_query($con,$query);
                $count = mysqli_num_rows($r);
                
                $actividad = mysqli_fetch_all($r);
                
                foreach($actividad as $ac){
                    echo
                    '<div class="activity">
                    <div class="profile-photo">
                    <img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png">
                    </div>
                    <div class="message">
                    <p>'.$ac[1].' '.$ac[2].' con código '.$ac[0].' se registró como '.$ac[4].'</p>
                    <small class="text-muted">'.'Código: '.$ac[0].'</small>
                    </div>
                    </div>';
                }
                ?>
            </div>
        </div>
        <!-- FIN DE USUARIOS RECIENTES -->
        
        <script src="js/sidebar.js" defer></script>
        <script src="js/registrar.js" defer></script>
    </body>
</html>