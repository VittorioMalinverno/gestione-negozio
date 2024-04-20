<?php

/**
 * Modulo per la creazione di un ordine.
 * prende in ingresso un array di prodotti con la quantità
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $body_data = $request_data['body'];
        $emailUtente = $body_data['email'] ?? null;;
        $modalita = $body_data['modalitaPagamento'] ?? null;;
        $articoli = $body_data['articoli'] ?? null;;
        $dataOra = date("Y-m-d H:i:s", time());
        if (isset($emailUtente) && isset($modalita) && isset($articoli) && !empty($emailUtente) && !empty($modalita) && !empty($articoli)) {
            $getidUser = "SELECT id FROM utente WHERE email='" . $email . "'";
            require("./connection.php");
            $res = $conn->query($query);
            if ($res->num_rows == 1) {
                $res = $res->fetch_array();
                $idUtente = $res[0]['id'];
                if (isset($idUtente) && !empty($idUtente)) {
                    //inserisco l'ordine
                    $sqlInserimentoOrdine = `INSERT INTO ordine(idUtente,modalitaPagamento, dataOra) VALUES(` . $idUtente . `,'` . $modalita . `', '` . $dataOra . `');`;
                    //recupero l'id dell'ordine
                    $idOrdine = "SELECT id FROM ordine WHERE idUtente = '" . $idUtente . "' AND modalitaPagamento = '" . $modalita . "' AND dataOra = '" . $dataOra . "'";
                    $res = $conn->query($query);
                    if ($res->num_rows == 1) {
                        $result = $res->fetch_array();
                        $idOrdine =  $result['id'];
                        if (isset($idOrdine) && !empty($idOrdine)) {
                            //recupero gli id dei prodotti
                            $idProdotti = [];
                            foreach ($articoli as $articolo) {
                                $id = $articolo['id'];
                                $numero = $articolo['numero'];
                                if (isset($id) && !empty($id) && isset($numero) && !empty($numero)) {
                                    $idProdotti[] = ["id" => $id, "numero" => $numero];
                                } else {
                                    $nome = $articolo['nome'];
                                    if (isset($nome) && !empty($nome)) {
                                        $searchId = "SELECT id FROM articolo WHERE nome = '$nome'";
                                        $res = $conn->query($query);
                                        if ($res->num_rows == 1) {
                                            if (isset($id) && !empty($id) && isset($numero) && !empty($numero)) {
                                                $resultId = $res->fetch_array();
                                                $idProdotto =  $resultId['id'];
                                                $idProdotti[] = ["id" => $id, "numero" => $numero];
                                            } else {
                                                echo json_encode(["result" => "Errore nella ricerca del prodotto, non è stato possibile trovare il nome dell'articolo nel db"]);
                                                require("./closeConnection.php");
                                                exit();
                                            }
                                        } else {
                                            echo json_encode(["result" => "Errore nella ricerca del prodotto, non è stato possibile trovare il nome dell'articolo nel db"]);
                                            require("./closeConnection.php");
                                            exit();
                                        }
                                    } else {
                                        echo json_encode(["result" => "Errore nella ricerca del prodotto, non è stato possibile trovare il nome dell'articolo nel db"]);
                                        require("./closeConnection.php");
                                        exit();
                                    }
                                }
                            }
                            //controllo il numero di prodotto richiesto rispetto alla disponibilità
                            foreach ($idProdotti as $idProdotto) {
                                $queryStock = "SELECT stock FROM articolo WHERE id = $idProdotto";
                                $stockResQ = $conn->query($queryStock);
                                if ($stockResQ->num_rows > 0) {
                                    $stockRes = $stockResQ->fetch_array();
                                    $stock = intval($stockRes['stock']);
                                    if (isset($stock) && !empty($stock)) {
                                        //calcolo il quantitativo di prodotto che è già stato richiesto in altri ordini
                                        $stockRichiestoQuery = "SELECT SUM(numero) AS stockRichiesto FROM riguardare WHERE idArticolo = $idProdotto";
                                        $stockResRichQ = $conn->query($stockRichiestoQuery);
                                        $stockResRichRes = $res->fetch_array();
                                        $stockSum = intval($stockResRichRes['stockRichiesto']);
                                        if ($stockResQ->num_rows > 0) {
                                            $idProdotto['quantitaDisponibile'] = $stock - $stockSum;
                                        } else {
                                            $idProdotto['quantitaDisponibile'] = $stock;
                                        }
                                    } else {
                                        echo json_encode(["result" => "Errore nella creazione dell'ordine"]);
                                        require("./closeConnection.php");
                                        exit();
                                    }
                                } else {
                                    echo json_encode(["result" => "Errore nella creazione dell'ordine"]);
                                    require("./closeConnection.php");
                                    exit();
                                }
                            }
                            //controllo la disponibilità rispetto alla richiesta
                            foreach ($idProdotti as $idProdotto) {
                                $id =  $idProdotto['id'];
                                $numero =  $idProdotto['numero'];
                                $quantitaDisponibile = $idProdotto['quantitaDisponibile'];
                                if ($numero > $quantitaDisponibile) {
                                    echo json_encode(["result" => "Errore nel numero di prodotto richiesto rispetto alla sua disponibilità"]);
                                    require("./closeConnection.php");
                                    exit();
                                }
                            }
                            //inserisco il prodotto nell'ordine
                            foreach ($idProdotti as $idProdotto) {
                                $id =  $idProdotto['id'];
                                $numero =  $idProdotto['numero'];
                                $query = "INSERT INTO riguardare(idOrdine, idArticolo, numero) VALUES($idOrdine, $id, $numero)";
                            }
                            echo json_encode(["result" => "Creazione dell'ordine avvenuto con successo"]);
                            require("./closeConnection.php");
                            exit();
                        } else {
                            echo json_encode(["result" => "Errore nella creazione dell'ordine"]);
                            require("./closeConnection.php");
                            exit();
                        }
                    } else {
                        echo json_encode(["result" => "Errore nella creazione dell'ordine"]);
                        require("./closeConnection.php");
                        exit();
                    }
                } else {
                    echo json_encode(["result" => "Non è stato possibile proseguire con l'aggiunta dell'ordine perchè l'id non è stato recuperato correttamente"]);
                    require("./closeConnection.php");
                    exit();
                }
            } else {
                echo json_encode(["result" => "Non è stato possibile proseguire con l'aggiunta dell'ordine perchè non è stato trovato l'utente ricercato"]);
                require("./closeConnection.php");
                exit();
            }
        } else {
            echo json_encode(["result" => "Non è stato possibile proseguire con l'aggiunta dell'ordine a causa di informazioni mancanti"]);
            require("./closeConnection.php");
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con l'aggiunta dell'ordine'", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
