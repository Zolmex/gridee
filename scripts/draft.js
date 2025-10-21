import { listenHome } from "./homeButton.js";
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