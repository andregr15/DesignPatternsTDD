<?php
namespace AGR\Model;

class NumerosRomanosTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new NumerosRomanos();
    }
    
    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Model\NumerosRomanos', $this->obj);
    }

    /**
    *   @expectedException InvalidArgumentException
    **/
    function testeInvalidArgumentExceptionSetNumeroInteiro(){
        $this->obj->setNumeroInteiro('a');
        $this->obj->setNumeroInteiro(10.00);
        $this->obj->setNumeroInteiro(null);
        $this->obj->setNumeroInteiro(array());
        $this->obj->setNumeroInteiro(4010);
        $this->obj->setNumeroInteiro(4000000);
    }

    function testeSetNumeroInteiro(){
        $this->obj->setNumeroInteiro(10);
        $this->assertEquals(10, $this->obj->getNumeroInteiro());
        $this->obj->setNumeroInteiro(25);
        $this->assertEquals(25, $this->obj->getNumeroInteiro());
        $this->obj->setNumeroInteiro(39);
        $this->assertEquals(39, $this->obj->getNumeroInteiro());
        $this->obj->setNumeroInteiro(3999);
        $this->assertEquals(3999, $this->obj->getNumeroInteiro());
        $this->obj->setNumeroInteiro(3999000);
        $this->assertEquals(3999000, $this->obj->getNumeroInteiro());
    }

    function testeConverterNumeroInteiro(){
        $this->obj->setNumeroInteiro(1);
        $this->assertEquals('I', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(5);
        $this->assertEquals('V', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(10);
        $this->assertEquals('X', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(50);
        $this->assertEquals('L', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(100);
        $this->assertEquals('C', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(500);
        $this->assertEquals('D', $this->obj->convertNumeroInteiro());
        
        $this->obj->setNumeroInteiro(1000);
        $this->assertEquals('M', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(3);
        $this->assertEquals('III', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(4);
        $this->assertEquals('IV', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(9);
        $this->assertEquals('IX', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(30);
        $this->assertEquals('XXX', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(19);
        $this->assertEquals('XIX', $this->obj->convertNumeroInteiro());
        
        $this->obj->setNumeroInteiro(1189);
        $this->assertEquals('MCLXXXIX', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(3999);
        $this->assertEquals('MMMCMXCIX', $this->obj->convertNumeroInteiro());

        $this->obj->setNumeroInteiro(574);
        $this->assertEquals('DLXXIV', $this->obj->convertNumeroInteiro());
    }
}
?>