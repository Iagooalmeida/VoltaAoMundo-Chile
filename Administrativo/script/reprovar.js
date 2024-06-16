document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-reject').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            fetch('reprovar_comentario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Reprovado!',
                        text: 'Comentário reprovado.',
                    }).then(() => {
                        // Atualize a página ou o status do comentário
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao aprovar o comentário.',
                });
                console.error('Erro:', error);
            });
        });
    });
});