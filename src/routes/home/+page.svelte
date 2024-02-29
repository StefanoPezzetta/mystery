<script>
    import { onMount } from 'svelte';
    import Modal from "../../lib/Modal.svelte";

    let showModal = false;
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


    let inviaDati = 0;
    let cards = [];

    async function sendDataToServer() {
        inviaDati = 1;
        const dataToSend = { inviaDati };

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

</script>

<main>
    <h1>MYSTERY MATCH</h1>
    <a href="profile" class="btn">profilo</a>
    <a href="filtra" class="btn">filtra</a>
    <a href="home" class="btn">home</a>

    <body>
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
                    <button on:click={() => (showModal = true, modalIndex = index, modalNome = card.nome , modalCognome = card.cognome, modalAltezza = card.altezza, modalPeso = card.peso, modalColore_capelli = card.colore_capelli, modalColore_occhi = card.colore_occhi, modalEta = card.eta, modalCitta = card.citta, modalSesso = card.sesso)}>Apri Popup</button>
                </div>
            </div>
        {/each}
        <Modal bind:showModal index={modalIndex} nome = {modalNome} cognome = {modalCognome} altezza = {modalAltezza} peso = {modalPeso} colore_capelli = {modalColore_capelli} modalColore_occhi = {modalColore_occhi} eta = {modalEta} citta = {modalCitta} sesso = {modalSesso} >
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
            <button class="neu-btn-chiaro mb-3 sm py-2 px-4 rounded-xl">Conferma</button>
        </Modal>
    </body>
</main>

<style>
    /* Stili CSS per la card */
    .card {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
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
        color: #555;
    }

    button {
        background-color: #3498db;
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: #2980b9;
    }
</style>
