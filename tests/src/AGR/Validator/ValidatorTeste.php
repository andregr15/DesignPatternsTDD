<?php
namespace AGR\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $requestMock = $this->getMockBuilder('\AGR\Request\Request')->getMock();
        $this->obj = new Validator($requestMock);
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('\AGR\Validator\Validator', $this->obj);
    }
}
?>