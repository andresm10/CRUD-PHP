$(document).ready(function () {
	var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

	$(".email").keyup(function(){	
		if( $(".email").val() == "" || !emailreg.test($(".email").val()) ){
				$(".email").focus().after("<span class='error'>Ingrese un email correcto</span>");
				alert("sss");
				return false;
		}
	});
	/*$(".email").keyup(function(){
		if( $(this).val() != "" && emailreg.test($(this).val())){
			$(".error").fadeOut();			
			return false;
		}		
	});*/
	
	/*----------------------------------------------------------------------------------------------------------------------------------*/

	
	
	/*$(".nombre, .asunto, .mensaje, .documento_identidad, .apellido, .telefono, .direccion, .nombre_usuario, .contrasena, .capchat, .codigo_grupo, .nombre_grupo, .informacion_requerida, .codigo_asignatura, .nombre_asignatura").keyup(function(){
		if( $(this).val() != "" ){
			$(".error").fadeOut();			
			return false;
		}		
	});
	
	
	$(".email").keyup(function(){
		if( $(this).val() != "" && emailreg.test($(this).val())){
			$(".error").fadeOut();			
			return false;
		}		
	});*/
});