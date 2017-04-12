<?php
namespace AGR\Element;
use AGR\Element\Select;

class SelectTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Select();
        $this->obj->addItem('valor1');
        $this->obj->addItem('valor2');
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Element\Select', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf('AGR\Interfaces\ElementInterface', $this->obj);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeMetodoAddItemException(){
        $this->obj->addItem(null);
    }

     /**
     * @expectedException Exception
     */
    function testeMetodoRenderException(){
        $element = new Select();
        $element->render();
    }


    function testeMetodoRender(){
        $this->assertEquals('<select><option value=\'valor1\'>valor1</option><option value=\'valor2\'>valor2</option></select><br>', $this->obj->render());
    }
}
?>