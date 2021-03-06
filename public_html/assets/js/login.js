let construct = () => {
    eventos();
};

const eventos = () => {
    $('#botao_login').on('click', function (e) {
        e.preventDefault();

        let email = $('#email').val(),
            senha = $('#senha').val();

        if (email !== "" && senha !== "") {

            let dados = {
                email: email,
                senha: senha,
                lembrar: $('#lembrar').is(':checked')
            };

            dados.acao = "Login/login";

            $.ajax({
                url: baseUrl,
                type: "POST",
                data: dados,
                dataType: "text",
                async: true,
                success: function (res) {
                    if (res && res === '1') {
                        // $('#msg_sucesso').toast('show'); // Para aparecer a mensagem de sucesso
                        // alert("Logou");
                        window.location.href = './trabalhos.php';
                    } else {
                        alert('Usuário/senha inválidos!');
                        // $('#msg_erro').toast('show');
                    }
                },
                error: function (request, status, str_error) {
                    console.log(request, status, str_error);
                }
            });
        }
    });

    $('#botao_senha').on('click', function (e) {
        e.preventDefault();

        let cpf = $('#cpf').val();

        if (cpf !== "") {
            let dados = {
                cpf: cpf,
                usuario_id: "alterar"
            };

            dados.acao = "Usuarios/cadastrar";

            $.ajax({
                url: baseUrl,
                type: "POST",
                data: dados,
                dataType: "text",
                async: true,
                success: function (res) {
                    if (res) {
                        $('#msg_sucesso').toast('show');
                    } else {
                        console.log(res);
                        $('#msg_erro').toast('show');
                    }
                },
                error: function (request, status, str_error) {
                    console.log(request, status, str_error);
                }
            });
        } else {
            $('#msg_alerta').toast('show');
        }
    });
};

construct();
