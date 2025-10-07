import { listenHome } from "./homeButton.js";

function setup() {
    listenHome(); // Home button listener
    setupLogin(); // Setup login listener
    
    const sideMenuBtn = document.querySelector('.h-side-btn');
    const sideMenuWrapper = document.querySelector('.side-menu-wrapper');
    const overlay = document.querySelector('.side-menu-overlay');

    sideMenuBtn.addEventListener('click', () => {
        sideMenuWrapper.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sideMenuWrapper.classList.toggle('active');
    });
}

function setupLogin() {
    document.getElementById('signin-btn').addEventListener("click", () => {
        window.location.href = "/pages/signin.html";
    });
}

setup();