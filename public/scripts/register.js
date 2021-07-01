/*function onResponse(response){
    return response.json();
}

function checkUsername(json){
    console.log(json);
    return json.exist;
}

function checkEmail(json){
    console.log(json);
}*/

function validazioneEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function validazionePassword(password) {
    return /[0-9]/.test(password);
}

function validazione(event){  
    event.preventDefault();
    
    for(let i = 0; i < div_errori.children.length; i++){
        div_errori.children[i].classList.add('hidden');
    }

    if(form.username.value.lenght === 0 || form.password.value.length === 0 || form.email.value.length === 0)
    {
        div_errori.children[0].classList.remove('hidden');
    }else{
        let errore = false;
        if(form.username.value.length < 5){
            div_errori.children[1].classList.remove('hidden');
            errore = true;
        }/*else{
            afetch('register/username/' + encodeURIComponent(form.username.value)).then(onResponse).then(checkUsername);
        }*/
    
        if(validazioneEmail(form.email.value) === false){
            div_errori.children[2].classList.remove('hidden');
            errore = true;
        }/*else{
            fetch('register/email/' + encodeURIComponent(form.email.value)).then(onResponse).then(checkEmail);
        }*/
    
        if(validazionePassword(form.password.value) === false || form.password.value.length < 6 || form.password.value.toString() === form.password.value.toString().toLowerCase()){
            div_errori.children[3].classList.remove('hidden');
            errore = true;
        }

        if(errore === false){
            const form = event.currentTarget;
            form.submit();
        }
    }
}
const div_errori = document.querySelector('.errore');
const form = document.forms['registrazione'];
form.addEventListener('submit', validazione);