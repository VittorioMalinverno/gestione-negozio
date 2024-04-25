import {recuperaProdotti} from "./viewArticoli.js";
const articoli = document.getElementById("articoli");
const cardTemplate = `

`;

window.onload = async() =>{
    let html = "";
    const rsp = await recuperaProdotti();
    console.log(rsp);
    rsp.result.forEach(element=>{
        html += cardTemplate
        .replace("%TITOLO", element.nome)
        .replace("%PREZZO", element.prezzo)
        .replace("%ID", element.id);
    })
    articoli.innerHTML = html;
    document.querySelectorAll(".acquista").forEach(element =>{
        element.onclick = () =>{
            window.location.href="../php/pagine/prodotto.php?idProdotto="+element.id;
        }
    })
}