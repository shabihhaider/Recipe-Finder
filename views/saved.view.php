<?php require('partials/head.php') ?>
<link rel="stylesheet" href="assets/css/recipe-notes.css">
<?php require('partials/nav.php') ?>

<main>
<div class="your-recipe-notes">
        <h2 class="saved-recipe-notes-title">My Recipe <span>Notes</span></h2>
        <div class="container">
            <?php if (isset($_SESSION['loggedIn'])) : ?>
                <section class="section__container special__container" id="special">
                    <div class="special__grid">
                        <?php foreach($recipe_notes as $recipe) : ?>
                            <div class="special__card">
                                <h4 class="recipe__name"><?= htmlspecialchars($recipe['recipe_name']) ?></h4>
                                <p class="recipe__description"><?= htmlspecialchars($recipe['recipe_description']) ?></p>
                                <ol class="recipe__steps">
                                    <?php 
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
            <?php else: ?>
                <h2 class="text-blue-500"><?= $error['noUser'] ?></h2>
            <?php endif; ?>
        </div>

        <div class="create-button">
            <button id="create-recipe-button" class="btn">Create Recipe</button>
        </div>
    </div>
</main>

<script src="assets/js/recipe-notes.js"></script>
<?php require('partials/footer.php') ?>
