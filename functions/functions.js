function validacion() {
nombre = document.getElementById("nombre").value;
if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
	alert('ERROR: El campo nombre no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

apellido = document.getElementById("apellido").value;
if( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
	alert('ERROR: El campo apellido no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

email = document.getElementById("email").value;
if(!(/\S+@\S+\.\S+/.test(email))){
	alert('ERROR: Debe escribir un correo valido');
	return false;
}

edad = document.getElementById("edad").value;
if(!isNaN(edad)){
	alert('ERROR: Debe elegir una fecha');
	return false;
}

pw = document.getElementById("pw").value;
if( pw == null || pw.length == 0 || /^\s+$/.test(pw) ) {
	alert('ERROR: El campo clave no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}



}