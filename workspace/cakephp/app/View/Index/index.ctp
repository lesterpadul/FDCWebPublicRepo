<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Website</title>
    <link rel="shortcut icon" href="https://i.ibb.co/GHctgsk/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <p id="demo"></p>
    <header>
        <div class="wrapper">
            <h2>My <span>Website</span></h2>
        </div>
    </header>
    <hr>
    <nav id="navigation">
        <div class="wrapper">
            <ul>
                <li><a href="/cakephp/home">Home</a></li>
                <li><a href="/cakephp/about-me">About</a></li>
                <li><a href="/cakephp/more-arts">More Arts</a></li>
                <li><a href="/cakephp/contacts">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div id="banner">
        <figure>
            <img src="https://fdc-inc.com/wp-content/uploads/2023/08/Buildings-1.jpg" alt="Building">
        </figure>
        <div class="banner_info">
            <h3><small class="c_orange">Where Creativity </small> Meets Code:<span>Redefining <q class="c_red">with AI</q></span></h3>
            <p>Welcome to AI Art, where art meets artificial intelligence! Explore a new frontier in creativity with our AI-generated artworks, pushing the boundaries of traditional artistry and redefining what's possible in the world of creativity.</p>
            <a href="/cakephp/about-me">About Us</a> <br> <button id="prev1">PREV</button> <button id="next1">NEXT</button>
        </div>
    </div>
    <div id="banner1">
        <figure>
            <img src="./img/banner/HTML_1920x565px.jpg" alt="Building">
        </figure>
        <div class="banner_info">
            <h3><small class="c_orange">Art</small> in the age of AI<span>is not just a reflection of reality <q class="c_red">reality</q></span></h3>
            <p>but a doorway to infinite creativity, where algorithms become the brushstrokes of the mind. It transcends traditional boundaries, blending the precision of technology with the boundless imagination of human expression, creating a new dimension where the possible and the impossible converge.</p>
            <a href="/cakephp/about-me">About Us</a> <br> <button id="prev2">PREV</button> <button id="next2">NEXT</button>
        </div>
    </div>
    <div id="banner2">
        <figure>
            <img src="./img/banner/html5-banners_new-article.png" alt="Building">
        </figure>
        <div class="banner_info">
            <h3><small class="c_orange">In the realm of AI </small> creativity is unchained<span>allowing allowing us to explore <q class="c_red">new horizons</q></span></h3>
            <p>where machines and humans co-create, transforming data into dreams and algorithms into art. Here, every line of code is a brushstroke on the canvas of possibility, painting a future where innovation knows no bounds.</p>
            <a href="/cakephp/about-me">About Us</a> <br> <button id="prev3">PREV</button> <button id="next3">NEXT</button>
        </div>
    </div>
    <div id="Services_con" class="Services" style="background-color: beige;">
        <div class="wrapper">
            <h3 class="t_center">Sample AI Art</h3>
            <div class="service_boxes">
                <section class="t_center">
                    <figure>
                        <img src="./img/amfermy_A_striking_painting_that_visually_represents_the_theme__b7453db2-cb92-4a23-aefc-ed927fa43ab6-1024x574.png" alt="AI Art 1">
                    </figure>
                    <h3>Art1</h3>
                    <p id="sparo"><strong>Artificial Intelligence</strong> (AI) has been making waves across various industries, and the realm of is no exception. With AI technology becoming more sophisticated, it's now capable of creating stunning artworks that rival those produced by human artists. However, this AI art revolution has sparked a debate within the creative community: is AI empowering or endangering the creative industries?</p>
                    <p id="sparoh"><strong>Artificial Intelligence</strong> (AI) has been making waves across various industries, and the realm of is no exception. With AI technology becoming more sophisticated, it's now capable of creating stunning artworks that rival those produced by human artists. However, this AI art revolution has sparked a debate within the creative community: is AI empowering or endangering the creative industries?</p>
                    <p id="spar"></p>
                    <button id="sbtnrm">Read More!</button>
                    <button id="sbtnrms">Read More!</button>
                    <button id="sbtnrl">Read Less!</button>
                </section>
                <section class="t_center">
                    <figure>
                        <img src="./img/download.jpg" alt="AI Art 2">
                    </figure>
                    <h3>Art2</h3>
                    <p id="sparo1"><strong>Exploring the World of AI Art</strong>
                        In recent years, Artificial Intelligence (AI) has been revolutionizing the world of art, offering new possibilities for creativity, expression, and innovation. But what exactly is AI art, and how is it changing the way we think about artistic creation?
                        At its core, AI art refers to artworks created with the assistance of artificial intelligence technology.</p>
                    <p id="spar1"></p>
                    <button id="sbtnrm1">Read more!</button>
                    <button id="sbtnrms1">Read More!</button>
                    <button id="sbtnrl1">Read Less!</button>
                </section>
            </div>
        </div>
    </div>
    <hr>
    <footer id="main_footer" class="t_center" style="color: white;">AI Art Creations © AI Artz - Empowering Creativity through Artificial Intelligence.</footer>
    <div class="social_media">
        <a href="https://www.facebook.com/">
            <figure>
                <img src="https://i.ibb.co/Fq7H9MG/fb-logo.webp" alt="">
            </figure>
        </a>
        <a href="https:/www.instagram.com">
            <figure>
                <img src="https://i.ibb.co/dDsT7F7/insta.png" alt="">
            </figure>
        </a>
        <a href="https://www.linkedin.com/">
            <figure>
                <img src="https://i.ibb.co/pLc4sXN/link-in.png" alt="">
            </figure>
        </a>
    </div>
    <script src="./js/jq.js"></script>
    <script src="./js/show.js"></script>
    <script src="./js/banner.js"></script>
    <script>
        const nodeList = document.querySelectorAll("img");
        alert("total image/s found: "+nodeList.length);
    </script>
</body>
</html>