let construct = () => {
    eventos();
};

const eventos = () => {
    
    $('#formulario').on('submit', function (e) {
        e.preventDefault();
        let nome = $('#nome').val(),
            cpf = $('#cpf').val(),
            email = $('#email').val(),
            senha = $('#senha').val(),
            conf_senha = $('#confirm_senha').val(),
            telefone = $('#telefone').val(),
            usuario_id  = $('#usuario_id').val();

        if (nome !== "" &&
            cpf !== "" &&
            email !== "" &&
            senha == conf_senha 
        ) {
            let dados = {
                nome: nome,
                cpf: cpf,
                email: email,
                telefone: telefone,
                senha: senha,
            };

            if(usuario_id>0){
                dados.usuario_id=usuario_id;
                delete dados.senha;
                dados.acao = "Usuarios/atualizarDados";
            }else{
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
        }else{
            $('#msg_alerta').toast('show');
        }
    });
};

construct();