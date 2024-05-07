import { creaOrdini } from "./viewArticoli.js";

// Retrieve the cart array from the session
const carrello = JSON.parse(sessionStorage.getItem(utente.carrello));
console.log(carrello);

if (carrello) {
    // Call the creaOrdini function with the cart array
    const risposta = await creaOrdini(carrello);
    console.log(risposta);
    const articolo = risposta.result.find(element => element.id == idProdotto);
}