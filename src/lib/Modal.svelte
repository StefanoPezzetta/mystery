<script>
    export let showModal; // boolean
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
  
    $: if (dialog && showModal) {
    dialog.showModal();
    onOpenFunction && onOpenFunction(); // Esegui la funzione se definita
  }
  </script>
  
  <!-- svelte-ignore a11y-click-events-have-key-events a11y-no-noninteractive-element-interactions -->
  <dialog
    class="bg-rosso-chiaro rounded-xl text-white"
    bind:this={dialog}
    on:close={() => (showModal = false)}
    on:click|self={() => dialog.close()}
  >
    <!-- svelte-ignore a11y-no-static-element-interactions -->
    <div on:click|stopPropagation>
      <slot name="header" />
      <slot />
      <!-- svelte-ignore a11y-autofocus -->
      <button class="btnClose" autofocus on:click={() => dialog.close()}>Chiudi</button>
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
        background-color: #ff00e6; /* Background color for the dialog */
        color: #000;
        text-align: left;
        font-weight: 600;
        letter-spacing: 0.5px;    }
    dialog[open] {
      animation: zoom 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .btnClose{
        color: #F837C9;
        background-color: #4B3849;
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
    }
  </style>