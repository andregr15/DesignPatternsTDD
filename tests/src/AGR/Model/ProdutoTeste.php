<?php
namespace AGR\Model;

class ProdutoTeste extends \PHPUnit_Framework_TestCase{
    private $obj;

    function setUp(){
        $this->obj = new Produto();
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Model\Produto', $this->obj);
    }

    function testeSetGetNome(){
        $this->obj->setNome('produto1');
        $this->assertEquals('produto1', $this->obj->getNome());
        $this->obj->setNome('produto2');
        $this->assertEquals('produto2', $this->obj->getNome());
        $this->obj->setNome('produto3');
        $this->assertEquals('produto3', $this->obj->getNome());
    }

    function testeSetGetDescricao(){
        $this->obj->setDescricao('descricao1');
        $this->assertEquals('descricao1', $this->obj->getDescricao());
        $this->obj->setDescricao('descricao2');
        $this->assertEquals('descricao2', $this->obj->getDescricao());
        $this->obj->setDescricao('descricao3');
        $this->assertEquals('descricao3', $this->obj->getDescricao());
        $this->obj->setDescricao(null);
        $this->assertEquals(null, $this->obj->getDescricao());
    }

    function testeSetGetValor(){
        $this->obj->setValor(100);
        $this->assertEquals(100, $this->obj->getValor());
        $this->obj->setValor(150);
        $this->assertEquals(150, $this->obj->getValor());
        $this->obj->setValor(150.10);
        $this->assertEquals(150.10, $this->obj->getValor());
    }

    /**
    * @expectedException InvalidArgumentException 
    **/
    function testeInvalidArgumentExceptionSetNome(){
        $this->obj->setNome(null);
    }

    /**
    * @expectedException InvalidArgumentException 
    **/
    function testeInvalidArgumentExceptionSetDescricao(){
        $this->obj->setDescricao(str_pad('a', 201, 'a', STR_PAD_RIGHT));
    }

    /**
    * @expectedException InvalidArgumentException
    **/
    function testeInvalidArgumentExceptionSetValor(){
        $this->obj->setValor('a');
        $this->obj->setValor(null);
    }
}
?>