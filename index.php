<?php
require_once __DIR__.'/vendor/autoload.php';
use Pimple\Container;
use AGR\Dao\SqliteDao;

$sqlite = new SqliteDao();
$sqlite->fixture();

$form = new \AGR\Element\ElementFacade(new AGR\Validator\Validator(new AGR\Request\Request));
$dados = array
            (
                array('nome'=> 'Produto teste', 'type'=>'text', 'validation'=>'notnull'),
                array('valor'=> '150.00', 'type'=>'numeric', 'validation'=>'greaterThan0'),
                array('descricao'=>'descrição do produto teste', 'type'=>'text', 'validation'=>'lessThan200'),
                array('categoria'=>'unitário', 'type'=>'select')
            );

$dados['categorias'] = $sqlite->getCategorias();
$form->populate($dados);
echo $form->render();

?>