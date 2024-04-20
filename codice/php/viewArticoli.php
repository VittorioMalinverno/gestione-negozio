<?php

/**
 * Modulo per recuperare tutti gli articoli inseriti nel db dagli utenti amministratori.
 * Se i campi della fetch sono vuoti vengono fatti vedere tutti i prodotti altrimenti viene fatta una ricerca
 * basandosi sulle variabili valorizzate.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $body_data = $request_data['body'];
        $prezzo = $body_data['prezzo'] ?? null;
        $tipologia = $body_data['tipologia'] ?? null;
        $nome = $body_data['nome'] ?? null;
        $stock = $body_data['stock'] ?? null;
        if (isset($prezzo) || isset($tipologia) || isset($nome) || isset($stock)) {
            $error = "";
            try {
                $prezzo = floatval($prezzo);
            } catch (Exception $e) {
                $error .= "Il prezzo non è un numero\n";
            }
            try {
                $stock = intval($stock);
            } catch (Exception $e) {
                $error .= "Lo stock richiesto non è un numero\n";
            }
            if (empty($error)) {
                require("./connection.php");
                $conditions = [];
                if (!empty($prezzo)) {
                    $conditions[] = "prezzo >= $prezzo";
                }
                if (!empty($tipologia)) {
                    $conditions[] = "tipologia = '$tipologia'";
                }
                if (!empty($nome)) {
                    $conditions[] = "nome = '$nome'";
                }
                if (!empty($stock)) {
                    $conditions[] = "stock >= $stock";
                }
                // Unisco le condizioni in una stringa where
                $whereClause = implode(' AND ', $conditions);
                $getSome = "SELECT * FROM articolo";
                if (!empty($whereClause)) {
                    $getSome .= " WHERE $whereClause";
                }
                $result = [];
                $res = $conn->query($getSome);
                while ($row = $res->fetch_assoc()) {
                    $result[] = $row;
                }
                echo json_encode(["result" => $result]);
                require("./closeConnection.php");
                exit();
            } else {
                error_log("array trovato: Qualcuno");
                echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero degli articoli", "error" => $error]]);
                require("./closeConnection.php");
                exit();
            }
        } else {
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
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con il recupero degli articoli", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
