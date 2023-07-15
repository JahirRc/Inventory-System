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
<!-- SELECT producto.id_prod, producto.nombre, producto.precio, producto.precio_pub, producto.stock, categoria.nombre_categoria FROM producto inner join categoria on producto.id_categoria=categoria.id_categoria WHERE categoria.nombre_categoria = 'Carcasas';-->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/registrar.css?parameter=2">
    <link rel="stylesheet" href="css/menu.css?parameter=2">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!----==== JQUERY ==== -->
    <script src="js/jquery.js"></script>
    
    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <?php
            include('partials/sidebar.php') ?>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!--<div class="search-box">
                <i class="uil uil-store"></i>
                <input type="text" placeholder="SISTEMA DE INVENTARIO" disabled>
            </div>-->
        </div>
    <div class = "forms-flex">
        <div class="wrapper">
            <h2>Nuevo Usuario</h2>
            <form id="form1" action="registrar-usuario.php" method="POST">
                <div class="input-box">
                    <input type="text" name="dni" id="dni" placeholder="DNI" 
                    value="<?php echo $dni;?>">
                </div>
                <div class="input-box">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" 
                    value="<?php echo $nombre_usuario;?>">
                </div>
                <div class="input-box">
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" 
                    value="<?php echo $apellido_usuario;?>">
                </div>
                <div class="input-box">
                    <input type="text" name="contrasena" id="contrasena" placeholder="Contraseña" 
                    value="<?php echo $contrasena_usuario;?>">
                </div>
                <div class="input-box">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" 
                    value="<?php echo $usuario_usuario;?>">
                </div>
                <div class="input-box">
                    <input type="text" name="cargo" id="cargo" placeholder="Cargo (1- Admin, 2- Trabajador)" 
                    value="<?php echo $cargo_usuario;?>">
                </div>

                <p style="color: red";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $error; ?></p>
                <!--<div class="select">
                    <select id="select-scroll-rol" name="select-scroll-rol" aria-label="Select menu example">
                        <option value="0">Rol</option>
                        <?php /*
                        $query = "SELECT id_cargo, nombre_cargo from cargo ORDER BY nombre_cargo ASC";
                        $r = mysqli_query($con,$query);
                        while($category = mysqli_fetch_assoc($r)){
                            ?>
                            <option value=<?= $category['id_cargo']?>><?= $category['nombre_cargo'] ?></td>
                            <?php } 
                            */?>
                    </select>
                </div>-->
            </form>
        </div>

        <!--<div class = "forms-flex">-->
            <div class="wrapper">
            <h2>Procesos Usuario</h2>
                <form action="registrar-usuario.php" method="POST">
                    <div class="input-box button">
                        <input type="Submit" value="Registrar Usuario" name="register_usuario" form="form1">
                    </div>
                    <div class="input-box button">
                        <input type="Submit" value="Buscar Usuario" name="search_usuario" form="form1">
                    </div>
                    <div class="input-box button">
                        <input type="Submit" value="Actualizar Usuario" name="update_usuario" form="form1">
                    </div>
                    <div class="input-box button">
                        <input type="Submit" value="Eliminar Usuario" name="delete_usuario" form="form1">
                    </div>
                </form>
            </div>
        <!--</div>-->
    </section>
    <script src="js/menu.js"></script>
</body>
</html>