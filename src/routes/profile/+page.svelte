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
        <!-- Utilizza la variabile locale come valore del placeholder -->
        <input type="text" name="nome" id="nome" placeholder="{nomePlaceholder}" readonly>
        <br>
        <input type="text" name="cognome" id="cognome"  placeholder="{cognomePlaceholder}" readonly>
        <br>
        <input type="text" name="altezza" id="altezza" bind:value={altezzaPlaceholder} placeholder="{altezzaPlaceholder}">
        <br>
        <input type="text" name="peso" id="peso" bind:value={pesoPlaceholder} placeholder="{pesoPlaceholder}">
        <br>
        <input type="text" name="colore_capelli" id="colore_capelli" bind:value={colore_capelliPlaceholder} placeholder="{colore_capelliPlaceholder}">
        <br>
        <input type="text" name="colore_occhi" id="colore_occhi" placeholder="{colore_occhiPlaceholder}" readonly>
        <br>
        <input type="text" name="eta" id="eta" bind:value={etaPlaceholder} placeholder="{etaPlaceholder}">
        <br>
        <input type="text" name="citta" id="citta" bind:value={cittaPlaceholder} placeholder="{cittaPlaceholder}">
        <br>
        <input type="text" name="sesso" id="sesso" placeholder="{sessoPlaceholder}" readonly>
        <br>
        <button on:click={sendModifiche}>Conferma</button>




        <p>contenuto dello store {emailValue}</p>
    </body>
</main>

