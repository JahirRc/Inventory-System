<?php
/*include('connection.php');

$stmt = $conn->prepare("SELECT producto.id_prod, producto.nombre,
producto.precio, producto.precio_pub, producto.stock,
categoria.nombre_categoria
FROM producto
inner join categoria
on producto.id_categoria=categoria.id_categoria");

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
*/
$query = "SELECT producto.id_prod, producto.nombre,
producto.precio, producto.precio_pub, producto.stock,
categoria.nombre_categoria
FROM producto
inner join categoria
on producto.id_categoria=categoria.id_categoria";

$r = mysqli_query($con,$query);
while($product = mysqli_fetch_assoc($r)){
?>
<tr>
    <td><?php echo $product['id_prod']?></td>
    <td><?php echo $product['nombre']?></td>
    <td><?php echo $product['precio']?></td>
    <td><?php echo $product['precio']*0.27?></td>
    <!--<td><?php /*echo $product['precio']*0.27*/?></td>-->
    <td><?php echo $product['precio_pub']?></td>
    <td><?php echo $product['stock']?></td>
    <td><?php echo $product['nombre_categoria']?></td>
</tr>
<?php
}
?>
