<?php
$query = "SELECT id_prod, fecha_realizado, descripcion from historial_actividad 
/*where MONTH(fecha_realizado)=MONTH(NOW())*/ ORDER BY fecha_realizado desc";

$r = mysqli_query($con,$query);
while($historial = mysqli_fetch_assoc($r)){
?>
<tr>
    <td><?php echo $historial['id_prod']?></td>
    <td><?php echo $historial['descripcion']?></td>
    <td><?php echo $historial['fecha_realizado']?></td>
</tr>
<?php
}
?>
