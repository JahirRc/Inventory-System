<?php
//include('./database/connection.php');

$query = "SELECT venta.id_venta, venta.dni,
venta.fecha, producto.nombre, detalle_venta.cantidad,
venta.total, detalle_venta.precio_unitario
FROM venta
inner join detalle_venta
on venta.id_venta=detalle_venta.id_venta
inner join producto
on detalle_venta.id_prod=producto.id_prod ORDER BY venta.fecha DESC";

$r = mysqli_query($con,$query);
while($venta = mysqli_fetch_assoc($r)){
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