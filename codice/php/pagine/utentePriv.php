<?php
session_start();
?>
<html>

<head>
  <!-- caratteristiche del file  -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- titolo del progetto -->
  <title>Pagina privata</title>

  <!-- il mio file css -->
  <link rel="stylesheet" href="../../css/utentePriv.css">
  <!-- css di bootstrap -->
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

        </ul>

        <!-- tasto per accedere e carrello -->
        <div class="d-flex">
          <a href="" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover me-5">
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

  <?php
  if (isset($_GET['modifica'])) {
    if ($_GET['modifica'] === "OK") {
  ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Dati modificati con successo.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $_GET['modifica'];
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  <?php
    }
  }
  ?>

  <!-- immagine utente con pulsanti -->
  <div class="container-fluid px-5 mt-5">
    <div class="row mb-0 mx-5">
      <div class="col-6 d-flex justify-content-start align-items-center">
        <div>
          <h2>Ciao, <?php echo $_SESSION['utente']['nome'] ?></h2>
        </div>
      </div>
      <div class="col-6 d-flex flex-column justify-content-start align-items-end mt-5">
        <a href="./impostazioni.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover mb-2">Impostazioni</a>
        <a href="./ordini.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover mt-2">I miei ordini</a>
      </div>
    </div>
  </div>

  <!-- carosello con prodotti più venduti -->
  <div class="border carosello mx-5 mt-5">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">

      <!-- vetrina iniziale -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./placeholder.png" class="d-block w-100" height="400" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./placeholder.png" class="d-block w-100" height="400" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./placeholder.png" class="d-block w-100" height="400" alt="...">
        </div>
      </div>

      <!-- pulsante di navigazione -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- js di bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>