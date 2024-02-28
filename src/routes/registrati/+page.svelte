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

<style>
    main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 70vh;
        margin: 0;
        background-color: rgb(175, 175, 175);
    }

    h1 {
        color: #db34bf;
    }

    h2 {
        margin: 10px 0;
    }

    input {
        width: 250px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px; /* Add rounded corners */
    }
    
</style>

<main>
    <h1>REGISTRATI</h1>
    <h2><input type="text" bind:value={emailValue} placeholder="Email" id="email" /></h2>
    <h2><input type="text" bind:value={pwValue} placeholder="Password" id="pw" /></h2>
    <button on:click={sendDataToServer}>Conferma</button>
    <br>
    <LinkBtn url="stats" name="Indietro"/>
    <p>Contenuto dello store: {$emailValueStore}</p>

    
</main>
         