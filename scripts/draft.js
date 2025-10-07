import { listenHome } from "./homeButton.js";

function setup() {
    const backBtn = document.getElementById('draft-panel-back-btn');
    const publishBtn = document.getElementById('publish-btn');

    backBtn.addEventListener('click', () => {
        window.location.href = "/index.html";
    });
    publishBtn.addEventListener('click', submitPost);

    listenHome(); // Home button listener
}

function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function submitPost() {
    const storagePosts = JSON.parse(localStorage.getItem("posts")) || [];
    const postTitle = document.getElementById('post-title-input').value;
    const postBody = document.getElementById('post-body-input').value;
    const post = {
        "title": postTitle,
        "body": postBody,
        "date": new Date().toISOString(),
        "reactions": randomInt(0, 500),
        "author_username": "unknown"
    };
    storagePosts.push(post);
    localStorage.setItem("posts", JSON.stringify(storagePosts));
    window.location.href = "/index.html";
}

setup();