<?php
$query = "SELECT COUNT(*) totalV FROM venta where DAY(fecha)=DAY(NOW())";
$r = mysqli_query($con,$query);
$fila = mysqli_fetch_assoc($r);

?>
<h1>
    <?php echo $fila['totalV']
    ?>
</h1>