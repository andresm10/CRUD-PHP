<?php 
	require ("../modelo/modelo.php");
	$objModelo = new Formulario();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript" src="../ajax/ajax.js"></script>

<script type="text/javascript">
	var nombre = "", apellido="", ciudad="", telefono="", descripcion="", imagen="", pais="", pk="", email="";
	document.getElementById("label_ciudad").innerHTML="";
	//________________________________________________________________________________________________________________________
	function validarEmail() {		
		email = document.getElementById("email_editar").value; 
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)){			
			document.getElementById('email_valido').innerHTML = 'Email Valido';  
		} else {			
			document.getElementById('email_valido').innerHTML = 'Email Invalido';  
		}
	}
		//________________________________________________________________________________________________________________________
function validarNumero(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; // Solo acepta números 	
    te = String.fromCharCode(tecla); 	
    return patron.test(te);  
} 
	//________________________________________________________________________________________________________________________	
	function modificarInformacion(){
		nombres = document.getElementById("nombres_editar").value;
		apellido = document.getElementById("apellidos_editar").value;
		email = document.getElementById("email_editar").value;
		pais = document.getElementById("paises_modificar").value;
		ciudad = document.getElementById("ciudades").value;
		telefono = document.getElementById("telefono_editar").value;
		descripcion = document.getElementById("descripcion_editar").value;
		pk = document.getElementById("pk_editar").value;
		if(nombres!="" && apellido!="" && email!="" && pais!="" && ciudad!="" && telefono!="" && descripcion!="" && pais!="seleccione_pais" && ciudad!="seleccione_ciudad"){
			ajax_("../control/controlador.php?nombres_editar="+nombres+"&apellidos_editar="+apellido+"&email_editar="+email+"&pais_editar="+pais+"&ciudad_editar="+ciudad+"&telefono_editar="+telefono+"&descripcion_editar="+descripcion+"&pkUsuario_editar="+pk);	
		}else{
			alert("Ingrese toda la informacion.");	
		}		
	}
	//________________________________________________________________________________________________________________________	
	function cargarCiudades(){
		pais = document.getElementById("paises_modificar").value;
		ajax_2("../control/controlador.php?pais_modificar="+pais);	
	}
</script>
</head>

<body>
	<form>
    <?php	
		if(isset($_GET["nombres"]) && isset($_GET["apellidos"]) && isset($_GET["email"]) && isset($_GET["pais"]) && isset($_GET["ciudad"]) && isset($_GET["telefono"]) && isset($_GET["descripcion"]) && isset($_GET["imagen"])){
			$pk=$_GET["pk"];
			$nombres=$_GET["nombres"];
			$apellidos=$_GET["apellidos"];
			$email=$_GET["email"];
			$pais=$_GET["pais"];
			$ciudad=$_GET["ciudad"];
			$telefono=$_GET["telefono"];
			$descripcion=$_GET["descripcion"];
			$imagen=$_GET["imagen"];
			}
	?><br /><br />
    	<table width="200" border="0" align="center">
        <tr> <td rowspan="8"><img src="<?php echo $imagen; ?>" width="250" height="250" title="<?php echo $nombres." ".$apellidos; ?>" /></td></tr>
  <input type="hidden" name="pk_editar" id="pk_editar" value="<?php echo $pk; ?>" />   
  <tr>
    <td>Nombres</td>
    <td><input type="text" name="nombres_editar" id="nombres_editar" value="<?php echo $nombres; ?>" /></td>
  </tr>
  <tr>
    <td>Apellidos</td>
	<td>
    	<input type="text" name="apellidos_editar" id="apellidos_editar" value="<?php echo $apellidos; ?>" />        
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
    	<input type="text" name="email_editar" id="email_editar" onkeyup="validarEmail();" value="<?php echo $email; ?>" />
        <label id="email_valido"></label>
    </td>
  </tr>
  <tr>
    <td>Pais</td>
    <td>
    	<?php $objModelo->cargarPaisesModificar(); ?>
    </td>
  </tr>
  <tr>
    <td>Ciudad</td>
    <td>
    	<div id="resultado_2">
        </div>      
    </td>
  </tr>
  <tr>
    <td>Tel&eacute;fono</td>
    <td><input type="text" name="telefono_editar" id="telefono_editar" onKeyPress="return validarNumero(event)" maxlength="7" value="<?php echo $telefono; ?>" /></td>
  </tr>
  <tr>
    <td>Descripci&oacute;n</td>
    <td><input type="text" name="descripcion_editar" id="descripcion_editar" value="<?php echo $descripcion; ?>" /></td>
  </tr>
  <tr><td colspan="3" align="center"><input type="button" value="Modificar" onclick="modificarInformacion();" /></td></tr>
</table>
<div id="resultado" align="center"></div>
    </form>
	
    <br /><br /><br />
</body>
</html>