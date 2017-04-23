<?php
namespace AGR\Element;

class Form implements \AGR\Interfaces\ElementInterface{

    private $acao;
    private $metodo;
    private $items;
    private $validator;

    function __construct($acao, $metodo, \AGR\Validator\Validator $validator){
        if(!is_string($acao)){
            throw new \InvalidArgumentException('Parâmetro acao deve ser uma string não nula!');
        }

        if(!is_string($metodo)){
            throw new \InvalidArgumentException('Parâmetro metodo deve ser uma string não nula!');
        }
        $this->acao = $acao;
        $this->metodo = $metodo;
        $this->items = array();
        $this->validator = $validator;
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

    function populate($dados){
        $this->validator->validateProduto($dados);
        
        if(count($this->validator->getErros()) != 0) return;

        $produto = new \AGR\Model\Produto();
        $produto->setNome($dados['nome']);
        $produto->setDescricao($dados['descricao']);
        $produto->setValor($dados['valor']);
        $produto->setCategoria($dados['categoria']);

        $this->addProduto($produto);
    }

    function getErros(){
        return $this->validator->getErros();
    }

    private function addProduto(\AGR\Model\Produto $produto){
        $fieldSet = new FieldSet();
        $fieldSet->addItem(new Text('Nome: '));
        $fieldSet->addItem(new Input('nome', $produto->getNome(), 'text'));
        $fieldSet->addItem(new Text('Valor: '));
        $fieldSet->addItem(new Input('valor', number_format($produto->getValor(), 2), 'text'));
        $fieldSet->addItem(new Text('Descrição: '));
        $fieldSet->addItem(new TextArea(50, 100, $produto->getDescricao()));
        $fieldSet->addItem(new Text('Forma de Venda: '));

        $select = new Select();
        $select->addItem(array('valor'=>'unitario', 'conteudo'=>'Unitário'));
        $fieldSet->addItem($select);

        $this->addItem($fieldSet);
    }
}
?>