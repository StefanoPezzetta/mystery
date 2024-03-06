<script>
    export let showModal2; // boolean
    export let index;
    export let nome;
    export let cognome;
    export let altezza;
    export let peso;
    export let colore_capelli;
    export let modalColore_occhi;
    export let eta;
    export let citta;
    export let sesso;

    export let onOpenFunction;
  
    let dialog; // HTMLDialogElement
  
    $: if (dialog && showModal2) {
    dialog.showModal();
    onOpenFunction && onOpenFunction(); // Esegui la funzione se definita
  }
  </script>
  
  <!-- svelte-ignore a11y-click-events-have-key-events a11y-no-noninteractive-element-interactions -->
  <dialog
    class="bg-rosso-chiaro rounded-xl text-white"
    bind:this={dialog}
    on:close={() => (showModal2 = false)}
    on:click|self={() => dialog.close()}
  >
    <!-- svelte-ignore a11y-no-static-element-interactions -->
    <div on:click|stopPropagation>
      <slot name="header" />
      <hr />
      <slot />
      <hr />
      <!-- svelte-ignore a11y-autofocus -->
      <button autofocus on:click={() => dialog.close()}>Chiudi</button>
    </div>
  </dialog>
  
  <style>
    dialog {
        max-width: 32em;
        border: none;
        padding: 0;
    }

    dialog::backdrop {
        background: rgba(0, 0, 0, 0.3);
    }

    dialog > div {
        padding: 1em;
        background-color: #e100ff; /* Background color for the dialog */
        border-radius: 10px; /* Optional: Add border-radius for rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Optional: Add box-shadow for a subtle elevation effect */
    }

    dialog[open] {
        animation: zoom 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes zoom {
        from {
            transform: scale(0.95);
        }
        to {
            transform: scale(1);
        }
    }

    dialog[open]::backdrop {
        animation: fade 0.2s ease-out;
    }

    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    button {
        display: block;
        background-color: #bb26b3; /* Slightly darker color for the button */
        color: #fff; /* Text color for the button */
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px; /* Optional: Add margin to separate the button from the content */
    }

    button:hover {
        background-color: #a520a8; /* Darker color on hover */
    }
  </style>