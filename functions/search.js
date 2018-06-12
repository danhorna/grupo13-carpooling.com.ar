function validacion() {
destino = document.getElementById("destino").value;
if( destino == null || destino.length == 0 || /^\s+$/.test(destino) ) {
	alert('ERROR: El campo destino no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

