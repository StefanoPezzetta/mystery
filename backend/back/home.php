<?php
// Consentire l'accesso da qualsiasi origine
header("Access-Control-Allow-Origin: *");

// Consenti l'utilizzo di alcune intestazioni specifiche (incluso Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Altri header che potrebbero essere richiesti
header('Content-Type: application/json');

$result = array(); // Array associativo da inviare al frontend

require("config.php"); //parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo json_encode(["error" => "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    
    if ($data !== null) {
        
        $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche");        
        if ($stmt->execute()) {
            $stmt->bind_result($id_utente, $nome, $cognome, $altezza, $peso, $colore_capelli, $colore_occhi, $eta, $citta, $sesso);
            $stmt->fetch();
            $stmt->close();

            $result = [
                "id_utente" => $id_utente,
                "nome" => $nome,
                "cognome" => $cognome,
                "altezza" => $altezza,
                "peso" => $peso,
                "colore_capelli" => $colore_capelli,
                "colore_occhi" => $colore_occhi,
                "eta" => $eta,
                "citta" => $citta,
                "sesso" => $sesso
            ];

        } else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }
    }

    // Invia la risposta JSON solo dopo il completamento delle operazioni
    echo json_encode($result);
}
?>
