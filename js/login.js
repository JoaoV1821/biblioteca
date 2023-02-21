const email  = document.getElementById("email");
const senha  = document.getElementById("senha");
const submit = document.getElementById("submit");
const msg = document.getElementById("error");

submit.addEventListener("click", (event) => {

    email.value = email.value.trim();
    senha.value = senha.value.trim();

    try {

        if (email.value === "" || email.value === null) {
           throw new Error("Digite seu email!");
    
        } else if (senha.value === "" || senha.value === null) {
            throw new Error("Digite sua senha!");
    
        } else {
            const regex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@ufpr+.br+$/, "gm");
    
            if (!regex.test(email.value)) {
                throw new Error("Email inválido!");
            };
        };

    } catch(err) {
        event.preventDefault();
        msg.innerText = err.message;
    }
   
});