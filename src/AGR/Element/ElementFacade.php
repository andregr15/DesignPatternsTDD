<?php
namespace AGR\Element;
use AGR\Validator\Validator;

class ElementFacade implements \AGR\Interfaces\ElementInterface{

    private $elements;
    private $validator;
    private $categorias;

    function __construct(Validator $validator){
        $this->elements = array();
        $this->validator = $validator;
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
        
        if(isset($dados['categorias']) && count($dados['categorias']) > 0){
            $this->categorias = $dados['categorias'];
        }

        $this->addProduto($produto);
    }

    function getErros(){
        return $this->validator->getErros();
    }

    private function addProduto(\AGR\Model\Produto $produto){
       $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=> array(
                array('tipo'=>'fieldset', 'itens'=> array(
                        array('tipo'=>'text', 'conteudo'=>'Nome: '),
                        array('tipo'=>'input', 'type'=>'text', 'nome'=>'nome', 'valor'=>strval($produto->getNome())),
                        array('tipo'=>'text', 'conteudo'=>'Valor: '),
                        array('tipo'=>'input', 'type'=>'text', 'nome'=>'valor', 'valor'=>number_format($produto->getValor(), 2)),
                        array('tipo'=>'text', 'conteudo'=>'Descrição: '),
                        array('tipo'=>'textarea', 'linhas'=>50, 'colunas'=>100, 'conteudo'=>strval($produto->getDescricao())),
                        array('tipo'=>'text', 'conteudo'=>'Forma de Venda: ')
                        )
                    )
                )
            )
       );
  
        if(isset($this->categorias)){
            $cats = array();
            foreach($this->categorias as $categoria){
                $cats[] =  array('valor'=>$categoria['valor'], 'conteudo'=>$categoria['conteudo']);
            }

           $dados[0]['itens'][0]['itens'][] = array('tipo'=>'select', 'itens'=>$cats);
        }
        
        $erros = $this->getErros();

        if(count($erros) > 0){
            $errs = array();
            foreach($erros as $erro){
                $errs[] = $erro;
            }

            $dados[0]['itens'][0]['itens'][] = array('tipo'=>'lista', 'itens'=>$errs);
        }
       
        $this->addElements($dados);
    }

}
?>