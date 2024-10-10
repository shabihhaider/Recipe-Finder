<?php require('partials/head.php') ?>
<link rel="stylesheet" href="assets/css/recipe-notes.css">
<!--JQUERY CDN LINK-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<?php require('partials/nav.php') ?>

<main>
    <div class="your-recipe-notes">
      <h2 class="saved-recipe-notes-title">My Recipe Notes</h2>
      <div class="container">
        <?php if (isset($_SESSION['loggedIn'])) : ?>
          <section class="section__container special__container" id="special">
              <div class="special__grid">
                  <?php foreach($recipe_notes as $recipe) : ?>
                      <div class="special__card">
                          <!-- Recipe Name -->
                          <h4 class="recipe__name"><?= htmlspecialchars($recipe['recipe_name']) ?></h4>
                          <!-- Recipe Description -->
                          <p class="recipe__description">
                              <?= htmlspecialchars($recipe['recipe_description']) ?>
                          </p>
                          <!-- Recipe Steps -->
                          <ol class="recipe__steps">
                              <?php 
                                  // Convert the recipe_steps string back into an array using the correct delimiter
                                  $steps = explode('||', $recipe['recipe_steps']); 
                                  foreach ($steps as $step): 
                              ?>
                                  <li><?= htmlspecialchars($step) ?></li>
                              <?php endforeach; ?>
                          </ol>
                      </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

      </div>
    
        <?php if (!isset($_SESSION['loggedIn'])) : ?>
            <h2 class="text-blue-500"><?= $error['noUser'] ?></h2>  
        <?php endif; ?>
        
        <div class="create-button">
            <button id="create-recipe-button">Create Recipe</button>

            <!-- Modal for Recipe Form -->
            <div class="modal-backdrop hidden" id="recipe-modal-backdrop">
              <div class="container hidden" id="recipe-modal">
                  <h1>Create Your <span class="change-color">Recipe Notes</span></h1>
                  <form id="recipeForm">
                      <!-- <div class="input-group">
                          <label for="recipeImage">Recipe Image:</label>
                          <input type="file" id="recipeImage" accept="image/*">
                      </div> -->

                      <div class="input-group">
                          <label for="recipeName">Recipe Name:</label>
                          <input type="text" id="recipeName" placeholder="Enter recipe name" required>
                      </div>

                      <div class="input-group">
                          <label for="recipeDescription">Recipe Description:</label>
                          <textarea id="recipeDescription" placeholder="Enter a brief description" required></textarea>
                      </div>

                      <div class="input-group">
                          <label for="recipeSteps">Recipe Steps:</label>
                          <textarea id="recipeSteps" placeholder="Enter steps" required></textarea>
                      </div>

                      <button type="submit" class="submit-btn">Save Recipe Note</button>
                  </form>
              </div>
            </div>

            <!-- New Success Modal -->
            <div class="modal-backdrop hidden" id="success-modal-backdrop">
                <div class="container hidden" id="success-modal">
                    <h1>Recipe Created <span class="change-color">Successfully!</span></h1>
                    <p>Your recipe has been saved.</p>
                    <button class="submit-btn" id="close-success-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="assets/js/recipe-notes.js"></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<?php require('partials/footer.php') ?>
