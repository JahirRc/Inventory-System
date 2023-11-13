<?php
  session_start();
  if(!isset($_SESSION['user'])) header('location: login.php');
  include('database/connection.php');
  $user = $_SESSION['user'];
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

        <script src="js/jquery.js"></script>
    </head>

    <body>
        <div class="container">
        <?php
        if($user['id_cargo'] == 1){
            include('partials/sidebar-final.php');
        }else if($user['id_cargo'] == 2){
            include('partials/sidebar-final-usuario.php');
        }
        ?>

        <main>
            <h1>Sistema de Inventario</h1>
            <div class="date">
                <input type="date" 
                value="<?php $fecha = date_default_timezone_set('America/Lima'); 
                $fecha = date('Y-m-d');
                echo $fecha?>" disabled>
                </div>

                <div class="showing">
                    <div class="input-sale">
                        <span class="material-symbols-outlined" style="background: var(--color-warning);">admin_panel_settings</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Usuarios Admin</h3>
                                <?php 
                                $query = "SELECT COUNT(dni) AS total_admin FROM usuarios where id_cargo='1'";
                                $r = mysqli_query($con,$query);
                                $fila = mysqli_fetch_assoc($r);
                                ?>
                                <h1>
                                    <?php 
                                    if($fila['total_admin'] == 0){
                                        echo '0';
                                    }else{
                                        echo $fila['total_admin'];
                                    }
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <small class="text-muted">Acceso completo</small>
                    </div>
                    <!-- FINAL DE CANTIDAD DEL DÍA -->

                    <div class="input-sale">
                        <span class="material-symbols-outlined" style="background: var(--color-warning);">person</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Usuarios Trabajador</h3>
                                <?php 
                                $query = "SELECT COUNT(dni) AS total_admin FROM usuarios where id_cargo='2'";
                                $r = mysqli_query($con,$query);
                                $fila = mysqli_fetch_assoc($r);
                                ?>
                                <h1>
                                    <?php 
                                    if($fila['total_admin'] == 0){
                                        echo '0';
                                    }else{
                                        echo $fila['total_admin'];
                                    }
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <small class="text-muted">Acceso restringido</small>
                    </div>
                    <!-- FINAL DE CANTIDAD DEL MES -->

                    <div class="input-sale">
                        <span class="material-symbols-outlined">mood</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Usuario del día</h3>
                                <?php 
                                $query = "SELECT dni, count(id_venta) as usuario_total
                                FROM venta 
                                where DAY(fecha)=DAY(NOW()) && MONTH(fecha)=MONTH(NOW()) && YEAR(fecha) = YEAR(NOW()) 
                                GROUP BY dni ORDER BY count(id_venta) DESC, SUM(total) DESC LIMIT 1";
                                $r = mysqli_query($con,$query);
                                $fila = mysqli_fetch_assoc($r);
                                ?>
                                <h1>
                                    <?php 
                                    if($fila == NULL){
                                        echo 'Nadie';
                                    }else{
                                        echo $fila['dni'];
                                    }
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <small class="text-muted">
                            <?php 
                            if($fila == NULL){
                                echo 'No hay ventas';
                            }else{
                                echo 'Con '.$fila['usuario_total']. ' ventas';
                            }
                            ?>
                        </small>
                    </div>
                    <!-- FINAL DE ADMIN DEL DÍA -->

                    <div class="input-sale">
                        <span class="material-symbols-outlined">sentiment_very_satisfied</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Usuario del mes</h3>
                                <?php 
                                $query = "SELECT dni, count(id_venta) as usuario_total
                                FROM venta 
                                where Month(fecha)=MONTH(NOW()) GROUP BY dni ORDER BY count(id_venta) DESC, SUM(total) DESC LIMIT 1";
                                $r = mysqli_query($con,$query);
                                $fila = mysqli_fetch_assoc($r);
                                ?>
                                <h1>
                                    <?php 
                                    if($fila == NULL){
                                        echo 'Nadie';
                                    }else{
                                        echo $fila['dni'];
                                    }
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <small class="text-muted"><?php 
                            if($fila == NULL){
                                echo 'No hay ventas';
                            }else{
                                echo 'Con '.$fila['usuario_total']. ' ventas';
                            }
                            ?>
                        </small>
                    </div>
                    <!-- FINAL DE TRABAJADOR DEL DÍA -->
                </div>

                
                <!-- FINAL DE CARTAS -->
                
                <div class="recent-sales">
                    <h2>Lista de Usuarios</h2>
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="static">DNI</th>
                                <th style="cursor: pointer;">Nombre</th>
                                <th style="cursor: pointer;">Apellido</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Fecha Creado</th>
                                <th>Fecha Actualizado</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include('database/usuario/sql-mostrar-usuarios.php') ?>
                        </tbody>
                        </table>
                </div>
            </main>

            <div class="right">
                <?php
                include('partials/top.php') ?>
                </div>

                <div class="recent-activity">
                    <h2>Ventas Recientes de Usuarios</h2>
                    <div class="activity">

                    <?php
                    $query = "SELECT * FROM venta ORDER BY fecha DESC LIMIT 4";
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
                        <p>'.'El usuario con código '.$ac[1].' realizó una venta de s/.'.$ac[3].'</p>
                        <small class="text-muted">'.$ac[2].'</small>
                        </div>
                        </div>';
                    }
                    ?>
                        <!-- FINAL ACTIVIDAD RECIENTE -->
                    </div>
                </div>

                <script src="js/sidebar.js" defer></script>
    <script src="js/pagination.js" defer></script>
    </body>
</html>