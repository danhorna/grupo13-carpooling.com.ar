function validacion() {
email = document.getElementById("email").value;
if(!(/\S+@\S+\.\S+/.test(email))){
	alert('ERROR: Debe escribir un correo valido');
	return false;
}

pw = document.getElementById("pw").value;
if( pw == null || pw.length == 0 || /^\s+$/.test(pw) ) {
	alert('ERROR: El campo clave no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

}