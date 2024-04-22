<?php

/**
 * Modulo per la connessione al db mysql
 * 
 */
require("./leggiFile.php");
$conf = leggiFile("./conf.json");
$conn = new mysqli($conf["urlDb"], $conf["usernameDb"], $conf["passwordDb"], $conf["databaseDb"]);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
