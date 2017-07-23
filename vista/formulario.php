<?php 
	require("../modelo/modelo.php");
	$objModelo = new Formulario();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario</title>
<script type="text/javascript" src="../ajax/ajax.js"></script>
<!-- ----------------------------------------FANCYBOX-------------------------------------------------------------------- -->
<!-- Add jQuery library -->
	<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/lib/jquery-1.7.2.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/source/jquery.fancybox.js?v=2.0.6"></script> 
	<link rel="stylesheet" type="text/css" href="../jquery/fancyapps-fancyBox-3a66a9b/source/jquery.fancybox.css?v=2.0.6" media="screen" />
    
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay opening speed and opacity
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedIn : 500,
						opacity : 0.95
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background-color' : '#eee'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
<script type="text/javascript">
	var nombre = "", apellido="", ciudad="", telefono="", descripcion="", imagen="", pais="", otraCiudad="", email="", ciudad_nueva="";
	var	confrimar_email = "";
	//________________________________________________________________________________________________________________________
	function validarEmail() {		
		email = document.getElementById("email_").value; 
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)){
			//alert("La dirección de email " + email + " es correcta.");
			document.getElementById('email_valido').innerHTML = 'Email Valido';  
		} else {
			//alert("La dirección de email es incorrecta." +email);
			document.getElementById('email_valido').innerHTML = 'Email Invalido';  
		}
	}
	//________________________________________________________________________________________________________________________	
	function validarConfirmarEmail() {
		email = document.getElementById("email_").value; 
		confrimar_email = document.getElementById("confirmar_email").value; 
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(confrimar_email) && confrimar_email==email){
			document.getElementById('confirmar_email_valido').innerHTML = 'Email Valido';  
		}else if(confrimar_email!=email){
			document.getElementById('confirmar_email_valido').innerHTML = 'Email Diferentes';	
		}
		else {
			document.getElementById('confirmar_email_valido').innerHTML = 'Email Invalido';  
		}
	}
	//________________________________________________________________________________________________________________________		
	function ciudadesSegunPais(){
		document.getElementById("resultado").innerHTML="";
		document.getElementById("resultado_2").innerHTML="";
		pais=document.getElementById("paises").value;
		ajax_("../control/controlador.php?paisSeleccionado="+pais);		
	}
	//________________________________________________________________________________________________________________________	
	function campoCiudad(){
		otraCiudad=document.getElementById("ciudades").value;
		ajax_2("../control/controlador.php?otraCiudadSeleccionada="+otraCiudad);
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
	function agregarPais(){
		var pais="";	
		pais= document.getElementById("pais_nuevo").value;
		if(pais!=""){
			ajax_4("../control/controlador.php?pais_nuevo="+pais);	
		}else{
			alert("Ingrese un pais");	
		}						
		//parent.jQuery.fancybox.close();
	}
	//________________________________________________________________________________________________________________________
	function ingreseCiudad(){
		ciudad_nueva = 	document.getElementById("ciudad_nueva").value;
		if(ciudad_nueva==""){			
			alert("Ingrese una ciudad.");
			document.getElementById('ciudad_nueva').focus();
		}
		document.getElementById('ciudad_nueva').focus();
	}
</script>
<style>
	input:text
	{
		border-radius:5px;		
	}
</style>
</head>

<body background="../img/GE-fondo1.jpg">
	<form action="../control/controlador.php" method="post" enctype="multipart/form-data">    
    	<div style="border-radius:10px; background-color:#9C9; text-align:center; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; color:#FFF;">
        	<h2>Ingresar Usuario</h2>
            <label>Nombre</label><br />
            <input type="text" name="nombre" id="nombre" value="" required="required" /><br />
            <label>Apellido</label><br />
            <input type="text" name="apellido" id="apellido" value="" required="required" /><br />
            <label>Email</label><br />
            <input type="text" value="" name="email_" id="email_" onkeyup="validarEmail();" oncopy="alert('No puedes Copiar'); return false;" required="required" autocomplete="off" /><br />
            <label id="email_valido"></label><br />
            <label>Confirmar Email</label><br />
            <input type="text" name="confirmar_email" id="confirmar_email" value="" oncopy="alert('No puedes Copiar'); return false;" onpaste="alert('No puedes Pegar'); return false;" onkeyup="validarConfirmarEmail();" required="required" autocomplete="off" /><br />
            <label id="confirmar_email_valido"></label><br />
            <label>Paises</label><br />
            <?php 
            	$objModelo->cargarPaises();
            ?>
            <a class="fancybox" href="#inline1" ><img src="../img/signo_mas.jpg" width="15" height="15" title="Agregar Pais" /></a><br />
            <div id="resultado"></div>
            <div id="resultado_2"></div>
            <label>Tel&eacute;fono</label><br />
            <input type="text" name="telefono" id="telefono" required="required" onKeyPress="return validarNumero(event)" maxlength="7" /><br />
            <label>Descripci&oacute;n</label><br />
            <input type="text" name="descripcion" id="descripcion" value="" required="required" /><br />
            <label>Imagen</label><br />
            <input type="file" name="imagen" /><br />
            <input type="submit" value="Registrar" />
            <a href='../admin/index.php' target="_blank">Consultar Usuarios</a>
            <?php 
            if(isset($_GET["mensaje"])){
            	echo "<center>".$_GET["mensaje"]."</center>";
            }
            ?>
            <div id="inline1" style="width:400px;display: none;">
                <label>Pais</label>
                <input type="text" name="pais_nuevo" id="pais_nuevo" />
                <input type="button" value="Agregar" onclick="agregarPais();" />
            	<div id="resultado_4" align="center"></div>
            </div>
            <br /><br />
    </div>
    </form>
</body>
</html>