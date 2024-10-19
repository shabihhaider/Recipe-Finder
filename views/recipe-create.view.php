<?php require('partials/head.php') ?>
<link rel="stylesheet" href="assets/css/recipe-notes.css">
<?php require('partials/nav.php') ?>

<main>
    <div class="container">
        <h1 class="create-recipe-title mb-5">Create <span>Recipe</span></h1>
        <form id="recipeForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="recipeName" placeholder="Recipe Name">
                <label for="recipeName">Recipe Name</label>
            </div>
            
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Description" id="recipeDescription"></textarea>
                <label for="recipeDescription">Recipe Description</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Steps to make a recipe" id="recipeSteps"></textarea>
                <label for="recipeSteps">Steps (one step per line)</label>
            </div>
            <button type="submit" class="submit-btn btn-primary">Submit</button>
        </form>

        <div class="modal-backdrop hidden" id="recipe-modal-backdrop">
            <div class="show-modal hidden" id="recipe-modal">
                <h1>Success!</h1>
                <p>Your recipe has been saved.</p>
                <button id="close-success-modal" class="btn">Close</button>
            </div>
        </div>
    </div>
</main>

<script src="assets/js/recipe-notes.js"></script>
<?php require('partials/footer.php') ?>
