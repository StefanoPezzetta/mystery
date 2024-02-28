<?php
// Consentire l'accesso da qualsiasi origine
header("Access-Control-Allow-Origin: *");

// Consenti l'utilizzo di alcune intestazioni specifiche (incluso Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Altri header che potrebbero essere richiesti
header('Content-Type: application/json');

$num_rows = "";
require("config.php"); //parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    
    if ($data !== null) {
        $email = $data['email'];
        $pw = $data['pw'];  

        $stmt = $mydb->prepare("SELECT pw FROM utente WHERE email = ?");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            $stmt->bind_result($hash);
            $stmt->fetch();
            $stmt->close();

            if ($hash !== null && password_verify($pw, $hash)==true) {
                $num_rows = 1;
            }else{
                $num_rows = 0;
            }
        } else {
            // Gestione degli errori durante l'esecuzione della query
            echo json_encode(["error" => "Errore durante l'esecuzione della query"]);
            exit();
        }
    }

    // Invia la risposta JSON solo dopo il completamento delle operazioni
    echo json_encode(["num_rows" => $num_rows]);
}
?>