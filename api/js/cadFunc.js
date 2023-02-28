const nome = document.getElementById('nome');
const email = document.getElementById('email');
const cpf = document.getElementById('cpf');
const senha = document.getElementById('senha');
const confSenha = document.getElementById('confSenha');
const submit = document.getElementById('submit');
const msg = document.getElementById('error');

const validaCpf = (cpf) => {
    let soma = 0;
    let resto;

    for (i=1; i<=9; i++) {
        soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
    };

    resto = (soma * 10) % 11;

    if ((resto == 10) || (resto == 11))  {
        resto = 0
    };

    if (resto != parseInt(cpf.substring(9, 10)) ) {
        return false
    };

    soma = 0;

    for (i = 1; i <= 10; i++) {
        soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
    };

    resto = (soma * 10) % 11;

    if ((resto == 10) || (resto == 11))  {
        resto = 0;
    };

    if (resto != parseInt(cpf.substring(10, 11) ) ) {
        return false;

    } else {
        return true;
    }
    
}

submit.addEventListener('click', (event) => {

    nome.value = nome.value.trim();
    email.value = email.value.trim();
    cpf.value = cpf.value.trim();
    senha.value = senha.value.trim();
    confSenha.value = confSenha.value.trim();


    try {
        const cpfInvalido = [
            "00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"
        ];

        const regexEmail = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@ufpr+.br+$/, "gm");

        if (nome.value === '' || nome.value  === null) {
            throw new Error("Digite seu nome!");
    
        } else if (email.value === '' || email.value === null) {
            throw new Error("Digite seu email!");
    
        } else if (cpf.value === '' || cpf.value === null) {
            throw new Error("Digite seu Cpf!");
    
        } else if (senha.value === '' || senha.value === null) {
            throw new Error("Digite sua senha!");
    
        } else if (confSenha.value === '' || confSenha.value === null) {
            throw new Error("Confirme sua senha !");
        
        } else if (confSenha.value !== senha.value) {
            throw new Error("As senhas não conferem!");

        } else {

            for (let i =0; i<cpf.value.length; i++) {
                if(cpf.value[i] === '.' || cpf.value[i] === '-') {
                    cpf.value = cpf.value.replace(cpf.value[i], '');
                }
            }

            if (cpf.value.length < 11 ) {
                throw new Error("Cpf inválido!");
    
            } else if (!validaCpf(cpf.value)) {
                throw new Error("Cpf inválido!");

            } else {

               cpfInvalido.map((c) => {
                    if(cpf.value === c) {
                       throw new Error("Cpf inválido!");
                    };
               });

                if (!regexEmail.test(email.value)) {
                    throw new Error("Email inválido!");
                };
            };

        };
        
    } catch(err) {
        event.preventDefault();
        msg.innerHTML = err.message;
    }; 
});