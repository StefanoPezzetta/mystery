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
        color: #ff00c8;
    }

    h2 {
        margin: 10px 0;
    }

    input {
        width: 250px;
        padding: 10px;
        border: 1px solid #464646;
        border-radius: 12px;
    }

</style>

<main>
    <h1>ACCEDI</h1>
    <h2><input type="text" placeholder="Email" bind:value={emailValue} id="email" /></h2>
    <h2><input type="text" placeholder="Password" bind:value={pwValue} id="pw" /></h2>
    <br>
    <button on:click={sendDataToServer}>Conferma</button>
    <br>
    <LinkBtn url='stats' name='Indietro'/>

</main>
