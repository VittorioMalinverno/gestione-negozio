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
    if(rsp.result){     
        window.location.href = "./login.php?response="+rsp.result;
    }
}