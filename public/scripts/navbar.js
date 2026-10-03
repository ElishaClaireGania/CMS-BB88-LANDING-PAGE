const DATA_NAV = "./src/data/navbar.json";

const initNavLinks = () => {
  const navLinks = document.querySelectorAll(".nav-links a");
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      document
        .querySelector(".nav-links a.active")
        ?.classList.remove("active");
      this.classList.add("active");
    });
  });
};

const initNavInteractions = () => {
  const menuOpenBtn = document.getElementById("menuOpenBtn");
  const navLinks = document.getElementById("navLinks");
  const closeBtn = document.getElementById("hamburger");

  if (menuOpenBtn && navLinks) {
    menuOpenBtn.addEventListener("click", () => {
      navLinks.classList.add("open");
    });
  }

  if (closeBtn && navLinks) {
    closeBtn.addEventListener("click", () => {
      navLinks.classList.remove("open");
    });
  }
};

export const loadNavbarSection = async () => {
  try {
    const response = await fetch(DATA_NAV);
    if (!response.ok) throw new Error("Navbar data not found.");
    const data = await response.json();
    renderNavbar(data);
  } catch (err) {
    console.error("Navbar Error:", err);
  }
};

const renderNavbar = (data) => {
  const navbar = document.querySelector("#navbar");
  const { logo, links, cta } = data;

  // 1. DESKTOP LINKS
  const desktopLinksHtml = links
    .map(
      (link, index) => `
    <li class="animate-link-drop-${index + 1}">
    <a href="${link.url}" class="nav-link relative block py-[1.75] px-[1.5] text-[0.75rem] text-white rounded-sm whitespace-nowrap transition duration-200 hover:bg-white/[0.14] hover:-translate-y-px xl:text-[0.88rem] xl:px-2">
    ${link.text}
    </a>
    </li>
    `,
    )
    .join("");

  // 2. MOBILE LINKS
  const mobileLinksHtml = links
    .map(
      (link) => `
    <li class="w-full">
    <a href="${link.url}" class="block py-[1.75] px-[1.5] text-[0.85rem] text-white rounded-sm w-full hover:bg-white/[0.14]">
    ${link.text}
    </a>
    </li>
    `,
    )
    .join("");

  // 3. INJECT ENTIRE STRUCTURE
  navbar.innerHTML = `
  <div class="flex items-center px-[4.5] h-[14.5]">
  <a href="#" class="max-lg:hidden shrink-0">
  <img src="${logo.src}" alt="${logo.alt}" class="animate-logo-slide-in h-[10.5] w-auto block ml-[2.5] transition-all duration-200 hover:scale-[1.08] hover:opacity-85 xl:h-[12.5] xl:ml-[12.5]"></img>
  </a>
  
  <ul class="nav-links nav-links-desktop hidden lg:flex items-center list-none flex-1 justify-between px-2 gap-0 xl:px-[22.5]">
  ${desktopLinksHtml}
  </ul>

            <a href="${cta.url}" class="animate-btn-slide-in hidden lg:inline-block bg-btn-red text-white font-bold py-2 px-3 rounded-md no-underline whitespace-nowrap shrink-0 mr-[2.5] text-[0.78rem] transition-all duration-200 hover:bg-[#cc0000] hover:-translate-y-0.5 hover:shadow-[0_4px_12px_rgba(255,0,0,0.4)] xl:px-[4.5] xl:mr-[32.5] xl:text-[0.88rem]">
            ${cta.text}
            </a>
            
            <button class="lg:hidden flex items-center bg-transparent border-none cursor-pointer text-white text-[1.4rem] ml-auto p-[1.5] transition-all duration-300 hover:text-light-blue hover:scale-110" id="menuOpenBtn">
            <i class="fa-solid fa-bars"></i>
            </button>
            </div>
            
            <ul class="nav-links lg:hidden fixed top-0 right-0 w-[60%] h-screen list-none flex flex-col items-start pt-[17.5] px-4 pb-20 gap-[0.5] z-999 shadow-[-4px_0_24px_rgba(0,0,0,0.4)] invisible opacity-0 translate-x-full transition-[transform,opacity,visibility] duration-350 ease-in-out [&.open]:visible [&.open]:opacity-100 [&.open]:translate-x-0" style="background: linear-gradient(to bottom, #0a1a6e, #1e88e5)" id="navLinks">        
            <li class="absolute top-3 right-3">
            <button id="hamburger" class="bg-transparent border-none cursor-pointer text-white text-[1.4rem] p-[1.5] transition-all duration-300 hover:text-light-blue hover:scale-110" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
            </button>
            </li>
            ${mobileLinksHtml}
            <li class="absolute bottom-4 left-0 right-0 px-4">
            <a href="${cta.url}" class="block bg-btn-red text-white font-bold text-[0.88rem] py-[2.5] px-[3.5] rounded-md no-underline text-center w-full transition-colors duration-200 hover:bg-[#cc0000]">
            ${cta.text}
            </a>
            </li>
        </ul>
    `;

  initNavLinks();
  initNavInteractions();
};
