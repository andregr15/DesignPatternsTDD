<?php
namespace AGR\Model;

class NumerosRomanos{
    private $numeroInteiro;

    function setNumeroInteiro($numero){
        if(!is_int($numero)){
            throw new \InvalidArgumentException('Parâmetro número deve ser um número inteiro positivo!');
        }
        
        if($numero > 3999 && (($numero / 1000 > 3999) || ($numero % 1000 > 0))){
            throw new \InvalidArgumentException('Parâmetro número não pode ser maior que 3999 e não ser terminado com 000 e não pode ser maior que 3999000!');    
        }

        $this->numeroInteiro = $numero;
    }

    function getNumeroInteiro(){
        return $this->numeroInteiro;
    }

    function convertNumeroInteiro(){
        $tamanhoNumero = strlen(strval($this->numeroInteiro));
        $ret = '';
        
        for($i = 0; $i < $tamanhoNumero; $i++){
            $ret.= $this->processaNumeroInteiro(str_pad(strval($this->numeroInteiro)[$i], $tamanhoNumero - $i, '0', STR_PAD_RIGHT));
        }
        return $ret;
    }

    private function processaNumeroInteiro($numero){
        if((int)$numero >= 1000){
           switch($numero[0]){
                case '1':
                    return 'M';
                case '2':
                    return 'MM';
                case '3':
                    return 'MMM';
           }
        }
        else if ((int)$numero >= 100){
            switch($numero[0]){
                case '1':
                    return 'C';
                case '2':
                    return 'CC';
                case '3':
                    return 'CCC';
                case '4':
                    return 'CD';
                case '5':
                    return 'D';
                case '6':
                    return 'DC';
                case '7':
                    return 'DCC';
                case '8':
                    return 'DCCC';
                case '9':
                    return 'CM';
            }
        }
        else if((int)$numero >= 10){
            switch($numero[0]){
                case '1':
                    return 'X';
                case '2':
                    return 'XX';
                case '3':
                    return 'XXX';
                case '4':
                    return 'XL';
                case '5':
                    return 'L';
                case '6':
                    return 'LX';
                case '7':
                    return 'LXX';
                case '8':
                    return 'LXXX';
                case '9':
                    return 'XC';
            }
        }
        else{
            switch($numero[0]){
                case '1':
                    return 'I';
                case '2':
                    return 'II';
                case '3':
                    return 'III';
                case '4':
                    return 'IV';
                case '5':
                    return 'V';
                case '6':
                    return 'VI';
                case '7':
                    return 'VII';
                case '8':
                    return 'VIII';
                case '9':
                    return 'IX';
            }
        }
    }
}
?>