import { listenHome } from "./homeButton.js";

function setup() {
    listenHome(); // Home button listener
    setupLogin(); // Setup login listener

    const sideMenuBtn = document.querySelector('.h-side-btn');
    const sideMenuWrapper = document.querySelector('.side-menu-wrapper');
    const overlay = document.querySelector('.side-menu-overlay');
    const createPostBtn = document.querySelector('.create-post-btn');

    sideMenuBtn.addEventListener('click', () => {
        sideMenuWrapper.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sideMenuWrapper.classList.toggle('active');
    });

    createPostBtn.addEventListener('click', () => {
        window.location.href = "/pages/draft.html";
    });
}

function setupLogin() {
    document.getElementById('signin-btn').addEventListener("click", () => {
        window.location.href = "/pages/signin.html";
    });
}

const postExamples = [
    {
        "title": "Building My First Game Engine",
        "body": "After months of trial and error, I finally got my entity system and renderer working together. Next step: physics!",
        "date": "2025-10-07T14:32:00Z",
        "reactions": 128,
        "author_username": "dev_mat"
    },
    {
        "title": "Dark Mode Complete!",
        "body": "Finally added dark mode to my portfolio site using CSS variables and prefers-color-scheme. It looks so much cleaner now.",
        "date": "2025-10-06T19:10:00Z",
        "reactions": 73,
        "author_username": "codeflux"
    },
    {
        "title": "Zig Syntax Still Hurts My Brain",
        "body": "I’ve been learning Zig this week, and while it’s powerful, I keep mixing up the syntax. Rust feels cozy in comparison.",
        "date": "2025-10-05T21:48:00Z",
        "reactions": 95,
        "author_username": "mat_dev"
    },
    {
        "title": "WebSocket Server Up and Running!",
        "body": "Got my multiplayer prototype communicating between clients. Latency’s solid under 100ms on local — time to test online.",
        "date": "2025-10-04T16:25:00Z",
        "reactions": 210,
        "author_username": "gridworks"
    },
    {
        "title": "CSS Grid Just Clicked",
        "body": "After fighting with flexbox for years, I finally understood how powerful grid templates are. Never going back.",
        "date": "2025-10-03T09:55:00Z",
        "reactions": 56,
        "author_username": "frontline"
    },
    {
        "title": "Procedural Map Generator Done!",
        "body": "Implemented noise-based terrain generation and biome blending for my roguelike. Every world feels unique now!",
        "date": "2025-10-02T23:41:00Z",
        "reactions": 182,
        "author_username": "astrum_creator"
    }
];
var posts = [];

function loadPosts() {
    // Simulate fetching the posts from server
    postExamples.forEach(post => posts.push(post));
}

function timeAgo(dateString) {
    const now = new Date();
    const date = new Date(dateString);
    const seconds = Math.floor((now - date) / 1000);
    const days = Math.floor(seconds / 86400);
    if (days > 1)
        return `${days} days ago`;
    if (days === 1)
        return "1 day ago";
    const hours = Math.floor(seconds / 3600);
    if (hours >= 1)
        return `${hours} hour${hours > 1 ? "s" : ""} ago`;
    const minutes = Math.floor(seconds / 60);
    if (minutes >= 1)
        return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
    return "Just now";
}

function createArticle(post) {
    const article = document.createElement('article');
    article.classList.add('post-card');
    article.innerHTML = `
    <header class="post-title" style="background-image: url('images/post-banner.jpg');">
      <p>${post.title}</p>
    </header>
    <section class="post-body">
      <p class="post-description">${post.body}</p>
      <div class="post-author-details">
        <img src="images/profile-picture.jpg" alt="Profile Picture">
        <div>
          <p>${post.author_username}</p>
          <p>${timeAgo(post.date)}</p>
        </div>
      </div>
      <div class="post-reactions">
        <p>&#129505; +${post.reactions}</p>
      </div>
    </section>
    `;
    return article;
}

function renderPosts() {
    const articles = document.getElementById('article-list');
    posts.forEach(post => {
        const article = createArticle(post);
        articles.appendChild(article);
    });
}

setup();

loadPosts();
renderPosts();