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
        $citta = $data["citta"];
        $uomo = $data["uomo"];
        $donna = $data["donna"];
        if($citta!=""){
            if($uomo==false && $donna == true){
                $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE citta = ? and sesso = 'f' and id_utente NOT IN (select id from utente where email = ?)"); 
                $stmt->bind_param("ss", $citta, $email);      
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }

            }else if($uomo==true && $donna == false){
                $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE citta = ? and sesso = 'm' AND id_utente NOT IN (select id from utente where email = ?)"); 
                $stmt->bind_param("ss", $citta, $email);      
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }

            }else{
                $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE citta = ? AND id_utente NOT IN (select id from utente where email = ?)"); 
                $stmt->bind_param("ss", $citta, $email);      
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }
            }
        }else if($uomo==false && $donna == true){
            $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE sesso = 'f' AND id_utente NOT IN (select id from utente where email = ?)"); 
            $stmt->bind_param("s", $email);
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }

        }else if($uomo==true && $donna == false){
            $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE sesso = 'm' AND id_utente NOT IN (select id from utente where email = ?)"); 
            $stmt->bind_param("s", $email);
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }

        }else{
            $stmt = $mydb->prepare("SELECT id_utente, nome, cognome, altezza, peso, colore_capelli, colore_occhi, eta, citta, sesso FROM caratteristiche WHERE id_utente NOT IN (select id from utente where email = ?)"); 
            $stmt->bind_param("s", $email);
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
                }else {
            // Gestione degli errori durante l'esecuzione della query
            $result = [
                "error" => "Errore durante l'esecuzione della query"
            ];
        }
        }
    }
    // Invia la risposta JSON solo dopo il completamento delle operazioni
    echo json_encode($result);
}
?>
