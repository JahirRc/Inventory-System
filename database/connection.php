<?php
	/*$servername = 'localhost';
	$usuario = 'root';
	$contrasena = '';

	//Conectando
	try{
		$conn = new PDO("mysql:host=$servername;dbname=inventario", $usuario, $contrasena);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo 'Conectado';
	} catch (\Exception $e){
		$error_message = $e->getMessage();
	}
	*/
	$con = mysqli_connect("localhost","root","","inventario");
?>