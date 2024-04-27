<?php
session_start();
if(!isset($_SESSION['utente'])){
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
    <title>Impostazioni</title>

    <!-- il mio file css -->
    <link rel="stylesheet" href="../../css/impostazioni.css">
    <!-- css di bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- navbar principale -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">

            <!-- tasto con titolo per tornare indietro -->
            <a class="navbar-brand" href="#">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- contenuto navbar principale -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                </ul>

                <!-- tasto per accedere e carrello -->
                <div class="d-flex">
                    <a href="" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5">
                        <?php
                        if(isset($_SESSION['utente'])){
                            echo "Ciao, ".$_SESSION['utente']['nome'];
                          }else{
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
    <?php
    session_start();
    if(isset($_SESSION['utente'])){
    ?>
        <input type="button" value="Indietro" onclick="window.location.href='./home.php'"/>
    <?php
    }
    ?>
    <div class="container text-center mt-6">
        <div class="row align-items-start">
            <div class="col-4 border-end">
                <h3>Impostazioni</h3>
                <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy text-center">
                    <a class="fs-4 p-1 rounded link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover my-5" href="#dettagliAccount">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                        Dettagli account</a>
                    <a class="fs-4 p-1 rounded link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover my-5" href="#indirizzoDiConsegna">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Indirizzo di consegna</a>
                    <a class="fs-4 p-1 rounded link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover my-5" href="#eliminaAccount">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                        </svg>
                        Elimina account</a>
                </div>
            </div>
            <div class="col-7 mt-5 ms-6 text-start overflow-y-scroll max-h">
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="nome" class="form-label" id="dettagliAccount">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="<?php echo $_SESSION['utente']['nome']?>">
                    </div>
                    <div class="mb-3">
                        <label for="cognome" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="cognome" placeholder="<?php echo $_SESSION['utente']['cognome']?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="<?php echo $_SESSION['utente']['email']?>">
                    </div>
                    <h6 class="text-danger">Vuoi modificare la password?</h6>
                    <div class="mb-3 p-2 border border-danger rounded">
                        <label for="passwordAttuale" class="form-label mt-2">Inserisci la password attuale</label>
                        <input type="text" class="form-control mb-2" id="passwordAttuale" placeholder="Password attuale">
                        <label for="passwordNuova" class="form-label mt-2">Inserisci la nuova password</label>
                        <input type="text" class="form-control mb-2" id="passwordNuova" placeholder="Nuova password">
                        <label for="passwordNuova2" class="form-label mt-2">Reinserisci la nuova password</label>
                        <input type="text" class="form-control mb-2" id="passwordNuova2" placeholder="Nuova password">
                    </div>
                    <div class="mb-3">
                        <label for="città" class="form-label" id="indirizzoDiConsegna">Città</label>
                        <input type="email" class="form-control" id="città" placeholder="Città attuale">
                    </div>
                    <div class="mb-3">
                        <label for="via" class="form-label">Via</label>
                        <input type="email" class="form-control" id="via" placeholder="Via attuale">
                    </div>
                    <div class="mb-3">
                        <label for="civico" class="form-label">Civico</label>
                        <input type="email" class="form-control" id="civico" placeholder="Civico attuale">
                    </div>
                    <h6 class="text-danger">Vuoi eliminare l'account?</h6>
                    <div class="mb-3 p-2 border border-danger rounded">
                        <label for="eliminaAccount" class="form-label mt-2">Scrivi "ELIMINA"</label>
                        <input type="text" class="form-control mb-2" id="eliminaAccount" placeholder="ELIMINA">
                        <div class="d-grid justify-content-end mt-2">
                            <button type="button" class="btn btn-danger">Elimina account</button>
                        </div>
                    </div>
                    <h6 class="text-success">Vuoi salvare le modifiche?</h6>
                    <div class="mb-3 p-2 border border-success rounded">
                        <label for="confermaModifiche" class="form-label mt-2">Scrivi "CONFERMA"</label>
                        <input type="text" class="form-control mb-2" id="confermaModifiche" placeholder="CONFERMA">
                        <div class="d-grid justify-content-end mt-2">
                            <button type="button" class="btn btn-success">Salva modifiche</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js di bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>