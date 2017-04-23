<?php
namespace AGR\Element;

class Form implements \AGR\Interfaces\ElementInterface{

    private $acao;
    private $metodo;
    private $items;
    
    function __construct($acao, $metodo){
        if(!is_string($acao)){
            throw new \InvalidArgumentException('Parâmetro acao deve ser uma string não nula!');
        }

        if(!is_string($metodo)){
            throw new \InvalidArgumentException('Parâmetro metodo deve ser uma string não nula!');
        }
        $this->acao = $acao;
        $this->metodo = $metodo;
        $this->items = array();
    }

    function addItem($item){
        if(!$item instanceOf \AGR\Interfaces\ElementInterface){
            throw new \InvalidArgumentException('Parâmetro item deve ser um objeto do tipo ElementInterface!');
        }
        $this->items[]=$item;
    }

    function render(){
        $ret = "<form action=\"{$this->acao}\" method=\"{$this->metodo}\">";
        foreach($this->items as $item){
            $ret.=$item->render();
        }
        $ret.="</form>";
        return $ret;
    }
}
?>