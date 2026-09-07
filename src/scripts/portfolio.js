const DATA_URL = "./src/data/portfolio.json";

document.addEventListener("DOMContentLoaded", () => {
  const projectGrid = document.getElementById("projects-grid");
  const filterButtons = document.querySelectorAll(".filter-btn");
  let portfolioCards = [];

  if (!projectGrid) {
    console.error(
      "Error: Could not find the portfolio grid element (#projects-grid) in the DOM.",
    );
    return;
  }

  // Fetch portfolio data
  async function fetchPortfolioData() {
    try {
      const response = await fetch(DATA_URL);

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();
      portfolioCards = data;
      return data;
    } catch (error) {
      console.error("Error loading portfolio data:", error);
    }
  }

  // Rendering of Cards
  function displayCards(filterCategory) {
    projectGrid.innerHTML = "";

    const filteredCards = portfolioCards.filter((card) => {
      if (filterCategory === "All") return true;
      return card.category === filterCategory;
    });

    if (filteredCards.length === 0) {
      projectGrid.innerHTML = `<div class="no-projects text-center py-8 text-gray-500 w-full col-span-full">No projects found in this category.</div>`;
      return;
    }

    filteredCards.forEach((card) => {
      const cardHTML = `
        <div class="project-card">
          <div class="img-wrapper">
            <img src="${card.image}" alt="${card.title}" />
          </div>
          <h3>${card.title}</h3>

          <!-- THE HOVER CARD (Matches design) -->
          <div class="info-overlay">
            <div class="overlay-logo">
              <img src="${card.image}" alt="logo" />
            </div>
            <div class="overlay-title">${card.title}</div>
            <div class="overlay-description">${card.description}</div>
          </div>
        </div>`;

      projectGrid.insertAdjacentHTML("beforeend", cardHTML);
    });
  }

  // Handle filter button click actions
  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      filterButtons.forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");

      const category = button.getAttribute("data-filter");
      displayCards(category);
    });
  });

  async function init() {
    const data = await fetchPortfolioData();

    displayCards("All");
  }

  init();
});
