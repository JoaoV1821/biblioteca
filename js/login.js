const email = document.getElementById("email");
const senha = document.getElementById("senha");
const submit = document.getElementById("submit");

submit.addEventListener("click", (event) => {
    event.preventDefault();

    email.value = email.value.trim();
    senha.value = senha.value.trim();

    if (email.value === "" || email.value === null) {
        alert("Digite seu email!");

    } else if (senha.value === "" || senha.value === null) {
        alert("Digite sua senha!");

    } else {
        const regex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+.com+$/, "gm");

        if(!regex.test(email.value)) {
            alert("Email inválido");

        } else {
            console.log(email.value);
            console.log(senha.value);
        }
    }

});