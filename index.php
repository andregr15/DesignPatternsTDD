<?php
require_once __DIR__.'/vendor/autoload.php';

$form = new \AGR\Element\ElementFacade(new AGR\Validator\Validator(new AGR\Request\Request));
$dados = array(
            array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'fieldset', 'itens'=> array(
                array('tipo'=>'text', 'conteudo'=>'conteudo'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor')
                )),
                array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'text', 'conteudo'=>'conteudo1'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo1'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor1')
                )),
                array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'text', 'conteudo'=>'conteudo2'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo2'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor2')
                )),
                array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                array('tipo'=>'text', 'conteudo'=>'conteudo3'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo3'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor3')
                )),
                array('tipo'=>'form', 'acao'=>'acao', 'metodo'=>'metodo', 'itens'=>array(
                    array('tipo'=>'fieldset', 'itens'=> array(
                array('tipo'=>'text', 'conteudo'=>'conteudo4'),
                array('tipo'=>'textarea', 'linhas'=>10, 'colunas'=>50, 'conteudo'=>'conteudo4'),
                array('tipo'=>'lista', 'itens'=>array(1, 2, 3)),
                array('tipo'=>'select', 'itens'=>array('item1', 'item2', 'item3')),
                array('tipo'=>'input', 'nome'=>'nome', 'valor'=>'valor4')
                ))))
            )));
$form->addElements($dados);
echo $form->render();

?>