<?php
session_start();
if (!isset($_SESSION['utente'])) {
    header("location: ./home.php");
}
?>

<!DOCTYPE html>

<html>

<head>
    <!-- caratteristiche del file  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- titolo del progetto -->
    <title>carrello</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
                        <form class="d-flex" role="search" onsubmit="return false">
                            <input class="form-control me-2" id="prodottoSearch" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit" id="cerca">Search</button>
                        </form>
                    </li>

                    <!-- selezione di un menù a tendina -->
                    <div class="ms-20">
                        <li class="nav-item dropdown">

                            <!-- interazione menù a tendina -->
                            <a class="nav-link dropdown-toggle" id="viewCategorie" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                </svg> Seleziona la categoria
                            </a>

                            <!-- opzioni menù a tendina -->
                            <ul class="dropdown-menu" id="categorie">
                            </ul>
                        </li>
                    </div>
                </ul>

                <!-- tasto per accedere e carrello -->
                <div class="d-flex">
                    <a href="./login.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5">
                        <?php
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

    <h1>Il tuo carrello</h1>
    <br>

    <div class="container">

        <?php
        //se è presente qualcosa nel carrello stamperà il carrello altrimenti dirà che è vuoto
        if (isset($_SESSION['utente']['carrello']) && !empty($_SESSION['utente']['carrello'])) {
            $carrello = $_SESSION['utente']['carrello'];
        ?>

            <table id="carrello" class="table table-hover table-condensed">

                <!-- intestazione tabella -->
                <thead>
                    <tr>
                        <th style="width:70%">Prodotto</th>
                        <th style="width:10%">Quantità</th>
                        <th style="width:10%">Prezzo</th>
                        <th style="width:10%">Elimina</th>
                    </tr>
                </thead>

                <!-- contenuto tabella (prodotti) -->
                <tbody>
                    <?php foreach ($carrello as $prodotto) { ?>
                        <tr>
                            <td data-th="prodotto">
                                <div class="row">
                                    <div class="col-sm-2"><img src="./placeholder.png" alt="..." class="img-responsive" width="100" height="100" /></div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?php echo $prodotto["prodotto"] ?></h4>
                                        <p><?php echo $prodotto["descrizione"] ?></p>
                                    </div>
                                </div>
                            </td>

                            <td data-th="quantità">
                                <p><?php echo $prodotto["quantita"] ?></p>
                            </td>

                            <td data-th="prezzo"><?php $prodotto["prezzo"] ?></td>

                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

                <!-- parte finale della tabella -->
                <tfoot>
                    <tr>
                        <form method="POST" action="">
                            <td><a href="./home.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Compra ancora</a></td>
                            <td class="hidden-xs">
                                <select name="metodo_pagamento">
                                    <option value="carta">Mastercard</option>
                                    <option value="contanti">Visa</option>
                                    <option value="paypal">Paypal</option>
                                </select>
                            </td>
                            <td class="hidden-xs"><strong>Totale 23€</strong></td>
                            <td><a href="#"><button class="btn btn-success btn-block" type="submit"> Paga </button></a></td>
                        </form>
                    </tr>
                </tfoot>
            </table>

        <?php
        } else {
            echo "<h2>Il tuo carrello è vuoto</h2>";
        }
        ?>

    </div>

</body>

</html>