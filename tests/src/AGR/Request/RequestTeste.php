<?php
namespace AGR\Request;

class RequestTest extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Request();
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('\AGR\Request\Request', $this->obj);
    }
}
?>