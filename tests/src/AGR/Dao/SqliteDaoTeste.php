<?php
namespace AGR\Dao;

class SqliteDaoTeste extends \PHPUnit_Framework_TestCase{

    private $obj;

    function setUp(){
        $this->obj = new SqliteDao();
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Dao\SqliteDao', $this->obj);
    }

    function testeFixure(){
        $this->expectOutputString('', $this->obj->fixture());
        $this->assertEquals(array(
            array('id'=>1, 'valor'=>'Unitário', 'conteudo'=>'Unitário'), 
            array('id'=>2, 'valor'=>'Fracionado', 'conteudo'=>'Fracionado'), 
            array('id'=>3, 'valor'=>'Pesado', 'conteudo'=>'Pesado')
            ), $this->obj->getCategorias());
    }

}
?>