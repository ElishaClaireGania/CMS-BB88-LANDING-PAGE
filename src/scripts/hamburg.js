document.addEventListener("DOMContentLoaded", function () {
  const hamburgerBtn = document.getElementById("hamburger-btn");
  const navMenu = document.getElementById("nav-menu");

  if (hamburgerBtn && navMenu) {
    hamburgerBtn.addEventListener("click", function (e) {
      console.log("Hamburger button clicked");
      e.preventDefault();
      e.stopPropagation();

      // Toggle active class for X animation
      this.classList.toggle("active");

      // Toggle menu visibility - simpler approach
      navMenu.classList.toggle("open");
    });

    // Close menu when clicking on a link
    const navLinks = navMenu.querySelectorAll("a");
    navLinks.forEach((link) => {
      link.addEventListener("click", function () {
        hamburgerBtn.classList.remove("active");
        navMenu.classList.remove("open");
      });
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (event) {
      const isClickInside =
        navMenu.contains(event.target) || hamburgerBtn.contains(event.target);
      if (!isClickInside && navMenu.classList.contains("open")) {
        hamburgerBtn.classList.remove("active");
        navMenu.classList.remove("open");
      }
    });
  }
});
