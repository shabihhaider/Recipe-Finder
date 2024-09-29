<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

  <main>
      <div class="your-recipe-notes">
        <h2 class="saved-recipe-notes-title">Your Saved Recipes</h2>
        <div class="your-recipe-notes-list">
          <ul>
            <?php if (isset($_SESSION['loggedIn'])) : ?>
              <?php foreach($recipes as $recipe) : ?>
                <li>
                  <a href="/recipe?id=<?= $recipe['id'] ?>" class="text-blue-700 hover:underline"><?= htmlspecialchars($recipe['recipe_title']) ?></a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>

        <?php if (!isset($_SESSION['loggedIn'])) : ?>
          <h2 class="text-blue-500"><?= $error['noUser'] ?></h2>  
        <?php endif; ?>

        <div class="create-button">
          <p id="create-recipe-button"><a href="/recipe/create">Create a Recipe</a></p>
        </div>
      </div>
  </main>

<?php require('partials/footer.php') ?>