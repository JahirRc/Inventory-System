<?php
$query = "SELECT COUNT(*) total FROM usuarios";
$r = mysqli_query($con,$query);
$fila = mysqli_fetch_assoc($r);

?>
<?php echo $fila['total']
?>