<?php
namespace AGR\Element;

class ElementFacade implements \AGR\Interfaces\ElementInterface{

    private $elements, $validator, $categorias;

    function __construct(AGR\Validator\Validator $validator){
        $this->elements = array();
        $this->validator = $validador;
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
                $form = new Form($dado['acao'], $dado['metodo'], new \AGR\Validator\Validator(new \AGR\Request\Request()));
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
                return isset($dado['type']) ? new Input($dado['nome'], $dado['valor'], $dado['type']) : 
                                              new Input($dado['nome'], $dado['valor']);
                break;
        }
    }

function populate($dados){
        $this->validator->validateProduto($dados);
        
        $produto = new \AGR\Model\Produto();

        if(count($this->validator->getErros()) == 0){
            $produto->setNome($dados['nome']);
            $produto->setDescricao($dados['descricao']);
            $produto->setValor($dados['valor']);
        }

        $produto->setCategoria(isset($dados['categoria']) ? $dados['categoria'] : 'Unitário');
        
        if(isset($dados['categorias']) && count($dados['categorias'])){
            $this->categorias = new Select();
            foreach($dados['categorias'] as $categoria){
                $this->categorias->addItem($categoria);
            }
        }

        $this->addProduto($produto);
    }

    function getErros(){
        return $this->validator->getErros();
    }

    private function addProduto(\AGR\Model\Produto $produto){
        $form = new Form('acao', 'metodo');
        $fieldSet = new FieldSet();
        $fieldSet->addItem(new Text('Nome: '));
        $fieldSet->addItem(new Input('nome', strval($produto->getNome()), 'text'));
        $fieldSet->addItem(new Text('Valor: '));
        $fieldSet->addItem(new Input('valor', number_format($produto->getValor(), 2), 'text'));
        $fieldSet->addItem(new Text('Descrição: '));
        $fieldSet->addItem(new TextArea(50, 100, strval($produto->getDescricao())));
        $fieldSet->addItem(new Text('Forma de Venda: '));
  
        $fieldSet->addItem($this->categorias);

        $erros = $this->getErros();

        if(count($erros) > 0){
            $lista = new Lista();
            foreach($erros as $erro){
                $lista->addItem($erro);
            }
            $fieldSet->addItem($lista);
        }
        $form->addItem($fieldSet);
        $this->addItem($form);
    }

}
?>