<?php
session_start();
if (isset($_GET['response'])) {
    if ($_GET['response'] === "true" ) {
        $_SESSION['loggato'] = true;
        header("location: ./home.php");
    }
}

if (isset($_COOKIE['loggato']) && $_COOKIE['loggato'] === "true") {
    header("location: ./home.php");
}
?>
<!DOCTYPE html>

<html>

<head lang="it">
    <!-- caratteristiche del file  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- titolo della pagina -->
    <title>Login</title>

    <!-- css di bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- il mio file css -->
    <link rel="stylesheet" href="../../css/login.css">

</head>

<body>
    <div id="public" class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="card" style="width: 20rem">
            <div class="text-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg>
            </div>
            <form onsubmit="return false" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <?php
                        //codice per gestire la visualizzazione dell'alert
                        if (isset($_COOKIE["error"]) || $_GET['response'] === "L'utente non risulta registrato") { //se c'è un errore
                            $error = $_COOKIE["error"] ?? "Utente non registrato"; //lo recupero
                            echo "<div id='alert'>";
                            setcookie("error", "", time() - 3600);
                        } else {
                            echo "<div id='alert' class='d-none'>";
                        }
                        ?>
                        <!-- alert per visualizzare i messaggi di errore -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <!-- simbolo del triangolo col ! in mezzo -->
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                </path>
                            </symbol>
                        </svg>
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill"></use>
                            </svg>
                            <strong id="testoAlert">
                                <?php
                                //stampo il testo dell'errore dentro l'alert
                                echo $error;
                                ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <!-- bottone per chiudere l'alert -->
                        </div>
                    </div>
                    <div class="mb-3">

                        <!-- form di inserimento -->
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="nomeUtente" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div id="divLogin" class="text-center">
                        <!-- pulsante log in -->
                        <button type="submit" id="login" class="btn btn-primary">
                            Log in
                        </button>
                        <div class="form-text mt-2">
                            Non sei ancora registrato?
                            <a href="./registrazione.php">Sign up</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../../javascript/login.js" type="module"></script>
    <!-- js di bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>