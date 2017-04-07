<?php
namespace AGR\Element;
use AGR\Element\Text;

class TextTeste extends \PHPUnit_Framework_TestCase{
    
    private $obj;

    function setUp(){
        $this->obj = new Text('conteudo');
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Element\Text', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf("AGR\Interfaces\ElementInterface", $this->obj);
    }
    
     /**
     * @expectedException InvalidArgumentException
     */
    function testeParametroConteudo(){
        $element = new Text(null);
    }

    function testeMetodoRender(){
        $this->assertEquals('conteudo', $this->obj->render());
    }
}
?>