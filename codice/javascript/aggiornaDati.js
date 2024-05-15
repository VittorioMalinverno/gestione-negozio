import { login as funLogin } from "./viewArticoli.js";

const nome = document.getElementById("nome");
const cognome = document.getElementById("cognome");
const emailAttuale = document.getElementById("emailAttuale");
const emailNuova = document.getElementById("emailNuova");
const passwordAttuale = document.getElementById("passwordAttuale");
const passwordNuova = document.getElementById("passwordNuova");
const passwordNuova2 = document.getElementById("passwordNuova2");
const indirizzo = document.getElementById("indirizzo");
const eliminaAccount = document.getElementById("eliminaAccount");
const buttonElimina = document.getElementById("buttonElimina");
const confermaModifiche = document.getElementById("confermaModifiche");
const buttonConferma = document.getElementById("buttonConferma");

const aggiornaUtente = (dizionario) => {
    console.log(dizionario);
    return new Promise((resolve, reject) => {
        fetch("../servizi/aggiornaDati.php", {
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
                console.log(response);
            })
            .catch((error) => {
                reject(error);
                console.log(error);
            });
    });
}

buttonConferma.onclick = async () => {
    if (confermaModifiche.value === "CONFERMA") {
        const rsp = await funLogin({
            email: emailAttuale.value,
            password: passwordAttuale.value
        })
        console.log("Login: " + rsp.result);
        if (rsp.result) {
            if (passwordNuova.value === passwordNuova2.value) {
                const dict = {
                    nome: "",
                    cognome: "",
                    email: "",
                    nuovaMail: "",
                    indirizzo: "",
                    password: "",
                    tipologia: "",
                };
                if (nome.value !== "") {
                    dict.nome = nome.value;
                }
                if (cognome.value !== "") {
                    dict.cognome = cognome.value;
                };
                if (emailAttuale.value !== "") {
                    dict.email = emailAttuale.value;
                };
                if (emailNuova.value !== "") {
                    dict.nuovaMail = emailNuova.value;
                };
                if (passwordNuova.value !== "") {
                    dict.password = passwordNuova.value;
                };
                if (indirizzo.value !== "") { 
                    dict.indirizzo = indirizzo.value;
                }
                const response = await aggiornaUtente(dict);
                if (response.result) {
                    //window.location.href = "./utentePriv.php?response=" + response.result;
                }
            } else {
                console.log("password diverse");
            }
        } else {
            console.log("Credenziali errate");
        }
    }
}
