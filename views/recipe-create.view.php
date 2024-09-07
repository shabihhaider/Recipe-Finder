<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
      <!-- action="" => where should the post request go (define the path where you want to access the POST request)-->
      <form method="POST">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">

              <div class="col-span-full">
                <label for="recipe" class="block text-sm font-medium leading-6 text-gray-900">Recipe Name</label>
                <div class="mt-2">
                  <textarea id="recipe" name="recipe" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= isset($_POST['recipe']) ? $_POST['recipe'] : '' ?></textarea>
                  
                  <?php if (isset($errors['recipe'])) : ?>
                    <p class="text-red-500 text-xs mt-2"><?= $errors['recipe'] ?></p>
                  <?php endif; ?>

                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600">Add a Recipe Name.</p>
              </div>

          <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
          </div>
      </form>

    </div>
  </main>

<?php require('partials/footer.php') ?>