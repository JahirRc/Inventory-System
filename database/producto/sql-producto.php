<?php
include('./database/connection.php');

//REGISTRAR PRODUCTO (NECESITA TODOS LOS CAMPOS LLENOS)
if(isset($_POST['register_product'])){
    $id_prod = $_POST['id_prod'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $precio_pub = $_POST['precio_pub'];
    $precio_o = $_POST['precio_o'];
    $precio_m = $_POST['precio_m'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['select-scroll'];

    //PARA EL HISTORIAL -------
    $usuario = $user['nombre'];
    //-------------------------

    if(empty($id_prod) || empty($nombre) || empty($precio) || empty($precio_pub) || empty($precio_o)  
    || empty($precio_m) || empty($stock) || empty($id_categoria)){
        //header("Location: registrar-producto.php");
        $error = "Debe llenar todos los campos";
    }else{
        $sql = mysqli_query($con,"SELECT * FROM producto WHERE id_prod = '$id_prod' or nombre = '$nombre'");
        $result = mysqli_num_rows($sql);

        if($result!=0){
            $error = "Producto ya existente";
        }else{

            //PARA EL HISTORIAL -------------------------------
            $fecha = date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d H:i:s');
            //-------------------------------------------------

            $query = "INSERT INTO producto (id_prod, nombre, precio, precio_pub, precio_o, precio_m,
            stock, id_categoria, fecha_creado, fecha_actualizado) VALUES ('$id_prod','$nombre', '$precio', '$precio_pub',
            '$stock', '$id_categoria', '$precio_o', '$precio_m', '$fecha', '$fecha')";
            mysqli_query($con,$query);

            //PARA EL HISTORIAL ---------------------------------------------------------------------------------------------
            /*$query2 = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
            VALUES ('$id_prod', '$fecha', CONCAT('Se creó el producto ', '$id_prod', ' - ', '$nombre ', 'por el usuario ', '$usuario'))";
            mysqli_query($con,$query2);
            */
            $query2 = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
            VALUES ('$id_prod', '$fecha', CONCAT('Se creó el producto ', '$nombre', ' con stock ', '$stock',
            ' por el usuario ', '$usuario'))";
            mysqli_query($con,$query2);
            //---------------------------------------------------------------------------------------------------------------

            $id_prod = "";
            $nombre = "";
            $precio = "";
            $precio_pub = "";
            $stock = "";
            $categoria = "";
            $error = "Producto registrado correctamente";
        }
    }
}


//BUSCAR PRODUCTO (NECESITA EL ID)
if(isset($_POST['search_product'])){
    $id_prod = $_POST['id_prod'];

    $query = "SELECT producto.id_prod, producto.nombre, producto.precio, producto.precio_pub,
    producto.precio_o, producto.precio_m, producto.stock, producto.id_categoria
    from producto
    WHERE producto.id_prod = '$id_prod'";
    
    $r = mysqli_query($con,$query);

    if($r){
        if(mysqli_num_rows($r)){
            while($row = mysqli_fetch_array($r)){
                $id_prod = $row['id_prod'];
                $nombre = $row['nombre'];
                $precio = $row['precio'];
                $precio_pub = $row['precio_pub'];
                $precio_o = $row['precio_o'];
                $precio_m = $row['precio_m'];
                $stock = $row['stock'];
                $categoria = $row['id_categoria'];
                $stock_anterior = $row['stock'];
            }
            $error = "Producto encontrado";
        }else if(!mysqli_num_rows($r)){
            $error = "Producto no encontrado";
        }
    }
}


//ACTUALIZAR PRODUCTO (NECESITA HABER HECHO UNA BÚSQUEDA)
if(isset($_POST['update_product'])){
    $id_prod = $_POST['id_prod'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $precio_pub = $_POST['precio_pub'];
    $precio_o = $_POST['precio_o'];
    $precio_m = $_POST['precio_m'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['select-scroll'];

    //PARA EL HISTORIAL -----------------------
    $usuario = $user['nombre'];
    $stock_anterior = $_POST['stock_anterior'];
    //-----------------------------------------

    if(empty($id_prod) || empty($id_categoria)){
        //header("Location: registrar-producto.php");
        $error = "Necesita hacer una búsqueda";
    }else{

        //PARA EL HISTORIAL -------------------------------
        $fecha = date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        //-------------------------------------------------

        $query = "UPDATE producto SET producto.nombre = '$nombre' , producto.precio = '$precio', 
        producto.precio_pub = '$precio_pub', producto.precio_o = '$precio_o', producto.precio_m = '$precio_m',
        producto.stock = '$stock', producto.id_categoria = '$id_categoria', producto.fecha_actualizado = '$fecha' 
        WHERE producto.id_prod = '$id_prod'";
        mysqli_query($con,$query);

        //PARA EL HISTORIAL --------------------------------------------------------------------------------------
        /*$query2 = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
        VALUES ('$id_prod', '$fecha', CONCAT('Se actualizó el producto ', '$id_prod', ' - ', '$nombre', 
        ' con stock de ', '$stock_anterior', ' a ', '$stock', ' por el usuario ', '$usuario'))";
        mysqli_query($con,$query2);
        */
        $query2 = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
        VALUES ('$id_prod', '$fecha', CONCAT('Se actualizó el producto, su stock cambió de ', '$stock_anterior', 
        ' a ', '$stock', ' por el usuario ', '$usuario'))";
        mysqli_query($con,$query2);
        //-------------------------------------------------------------------------------------------------------
        
        $id_prod = "";
        $nombre = "";
        $precio = "";
        $precio_pub = "";
        $stock = "";
        $categoria = "";
        $error = "Producto actualizado correctamente";

        sleep(1);

        header('Location: mostrar-productos-final.php');
    }
}


//ELIMINAR PRODUCTO (NECESITA EL ID)
if(isset($_POST['delete_product'])){
    $id_prod = $_POST['id_prod'];

    //PARA EL HISTORIAL -------
    $usuario = $user['nombre'];
    //-------------------------

    if(empty($id_prod)){
        //header("Location: registrar-producto.php");
        $error = "Ingrese un código válido";
    }else{

        //PARA EL HISTORIAL -------------------------------
        $fecha = date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        //-------------------------------------------------

        //PARA EL HISTORIAL ---------------------------------------------------------------------------------------------
        /*$query = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
        VALUES ('$id_prod', '$fecha', CONCAT('Se eliminó el producto ', '$id_prod', ' por el usuario ', '$usuario'))";
        mysqli_query($con,$query);
        */
        $query = "INSERT INTO historial_actividad (id_prod, fecha_realizado, descripcion)
        VALUES ('$id_prod', '$fecha', CONCAT('Se eliminó el producto por el usuario ', '$usuario'))";
        mysqli_query($con,$query);
        //--------------------------------------------------------------------------------------------------------------

        $query2 = "DELETE FROM producto where id_prod = '$id_prod'";
        mysqli_query($con,$query2);
        
        $id_prod = "";
        $nombre = "";
        $precio = "";
        $precio_pub = "";
        $stock = "";
        $categoria = "";
        
        $error = "Producto eliminado";
    }
}


//REGISTRAR CATEGORÍA
if(isset($_POST['register_categoria'])){
    $nombre_categoria = $_POST['nombre_categoria'];
    $fecha = date('Y-m-d H:i:s');

    if(empty($nombre_categoria)){
        $errorC = "Rellene el campo correctamente";
    }else{
        $sql = mysqli_query($con,"SELECT * FROM categoria WHERE nombre_categoria = '$nombre_categoria'");
        $result = mysqli_num_rows($sql);

        if($result!=0){
            $errorC = "Categoría ya existente";
        }else{
            $query = "INSERT INTO categoria (id_categoria, nombre_categoria, fecha) 
            VALUES ('','$nombre_categoria', '$fecha')";

            $errorC = "Categoría agregada correctamente";

            $nombre_categoria = "";
            
            mysqli_query($con,$query);
        }
    }
}
?>

