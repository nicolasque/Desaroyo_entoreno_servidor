<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuarios</title>
</head>
<body>

	<h1>Usuarios</h1>
	<?php 

		include "funciones.php";

		if (isset($_COOKIE['tipo_usuario']) && $_COOKIE['tipo_usuario'] == "superAdmin") {
			//$conn = crearConexion();
			//$tipoPermisoActual = mysqli_fetch_assoc(mysqli_query($conn, "SELECT management FROM setup "));

			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				cambiarPermisos();
			}

			echo (" <p>"."Los permisos actuales estan en: ".getPermisos(). "</p>");

			$botonCambiarPermiso = "<form method='POST' action=''><input type='submit' value='Cambiar modo'></form>";
			echo $botonCambiarPermiso;

			echo "<br>";
			$volverInicio = "<a href='index.php'>Volver a inicio</a>";
			echo $volverInicio;

			pintaTablaUsuarios();

		} else {
			echo "No tienes permisos para acceder a esta página, <a href='index.php'> vuelve a inicio de sesion </a>";
		}

	

	?>

</body>
</html>