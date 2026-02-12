document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let numero = document.getElementById("numero_control").value;
    let password = document.getElementById("password").value;

    if(numero === "" || password === ""){
        alert("Por favor completa todos los campos");
        return;
    }

    alert("Inicio de sesión simulado\nNúmero de control: " + numero);
});
