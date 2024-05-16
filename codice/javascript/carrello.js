import { creaOrdini } from "./viewArticoli.js";

document.getElementById('formPagamento').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const metodoPagamento = formData.get('metodo_pagamento');

    const paragrafo = document.getElementById("mail");
    const email = paragrafo.textContent;

    //controllo
    console.log(email);
    console.log(carrello);
    console.log(metodoPagamento);

    //formattazione carrello
    let carrelloFormattato = [];
    carrello.forEach(prodotto => {
        carrelloFormattato.push({
            "id": prodotto.prodotto,
            "numero": prodotto.quantita
        });
    });

    //variabile completa
    let ordine = {"email": email, "articoli": carrelloFormattato, "modalitaPagamento": metodoPagamento};
    console.log(ordine);

    const risposta = await creaOrdini(ordine);
    console.log(risposta);
});