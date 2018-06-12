function validacion() {
origen = document.getElementById("destino").value;
if( origen == null || origen.length == 0 || /^\s+$/.test(origen) ) {
	alert('ERROR: El campo origen no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}