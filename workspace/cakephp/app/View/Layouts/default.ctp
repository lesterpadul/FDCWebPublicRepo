
   


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/cakephp/app/webroot/css/styles.css" />
    <link
      rel="shortcut icon"
      href="https://firebasestorage.googleapis.com/v0/b/jikipsoria.appspot.com/o/assets%2Fjiki-animated2-nobg.png?alt=media&token=9996514d-499f-461a-91df-383a29f2d03b"
      type="image/x-icon"
    />
    <title>Jiki's Web</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/cakephp/app/webroot/js/script.js" defer></script>
    <script src="/cakephp/app/webroot/js/shop.js" defer></script>

  </head>
  <body>
    <header>
      <nav>
        <ul
          class="fixed top-0 h-20 w-full flex gap-10 items-center justify-center text-lg"
        >
          <li class="right-auto"><a href="#">Home</a></li>
          <!-- <li><a href="#">About</a></li> -->
          <li><a href="#projects">Projects</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="shop.html">Shop</a></li>
        </ul>
      </nav>
    </header>
    <main>


   
		<!-- content-->
		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>

		<!-- Footer-->
      <!-- <section id="carousel-container" class="h-dvh">
        <h1 class="text-3xl mt-16">Carousel</h1>

        <div id="carousel" class="carousel">
          <div class="slide">
            <img
              src="https://cdn-icons-png.flaticon.com/512/3135/3135731.png"
              alt="Slide 1"
            />
          </div>
          <div class="slide">
            <img
              src="https://cdn-icons-png.flaticon.com/512/2972/2972066.png"
              alt="Slide 2"
            />
          </div>
          <div class="slide">
            <img
              src="https://cdn-icons-png.flaticon.com/512/2400/2400603.png"
              alt="Slide 3"
            />
          </div>
        </div>

        <button id="prevBtn" class="carousel-btn">Previous</button>
        <button id="nextBtn" class="carousel-btn">Next</button> -->

      <!-- <button
          id="prevBtn"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Previous
        </button>
        <button
          id="nextBtn"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Next
        </button> -->
      <!-- </section> -->
    </main>
    <footer id="contact" class="h-24">
      <div class="flex flex-col items-center justify-center h-full">
        <div class="flex gap-4">
          <a href="https://github.com/jkpsoria" target="_blank"
            ><img
              src="https://www.pngarts.com/files/8/Github-Logo-Transparent-Background-PNG.png"
              alt=""
              class="h-5"
          /></a>
        </div>
        <p>Made with love, not with skill.</p>
        <p>© 2024 FDC.Jiki</p>
      </div>
    </footer>
  </body>
</html>
