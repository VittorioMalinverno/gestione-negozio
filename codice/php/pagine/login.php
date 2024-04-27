<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <p>Accedi</p>
        <form onsubmit="return false">
            <input type="text" id="username" placeholder="Inserisci il tuo username"/>
            <input type="password" id="password" placeholder="Inserisci la tua password"/>
            <input type="submit" id="login" value="login">
        </form>
        <p>Registrati</p>
        <form onsubmit="return false">
            <input type="text" id="nomeReg" placeholder="Inserisci il tuo nome"/>
            <input type="text" id="cognomeReg" placeholder="Inserisci il tuo cognome"/>
            <input type="text" id="usernameReg" placeholder="Inserisci il tuo username"/>
            <input type="password" id="passwordReg" placeholder="Inserisci la tua password"/>
            <input type="text" id="indirizzoReg" placeholder="Inserisci il tuo indirizzo"/>
            <input type="submit" id="registrati" value="registrati">
        </form>
    </div>
    <script src="../../javascript/login.js" type="module"></script>
</body>
</html>