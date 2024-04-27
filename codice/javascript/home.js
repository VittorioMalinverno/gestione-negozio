import { recuperaProdotti } from "./viewArticoli.js";
const articoli = document.getElementById("articoli");
const search = document.getElementById("cerca");
const prodottoSearch = document.getElementById("prodottoSearch");
const viewCategorie = document.getElementById("viewCategorie");
const categorie = document.getElementById("categorie");

const templateCategoria = `
  <li><a class="dropdown-item categorieSearch" id='%categoria'>%categoria</a></li>
`;
viewCategorie.onclick = async() =>{
  let rsp = await recuperaProdotti();
  const cat = [];
  rsp.result.forEach(element=>{
    if(!cat.includes(element.tipologia.toLowerCase())){
      cat.push(element.tipologia.toLowerCase());
    }
  })
  let html = templateCategoria.replaceAll("%categoria", "Rimuovi filtro");
  cat.forEach(element =>{
    html += templateCategoria.replaceAll("%categoria", element);
  })
  categorie.innerHTML = html;
  document.querySelectorAll(".categorieSearch").forEach(element => {
    element.onclick = async() => {
      const tipo = element.id;
      let rsp = await recuperaProdotti();
      rsp = rsp.result;
      if(tipo == "Rimuovi filtro"){
        view(rsp);
      }else{
        rsp = rsp.filter(element => element.tipologia.toLowerCase() == tipo);
        view(rsp);
      }
    }
  })
}
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