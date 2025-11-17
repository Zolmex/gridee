import { listenHome } from "./homeButton.js";

function setup() {
    listenHome(); // Home button listener

    const reaccionBtn = $('.reactions__btn--like');
    reaccionBtn.on('click', () => {
        let idAtt = $('article').attr("id");
        let id = parseInt(idAtt.replace(/[^0-9]/g, ''));
        window.location.href = "?p=" + id + "&react=true";
    });
}

setup();