document.addEventListener('DOMContentLoaded', function () {
    const lightboxImages = document.querySelectorAll('.lightbox-trigger');
    const lightboxModal = document.getElementById('lightbox-modal');
    const closeButton = document.querySelector('.close-btn');

    // Adiciona um evento de clique a cada imagem
    lightboxImages.forEach(function (image) {
        image.addEventListener('click', function () {
            const modalImage = document.getElementById('lightbox-image');
            modalImage.src = this.src;
            lightboxModal.style.display = 'block';
        });
    });

    // Fecha o modal quando o usuário clica no botão de fechar
    closeButton.addEventListener('click', function () {
        lightboxModal.style.display = 'none';
    });

    // Fecha o modal quando o usuário clica em qualquer área fora da imagem
    lightboxModal.addEventListener('click', function (event) {
        if (event.target === lightboxModal) {
            lightboxModal.style.display = 'none';
        }
    });
});
