let construct = () => {
    eventos();
};

const eventos = () => {
    
    $('#formulario').on('submit', function (e) {
        e.preventDefault();
        let titulo = $('#titulo').val(),
            autores = $('#autores').val(),
            modalidade = $('#modalidade').val(),
            arquivo = $('#arquivo').val(),
            idUsuario = $('#formulario').attr('data-idUsuario');

        if (titulo !== "" &&
            autores !== "" &&
            modalidade !== "" &&
            arquivo !== ""
        ) {
            let dados = {
                titulo: titulo,
                autores: autores,
                modalidade: modalidade,
                arquivo: arquivo
            };

            if(idUsuario > 0){
                dados.idUsuario = idUsuario;
                dados.acao = "Trabalhos/atualizarDados";
            } else{
                dados.acao = "Usuarios/cadastrar";
            }
    
            $.ajax({
                url: baseUrl,
                type: "POST",
                data: dados,
                dataType: "text",
                async: true,
                success: function (res) {
                    if (res) {
                        // console.log(res);
                        // $('#msg_sucesso').toast('show'); // Para aparecer a mensagem de sucesso
                        // alert("Cadastrou");
                        window.location="trabalhos.php";
                        $('#formulario').each(function () {
                            this.reset(); // Pra limpar o formulário
                        });
                    } else {
                        // alert("Não FOi");
                        $('#msg_alerta').toast('show');
                    }
                },
                error: function (request, status, str_error) {
                    console.log(request, status, str_error)
                }
            });
        } else{
            $('#msg_alerta').toast('show');
        }
    });
};

construct();