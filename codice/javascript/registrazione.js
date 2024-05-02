import { registrati as funRegistrati} from "./viewArticoli.js";

const nome = document.getElementById("nome");
const cognome = document.getElementById("cognome");
const email = document.getElementById("email");
const password = document.getElementById("password");
const indirizzo = document.getElementById("indirizzo"); 
const registrati = document.getElementById("registrati");

registrati.onclick = async() =>{
    let rsp = await funRegistrati({
        nome: nome.value,
        cognome: cognome.value,
        email: email.value,
        password: password.value,
        indirizzo: indirizzo.value
    });
    nome.value = cognome.value = email.value = password.value = indirizzo.value = "";
}