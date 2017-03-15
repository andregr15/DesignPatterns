<?php

namespace AGR\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    private $validator;

    private function getRequestMock(){
        return $this->getMockBuilder('\AGR\Request\Request')->getMock();
    }

    private function getValidator(){
        return new \AGR\Validator\Validator($this->getRequestMock());
    }

    protected function setUp(){
        $request = new \AGR\Request\Request();
        $this->validator = new \AGR\Validator\Validator($request);
    }

    protected function tearDown(){
        $this->validator = null;
    }

    //=========================== testes unitários =====================================================================================

    public function testClassTypeUnitario(){
        $this->assertInstanceOf("AGR\Validator\Validator", $this->getValidator());
    }

    public function testValidateMethodUnitario(){
        $dados = array(
            'nome'=>'produto teste',
            'valor'=>'100.00'
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEmpty($errors);
    }

    public function testValidateMissingNomeUnitario(){
        $dados = array(
            'valor'=>'100.00',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome não inicializado!', 'field' => 'nome')));
    }

     public function testValidateMissingValorUnitario(){
        $dados = array(
            'nome' => 'teste',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor')));
    }

    public function testValidateNomeTooLongUnitario(){
        $dados = array(
            'nome' => 'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome maior que 200 caracteres!', 'field' => 'nome')));
    }

     public function testValidateValorNotNumberUnitario(){
        $dados = array(
            'nome' => 'teste',
            'valor' => 'a'
        );
    
        $validator = $this->getValidator();

        $errors = $validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não é numérico!', 'field' => 'valor')));
    }

    //============================== testes funcionais ==================================================================================

    public function testClassTypeFuncional(){
        $this->assertInstanceOf("AGR\Validator\Validator", $this->validator);
    }

    public function testValidateMethodFuncional(){
        $dados = array(
            'nome'=>'produto teste',
            'valor'=>'100.00'
        );
    
       $errors = $this->validator->validate($dados);

        $this->assertEmpty($errors);
    }

    public function testValidateMissingNomeFuncional(){
        $dados = array(
            'valor'=>'100.00',
        );
    
        $errors = $this->validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome não inicializado!', 'field' => 'nome')));
    }

     public function testValidateMissingValorFuncional(){
        $dados = array(
            'nome' => 'teste',
        );

        $errors = $this->validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor')));
    }

    public function testValidateNomeTooLongFuncional(){
        $dados = array(
            'nome' => 'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );

        $errors = $this->validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'nome maior que 200 caracteres!', 'field' => 'nome')));
    }

     public function testValidateValorNotNumberFuncional(){
        $dados = array(
            'nome' => 'teste',
            'valor' => 'a'
        );

        $errors = $this->validator->validate($dados);

        $this->assertEquals($errors, array(array('class' => 'li', 'value' => 'valor não é numérico!', 'field' => 'valor')));
    }
}



?>