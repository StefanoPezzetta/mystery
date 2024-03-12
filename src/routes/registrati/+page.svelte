<script>
    import { goto } from '$app/navigation';
    import { store } from '../../store.js';


 

    let emailValue = "";
    let pwValue = "";

/* async function sendDataToServer(){

const dataToSend = {
        email: emailValue,
        pw: pwValue,
}

try {
const response = await fetch('http://localhost/backend/back/registrazione.php', {
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

    // Aggiorna lo store solo dopo la conferma
    

} else {
    console.error('La risposta non contiene dati JSON');
}

} catch (error) {
console.error('Errore nella fetch:', error.message);
}

}; */

function saveData(){

    if (emailValue.trim() !== "" && pwValue.trim() !== "") {
        // Esegui l'azione solo se entrambi i campi sono compilati
        // Puoi inserire qui la logica per salvare i dati o navigare verso un'altra pagina
        console.log("Dati salvati:", emailValue, pwValue);
        store.set({
            emailValueStore: emailValue,
            pwValueStore: pwValue
        });
        goto("../info/");
    } else {
        // Altrimenti, mostra un avviso o esegui un'azione appropriata
        console.log("Compila entrambi i campi prima di continuare.");
    }
    
}

</script>

<body>
    <div class="background"></div>
    <div class="header-text">
        <h1>MYSTERY MATCH</h1>
    </div>
    <div class="content">
        <div class="scritta1">
            <h2>Registrati</h2>
        </div>
        <input type="text" placeholder="Email" bind:value={emailValue} id="email" />
        <br>
        <input type="text" placeholder="Password" bind:value={pwValue} id="pw" />
        <br>
        <div class="button-container">
            <a href="stats" class="back-btn">Indietro</a>
            <button on:click={saveData}>Conferma</button>
        </div>
        <p>Hai già un account? Clicca <a href="login" class="login-link">qui</a>.</p>
    </div>
</body>



<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #4B3849;
        position: relative;
    }

    .background {
        background-color: #4B3849;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .header-text {
        position: fixed;
        top: 0%;
        left: 50%;
        transform: translateX(-50%);
        color: #FF00E6;
        text-align: center;
        font-size: 40px;
    }

    .scritta1 {
        margin-top: 20px;
        color: #F837C9;
        font-size: 35px;
    }

    .content {
        position: relative;
        border: 4px solid #FF00E6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        max-width: 500px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.7);
        transition: transform 0.3s ease;
    }

    .content:hover {
        transform: scale(1.05);
    }

    .content p {
        color: #f041e1;
    }

    input {
        color: #fff;
        width: 250px;
        padding: 10px;
        border: 1px solid #464646;
        border-radius: 12px;
        margin-bottom: 10px;
        background-color: #4B3849;
        border-color: #FF00E6;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #ff00ea;
    }

    button {
        padding: 10px 20px;
        background-color: #F837C9;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #ff00ea;
    }
    

    .back-btn {
        margin-top: 10px;
        display: inline-block;
        padding: 8px 25px;
        background-color: #F837C9;
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        cursor: pointer;
    }

    .back-btn:hover {
        background-color: #ff00ea;
    }


    .login-link {
        
        color: #fff;
    }

    .login-link:hover {
        background-color: #ff00ea;
    }

    h1 {
        align-content: center;
        font-family: 'Jacques Francois';
    }


    
</style>




         