<?php 
	require("../modelo/modelo.php");
	$objFormulario = new Formulario();
	$mensajeExito="Registro Exitoso";
	$mensajeError="Error al Registrar: Datos Incompletos";
	//---------------------------------------------------------------------------------------------------------------------------	
	if(isset($_GET["paisSeleccionado"])){
			if($_GET["paisSeleccionado"]!="seleccione_pais"){
				$objFormulario->cargarCiudades($_GET["paisSeleccionado"]);
			}
	}
	//---------------------------------------------------------------------------------------------------------------------------	
	if(isset($_GET["pais_nuevo"])){
			$objFormulario->registrarPaisNuevo($_GET["pais_nuevo"]);
			echo "<script>location.href='../vista/formulario.php';</script>";
			exit();
	}

	//---------------------------------------------------------------------------------------------------------------------------	
	if(isset($_GET["nombres_editar"]) && isset($_GET["apellidos_editar"]) && isset($_GET["email_editar"]) && isset($_GET["pais_editar"]) && isset($_GET["ciudad_editar"]) && isset($_GET["telefono_editar"]) && isset($_GET["descripcion_editar"]) && isset($_GET["pkUsuario_editar"])){
			$objFormulario->modificarUsuario($_GET["pkUsuario_editar"],$_GET["nombres_editar"],$_GET["apellidos_editar"],$_GET["email_editar"],$_GET["pais_editar"],$_GET["ciudad_editar"],$_GET["telefono_editar"],$_GET["descripcion_editar"]);
			echo "<script>location.href='../vista/modificarInformacionUsuario.php';</script>";
	}
	//---------------------------------------------------------------------------------------------------------------------------	
	if(isset($_GET["otraCiudadSeleccionada"])){
		if($_GET["otraCiudadSeleccionada"]=="otra_ciudad"){
			$objFormulario->cargarCampoCiudad();
		}
	}
	//------------------------------------------ REGISTRAR USUARIO--------------------------------------------------------------------------------	
	if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email_"]) && isset($_POST["paises"]) && isset($_POST["ciudades"]) && isset($_POST["telefono"]) && isset($_POST["descripcion"]) && isset($_FILES['imagen']['name']) || isset($_POST["ciudad_nueva"]) ){
			if($_POST["paises"]=="seleccione_pais"){
				echo "<script>location.href='../vista/formulario.php?mensaje=".$mensajeError."';</script>";	
			}else if($_POST["paises"]!="seleccione_pais" && $_POST["ciudades"]=="seleccione_ciudad"){
				echo "<script>location.href='../vista/formulario.php?mensaje=".$mensajeError."';</script>";	
			}
			else if($_POST["ciudades"]=="otra_ciudad"  &&  $_POST["ciudad_nueva"]==""){
				echo "<script>location.href='../vista/formulario.php?mensaje=".$mensajeError."';</script>";					
			}else{
			
			$ciudad="";
			$nombre_archivo = $_FILES['imagen']['name']; 			
			$tipo_archivo = $_FILES['imagen']['type']; 
			$tamano_archivo = $_FILES['imagen']['size'];
			$ruta="../uploads/".$nombre_archivo;
			move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);			
			if($_POST["ciudades"]!="otra_ciudad"){
				$ciudad=$_POST["ciudades"];
			}else{
				$ciudad=$_POST["ciudad_nueva"];
			}
			$objFormulario->registrarUsuario($_POST["nombre"],$_POST["apellido"],$_POST["email_"],$_POST["paises"],$ciudad,$_POST["telefono"],$_POST["descripcion"],$ruta);
			/*echo "<script>location.href='../vista/formulario.php?mensaje=".$mensajeExito."';</script>";*/
			}
		}/*else{
			echo "<script>location.href='../vista/formulario.php?mensaje=".$mensajeError."';</script>";
		}*/
	//-------------------------CARGAR CIUDADES DEPENDIENDO DEL PAIS, PARA FANCY BOX MODIFICAR DATOS USUARIO-------------------------	
	if(isset($_GET["pais_modificar"])){
			if($_GET["pais_modificar"]!="seleccione_pais"){
				$objFormulario->cargarCiudadesModificar($_GET["pais_modificar"]);
			}
	}
	//-------------------------ELIMINAR USUARIO-------------------------	
	if(isset($_GET["eliminar_usuario"])){
		?>
			<script>
            	confirmar=confirm("¿Esta seguro de elimiar el registro?");
				if(confirmar){
					location.href="controlador.php?confirmacion=si&codigo_user=<?php echo $_GET["codigo"]; ?>";
				}else{
					location.href="../vista/modificarInformacionUsuario.php";
				}
           </script>
		<?php
	}
	if(isset($_GET["confirmacion"])){
		$objFormulario->eliminarUsuario($_GET["codigo_user"]);
	}	

?>