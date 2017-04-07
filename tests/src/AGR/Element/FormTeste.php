<?php
namespace AGR\Element;
use AGR\Element\Form;

class FormTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Form('acao', 'metodo');
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Element\Form', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf('AGR\Interfaces\ElementInterface', $this->obj);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeMetodoAddItemException(){
        $this->obj->addItem(null);
        $this->obj->addItem('a');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeConstrutorParametroAcaoException(){
        $this->obj = new Form(null, null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeConstrutorParametroMetodoException(){
        $this->obj = new Form('acao', null);
    }

    function testeMetodoRenderComMock(){
        $this->assertEquals('<form action="acao" method="metodo"></form>', $this->obj->render());
        
        $textMock = $this->getMockBuilder('AGR\Element\Text')->setConstructorArgs(['conteudo'=>'conteudo: '])->getMock();
        $textMock->method('render')->willReturn('conteudo: ');
        $this->obj->addItem($textMock);

        $inputMock = $this->getMockBuilder('AGR\Element\Input')->setConstructorArgs(['nome'=>'nome', 'valor'=>'valor'])->getMock();
        $inputMock->method('render')->willReturn('<input type="submit" name="nome" value="valor"/>');
        $this->obj->addItem($inputMock);

        $this->assertEquals('<form action="acao" method="metodo">conteudo: <input type="submit" name="nome" value="valor"/></form>', $this->obj->render());
    }
}
?>