$(document).ready(function() {
    $("#uploadForm").submit(function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        var status = $("#status").val();

        formData.append('status', status);

        $.ajax({
            url: 'importar_comentarios.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    var jsonResponse = JSON.parse(response);

                    if (jsonResponse.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Comentários importados com sucesso.'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: jsonResponse.message
                        });
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Resposta inválida do servidor. Tente novamente.'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Erro na requisição. Tente novamente.'
                });
            }
        });
    });
});
