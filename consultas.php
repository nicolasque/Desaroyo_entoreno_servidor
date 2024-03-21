<?php 

	include "conexion.php";

	

	function tipoUsuario($nombre, $correo){
		// Create a connection
		$conn = crearConexion();


		$comprobar = mysqli_fetch_assoc( mysqli_query($conn, "SELECT * FROM user WHERE full_name = '$nombre' AND email ='$correo'"));


		if(!empty($comprobar)){
			if(esSuperadmin($nombre, $correo)){
				setcookie("tipo_usuario", "superAdmin", time()+3600, "/");

				return ("Bienvenido ".$nombre." eres superadmin, accede al control de usuarios: ". "<br>". "<a href='usuarios.php'>Usuarios</a>");
			}

			if($comprobar['enabled'] == 1){
				setcookie("tipo_usuario", "autorizado", time()+3600, "/");
				return ("Bienvenido ".$nombre." eccede a la pagina de articulos: ". "<br>". "<a href='articulos.php'>Articulos</a>");
			}else{
				setcookie("tipo_usuario", "noAutorizado", time()+3600, "/");
				return ("Bienvenido ".$nombre." eccede a la pagina de articulos: ". "<br>". "<a href='articulos.php'>Articulos</a>");
			}
			


		} else{
			return (" Lo sentimos ".$nombre.", no esta registrado " );
		}

	}


	function esSuperadmin($nombre, $correo){
		$conn = crearConexion();

		$sacarIdUsuario= mysqli_fetch_assoc( mysqli_query($conn, "SELECT id FROM user WHERE full_name = '$nombre' AND email ='$correo'"));
		$idUsuario = $sacarIdUsuario['id'];

		$ifSuper= mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM setup WHERE superadmin_id = '$idUsuario'")); 

		if(!empty($ifSuper)){
			echo "Superadmin";
			return true;
		} else{
			return false;
		}


	}


	function getPermisos() {
		// Completar...	
		$conn = crearConexion();
		$permiso =	mysqli_query($conn, "SELECT * FROM setup");
		$permiso = mysqli_fetch_assoc($permiso);
		return $permiso["management"];
	
		
	}


	function cambiarPermisos() {
		$conn = crearConexion();
		
		$tipoPermiso= mysqli_query($conn, "SELECT management FROM setup");
		$tipoPermiso = mysqli_fetch_assoc($tipoPermiso);
		$tipoPermiso = $tipoPermiso['management'];
		if($tipoPermiso == 1){
			mysqli_query($conn, "UPDATE setup SET management = 0");}
			 else{
				mysqli_query($conn, "UPDATE setup SET management = 1");
			}
		

	}


	function getCategorias() {
		// Completar...	
		$conn = crearConexion();
		$categorias = mysqli_query($conn, "SELECT * FROM category");
		$categorias = mysqli_fetch_all($categorias);
		return $categorias;

	}


	function getListaUsuarios() {
		$conn = crearConexion();

		$array = mysqli_query($conn, "SELECT full_name, email, enabled FROM user");

		$tabla= "<table><thead><tr><th>Nombre</th><th>Email</th><th>Permiso</th></tr></thead><tbody>";
		while($fila = mysqli_fetch_assoc($array)){
			$tabla .= "<tr><td>".$fila['full_name']."</td><td>".$fila['email']."</td><td>".$fila['enabled']."</td></tr>";
		}

		$tabla .= "</tbody></table>";
		return $tabla;



	}


	function getProducto($ID) {
		$conn = crearConexion();
		$prodicto = mysqli_query($conn, "SELECT * FROM product WHERE id = '$ID'");
		$prodicto = mysqli_fetch_assoc($prodicto);
		$tabla ="<table><t<head><tr><th>Nombre</th><th>Categoria</th><th>Coste</th><th>Precio</th><th>Id</th></tr>";
		$tabla .= "<tr><td>".$prodicto['name']."</td><td>".$prodicto['category_id']."</td><td>".$prodicto['cost']."</td><td>".$prodicto['price']."</td><td>".$prodicto['id']."</td></tr>";
		$tabla .= "</tbody></table>";
		return $tabla;
	}


	function getProductos($orden) {
		$conn = crearConexion();

		$productos = mysqli_query($conn, "SELECT product.id, product.name, product.cost, product.price, category.name AS category_name FROM product INNER JOIN category ON product.category_id = category.id ORDER BY $orden");
		$productos = mysqli_fetch_all($productos, MYSQLI_ASSOC);

		return $productos;
	}




	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$conn = crearConexion();
		$query = mysqli_query($conn, "INSERT INTO product (name, cost, price, category_id) VALUES ('$nombre', '$coste', '$precio', '$categoria')");
	
		return $query;
	}


	function borrarProducto($id) {
		$conn = crearConexion();
		$query = mysqli_query($conn, "DELETE FROM product WHERE id = '$id'");
		return $query;
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$conn = crearConexion();
		$query = mysqli_query($conn, "UPDATE product SET name = '$nombre', cost = '$coste', price = '$precio', category_id = '$categoria' WHERE id = '$id'");
	
		return $query;

	}

?>