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
        $email = $data["email"];
        $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, eta, citta FROM caratteristiche where id_utente NOT IN (select id from utente where email = ?)");
        $stmt->bind_param("s", $email);        
        if ($stmt->execute()) {
            $stmt->bind_result($id_utente, $nome, $cognome, $eta, $citta);

            while ($stmt->fetch()) {
                $result[] = [
                    "id_utente" => $id_utente,
                    "nome" => $nome,
                    "cognome" => $cognome,
                    "eta" => $eta,
                    "citta" => $citta,
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
