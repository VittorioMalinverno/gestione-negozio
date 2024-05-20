<?php

/**
 * Modulo per recuperare tutti gli ordini dell'utente con una determinata email.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        //$body_data = $request_data['body'];
        $email =  $request_data['email'] ?? null;;
        if (isset($email) && !empty($email)) {
            require("./connection.php");
            $query = "SELECT * FROM ordine INNER JOIN utente ON utente.id = ordine.idUtente WHERE utente.email = '" . $email . "'";
            $res = $conn->query($query);
            $result = [];
            while ($row = $res->fetch_assoc()) {
                $result[] = $row;
            }
            echo json_encode(["result" => $result]);
           // require("./closeConnection.php");
            exit();
        } else {
            echo json_encode(["result" => "Non è stato possibile proseguire con la registrazione per mancanza di compilazione delle informazioni"]);
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero degli ordini", "error" => $e->getMessage()]]);
       // require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
