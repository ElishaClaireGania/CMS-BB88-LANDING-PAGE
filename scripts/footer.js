// ./scripts/footer.js
document.addEventListener("DOMContentLoaded", () => {
  const DATA_URL = "./src/data/footer.json";

  const createSocialLinks = (links) =>
    links
      .map(
        (link) => `
          <a href="${link.url}" class="social-icon-btn flex items-center justify-center" aria-label="${link.platform}">
            <span class="icon-inner-circle flex items-center justify-center">
              <i class="${link.iconClass}"></i>
            </span>
          </a>
        `
      )
      .join("");

  const renderFooter = (data) => {
    const { socialTitle, socialLinks, copyrightText } = data;

    return `
      <div class="footer-social-section w-full flex flex-col items-center justify-center">
        <p class="footer-title">${socialTitle}</p>

        <div class="flex items-center gap-4">
          ${createSocialLinks(socialLinks)}
        </div>
      </div>

      <div class="footer-copyright-section w-full px-6 text-center">
        <p>${copyrightText}</p>
      </div>
    `;
  };

  const loadFooter = async () => {
    const footerElement = document.querySelector("footer");

    if (!footerElement) {
      console.error("Error: Could not find <footer> element in DOM.");
      return;
    }

    try {
      const response = await fetch(DATA_URL);

      if (!response.ok) {
        throw new Error("Failed to load footer.json");
      }

      const data = await response.json();
      footerElement.innerHTML = renderFooter(data);

    } catch (error) {
      console.warn("Footer JSON fetch failed. Using fallback data:", error);
      footerElement.innerHTML = renderFooter(fallbackFooterData);
    }
  };

  loadFooter();
});