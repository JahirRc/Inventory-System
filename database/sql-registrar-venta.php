<?php

error_log("Script executed");
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
                $result['stock'] = $row['stock'];
            }
            echo json_encode($result);
        }else if(!mysqli_num_rows($r)){
            //echo "*Producto no encontrado";
            echo json_encode($result);
        }
    }

    return false;
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
if(isset($_POST['detalle_venta'])){
    $detalle_venta = json_decode($_POST['detalle_venta'], true); // Decode the JSON data into an array

    foreach($detalle_venta as $detalle) {
        $id_venta = $detalle['id_venta'];
        $id_prod = $detalle['id_prod'];
        $cantidad = $detalle['cantidad'];
        $precio_unitario = $detalle['precio_unitario'];
        $precio_total = $detalle['precio_total'];
        
        // Insert the details into the detalle_venta table
        $query = "INSERT INTO detalle_venta (id_detallev, id_venta, id_prod, cantidad, precio_unitario, precio_total) 
                  VALUES ('', '$id_venta', '$id_prod', '$cantidad', '$precio_unitario', '$precio_total')";
        mysqli_query($con, $query);

        // Update the stock in the producto table
        $query2 = "UPDATE producto SET stock = stock - $cantidad WHERE id_prod = '$id_prod'";
        mysqli_query($con, $query2);
    }

    // Send success response
    $mensaje['error'] = "Detalles de venta registrados con éxito";
    echo json_encode($mensaje);
}

?>