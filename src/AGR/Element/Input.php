<?php
namespace AGR\Element;

class Input implements \AGR\Interfaces\ElementInterface{
    private $nome;
    private $valor;
    private $tipo;
    
    function __construct($nome, $valor, $tipo ='submit'){
        if(!isset($nome) || !is_string($nome)){
            throw new \InvalidArgumentException ('Parâmetro nome deve ser uma string!');
        }

        if(!isset($valor) || !is_string($valor)){
            throw new \InvalidArgumentException ('Parâmetro valor deve ser uma string!');
        }

        $this->nome = $nome;
        $this->valor = $valor;
        $this->tipo = $tipo;
    }

    function render(){
        return "<input type=\"{$this->tipo}\" name=\"{$this->nome}\" value=\"{$this->valor}\"><br>";
    }
}
?>