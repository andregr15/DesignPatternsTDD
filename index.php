<?php
require_once __DIR__.'/vendor/autoload.php';

$form = new \AGR\Element\ElementFacade(new AGR\Validator\Validator(new AGR\Request\Request));
$dados = array
            (
                array('nome'=> 'Produto teste', 'type'=>'text', 'validation'=>'notnull'),
                array('valor'=> '150.00', 'type'=>'numeric', 'validation'=>'greaterThan0'),
                array('descricao'=>'descrição do produto teste', 'type'=>'text', 'validation'=>'lessThan200'),
                array('categoria'=>'unitário', 'type'=>'select')
            );

$form->populate($dados);
echo $form->render();

?>