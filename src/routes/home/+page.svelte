<script>
    function openPopup(content) {
                document.getElementById('popupContent').innerText = content;
                document.getElementById('popupOverlay').style.display = 'flex';
            }

            function closePopup() {
                document.getElementById('popupOverlay').style.display = 'none';
            }
            async function sendDataToServer(){

                const dataToSend = {
                        email: emailValue, //metti la variabile che semplicemente dice al server di agire
                        pw: pwValue,
                }

                try {
                const response = await fetch('http://localhost/backend/back/home.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(dataToSend), 
                });

                if (!response.ok) {
                    throw new Error(`Errore durante la richiesta al server. Codice di stato: ${response.status}`);
                }

                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const responseData = await response.json();
                    console.log('Dati ricevuti dal server:', responseData);

                    const result = responseData.result;

                /* if (responseData !== null) {
                    if(numRows==1){
                        emailValueStore.set(emailValue);
                        console.log('Dati risultanti:', numRows);
                        goto("../home/");
                }else{
                            console.log("numero righe:", numRows);
                            alert("nessun utente trovato");
                    } */

                } else {
                    // Nessuna riga restituita
                    // Esegui le azioni desiderate
                    alert("errore");
                    console.log('Nessun dato risultante.');
                }
                    

                } else {
                    console.error('La risposta non contiene dati JSON');
                }

                } catch (error) {
                    console.error('Errore nella fetch:', error.message);
                }

                };
</script>

<main>
<h1>MYSTERY MATCH</h1>
<a href="profilo" class="btn">profilo</a>
<a href="filtra" class="btn">filtra</a>
<a href="home" class="btn">home</a>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>

    <!-- Prima card -->
    <div class="card">
        <div class="card-content">
            <div class="card-title">Card 1</div>
            <div class="card-description">
                <p id="nome"><strong>Nome:</strong> John</p>
                <p id="cognome1"><strong>Cognome:</strong> Doe</p>
                <p id="eta">Età:</p>            </div>
                <p id="citta"><strong>Città:</strong> </p>

            <button onclick="openPopup('Popup 1')">Apri Popup</button>
        </div>
    </div>

 

   
</body>


</main>
<style>
    /* Stili CSS per la card */
        /* Stili CSS per la card */
        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px;
        }

        .card-content {
            padding: 16px;
        }

        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .card-description {
            font-size: 1em;
            color: #555;
        }
</style>