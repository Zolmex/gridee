export function listenHome() {
    const homeButton = document.querySelector('.h-side-container img');

    homeButton.addEventListener('click', () => {
        window.location.href = "/index.html";
    });
}