<?php


namespace core\controller;

// use core\model\Evento;
use core\model\Trabalho;

class Trabalhos
{


    private $idTrabalho = null;
    private $titulo = null;
    private $autores = null;
    private $statuImpressao = null;
    private $statusPagamento = null;
    private $caminhoTrabalho = null;
    private $codigoTrabalho = null;
    private $dataHora = null;

    private $lista_trabalhos = [];

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }


    /**
     * Efetua o cadastro do trabalho no sistema, porém não tanto, já que todos os titulos e autores estão pre-cadastrados,
     * No caso esse método apenas adiciona ao banco o caminho do arquivo enviado e os status
     */
    public function atualizarDados($dados) {
        $trabalho = new Trabalho();

        if (isset($dados['caminhoTrabalho'])) {
            $pasta  = 'arquivos/';
            $extensao = "." . pathinfo($dados['caminhoTrabalho'], PATHINFO_EXTENSION);
            $novoNome = time() . md5(uniqid());
            $arquivoServidor = $pasta . $novoNome . $extensao;
            
            echo "<pre>" . print_r($dados) . "</pre>";

            if (move_uploaded_file($dados['tmp'], $arquivoServidor)) {
                $dados[Trabalho::COL_CAMINHO_TRABALHO] = $arquivoServidor;
                unset($dados['tmp']);


                $trabalho->alterar($dados);
                
                echo "foi desgraçaaaaaaaaaaaaaaa";

                return $trabalho;
            }
        }

        
    }

    public function listarTrabalhos($dados = []) {
        $trabalho = new Trabalho();

        $busca = isset($dados['busca']) ? $dados['busca'] : [];

        $lista = $trabalho->listar(null, $busca, Trabalho::COL_TITULO . " ASC ");
        $lista = $trabalho->listar(null, $busca, Trabalho::COL_TITULO . " ASC");

        
        if (count($lista) > 0) {
            $this->__set("lista_trabalhos", $lista);       
        }

        return [
            "lista_trabalhos" => $this->lista_trabalhos
        ];
    }

}
