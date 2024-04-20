
<?php
/**
 * Modulo per il login.
 * Per ogni tentativo viene fatto prima il controllo che le credenziali siano del superAdmin
 * altrimenti viene fatto il controllo nel db
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $requestBody = file_get_contents('php://input');
        $request_data = json_decode($requestBody, true);
        $body_data = $request_data['body'];
        $nomeUtente = $body_data['email'] ?? null;
        $passwordUser = $body_data['password'] ?? null;
        if (isset($nomeUtente) && isset($passwordUser)) {
            require("./leggiFile.php");
            $conf = leggiFile("../../conf.json");
            if ($nomeUtente == $conf['userAdmin'] && $passwordUser == $conf['passwordAdmin']) {
                echo  json_encode(["result" => "Super Admin"]);
                exit();
            }
            require("./connection.php");
            $query = "SELECT password FROM utente WHERE email = '" . $nomeUtente . "'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($passwordUser, $row['password'])) {
                    echo  json_encode(["result" => true]);
                    require("./closeConnection.php");
                    exit();
                } else {
                    echo  json_encode(["result" => false]);
                    require("./closeConnection.php");
                    exit();
                }
            } else {
                echo  json_encode(["result" => "L'utente non risulta registrato"]);
                require("./closeConnection.php");
                exit();
            }
        } else {
            echo  json_encode(["result" => "Method not allowed"]);
            require("./closeConnection.php");
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["result" => ["message" => "Non è stato possibile proseguire con la registrazione", "error" => $e->getMessage()]]);
        require("./closeConnection.php");
        exit();
    }
} else {
    echo  json_encode(["result" => "Method not allowed"]);
    exit();
}
?>