<?php

/**
 * Modulo per ottenere il numero di ordini che ogni cliente ha fatto.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "SELECT COUNT(*) AS numeroOrdini, utente.nome, utente.cognome FROM utente INNER JOIN ordine ON ordine.idUtente = utente.id GROUP BY uente.email";
        $result = [];
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode(["result" => $result]);
       // require("./closeConnection.php");
        exit();
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire la ricerca dei prodotti richiesti dal cliente specificato", "error" => $e->getMessage()]]);
       // require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
