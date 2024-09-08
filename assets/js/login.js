
/* SignUp and LogIn */
const form = document.getElementById("form");
const emailInput = document.getElementById("email-input");
const passwordInput = document.getElementById("password-input");
const errorMessage = document.getElementById("error-message");

form.addEventListener("submit", (e) => {
  
  e.preventDefault(); // Prevent the form from submitting the traditional way
  let errors = [];
  
  if (emailInput) {
    errors = getLogInFormErrors(
      emailInput.value,
      passwordInput.value,
    );
    // If there is no errors submit the form
    if (errors.length === 0) {
      form.submit();  
    } else {
      // If there are errors display them
      errorMessage.innerText = errors.join(". ");
    }
  }

});

function getLogInFormErrors(email, password) {
  let errors = [];

  // Clear previous error highlights
  document.querySelectorAll(".highlight").forEach((element) => {
    element.classList.remove("incorrect");
  });

  if (email === "" || email == null) {
    errors.push(`Email is required`);
    emailInput.parentElement.classList.add("incorrect");
  }
  if (password === "" || password == null) {
    errors.push(`Password is required`);
    passwordInput.parentElement.classList.add("incorrect");
  }

  if (password.length < 8 && password !== "") {
    errors.push(`Password must have at least 8 characters`);
    passwordInput.parentElement.classList.add("incorrect");
  }

  return errors;
}

const allInputs = [
  firstNameInput,
  emailInput,
  passwordInput,
  repeatPasswordInput,
].filter((input) => input != null);

allInputs.forEach((input) => {
  input.addEventListener("input", () => {
    if (input.parentElement.classList.contains("incorrect")) {
      input.parentElement.classList.remove("incorrect");
      errorMessage.innerText = "";
    }
  });
});