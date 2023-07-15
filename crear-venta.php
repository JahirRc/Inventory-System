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
<!-- SELECT producto.id_prod, producto.nombre, producto.precio, producto.precio_pub, producto.stock, categoria.nombre_categoria FROM producto inner join categoria on producto.id_categoria=categoria.id_categoria WHERE categoria.nombre_categoria = 'Carcasas';-->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/registrar-venta.css?parameter=2">
    <link rel="stylesheet" href="css/menu.css?parameter=2">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!----==== JQUERY ==== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

	<script src="js/agregar-producto-venta.js"></script>
    
    <title>Admin Dashboard Panel</title>
</head>
<body onload="updateInvoice()">
    <nav>
	<?php
        if($user['id_cargo'] == 1){
            include('partials/sidebar.php');
        }else if($user['id_cargo'] == 2){
            include('partials/sidebar-usuario.php');
        }
        ?>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <!--<div class="search-box">
                <i class="uil uil-store"></i>
                <input type="text" placeholder="SISTEMA DE INVENTARIO" disabled>
            </div>-->
        </div>
        <div class="wrapper">
        <h1>Venta</h1>
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
				<!--<tr>
					<th><span>Amount Due</span></th>
					<td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
				</tr>
-->
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th>ID Producto</th>
						<th>Nombre</th>
						<th>Precio Unitario</th>
						<th>Cantidad</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr id="elementos">
						<td><a class="cut">-</a><span contenteditable class="id" id="id_prod" name="id_prod"></span></td>
						<td><span class="nombre" id="nombre" name="nombre"><?php echo $nombre; ?></span></td>
						<td><span class="precio" id="precio" name="precio"><?php echo $precio; ?></span></td>
						<td><span class="cantidad" id="cantidad" name="cantidad" contenteditable>0</span></td>
						<td><span class="precio_total" id="precio_total" name="precio_total"></span></td>
					</tr>
				</tbody>
			</table>
			<a class="add" onClick="crearMas()">+</a>
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span name="total" id="total"></span></td>
				</tr>
				<tr>
				<td><span name = "error" id="error"><?php echo $error; ?></span></td>
</tr>
				<!--<tr>
					<th><span>Amount Paid</span></th>
					<td><span data-prefix>$</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span>Balance Due</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
-->
			</table>
			<div class="input-box button">
				<input type="Submit" value="Registrar Venta" id="realizar_venta" name="realizar_venta" onClick=funciones()>
			</div>
		</div>
		</article>
    </section>

	
	<!-- https://codeanddeploy.com/blog/php/how-to-return-json-response-in-php-mysql-using-ajax-and-jquery
	https://www.nicesnippets.com/blog/ajax-post-request-with-jquery-and-php
	https://www.tutorialspoint.com/how-to-send-button-value-to-php-backend-via-post-using-ajax
-->
    <script src="js/menu.js"></script>
    <script src="js/registrar-venta.js"></script>
</script>
</body>
</html>