import { login as funLogin, registrati as funRegistrati} from "./viewArticoli.js";
const username = document.getElementById("username");
const password = document.getElementById("password");
const login = document.getElementById("login");

const nomeReg = document.getElementById("nomeReg");
const cognomeReg = document.getElementById("cognomeReg");
const usernameReg = document.getElementById("usernameReg");
const passwordReg = document.getElementById("passwordReg");
const indirizzoReg = document.getElementById("indirizzoReg"); 
const registrati = document.getElementById("registrati");

login.onclick = async() =>{
    let rsp = await funLogin({
        email: username.value,
        password: password.value
    });
    console.log(rsp);
    if(rsp.result){
        console.log("sposto");
        window.location.href = "./home.php";
    }
}

registrati.onclick = async() =>{
    let rsp = await funRegistrati({
        nome: nomeReg.value,
        cognome: cognomeReg.value,
        email: usernameReg.value,
        password: passwordReg.value,
        indirizzo: indirizzoReg.value
    });
    nomeReg.value = cognomeReg.value = usernameReg.value = passwordReg.value = indirizzoReg.value = "";
}