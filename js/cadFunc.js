const nome = document.getElementById('nome');
const email = document.getElementById('email');
const cpf = document.getElementById('cpf');
const senha = document.getElementById('senha');
const confSenha = document.getElementById('confSenha');
const submit = document.getElementById('submit');

submit.addEventListener('click', () => {

    nome.value = nome.value.trim();
    email.value = email.value.trim();
    cpf.value = cpf.value.trim();
    senha.value = senha.value.trim();
    confSenha.value = confSenha.value.trim();

    if (nome.value === '' || nome.value  === null) {
        alert('Digite seu nome');

    } else if (email.value === '' || email.value === null) {
        alert('Digite seu email');

    } else if (cpf.value === '' || cpf.value === null) {
        alert('Digite seu cpf');

    } else if (senha.value === '' || senha.value === null) {
        alert('Digite sua senha');

    } else if (confSenha.value === '' || confSenha.value === null) {
        alert('Confirme sua senha');
    
    } else if (confSenha.value !== senha.value) {
        alert('As senhas não conferem');

    } else {
        const cpfInvalido = [
            "00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"
        ];

        const regexEmail = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+.com+$/, "gm");
     

        if (cpf.value.length < 11 ) {
            alert('Cpf inválido');

        } else {

            for (let i =0; i<cpf.value.length; i++) {
                if(cpf.value[i] === '.' || cpf.value[i] === '-') {
                    cpf.value = cpf.value.replace(cpf.value[i], '');
                }
            }

           cpfInvalido.map((c) => {
                if(cpf.value === c) {
                    alert("Cpf inválido!");
                };
           });
        }

        if (!regexEmail.test(email.value)) {
            alert('Email inválido');
        };

    };
    
});