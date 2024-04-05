document.addEventListener('DOMContentLoaded', function () {
    // Seleciona todas as imagens com a classe lightbox-trigger
    const lightboxImages = document.querySelectorAll('.lightbox-trigger');

    // Seleciona o modal do lightbox e o botão de fechar
    const lightboxModal = document.getElementById('lightbox-modal');
    const closeButton = document.querySelector('.close-btn');

    // Adiciona um evento de clique a cada imagem
    lightboxImages.forEach(function (image) {
        image.addEventListener('click', function () {
            // Atualiza o conteúdo da imagem no modal do lightbox
            const modalImage = document.getElementById('lightbox-image');
            modalImage.src = this.src;
            
            // Exibe o modal do lightbox
            lightboxModal.style.display = 'block';
        });
    });

    // Adiciona um evento de clique ao botão de fechar
    closeButton.addEventListener('click', function () {
        // Fecha o modal do lightbox
        lightboxModal.style.display = 'none';
    });
});
