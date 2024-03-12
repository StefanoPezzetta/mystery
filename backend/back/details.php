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
    
    if ($data !== null) {
        $id = $data["id_utente"];
        $stmt = $mydb->prepare("SELECT altezza, peso, colore_capelli, colore_occhi, sesso FROM caratteristiche where id_utente  = ?");
        $stmt->bind_param("i", $id);        
        if ($stmt->execute()) {
            $stmt->bind_result($altezza, $peso, $colore_capelli, $colore_occhi, $sesso);

            while ($stmt->fetch()) {
                $result[] = [
                    "altezza" => $altezza,
                    "peso" => $peso,
                    "colore_capelli" => $colore_capelli,
                    "colore_occhi" => $colore_occhi,
                    "sesso" => $sesso
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
