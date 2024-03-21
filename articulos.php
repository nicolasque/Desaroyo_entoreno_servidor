<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>
	<h1>Lista de artículos</h1>


	<?php 


		include "funciones.php";

		if(isset($_COOKIE['tipo_usuario']) && $_COOKIE['tipo_usuario'] == "autorizado") {
			$linkCrearArticulo = "<p><a href='formArticulos.php?accion=anadir'>Añadir artículo</a></p>";
			echo $linkCrearArticulo;
		
		}
		echo "<br>";
		echo pintaProductos('id');

	?>


</body>
</html>