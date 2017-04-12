<?php
namespace AGR\Element;

class FieldSet implements \AGR\Interfaces\ElementInterface{
    
    private $items;

    function __construct(){
        $this->items = array();
    }

    function addItem($elemento){
        if(!is_a($elemento, 'AGR\Interfaces\ElementInterface')){
            throw new \InvalidArgumentException('Parâmetro elemento deve ser do tipo ElementInterface!');
        }
        $this->items[] = $elemento;
    }

    function render(){
        $ret = '<fieldset>';

        foreach($this->items as $item){
            $ret .= $item->render();
        }

        $ret .= '</fieldset>';
        return $ret;
    }
}
?>