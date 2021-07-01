function onResponse(response){
    return response.json();
}

function CreazioneElemento(contenuto,div){
    div.setAttribute('id',contenuto.id);
    
    const span_1 = document.createElement('span');
    const span_2 = document.createElement('span');

    const new_h3 = document.createElement('h3');
    new_h3.textContent = contenuto.nome;
    const new_img = document.createElement('img');
    new_img.src = contenuto.url_immagine;
    span_1.appendChild(new_h3);
    span_1.appendChild(new_img);

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
    span_2.appendChild(new_p);
    span_2.appendChild(new_em);

    div.appendChild(span_1);
    div.appendChild(span_2);
}

function jsonProdottiVendite(json){
    const grid_venduti = document.querySelector('#venduti');

    if(json.length > 0){
        for(let i = 0; i < json.length; i++){
            let new_div = document.createElement('div');
            CreazioneElemento(json[i],new_div);
            grid_venduti.appendChild(new_div);
        }
    }else{
        const new_strong = document.createElement('strong');
        new_strong.textContent = "Nessun elemento disponibile al momento";
      
        grid_elements.appendChild(new_strong);
    }
}
fetch('novita/prodotti').then(onResponse).then(jsonProdottiVendite);


function responseSubmitForm(json){
    const grid_risultati = document.querySelector('#risultati');

    if(json.length > 0){
        for(let i = 0; i < json.length; i++){
            let new_div = document.createElement('div');
            CreazioneElemento(json[i],new_div);
            grid_risultati.appendChild(new_div);
        }
    }else{
        const new_strong = document.createElement('strong');
        new_strong.textContent = "Nessun elemento disponibile al momento";
      
        grid_risultati.appendChild(new_strong);
    }
}

function submit_form(event){
    const grid_risultati = document.querySelector('#risultati');
    grid_risultati.innerHTML = "";
    const form_data = {method:'POST', body: new FormData(search_form)};
    fetch("novita/ricerca/prodotti", form_data).then(onResponse).then(responseSubmitForm);
    event.preventDefault();
}

const search_form = document.forms['search_products'];
search_form.addEventListener('submit',submit_form);

