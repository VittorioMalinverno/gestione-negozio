<?php

/**
 * Modulo per l'eliminazione di un utente registrato.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $email = $request_data['email'] ?? null;
        if(!empty($email) && isset($email) ){
            $query = "DELETE FROM utente WHERE email='".$email."'";
            require("./connection.php");
            $conn->query($query);
            require("./closeConnection.php");
            echo  json_encode(["result" => "Eliminazione avvenuta con successo"]);
        }else{
            echo  json_encode(["result" => "Username e/o password mancante"]);
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con l'eliminazione dell'utente", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
?>