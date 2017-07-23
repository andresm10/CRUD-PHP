<link href="../css/estilos_tabla.css" rel="stylesheet" type="text/css" />
<?php
	require "../conexion/conexion.php";
	class Formulario{
		var $conn;
		var $conexion;
		var $mensajeExito;
		var $mensajeError;
		function Formulario(){
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
			$this->mensajeExito="Registro Exitoso";
			$this->mensajeError="Error al Registrar";
		}
		//---------------------------------------------------------------------------------------------------------------------------		
		function registrarUsuario($nombre, $apellidos, $email, $pais, $ciudad, $telefono, $descripcion, $imagen){
			
			$queryRegistrar = "insert into usuarios (nombre, apellido, email, pais, ciudad, telefono, descripcion, imagen) values ('".$nombre."', '".$apellidos."', '".$email."', '".$pais."', '".$ciudad."', '".$telefono."', '".$descripcion."', '".$imagen."')";			
			$registrar = mysqli_query($this->conn, $queryRegistrar) or die(mysqli_error());
			
			$queryRegistrar="insert into ciudades (pkpais, ciudad) values (".$pais.", '".$ciudad."')";
			mysqli_query($this->conn, $queryRegistrar) or die(mysql_error());
			
			if($registrar){
				//echo $this->mensajeExito;
				echo "<script>location.href='../vista/formulario.php?mensaje=". $this->mensajeExito."';</script>";				
			}else{
				//echo $this->mensajeError;
				echo "<script>location.href='../vista/formulario.php?mensaje=".$this->mensajeError."';</script>";
			}
		}
		//---------------------------------------------------------------------------------------------------------------------------		
		function registrarPaisNuevo($pais){
			
			$queryRegistrar = "insert into paises (pais) values ('".$pais."')";
			$registrar = mysqli_query($this->conn, $queryRegistrar) or die(mysqli_error());
			if($registrar){
				echo $this->mensajeExito;				
			}else{
				echo $this->mensajeError;
			}
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function cargarPaises(){
			$queryConsulta="select * from paises order by pais asc";
			$result = mysqli_query($this->conn, $queryConsulta) or die(mysqli_error());
			echo "<select name='paises' id='paises' onchange='ciudadesSegunPais();'>";
			echo "<option value='seleccione_pais' selected='selected'>Seleccione</option>";
			while($campo=mysqli_fetch_array($result)){
				echo "<option value='".$campo['pkPais']."'> ".$campo['pais']." </option>";
			}
			echo "</select>";			
		}
		function cargarPaisesModificar(){
			$queryConsulta="select * from paises order by pais asc";
			$result = mysqli_query($this->conn, $queryConsulta) or die(mysqli_error());
			echo "<select id='paises_modificar' onchange='cargarCiudades();'>";
			echo "<option value='seleccione_pais' selected='selected'>Seleccione</option>";
			while($campo=mysqli_fetch_array($result)){
				echo "<option value='".$campo['pkPais']."'> ".$campo['pais']." </option>";
			}
			echo "</select>";			
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function cargarCiudades($pkPais){
			$queryConsulta="select * from ciudades where pkpais = ".$pkPais;
			$result = mysqli_query($this->conn, $queryConsulta) or die(mysqli_error());
			echo "<label>Ciudad</label><br><select name='ciudades' id='ciudades' onchange='campoCiudad();'>";
			echo "<option value='seleccione_ciudad' selected='selected'> Seleccione... </option>";
			while($campo=mysqli_fetch_array($result)){
				echo "<option value='".$campo['ciudad']."'> ".$campo['ciudad']." </option>";
			}
			echo "<option value='otra_ciudad'>Nueva Ciudad</option>";
			echo "</select>";
		}
		function cargarCiudadesModificar($pkPais){
			$queryConsulta="select * from ciudades where pkpais = ".$pkPais;
			$result = mysqli_query($this->conn, $queryConsulta) or die(mysqli_error());
			echo "<select name='ciudades' id='ciudades'>";
			echo "<option value='seleccione_ciudad' selected='selected'> Seleccione</option>";
			while($campo=mysqli_fetch_array($result)){
				echo "<option value='".$campo['ciudad']."'> ".$campo['ciudad']." </option>";
			}			
			echo "</select>";
		}
		//---------------------------------------------------------------------------------------------------------------------------		
		function cargarCampoCiudad(){
			echo "<br><input type='text' name='ciudad_nueva' id='ciudad_nueva' required='required' placeholder='Ingresa la nueva Ciudad'  onblur='ingreseCiudad();' />";
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function listarUsuarios(){
			$sql="select * from usuarios order by nombre asc";
			$rs=mysqli_query($this->conn, $sql);
			$i=0;
			if(mysqli_num_rows($rs)<1){
				echo "No hay usuarios registrados";	
			}else{
			 echo "<table border='0' align='center' class='table_' >";
			 echo "<thead><th>Nombres</th><th>Apelldios</th><th>Email</th><th>Pais</th><th>Ciudad</th><th>Tel&eacute;fono</th><th>Descripci&oacute;n</th><th>Modificar</th><th>Eliminar</th></thead>";
			 while ($row = mysqli_fetch_array($rs)){	
			 			 					 								
			echo "<td align='center'>".$row["nombre"]."</td>";
			echo "<td align='center'>".$row["apellido"]."</td>";	
			echo "<td align='center'>".$row["email"]."</td>";			
			$sqlPais = "select * from paises where pkPais = ".$row["pais"];
			$rsPais = mysqli_query($this->conn, $sqlPais);
			$rowPais = mysqli_fetch_array($rsPais);
			echo "<td align='center'>".$rowPais["pais"]."</td>";	
			echo "<td align='center'>".$row["ciudad"]."</td>";			
			echo "<td align='center'>".$row["telefono"]."</td>";			
			echo "<td align='center'>".$row["descripcion"]."</td>";
						
			echo '<td align="center">
			<a class="fancybox fancybox.iframe" href="../vista/fancyBoxModificarUsuario.php?nombres='.$row["nombre"].'&apellidos='.$row["apellido"].'&email='.$row["email"].'&pais='.$row["pais"].'&ciudad='.$row["ciudad"].'&telefono='.$row["telefono"].'&descripcion='.$row["descripcion"].'&imagen='.$row["imagen"].'&pk='.$row["pkUsuario"].'" >Editar</a></td>';
			echo "<td><a href='../control/controlador.php?eliminar_usuario=si&codigo=".$row["pkUsuario"]."'>Eliminar</a></td></tr>";
			$i++; 
			}			
			}
			echo "</table>";
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function modificarUsuario($pk, $nombre, $apellido, $email, $pais, $ciudad, $telefono, $descripcion){
			$queryUpdate = "update usuarios set nombre = '".$nombre."', apellido = '".$apellido."', email = '".$email."', pais = '".$pais."', ciudad = '".$ciudad."', telefono = '".$telefono."', descripcion = '".$descripcion."' where pkUsuario = ".$pk;
			$update =mysqli_query($this->conn, $queryUpdate);
			if($update){
				echo "Actualizacion Exitosa";
			}else{
				echo "Error Al Actualizar";
				}
		}
		//---------------------------------------------------------------------------------------------------------------------------
		function eliminarUsuario($pk){
			$queryDelete = "delete from usuarios where pkUsuario = ".$pk;
			$delete =mysqli_query($this->conn, $queryDelete);
			if($delete){						
				echo "<script>
						alert('Eliminacion exitosa');
						location.href='../vista/modificarInformacionUsuario.php';
				</script>";				
			}else{
				echo "<script>
						alert('Error Al Eliminar');
						location.href='../vista/modificarInformacionUsuario.php';
				</script>";	
				}
		}
	}
?>