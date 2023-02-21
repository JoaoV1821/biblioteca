const nome   = document.getElementById('nome');
const email  = document.getElementById('email');
const grr    = document.getElementById('grr');
const submit = document.getElementById('submit');
const msg = document.getElementById('error');

submit.addEventListener('click', (event) => {
    nome.value = nome.value.trim();
    email.value = email.value.trim();
    grr.value = grr.value.trim();

    try {
        if (nome.value === '' || nome.value === null) {
            throw new Error("Digite seu nome!");
    
        } else if (email.value === '' || email === null) {
            throw new Error("Digite seu email!");
    
        } else if (grr.value === '' || grr.value === null) {
            throw new Error("GRR inválido!");
            
        } else {
    
            const regexEmail = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@ufpr+.br+$/, "gm");
            const regexGrr = new RegExp(/^[{8}[0-9]+$/);
    
            if (!regexEmail.test(email.value)) {
                throw new Error("Email inválido!");
            } 
            
            if (grr.length > 8 || grr.value.length < 8) {
                throw new Error("GRR inválido")
            } 
    
            if (!regexGrr.test(grr.value)) {
                throw new Error("GRR inválido!");
            }
        }
    } catch(err) {
        event.preventDefault();
        msg.innerText = err.message;
    }

   
})