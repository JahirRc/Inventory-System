<?php
  session_start();
  if(!isset($_SESSION['user'])) header('location: login.php');
  $user = $_SESSION['user'];
  include('database/connection.php');
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
    </head>

    <body>
        <div class="container">
            <?php include('partials/sidebar-final-usuario.php');?>
            <!-- FINAL ASIDE -->
            <main>
                <h1>Menú</h1>

                <div class="date">
                    <input type="date" 
                    value="<?php $fecha = date_default_timezone_set('America/Lima'); 
                    $fecha = date('Y-m-d');
                    echo $fecha?>" disabled>
                </div>

                <div class="showing">
                    <div class="input-sale">
                        <span class="material-symbols-outlined" style="background: var(--color-warning);">analytics</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Ingresos del Día</h3>
                                <?php 
                                include('database/menu/sql-ingresos-dia.php') ?>
                            </div>
                        </div>
                        <small class="text-muted">Último día</small>
                    </div>
                    <!-- FINAL DE CANTIDAD DEL DÍA -->

                    <div class="input-sale">
                        <span class="material-symbols-outlined" style="background: var(--color-warning);">savings</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Ingresos del Mes</h3>
                                <?php 
                                include('database/menu/sql-ingresos-actuales.php') ?>
                            </div>
                        </div>
                        <small class="text-muted">Último día</small>
                    </div>
                    <!-- FINAL DE CANTIDAD DEL MES -->

                    <div class="sales">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Ventas del día</h3>
                                <?php 
                                include('database/menu/sql-contar-ventas-dia.php') ?>
                            </div>
                        </div>
                        <small class="text-muted">Último día</small>
                    </div>
                    <!-- FINAL DE VENTAS DEL MES -->

                    <div class="sales">
                        <span class="material-symbols-outlined">account_balance</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Ventas del Mes</h3>
                                <?php 
                                include('database/menu/sql-contar-ventas.php') ?>
                            </div>
                        </div>
                        <small class="text-muted">Último día</small>
                    </div>
                    <!-- FINAL DE USUARIOS REGISTRADOS -->
                </div>
                <!-- FINAL DE CARTAS -->

                <div class="recent-sales">
                    <h2>Ventas Recientes</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM venta ORDER BY fecha DESC LIMIT 5";
                        $r = mysqli_query($con,$query);
                        $count = mysqli_num_rows($r);
                        
                        $venta = mysqli_fetch_all($r);
                        
                        foreach($venta as $v){
                            echo
                            '<tr>
                            <td>'.$v[0].'</td>
                            <td>'.$v[1].'</td>
                            <td>'.$v[2].'</td>
                            <td>'.$v[3].'</td>
                            </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="#">Mostrar todos</a>
                </div>
            </main>
            <!-- FINAL MAIN-->

            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="theme-toggler">
                        <span class="material-symbols-outlined active">light_mode</span>
                        <span class="material-symbols-outlined">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Hola, </p><?php echo $user['nombre']?></b></p>
                            <small class="text-muted">Trabajador</small>
                        </div>
                        <div class="profile-photo">
                            <img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="">
                        </div>
                    </div>
                </div>
                <!-- FINAL DEL TOP -->

                <div class="recent-activity">
                    <h2>Actividad Reciente</h2>
                    <div class="activity">

                    <?php
                    $query = "SELECT * FROM historial_actividad ORDER BY id_historial DESC LIMIT 4";
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
                        <p>'.$ac[3].'</p>
                        <small class="text-muted">'.$ac[2].'</small>
                        </div>
                        </div>';
                    }
                    ?>
                        <!-- FINAL ACTIVIDAD RECIENTE -->
                    </div>
                </div>
            </div>
        </div>

        <script src="js/sidebar.js" defer></script>
    </body>
</html>