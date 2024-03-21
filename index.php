<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<h1></h1>

	<!-- create a form that ask the user for a name and a email -->
	
	<form method="GET"  action="">
		<label for="full_name">Name</label>
		<input type="text" name="full_name" id="name">
		<label for="email">Email</label>
		<input type="email" name="email" id="email">
		<input type="submit" value="Submit">
	</form>

	<?php
	
		include "consultas.php";

		$conn = crearConexion();

		echo tipoUsuario($_GET['full_name'], $_GET['email']);

		echo "<br>";	

	?>	
	
</body>
</html>