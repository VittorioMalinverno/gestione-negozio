import { recuperaProdotti as getProdotti } from "./viewArticoli.js";
const table = document.getElementById('table');
const salva = document.getElementById('salva');
const nome = document.getElementById('nome');
const tipologia = document.getElementById('tipologia');
const descrizione = document.getElementById('descrizione');
const prezzo = document.getElementById('prezzo');
const stock = document.getElementById('stock');
const immagine = document.getElementById('immagine');

let html = "";
const thead = `<thead>
<tr class="table-dark">
    <th>#</th>
    <th>Nome</th>
    <th>Tipologia</th>
    <th>Prezzo</th>
    <th>Stock</th>
    <th></th>
</tr>
</thead>`;

const template = `<tbody>
<tr>
    <td>%ID</td>
    <td>%NOME</td>
    <td>%TIPOLOGIA</td>
    <td>%PREZZO</td>
    <td>%STOCK</td>
    <td><a class="btn btn-outline-primary" href="../pagine/prodottoAdmin.php?index=%INDEX"> Modifica</a></td>
</tr>
</tbody>`;

(async () => {
  const dati = await getProdotti();
  console.log(dati);
  html += thead;
  dati.result.forEach((element, index) => {
    html += template.replace("%ID", element.id).replace("%NOME", element.nome).replace("%TIPOLOGIA", element.tipologia)
      .replace("%PREZZO", element.prezzo + "€").replace("%STOCK", element.stock).replace("%INDEX", index);
  });
  table.innerHTML = html;
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
      nome: nome.value,
      tipologia: tipologia.value,
      descrizione: descrizione.value,
      prezzo: prezzo.value,
      stock: stock.value,
      immagineSerializzata: immagine.value,
    });
    console.log(rsp);
  } else {
    console.log("Valorizzare tutti i campi");
  }
}



