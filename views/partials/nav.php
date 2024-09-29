<nav>
      <div class="nav__header">
        <div class="logo nav__logo">
          <a href="/">Tlash<span>Recipe</span></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">  
        <li>
          <a href="#home">Home</a>
        </li>
        <li>
          <?php if (isset($_SESSION['user'])) :?>
            <a href="/favourites">Favourites</a>
          <?php endif; ?>
        </li>
          <?php if (!isset($_SESSION['user'])) :?>
            <a href="/registration">Registration Form</a>
          <?php endif; ?>

          <?php if (!isset($_SESSION['user'])) :?>
            <a href="/login">LogIn Form</a>
          <?php endif; ?>
        <li>
          <a href="/saved">Saved Recipes</a>
        </li>
        <li>
          <a href="/find">Find Recipes</a>
        </li>
        <li>
          <a href="/subscription">Subscription</a>
        </li>
        <li>
          <a href="/#contact">Contact Us</a>
        </li>
        <li>
          <?php if (isset($_SESSION['user'])) :?>
            <a href="/logout">Logout</a>
          <?php endif; ?>
        </li>
      </ul>
</nav>