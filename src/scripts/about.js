const DATA_URL = "./src/data/about.json";

const renderAbout = ({ services, about }) => {
  const { title: servicesTitle, icons } = services;

  const {
    title: aboutTitle,
    subtitle,
    paragraphs
  } = about;

  return `
    <div class="about-bg absolute inset-0 z-0">
      <img
        src="assets/bg/background 1.png"
        alt=""
        class="about-bg-image w-full h-full object-cover z-1"
      />

      <img
        src="assets/bg/vector1.png"
        alt=""
        class="about-vector-overlay absolute right-0 pointer-events-none z-2"
      />
    </div>

    <div class="about-wrapper relative z-10 w-full max-w-300">

      <div class="design-marketing flex flex-col items-center text-center">

        <h2>${servicesTitle}</h2>

        <div class="divider z-10"></div>

        <div class="about-icons flex flex-wrap justify-center gap-8 mt-1">

          ${icons
            .map(
              ({ image, label }) => `
                <div class="icon-container flex flex-col items-center">

                  <div class="icon-wrapper">
                    <img src="${image}" alt="${label}">
                  </div>

                  <span class="icon-label">
                    ${label}
                  </span>

                </div>
              `
            )
            .join("")}

        </div>

      </div>

      <div class="about-contents flex flex-col items-center">

        <h2>${aboutTitle}</h2>

        <div class="divider z-10"></div>

        <h3>${subtitle}</h3>

        ${paragraphs
          .map(
            (paragraph) => `
              <p>
                ${paragraph}
              </p>
            `
          )
          .join("")}

      </div>

    </div>
  `;
};

export const loadAbout = async () => {
  try {
    const response = await fetch(DATA_URL);

    if (!response.ok) {
      throw new Error("Failed to load about.json");
    }

    const data = await response.json();

    const aboutSection = document.getElementById("about");

    aboutSection.innerHTML = renderAbout(data);

  } catch (error) {
    console.error("About Section Error:", error);
  }
};