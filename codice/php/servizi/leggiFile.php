<?php

/**
 * Funzione per leggere dal file json di configurazione
 */
function leggiFile($path){
    $file = fopen($path, 'r');
    $contentFile = fread($file, filesize($path));
    fclose($file);
    return json_decode($contentFile, true);
}
