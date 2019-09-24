<?php
use core\CRUD;
use core\model\Usuario;
class Teste extends CRUD {
    public function inserir() {
        $dados = [
            "nome" => "Marco Aurélio",
            "cpf" => "012.345.678-90",
            "senha" => "1234",
            "email" => "teste@teste.com",
            "data_nascimento" => "2000-01-01",
            "telefone" => "(62) 9 9999-9999",
            "endereco" => "Rua 01",
            "bairro" => "Centro",
            "estado" => "GO",
            "cidade" => "Ceres",
            "cep" => "76.300-000",
            "nacionalidade" => "Brasileiro",
            "ocupacao" => "Programador",
            "admin" => 1
        ];
        $retorno = $this->create("usuario", $dados);
        echo "<pre>";
        print_r($this->pegarUltimoSQL());
        print_r("\n" . $retorno);
        echo "</pre>";
    }
    public function atualizar() {
        $dados = [
            "usuario_id" => 3,
            "nome" => "Marco Aurélio",
            "cpf" => "036.566.561-42",
            "senha" => "123456",
            "email" => "teste@teste.com",
            "data_nascimento" => "1992-09-12",
            "telefone" => "(62) 9 9999-9999",
            "endereco" => "Rua 01",
            "bairro" => "Centro",
            "estado" => "GO",
            "cidade" => "Ceres",
            "cep" => "76.300-000",
            "nacionalidade" => "Brasileiro",
            "ocupacao" => "Programador",
            "admin" => 1
        ];
        $where_condicao = "usuario_id = ?";
        $where_valor[] = 3;
        $retorno = $this->update("usuario", $dados, $where_condicao, $where_valor);
        echo "<pre>";
        print_r($this->pegarUltimoSQL());
        print_r("\n" . $retorno);
        echo "</pre>";
    }
    public function deletar() {
        $where_condicao = "usuario_id = ?";
        $where_valor[] = 5;
        $retorno = $this->delete("usuario", $where_condicao, $where_valor);
        echo "<pre>";
        print_r($this->pegarUltimoSQL());
        print_r("\n" . $retorno);
        echo "</pre>";
    }
    public function selecionar() {
        $campos = "*";
//        $campos = "nome, email";
//        $where_condicao = "admin = ?";
        $where_condicao = "";
//        $where_valor = [0];
        $where_valor = [];
//
//        $ordem = "senha DESC";
        $ordem = null;
//        $limite = 3;
        $limite = null;
//        $group_by = "nome";
        $group_by = null;
        $retorno = $this->read("usuario", $campos, $where_condicao, $where_valor, $group_by, $ordem, $limite);
        echo "<pre>";
        print_r($this->pegarUltimoSQL() . "\n");
        print_r($retorno);
        echo "</pre>";
    }
    public function listar() {
        $usuario = new Usuario();
        $retorno = $usuario->listar();
        return $retorno;
    }
}