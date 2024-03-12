<script>
    import LinkBtn from "../../lib/LinkBtn.svelte";
    import { goto } from '$app/navigation';
    import { store } from '../../store.js'; 
      $: emailValue = $store.emailValueStore;
      $: pwValue = $store.pwValueStore;
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
              pw: pwValue,
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
  }

      goto("../home/");
  };


</script>

<main>
  <body>
    <div class="title">
      <h1>MYSTERY MATCH</h1>
    </div>
    <div class="background"></div>
    <div class="content">
    <p3>Crea un account gratuitamente</p3>
    <p>Qual è il tuo nome?</p>
    <input type="text" placeholder="Scrivi qui..." bind:value={nomeValue} name="nome" id="nome">
    <br>
    <p>Qual è il tuo cognome?</p>

    <input type="text" name="cognome" bind:value={cognomeValue} id="cognome" placeholder="Scrivi qui...">
    <br>
    <p>In cosa ti identifichi?</p>
    <div class="custom-select">
      <select name="sesso" bind:value={sessoValue} on:change={handleChange} id="sesso">
        <option value="M">Maschio</option>
        <option value="F">Femmina</option>
      </select>
    </div>
    
    <br>
    <br>
    <p>Quanti anni hai?</p>

    <input type="number" name="età" bind:value={etaValue} id ="età" placeholder="Scrivi qui..." min="18">
    <p>Qual è la tua altezza?</p>
    <input type="number" name="altezza" bind:value={altezzaValue} id="altezza" placeholder="Scrivi qui...">
    <p>Quanto pesi?</p>
    <input type="number" name="peso" bind:value={pesoValue} id="peso" placeholder="Scrivi qui...">
    <p>Qual'è il colore dei tuoi capelli?</p>
    <input type="text" name="capelli" bind:value={coloreCapelliValue} id="capelli" placeholder="Scrivi qui...">
    <p>Qual'è il colore dei tuoi occhi?</p>
    <input type="text" name="occhi" bind:value={coloreOcchiValue} id="occhi" placeholder="Scrivi qui...">
    <p>Qual è la tua città di residenza?</p>
    <input type="text" name="città" bind:value={cittaValue} id="città" placeholder="Scrivi qui...">
    <br>
    <br>
    <p>Quali sono i tuoi interessi? Parlaci di te.</p>
    
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
    <a href='registrati' class='back-btn'>Indietro</a>
    <button on:click={sendDataToServer}><a href="home">Crea account</a></button>
    
  </body>
</main>

<style>
body {
  background-color: #503c4c;
  text-align: center;
  margin: 0;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

::placeholder {
  color: #ff00ea;
}




p, p3 {
  margin: 10px 0;
  color: #ff00ea;
}


input {
  width: 205px;
  padding: 10px;
  border: 1px solid #949494;
  border-radius: 10px;
  margin-bottom: 10px;
  background-color: #503c4c;

}


.title h1 {
  margin-top: 120px;
  color: #ff00e6;
  position: relative;
  font-size: 56px;
  top: 50%; /* Imposta la posizione al centro verticale */
  left: 50%; /* Imposta la posizione al centro orizzontale */
  transform: translate(-50%, -50%); /* Centra il titolo in modo preciso */
  margin-bottom: 50px; /* Aggiungi spazio sotto il titolo */
}

button, a {
  padding: 10px;
  background-color: #ff00ea;
  color: #fff;
  border: none;
  cursor: pointer;
  text-decoration: none;
  margin-right: 5px;
  border-radius: 20px;

}


a.back-btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #ff00ea;
  color: #fff;
  text-decoration: none;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  margin-top: 10px;
}

a.back-btn:hover {
  background-color: #ff00ea;
}
button:hover {
  background-color: #e600b4;
}

a.back-btn:hover {
  background-color: #e600b4;
}
.custom-select {
    width: 250px;
    margin-bottom: 10px;
  }

  .custom-select select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-family: 'Arial', sans-serif;
    color: #fff;
    border: 1px solid #949494;
    border-radius: 10px;
    background-color: #503c4c;
    cursor: pointer;
    outline: none;
  }

  .custom-select select:hover {
    background-color: #574357;
  }

  .custom-select select:focus {
    border-color: #ff00ea;
  }

 


</style>
