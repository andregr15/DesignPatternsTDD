<?php
namespace AGR\Element;

class Text implements \AGR\Interfaces\ElementInterface{
    private $conteudo;

    function __construct($conteudo){
        if(!isset($conteudo)){
            throw new \InvalidArgumentException('Parâmetro conteúdo não pode nulo!');
        }
        $this->conteudo = $conteudo;
    }

    function render(){
        return $this->conteudo;
    }
}
?>