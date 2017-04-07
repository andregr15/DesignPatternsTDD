<?php
namespace AGR\Element;

class Select implements \AGR\Interfaces\ElementInterface{

    private $items;

    function __construct(){
        $this->items = array();
    }

    function addItem($item){
        if(!isset($item)){
            throw new \InvalidArgumentException('Parâmetro item não pode ser nulo!');
        }
        $this->items[]=$item;
    }

    function render(){
        if(!isset($this->items) || count($this->items) == 0){
            throw new \Exception('Select sem itens!');
        }
        
        $ret = '<select>';
        foreach($this->items as $item){
            $ret.="<option value='{$item}'>{$item}</option>";
        }
        $ret.='</select>';
        return $ret;
    }
}
?>