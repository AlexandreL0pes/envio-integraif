const url_origem = window.location.pathname.split('/');
const home_url = `${window.location.origin}/${url_origem[1]}/${url_origem[2]}/${url_origem[3]}`;

let construct = () => {
    eventos();
    eventos2();
};

const eventos = () => {
    const filtrar = $('#filtrar');
    const autores = $('#autores');
    const pagamento = $('#pagamento');
    const impressao = $('#impressao');
    const dados = {};

    pagamento.on('change', (e) => {
        dados.pagamento = e.target.selectedOptions[0].value;
    });

    impressao.on('change', (e) => {
        dados.impressao = e.target.selectedOptions[0].value;
    });

    filtrar.on('submit', (e) => {
        e.preventDefault();

        if (autores.val() !== "") dados.autores = autores.val();
        if (pagamento[0].value != 10) dados.pagamento = pagamento[0].value;
        if (impressao[0].value != 10) dados.impressao = impressao[0].value;

        console.log(dados);
        
        if (Object.keys(dados).length > 0) {
            let link = home_url;
            let contador = 0;

            $.each(dados, (i, v) => {
                if (contador === 0) {
                    link += '?';
                    link += `${i}=${v}`;
                } else {
                    link += `&${i}=${v}`;
                }

                contador++;
            });

            window.location.href = link;
        }
    })
};

const eventos2 = () => {
    $('#formulario').on('submit', function (e) {
        e.preventDefault(); 

        let pagamento = $('#statusPagamento'),
            impressao = $('#statusImpressao');
    
        pagamento.on('change', (e) => {
            pagamento = e.target.selectedOptions[0].value;
        });
    
        impressao.on('change', (e) => {
            impressao = e.target.selectedOptions[0].value;
        });   

        let statusPagamento = pagamento[0].value,
            statusImpressao = impressao[0].value,
            idTrabalho = $('#tr').attr('data-idTrabalho');     
        
        if (idTrabalho != "") {
            let dados = {
                statusPagamento: statusPagamento,
                statusImpressao: statusImpressao,
                idTrabalho: idTrabalho,
                acao: "Trabalhos/atualizarDados"
            };
            
            console.log(dados);  
            
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
                        // alert(res);
                        window.location = "trabalhos.php";
                        $('#formulario').each(function () {
                            this.reset(); // Pra limpar o formulário
                        });
                    } else {
                        alert("Não FOi" + res);
                        // $('#msg_alerta').toast('show');
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
