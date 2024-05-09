import { creaOrdini } from "./viewArticoli.js";


// carrello.js

// Send a GET request to the PHP page
fetch('../pagine/carrello.php', {
    method: 'GET',
})
.then(response => response.json())
.then(data => {
    // Access the session array
    const carrello = data.carrello;

    // Now you can use the carrello array in your JavaScript code
    console.log(carrello);
})
.catch(error => {
    console.error('Error:', error);
});

// Retrieve the cart array from the session
//const paragrafo = document.getElementById("carrello");
//const carrello = paragrafo.textContent;
//console.log(carrello);

if (carrello) {
    // Call the creaOrdini function with the cart array
    //const risposta = await creaOrdini(carrello);
    //console.log(risposta);
    //const articolo = risposta.result.find(element => element.id == idProdotto);
}