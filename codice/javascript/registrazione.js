import { registrati as funRegistrati } from "./viewArticoli.js";

const nome = document.getElementById("nome");
const cognome = document.getElementById("cognome");
const email = document.getElementById("email");
const password = document.getElementById("password");
const indirizzo = document.getElementById("indirizzo");
const registrati = document.getElementById("registrati");


registrati.onclick = async () => {
    if (nome.value !== "" && cognome.value !== "" && email.value !== "" && password.value !== "" && indirizzo.value !== "") {
        let rsp = await funRegistrati({
            nome: nome.value,
            cognome: cognome.value,
            email: email.value,
            password: password.value,
            indirizzo: indirizzo.value
        });
        if (rsp.result === "Ok") {
            document.cookie = "loggato = true";
            window.location.href = '../pagine/login.php';
        } else {
            document.cookie = "error = Errore nella registrazione, riprovare";
            window.location.href = "./registrazione.php";
        }
        nome.value = cognome.value = email.value = password.value = indirizzo.value = "";
    } else {
        document.cookie = "error = Valorizzare tutti i campi";
            window.location.href = "./registrazione.php";
    }
}