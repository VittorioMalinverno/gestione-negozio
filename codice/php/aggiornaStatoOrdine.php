<?php

/**
 * Modulo per l'aggiornamento dello stato dell'ordine da 'In corso' (Valore di default) ad 'Evaso'.
 * L'ordine viene ricercato tramite identificativo
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $body_data = $request_data['body'];
        $idOrdine =  $body_data['id'] ?? null;
        if (!empty($idOrdine) && isset($idOrdine)) {
            require("./connection.php");
            $queryUpdate = "UPDATE ordine SET stato='Evaso' WHERE id=" . $idOrdine;
            $res = $conn->query($query);
            $result = [];
            while ($row = $res->fetch_assoc()) {
                $result[] = $row;
            }
            echo json_encode(["result" => $result]);
            require("./closeConnection.php");
            exit();
        } else {
            echo json_encode(["result" => "Non è stato selezionato l'id dell'ordine da modificare"]);
            require("./closeConnection.php");
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con la modifica dello stato dell'ordine", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
