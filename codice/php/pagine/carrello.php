<?php
session_start();
if(!isset($_SESSION['utente'])){
    header("location: ./home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il tuo carrello</title>
    <style>
        table{
            width: 100%;
            text-align:center;
        }
    </style>
</head>
<body>
    <input type="button" value="indietro" onclick="window.location.href='./home.php'"/>
    <div>
        <h1>Il tuo carrello</h1>
        <table>
            <tr><th>Prodotto</th><th>Quantità</th></tr>
            <?php
             $carrello = $_SESSION['utente']['carrello'];
             if(isset($carrello) && !empty($carrello)){
                for($i=0;$i < count($carrello); $i++){
                    $prodotto = $carrello[$i]['prodotto'];
                    $quantita = $carrello[$i]['quantita'];
                    echo "<tr>";
                    echo "<td>$prodotto</td>";
                    echo "<td>$quantita</td>";
                    echo "<tr>";
                }
             }else{
                echo "<tr><td colspan='2'>Nessun prodotto inserito</td></tr>";
             }
            ?>
        </table>
        <?php
        if(isset($carrello) && !empty($carrello)){
        ?>
        <form method="post" action="">
            <select name="metodopagamento" >
                <option value="">Seleziona il metodo di pagamento</option>
                <option value="carta">carta</option>
                <option value="contanti">contanti</option>
                <option value="paypal">paypal</option>
            </select>
            <input type="submit"/>
        </form>
        <?php
        }
        ?>
        
    </div>
</body>
</html>