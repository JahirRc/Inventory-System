<?php

$query = "SELECT SUM(total) AS total_dia FROM venta where DAY(fecha)=DAY(NOW()) && MONTH(fecha)=MONTH(NOW()) && YEAR(fecha) = YEAR(NOW())";

$r = mysqli_query($con,$query);
$fila = mysqli_fetch_assoc($r);

?>
<h1>
    <?php 
    if($fila['total_dia'] == 0){
        echo '0';
    }else{
        echo $fila['total_dia'];
    }
    ?>
</h1>