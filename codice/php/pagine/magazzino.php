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
    <title>Magazzino</title>

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
        <table id="table" class="table table-hover mt-3">
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Inserisci prodotto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Inserisci un nuovo prodotto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="mt-3">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipologia" class="form-label">Tipologia</label>
                                <input type="text" class="form-control" id="tipologia" required>
                            </div>
                            <div class="mb-3">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <input type="text" class="form-control" id="descrizione" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="prezzo" class="form-label">Prezzo (in €)</label>
                                <input type="number" min="0" class="form-control" id="prezzo" required>
                            </div>
                            <div class="mb-3">
                                <label for="immagine" class="form-label">Immagine serializzata</label>
                                <input type="file" class="form-control" id="immagine" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="salva" type="button" class="btn btn-primary">Salva</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../javascript/magazzino.js" type="module"></script>
    <!-- js di bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>