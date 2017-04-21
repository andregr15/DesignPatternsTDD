<?php
namespace AGR\Element;

class FieldSetTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new FieldSet();
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('\AGR\Element\FieldSet', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf('\AGR\Interfaces\ElementInterface', $this->obj);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeMetodoAddItemException(){
        $this->obj->addItem(null);
        $this->obj->addItem('a');
    }

    function testeUnitarioRenderMethod(){
        $this->assertEquals('<fieldset></fieldset>', $this->obj->render());

        $textMock = $this->getMockBuilder('AGR\Element\Text')->setConstructorArgs(['conteudo'=>'conteudo: <br>'])->getMock();
        $textMock->method('render')->willReturn('conteudo: <br>');
        $this->obj->addItem($textMock);

        $inputMock = $this->getMockBuilder('AGR\Element\Input')->setConstructorArgs(['nome'=> 'salvar', 'valor'=>'Salvar'])->getMock();
        $inputMock->method('render')->willReturn('<input type="submit" name="salvar" value="Salvar"><br>');
        $this->obj->addItem($inputMock);

        $this->assertEquals('<fieldset>conteudo: <br><input type="submit" name="salvar" value="Salvar"><br></fieldset>', $this->obj->render());
    }

     function testeFuncionalRenderMethod(){
        $this->assertEquals('<fieldset></fieldset>', $this->obj->render());

        $text = new Text('conteudo: ');
        $this->obj->addItem($text);

        $input = new Input('salvar', 'Salvar');
        $this->obj->addItem($input);

        $this->assertEquals('<fieldset>conteudo: <br><input type="submit" name="salvar" value="Salvar"><br></fieldset>', $this->obj->render());
    }
}
?>