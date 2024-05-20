<?php

/**
 * Modulo per aggiungere in db un nuovo articolo.
 * Se viene aggiunto un prodotto il cui nome è già presente in db viene sovrascritto e quindi tutti i suoi dati vengono 
 * rivalorizzati con i dati passati come parametro
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $prezzo = $request_data['prezzo'] ?? null;
        $descrizione = $request_data['descrizione'] ?? null;
        $tipologia = $request_data['tipologia'] ?? null;
        $nome = $request_data['nome'] ?? null;
        $stock = $request_data['stock'] ?? null;
        $immagineSerializzata = $request_data['immagineSerializzata'] ?? null;
        if (isset($prezzo) && isset($descrizione) && isset($tipologia) && isset($nome) && isset($stock) && isset($immagineSerializzata) && !empty($prezzo) && !empty($descrizione) && !empty($tipologia) && !empty($nome) && !empty($stock) && !empty($immagineSerializzata)) {
            $error = "";
            try {
                $prezzo = floatval($prezzo);
            } catch (Exception $e) {
                $error .= "E' stato inserito un prezzo non valido\n";
            }
            try {
                $stock = floatval($stock);
            } catch (Exception $e) {
                $error .= "E' stato inserito un numero di stock non valido\n";
            }
            if (empty($error)) {
                require("./connection.php");
                //verifico se esiste già un prodotto con lo stesso nome -> se esiste faccio update altrimenti lo aggiungo
                $queryVerifica = "SELECT * FROM articolo WHERE nome='" . $nome . "'";
                $resUno = $conn->query($queryVerifica);
                if ($resUno->num_rows > 0) {
                    //articolo già presente
                    $conditions = [];
                    if (!empty($prezzo)) {
                        $conditions[] = "prezzo = $prezzo";
                    }
                    if (!empty($descrizione)) {
                        $conditions[] = "descrizione = '$descrizione'";
                    }
                    if (!empty($tipologia)) {
                        $conditions[] = "tipologia = '$tipologia'";
                    }
                    if (!empty($immagineSerializzata)) {
                        $conditions[] = "immagineSerializzata = '$immagineSerializzata'";
                    }
                    if (!empty($stock)) {
                        $conditions[] = "stock = $stock";
                    }
                    //query di update
                    $updateClause = implode(', ', $conditions);
                    $queryUpdate = "UPDATE articolo SET ";
                    if (!empty($whereClause) && !empty($nome) && isset($nome)) {
                        $queryUpdate .= $updateClause .= "WHERE nome='" . $nome . "'";
                        $conn->query($queryVerifica);
                        echo json_encode(["result" => "Articolo aggiornato con successo"]);
                       // require("./closeConnection.php");
                        exit();
                    } else {
                        echo json_encode(["result" => "Non è stato possibile fare l'update, campi non completi"]);
                       // require("./closeConnection.php");
                        exit();
                    }
                } else {
                    $query = "INSERT INTO articolo(prezzo, descrizione, tipologia, nome, stock, immagineSerializzata) VALUES(" . $prezzo . ",'" . $descrizione . "','" . $tipologia . "','" . $nome . "'," . $stock . ",'" . $immagineSerializzata . "')";
                    $conn->query($query);
                    echo json_encode(["result" => "Articolo aggiunto con successo"]);
                   // require("./closeConnection.php");
                    exit();
                }
            } else {
                echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con l'aggiunta dell'articolo", "error" => $error]]);
               // require("./closeConnection.php");
                exit();
            }
        } else {
            echo json_encode(["result" => "Non è stato possibile proseguire con l'aggiunta dell'articolo a causa di informazioni mancanti"]);
           // require("./closeConnection.php");
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con l'aggiunta dell'articolo", "error" => $e->getMessage()]]);
       // require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
