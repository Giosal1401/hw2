//Auntenticazione Utente
let auth = null;
fetch("account/auth").then(onResponse).then(checkAuth);

function checkAuth(json){
    auth = json.Auth;
}

function onResponse(response){
    return response.json();
}

//Creazione sezioni della pagina dinamicamente 
function CreazioneElemento(contenuto,div){
    div.setAttribute('id',contenuto.id);
    
    const new_h3 = document.createElement('h3');
    new_h3.textContent = contenuto.nome;
    const img_prefer = document.createElement('img');
    img_prefer.src = "images/preferiti-vuota.png";
    img_prefer.addEventListener('click',aggiungiPreferiti);
    new_h3.appendChild(img_prefer); 
    const new_img = document.createElement('img');
    new_img.src = contenuto.url_immagine;

    const new_span = document.createElement('span');
    new_span.classList.add('hidden');
    const new_p = document.createElement('p');
    if(contenuto.descrizione === null){
        new_p.textContent = "Al momento non abbiamo nessun informazione";
    }else{
        new_p.textContent = contenuto.descrizione;
    }
    
    const new_em = document.createElement('em');
    if(contenuto.tipo === 'nutrizione'){
        new_em.textContent = "Prezzo: " + contenuto.prezzo + "€/kg";
    }else{
        new_em.textContent = "Prezzo: " + contenuto.prezzo + "Euro";
    }
    new_span.appendChild(new_p);
    new_span.appendChild(new_em);
    
    
    const span_buttons = document.createElement('span');
    span_buttons.classList.add('element_buttons');

    const carrello_png = document.createElement('img');
    carrello_png.src= "images/carrello-vuoto.png"; 
    carrello_png.addEventListener('click',mostraModale);
    
    const new_button = document.createElement('button');
    new_button.textContent = 'Maggiori Informazioni';
    new_button.addEventListener('click',mostraDettagli);

    span_buttons.appendChild(new_button);
    span_buttons.appendChild(carrello_png);

    div.appendChild(new_h3);
    div.appendChild(new_img);
    div.appendChild(new_span);
    div.appendChild(span_buttons);
}

//Cariamento elementi(prodotti) dinamicamente
function jsonProdotti(json){
    const grid_elements = document.querySelector('.elementi').parentNode.children[1];

    if(json.length > 0){
        for(let i = 0; i<json.length; i++){
            let new_div = document.createElement('div');
            CreazioneElemento(json[i],new_div);
            grid_elements.appendChild(new_div);
        }
        fetch("account/prodotti/preferiti").then(onResponse).then(jsonPreferiti);
    }else{
        const new_strong = document.createElement('strong');
        new_strong.textContent = "Nessun elemento disponibile al momento";
      
        grid_elements.appendChild(new_strong);
    }
}
fetch("home/prodotti").then(onResponse).then(jsonProdotti);

//Caricamento prodotti preferiti
function jsonPreferiti(json){
    const grid_favorites = document.querySelector('#risultatiPreferiti');
    grid_favorites.innerHTML = "";

    if(json.length > 0){
        for(let i = 0; i < json.length; i++){
            const new_div = document.createElement('div');
            
            const new_h3 = document.createElement('h3');
            new_h3.textContent = json[i].nome;

            const new_img = document.createElement('img');
            new_img.src = json[i].url_immagine;

            new_div.appendChild(new_h3);
            new_div.appendChild(new_img);
            grid_favorites.appendChild(new_div);

            const div_prodotto = document.getElementById(json[i].id);

            const img_preferiti = div_prodotto.querySelector('h3 img');
            img_preferiti.src = "images/preferiti-piena.png";
            img_preferiti.removeEventListener('click', aggiungiPreferiti);
            img_preferiti.addEventListener('click', togliPreferiti);
        }
    }else{
        const new_strong = document.createElement('strong');
        new_strong.textContent = "Non hai selezionato nessun elemento";
      
        grid_favorites.appendChild(new_strong);
    }
}

//Mostra/togli dettagli dei prodotti
function mostraDettagli(event){
    const button = event.currentTarget;
    const span_hidden = button.parentNode.parentNode.querySelector('.hidden');

    button.textContent = "Meno Informazioni";
    span_hidden.classList.remove('hidden');
 
    button.removeEventListener('click', mostraDettagli);
    button.addEventListener('click',togliDettagli);
}

