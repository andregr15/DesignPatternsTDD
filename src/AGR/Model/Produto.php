<?php
namespace AGR\Model;

class Produto{

    private $nome, $descricao, $valor, $categoria;

    function setNome($nome){
        if(!isset($nome) || strlen($nome) == 0){
            throw new \InvalidArgumentException('Parâmetro nome não pode ser nulo ou em branco!');
        }
        $this->nome = $nome;
    }

    function getNome(){
        return $this->nome;
    }

    function setDescricao($descricao){
        if(strlen($descricao) > 200){
            throw new \InvalidArgumentException('Parâmetro descricação deve ter um comprimento máximo de 200 caracteres!');
        }
        $this->descricao = $descricao;
    }

    function getDescricao(){
        return $this->descricao;
    }

    function setValor($valor){
        if(!is_numeric($valor) && $valor >= 0){
            throw new \InvalidArgumentException('Parâmetro valor deve ser um número positivo!');
        }
        $this->valor = $valor;
    }

    function getValor(){
        return $this->valor;
    }

    function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    
}
?>