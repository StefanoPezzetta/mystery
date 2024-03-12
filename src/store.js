// store.js
import { writable } from 'svelte/store';

// Crea uno store per le variabili di sessione
export const store = writable(
    {
        emailValueStore: "",
        pwValueStore: "",
    }
);
