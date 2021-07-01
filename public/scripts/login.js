function validazione(event){
    const div_errori = document.querySelector('.errore');
    
    for(let i = 0; i < div_errori.children.length; i++){
        div_errori.children[i].classList.add('hidden');
    }  
    
    if(form.username.value.lenght === 0 || form.password.value.length === 0)
    {
        const div_errori = document.querySelector('.errore');
        div_errori.firstElementChild.classList.remove('hidden');
        event.preventDefault();
    }
}
const form = document.forms['autenticazione'];
form.addEventListener('submit', validazione);