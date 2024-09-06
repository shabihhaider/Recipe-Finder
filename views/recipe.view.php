<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
       <p class="text-blue-500 underline">
        <a href="/saved">go back...</a>
       </p>
       
      <p class="mt-5">
        <?= $recipe['recipe_name'] ?>
      </p>

    </div>
  </main>

<?php require('partials/footer.php') ?>