function togliDettagli(event){
    const button = event.currentTarget;
    const span_hidden = button.parentNode.parentNode.childNodes[2];

    button.textContent = "Maggiori Informazioni";
    span_hidden.classList.add('hidden');
 
    button.removeEventListener('click', togliDettagli);
    button.addEventListener('click', mostraDettagli);
}

//Aggiungi/rimuovi prodotto dai preferiti
function aggiornaPreferiti(){
    fetch("account/prodotti/preferiti").then(onResponse).then(jsonPreferiti);
}

function aggiungiPreferiti(event){
    const modal_view = document.querySelector('#modal-view');
    modal_view.firstElementChild.classList.remove('outSession');

    if(auth){
        event.currentTarget.removeEventListener('click',aggiornaPreferiti);
        event.currentTarget.addEventListener('click',togliPreferiti);
        const id_prodotto = event.currentTarget.parentNode.parentNode.getAttribute('id');
        const url = 'account/preferiti/add/' + encodeURIComponent(id_prodotto);
        fetch(url).then(aggiornaPreferiti);
    }else{    
        const button = document.querySelector('#modal-view div button');
        button.addEventListener('click',togliModale);

        const new_p = document.createElement('p');
        new_p.textContent = "Devi prima essere loggato al tuo account!";
       
        modal_view.firstElementChild.classList.add('outSession');
        modal_view.firstElementChild.insertBefore(new_p,modal_view.firstElementChild.firstElementChild);
        modal_view.style.top = window.pageYOffset + 'px';
        document.body.classList.add('no-scroll');
        modal_view.classList.remove('hidden');
    }
}

function togliPreferiti(event){
    if(auth){
        event.currentTarget.src = "images/preferiti-vuota.png";

        event.currentTarget.removeEventListener('click',togliPreferiti);
        event.currentTarget.addEventListener('click',aggiungiPreferiti);
        const id_prodotto = event.currentTarget.parentNode.parentNode.getAttribute('id');
        const url = 'account/preferiti/remove/' + encodeURIComponent(id_prodotto);
        fetch(url).then(aggiornaPreferiti);
    }else{ 
        const modal_view = document.querySelector('#modal-view');
        const button = document.querySelector('#modal-view div button');
        button.addEventListener('click',togliModale);

        const new_p = document.createElement('p');
        new_p.textContent = "Devi prima essere loggato al tuo account!";
       
        modal_view.firstElementChild.insertBefore(new_p,modal_view.firstElementChild.firstElementChild);
        modal_view.style.top = window.pageYOffset + 'px';
        document.body.classList.add('no-scroll');
        modal_view.classList.remove('hidden');
    }
}

//Ricerca prodotto tramite barra di ricerca
function ricerca(event){
    const barra = event.currentTarget;
    const testo = barra.value;
    const grid_elements = document.querySelector('#grid_elements');
    
    for(let i = 0; i<grid_elements.childNodes.length; i++){
        grid_elements.childNodes[i].classList.remove('hidden');
    }    

    if(testo!==''){ 
        for(let i = 0; i<grid_elements.childNodes.length; i++){
            if(grid_elements.childNodes[i].childNodes[0].textContent.toLowerCase().indexOf(testo.toLowerCase()) === -1){
                grid_elements.childNodes[i].classList.add('hidden');
            }
        }
    } 
}
document.querySelector('.elementi input').addEventListener('keyup', ricerca);

//Script compra prodotto
function togliModale(event){
    //window.location.reload();  //per aggiornare i numeri di elementi presenti nel carrello

    const modal_view = document.querySelector('#modal-view');
    document.body.classList.remove('no-scroll');
    modal_view.classList.add('hidden');

    modal_view.firstElementChild.firstElementChild.remove();
    modal_view.querySelector('form').classList.add('hidden');

    const form = document.forms['acquisto'];
    form.quantità.value = 1;
}

