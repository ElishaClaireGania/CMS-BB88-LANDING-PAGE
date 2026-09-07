const DATA_URL = "./src/data/recent-posts.json";

const createCards = (posts) =>
  posts
    .map(
      (post) => `
        <article class="post-card">
          <div class="card-inner">
            <div class="post-image-wrapper">
              <img src="${post.image}" alt="${post.title}" />
            </div>
            <div class="post-content">
              <span class="post-category">${post.category}</span>
              <div class="post-title-box">
                <h3>${post.title}</h3>
              </div>
              <p class="post-description">
                ${post.description}
              </p>
              <a href="${post.link || "#"}" class="btn-read-more">
                Read More <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </article>
      `,
    )
    .join("");

const renderRecentPosts = (posts) => {
  return `
    <img
      src="./assets/vector/vector2.png"
      alt=""
      class="posts-vector top-left"
    />
    <img
      src="./assets/vector/vector2.0.png"
      alt=""
      class="posts-vector top-right"
    />

    <div class="recent-posts-header">
      <h2>Recent Posts</h2>
      <div class="divider z-10"></div>
    </div>

    <div class="posts-container">
      <div class="posts-grid">
        ${createCards(posts)}
      </div>
    </div>
  `;
};

// Main function
export const loadRecentPosts = async () => {
  const recentPostsSection = document.getElementById("recent-posts");

  if (!recentPostsSection) {
    console.error("Error: Hindi mahanap ang section na may id='recent-posts'");
    return;
  }

  try {
    const response = await fetch(DATA_URL);

    if (!response.ok) {
      throw new Error("Failed to load JSON file");
    }

    const data = await response.json();
    recentPostsSection.innerHTML = renderRecentPosts(data);
  } catch (error) {
    console.warn(
      "JSON fetch failed. Using fallback data to prevent blank screen:",
      error,
    );
    recentPostsSection.innerHTML = renderRecentPosts(fallbackPosts);
  }
};

// Automatic execution
// loadRecentPosts();
