<body>
    <div class="background"></div>
    <div class="header-text">
        <h2>Appuntamento al buio?</h2>
        <h3>Trova la tua anima gemella</h3>
        <p>DIVERTIMENTO ASSICURATO</p>
    </div>
    <div class="content">
        <h1>MYSTERY MATCH</h1>
        <p>Benvenuto sul sito di incontri n° 1 in Italia</p>
        <a href="login" class="back-btn">Login</a>
        <br>
        <a href="registrati" class="link-btn">Registrati</a>
    </div>
</body>

<style>
body {
    margin: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden; /* Prevent content from overflowing blurred background */
}

.background {
    position:absolute;
    width: 110%;
    height: 120%;
    background-image: url('image.png'); /* Adjust the path to your image */
    background-size: cover;
    background-position: center;
    filter: blur(19px); /* Apply the blur effect to the background image */
}

.content {
    position: relative;
    z-index: 1; /* Ensure content stays above the blurred background */
    text-align: center;
}

h1, p {
    margin: 0 0 10px; /* Adjust spacing */
    color: #fff; /* Text color */
    font-family: Arial, sans-serif; /* Specify a font family for better readability */
    text-shadow: 6px 6px 6px black; /* Add text shadow for outline effect */
}

.back-btn, .link-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f041e1;
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
    top: 50px; /* Adjust the top spacing */
    left: 50%;
    transform: translateX(-50%);
    color: #fff; /* Text color */
    font-family: Arial, sans-serif; /* Specify a font family for better readability */
    text-align: center; /* Center the text horizontally */
    text-shadow: 2px 2px 2px black; /* Add text shadow for outline effect */
}

.header-text h2, .header-text h3 {
    margin: 0; /* Remove default margins */
}

.header-text h2 {
    font-size: 24px; /* Adjust font size */
}

.header-text h3 {
    font-size: 20px; /* Adjust font size */
}

.header-text p {
    font-size: 20px; /* Adjust font size */
    margin-top: 50px;
}

</style>