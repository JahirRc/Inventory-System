<?php
include('./database/connection.php');

//REGISTRAR NUEVO USUARIO
if(isset($_POST['register_usuario'])){
    $dni = $_POST['dni'];
    $nombre_usuario = $_POST['nombre'];
    $apellido_usuario = $_POST['apellido'];
    $contrasena_usuario = $_POST['contrasena'];
    $usuario_usuario = $_POST['usuario'];
    $fecha_creado = date('Y-m-d H:i:s');
    $fecha_actualizado = date('Y-m-d H:i:s');
    $id_cargo = $_POST['cargo'];

    if(empty($dni) || empty($nombre_usuario) || empty($apellido_usuario) || empty($contrasena_usuario) || 
    empty($usuario_usuario) || empty($id_cargo)){
        //header("Location: registrar-producto.php");
        $error = "Debe llenar todos los campos";
    }else{
        $sql = mysqli_query($con,"SELECT * FROM usuarios WHERE dni = '$dni'");
        $result = mysqli_num_rows($sql);

        if($result!=0){
            $error = "Código ya registrado";
        }else{

            //$hash = password_hash($contrasena_usuario, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios (dni, nombre, apellido, contrasena,
            usuario, fecha_creado, fecha_actualizado, id_cargo) VALUES ('$dni',
            '$nombre_usuario', '$apellido_usuario', '$contrasena_usuario',
            '$usuario_usuario', '$fecha_creado', '$fecha_actualizado',
            '$id_cargo')";
            
            mysqli_query($con,$query);

            $dni = "";
            $nombre_usuario = "";
            $apellido_usuario = "";
            $contrasena_usuario = "";
            $usuario_usuario = "";
            $id_cargo = "";

            $error = "Usuario registrado con éxito";
        }
    }
}


//BUSCAR UN USUARIO SEGÚN SU DNI
if(isset($_POST['search_usuario'])){
    $dni = $_POST['dni'];

    $query = "SELECT usuarios.dni, usuarios.nombre, usuarios.apellido, usuarios.contrasena,
    usuarios.usuario, usuarios.id_cargo from usuarios
    WHERE dni = '$dni'";
    
    $r = mysqli_query($con,$query);

    if($r){
        if(mysqli_num_rows($r)){
            while($row = mysqli_fetch_array($r)){
                $dni = $row['dni'];
                $nombre_usuario = $row['nombre'];
                $apellido_usuario = $row['apellido'];
                $contrasena_usuario = $row['contrasena'];
                $usuario_usuario = $row['usuario'];
                $cargo_usuario = $row['id_cargo'];
            }
            $error = "Usuario encontrado";
        }else if(!mysqli_num_rows($r)){
            $error = "Usuario no encontrado";
        }
    }
}


//ACTUALIZAR UN USUARIO (NECESITA HACER UNA BÚSQUEDA)
if(isset($_POST['update_usuario'])){
    $dni = $_POST['dni'];
    $nombre_usuario = $_POST['nombre'];
    $apellido_usuario = $_POST['apellido'];
    $contrasena_usuario = $_POST['contrasena'];
    $usuario_usuario = $_POST['usuario'];
    $fecha_actualizado = date('Y-m-d H:i:s');
    $id_cargo = $_POST['cargo'];

    if(empty($dni) || empty($nombre_usuario) || empty($apellido_usuario) || empty($contrasena_usuario) || 
    empty($usuario_usuario) || empty($id_cargo)){
        //header("Location: registrar-producto.php");
        $error = "Necesita hacer una búsqueda";
    }else{
        $query = "UPDATE usuarios SET usuarios.nombre = '$nombre_usuario' , usuarios.nombre = '$nombre_usuario', 
        usuarios.apellido = '$apellido_usuario', usuarios.contrasena = '$contrasena_usuario', 
        usuarios.usuario = '$usuario_usuario', usuarios.fecha_actualizado = '$fecha_actualizado',
        usuarios.id_cargo = '$id_cargo' WHERE usuarios.dni = '$dni'";
        
        mysqli_query($con,$query);
        
        $dni = "";
        $nombre_usuario = "";
        $apellido_usuario = "";
        $contrasena_usuario = "";
        $usuario_usuario = "";
        $id_cargo = "";

        $error = "Usuario Actualizado";
    }
}


//ELIMINAR UN USUARIO SEGÚN SU DNI
if(isset($_POST['delete_usuario'])){
    $dni = $_POST['dni'];

    if(empty($dni)){
        //header("Location: registrar-producto.php");
        $error = "Ingrese un código válido";
    }else{
        $query = "DELETE FROM usuarios WHERE usuarios.dni = '$dni'";
        mysqli_query($con,$query);
        $error = "Usuario eliminado";
    }
}
?>