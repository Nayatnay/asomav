
/* Alterna entre agregar y quitar la clase "responsive" a la barra de iconos cuando el usuario haga clic en el icono */

function myFunction() {
  var x = document.getElementById("myIconbar");
  if (x.className === "nav-menu") {
    x.className += " responsive";
  } else {
    x.className = "nav-menu";
  }
}

// LIMPIAR  INPUT AL HACER CLIC SOBRE ÉL  

document.getElementById("monto").addEventListener('click', limpiar);

function limpiar(e) {
  if ($(this).val() < 1) {
    $('#monto').val('');
  }
};

document.getElementById("montonc").addEventListener('click', limpiarnc);

function limpiarnc(e) {
  if ($(this).val() < 1) {
    $('#montonc').val('');
  }
};

// Activar/Desactivar Formularios Gastos comunes y no comunes

function fnccomun() {
  document.getElementById("formnocomun").style.display = "none";
  document.getElementById("formcomun").style.display = "block";
};

function fncnocomun() {
  document.getElementById("formcomun").style.display = "none";
  document.getElementById("formnocomun").style.display = "block";
};

// Sumar y restar valores de los checkbox

function sumar(dato) {
  /*
  $('#tabladeuda').on('click', 'tr', function () {
    var dato = $(this).find('td').eq(3).text(); //obtener el dato de la tercera columna de la tabla
  */
  var pagado = $("#monto").val();
  pagado = Number(pagado)
  pagado += dato;
  $('#monto').val(pagado.toFixed(2));
}

function restar(dato) {
  /*
   $('#tabladeuda').on('click', 'tr', function () {
     var dato = $(this).find('td').eq(3).text(); //obtener el dato de la tercera columna de la tabla
 */
  var pagado = $("#monto").val();
  pagado = Number(pagado)
  pagado -= dato;
  $('#monto').val(pagado.toFixed(2));
}

function idfact(id) {

  var idfac = $("#idfac").val();
  if (idfac == "") {
    idnuevo = id + ",";
  }else{
    idnuevo = idfac + id + ",";
  }
  
  $('#idfac').val(idnuevo);

}

function idnofact(id) {

  var expresion = id + ",";  //expresion a buscar 
  var idfac = $("#idfac").val();  //informacion que viene del imput contenedor de los id de facturas que se han seleccionado con los checkbox
  /*var longexp = expresion.length;  //longitud de la expresion buscada
  var index = idfac.indexOf(expresion);  //posicion en la que se encuentra la expresion buscada */ 
  var newStr = idfac.replace(expresion,'');
  $('#idfac').val(newStr);

}

function fncingreso() {
  document.getElementById("formegreso").style.display = "none";
  document.getElementById("formingreso").style.display = "block";
};

function fncegreso() {
  document.getElementById("formingreso").style.display = "none";
  document.getElementById("formegreso").style.display = "block";
};

function ocultar() {
  document.getElementById("gastoid").style.display = "none";
  document.getElementById("descripcion").value = "";
  document.getElementById("descripcion").style.display = "block";
};

function mostrar() {
  document.getElementById("descripcion").style.display = "none";
  document.getElementById("gastoid").style.display = "block";
};

function llenar() {
/*var x = document.getElementById('gastoid');
  document.getElementById('gast').value=x;*/
  var combo = document.getElementById("gastoid");
var selected = combo.options[combo.selectedIndex].text;
if (selected == "Seleccione Servicio o Proveedor") {
  selected = "";
}
document.getElementById('descripcion').value = selected;
 
}

function ani(){
  document.getElementById("envios").style.display = "block";
  document.getElementById('envios').className ='envios';
}


        //textarea auto resize de acuerdo al texto introducido

        const cuerpo = document.querySelector("textarea")
        cuerpo.addEventListener("keyup", e => {
            cuerpo.style.height = '65px';
            let scHeight = cuerpo.scrollHeight;            
            cuerpo.style.height = scHeight+'px';
        });
  




/*********************************************************************************** 
  //variables globales para definir el separador de millares y decimales
//Para coma millares y punto en decimales (USA)
const DECIMALES=".";
// cambiar por "," para coma decimal y punto en millares (ESPAÑA)
const INFLOCAL = DECIMALES==="."?new Intl.NumberFormat('en-US'):new Intl.NumberFormat('es-ES');
//============================================================================
let regexpInteger = new RegExp('[^0-9]', 'g');
let regexpNumber = new RegExp('[^0-9' + '\\' + DECIMALES + ']', 'g');
//============================================================================

// Formatear solamente numeros decimales positivos con solo 2 decimales
function numberFormatPositivoFixed(e) {
    if (this.value !== "") {
        //se filtra el contenido de caracteres no admisibles
        //se divide el numero entre la parte entera y la parte decimal
        let contenido = this.value.replace(regexpNumber, "").split(DECIMALES);
        //ver si hay ya 2 decimales introducidos
        if (contenido.length > 1) {
            if (contenido[1].length > 2) {
                contenido[1] = contenido[1].substring(0, contenido[1].length - 1);
            }
        }
        // añadimos los separadores de miles a la parte entera del numero
        contenido[0] = contenido[0].length ? INFLOCAL.format(parseInt(contenido[0])) : "0";
        // Juntamos el numero con los decimales si hay decimales
        this.value = contenido.length > 1 ? contenido.slice(0, 2).join(DECIMALES) : contenido[0];
    }
}
window.onload = function() {
    //SE EJECUTA DESPUES CARGAR EL CODIGO CSS y HTML
    // Creamos el evento keyup para cada clase definida
    document.querySelectorAll(".numberM").forEach(el => el.addEventListener("keyup", numberFormatPositivoFixed));
};
*/

