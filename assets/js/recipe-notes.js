$(document).ready(function() {

    $('#create-recipe-button').on('click', function() {
        window.location.href = '/recipe-create'; // Redirect to create recipe page
    });

    $('#recipeForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const recipeName = $('#recipeName').val();
        const recipeDescription = $('#recipeDescription').val();
        const recipeSteps = $('#recipeSteps').val().split('\n').join('||');

        if (!recipeName || !recipeDescription || !recipeSteps) {
            alert("All fields are required!");
            return;
        }

        // Send the data to the backend
        fetch("/saved", {
            "method": "POST",
            "headers": {
                "Content-Type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify({ "recipe_name": recipeName, "recipe_description": recipeDescription, "recipe_steps": recipeSteps})
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Return parsed JSON
        })
        .then(function(data) {
            console.log(data);
            // Show the success modal
            $('#recipe-modal-backdrop').removeClass('hidden').addClass('show-backdrop');
            $('#recipe-modal').removeClass('hidden').addClass('show-modal');
        })
        .catch(error => {
            console.error('Error saving recipe note:', error);
        });
    });

    // Close the success modal
    $('#close-success-modal').on('click', function() {
        $('#recipe-modal-backdrop').removeClass('show-backdrop').addClass('hidden');
        $('#recipe-modal').removeClass('show-modal').addClass('hidden');
    });
});
