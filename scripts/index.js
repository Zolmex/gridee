const sideMenuBtn = document.querySelector('.h-side-btn');
const sideMenuWrapper = document.querySelector('.side-menu-wrapper');
const overlay = document.querySelector('.side-menu-overlay');

sideMenuBtn.addEventListener('click', () => {
    sideMenuWrapper.classList.toggle('active');
});

overlay.addEventListener('click', () => {
    sideMenuWrapper.classList.toggle('active');
});