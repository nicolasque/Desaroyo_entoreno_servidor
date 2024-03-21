<?php 
	// Path: conexion.php
	

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac_dwes";

		

		// Crear la conexión
		$conexion = new mysqli($host, $user, $pass, $baseDatos);


		// Comprobar la conexión
		if($conexion->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
		}
			mysqli_select_db($conexion, 'pac_dwes');

			return $conexion;

	}


	function cerrarConexion($conexion) {
		$conexion->close();

	}


?>