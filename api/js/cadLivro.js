const titulo  = document.getElementById('titulo');
const autor   = document.getElementById('autor');
const editora = document.getElementById('editora');
const imagem  = document.getElementById('imagem');
const submit  = document.getElementById('submit');
const msg = document.getElementById('error');

submit.addEventListener('click', (event) => {
    titulo.value = titulo.value.trim();
    autor.value = autor.value.trim();
    editora.value = editora.value.trim();

    try {
        if (titulo.value === '' || titulo.value === null) {
            throw new Error("Digite o titulo!");
    
        } else if (autor.value === '' || autor.value === null) {
            throw new Error("Digite o autor!");
    
        } else if (editora.value === '' || editora.value === null) {
            throw new Error("Digite a editora!");
    
        } else if(imagem.value === '' || imagem.value === null) {
            throw new Error("Escolha uma imagem!");
    
        };

    } catch(err) {
        event.preventDefault();
        msg.innerText = err.message;
        
    } 
   
});