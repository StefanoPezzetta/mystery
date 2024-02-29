<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$result = array();

require("config.php");

$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo json_encode(["error" => "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    
    if ($data !== null && $data["inviaDati"] == 1) {
        $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche");        
        if ($stmt->execute()) {
            $stmt->bind_result($id_utente, $nome, $cognome, $altezza, $peso, $colore_capelli, $colore_occhi, $eta, $citta, $sesso);

            while ($stmt->fetch()) {
                $result[] = [
                    "id_utente" => $id_utente,
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
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }
    }

    // Invia la risposta JSON solo dopo il completamento delle operazioni
    echo json_encode($result);
}
?>
