<?php

$query = "SELECT SUM(total) AS total_mes FROM venta where MONTH(fecha)=MONTH(NOW())";

$r = mysqli_query($con,$query);
$fila = mysqli_fetch_assoc($r);

?>
<h1>
    <?php 
    if($fila['total_mes'] == 0){
        echo '0';
    }else{
        echo $fila['total_mes'];
    }
    ?>
</h1>