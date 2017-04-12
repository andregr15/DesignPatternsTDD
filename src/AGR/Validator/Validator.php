<?php
namespace AGR\Validator;

class Validator{
    private $request;

    function __construct(\AGR\Request\Request $request){
        $this->request= $request;
    }
}
?>