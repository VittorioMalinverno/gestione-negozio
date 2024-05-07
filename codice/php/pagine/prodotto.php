<?php
if (!isset($_GET["idProdotto"]) || empty($_GET["idProdotto"])) {
    header("location: ./home.php");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quantita = intval($_POST['quantita']);
        $prodotto = $_POST["agg_nome"];
        $descrizione = $_POST["agg_descrizione"];
        $prezzo = $_POST["agg_prezzo"];
        if ($quantita >= 1 && isset($prodotto) && !empty($prodotto)) {
            session_start();
            if (!isset($_SESSION['utente']['carrello'])) {
                $_SESSION['utente']['carrello'] = [];
            }
            $presente = -1;
            for ($i = 0; $i < count($_SESSION['utente']['carrello']); $i++) {
                if ($_SESSION['utente']['carrello'][$i]['prodotto'] == $prodotto) {
                    $presente = $i;
                }
            }
            if ($presente == -1) {
                $_SESSION['utente']['carrello'][] = [
                    "prodotto" => $prodotto,
                    "descrizione" => $descrizione,
                    "prezzo" => $prezzo,
                    "quantita" => intval($quantita),
                ];
            } else {
                $_SESSION['utente']['carrello'][$presente]['quantita'] = $_SESSION['utente']['carrello'][$presente]['quantita'] + intval($quantita);
            }

            header("location: ./home.php");
        }
    }
}
?>
<!DOCTYPE html>

<html>

<head>
    <!-- caratteristiche del file  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- titolo del progetto -->
    <title>Prodotto</title>

    <!-- il mio file css -->
    <link rel="stylesheet" href="../../css/prodotto.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- navbar principale -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">

            <!-- tasto con titolo per tornare indietro -->
            <a class="navbar-brand" href="./home.php">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- contenuto navbar principale -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- barra di ricerca -->
                    <li class="nav-item">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>

                    <!-- selezione di un menù a tendina -->
                    <div class="ms-20">
                        <li class="nav-item dropdown">

                            <!-- interazione menù a tendina -->
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                </svg> Seleziona la categoria
                            </a>

                            <!-- opzioni menù a tendina -->
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </div>
                </ul>

                <!-- tasto per accedere e carrello -->
                <div class="d-flex">
                    <a href="" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5"><a href="./login.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5">
                            <?php
                            session_start();
                            if (isset($_SESSION['utente'])) {
                                echo "Ciao, " . $_SESSION['utente']['nome'];
                            } else {
                                echo "Ciao, accedi";
                            }
                            ?>
                        </a>
                        <a href="./carrello.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg> Carrello
                        </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- navbar secondaria -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid mx-10">

            <!-- in caso di poco spazio rientra nel tasto a parte -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- testo promozionale -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <p class="text-light fs-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-truck me-2" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                    </svg> Spedizione gratuita su tutti gli ordini!
                </p>
            </div>
        </div>
    </nav>

    <!-- nome prodotto -->
    <div class="container1">
        <h1>Acquista <span id="nomeProdotto"></span></h1>
        <h5>Prezzo <span id="prezzo"></span>€</h5>
    </div>

    <!-- immagine e descrizione -->
    <div class="container2">
        <!-- immagini di sinistra -->
        <div class="left-column">
            <img src="./placeholder.png" alt="...">
        </div>
        <!-- dati a destra -->
        <div class="right-column">
            <!-- descrizione -->
            <p>categoria: <span id="categoria"></span></p>
            <p>Descrizione: <span id="descrizione"></span></p>
            <p>stock rimanente: <span id="stockRimanente"></span></p>
            <!-- bottone per agiungere al carrello -->
            <div class="d-grid gap-2 mt-5">
                <form method="post">
                    <input type="number" name="quantita" min="1" value="1" />
                    <input type="hidden" name="agg_nome" id="agg_nome" />
                    <input type="hidden" name="agg_descrizione" id="agg_descrizione" />
                    <input type="hidden" name="agg_prezzo" id="agg_prezzo" />
                    <input type="submit" class="btn btn-primary rounded-pill" value="Aggiungi al carrello" />
                </form>
            </div>
        </div>
    </div>
    <script src="../../javascript/prodotto.js" type="module"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>