function calcularVuelto(){
  let fecha = document.getElementById('fecha')
  let fechaFactura = document.getElementById('fechaFactura')

           fechaFactura.value = fecha.value
           fecha.value = fecha.value
           //agreagndo valores a los im¡nputs del form
}
function agregarNombre(entrada){
  let nombre = document.getElementById('nombreDelProducto');
            nombre.value = entrada
}
var fx = document.getElementById('cambio'),
resultado = document.getElementById('vuelto');
let total = document.getElementById("total")
let cambio = document.getElementById("cambio")
let vuelto = document.getElementById('vuelto')
let totalFactura = document.getElementById("totalFactura")
let cambioFactura = document.getElementById("cambioFactura")
let vueltoFactura = document.getElementById('vueltoFactura')

cambio.addEventListener('input', function () {
    var error = true;
    try{
        //Si sólo tiene números y signos + - * / ( )
        if (cambio.value) {
            // Evaluar el resultado
            resultado.value = eval(cambio.value)-total.value;
            totalFactura.value = total.value
            cambioFactura.value = cambio.value
            vueltoFactura.value = vuelto.value
            error = false;
        }
        if (cambio.value=='') {
            // Evaluar el resultado
            resultado.value = ''
            error = false;
        }
    } catch (err) { }
    if (error) // Si no se pudo calcular
        vuelto.innerText = "Error";
});
