<?php
namespace AGR\Element;
use AGR\Element\ElementFacade;

class ElementFacadeTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $requestMock = $this->getMockBuilder("\AGR\Request\Request")->getMock();
        $validatorMock = $this->getMockBuilder("\AGR\Validator\Validator")->setConstructorArgs(['request'=>$requestMock])->getMock();
        $this->obj = new ElementFacade();
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
            array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
            array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
            array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor', 'type'=>'text')
        );

        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo"></form><fieldset></fieldset>conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item1</option><option value=\'item2\'>item2</option><option value=\'item3\'>item3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="nome" value="valor"><br>', $this->obj->render());
    }

    function testeAddElementsWithFormItensMethod(){
        $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'text', 'conteudo'=>'conteudo'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
                array('tipo'=>'input', 'nome'=>'texto', 'valor'=>'texto', 'type'=>'text')
                )
            )
        );
        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo">conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item1</option><option value=\'item2\'>item2</option><option value=\'item3\'>item3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="texto" value="texto"><br></form>', $this->obj->render());
    }

    function testeAddElementsWithFieldSetItensMethod(){
        $dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'fieldset', 'itens'=> array(
                    array('tipo'=>'text', 'conteudo'=>'conteudo'),
                    array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
                    array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                    array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                    array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor'),
                    array('tipo'=>'input', 'nome'=>'texto', 'valor'=>'texto', 'type'=>'text')
                    )
                )
                )
            )
        );
        $this->obj->addElements($dados);
        $this->assertEquals('<form action="acao" method="metodo"><fieldset>conteudo<br><textarea rows="10" cols="50">conteudo</textarea><br><ul><li>1</li><li>2</li><li>3</li></ul><select><option value=\'item1\'>item1</option><option value=\'item2\'>item2</option><option value=\'item3\'>item3</option></select><br><input type="submit" name="nome" value="valor"><br><input type="text" name="texto" value="texto"><br></fieldset></form>', $this->obj->render());
    }
}
?>