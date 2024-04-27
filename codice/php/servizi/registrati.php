<?php

/**
 * Modulo per la gestione della registrazione di un utente.
 * Ad ogni tentativo viene fatto il controllo che l'utente non sia già stato registrato (stessa mail, ...), 
 * e nel caso lo registra nel db
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $nome = $request_data['nome'] ?? null;
        $cognome = $request_data['cognome'] ?? null;
        $nomeUtente = $request_data['email'] ?? null;
        $passwordUser = $request_data['password'] ?? null;
        $tipologia = $request_data['tipologia'] ?? "base";
        $indirizzo = $request_data['indirizzo'] ?? null;
        if (isset($nome) && isset($cognome) && isset($nomeUtente) && isset($passwordUser) && isset($tipologia) && isset($indirizzo)) {
            require("./connection.php");
            //verifico che non ci sia già un utente con le stesse credenziali
            $queryPrimaVerifica = "SELECT * FROM utente WHERE nome='" . $nome . "' AND cognome = '" . $cognome . "' AND email = '" . $nomeUtente . "' AND indirizzo = '" . $indirizzo . "'";
            $resultPrimaVerifica = $conn->query($queryPrimaVerifica);
            if ($resultPrimaVerifica->num_rows > 0) {
                echo json_encode(["result" => "Utente già registrato"]);
                require("./closeConnection.php");
                exit();
            }
            //verifico che la mail non sia ripetuta
            $querySecondaVerifica = "SELECT * FROM utente WHERE email = '" . $nomeUtente . "' ";
            $resultSecondaVerifica = $conn->query($queryPrimaVerifica);
            if ($resultSecondaVerifica->num_rows > 0) {
                echo json_encode(["result" => $requestBody]);
                require("./closeConnection.php");
                exit();
            }
            //inserisco in db il nuovo utente
            $query = "INSERT INTO utente(nome, cognome, email, password, tipologia, indirizzo )" .
                " VALUES('" . $nome . "','" . $cognome . "','" . $nomeUtente . "','" . password_hash($passwordUser, PASSWORD_DEFAULT) . "','" . $tipologia . "','" . $indirizzo . "')";

            $conn->query($query);
            echo json_encode(["result" => "Ok"]);
            require("./closeConnection.php");
            exit();
        } else {
            echo  json_encode(["result" => "Body dell'http request non compilato correttamente"]);
            require("./closeConnection.php");
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con la registrazione", "error" => $e->getMessage()]]);
        exit();
        require("./closeConnection.php");
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
