<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

    <header class="section__container header__container" id="home">
      <div class="header__image">
        <img src="assets/images/main.png" alt="header" />
      </div>
      <div class="header__content">
        <?php if (isset($_SESSION['loggedIn'])) : ?>
          <h2>Welcome, <span id="user"><?= $_SESSION['user']['username'] ?>!</span></h2>
        <?php endif; ?>
        <h1>Find, Select, Made & Enjoy The <span>True Taste</span>.</h1>
        <p class="section__description">
          Explore the best and most delicious recipes, easy to make and perfect. So, What are you waiting for? Start now!
        </p>
        <div class="header__btn">
          <a href="/subscription"><button class="btn">Get Started</button></a>
        </div>
      </div>
    </header>

    <section class="section__container explore__container" id="explore">
      <div class="explore__image">
        <img src="assets/images/explore_recipes.png" alt="explore" />
      </div>
      <div class="explore__content">
        <h1 class="section__header">Find your Recipe</h1>
        <p class="section__description">
          Simple to search for recipes by TlashRecipe, easy to make and perfect for any occasion. Explore our collection of recipes and get inspired. And make your own recipe.
        </p>
        <div class="explore__btn">
          <button class="btn">
            <a class="explore" href="/find">Explore Story <span><i class="ri-arrow-right-line"></i></span></a>
          </button>
        </div>
      </div>
    </section>

    <!--- Contact Section --->
    <?php require('partials/contact.php') ?>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo footer__logo">
            <a href="/">Tlash<span>Recipe</span></a>
          </div>
          <p class="section__description">
            TlashRecipe is a platform where you can find the best and most delicious recipes, easy to make and perfect for any occasion. 
          </p>
        </div>
        <div class="footer__col">
          <h4>Product</h4>
          <ul class="footer__links">
            <li><a href="/recipe/create">Create Recipes</a></li>
            <li><a href="/saved">Saved Recipes</a></li>
            <li><a href="/favourites">Favourites</a></li>
            <li><a href="/find">Find Recipes</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Information</h4>
          <ul class="footer__links">
            <li><a href="#">About Us</a></li>
            <li><a href="#contact">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2024 Tlash Recipe. All rights reserved.
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>

<?php require('partials/footer.php') ?>