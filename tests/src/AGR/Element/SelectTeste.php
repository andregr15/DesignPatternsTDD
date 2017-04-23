<?php
namespace AGR\Element;
use AGR\Element\Select;

class SelectTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Select();
        $this->obj->addItem(array('valor'=>'valor1', 'conteudo'=>'Valor 1'));
        $this->obj->addItem(array('valor'=>'valor2', 'conteudo'=>'Valor 2'));
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
        $this->obj->addItem('a');
        $this->obj->addItem(array());
    }

     /**
     * @expectedException Exception
     */
    function testeMetodoRenderException(){
        $element = new Select();
        $element->render();
    }


    function testeMetodoRender(){
        $this->assertEquals('<select><option value=\'valor1\'>Valor 1</option><option value=\'valor2\'>Valor 2</option></select><br>', $this->obj->render());
    }
}
?>