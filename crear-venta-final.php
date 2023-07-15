<?php
  session_start();
  if(!isset($_SESSION['user'])) header('location: login.php');
  include('database/connection.php');
  $user = $_SESSION['user'];

  $nombre = "";
  $precio = "";
  $id_prod = "";

  $error = "";
  $errorC = "";

  //VALORES VENTA
  $id_venta = "";
  $dni = "";
  $fecha = "";
  $total = "";
  

  //VALORES DETALLE
  $cantidad = "";
  $precio_unitario = "";
  $precio_total = "";

  $error = "";

  include("database/sql-registrar-venta.php");
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
        <!--<script src="js/agregar-producto-venta.js"></script>    -->
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
                <span name="error" id="error"><?php echo $error; ?></span>
            </div>
            <!-- FIN DE SECCIÓN DE FECHA -->
            
            <!-- PRIMERA SECCIÓN DEL MAIN - FORMULARIO -->
            <div class="recent-sales">
                <h2>Registrar Venta</h2>
                
			    <table class="meta">
			    <tr>
					<th><span>ID Venta</span></th>
					<td><span contenteditable name="id_venta" id="id_venta"></span></td>
				</tr>
				<tr>
					<th><span>DNI Vendedor</span></th>
					<td><span name="dni" id="dni"><?php echo $user['dni'] ?></span></td>
				</tr>
				<tr>
					<th><span>Fecha</span></th>
					<td><span name="fecha" id="fecha"><?php date_default_timezone_set('America/Lima'); echo date('Y-m-d H:i:s');?></span></td>
				</tr>
            </table>

            <table class="inventory" style="margin-top: 10px;">
				<thead>
					<tr>
						<th>ID Producto</th>
						<th>Nombre</th>
						<th>Tipo Precio</th>
                        <th>Precio Final</th>
						<th>Cantidad</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody id="elementosP">
					<tr id="elementos">
						<td><a class="cut">-</a><br><br class="espacio1"><span contentEditable class="id" id="id_prod" name="id_prod"></span></td>
						<td><span class="nombre" id="nombre" name="nombre"><?php echo $nombre; ?></span></td>
						<td><span class="tipo" id="tipo" name="tipo">
                            <select style="padding: 0.5rem;" class="input select" name="select-scroll" id="select-scroll" aria-label="Select menu example">
                                <option value="0">Precio</option>
                                <option value="precio">Precio Unitario</option>
                                <option value="precio_pub">Precio Público</option>
                                <option value="precio_o">Precio Oferta</option>
                                <option value="precio_m">Precio por Mayor</option>
                            </select>
                            </span>
                        </td>
                        <td><span class="precio" id="precio" name="precio"><?php echo $precio; ?></span></td>
						<td><span class="cantidad" id="cantidad" name="cantidad" contenteditable>0</span></td>
						<td><span class="precio_total" id="precio_total" name="precio_total"></span></td>
					</tr>
				</tbody>
			</table>
			<a class="add" onClick="crearMas()">+</a>
            <button type="submit" value="Registrar Venta" id="realizar_venta" name="realizar_venta" onClick=funciones() class="login__button">
                <span>Registrar Venta</span>
            </button>  
            
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
            <h2>Total de la Venta</h2>
            <div class="activity">
            <table class="balance" style="height: 20px; margin-top: 10px;">
				<tr>
					<th><span>Total&nbsp&nbsp</span></th>
					<td><span name="total" id="total"></span></td>
				</tr>
				<tr>
            </tr>
			</table>
            </div>
        </div>
        <!-- FIN DE USUARIOS RECIENTES -->
        
        <script src="js/sidebar.js" defer></script>
        <script src="js/agregar-producto-venta-final.js" defer></script>
        <script src="js/registrar-venta.js" defer></script>
        <script>
        </script>
    </body>
</html>