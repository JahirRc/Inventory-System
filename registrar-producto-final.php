<?php
  session_start();
  if(!isset($_SESSION['user'])) header('location: login.php');
  include('database/connection.php');
  $user = $_SESSION['user'];

  $nombre = "";
  $precio = "";
  $precio_pub = "";

  $precio_o = "";
  $precio_m = "";

  $stock = "";
  $categoria = "";
  $id_prod = "";

  //PARA HISTORIAL-----
  $stock_anterior = "";
  //-------------------

  $error = "";
  $errorC = "";

  include("database/producto/sql-producto.php");
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
            
        <main>
            <h1>Sistema de Inventario</h1>
            <div class="date">
                <input type="date" 
                value="<?php $fecha = date_default_timezone_set('America/Lima'); 
                $fecha = date('Y-m-d');
                echo $fecha?>" disabled>
                
                <span style="var(--color-dark);";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $error; ?></span>
            </div>
            
            <div class="recent-sales">
                <h2>Registrar Producto</h2>
                <form action="registrar-producto-final.php" method="POST" id="stripe-login">
                    <section class="login">
                        <div class="wrapper">
                            <label class="login__label">
                                <span>Código</span>
                                <input type="text" class="input" name="id_prod" id="id_prod" autocomplete="off" 
                                value="<?php echo $id_prod;?>">
                            </label>
                            
                            <label class="login__label">
                                <span>Nombre</span>
                                <input type="text" class="input" name="nombre" id="nombre" autocomplete="off" 
                                value="<?php echo $nombre;?>">
                            </label>
                            
                            <label class="login__label">
                                <span>Precio</span>
                                <input type="number" step="any" class="input" name="precio" id="precio" 
                                autocomplete="off" value="<?php echo $precio;?>" >
                            </label>
                            
                            <label class="login__label">
                                <span>Precio Público</span>
                                <input type="number" step="any" class="input" name="precio_pub" id="precio_pub" 
                                autocomplete="off" value="<?php echo $precio_pub;?>">
                            </label>
                            
                            <label class="login__label">
                                <span>Precio Oferta</span>
                                <input type="number" step="any" class="input" name="precio_o" id="precio_o" 
                                autocomplete="off" value="<?php echo $precio_o;?>">
                            </label>
                            
                            <label class="login__label">
                                <span>Precio por Mayor</span>
                                <input type="number" step="any" class="input" name="precio_m" id="precio_m" 
                                autocomplete="off" value="<?php echo $precio_m;?>">
                            </label>
                            
                            <div class="login__label">
                                <span>Stock</span>
                                <input type="number" step="any" class="input" name="stock" id="stock" 
                                value="<?php echo $stock;?>" >
                            </div>
                            
                            <!-- PARA HISTORIAL -->
                            <input type="hidden" name="stock_anterior" id="stock_anterior" value="<?php echo $stock;?>" >
                            <!-------------------------------------------------------------->
                            
                            <div class="login__label">
                                <span>Categorías</span>
                                <select class="input" name="select-scroll" id="select-scroll" aria-label="Select menu example">
                                    <option value="0">Categoría</option>
                                    <?php
                                    $query = "SELECT id_categoria, nombre_categoria from categoria ORDER BY nombre_categoria ASC";
                                    $r = mysqli_query($con,$query);
                                    while($category = mysqli_fetch_assoc($r)){
                                    ?>
                                    <option value=<?= $category['id_categoria']?>
                                    <?php if($category['id_categoria'] == $categoria) echo 'selected="selected"'?>>
                                    <?= $category['nombre_categoria'] ?></td>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <button type="submit" href="registrar-producto-final.php" id="registrar" 
                            name="register_product" class="login__button">
                                <span>Registrar Producto</span>
                            </button>
                            
                            <button type="submit" id="buscar" name="search_product" class="login__button"> 
                                <span>Buscar Producto</span>
                            </button>

                            <button type="submit" name="update_product" class="login__button">
                                <span>Editar Producto</span>
                            </button>
                            
                            <button type="submit" name="delete_product" class="login__button">
                                <span>Eliminar Producto</span>
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </main>
        
        <div class="right">
            <?php
            include('partials/top.php') ?>
            </div>
            
            <div class="recent-activity">
                <h2>Nueva Categoría</h2>
                <form action="registrar-producto-final.php" method="POST" id="stripe-login">
                    <section class="login">
                        <div class="wrapper" style="grid-template-columns: repeat(1, 1fr);">
                            <label class="login__label">
                                <span>Nombre</span>
                                <input type="text" class="input" name="nombre_categoria" id="nombre_categoria" autocomplete="off" 
                                value="<?php ?>">
                            </label>
                            
                            <button type="submit" href="registrar-producto-final.php" id="registrar" name="register_categoria" class="login__button">
                                <span>Registrar Categoría</span>
                            </button>

                            <span style="var(--color-dark);";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $errorC; ?></span>
                        </div>
                    </section>
                </form>

                <div class="recent-activity">
                    <h2>Últimos Productos</h2>
                    <div class="activity">
                        <?php
                        $query = "SELECT * FROM producto ORDER BY fecha_creado DESC LIMIT 2";
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
                            <p>'.'Se creó el producto '.$ac[1].'. con código '.$ac[0].' y stock inicial de '.$ac[6].'</p>
                            <small class="text-muted">'.$ac[8].'</small>
                            </div>
                            </div>';
                        }
                        ?>
                    </div>

                <!--<div class="wrapper" style="margin-top: 20px">
                    <span style="var(--color-dark);";><?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $error; ?></span>
                </div>-->
            </div>
        </div>
        <script src="js/sidebar.js" defer></script>
    </body>
</html>