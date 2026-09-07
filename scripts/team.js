const DATA_URL = "./src/data/team.json";

const updateArrowPosition = (targetCard, speechBubble, arrow) => {
  if (!speechBubble || !arrow || !targetCard) return;

  requestAnimationFrame(() => {
    const bubbleRect = speechBubble.getBoundingClientRect();
    const cardRect = targetCard.getBoundingClientRect();

    const cardCenter = cardRect.left + cardRect.width / 2 - bubbleRect.left;

    let percent = (cardCenter / bubbleRect.width) * 100;
    percent = Math.max(6, Math.min(94, percent));

    arrow.style.left = `${percent}%`;
  });
};

const renderTeam = ({ title, roles, defaultRole }) => {
  const firstRow = roles.filter((role) => role.row === 1);
  const secondRow = roles.filter((role) => role.row === 2);

  const createCards = (items) =>
    items
      .map(
        ({ id, name, icon }) => `
          <button
            class="team-card ${id === defaultRole ? "active-card" : ""}"
            id="btn-${id}"
            data-role="${id}">

              <div class="card-body">
                  <div class="active-circle">
                      <img
                          src="${icon}"
                          alt="${name}"
                          class="card-icon">
                  </div>
              </div>

              <div class="card-band">
                  ${name}
              </div>
          </button>
      `,
      )
      .join("");

  const activeRole = roles.find((role) => role.id === defaultRole) || roles[0];

  return `
      <img
          src="/assets/vector/vector3.png"
          alt=""
          class="team-clouds">
      <div class="team-container">
          <div class="team-header">

              <h2>${title}</h2>
              <div class="divider z-10"></div>
          </div>

          <div class="team-row">
              ${createCards(firstRow)}
          </div>

          <div class="team-row team-bottom">
              ${createCards(secondRow)}
          </div>

          <div class="speech-wrapper">

              <div
                  class="team-speech-bubble"
                  id="team-speech-bubble">
                  <div
                      id="bubble-arrow"
                      class="bubble-arrow">
                  </div>
                  <h3
                      id="role-title"
                      class="role-title">
                      ${activeRole.name}
                  </h3>
                  <p
                      id="role-desc"
                      class="role-desc">

                      ${activeRole.description}
                  </p>
              </div>
          </div>

          <div class="team-illustration-wrapper">

              <img
                  src="/assets/vector/vector4.png"
                  class="team-people-vector"
                  alt="Our Team">

          </div>
      </div>
  `;
};

export const loadTeam = async () => {
  try {
    const response = await fetch(DATA_URL);

    if (!response.ok) {
      throw new Error("Failed to load team.json");
    }

    const data = await response.json();

    const teamSection = document.getElementById("team");

    teamSection.innerHTML = renderTeam(data);

    initializeTeam(data.roles);
  } catch (error) {
    console.error("Team Section Error:", error);
  }
};

const initializeTeam = (roles) => {
  const cards = document.querySelectorAll(".team-card");

  const speechBubble = document.getElementById("team-speech-bubble");
  const arrow = document.getElementById("bubble-arrow");
  const roleTitle = document.getElementById("role-title");
  const roleDesc = document.getElementById("role-desc");

  const roleData = {};

  roles.forEach((role) => {
    roleData[role.id] = role;
  });

  const defaultCard = document.querySelector(".team-card.active-card");

  if (defaultCard) {
    setTimeout(() => {
      updateArrowPosition(defaultCard, speechBubble, arrow);
    }, 300);
  }

  window.addEventListener("load", () => {
    const active = document.querySelector(".team-card.active-card");

    if (active) {
      updateArrowPosition(active, speechBubble, arrow);
    }
  });

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      const selectedRole = card.dataset.role;

      const role = roleData[selectedRole];

      if (!role) return;

      cards.forEach((c) => c.classList.remove("active-card"));

      card.classList.add("active-card");

      roleTitle.textContent = role.name;

      roleDesc.textContent = role.description;

      updateArrowPosition(card, speechBubble, arrow);
    });
  });

  window.addEventListener("resize", () => {
    const active = document.querySelector(".team-card.active-card");

    if (active) {
      updateArrowPosition(active, speechBubble, arrow);
    }
  });
};

loadTeam();
