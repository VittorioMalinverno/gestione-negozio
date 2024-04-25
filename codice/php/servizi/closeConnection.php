<?php

/**
 * Modulo per la chiusura della connessione mysql.
 * Prima della sua chiusura viene fatto il controllo che $conn sia un istanza di mysqli
 */
if ($conn instanceof mysqli && isset($conn)) {
    $conn->close();
}
