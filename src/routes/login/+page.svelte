<script>
    import LinkBtn from "../../lib/LinkBtn.svelte";
    import { store } from '../../store.js'; 
    import { goto } from '$app/navigation';
    import logo from "../../lib/logo.png";


    let emailValue = "";
    let pwValue = "";

    async function sendDataToServer(){

        const dataToSend = {
                email: emailValue,
                pw: pwValue,
        }

        try {
        const response = await fetch('http://localhost/backend/back/login.php', {
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

            const numRows = responseData.num_rows;

        if (responseData !== null) {
            if(numRows==1){
                console.log('Dati risultanti:', numRows);
                store.set({
                    emailValueStore: emailValue,
                    pwValueStore: pwValue
                });
            goto("../home/");
           }else{
                    console.log("numero righe:", numRows);
                    alert("nessun utente trovato");
            }

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

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .background {
        background-color: #4B3849;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Posiziona dietro il contenuto */
    }
    
    .header-text {
    position: fixed;
    top: 0%;
left: 50%;
    transform: translateX(-50%);
    color: #FF00E6; /* Text color */
    text-align: center; /* Center the text horizontally */
    font-size: 40px;
}
    .scritta1{
        margin-top: 20px;
        color: #F837C9; 
        font-size: 35px;
    }
    
    .content {
        position: relative;
        border: 4px solid #FF00E6; /* Rendi il bordo più spesso */
        border-radius: 12px; /* Aggiunge bordi arrotondati */
        padding: 20px; /* Aggiunge spazio interno al contenitore */
        text-align: center;
        max-width: 500px; /* Imposta una larghezza massima per il contenitore */
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.7); /* Ombra uniforme su tutti i lati */
        transition: transform 0.3s ease; /* Aggiungi transizione al cambio di scala */
    }
    
    .content:hover {
        transform: scale(1.05); /* Effetto di ingrandimento al passaggio del mouse */
    }
    
    .content p{
        color: #f041e1;
    }

    
    input {
        color: #fff;
        width: 250px;
        padding: 10px;
        border: 1px solid #464646;
        border-radius: 12px;
        margin-bottom: 10px; /* Add spacing between inputs */
        background-color: #4B3849;
        border-color: #FF00E6;
        transition: border-color 0.3s ease; /* Aggiungi transizione al cambio di colore del bordo */
    }
    
    input:focus {
        border-color: #ff00ea; /* Cambia colore del bordo quando l'input ottiene il focus */
    }
    
    button {
        padding: 10px 20px;
        background-color: #ff00ea;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 10px; /* Add spacing above the button */
    }
    
    button:hover {
        background-color: #ff00ea;
    }
    
    .back-btn {
        margin-top: 10px;
        display: inline-block;
        padding: 8px 25px;
        background-color: #ff00ea;
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        cursor: pointer;
    }
    
    .back-btn:hover {
        background-color: #ff00ea;
    }
    
    .registrati-link {
        color: #fff;
        text-decoration: underline;
    }
    
    .registrati-link:hover {
        background-color: #ff00ea;
    }
    h1{
        align-content: center;
        font-family: 'Jacques Francois'
    }






</style>

<body>
    <div class="background"></div>
    <div class="header-text">
        <h1>MYSTERY MATCH</h1>
    </div>
    <div class="content">
        <div class="scritta1">
            <h2>Accedi</h2>
        </div>
        <input type="text" placeholder="Email" bind:value={emailValue} id="email" />
        <br>
        <input type="text" placeholder="Password" bind:value={pwValue} id="pw" />
        <br>
        <div class="button-container">
            <a href="stats" class="back-btn">Indietro</a>
            <button on:click={sendDataToServer}>Conferma</button>
        </div>
        
        
        <p>Non hai un account? Clicca <a href="registrati" class="registrati-link">qui</a> per registrarti gratuitamente.</p>
    </div>
</body>
