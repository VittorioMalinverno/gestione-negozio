import { recuperaOrdini } from "./viewArticoli.js";


const paragrafo = document.getElementById("mail");
const email = paragrafo.textContent;
console.log(email);

if (email) {
    const risposta = await recuperaOrdini(email);
    console.log(risposta);
    //const articolo = risposta.result.find(element => element.id == idProdotto);
} else {
    console.error("Email not found in the session.");
}