let construct = () => {
    eventos();
};

const eventos = () => {
    
    $('#formulario').on('submit', function (e) {
        e.preventDefault();       

        let titulo = $('#titulo').val(),
            autores = $('#autores').val(),
            modalidade = $('#modalidade').val(),
            arquivo = $('#arquivo').prop('files')[0],
            idUsuario = $('#formulario').attr('data-idUsuario');     
        
        if (titulo !== "" &&
            autores !== "" &&
            modalidade !== "" &&
            arquivo !== ""
        ) {
            
            var form_data = new FormData();
            
            let dNow = new Date();
            datahora = "'" + dNow.getFullYear() + "-" + (dNow.getMonth()+1) + "-" + dNow.getDate() + " " + 
            dNow.getHours() + ":" + dNow.getMinutes()  + ":" + dNow.getSeconds() + "'";

            form_data.append('titulo', titulo);
            form_data.append('statusImpressao', 1);
            form_data.append('statusPagamento', 2);
            form_data.append('datahora', datahora);
            form_data.append('caminhoTrabalho', arquivo);
            form_data.append('idUsuario', idUsuario);
            
            console.log(form_data);            

            $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response) {
                    alert(php_script_response); // display response from the PHP script, if any
                }
            });
            
            /*
            
            let dados = {
                titulo: titulo,
                statusImpressao: null,
                caminhoTrabalho: arquivo,
                statusPagamento: null, 
                datahora: null
            };

            if(idUsuario > 0){
                dados.idUsuario = idUsuario;
                dados.acao = "Trabalhos/atualizarDados";
            } else{
                dados.acao = "Usuarios/cadastrar";
            }
            
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
                        alert(res);
                        // window.location = "trabalhos.php";
                        // $('#formulario').each(function () {
                        //     this.reset(); // Pra limpar o formulário
                        // });
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
        }*/
        }
    });
};

construct();