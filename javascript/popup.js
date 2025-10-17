function showPopup(message, position = "bottom") {
  const popup = document.createElement("div");
  popup.className = `popup-banner popup-${position}`;
  popup.textContent = message;

  document.body.appendChild(popup);

  // Trigger entrance animation
  requestAnimationFrame(() => {
    popup.classList.add("popup-show");
  });

  // Auto-dismiss after 3 seconds
  setTimeout(() => {
    popup.classList.remove("popup-show");
    popup.addEventListener("transitionend", () => popup.remove());
  }, 10000);
}

// Apply for specific pages
window.addEventListener("DOMContentLoaded", () => {
  const path = window.location.pathname;

  if (path.includes("index.html") || path.endsWith("/")) {
    showPopup("Welcome to Krushi Sahay – Check latest schemes now!", "bottom");
  } else if (path.includes("dashboard.html")) {
    showPopup("Welcome back to your Dashboard – Check updates now!", "bottom");
  } else if (path.includes("schemes.html")) {
    showPopup("Explore the latest Government Schemes here!", "top");
  }
});
