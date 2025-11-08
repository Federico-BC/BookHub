document.addEventListener("DOMContentLoaded", ()=> {
    
    let formulario = document.getElementById("signupForm");
    
    formulario.addEventListener("submit", (form)=> {
        form.preventDefault();

        let pass1 = document.getElementById("password");
        let pass2 = document.getElementById("password2");

        if (pass1.value == pass2.value) {
            if (document.getElementById("password2Error")) {
                document.getElementById("password2Error").remove();
            }
            formulario.submit();
        }else if(!document.getElementById("password2Error")) {
            let etiqueta = document.createElement("p");
            etiqueta.id = "password2Error";
            etiqueta.className = "text-danger";
            etiqueta.textContent = "Las contraseñas no coinciden";
            document.getElementById("passDiv").insertAdjacentElement("afterend", etiqueta);
        }
    });
});