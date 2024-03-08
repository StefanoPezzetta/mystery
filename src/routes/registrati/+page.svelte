<script>
    import LinkBtn from "../../lib/LinkBtn.svelte";
    import { goto } from '$app/navigation';
    import { emailValueStore } from '../../store.js'; 

 
    
    let emailValue = "";
    let pwValue = "";

async function sendDataToServer(){

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
    emailValueStore.set(emailValue);
    goto("../info/");
};

</script>

<body>
    <div class="title">
        <h1>MYSTERY MATCH</h1>
    </div>
    <h1>Crea un account gratuitamente</h1>
    <br>
    <p>Inserisci la tua email:</p>
    <h2><input type="text" bind:value={emailValue} placeholder="Scrivi qui..." id="email" /></h2>
    <p1>Dovrai confermare questa Email più tardi.</p1>
    <p>Inserisci la tua password:</p>
    <h2><input type="text" bind:value={pwValue} placeholder="Scrivi qui..." id="pw" /></h2>
    <a href="stats" class="back-btn">Indietro</a>
    <br>
    <button class="link-btn" on:click={sendDataToServer}>Avanti</button>
    <br>
    
</body>

<style>
body {
    margin-top: 1px;
    background-color: #503c4c;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100vw; 
    height: 100vh; 
    margin: 0;
    position: relative;
}

.title h1{
    margin-top: 1px;


            color: #ff00e6;
            position: absolute;
            font-size: 56px;
            top: 45px;
            transform: translateX(-50%);
        }



h2 {
    margin: 10px 0;
    color: #ff00e6;
    margin-top:1px;
}

p {
    font-size: 25px;
    margin: 10px 0;
    color: #ff00e6;
    margin-top:1px;

}
p1 {
    margin: 10px 0;
    font-size: 14px;
    color: #ff00e6;
    margin-top:1px;
    margin-right: 1%;
}
h1 {
    margin: 10px 0;
    color: #ff00e6;
    margin-top: 1px;
    font-family: 'Jacques Francois'

}
input {
    margin-top: 1px;
    width: 250px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px; /* Add rounded corners */
    margin-bottom: 10px; /* Add spacing between inputs */
    background-color: #503c4c;
    border-color: #FF00E6;

}

.link-btn, .back-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f041e1;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 18px;
    cursor: pointer;
}

.link-btn:hover, .back-btn:hover {
    background-color: #ff00ea;
    transition: background-color 0.3s ease;

}

</style>



         