import { listenHome } from "./homeButton.js";

var bannerFile = null;

import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from '../ckeditor/ckeditor5/ckeditor5.js';

ClassicEditor
    .create(document.querySelector('#editor'), {
        licenseKey: 'GPL',
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        ]
    })
    .then(editor => {
        console.log('CKEditor initialized', editor);
        window.editor = editor; // for dev console access
    })
    .catch(error => {
        console.error('CKEditor error while creating the editor:', error);
    });

function setup() {
    const backBtn = $('#draft-panel-back-btn');
    const bannnerInput = $('#post-banner-input');

    bannnerInput.change((event) => { // Cuando el usuario selecciones una imagen guardamos el archivo en una variable global
        var file = event.target.files[0];
        if (file != null) {
            const reader = new FileReader();
            reader.onload = (e) => {
                bannerFile = e.target.result;
            };

            reader.onerror = (e) => {
                console.error('Error reading file:', e.target.error);
            };

            reader.readAsDataURL(file); // Leer archivo
            console.info("Archivo subido correctamente.");
        }
    });

    backBtn.on('click', () => {
        window.location.href = "/index.php";
    });
    $('#publish-form').on('submit', submitPost);

    listenHome(); // Home button listener

    $('#profile-btn')?.on("click", () => {
        $('#profile-card').toggle(); // Mostrar/Esconder la tarjeta del perfil del usuario
    });
}

function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function submitPost() {
    const postBody = window.editor.getData();
    $('#post-body-input').val(postBody);
}

setup();