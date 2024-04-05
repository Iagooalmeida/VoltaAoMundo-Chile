document.addEventListener('DOMContentLoaded', function () {
    const lightboxImages = document.querySelectorAll('.lightbox-trigger');
    const lightboxModal = document.getElementById('lightbox-modal');
    const closeButton = document.querySelector('.close-btn');
    const modalImage = document.getElementById('lightbox-image');

    let currentImageIndex = 0;

    // Adiciona um evento de clique a cada imagem
    lightboxImages.forEach(function (image, index) {
        image.addEventListener('click', function () {
            currentImageIndex = index;
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

    // Adiciona event listener para as teclas de seta
    document.addEventListener('keydown', function (event) {
        if (lightboxModal.style.display === 'block') {
            if (event.key === 'ArrowLeft') {
                currentImageIndex = (currentImageIndex - 1 + lightboxImages.length) % lightboxImages.length;
                modalImage.src = lightboxImages[currentImageIndex].src;
            } else if (event.key === 'ArrowRight') {
                currentImageIndex = (currentImageIndex + 1) % lightboxImages.length;
                modalImage.src = lightboxImages[currentImageIndex].src;
            }
        }
    });
});
