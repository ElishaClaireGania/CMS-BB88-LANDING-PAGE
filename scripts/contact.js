const DATA_URL = "./src/data/contact.json";

const renderContact = (data) => {
  const { vectors, header, mapUrl, infoPills, footer } = data;

  const pillsHTML = infoPills
    .map(({ iconClass, label, value, isDesc }) => {
      const valueClass = isDesc ? "capsule-value desc-text" : "capsule-value";
      return `
        <div class="info-capsule-row">
          <div class="capsule-icon-badge">
            <i class="${iconClass}"></i>
          </div>
          <div class="capsule-body-pill">
            <div class="capsule-inner-card">
              <span class="capsule-label">${label}</span>
              <span class="${valueClass}">${value}</span>
            </div>
          </div>
        </div>
      `;
    })
    .join("");

  return `
    <img src="${vectors.topLeft}" alt="" class="vector-decor top-left" />
    <img src="${vectors.bottomRight}" alt="" class="vector-decor bottom-right" />

    <div class="contact-container">
      <div class="contact-header">
        <h2 class="contact-title">${header.title}</h2>
        <div class="divider z-10"></div>
        <p class="contact-subtitle">${header.subtitle}</p>
      </div>

      <div class="map-frame-wrapper w-full h-95 bg-white">
        <iframe
          src="${mapUrl}"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>

      <div class="contact-grid">
        <div class="info-pills-col">
          ${pillsHTML}
        </div>

        <div class="form-col">
          <form id="contact-form" onsubmit="event.preventDefault()">
            <div class="form-row-half">
              <input type="text" placeholder="Your name" required />
              <input type="email" placeholder="Your email" required />
            </div>
            <input
              type="text"
              placeholder="Subject"
              required
              class="full-width-input"
            />
            <textarea placeholder="Message" rows="6" required></textarea>
          </form>
        </div>
      </div>

      <div class="contact-bottom-bar">
        <div class="contact-logo-text">
          <h3>${footer.companyName}</h3>
          <p>${footer.subTitle}</p>
        </div>
        <button type="submit" form="contact-form" class="btn-send-message">
          Send Message
        </button>
      </div>
    </div>
  `;
};

export const loadContact = async () => {
  const contactContainer = document.getElementById("contact");

  if (!contactContainer) {
    console.error("Error: Could not find section with id 'contact'");
    return;
  }

  try {
    const response = await fetch(DATA_URL);

    if (!response.ok) {
      throw new Error("Failed to load contact.json");
    }

    const data = await response.json();
    contactContainer.innerHTML = renderContact(data);

  } catch (error) {
    console.warn("Contact JSON fetch failed. Using fallback data:", error);

    contactContainer.innerHTML = renderContact(fallbackContactData);
  }
};

// loadContact();