<?php
// Consentire l'accesso da qualsiasi origine
header("Access-Control-Allow-Origin: *");

// Consenti l'utilizzo di alcune intestazioni specifiche (incluso Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Altri header che potrebbero essere richiesti
header('Content-Type: application/json');

$result = [];
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

        $stmt = $mydb->prepare("SELECT caratteristiche.nome, caratteristiche.cognome, caratteristiche.altezza, caratteristiche.peso, caratteristiche.colore_capelli,
        caratteristiche.colore_occhi, caratteristiche.eta, caratteristiche.citta, caratteristiche.sesso FROM caratteristiche WHERE caratteristiche.id_utente IN (SELECT utente.id from utente where utente.email = (?))");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            $stmt->bind_result($nome, $cognome, $altezza, $peso, $colore_capelli, $colore_occhi, $eta, $citta, $sesso);
            while ($stmt->fetch()) {
                $result[] = [
                    "nome" => $nome,
                    "cognome" => $cognome,
                    "altezza" => $altezza,
                    "peso" => $peso,
                    "colore_capelli" => $colore_capelli,
                    "colore_occhi" => $colore_occhi,
                    "eta" => $eta,
                    "citta" => $citta,
                    "sesso" => $sesso,
                ];
            }
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