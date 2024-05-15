<?php
/**
 * Modulo per la modifica dei dati di un utente registrato.
 * Attraverso la mail viene trovato l'utente interessato e viene fatto un update dei campi non vuoti
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
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
                // Codifica la password se è stata fornita
                if (!empty($password)) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                }
                
                // Genera la parte SET della query di aggiornamento
                $updateFields = [];
                if (!empty($nome)) {
                    $updateFields[] = "nome = '$nome'";
                }
                if (!empty($cognome)) {
                    $updateFields[] = "cognome = '$cognome'";
                }
                if (!empty($password)) {
                    $updateFields[] = "password = '$password'";
                }
                if (!empty($tipologia)) {
                    $updateFields[] = "tipologia = '$tipologia'";
                }
                if (!empty($indirizzo)) {
                    $updateFields[] = "indirizzo = '$indirizzo'";
                }
                if (!empty($nuovaMail)) {
                    // Controlla se la nuova email è diversa dalla vecchia
                    if ($nuovaMail != $email) {
                        // Controlla se la nuova email esiste già
                        $checkEmail = "SELECT * FROM utente WHERE email = '$nuovaMail'";
                        $userCheckEmail = $conn->query($checkEmail);
                        if ($userCheckEmail->num_rows > 0) {
                            echo json_encode(["result" => "Esiste già un utente con questa email"]);
                            require("./closeConnection.php");
                            exit();
                        }
                        $updateFields[] = "email = '$nuovaMail'";
                    }
                }
                
                // Esegui la query solo se ci sono campi da aggiornare
                if (!empty($updateFields)) {
                    $queryUpdate = "UPDATE utente SET ";
                    $queryUpdate .= implode(", ", $updateFields);
                    $queryUpdate .= " WHERE email='" . $email . "'";
                    $conn->query($queryUpdate);
                    echo  json_encode(["result" => "OK"]);
                    require("./closeConnection.php");
                    exit();
                } else {
                    echo  json_encode(["result" => "Non sono stati specificati i campi da modificare"]);
                    require("./closeConnection.php"); 
                    exit();
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
