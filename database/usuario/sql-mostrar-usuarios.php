<?php
/*include('connection.php');

$stmt = $conn->prepare("SELECT * FROM usuarios");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
*/

$query = "SELECT * from usuarios";

$r = mysqli_query($con,$query);
while($usuario = mysqli_fetch_assoc($r)){
?>
<tr>
    <td><?php echo $usuario['dni']?></td>
    <td><?php echo $usuario['nombre']?></td>
    <td><?php echo $usuario['apellido']?></td>
    <td><?php echo $usuario['usuario']?></td>
    <td><?php echo $usuario['contrasena']?></td>
    <td><?php echo $usuario['fecha_creado']?></td>
    <td><?php echo $usuario['fecha_actualizado']?></td>
</tr>
<?php
}
?>

