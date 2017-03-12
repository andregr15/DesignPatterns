<?php

namespace AGR\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    private function getRequestMock(){
        return $this->getMockBuilder('\AGR\Request\Request')->getMock();
    }

    private function getValidator(){
        return new \AGR\Validator\Validator($this->getRequestMock());
    }

    public function testClassType(){
        $this->assertInstanceOf("AGR\Validator\Validator", $this->getValidator());
    }

    public function testValidateMethod(){
        $dados = array(
            'nome'=>'produto teste',
            'valor'=>'100.00'
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEmpty($errors);
    }

    public function testValidateMissingNome(){
        $dados = array(
            'valor'=>'100.00',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome não inicializado!', 'field' => 'nome')));
    }

     public function testValidateMissingValor(){
        $dados = array(
            'nome' => 'teste',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor')));
    }

    public function testValidateNomeTooLong(){
        $dados = array(
            'nome' => 'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome maior que 200 caracteres!', 'field' => 'nome')));
    }

     public function testValidateValorNotNumber(){
        $dados = array(
            'nome' => 'teste',
            'valor' => 'a'
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não é numérico!', 'field' => 'valor')));
    }

}



?>