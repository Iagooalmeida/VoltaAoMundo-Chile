// Autor: Iago Oliveira
        $(document).ready(function(){
            $(".menu-button").click(function(){
                $(".menu-bar").toggleClass("open");
                $(".content").toggleClass("menu-expanded");
            });

            $(".btn-edit").click(function() {
                var id = $(this).data("id");
                var nome = $(this).data("nome");
                var email = $(this).data("email");
                var comentario = $(this).data("comentario");

                $("#editId").val(id);
                $("#editNome").val(nome);
                $("#editEmail").val(email);
                $("#editComentario").val(comentario);

                $("#editModal").modal("show");
            });
        });
    