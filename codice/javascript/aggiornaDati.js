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

buttonConferma.onclick = () => {
    if (confermaModifiche.value === "CONFERMA") {
        funLogin({
            email: emailAttuale.value,
            password: passwordAttuale.value
        }).then((rsp) => {
            if (rsp.result) {
                if (passwordNuova.value === passwordNuova2.value) {
                    aggiornaUtente({
                        nome: nome.value,
                        congome: cognome.value,
                        email: emailNuova.value,
                        password: passwordNuova.value,
                        indirizzo: indirizzo.value,
                    }).then((response) => {
                        if (response.result) {
                            //window.location.href = "./utentePriv.php?response=" + response.result;
                        }
                    })
                } else {
                    console.log("password diverse");
                }
            } else {
                console.log(rsp.result);
            }
        })
    }

}