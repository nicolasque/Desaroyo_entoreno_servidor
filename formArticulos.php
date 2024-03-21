<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<h1>Formulario de artículos</h1>
	<!--  -->




	<form method="GET" >
			<label for="id">ID</label>
			<input type="number" name="id" id="id" readonly value="<?php echo isset( $_GET['id']) ? $_GET['id'] : '' ?>">

			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" value="<?php echo isset( $_GET['name']) ? $_GET['name'] : '' ?>">
			
			<label for="price">Precio</label>
			<input type="number" name="price" id="price" value="<?php echo isset( $_GET['precio']) ? $_GET['precio'] : '' ?>">
			<label for="cost">Coste</label>
			<input type="number" name="cost" id="cost" value="<?php echo isset( $_GET['coste']) ? $_GET['coste'] : '' ?>">

			<label for="type">Tipo</label>
			<select name="type" id="type">
		<?php 
			include "funciones.php";
			pintaCategorias(1);

			 //$accuin coge que tipo de boton se mostarara en pantalla			
				$accion = $_GET['accion'];
				if ($accion == 'anadir' || $_GET['anadir'] == 'Añadir') {
			
					echo "<input type='submit' value='Añadir' name='anadir'>";
					

				}else if($accion == 'borrar' || $_GET['borrar'] == 'Borrar'){
					echo "<input type='submit' value='Borrar' name='borrar'>";

				} else if($accion == 'editar' || $_GET['editar'] == 'Editar'){
					echo "<input type='submit' value='Editar' name='editar'>";
				}


				echo "</form>";//necesario para cerrar el formulario
	

			echo "<br>";
			echo "<a href='articulos.php'>Volver a la lista de artículos</a>";


			//caudno es añadir
			if(isset($_GET['anadir'])) {

				anadirProducto($_GET['name'], $_GET['cost'], $_GET['price'], $_GET['type']);
				echo "<h1>"."Atriculo añadido"."</h1>";

				//cuadno es borrar
			}else if(isset($_GET['borrar'])) {

				borrarProducto($_GET['id']);
				echo "<h1>"."Atriculo borrado"."</h1>";


			}else if(isset($_GET['editar'])) {

				editarProducto($_GET['id'], $_GET['name'], $_GET['cost'], $_GET['price'], $_GET['type']);
				echo "<h1>"."Atriculo editado"."</h1>";

			}
			

	
	?>

	
</body>
</html>