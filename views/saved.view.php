<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
       <p>This page is about Saved Recipes.</p>

        <?php foreach($recipes as $recipe) : ?>
          <li>
            <a href="/recipe?id=<?= $recipe['id'] ?>" class="text-blue-700 hover:underline"><?= $recipe['recipe_name'] ?></a>
          </li>
        <?php endforeach; ?>

    </div>
  </main>

<?php require('partials/footer.php') ?>