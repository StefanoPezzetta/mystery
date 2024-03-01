<?php
// Consentire l'accesso da qualsiasi origine
header("Access-Control-Allow-Origin: *");

// Consenti l'utilizzo di alcune intestazioni specifiche (incluso Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Altri header che potrebbero essere richiesti
header('Content-Type: application/json');

$result = [];
require("config.php"); // Parametri di connessione
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
        $altezza = $data['altezza'];
        $peso = $data['peso'];
        $colore_capelli = $data['colore_capelli'];
        $eta = $data['eta'];
        $citta = $data['citta'];

        $stmt = $mydb->prepare("UPDATE caratteristiche SET altezza = ?, peso = ?, colore_capelli = ?, eta = ?, citta = ? WHERE id_utente IN (SELECT utente.id FROM utente WHERE utente.email = ?)");
        $stmt->bind_param("iisiss", $altezza, $peso, $colore_capelli, $eta, $citta, $email);
        
        if ($stmt->execute()) {
            $result = "modifiche effettuate";
            $stmt->close();
        } else {
            // Gestione degli errori durante l'esecuzione della query
            echo json_encode(["error" => "Errore durante l'esecuzione della query"]);
            exit();
        }
    }

    // Invia la risposta JSON solo dopo il completamento delle operazioni
    echo json_encode($result);
}
?>
