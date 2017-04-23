<?php
namespace AGR\Element;
use AGR\Element\ElementFacade;

class ElementFacadeTeste extends \PHPUnit_Framework_TestCase{
    private $obj, $objMock, $requestMock, $validatorMock;

    function setUp(){
        $request = new Request();
        $validator = new Validator($request);
        $this->obj = new ElementFacade($validator);

        $this->requestMock = $this->getMockBuilder('AGR\Request\Request')->getMock();
        $this->validatorMock = $this->getMockBuilder('AGR\Validator\Validator')->setConstructorArgs(['request'=>$this->requestMock])->getMock();
        $this->validatorMock->method('validateProduto')->willReturn(null);
        $this->validatorMock->method('getErros')->willReturn(array());
        $this->objMock = new ElementFacade($this->validatorMock);
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('\AGR\Element\ElementFacade', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf('\AGR\Interfaces\ElementInterface', $this->obj);
    }

    function testeMetodoRender(){
        $this->AssertEquals('', $this->obj->render());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeAddElementsMethodException(){
        $dados = null;
        $this->obj->addElements($dados);
    }

    function testeAddElementsMethod(){
        $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo'),
            array('tipo'=>'fieldset'),
            array('tipo'=>'text', 'conteudo'=>'conteudo'),
            array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
            array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
            array('tipo'=>'select', 'itens'=>array(array('valor'=>'item1', 'conteudo'=>'item 1'), array('valor'=>'item2', 'conteudo'=>'item 2'), array('valor'=>'item3', 'conteudo'=>'item 3'))),
            array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
            array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor', 'type'=>'text')
        );

        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo"></form><fieldset></fieldset>conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item 1</option><option value=\'item2\'>item 2</option><option value=\'item3\'>item 3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="nome" value="valor"><br>', $this->obj->render());
    }

    function testeAddElementsWithFormItensMethod(){
        $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'text', 'conteudo'=>'conteudo'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array(array('valor'=>'item1', 'conteudo'=>'item 1'), array('valor'=>'item2', 'conteudo'=>'item 2'), array('valor'=>'item3', 'conteudo'=>'item 3'))),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
                array('tipo'=>'input', 'nome'=>'texto', 'valor'=>'texto', 'type'=>'text')
                )
            )
        );
        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo">conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item 1</option><option value=\'item2\'>item 2</option><option value=\'item3\'>item 3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="texto" value="texto"><br></form>', $this->obj->render());
    }

    function testeAddElementsWithFieldSetItensMethod(){
        $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'fieldset', 'itens'=> array(
                    array('tipo'=>'text', 'conteudo'=>'conteudo'),
                    array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
                    array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                    array('tipo'=>'select', 'itens'=>array(array('valor'=>'item1', 'conteudo'=>'item 1'), array('valor'=>'item2', 'conteudo'=>'item 2'), array('valor'=>'item3', 'conteudo'=>'item 3'))),
                    array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
                    array('tipo'=>'input', 'nome'=>'texto', 'valor'=>'texto', 'type'=>'text')
                    )
                )
                )
            )
        );
        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo"><fieldset>conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item 1</option><option value=\'item2\'>item 2</option><option value=\'item3\'>item 3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="texto" value="texto"><br></fieldset></form>', $this->obj->render());
    }

    function testeUnitarioPopulateProduto(){
        $dados = array(
            'nome'=>'produto 1',
            'descricao' => 'descricao produto 1',
            'valor' => 150.00,
            'categoria' => 'unitário'
        );

        $this->objMock->populate($dados);
        $this->assertEquals(array(), $this->objMock->getErros());

        $dados = array(
            'descricao' => str_pad('', 202, 'a'),
            'valor' => 'a',
            'categoria' => 'unitário'
        );

        $this->validatorMock = $this->getMockBuilder('AGR\Validator\Validator')->setConstructorArgs(['request'=>$this->requestMock])->getMock();
        $this->validatorMock->method('validateProduto')->willReturn(null);
        $this->validatorMock->method('getErros')->willReturn(array(
            'O nome do produto é obrigatório!',
            'A descrição deve ter no máximo 200 caracteres!',
            'O valor deve ser um número positivo!'
        ));

        $this->objMock = new ElementFacade($this->validatorMock);

        $this->objMock->populate($dados);
        $this->assertEquals(array(
            'O nome do produto é obrigatório!', 
            'A descrição deve ter no máximo 200 caracteres!',
            'O valor deve ser um número positivo!'
            ), $this->objMock->getErros());
    }

    function testeFuncionalPopulateProduto(){
        $dados = array(
            'nome'=>'produto 1',
            'descricao' => 'descricao produto 1',
            'valor' => 150.00,
            'categoria' => 'unitário'
        );

        $this->obj->populate($dados);
        $this->assertEquals(array(), $this->obj->getErros());

        $dados = array(
            'descricao' => str_pad('', 202, 'a'),
            'valor' => 'a',
            'categoria' => 'unitário'
        );

        $this->obj->populate($dados);
        $this->assertEquals(array(
            'O nome do produto é obrigatório!', 
            'A descrição deve ter no máximo 200 caracteres!',
            'O valor deve ser um número positivo!'
            ), $this->obj->getErros());
    }

    function testeFuncionalRenderWithProduto(){
         $dados = array(
            'nome'=>'produto 1',
            'descricao' => 'descrição produto 1',
            'valor' => 150.10,
            'categoria' => 'unitário'
        );

        $this->obj->populate($dados);
        $this->assertEquals('<form action="acao" method="metodo"><fieldset>Nome: <br><input type="text" name="nome" value="produto 1"><br>Valor: <br><input type="text" name="valor" value="150.10"><br>Descrição: <br><textarea rows="50" cols="100">descrição produto 1</textarea><br>Forma de Venda: <br><select><option value=\'unitario\'>Unitário</option></select><br></fieldset></form>', $this->obj->render());
    }

    function testeFuncionalRenderWithErroProduto(){
         $dados = array(
            'descricao' => str_pad('', 202, 'a'),
            'valor' => 'a',
            'categoria' => 'unitário'
        );

        $this->obj->populate($dados);
        $this->assertEquals('<form action="acao" method="metodo"><fieldset>Nome: <br><input type="text" name="nome" value=""><br>Valor: <br><input type="text" name="valor" value="0.00"><br>Descrição: <br><textarea rows="50" cols="100"></textarea><br>Forma de Venda: <br><select><option value=\'unitario\'>Unitário</option></select><br><ul><li>O nome do produto é obrigatório!</li><li>A descrição deve ter no máximo 200 caracteres!</li><li>O valor deve ser um número positivo!</li></ul></fieldset></form>', $this->obj->render());
    }
}
?>