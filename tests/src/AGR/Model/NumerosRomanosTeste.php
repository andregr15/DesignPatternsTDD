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
        $this->obj->setNumeroInteiro(3999000);
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

    /**
    *   @expectedException InvalidArgumentException
    **/
    function testeInvalidArgumentExceptionSetNumeroRomano(){
        $this->obj->setNumeroRomano('a');
        $this->obj->setNumeroRomano(10);
        $this->obj->setNumeroRomano('XABE');
        $this->obj->setNumeroRomano('IIII');
        $this->obj->setNumeroRomano('VV');
    }

    function testeSetNumeroRomano(){
        $this->obj->setNumeroRomano("i");
        $this->assertEquals("i", $this->obj->getNumeroRomano());
        $this->obj->setNumeroRomano("X");
        $this->assertEquals("X", $this->obj->getNumeroRomano());
        $this->obj->setNumeroRomano("CM");
        $this->assertEquals("CM", $this->obj->getNumeroRomano());
        $this->obj->setNumeroRomano("L");
        $this->assertEquals("L", $this->obj->getNumeroRomano());
    }

    function testeConverterNumeroRomano(){
        $this->obj->setNumeroRomano('i');
        $this->assertEquals(1, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('V');
        $this->assertEquals(5, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('X');
        $this->assertEquals(10, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('L');
        $this->assertEquals(50, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('C');
        $this->assertEquals(100, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('D');
        $this->assertEquals(500, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('m');
        $this->assertEquals(1000, $this->obj->convertNumeroRomano());

         $this->obj->setNumeroRomano('III');
        $this->assertEquals(3, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('IV');
        $this->assertEquals(4, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('XV');
        $this->assertEquals(15, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('IX');
        $this->assertEquals(9, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('xxx');
        $this->assertEquals(30, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('xix');
        $this->assertEquals(19, $this->obj->convertNumeroRomano());
        
        $this->obj->setNumeroRomano('MCLXXXIX');
        $this->assertEquals(1189, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('MMMCMXCIX');
        $this->assertEquals(3999, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('DLXXIV');
        $this->assertEquals(574, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('CCC');
        $this->assertEquals(300, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('mmm');
        $this->assertEquals(3000, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('CCL');
        $this->assertEquals(250, $this->obj->convertNumeroRomano());

        $this->obj->setNumeroRomano('mmD');
        $this->assertEquals(2500, $this->obj->convertNumeroRomano());

         $this->obj->setNumeroRomano('CXCIX');
        $this->assertEquals(199, $this->obj->convertNumeroRomano());
    }
}
?>