function mostraModale(event){
    const modal_view = document.querySelector('#modal-view');
    modal_view.firstElementChild.classList.remove('outSession');

    const button = document.querySelector('#modal-view div button');
    button.addEventListener('click',togliModale);
    
    if(auth){
        const new_div = document.createElement('div');
        const div_prodotto = event.currentTarget.parentNode.parentNode;
    
        const h3 = document.createElement('h3');
        h3.textContent = div_prodotto.firstChild.textContent;
        const img = document.createElement('img');
        img.src = div_prodotto.childNodes[1].src;
        const p = document.createElement('p');
        p.textContent = div_prodotto.childNodes[2].firstChild.textContent;
        const em = document.createElement('em');
        em.textContent = div_prodotto.childNodes[2].lastChild.textContent;

        new_div.appendChild(h3);
        new_div.appendChild(img);
        new_div.appendChild(p);
        new_div.appendChild(em);
    
        modal_view.style.top = window.pageYOffset + 'px';
        document.body.classList.add('no-scroll');
        modal_view.classList.add('grid');
        modal_view.classList.remove('hidden'); 

        const form = document.forms['acquisto'];
        form.id_prodotto.setAttribute('value',div_prodotto.getAttribute('id'));
        form.addEventListener('submit',aggiungiAlCarrello);
        form.classList.remove('hidden');

        modal_view.firstElementChild.insertBefore(new_div,modal_view.firstElementChild.firstElementChild);
    }else{
        const new_p = document.createElement('p');
        new_p.textContent = "Devi prima essere loggato al tuo account!";
        
        modal_view.firstElementChild.classList.add('outSession');
        modal_view.firstElementChild.insertBefore(new_p,modal_view.firstElementChild.firstElementChild);
        modal_view.style.top = window.pageYOffset + 'px';
        document.body.classList.add('no-scroll');
        modal_view.classList.remove('hidden');
    }    
}

//per aggiornare i numeri di prodotti nel carrello senza utillizare reload()
function aggiorna(json){
    const div_cart_details = document.querySelector('#cartDetails');
    const p_cart_details = div_cart_details.firstElementChild.firstElementChild;
    p_cart_details.textContent = "Totale prodotti: " + json.numero_prodotti;
}

function aggionaProdottiCarrello(){
    fetch("carrello/prodotti").then(onResponse).then(aggiorna);
}

function removeResponseAddCart(event){
    const span = document.querySelector('#modal-view span');
    span.remove();
    aggionaProdottiCarrello();
}

function responseAddCart(json){
    const modal_view = document.querySelector('#modal-view');
    
    const new_p = document.createElement('p');
    new_p.textContent = json.message_user;
    const new_button = document.createElement('button');
    new_button.textContent = "Avanti";
    new_button.addEventListener('click',removeResponseAddCart);
    
    const span = document.createElement('span');
    span.appendChild(new_p);
    span.appendChild(new_button);

    modal_view.appendChild(span);
}

function aggiungiAlCarrello(event){
    const form = document.forms['acquisto'];
    const form_data = {method:'POST', body: new FormData(form)};
    fetch("carrello/buy", form_data).then(onResponse).then(responseAddCart);
    event.preventDefault();    
}

//Script 'Pulsante' MENU
function scopriMenu(event){
    const link = document.querySelector('#menuAperto');

    event.currentTarget.removeEventListener('click',scopriMenu);
    event.currentTarget.addEventListener('click',nascondiMenu);
    link.classList.remove('hidden');
}

function nascondiMenu(event){
    const link = document.querySelector('#menuAperto');

    event.currentTarget.removeEventListener('click',nascondiMenu);
    event.currentTarget.addEventListener('click',scopriMenu);
    link.classList.add('hidden');
}
const menu = document.querySelector('#menu');
menu.addEventListener('click',scopriMenu);

const menu_tendina = document.querySelector('.menu_tendina');
menu_tendina.addEventListener('click',scopriMenu);

//Script ShowDetails
function removeDetails(event){
    event.currentTarget.classList.remove('noBorderRadius');
    if(event.currentTarget.textContent.toLowerCase() === "account"){
        document.querySelector('#accountDetails').classList.add('hidden');
    }else{
        document.querySelector('#cartDetails').classList.add('hidden');
    }
    event.currentTarget.addEventListener('mouseover',showDetails);
    event.currentTarget.removeEventListener('mouseout', removeDetails);

}

function showDetails(event){
    event.currentTarget.classList.add('noBorderRadius');

    if(event.currentTarget.textContent.toLowerCase() === "account"){
        document.querySelector('#accountDetails').classList.remove('hidden');
        
    }else{
        document.querySelector('#cartDetails').classList.remove('hidden');
    }
    event.currentTarget.removeEventListener('mouseover',showDetails);
    event.currentTarget.addEventListener('mouseout', removeDetails);
    
}

const links = document.querySelectorAll('.link a');
for(link of links){
    link.addEventListener('mouseover',showDetails);
}