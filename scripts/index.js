import { listenHome } from "./homeButton.js";

function setup() {
    listenHome(); // Home button listener
    setupLogin(); // Setup login listener

    const sideMenuBtn = $('.h-side-btn');
    const sideMenuWrapper = $('.side-menu-wrapper');
    const overlay = $('.side-menu-overlay');
    const createPostBtn = $('.create-post-btn');
    const sideMenuLinks = $('.side-menu-link');
    const posts = $('.post-card');

    sideMenuBtn.on('click', () => {
        sideMenuWrapper.toggleClass('active');
    });

    overlay.on('click', () => {
        sideMenuWrapper.toggleClass('active');
    });

    createPostBtn.on('click', () => {
        window.location.href = "/pages/draft.php";
    });

    posts.on('click', function() {
        let idAtt = $(this).attr("id");
        let id = parseInt(idAtt.replace(/[^0-9]/g, ''));
        
        window.location.href = "/pages/post.php?p=" + id;
    });

    $.each(sideMenuLinks, (index, link) => link.addEventListener('click', () => {
        window.location.href = "/index.php";
    }));

    $("#h-search").on("keyup", function () { // Cuando el usuario escribe en el input de busqueda, actualizamos las publicaciones que se muestren
        let texto = $(this).val().toLowerCase();
    
        $("article").each(function () {
            let titulo = $(this).find("header").find("h2").text().toLowerCase();
    
            if (titulo.includes(texto)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
}

function setupLogin() {
    $('#signin-btn')?.on("click", () => {
        window.location.href = "/pages/signin.php";
    });
    $('#profile-btn')?.on("click", () => {
        $('#profile-card').toggle(); // Mostrar/Esconder la tarjeta del perfil del usuario
    });
}

setup();