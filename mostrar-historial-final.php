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
                
                <div class="recent-sales">
                    <h2>Historial de Actividades</h2>
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="static">ID Actividad</th>
                                <th class="static">Descripción</th>
                                <th style="cursor: pointer;" onclick="sortTable(2)">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include('database/historial/sql-mostrar-historial.php') ?>
                        </tbody>
                        </table>
                </div>
            </main>

            <div class="right">
                <?php
                include('partials/top.php') ?>
                </div>

                <div class="recent-activity">
                    <h2>Actividad más Antigua</h2>
                    <div class="activity">

                    <?php
                    $query = "SELECT * FROM historial_actividad ORDER BY fecha_realizado ASC LIMIT 4";
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

                <script src="js/sidebar.js" defer></script>
    <script src="js/pagination.js" defer></script>
    </body>
</html>