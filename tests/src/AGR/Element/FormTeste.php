<?php
namespace AGR\Element;
use AGR\Element\Form;
use AGR\Request\Request;
use AGR\Validator\Validator;

class FormTeste extends \PHPUnit_Framework_TestCase{
    private $obj, $objMock, $requestMock, $validatorMock;

    function setUp(){
        $request = new Request();
        $validator = new Validator($request);
        $this->obj = new Form('acao', 'metodo', $validator);

        $this->requestMock = $this->getMockBuilder('AGR\Request\Request')->getMock();
        $this->validatorMock = $this->getMockBuilder('AGR\Validator\Validator')->setConstructorArgs(['request'=>$this->requestMock])->getMock();
        $this->validatorMock->method('validateProduto')->willReturn(null);
        $this->validatorMock->method('getErros')->willReturn(array());
        $this->objMock = new Form('acao', 'metodo', $this->validatorMock);
    }

    function tearDown(){
        $this->obj = null;
    }

    function testeTipoObjeto(){
        $this->assertInstanceOf('AGR\Element\Form', $this->obj);
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
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeUnitarioConstrutorParametroAcaoException(){
        $requestMock = $this->getMockBuilder('AGR\Request\Request')->getMock();
        $validatorMock = $this->getMockBuilder('AGR\Validator\Validator')->setConstructorArgs(['requedst'=>$requestMock])->getMock();
        $this->obj = new Form(null, null, $validatorMock);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeUnitarioConstrutorParametroMetodoException(){
        $requestMock = $this->getMockBuilder('AGR\Request\Request')->getMock();
        $validatorMock = $this->getMockBuilder('AGR\Validator\Validator')->setConstructorArgs(['requedst'=>$requestMock])->getMock();
        $this->obj = new Form(null, null, $validatorMock);
    }

      /**
     * @expectedException InvalidArgumentException
     */
    function testeFuncionalConstrutorParametroAcaoException(){
        $this->obj = new Form(null, null, new Validator(new Request()));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testeFuncionalConstrutorParametroMetodoException(){
        $this->obj = new Form('acao', null, new Validator(new Request()));
    }

    function testeUnitarioMetodoRender(){
        $this->assertEquals('<form action="acao" method="metodo"></form>', $this->obj->render());
        
        $textMock = $this->getMockBuilder('AGR\Element\Text')->setConstructorArgs(['conteudo'=>'conteudo: '])->getMock();
        $textMock->method('render')->willReturn('conteudo: <br>');
        $this->obj->addItem($textMock);

        $inputMock = $this->getMockBuilder('AGR\Element\Input')->setConstructorArgs(['nome'=>'nome', 'valor'=>'valor'])->getMock();
        $inputMock->method('render')->willReturn('<input type="submit" name="nome" value="valor"><br>');
        $this->obj->addItem($inputMock);

        $this->assertEquals('<form action="acao" method="metodo">conteudo: <br><input type="submit" name="nome" value="valor"><br></form>', $this->obj->render());
    }

    function testeFuncionalMetodoRender(){
        $this->assertEquals('<form action="acao" method="metodo"></form>', $this->obj->render());
        
        $text = new Text('conteudo: ');
        $this->obj->addItem($text);

        $input = new Input('nome', 'valor');
        $this->obj->addItem($input);

        $this->assertEquals('<form action="acao" method="metodo">conteudo: <br><input type="submit" name="nome" value="valor"><br></form>', $this->obj->render());
    }
}
?>