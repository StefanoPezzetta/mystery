<script>
     
 
    import { emailValueStore } from '../../store.js';
    import { onMount } from 'svelte'; 
    let emailValue;
    let data;
    let nomePlaceholder;
    let cognomePlaceholder;
    let altezzaPlaceholder;
    let pesoPlaceholder;
    let colore_capelliPlaceholder;
    let colore_occhiPlaceholder;
    let etaPlaceholder;
    let cittaPlaceholder;
    let sessoPlaceholder;

    $: emailValue = $emailValueStore;

    async function sendDataToServer() {
        const dataToSend = {
            email: emailValue,
        }

        try {
            const response = await fetch('http://localhost/backend/back/profilo.php', {
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

                // Assegna il valore al placeholder
                nomePlaceholder = responseData[0]["nome"];
                cognomePlaceholder = responseData[0]["cognome"];
                altezzaPlaceholder = responseData[0]["altezza"];
                pesoPlaceholder = responseData[0]["peso"];
                colore_capelliPlaceholder = responseData[0]["colore_capelli"];
                colore_occhiPlaceholder = responseData[0]["colore_occhi"];
                etaPlaceholder = responseData[0]["eta"];
                cittaPlaceholder = responseData[0]["citta"];
                sessoPlaceholder = responseData[0]["sesso"];



            } else {
                console.error('La risposta non contiene dati JSON');
            }

        } catch (error) {
            console.error('Errore nella fetch:', error.message);
            console.error('Dettagli dell\'errore:', error.message, error.name, error.stack);
        }
    };

    onMount(() => {
        sendDataToServer();
    }); 
    async function sendModifiche() {
        const dataToSend = {
            email: emailValue,
            altezza: altezzaPlaceholder,
            peso: pesoPlaceholder,
            colore_capelli: colore_capelliPlaceholder,
            eta: etaPlaceholder,
            citta: cittaPlaceholder,
        }

        try {
            const response = await fetch('http://localhost/backend/back/modifyProfilo.php', {
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

            } else {
                console.error('La risposta non contiene dati JSON');
            }

        } catch (error) {
            console.error('Errore nella fetch:', error.message);
            console.error('Dettagli dell\'errore:', error.message, error.name, error.stack);
        }
        sendDataToServer();
    }; 
</script>

<main>
    <body>
        <div class="profile-form">
            <h2>Il tuo profilo</h2>
            <input type="text" name="nome" id="nome" placeholder="{nomePlaceholder}" readonly>
            <input type="text" name="cognome" id="cognome" placeholder="{cognomePlaceholder}" readonly>
            <input type="text" name="altezza" id="altezza" bind:value={altezzaPlaceholder} placeholder="Altezza (cm)">
            <input type="text" name="peso" id="peso" bind:value={pesoPlaceholder} placeholder="Peso (kg)">
            <input type="text" name="colore_capelli" id="colore_capelli" bind:value={colore_capelliPlaceholder} placeholder="Colore dei capelli">
            <input type="text" name="colore_occhi" id="colore_occhi" placeholder="{colore_occhiPlaceholder}" readonly>
            <input type="text" name="eta" id="eta" bind:value={etaPlaceholder} placeholder="Età">
            <input type="text" name="citta" id="citta" bind:value={cittaPlaceholder} placeholder="Città">
            <input type="text" name="sesso" id="sesso" placeholder="{sessoPlaceholder}" readonly>
            <button on:click={sendModifiche}>Salva modifiche</button>
            <a href="home" class="btn back-class">Indietro</a>
        </div>
    </body>
</main>


<style>
    /* Stili CSS per il body */
    body {
        font-family: Arial, sans-serif;
        background-color: #582b4d;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Stili CSS per il main */
    main {
        text-align: center;
    }

    /* Stili CSS per il profilo utente */
    .profile-form {
        background-color: #F837C9;
        font-weight: 700;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
        
    }
    .profile-form input{
        background-color: #F837C9;
        border: 1px rgba(248,55,201 0.1);
        

    }
    .profile-form input::placeholder {
        color: #582b4d; /* Colore del placeholder */
        font-style: italic; /* Stile del testo del placeholder (ad esempio, corsivo) */
        font-weight: 500;
    }
    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    input {
        width: calc(100% - 20px);
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        margin-bottom: 20px;
        width: calc(100% - 20px);
        padding: 10px;
        color: #F837C9;
        background-color: #4B3849;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #bb26b3;
    }
    .back-class {
        text-decoration: none  ;
        padding: 8px;
        color: #F837C9;
        background-color: #4B3849;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
}
.back-class:hover{
    background-color: #bb26b3;


}

</style>
