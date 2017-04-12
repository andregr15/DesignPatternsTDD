<?php
namespace AGR\Element;

class ElementFacade implements \AGR\Interfaces\ElementInterface{

    private $elements;

    function __construct(){
        $this->elements = array();
    }

    function render(){
        $ret = '';
        foreach($this->elements as $element){
           $ret.=$element->render();
        }
        return $ret;
    }

    function addElements($dados){
        if(!is_array($dados)){
            throw new \InvalidArgumentException('Parâmetro dados deve ser do tipo array!');
        }

        foreach($dados as $dado){
            $this->elements[] = $this->createField($dado);
        }
    }

    private function createField($dado){
        if(!is_array($dado)){
            throw new \InvalidArgumentException('Parâmetro dado deve ser do tipo array!');
        }

        switch($dado['tipo']){
            case 'form':
                $form = new Form($dado['acao'], $dado['metodo']);
                if(isset($dado['itens'])){
                    foreach($dado['itens'] as $item){
                        $form->addItem($this->createField($item));
                    }
                }
                return $form;
                break;
            case 'fieldset':
                $fieldSet = new FieldSet();
                if(isset($dado['itens'])){
                    foreach($dado['itens'] as $item){
                        $fieldSet->addItem($this->createField($item));
                    }
                }
                return $fieldSet;
                break;
            case 'text':
                return new Text($dado['conteudo']);
                break;
            case 'textarea':
                return new TextArea($dado['linhas'], $dado['colunas'], $dado['conteudo']);
                break;
            case 'lista':
                $lista = new Lista();
                foreach($dado['itens'] as $item){
                    $lista->addItem($item);
                }
                return $lista;
                break;
            case 'select':
                $select = new Select();
                foreach($dado['itens'] as $item){
                    $select->addItem($item);
                }
                return $select;
                break;
            case 'input':
                return new Input($dado['nome'], $dado['valor']);
                break;
        }
    }


}
?>