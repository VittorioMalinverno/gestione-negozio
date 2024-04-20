<?php

/**
 * Modulo per ottenere i prodotti con la quantità venduta.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "SELECT articolo.*, COUNT(riguardare.numero) FROM articolo INNER JOIN riguardare "
            . " ON articolo.id = riguardare.idArticolo INNER JOIN ordine ON riguardare.idOrdine = ordine.id GROUP BY articolo.id";
        $result = [];
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode(["result" => $result]);
        require("./closeConnection.php");
        exit();
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero dei prodotti con la quantità", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
