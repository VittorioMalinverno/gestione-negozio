import { recuperaProdotti as getProdotti } from "./viewArticoli.js";
const tipologia = document.getElementById('tipologia');
const descrizione = document.getElementById('descrizione');
const prezzo = document.getElementById('prezzo');
const stock = document.getElementById('stock');
const immagine = document.getElementById('immagine');
const index = document.getElementById('index').value;
const salva = document.getElementById('salva');
const nomeProdotto = document.getElementById('nomeProdotto');

let nome;

(async () => {
    const dati = await getProdotti();
    nome = dati.result[index].nome;
    nomeProdotto.innerText = nome; 
    tipologia.value = dati.result[index].tipologia;
    descrizione.value = dati.result[index].descrizione;
    prezzo.value = dati.result[index].prezzo;
    stock.value = dati.result[index].stock;
  })();

  const aggiungiArticolo = (dizionario) => {
    console.log(dizionario);
    return new Promise((resolve, reject) => {
      fetch("../servizi/aggiungiArticolo.php", {
        method: "Post",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify(dizionario)
      })
        .then((element) => {
          return element.json();
        }).then((response) => {
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        });
    });
  }

  //NON FUNZIONA
salva.onclick = async () => {
    if (nome.value !== "" && tipologia.value !== "" && descrizione.value !== "" && prezzo.value !== "" && stock.value !== "" && immagine.value !== "") {
      const rsp = await aggiungiArticolo({
        nome: nome,
        tipologia: tipologia.value,
        descrizione: descrizione.value,
        prezzo: prezzo.value,
        stock: stock.value,
        //immagineSerializzata: immagine.value,
        immagineSerializzata: "",

      });
      console.log(rsp);
      if(rsp === "OK") {
        window.location.href = "../pagine/homeAdmin.php";
      }
    } else {
      console.log("Valorizzare tutti i campi");
    }
  }