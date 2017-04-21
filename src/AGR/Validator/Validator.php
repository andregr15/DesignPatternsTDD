<?php
namespace AGR\Validator;

class Validator{
    private $request;
    private $erros;

    function __construct(\AGR\Request\Request $request){
        $this->request = $request;
        $this->erros = array();
    }

    function validateProduto($dados){
        if(!isset($dados['nome'])){
            $this->erros[] = 'O nome do produto é obrigatório!';
        }

        if(isset($dados['descricao']) && strlen($dados['descricao']) > 200){
            $this->erros[] = 'A descrição deve ter no máximo 200 caracteres!';
        }

        if(!isset($dados['valor']) || !is_numeric($dados['valor']) || $dados['valor'] <= 0){
            $this->erros[] = 'O valor deve ser um número positivo!';
        }
    }

    function getErros(){
        return $this->erros;
    }
}
?>