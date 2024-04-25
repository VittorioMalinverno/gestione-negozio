<?php

/**
 * Modulo per ottenere il numero di pagamenti utilizzati e li ordina in modo discendente
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $query = "SELECT  modalitaPagamento, COUNT(modalitaPagamento) AS conteggio  FROM ordine  GROUP BY modalitaPagamento ORDER BY conteggio DESC";
        require("./connection.php");
        $result = [];
        $res = $conn->query($query);
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode(["result" => $result]);
        require("./closeConnection.php");
        exit();
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero delle tipologie di pagamenti fatti", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
