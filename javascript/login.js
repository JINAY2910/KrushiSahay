document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");

  form.addEventListener("submit", function (e) {
    let valid = true;

    const username = document.getElementById("username");
    const password = document.getElementById("password");

    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("loginPasswordError");

    // Clear previous errors
    usernameError.textContent = "";
    passwordError.textContent = "";

    // Username validation (basic length check)
    if (username.value.trim().length < 3) {
      usernameError.textContent = "Username must be at least 3 characters long.";
      valid = false;
    }

    // Password validation (basic length check)
    if (password.value.trim().length < 6) {
      passwordError.textContent = "Password must be at least 6 characters long.";
      valid = false;
    }

    if (!valid) {
      e.preventDefault(); // Prevent form from submitting
    }
  });
});
