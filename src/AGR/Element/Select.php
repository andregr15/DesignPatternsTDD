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

        if(!is_array($item)){
            throw new \InvalidArgumentException('Parâmetro item deve ser do tipo array!');
        }

        if(!isset($item['valor']) || !isset($item['conteudo'])){
            throw new \InvalidArgumentException('Parâmetro item deve conter os campos valor e conteudo preenchidos!');
        }

        $this->items[]=$item;
    }

    function render(){
        if(!isset($this->items) || count($this->items) == 0){
            throw new \Exception('Select sem itens!');
        }
        
        $ret = '<select>';
        foreach($this->items as $item){
            $ret.="<option value='{$item['valor']}'>{$item['conteudo']}</option>";
        }
        $ret.='</select><br>';
        return $ret;
    }
}
?>