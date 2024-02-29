<?php
// Consentire l'accesso da qualsiasi origine
header("Access-Control-Allow-Origin: *");

// Consenti l'utilizzo di alcune intestazioni specifiche (incluso Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Altri header che potrebbero essere richiesti
header('Content-Type: application/json');

require("config.php"); //parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Leggi il corpo della richiesta
    $json_data = file_get_contents("php://input");

    // Decodifica la stringa JSON in un array associativo
    $data = json_decode($json_data, true);
    if ($data !== null) {
        // Ora $data contiene i dati inviati
        $email = $data['email'];
        $pw = $data['pw'];
        $hash = password_hash($pw, PASSWORD_DEFAULT);
        $stmt = $mydb->prepare("INSERT INTO utente (email, pw) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->execute();
        $stmt->close();
    }
}
?>
