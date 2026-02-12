/*document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let numero = document.getElementById("numero_control").value;
    let password = document.getElementById("password").value;

    if(numero === "" || password === ""){
        alert("Por favor completa todos los campos");
        return;
    }

    alert("Inicio de sesión simulado\nNúmero de control: " + numero);
});*/

//Funcion de prueba
let numeroPrueba = "24212251";
let contraPrueba = "OIML010702HCHNRSA3";
let numero = document.querySelector(".numero_control");
let password = document.querySelector(".password");

function InicioSesion (){
    //Checa si el numero de control y la CURP esten correctos y cambia de pagina.
    if ((numero.value === numeroPrueba) && (password.value === contraPrueba)) {
        console.log("Inicio de sesion.");
        //TODO: Hay que cambiar esto a que te mande a una pagina con el tipo de usuario correcto..
        window.location.assign("Registro_Alumno.html");
    }
    //Por si los datos estan mal
    else if((numero.value !== contraPrueba) && (password.value !== contraPrueba)){
        alert("Datos Erroneos.")
        console.log("Datos erroneos");
    }
    //DEBUG
    else {
        console.log("error no previsto");
        console.log(numero.value);
        console.log(password.value);
    }
}

//Para el boton.
document.getElementById("botonIniciarSesion").addEventListener("click",InicioSesion);
