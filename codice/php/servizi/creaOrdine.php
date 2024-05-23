<?php
/**
 * Modulo per la creazione dell'ordine
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $emailUtente = $request_data['email'] ?? null;
        $modalita = $request_data['modalitaPagamento'] ?? null;
        $articoli = $request_data['articoli'] ?? null;
        $dataOra = date("Y-m-d H:i:s", time());
        if (isset($emailUtente) && isset($modalita) && !empty($articoli)) {
            require("./connection.php"); // Connessione al database
            // Recupero dell'ID dell'utente
            $getidUser = $conn->prepare("SELECT id FROM utente WHERE email = ?");
            $getidUser->bind_param("s", $emailUtente);//s sta per stringa
            $getidUser->execute();
            $res = $getidUser->get_result();
            if ($res->num_rows == 1) {
                //verifico la presenza del numero richiesto dal cliente
                $inserisci = true;
                foreach ($articoli as $articolo) {
                    $stockArticolo = "SELECT id, stock FROM articolo WHERE nome='".$articolo['id']."'";
                    $res1 = $conn->query($stockArticolo);
                    $res1 = $res1->fetch_array();
                    $conteggioProdotto = "SELECT SUM(numero) AS conto FROM riguardare WHERE idArticolo = ".$res['id'];
                    $res2 = $conn->query($stockArticolo);
                    $res2 = $res2->fetch_array();
                    if(!($res1['stock'] - $res2['conto']) > $articolo['numero']){
                        $inserisci = false;
                    }
                }
                //verifico se tutti i prodottoi sono disponibilit per la quantità richiestra
                if($inserisci){
                    $idUtente = $res->fetch_assoc()['id'];
                    // Inserimento dell'ordine
                    $sqlInserimentoOrdine = "INSERT INTO ordine (idUtente, modalitaPagamento, dataOra) VALUES (?, ?, ?)";
                    $inserisciOrdine = $conn->prepare($sqlInserimentoOrdine);
                    $inserisciOrdine->bind_param("iss", $idUtente, $modalita, $dataOra);//intero-stringa-stringa
                    $inserisciOrdine->execute();
                    // Recupero dell'ID dell'ordine appena inserito
                    $idOrdine = $inserisciOrdine->insert_id;
                    // Inserimento dei prodotti nell'ordine
                    foreach ($articoli as $articolo) {
                        $id = $articolo['id'];
                        $numero = $articolo['numero'];
                        $inserisciProdotto = "INSERT INTO riguardare (idOrdine, idArticolo, numero) VALUES ( $idOrdine, (SELECT id FROM articolo WHERE nome='$id'), $numero)";
                        $conn->query($inserisciProdotto);
                    }
                    
                }else{
                    echo json_encode(["result" => true]);
                }
            } else {
                echo json_encode(["result" => "Non è stato possibile trovare l'utente"]);
            }
            $conn->close();
        } else {
            echo json_encode(["result" => "Informazioni mancanti"]);
        }
    } catch (Exception $e) {
        echo json_encode(["result" => "Errore nella creazione dell'ordine", "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["result" => "Metodo non consentito"]);
}
?>