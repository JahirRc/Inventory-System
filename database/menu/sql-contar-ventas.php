<?php
$query = "SELECT COUNT(*) totalV FROM venta where MONTH(fecha)=MONTH(NOW())";
$r = mysqli_query($con,$query);
$fila = mysqli_fetch_assoc($r);

?>
<h1>
    <?php echo $fila['totalV']
    ?>
</h1>