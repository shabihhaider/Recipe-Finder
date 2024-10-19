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
          <button class="btn explore-button">
            <a class="explore" href="/find">Explore Story <span><i class="ri-arrow-right-line"></i></span></a>
          </button>
        </div>
      </div>
    </section>

    <!--- Contact Section --->
    <?php require('partials/contact.php') ?>
    
<?php require('partials/footer.php') ?>