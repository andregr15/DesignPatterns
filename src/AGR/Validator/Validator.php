<?php
namespace AGR\Validator;

use AGR\Request\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\RecursiveValidator;
class Validator{
    private $errors;
    private $validator;
    
    function __construct(Request $request){
        $this->errors = array();
    }

    function validate(&$dados){
        $errors = array();

        if(isset($dados)){
            if(!isset($dados['nome'])){
                $dados['nome'] = "";
                $errors[] = array('class' => 'li', 'value' => 'nome não inicializado!', 'field' => 'nome');
            }else if(strlen($dados['nome']) > 200){
                $dados['nome'] = "";
                $errors[] = array('class' => 'li', 'value' => 'nome maior que 200 caracteres!', 'field' => 'nome');
            }

            if(!isset($dados['valor'])){
                $errors[] = array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor');
                $dados['valor'] = "";
            }else if(!is_numeric($dados['valor'])){
                $errors[] = array('class' => 'li', 'value' => 'valor não é numérico!', 'field' => 'valor');
                $dados['valor'] = "";
            }
        }
        else{
            $errors[] = array('class' => 'li', 'value' => 'dados não inicializados!');
            $dados = array(
                'nome'=>'',
                'valor'=>'',
                'descricao'=>'',
                'tipo'=>''
            );
        }

        return $errors;
    }
}

?>