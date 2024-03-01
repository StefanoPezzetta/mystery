<script>
    import LinkBtn from "../../lib/LinkBtn.svelte";
    import { emailValueStore } from '../../store.js'; 
    import { goto } from '$app/navigation';


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
                emailValueStore.set(emailValue);
                console.log('Dati risultanti:', numRows);
                emailValueStore.set(emailValue);
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
        position:absolute;
        width: 110%;
        height: 120%;
        background-image: url('image.png'); /* Adjust the path to your image */
        background-size: cover;
        background-position: center;
        filter: blur(19px); /* Apply the blur effect to the background image */
    }
    
    .header-text {
        margin-top: 220px;
        position: fixed;
        top: 50px; /* Adjust the top spacing */
        left: 50%;
        transform: translateX(-50%);
        color: #ffffff; /* Text color */
        font-family: Arial, sans-serif; /* Specify a font family for better readability */
        text-align: center; /* Center the text horizontally */
    }
    
    .content {
        position: relative;
        z-index: 1; /* Ensure content stays above the blurred background */
        text-align: center;
    }
    
    input {
        width: 250px;
        padding: 10px;
        border: 1px solid #464646;
        border-radius: 12px;
        margin-bottom: 10px; /* Add spacing between inputs */
    }
    
    button {
        padding: 10px 20px;
        background-color: #f041e1;
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
        background-color: #f041e1;
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
        color: #ff00ea;
    }
    h2{
        margin-top: 0px;
    }
    </style>
    
    <body>
        <div class="background"></div>
        <div class="header-text">
            <h2>ACCEDI</h2>
        </div>
        <div class="content">
            <input type="text" placeholder="Email" bind:value={emailValue} id="email" />
            <br>
            <input type="text" placeholder="Password" bind:value={pwValue} id="pw" />
            <br>
            <button on:click={sendDataToServer}>Conferma</button>
            <br>
            <a href="stats" class="back-btn">Indietro</a>
    
            <p>Non hai un account? Clicca <a href="registrati" class="registrati-link">qui</a> per registrarti gratuitamente.</p>
        </div>
    </body>