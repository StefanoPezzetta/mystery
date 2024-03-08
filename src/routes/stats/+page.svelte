<script>
    import logo from "../../lib/logo.png";
</script>
<body style="background-color: #4B3849;">
    <div class="title">
        <h1>MYSTERY MATCH</h1>
    </div>

    <img class="image" src={logo}> 
    

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
    
    <footer>
        <p>2024 MysteryMatch®  registered trademark
            <br>
            mysterymatch.info@gmail.com</p>
    </footer>
</body>

    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        body footer{
            margin-top: 112px;
            text-align: center;
            

        }
        body footer p{
            color: #F837C9;
        }
        .header-text {
            margin-top: 625px; 
            text-align: center; 
            color: #F837C9;
            text-shadow: none; 
        }

        
        .image{
            height: 358.73px;
            width: 551.42px;
            z-index: 10;
            position: absolute;
        }
        .title h1{
            color: #ff00e6;
            position: absolute;
            font-size: 56px;
            top: 45px; 
            left: 25%; 
            transform: translateX(-50%);
        }
        .btnAccedi {
            position: fixed;
            color: #4B3849;
            top: 50px;
            right: 360px; 
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

       

        .header-text h2{
            margin: 0;
        }

        .header-text h2 {
            font-size: 24px;
        }


    </style>
