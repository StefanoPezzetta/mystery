<?php
define('DEBUG_MODE', true);
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
        $nome = $data['nome'];
        $cognome = $data['cognome'];
        $sesso = $data['sesso'];
        $età = $data['età'];
        $altezza = $data['altezza'];
        $peso = $data['peso'];
        $coloreCapelli = $data['coloreCapelli'];
        $coloreOcchi = $data['coloreOcchi'];
        $città = $data['città'];

        // Eseguire la query SELECT per ottenere l'ID dell'utente
        $stmt = $mydb->prepare("SELECT id FROM utente WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close(); 
 
        $stmt1 = $mydb->prepare("INSERT INTO caratteristiche (id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("issiississ", $id, $nome, $cognome, $altezza, $peso, $coloreCapelli, $coloreOcchi, $età, $città, $sesso);
        $stmt1->execute();
        $stmt1->close(); 
    }
}
?>

