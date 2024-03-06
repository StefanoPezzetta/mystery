<script>
    import logo from "../../lib/logo.jpg";
</script>
<body style="background-color: #4B3849;">
    <div class="title">
        <h1>MYSTERY MATCH</h1>
    </div>

    <div class="image">
        <img src={logo}>
    </div>
    
    <div class="header-text">
        <h2>Appuntamento al buio?</h2>
        <h2>Trova la tua anima gemella</h2>
        <h2>DIVERTIMENTO ASSICURATO</h2>
    </div>
    <div class="btnAccedi">
        <a href="login" class="back-btn"><strong>Accedi</a>
    </div>
    <div class="btnRegistra">
        <a href="registrati" class="link-btn"><strong>Iscriviti gratuitamente</a>
    </div>
    <div class="marchio">
        <p>2024 MysteryMatch®  registered trademark
            <br>
            mysterymatch.info@gmail.com</p>
    </div>
    

    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .marchio {
            margin-top: 250px; /* Puoi regolare la distanza dal top a tuo piacimento */
            text-align: center; /* Centra il testo orizzontalmente */
        }

        .marchio p {
            color: #F837C9;
            text-shadow: none; 
        }
        .image{
            margin-top: 220px;
        }
        .title h1{
            color: #ff00e6;
            position: absolute;
            font-size: 56px;
            top: 45px; /* Regola la distanza dal top */
            left: 25%; /* Posiziona al centro orizzontalmente */
            transform: translateX(-50%);
        }
        .btnAccedi {
            position: fixed;
            color: #4B3849;
            top: 50px; /* Regola la distanza dal top */
            right: 360px; /* Regola la distanza dal right */
            text-align: center;
        }

        .btnAccedi a {
            display: inline-block;
            padding: 15px 25px;
            background-color: #F837C9;
            color: #000;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .btnAccedi a:hover {
            background-color: #ff00ea;
        }
        .btnRegistra {
            position: fixed;
            color: #4B3849;
            top: 720px; 
            text-align: center;
        }

        .btnRegistra a {
            display: inline-block;
            padding: 15px 25px;
            background-color: #F837C9;
            color: #000;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .btnRegistra a:hover {
            background-color: #ff00ea;
        }
        .content a{
            color: #4B3849;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        h1, p {
            margin: 0 0 10px;
            color: #fff;
            font-family: Arial, sans-serif;
            text-shadow: 6px 6px 6px black;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #F837C9;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 5%;
        }
        .link-btn{
            display: inline-block;
            padding: 10px 20px;
            background-color: #F837C9;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 5%;
        }

        .back-btn:hover, .link-btn:hover {
            background-color: #ff00ea;
        }

        .header-text {
            position: fixed;
            top: 600px;
            left: 50%;
            transform: translateX(-50%);
            color: #F837C9;
            font-family: Arial, sans-serif;
            text-align: center;
            text-shadow: 2px 2px 2px black;
        }

        .header-text h2, .header-text h3 {
            margin: 0;
        }

        .header-text h2 {
            font-size: 24px;
        }

        .header-text h3 {
            font-size: 20px;
        }

        .header-text p {
            font-size: 20px;
            margin-top: 50px;
        }
    </style>
</body>
