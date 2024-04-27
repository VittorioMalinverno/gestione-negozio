<?php

/**
 * Modulo per recuperare tutti gli articoli inseriti nel db dagli utenti amministratori.
 * Se i campi della fetch sono vuoti vengono fatti vedere tutti i prodotti altrimenti viene fatta una ricerca
 * basandosi sulle variabili valorizzate.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
            require("./connection.php");
            $getAll = "SELECT * FROM articolo";
            $res = $conn->query($getAll);
            $result = [];
            while ($row = $res->fetch_assoc()) {
                $result[] = $row;
            }
            echo json_encode(["result" => $result]);
            require("./closeConnection.php");
            exit();
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero degli articoli", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
