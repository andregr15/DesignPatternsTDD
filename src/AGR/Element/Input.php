<?php
namespace AGR\Element;

class Input implements \AGR\Interfaces\ElementInterface{
    private $nome;
    private $valor;
    
    function __construct($nome, $valor){
        if(!isset($nome) || !is_string($nome)){
            throw new \InvalidArgumentException ('Parâmetro nome deve ser uma string!');
        }

        if(!isset($valor) || !is_string($valor)){
            throw new \InvalidArgumentException ('Parâmetro valor deve ser uma string!');
        }

        $this->nome = $nome;
        $this->valor = $valor;
    }

    function render(){
        return "<input type=\"submit\" name=\"{$this->nome}\" value=\"{$this->valor}\">";
    }
}
?>