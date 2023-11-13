<?php

include("../connection.php");

if(isset($_POST['request'])){
    $request = $_POST['request'];
    $query = "SELECT producto.id_prod, producto.nombre, producto.precio, 
    producto.precio_pub, producto.precio_o, producto.precio_m, producto.stock, categoria.nombre_categoria 
    FROM producto 
    inner join categoria 
    on producto.id_categoria=categoria.id_categoria 
    WHERE categoria.nombre_categoria = '$request'";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
}
?>

<h2>Lista de Productos</h2>
<table id="tabla">
    <thead>
        <tr>
            <th class="cursor: pointer;">ID</th>
            <th style="cursor: pointer;" >Nombre</th>
            <th style="cursor: pointer;" >Precio (s/.)</th>
            <th style="cursor: pointer;" >Precio ($)</th>
            <th style="cursor: pointer;" >Precio P.</th>
            <th style="cursor: pointer;" >Precio O.</th>
            <th style="cursor: pointer;" >Precio M.</th>
            <th style="cursor: pointer;" >Stock</th>
            <th class="static">Categoría</th>
        </tr>
    </thead>
        <?php
        if($count){
        ?>
        <tbody>
            <?php
            while($product = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $product['id_prod']?></td>
                <td><?php echo $product['nombre']?></td>
                <td><?php echo $product['precio'] ?></td>
                <td><?php echo $product['precio']*0.27 ?></td>
                <td><?php echo $product['precio_pub']?></td>
                <td><?php echo $product['precio_o']?></td>
                <td><?php echo $product['precio_m']?></td>
                <td><?php echo $product['stock']?></td>
                <td><?php echo $product['nombre_categoria']?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        <?php
        }else{
            include("../producto/sql-mostrar-productos.php");
        }
        ?>
    </table>
</div>
<script src="js/mostrar-usuario.js"></script>
<script src="js/pagination.js" defer></script>