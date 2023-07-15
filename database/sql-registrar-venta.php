<?php
include('connection.php');

//BUSCAR PRODUCTO (NECESITA EL ID)
if(isset($_POST['id_prod'])){
    $id_prod = $_POST['id_prod'];

    $query = "SELECT producto.nombre, producto.precio, producto.stock
    from producto
    WHERE producto.id_prod = '$id_prod'";
    
    $r = mysqli_query($con,$query);

    $result = [];

    if($r){
        if(mysqli_num_rows($r)){
            while($row = mysqli_fetch_array($r)){
                $result['nombre'] = $row['nombre'];
                //PARA MOSTRAR QUE NO HAY STOCK
                if($row['stock'] == 0){
                    $result['precio'] = "NO HAY STOCK";
                }else{
                    $result['precio'] = $row['precio'];
                }
            }
            echo json_encode($result);
        }else if(!mysqli_num_rows($r)){
            //echo "*Producto no encontrado";
            echo json_encode($result);
        }
    }
}


//DATOS DE LA VENTA
if(isset($_POST['id_venta'])){
    $id_venta = $_POST['id_venta'];
    $dni = $_POST['dni'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
    
    $mensaje = [];

    if(empty($id_venta) || empty($dni) || empty($total)){
        //header("Location: registrar-producto.php");
        $mensaje['error'] = "DEBE LLENAR LOS CAMPOS ID, DNI Y AGREGAR POR LO MENOS UN PRODUCTO";
        echo json_encode($mensaje);
    }else{
        $sql = mysqli_query($con,"SELECT * FROM venta WHERE id_venta = '$id_venta'"); // EJEMPLO : 3 -> EXISTE = MUESTRA , NO EXISTE = NADA
        $result = mysqli_num_rows($sql); // EJEMPLO : 3 -> EXISTE = 1 , NO EXISTE = 0

        if($result!=0){
            $mensaje['error'] = $result; // DEVUELVE 1 $MENSAJE['ERROR] = 1;
            echo json_encode($mensaje);
        }else{
            
            $query = "INSERT INTO venta (id_venta, dni, fecha, total) 
            VALUES ('$id_venta', '$dni', '$fecha', '$total')";
                
            mysqli_query($con,$query);

            $query2 = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
            VALUES ('$id_venta', '$fecha', CONCAT('El usuario con dni ', '$dni', ' hizo una venta de ', '$total',
            ' soles'))";

            mysqli_query($con,$query2);
        
            $mensaje['error'] = "VENTA REGISTRADA CON ÉXITO";
            echo json_encode($mensaje);
        }
    }

};


//DATOS DEL DETALLE DE LA VENTA
if(isset($_POST['precio_total'])){
    //$id_venta = $_POST['id_venta'];
    $id_prod = $_POST['id_prod'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $precio_total = $_POST['precio_total'];
    
    $mensaje = [];

    /*if(empty($precio_total)){
        //header("Location: registrar-producto.php");
        $mensaje['error'] = "DEBE AGREGAR UN PRODUCTO";
        echo json_encode($mensaje);
    }else{*/

        /*$sql = mysqli_query($con,"SELECT * FROM detalle_venta WHERE id_venta = '$id_venta'");
        $result = mysqli_num_rows($sql);

        if($result){
            $mensaje['error'] = "ID YA USADO";
            echo json_encode($mensaje);
        }else{
            */
            $query = "INSERT INTO detalle_venta (id_detallev, id_venta, id_prod, cantidad, precio_unitario, precio_total) 
            VALUES ('', '$id_venta', '$id_prod', '$cantidad', '$precio_unitario', '$precio_total')";
                
            mysqli_query($con,$query);

            $query2 = "UPDATE producto SET stock = stock - $cantidad WHERE id_prod = '$id_prod'";

            mysqli_query($con,$query2);
        //}
    //}

};

?>