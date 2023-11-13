<?php
$con = mysqli_connect("localhost","root","","inventario");

//REGISTRAR NUEVO USUARIO

    //isset($_POST['register_usuario_x']) //PARA INPUT IMAGE
    $precio = $_POST['precio'];
    $id_prod = $_POST['id_prod'];

    $query = "SELECT $precio AS resultado
    FROM producto WHERE id_prod = '$id_prod'";
    $r = mysqli_query($con,$query);

    $result = [];

    if($r){
        if(mysqli_num_rows($r)){
            while($row = mysqli_fetch_array($r)){
                $result['precio'] = $row['resultado'];
            }
            echo json_encode($result);
        }else if(!mysqli_num_rows($r)){
            echo json_encode($result);
        }
    }

    

