<?php

namespace core\model;

use core\CRUD;
use Exception;

class Trabalho extends CRUD
{

    const TABELA = "trabalho";
    const COL_ID_TRABALHO = "idTrabalho";
    const COL_TITULO = "titulo";
    const COL_AUTORES = "autores";
    const COL_STATUS_IMPRESSAO = "statusImpressao";
    const COL_CAMINHO_TRABALHO = "caminhoTrabalho";
    const COL_CODIGO_TRABALHO = "codigoTrabalho";
    const COL_STATUS_PAGAMENTO = "statusPagamento";
    const COL_DATA_HORA = "dataHora";
    const COL_ID_AREA_TEMATICA = "idAreaTematica";
    const COL_ID_MODALIDADE = "idModalidade";
    const COL_ID_USUARIO = "idUsuario";

    public function adicionar($dados)
    {
        try {
            $retorno = $this->create(self::TABELA, $dados);
        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
            return false;
        }

        return $retorno;
    }

    public function alterar($dados)
    {

        if (!isset($dados[self::COL_ID_TRABALHO])) {
            throw new Exception("É necessário informar o ID do trabalho para atualizar");
        }

        $where_condicao = self::COL_ID_TRABALHO . " = ?";
        $where_valor[] = $dados[self::COL_ID_TRABALHO];

        try {
            $this->update(self::TABELA, $dados, $where_condicao, $where_valor);
        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
            return false;
        }

        return $dados[self::COL_ID_TRABALHO];
    }

    public function listar($campos = [], $busca = [], $ordem = null, $limite = null)
    {
        $campos = $campos != null ? $campos : "*";
        $ordem = $ordem != null ? $ordem : self::COL_TITULO . " ASC";

        // $where_condicao = "trabalho." . self::COL_ID_USUARIO . " != "; // Pode pra listar apenas os que não foram submetidos
        $where_condicao = "1 = 1";
        $where_valor = [];

        if (count($busca) > 0) {

            if (isset($busca['texto']) && !empty($busca['texto'])) {
                $where_condicao .= " AND (" . self::COL_TITULO . " LIKE ? OR " . self::COL_AUTORES . " LIKE ?)";
                $where_valor[] = "%{$busca['texto']}%";
                $where_valor[] = "%{$busca['texto']}%";
            }

            if (isset($busca['statusImpressao']) && !empty($busca['statusImpressao'])) {
                $where_condicao .= " AND " . self::COL_STATUS_IMPRESSAO . " = ?";
                $where_valor[] = $busca['statusImpressao'];
            }

            if (isset($busca['statusPagamento']) && !empty($busca['statusPagamento'])) {
                $where_condicao .= " AND " . self::COL_STATUS_PAGAMENTO . " = ?";
                $where_valor = $busca['statusPagamento'];
            }
        }

        $retorno = [];        

        try {
            $retorno = $this->read(self::TABELA . " t ", $campos, $where_condicao, $where_valor, null, $ordem, $limite);
        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
        }

        return $retorno;
    }
}
