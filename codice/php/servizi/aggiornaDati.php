<?php

/**
 * Modulo per la modifica dei dati di un utente registrato.
 * Attraverso la mail viene trovato l'utente interessato e viene fatto un update dei campi non vuoti
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
       // $body_data = $request_data['body'];
        $email = $request_data['email'] ?? null;
        $nome = $request_data['nome'] ?? null;
        $cognome = $request_data['cognome'] ?? null;
        $password = $request_data['password'] ?? null;
        $tipologia = $request_data['tipologia'] ?? null;
        $indirizzo = $request_data['indirizzo'] ?? null;
        $nuovaMail = $request_data['nuovaMail'] ?? null;
        if (isset($email) && !empty($email)) {
            $ricercaUtente = "SELECT * FROM utente WHERE email = '$email'";
            require("./connection.php");
            $utente = $conn->query($ricercaUtente);
            if (mysqli_num_rows($utente) == 1) {
                $conditions = [];
                $password = password_hash($password, PASSWORD_DEFAULT);
                if (!empty($nome)) {
                    $conditions[] = "nome = $nome";
                }
                if (!empty($cognome)) {
                    $conditions[] = "cognome = '$cognome'";
                }
                if (!empty($password)) {
                    $conditions[] = "password = '$password'";
                }
                if (!empty($tipologia)) {
                    $conditions[] = "tipologia = '$tipologia'";
                }
                if (!empty($stock)) {
                    $conditions[] = "stock = $stock";
                }
                if (!empty($indirizzo)) {
                    $conditions[] = "indirizzo = $indirizzo";
                }
                if (!empty($nuovaMail)) {
                    $conditions[] = "email = $nuovaMail";
                }
                $checkEmail = "SELECT * FROM utente WHERE email = '$nuovaMail'";
                $userCheckEmail = $conn->query($checkEmail);
                if ($userCheckEmail->num_rows > 0) {
                    echo  json_encode(["result" => "Esiste già un utente con questa email"]);
                    require("./closeConnection.php");
                    exit();
                } else {
                    $queryUpdate = "UPDATE utente SET ";
                    if (isset($nome) && isset($cognome) && isset($password)  && isset($tipologia) && isset($indirizzo) && isset($nuovaMail)) {
                        $queryUpdate .= $updateClause .= "WHERE email='" . $email . "'";
                        $conn->query($queryUpdate);
                        echo  json_encode(["result" => "Modifica avvenuta con successo"]);
                        require("./closeConnection.php");
                        exit();
                    } else {

                        echo  json_encode(["result" => "Non sono stati specificati i campi da modificare"]);
                        require("./closeConnection.php");
                        exit();
                    }
                }
            } else {
                echo  json_encode(["result" => "Non è stato possibile trovare un utente, o esistono più utenti con questo indirizzo email"]);
                require("./closeConnection.php");
                exit();
            }
        } else {
            echo  json_encode(["result" => "Errore: campi non completi"]);
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con l'aggiornamento dei dati dell'utente", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
