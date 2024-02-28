<script>
    import LinkBtn from "../../lib/LinkBtn.svelte";
</script>

<style>
    main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 70vh;
        margin: 0;
    }

    h1 {
        color: #ff00ea;
    }

    p {
        font-size: 18px;
        color: #161616;
        margin-bottom: 20px;
    }

</style>    

<main>
    <h1>MYSTERY MATCH</h1>
    <p>Benvenuto sul sito di incontri n° 1 in Italia</p>
    <LinkBtn url='login' name="Login"/>
    <br>
    <LinkBtn url='registrati' name="Registrati"/>
</main>
