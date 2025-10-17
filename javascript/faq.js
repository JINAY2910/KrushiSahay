document.addEventListener("DOMContentLoaded", function () {
  const allFaqs = document.querySelectorAll(".faq-block");
  allFaqs.forEach((faq) => {
    faq.addEventListener("toggle", () => {
      if (faq.open) {
        allFaqs.forEach((otherFaq) => {
          if (otherFaq !== faq && otherFaq.open) {
            otherFaq.open = false;
          }
        });
      }
    });
  });
});
