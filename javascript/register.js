document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("registerForm");
  const name = document.getElementById("name");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const confirm = document.getElementById("confirm");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  form.addEventListener("submit", (e) => {
    let isValid = true;

    emailError.textContent = "";
    passwordError.textContent = "";

    // Trim input values
    const emailValue = email.value.trim();
    const passwordValue = password.value;
    const confirmValue = confirm.value;

    // Validate email or mobile
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^[6-9]\d{9}$/;
    if (!emailPattern.test(emailValue) && !phonePattern.test(emailValue)) {
      emailError.textContent = "Enter a valid email or 10-digit mobile number.";
      isValid = false;
    }

    // Check password match
    if (passwordValue !== confirmValue) {
      passwordError.textContent = "Passwords do not match.";
      isValid = false;
    }

    if (!isValid) {
      e.preventDefault();
    }
  });
});
