<?php
namespace AGR\Element;
use AGR\Element\Lista;

class ListaTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Lista();
        $this->obj->addItem('valor1');
        $this->obj->addItem('valor2');
    }

    function tearDown(){
        $this->obj = null;
    }

    public function testeTipoObjeto(){
        $this->assertInstanceOf("\AGR\Element\Lista", $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf("\AGR\Interfaces\ElementInterface", $this->obj);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeMetodoAddItemListaException(){
        $this->obj->addItem(null);
    }

     /**
     * @expectedException Exception
     */
    function testeMetodoRenderException(){
        $element = new Lista();
        $element->render();
    }

    function testeMetodoRender(){
        $this->assertEquals('<ul><li>valor1</li><li>valor2</li></ul>', $this->obj->render());
    }
}
?>