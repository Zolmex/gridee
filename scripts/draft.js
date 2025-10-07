import { listenHome } from "./homeButton.js";

function setup() {
    const backBtn = document.getElementById('draft-panel-back-btn');

    backBtn.addEventListener('click', () => {
        window.location.href = "/index.html";
    });

    listenHome(); // Home button listener
}

function submitPost() {
    
}

setup();