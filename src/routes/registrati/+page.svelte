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
    width: 100vw; /* Use 100vw to make the main element fill the viewport width */
    height: 100vh; /* Use 100vh to make the main element fill the viewport height */
    margin: 0;
    position: relative; /* Set position to relative for positioning the pseudo-element */
}

main::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;

    background-image: url('image.png'); /* Add the background image */
    background-size: cover; /* Adjust background size to cover the entire element */
    background-position: center; /* Center the background */
    filter: blur(10px); /* Apply the blur filter */
    z-index: -1; /* Move the pseudo-element below the main content */
    width: 110%;
    height: 120%;
    background-size: cover;
    background-position: center;

}

h1 {
    color: #db34bf;
    margin-top: 0; /* Remove default margin */
}

h2 {
    margin: 10px 0;
}

input {
    width: 250px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px; /* Add rounded corners */
    margin-bottom: 10px; /* Add spacing between inputs */
}

.link-btn, .back-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f041e1;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    filter: blur(0px);
    margin-top: 10px; /* Add spacing above the button */
}

.link-btn:hover, .back-btn:hover {
    background-color: #ff00ea;
}


</style>

<main>
    <h1>REGISTRATI</h1>
    <h2><input type="text" bind:value={emailValue} placeholder="Email" id="email" /></h2>
    <h2><input type="text" bind:value={pwValue} placeholder="Password" id="pw" /></h2>
    <button class="link-btn" on:click={sendDataToServer}>Conferma</button>
    <br>
    <a href="stats" class="back-btn">Indietro</a>
</main>

         