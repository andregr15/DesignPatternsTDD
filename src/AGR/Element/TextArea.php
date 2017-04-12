<?php
namespace AGR\Element;

class TextArea implements \AGR\Interfaces\ElementInterface{ 
    
    private $linhas;
    private $colunas;
    private $conteudo;

    function __construct($linhas, $colunas, $conteudo){
        if(!is_int($linhas)){
            throw new \InvalidArgumentException ('Parâmetro linhas deve ser um número inteiro!');
        }

        if(!is_int($colunas)){
            throw new \InvalidArgumentException ('Parâmetro colunas deve ser um número inteiro!');
        }

        $this->linhas = $linhas;
        $this->colunas = $colunas;
        $this->conteudo = $conteudo;
    }

    function render(){
        return "<textarea rows=\"{$this->linhas}\" cols=\"{$this->colunas}\">{$this->conteudo}</textarea><br>";
    }
}
?>