<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
       <p>This page is about Saved Recipes.</p>

        <ul>
          <?php foreach($recipes as $recipe) : ?>
            <li>
              <a href="/recipe?id=<?= $recipe['id'] ?>" class="text-blue-700 hover:underline"><?= htmlspecialchars($recipe['recipe_name']) ?></a>
            </li>
          <?php endforeach; ?>
        </ul>

        <p class="mt-5">
          <a href="/recipe/create" class="text-blue-500 hover:underline">Create a Recipe</a>
        </p>

    </div>
  </main>

<?php require('partials/footer.php') ?>