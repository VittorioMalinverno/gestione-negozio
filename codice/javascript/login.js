import { login as funLogin} from "./viewArticoli.js";
const email = document.getElementById("email");
const password = document.getElementById("password");
const login = document.getElementById("login");


login.onclick = async() =>{
    let rsp = await funLogin({
        email: email.value,
        password: password.value
    });
    console.log(rsp);
    if (rsp.result === "Super Admin"){
        window.location.href = "../pagine/homeAdmin.php";
    } else if(rsp.result){
        window.location.href = "./login.php?response="+rsp.result;
    } else {
        document.cookie = "error = Errore nella login, riprovare";
        window.location.href = "./login.php";
    }
}