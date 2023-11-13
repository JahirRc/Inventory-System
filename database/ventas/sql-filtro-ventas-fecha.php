<?php

include('../connection.php');

if(isset($_POST['request'])){
    $request = $_POST['request'];
    $query = "SELECT venta.id_venta, venta.dni,
    venta.fecha, producto.nombre, detalle_venta.cantidad,
    venta.total, detalle_venta.precio_unitario
    FROM venta
    inner join detalle_venta
    on venta.id_venta=detalle_venta.id_venta
    inner join producto
    on detalle_venta.id_prod=producto.id_prod
    WHERE venta.fecha LIKE '$request%'";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
}
?>

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
        <?php
        if($count){
        ?>
        <tbody>
            <?php
            while($venta = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $venta['id_venta']?></td>
                <td><?php echo $venta['dni']?></td>
                <td><?php echo $venta['fecha']?></td>
                <td><?php echo $venta['nombre']?></td>
                <td><?php echo $venta['cantidad']?></td>
                <td><?php echo 's/. '.$venta['cantidad']*$venta['precio_unitario']?></td>
                <td><?php echo 's/. '.$venta['total']?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        <?php
        }else{
            include("sql-mostrar-ventas.php");
        }
        ?>
    </table>
</div>
<script src="js/mostrar-usuario.js"></script>
<script src="js/pagination.js" defer></script>