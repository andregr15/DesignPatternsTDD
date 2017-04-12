<?php
namespace AGR\Element;
use AGR\Element\Input;

class InputTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Input('salvar', 'Salvar');
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('\AGR\Element\Input', $this->obj);
    }

    function testeTipoInterface(){
        $this->assertInstanceOf('\AGR\Interfaces\ElementInterface', $this->obj);
    }
    
     /**
     * @expectedException InvalidArgumentException
     */
    public function testeParametroNomeConstrutor(){
        $element = new Input(null, null);
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testeParametroValorConstrutor(){
        $element = new Input('nome', null);
    }

    function testeMetodoRender(){
        $this->assertEquals('<input type="submit" name="salvar" value="Salvar"><br>', $this->obj->render());
    }
}

?>