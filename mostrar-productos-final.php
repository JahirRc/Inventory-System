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
                    <h2>Lista de Productos</h2>
                    <table id="tabla">
                        <thead>
                            <tr>
                            <th class="cursor: pointer;">ID</th>
                            <th style="cursor: pointer;" >Nombre</th>
                            <th style="cursor: pointer;" >Precio (s/.)</th>
                            <th style="cursor: pointer;" >Precio ($)</th>
                            <th style="cursor: pointer;" >Precio Público</th>
                            <th style="cursor: pointer;" >Stock</th>
                            <th class="static">Categoría</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include('database/producto/sql-mostrar-productos.php') ?>
                      
                        </tbody>
                    </table>
                </div>
            </main>

            <div class="right">
                <?php
                include('partials/top.php') ?>
                </div>

                <div class="recent-activity">
                    <h2>Filtro por Categoría</h2>
                    <?php
                        include('partials/select.php') ?>
                </div>
        <script src="js/select.js" defer></script>

        <script type="text/javascript">
        $(document).ready(function(){
            $("#select-scroll").click(function(){
                var value = $("#sBtn-text").text();
                console.log(value);
                $.ajax({
                  url:"database/categorias/sql-filtro-categoria.php",
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
    </script>
    <script src="js/sidebar.js" defer></script>
    <script src="js/pagination.js" defer></script>
    </body>
</html>