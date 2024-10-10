$(document).ready(function() {
    $('#create-recipe-button').on('click', function() {
        $('#recipe-modal').removeClass('hidden').addClass('show-modal');
        $('#recipe-modal-backdrop').removeClass('hidden').addClass('show-backdrop');
    });

    // Close the modal when clicked outside the form
    $(window).on('click', function(event) {
        if ($(event.target).is('#recipe-modal-backdrop')) {
            // Close create recipe modal
            $('#recipe-modal').removeClass('show-modal').addClass('hidden');
            $('#recipe-modal-backdrop').removeClass('show-backdrop').addClass('hidden');

            // Close success modal if it's open
            $('#success-modal-backdrop').removeClass('show-backdrop').addClass('hidden');
        }
    });

    $('#recipeForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
    
        // Close the create recipe modal
        $('#recipe-modal').removeClass('show-modal').addClass('hidden');
        $('#recipe-modal-backdrop').removeClass('show-backdrop').addClass('hidden');
    
        // // Reset the form
        // $('#recipeForm')[0].reset();
    
        // Get form values
       // const recipeImage = $('#recipeImage')[0].files[0]; // Make sure to use [0] to access the file
        const recipeName = $('#recipeName').val(); // Use .val() to get the value
        const recipeDescription = $('#recipeDescription').val(); // Use .val() to get the value
        const recipeSteps = $('#recipeSteps').val().split('\n').join('||');
    
        //console.log(recipeImage);
        console.log(recipeName);
        console.log(recipeDescription);
        console.log(recipeSteps);
        
        // Send the data to backend
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
            $('#success-modal-backdrop').removeClass('hidden').addClass('show-backdrop');
            $('#success-modal').removeClass('hidden').addClass('show-modal');
        })
        .catch(error => {
            console.error('Error saving recipe note:', error);
        });
    });

    // Close the success modal
    $('#close-success-modal').on('click', function() {
        $('#success-modal-backdrop').removeClass('show-backdrop').addClass('hidden');
        $('#success-modal').removeClass('show-modal').addClass('hidden');
    });
});
