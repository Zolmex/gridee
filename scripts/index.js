import { listenHome } from "./homeButton.js";

function setup() {
    listenHome(); // Home button listener
    setupLogin(); // Setup login listener

    const sideMenuBtn = $('.h-side-btn');
    const sideMenuWrapper = $('.side-menu-wrapper');
    const overlay = $('.side-menu-overlay');
    const createPostBtn = $('.create-post-btn');
    const sideMenuLinks = $('.side-menu-link');

    sideMenuBtn.on('click', () => {
        sideMenuWrapper.toggleClass('active');
    });

    overlay.on('click', () => {
        sideMenuWrapper.toggleClass('active');
    });

    createPostBtn.on('click', () => {
        window.location.href = "/pages/draft.php";
    });

    $.each(sideMenuLinks, (index, link) => link.addEventListener('click', () => {
        window.location.href = "/index.php";
    }))
}

function setupLogin() {
    $('#signin-btn')?.on("click", () => {
        window.location.href = "/pages/signin.php";
    });
    $('#profile-btn')?.on("click", () => {
        $('#profile-card').toggle(); // Mostrar/Esconder la tarjeta del perfil del usuario
    });
}

function loadPosts() {
    // Simulate fetching the posts from server
    const storagePosts = JSON.parse(localStorage.getItem('posts')) || [];
    if (storagePosts){
        storagePosts.forEach(post => posts.push(post));
    }
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