<?php
namespace AGR\Model;

class NumerosRomanos{
    private $numeroInteiro, $numeroRomano;

    //Regex - checking for valid Roman numerals
    private $roman_regex='/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/';

    private $numerosRomanos = array(
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    );

    function setNumeroInteiro($numero){
        if(!is_int($numero)){
            throw new \InvalidArgumentException('Parâmetro número deve ser um número inteiro positivo!');
        }
        
        if($numero > 3999) {//&& (($numero / 1000 > 3999) || ($numero % 1000 > 0))){
            throw new \InvalidArgumentException('Parâmetro número não pode ser maior que 3999!');    
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

    function setNumeroRomano($numero){
        if(!is_string($numero) || strlen($numero) > 9 || !$this->checarNumeroRomano($numero)){
            throw new \InvalidArgumentException('Parâmetro número deve ser um número romano válido!');
        }
        
        $this->numeroRomano = $numero;
    }

    function getNumeroRomano(){
        return $this->numeroRomano;
    }

    private function checarNumeroRomano($numero){
        return preg_match($this->roman_regex, strtoupper($numero)) > 0;
    }

    function convertNumeroRomano(){
        $ret = 0;
        $numAnterior = 0;

        foreach(str_split(strtoupper($this->numeroRomano)) as $numero){
            $num = $this->numerosRomanos[$numero];
            if($numAnterior != 0){ // como já foi adiciona o número anterior ao resultado, deve-se subtraí-lo duas vezes
                $ret += $num <= $numAnterior ? $num : $num - (2 * $numAnterior);
            }
            else{
                $ret += $num;
            }

            $numAnterior = $num;
        }

        return $ret;
    }
}
?>