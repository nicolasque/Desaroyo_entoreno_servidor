<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		$categorias = getCategorias();
		echo ("<p>Categorias</p>".$categorias[0]['name']);


		for($i = 0; $i < count($categorias); $i++) {			//
	
			$idCategoria = $categorias[$i][0];	
			$nombreCategoria = $categorias[$i][1];
			if($idCategoria == $defecto) {
				echo "<option value='$idCategoria' selected>$nombreCategoria</option>";
			} else {
				echo "<option value='$idCategoria'>$nombreCategoria</option>";
			}

		}

	}
	

	function pintaTablaUsuarios(){
		echo getListaUsuarios();

	}

		
	function pintaProductos($orden) {

		$table = "<table><thead><tr>
		<th><a href='?orden=id'>Id</a></th>
		<th><a href='?orden=name'>Nombre</a></th>
		<th><a href='?orden=cost'>Coste</a></th>
		<th><a href='?orden=price'>Precio</th></a>
		<th><a href='?orden=category_id'>Categoria</a></th>
		<th>Acciones</th>
		</tr></thead><tbody>";
		if(isset($_GET['orden'])) {
			$orden = $_GET['orden'];
		}

		
		for($i = 0; $i < count(getProductos($orden)); $i++) {
			$nombre= getProductos($orden)[$i]['name'];
			$id= getProductos($orden)[$i]['id'];
			$coste= getProductos($orden)[$i]['cost'];
			$precio= getProductos($orden)[$i]['price'];
			if(getPermisos()==1){
				$editarBorrar = "<td><a href='formArticulos.php?accion=editar&id=$id&name=$nombre&coste=$coste&precio=$precio'>Editar</a> -
				 					 <a href='formArticulos.php?accion=borrar&id=$id&name=$nombre&coste=$coste&precio=$precio'>Borrar</a></tr>";//Boton editar y borrar 
				}else{
					$editarBorrar = "<td>Acciones no disponibles</td>";
				}

			$table .= "<tr><td>".$id."</td>
			<td>".getProductos($orden)[$i]['name']."</td>
			<td>".getProductos($orden)[$i]['cost']."</td>
			<td>".getProductos($orden)[$i]['price']."</td>
			<td>".getProductos($orden)[$i]['category_name']."</td>".$editarBorrar; //Ay que añadir los botones de editar y borrar
			
			
			
		}
		$table .= "</tbody></table>";

		return $table;

	}

?>