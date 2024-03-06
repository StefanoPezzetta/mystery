<script>
  import LinkBtn from "../../lib/LinkBtn.svelte";
  import { goto } from '$app/navigation';
  import { emailValueStore } from '../../store.js'; 
    let emailValue;
    $: emailValue = $emailValueStore;
    let nomeValue = "";
    let cognomeValue = "";
    let sessoValue = "";
    let etaValue = "";
    let altezzaValue = "";
    let pesoValue = "";
    let coloreCapelliValue = "";
    let coloreOcchiValue = "";
    let cittaValue = "";

  let inputList = [];

  function handleChange(event) {
    sessoValue = event.target.value;
  }

  function aggiungiInput() {
    const nuovoInput = { id: inputList.length + 1, value: "" };
    inputList = [...inputList, nuovoInput];
  }

  function eliminaInput() {
    inputList.pop();
    inputList = [...inputList];
  }
  

async function sendDataToServer(){

    const dataToSend = {
            email: emailValue,
            nome: nomeValue,
            cognome: cognomeValue,
            sesso : sessoValue,
            età: etaValue,
            altezza: altezzaValue,
            peso: pesoValue,
            coloreCapelli: coloreCapelliValue,
            coloreOcchi: coloreOcchiValue,
            città: cittaValue,
    }

    try {
    const response = await fetch('http://localhost/backend/back/caratteristiche.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // Specifica il tipo di contenuto come JSON
            // Altri eventuali header necessari possono essere aggiunti qui
        },
        body: JSON.stringify(dataToSend), // Converte i dati in formato JSON
    });

    // Gestione degli errori HTTP
    if (!response.ok) {
        throw new Error(`Errore durante la richiesta al server. Codice di stato: ${response.status}`);
    }

    // Controllo del tipo di contenuto
    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
        const responseData = await response.json();
        console.log('Dati ricevuti dal server:', responseData);
        // Puoi fare ulteriori operazioni con i dati ricevuti, se necessario
    } else {
        console.error('La risposta non contiene dati JSON');
    }

} catch (error) {
    console.error('Errore nella fetch:', error.message);
}

    goto("../home/");
};


</script>

<main>
  <body>
    <div class="background"></div>
    <div class="content">
    <p3>Informazioni utente:</p3>
    <p></p>
    <input type="text" placeholder="Nome" bind:value={nomeValue} name="nome" id="nome">
    <br>
    <p></p>
    <input type="text" name="cognome" bind:value={cognomeValue} id="cognome" placeholder="Cognome">
    <br>
    <select name="sesso" bind:value={sessoValue} on:change={handleChange} id="sesso">
      <option value="M">Maschio</option>
      <option value="F">Femmina</option>
    </select>
    <br>
    <br>
    <input type="number" name="età" bind:value={etaValue} id ="età" placeholder="Età" min="18">
    <p>Altezza:</p>
    <input type="number" name="altezza" bind:value={altezzaValue} id="altezza" placeholder="cm">
    <p>Peso: </p>
    <input type="number" name="peso" bind:value={pesoValue} id="peso" placeholder="kg">
    <p></p>
    <input type="text" name="capelli" bind:value={coloreCapelliValue} id="capelli" placeholder="Colore dei capelli">
    <p></p>
    <input type="text" name="occhi" bind:value={coloreOcchiValue} id="occhi" placeholder="Colore degli occhi">
    <p>Indirizzo</p>
    <input type="text" name="città" bind:value={cittaValue} id="città" placeholder="Città">
    <br>
    <br>
    <p4>Interessi:</p4>
    
    <button on:click={aggiungiInput}>Aggiungi +</button>
    
    <button on:click={eliminaInput}>Elimina -</button>

    <br>
    {#each inputList as { id, value }}
    <br>
    <input type="text" bind:value={value} key={id} name="interessi" placeholder="..." />
    {/each}
    <br>
    <br>
    <br>
    <button on:click={sendDataToServer}><a href="home">Conferma</a></button>
    <a href='registrati' class='back-btn'>Indietro</a>
  </body>
</main>

<style>
body {
  text-align: center;
  margin: 0;
}


main {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('image.png'); /* Replace 'image.png' with your image path */
  background-size: cover;
  background-position: center;
  filter: blur(7px); /* Apply a 10px blur effect to the background image */
}

.content {
  position: relative; /* Ensure the content stays above the background */

  z-index: 1; /* Ensure that content is displayed above the blurred background */
}

p3 {
  margin: 0px 0;
  color: #ff00ea;
  font-family: Arial, Verdana, sans-serif;
  font-size: x-large;
}

p {
  margin: 10px 0;
}

p4 {
  margin: 0px 0;
  color: #ff00ea;
  font-size: large;
  font-family: Arial, Verdana, sans-serif;
}

input {
  width: 205px;
  padding: 10px;
  border: 1px solid #797979;
  border-radius: 8px; /* Add rounded corners */
  margin-bottom: 10px;
}

button {
  padding: 10px;
  background-color: #ff00ea;
  color: #fff;
  border: none;
  border-radius: 8px; /* Add rounded corners */
  cursor: pointer;
}

button a {
  color: #fff;
  text-decoration: none;
}

a.back-btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #ff00ea;
  color: #fff;
  text-decoration: none;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  margin-top: 10px; /* Add spacing above the button */
}

a.back-btn:hover {
  background-color: #ff00ea;
}

</style>
