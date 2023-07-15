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
                <input type="date" id="date"
                value="<?php $fecha = date_default_timezone_set('America/Lima'); 
                $fecha = date('Y-m-d');
                echo $fecha?>">
                </div>
                <div class="recent-sales">
                    <h2>Lista de Ventas</h2>
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th class="static">ID Venta</th>
                                <th style="cursor: pointer;" >DNI</th>
                                <th style="cursor: pointer;" >Fecha</th>
                                <th style="cursor: pointer;" >Nombre</th>
                                <th style="cursor: pointer;" >Cantidad</th>
                                <th style="cursor: pointer;" >Total Producto</th>
                                <th class="static">Total Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('database/ventas/sql-mostrar-ventas.php') ?>
                        </tbody>
                    </table>
                </div>
            </main>

            <div class="right">
                <?php
                include('partials/top.php') ?>
                </div>

                <div class="recent-activity">
                    <h2>Filtro por Código de Trabajador</h2>
                    <?php
                        include('partials/select-dni.php') ?>
                </div>
        <script src="js/select.js" defer></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $("#select-scroll").click(function(){
                var value = $("#sBtn-text").text();
                console.log(value);
                $.ajax({
                  url:"database/ventas/sql-filtro-ventas-dni.php",
                  type:"POST",
                  data:'request=' + value,
                  beforeSend:function(){
                    $(".recent-sales").html("<span>Working</span>");
                  },
                  success:function(data){
                    $(".recent-sales").html(data);
                  }
                });
            });
        });

        $(document).ready(function(){
            $("#date").change(function(){
                var value = $(this).val();
                console.log(value);
                $.ajax({
                  url:"database/ventas/sql-filtro-ventas-fecha.php",
                  type:"POST",
                  data:'request=' + value,
                  beforeSend:function(){
                    $(".recent-sales").html("<span>Working</span>");
                  },
                  success:function(data){
                    $(".recent-sales").html(data);
                    console.log(data);
                  }
                });
            });
        });

        
    </script>

    
    <script src="js/sidebar.js" defer></script>
    <script src="js/pagination.js" defer></script>
    </body>
</html>
