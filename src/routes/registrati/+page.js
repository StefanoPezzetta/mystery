/*let emailValue = document.getElementById("email").value;
let pwValue = document.getElementById("pw").value;

const dataToSend = {
    email: emailValue,
    pw: pwValue,
};

const sendDataToServer = async (dataToSend) => {
    try {
        const response = await fetch('http://localhost/back/registrazione.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Specifica il tipo di contenuto come JSON
                // Altri eventuali header necessari possono essere aggiunti qui
            },
            body: JSON.stringify(dataToSend), // Converte i dati in formato JSON
        });

        if (!response.ok) {
            throw new Error('Errore durante la richiesta al server');
        }

        const responseData = await response.json();
        console.log('Dati ricevuti dal server:', responseData);

        // Puoi fare ulteriori operazioni con i dati ricevuti, se necessario

    } catch (error) {
        console.error('Si è verificato un errore:', error.message);
    }
};

sendDataToServer(dataToSend);

*/