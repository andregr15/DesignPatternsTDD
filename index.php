<?php
require_once __DIR__.'/vendor/autoload.php';
use Pimple\Container;
use AGR\Dao\SqliteDao;

$sqlite = new SqliteDao();
$sqlite->fixture();

$form = new \AGR\Element\ElementFacade(new AGR\Validator\Validator(new AGR\Request\Request));

$dados = array(
            'nome' => 'produto 1',
            'descricao' => 'descrição produto 1',
            'valor' => 150.00,
            'categoria' => 'unitário'
        );

$dados['categorias'] = $sqlite->getCategorias();
$form->populate($dados);
echo $form->render();

?>