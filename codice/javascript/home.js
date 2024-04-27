import { recuperaProdotti } from "./viewArticoli.js";
const articoli = document.getElementById("articoli");
const search = document.getElementById("cerca");
const prodottoSearch = document.getElementById("prodottoSearch");

search.onclick = async () => {
  if (prodottoSearch.value != "") {
    let rsp = await recuperaProdotti();
    rsp = rsp.result;
    rsp = rsp.filter(element => element.nome.toLowerCase().includes(prodottoSearch.value.toLowerCase()));
    prodottoSearch.value = "";
    view(rsp);
  }
}
const cardTemplate = `
<div class="col mx-5 my-5">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title mb-4">%TITOLO</h5>
              <img src="./placeholder.png" class="card-img-top" alt="...">
              <div class="d-flex mt-5 justify-content-between align-items-center">
                <p class="m-0">%PREZZO €</p>
                <a class="btn btn-primary rounded-pill acquista" id="%ID">Acquista</a>
              </div>
            </div>
          </div>
        </div>
`;
const view = async (rsp) => {
  let html = "";
  if (rsp) {
    rsp.forEach(element => {
      html += cardTemplate
        .replace("%TITOLO", element.nome)
        .replace("%PREZZO", element.prezzo)
        .replace("%ID", element.id);
    })
  } else {
    const rsp = await recuperaProdotti();
    rsp.result.forEach(element => {
      html += cardTemplate
        .replace("%TITOLO", element.nome)
        .replace("%PREZZO", element.prezzo)
        .replace("%ID", element.id);
    })
  }
  articoli.innerHTML = html;
  document.querySelectorAll(".acquista").forEach(element => {
    element.onclick = () => {
      window.location.href = "./prodotto.php?idProdotto=" + element.id;
    }
  })
}


view();