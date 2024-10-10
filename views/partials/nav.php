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

        <a href="/">Home</a>
          
        <?php if (isset($_SESSION['user'])) :?>
          <a href="/favourites">Favourites</a>
          <a href="/saved">Saved Recipes</a>
          <a href="/#contact">Contact Us</a>
          <a href="/logout">Logout</a>
        <?php endif; ?>
          
        <?php if (!isset($_SESSION['user'])) :?>
          <a href="/registration">Registration Form</a>
          <a href="/login">LogIn Form</a>
        <?php endif; ?>
          
        <a href="/find">Find Recipes</a>
        <a href="/subscription">Subscription</a>
        
      </ul>
</nav>