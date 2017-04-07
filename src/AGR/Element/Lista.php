<?php
namespace AGR\Element;

class Lista implements \AGR\Interfaces\ElementInterface{

    private $items;

    function __construct(){
        $this->items = array();
    }

    function addItem($item){
        if(!isset($item)){
            throw new \InvalidArgumentException('Parâmetro item não pode ser nulo!');
        }
        $this->items[] = $item;
    }

    function render(){
        if(!isset($this->items) || count($this->items) == 0){
            throw new \Exception('Lista sem itens!');
        }

        $ret = '<ul>';
        foreach($this->items as $item) {
            $ret.="<li>{$item}</li>";
        }
        $ret.='</ul>';
        return $ret;
    }
}

?>