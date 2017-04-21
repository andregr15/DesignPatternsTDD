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

    function testevalidateProduto(){
        $dados = array(
            'nome'=>'produto 1',
            'descricao' => 'descricao do produto 1',
            'valor' => 150
        );

        $this->obj->validateProduto($dados);

        $this->assertEquals(array(), $this->obj->getErros());

        $dados = array(
            'descricao'=>str_pad('', 202, 'a'),
            'valor'=> 'a'
        );

        $this->obj->validateProduto($dados);
        $erros = $this->obj->getErros();
        $this->assertEquals('O nome do produto é obrigatório!', $erros[0]);
        $this->assertEquals('A descrição deve ter no máximo 200 caracteres!', $erros[1]);
        $this->assertEquals('O valor deve ser um número positivo!', $erros[2]);
    }
}
?>