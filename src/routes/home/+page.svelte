<script>
    import { onMount } from 'svelte';
    import Modal from "../../lib/Modal.svelte";
    import Modal2 from "../../lib/Modal2.svelte";
    import Modal3 from "../../lib/Modal3.svelte";

    import { emailValueStore } from '../../store.js'; 


    let emailValue;
    $: emailValue = $emailValueStore;
    let showModal = false;
    let showModal2 = false;
    let showModal3 = false;
    let modal3Content = "";
    let modalIndex = null;
    let modalNome = null;
    let modalCognome = null;
    let modalAltezza = null;
    let modalPeso = null;
    let modalColore_capelli = null;
    let modalColore_occhi = null;
    let modalEta = null;
    let modalCitta = null;
    let modalSesso = null;
    let cittaChecked = "";
    let uomoChecked = false;
    let donnaChecked = false;

    function handleCheckboxChange(sex) {
        if (sex === 'uomo') {
            uomoChecked = true;
            donnaChecked = false;
        } else if (sex === 'donna') {
            uomoChecked = false;
            donnaChecked = true;
        }
    }


    let cards = [];
    

    async function sendDataToServer() {
        const dataToSend = {
            email: emailValue,
         };

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

                cards = responseData;
            } else {
                alert("errore");
                console.log('Nessun dato risultante.');
            }
        } catch (error) {
            console.error('Errore nella fetch:', error.message);
        }
    }

    onMount(() => {
        sendDataToServer();
    });
   
    async function dataFiltered() {
        const dataToFilter = {
            email: emailValue,
            citta: cittaChecked,
            uomo: uomoChecked,
            donna: donnaChecked,
        }

        try {
            const response = await fetch('http://localhost/backend/back/filter.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(dataToFilter),
            });

            if (!response.ok) {
                throw new Error(`Errore durante la richiesta al server. Codice di stato: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const responseData = await response.json();
                console.log('Dati ricevuti dal server:', responseData);

                cards = responseData;
            } else {
                alert("errore");
                console.log('Nessun dato risultante.');
            }
        } catch (error) {
            console.error('Errore nella fetch:', error.message);
        }
    }
    function generateRandomContent() {
    const randomNumber = Math.random(); // Genera un numero casuale tra 0 e 1

    if (randomNumber < 0.5) {
      // Scegli una struttura HTML
      return `
        <div class="congratulations-message">
            <h1>Congratulazioni!</h1>
            <p>Hai ricevuto un match!</p>
        </div>
        `;
    } else {
      // Scegli un'altra struttura HTML
      return `
        <div class="sorry-message">
            <h1>Ci spiace!</h1>
            <p>Il match non è stato ricambiato.</p>
        </div>
        `;
    }
  }
  function openModal3() {
    console.log("generahtml");
    modal3Content = generateRandomContent(); // Genera il contenuto HTML dinamico
    showModal3 = true; // Apre il modal3
  }

</script>

<main>
    <h1>MYSTERY MATCH</h1>
    <a href="profile" class="btn">profilo</a>
    <button on:click={() => (showModal = true)}>Apri Popup</button>
    <a href="home" class="btn">home</a>

    <body>
        <Modal bind:showModal >
            <h2 slot="header">Personalizza</h2>
            <div>
              <ul>
                <p>Filtra per:</p>
                    <label for="citta"> Città:</label><br>
                    <input type="text" id="citta" name="citta" bind:value={cittaChecked}><br>
                    <label for="uomo"> Genere</label><br>
                    <input type="checkbox" id="uomo" name="sesso" value="uomo" bind:checked={uomoChecked} on:change={() => handleCheckboxChange('uomo')}>
                    <label for="uomo"> Uomo</label><br>
                    <input type="checkbox" id="donna" name="sesso" value="donna" bind:checked={donnaChecked} on:change={() => handleCheckboxChange('donna')}>
                    <label for="donna"> Donna</label><br>

              </ul>
            </div>
            <button on:click={dataFiltered} class="neu-btn-chiaro mb-3 sm py-2 px-4 rounded-xl">Conferma</button>
        </Modal>
        {#each cards as card, index}
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Card {index + 1}</div>
                    <div class="card-description">
                        <p><strong>Nome:</strong> {card.nome}</p>
                        <p><strong>Cognome:</strong> {card.cognome}</p>
                        <p>Età: {card.eta}</p>
                        <p><strong>Città:</strong> {card.citta}</p>
                    </div>
                    <button on:click={() => (showModal2 = true, modalIndex = index, modalNome = card.nome , modalCognome = card.cognome, modalAltezza = card.altezza, modalPeso = card.peso, modalColore_capelli = card.colore_capelli, modalColore_occhi = card.colore_occhi, modalEta = card.eta, modalCitta = card.citta, modalSesso = card.sesso)}>Apri Popup</button>
                </div>
            </div>
        {/each}
        <Modal2 bind:showModal2 index={modalIndex} nome = {modalNome} cognome = {modalCognome} altezza = {modalAltezza} peso = {modalPeso} colore_capelli = {modalColore_capelli} modalColore_occhi = {modalColore_occhi} eta = {modalEta} citta = {modalCitta} sesso = {modalSesso} >
            <h2 slot="header">Personalizza</h2>
            <div>
              <ul>
                <p>{modalNome}</p>
                <p>{modalCognome}</p>
                <p>{modalAltezza}</p>
                <p>{modalPeso}</p>
                <p>{modalColore_capelli}</p>
                <p>{modalColore_occhi}</p>
                <p>{modalEta}</p>
                <p>{modalSesso}</p>

              </ul>
            </div>
            <button on:click={openModal3} class="neu-btn-chiaro mb-3 sm py-2 px-4 rounded-xl">Conferma</button>
        </Modal2>
        <Modal3 bind:showModal3 >
            <h2 slot="header">Personalizza</h2>
            <div>
              <ul>
                {@html modal3Content}
              </ul>
            </div>
            <button on:click={() => (showModal3 = true)} class="neu-btn-chiaro mb-3 sm py-2 px-4 rounded-xl">Conferma</button>
        </Modal3>
    </body>
</main>

<style>
    /* Stili CSS per la card */
    body {
    font-family: 'Arial', sans-serif;
    background-color: #8e44ad; /* Sfondo viola chiaro */
    color: #fff; /* Testo bianco */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

main {
    text-align: center;
}

h1 {
    color: #fff; /* Testo bianco */
}

.btn {
    /* Aggiungi stili ai tuoi bottoni se necessario */
}

/* Stili CSS per le card */
.card {
    width: 300px;
    border: 1px solid #c419c4; /* Bordo delle card fucsia acceso */
    border-radius: 8px;
    overflow: hidden;
    margin: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    background-color: #e719b4; /* Sfondo delle card fucsia acceso */
    color: #000;
}
.card:hover {
    transform: scale(1.05);
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
    color: #fff; /* Testo bianco */
}

/* Stili CSS per i bottoni */
button {
    background-color: #c325e2;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    margin: 5px; /* Aggiungi margine ai bottoni */
}

button:hover {
    background-color: #2980b9;
}
</style>
