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
    <title>Admin</title>

    <!-- il mio file css -->
    <link rel="stylesheet" href="../../css/home.css">
    <!-- css di bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- navbar principale -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">

            <!-- tasto con titolo per tornare indietro -->
            <a class="navbar-brand" href="./homeAdmin.php">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- contenuto navbar principale -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>

                <div class="d-flex">
                    <!--
                    <a href="./utentePriv.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5">Ciao, Admin</a>
                    -->
                    <p class="text-light me-5">Ciao, admin</p>
                    <a href="./logout.php" class="link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <div class="row">
            <div class="col mx-5 my-2">
                <div class="card h-100">
                    <img src="../../css/magazzino.jpg" class="card-img-top" alt="Immagine del magazzino">
                    <div class="card-body">
                        <h2 class="card-title">MAGAZZINO</h2>
                        <p class="card-text">Qui vengono gestiti i prodotti:</p>
                        <ul class="no-bullets">
                            <li>Inserimento articolo</li>
                            <li>Modifica articolo</li>
                            <li>Cancella articolo</li>
                            <li>Gestione stock</li>
                            <li> <a href="./magazzino.php" class="btn btn-primary mt-2">Vai al magazzino</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col mx-5 my-2">
                <div class="card h-100">
                    <img src="../../css/ordini.jpg" class="card-img-top" alt="Immagine degli ordini">
                    <div class="card-body">
                        <h2 class="card-title">ORDINI</h2>
                        <p class="card-text">Qui vengono gestiti gli ordini:</p>
                        <ul class="no-bullets">
                            <li>Visualizzazione ordine</li>
                            <li>Cancellazione ordine</li>
                            <li>Stato dell'ordine</li>
                            <li><a href="#" class="btn btn-primary mt-4">Vai agli ordini</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col mx-5 my-2">
                <div class="card h-100">
                    <img src="../../css/statistiche.jpg" class="card-img-top" alt="Immagine delle statistiche">
                    <div class="card-body">
                        <h2 class="card-title">STATISTICHE</h2>
                        <p class="card-text">Qui vengono visualizzate le statistiche di vendita del negozio:</p>
                        <ul class="no-bullets">
                            <li>Classificazione prodotti più venduti</li>
                            <li>Classifica dei clienti con più ordini</li>
                            <li>Classifica dei metodi di pagamento più utilizzati</li>
                            <li><a href="#" class="btn btn-primary mt-3">Vai alle statistiche</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- js di bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>