
const livro = document.getElementById("livro");
const grr = document.getElementById("grr");
const dataDev = document.getElementById("dataDev");
const submit = document.getElementById("submit");
const msg = document.getElementById("error");

submit.addEventListener("click", (event) => {
    
    livro.value = livro.value.trim();
    grr.value = grr.value.trim();

    try {

        if (livro.value === '' || livro.value === null ) {
            throw new Error("Digite o nome do livro");

        } else if (grr.value === '' || grr.value === null) {
            throw new Error("Digite o GRR");

        } else if (dataDev.value === '' || dataDev.value === null){
            throw new Error ("Digite a data de devolução!");

        } else {

            const dataDevolucao = new Date(dataDev.value);
            const today = new Date();
            const regexGrr = new RegExp(/^[{8}[0-9]+$/);

            if (dataDevolucao.getTime() <= today.getTime()) {
                throw new Error("A data de devolução deve ser futura!");
            } 
 
            if (!regexGrr.test(grr.value)) {
                throw new Error("GRR inválido!");
            }
        }

    } catch (err) {
        event.preventDefault();
        msg.innerText = err.message;
    };
});