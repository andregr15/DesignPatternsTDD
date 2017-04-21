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

    function testeUnitarioMetodoRender(){
        $this->assertEquals('<form action="acao" method="metodo"></form>', $this->obj->render());
        
        $textMock = $this->getMockBuilder('AGR\Element\Text')->setConstructorArgs(['conteudo'=>'conteudo: '])->getMock();
        $textMock->method('render')->willReturn('conteudo: <br>');
        $this->obj->addItem($textMock);

        $inputMock = $this->getMockBuilder('AGR\Element\Input')->setConstructorArgs(['nome'=>'nome', 'valor'=>'valor'])->getMock();
        $inputMock->method('render')->willReturn('<input type="submit" name="nome" value="valor"><br>');
        $this->obj->addItem($inputMock);

        $this->assertEquals('<form action="acao" method="metodo">conteudo: <br><input type="submit" name="nome" value="valor"><br></form>', $this->obj->render());
    }

    function testeFuncionalMetodoRender(){
        $this->assertEquals('<form action="acao" method="metodo"></form>', $this->obj->render());
        
        $text = new Text('conteudo: ');
        $this->obj->addItem($text);

        $input = new Input('nome', 'valor');
        $this->obj->addItem($input);

        $this->assertEquals('<form action="acao" method="metodo">conteudo: <br><input type="submit" name="nome" value="valor"><br></form>', $this->obj->render());
    }
}
?>