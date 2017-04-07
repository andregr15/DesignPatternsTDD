<?php
namespace AGR\Element;
use AGR\Element\TextArea;

class TextAreaTeste extends \PHPUnit_Framework_TestCase {
    private $obj;

    function setUp(){
        $this->obj = new TextArea(50, 10, 'teste de textarea');
    }

    function tearDown(){
        $this->obj = null;
    }

    public function testeTipoObjeto(){
        $this->assertInstanceOf("\AGR\Element\TextArea", $this->obj);
    }

      public function testeTipoInterface(){
        $this->assertInstanceOf("\AGR\Interfaces\ElementInterface",  $this->obj);
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testeParametroLinhasConstrutor(){
        $element = new TextArea(null, null, null);
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testeParametroColunasConstrutor(){
        $element = new TextArea(5, null, null);
    }

    public function testeMetodoRender(){
        $this->assertEquals('<textarea rows="50" cols="10">teste de textarea</textarea>', $this->obj->render());
    }
}

?>