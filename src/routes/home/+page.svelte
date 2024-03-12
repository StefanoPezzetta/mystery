<script>
    import { onMount } from 'svelte';
    import Modal from "../../lib/Modal.svelte";
    import Modal2 from "../../lib/Modal2.svelte";
    import Modal3 from "../../lib/Modal3.svelte";

    import { store } from '../../store.js'; 


    let emailValue;
    $: emailValue = $store.emailValueStore;
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
    let altezzaValue = null;
    let pesoValue = null;
    let colore_capelliValue = null;
    let colore_occhiValue = null;
    let sessoValue = null;




    /* function handleCheckboxChange(sex) {
        if (sex === 'uomo') {
      uomoChecked = !uomoChecked;
    } else if (sex === 'donna') {
      donnaChecked = !donnaChecked;
    }
  } */



    let cards = [];
    

    async function reciveDataFromServer() {
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

    async function reciveCaratteristicheFromServer(id_utente) {
        const dataToSend = {
            id_utente: id_utente,
         };

        try {
            const response = await fetch('http://localhost/backend/back/details.php', {
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
                const responseData1 = await response.json();
                console.log('Dati ricevuti dal server:', responseData1);
                altezzaValue = responseData1[0].altezza;
                pesoValue = responseData1[0].peso;
                colore_capelliValue = responseData1[0].colore_capelli;
                colore_occhiValue = responseData1[0].colore_occhi;
                sessoValue = responseData1[0].sesso;

                console.log('Valori assegnati:', altezzaValue, pesoValue, colore_capelliValue, colore_occhiValue, sessoValue);

            } else {
                alert("errore");
                console.log('Nessun dato risultante.');
            }
        } catch (error) {
            console.error('Errore nella fetch:', error.message);
        }
    }

    onMount(async () => {
        await reciveDataFromServer();
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
    modal3Content = generateRandomContent();
    showModal3 = true; 
  }
  function deleteStoreData(){
    store.set({
        emailValueStore: "",
        pwValueStore: ""
    });  }

</script>

<main>
    <h1>MYSTERY MATCH</h1>
    <div class= "string">
        <div class= "btnContainer">
            <a href="profile" class="btn">Profilo</a>
            <button on:click={() => (showModal = true)} class="btn">Filtri</button>

            <a href="login" class="btn" on:click={deleteStoreData}>Logout</a>

        </div>
        
    </div>
    
    <body>
<!--         filtraggio
 -->       <Modal bind:showModal>
            <div class="modal-content">
                <form>
                    <div class="form-group">
                        <label for="citta">Città:</label>
                        <input type="text" id="citta" name="citta" bind:value={cittaChecked}>
                    </div>
                    <div class="form-group">
                        <label>
                            Genere:
                            <div>
                                <input type="checkbox" id="uomo" name="sesso" value="uomo" bind:checked={uomoChecked}>
                                <label for="uomo">Uomo</label>
                            </div>
                            <div>
                                <input type="checkbox" id="donna" name="sesso" value="donna" bind:checked={donnaChecked}>
                                <label for="donna">Donna</label>
                            </div>
                        </label>
                    </div>
                    
                    <button class = "btnConfirm" on:click={dataFiltered} >Conferma</button>
                </form>
            </div>
        </Modal>
        {#each cards as card, index}
        <div class="card">
            <div class="card-content">
              <div class="card-description">
<!--                 <img class = "image" src={image} alt="image">
 -->                    <p><strong>Nome:</strong> {card.nome}
                        <br>
                    <strong>Cognome:</strong> {card.cognome}
                    <br>
                    <strong>Età:</strong> {card.eta}
                    <br>
                    <strong>Città:</strong> {card.citta}</p>
                </div>
                <button class="detail" on:click={async () => {
                    try {
                        await reciveCaratteristicheFromServer(card.id_utente);
                        showModal2 = true;
                        modalIndex = index;
                        modalNome = card.nome;
                        modalCognome = card.cognome;
                        modalAltezza = altezzaValue;
                        modalPeso = pesoValue;
                        modalColore_capelli = colore_capelliValue;
                        modalColore_occhi = colore_occhiValue;
                        modalEta = card.eta;
                        modalSesso = sessoValue;
                        modalCitta = card.citta;
                    } catch (error) {
                        console.error('Errore durante la ricezione delle caratteristiche:', error);
                    }
                }}>DETTAGLI</button>   
             </div>
        </div>
        <br>
        <br>
        <br>
        {/each}

        <!-- Caratteristiche -->
        <Modal2 bind:showModal2 index={modalIndex} nome={modalNome} cognome={modalCognome} altezza = {modalAltezza} peso = {modalPeso} colore_capelli = {modalColore_capelli} colore_occhi = {modalColore_occhi} eta={modalEta} sesso = {modalSesso} citta={modalCitta}>
            <div>
                <ul>
                    <p>Nome: {modalNome}</p>
                    <p>Cognome: {modalCognome}</p>
                    <p>Altezza: {modalAltezza}</p>
                    <p>Peso: {modalPeso}</p>
                    <p>Colore capelli: {modalColore_capelli}</p>
                    <p>Colore occhi: {modalColore_occhi}</p>
                    <p>Età: {modalEta}</p>
                    <p>Genere: {modalSesso}</p>
                    <p>Città: {modalCitta}</p>
                </ul>
            </div>
            <button on:click={openModal3} class="btnMatch">Match</button>
        </Modal2>
        <Modal3 bind:showModal3>
            <div>
                <ul>{@html modal3Content}</ul>
            </div>
<!--             <button on:click={() => (showModal3 = true)} class="neu-btn-chiaro mb-3 sm py-2 px-4 rounded-xl">Conferma</button>
 -->        </Modal3>
    </body>
</main>

<style>
    body {

        font-family: 'Arial', sans-serif;
        background-color: #4B3849;
        color: #fff;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        display: flex;
    }

    main {
        margin-top: 120px;
        text-align: center;
    }
    .btnContainer{
        margin-left: 690px;
    }
    .string{
        display: flex;
        align-items: center;
        z-index: 1000;
        width: 1919px;
        height: 60px;
        background-color: #c711b53a;
    }

    h1 {
        color: #ff00e6;
        font-size: 60px;
        font-family: 'Jacques Francois';
        padding: 0%;
        border: 0;
        margin: 0;
        

        
    }

    .btn {
        background-color: #ff00ea;
        color: #4B3849;
        font-weight: 700;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        margin: 5px;
        text-decoration: none;
    }
    .btn:hover {
        background-color: #b9299a;
        background-image: url('image.png');

    }
    .btn {
        background-color: #e100ff;
        color: #4B3849;
        font-weight: 700;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin: 5px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #bb26b3;
    }
    .modal-content {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="checkbox"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="checkbox"] + label {
        margin-left: 5px;
    }

    .btnConfirm {
        color: #F837C9;
        background-color: #4B3849;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btnMatch{
        color: #F837C9;
        background-color: #4B3849;
    }
.card {
        background-color: #F837C9;
        border-radius: 10px; 
        padding: 20px; 
        margin: 10px; 
        width: 500px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }
    .card .card-content .card-description{
        color: #4B3849;
        font-weight: 700;
    }
    .detail{
        font-family: 'Jacques Francois';
        color: #F837C9;
        background-color: #4B3849;
        letter-spacing: 1px;
        height: 45px;
        width: 90px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .image{
        width: 40px;
        height: 40px;
    }

</style>
