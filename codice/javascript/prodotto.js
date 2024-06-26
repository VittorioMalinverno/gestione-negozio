import {recuperaProdotti,recuperaQuantitaVenduta} from "./viewArticoli.js";
const url = new URL(window.location.href);
const idProdotto = url.searchParams.get("idProdotto");
const descrizione = document.getElementById("descrizione");
const categoria = document.getElementById("categoria");
const nomeProdotto = document.getElementById("nomeProdotto");
const prezzo = document.getElementById("prezzo");
const stockRimanente = document.getElementById("stockRimanente");

const agg_nome = document.getElementById("agg_nome");
const agg_descrizione = document.getElementById("agg_descrizione");
const agg_prezzo = document.getElementById("agg_prezzo");

window.onload = async() =>{
    const rsp = await recuperaProdotti();
    const articolo = rsp.result.find(element => element.id == idProdotto);
    console.log(articolo);
    if(articolo != null){
        agg_nome.value = articolo.nome;
        agg_descrizione.value = articolo.descrizione;
        agg_prezzo.value = articolo.prezzo;
        descrizione.innerText = articolo.descrizione;
        categoria.innerText = articolo.tipologia;
        nomeProdotto.innerText = articolo.nome;
        prezzo.innerText = articolo.prezzo;
        const rsp2 = await recuperaQuantitaVenduta();
        stockRimanente.innerText = (rsp2.result.length > 0 && rsp2.result.find(element => element.id == articolo.id)) ? (articolo.stock - 
            (rsp2.result.find(element => element.id == articolo.id)).venduto
        ): articolo.stock;
    }else{
        console.error("Attenzione l'id passato come parametro all'url non è corretto");
    }

}   