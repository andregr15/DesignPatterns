<?php
namespace AGR\Elements;

class FormTest extends \PHPUnit_Framework_TestCase {

    private $request;
    private $validator;
    private $form;

    private function getRequestMock(){
        return $this->getMockBuilder('\AGR\Request\Request')->getMock();
    }

    private function getValidatorMock(){
        return $this->getMockBuilder('\AGR\Validator\Validator')->setConstructorArgs(['Request' => $this->getRequestMock()])->getMock();
    }

    protected function setUp(){
        $this->request = new \AGR\Request\Request();
        $this->validator = new \AGR\Validator\Validator($this->request);
        $this->form = new \AGR\Elements\Form("/produto", "produto", $this->validator);
    }

    protected function tearDown(){
        $this->form = null;
        $this->validator = null;
        $this->request = null;
    }

    //============================= testes unitários =====================================================================

    public function testClassTypeUnitario(){
        $this->assertInstanceOf("AGR\Interfaces\Element", new \AGR\Elements\Form(null, null, $this->getValidatorMock()));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddMethodInvalidArgumentExceptionUnitario(){
        $form = new \AGR\Elements\Form(null, null, $this->getValidatorMock());
        $form->add("teste");
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testPopulateMethodInvalidArgumentExceptionUnitario(){
        $form = new \AGR\Elements\Form(null, null, $this->getValidatorMock());
        $form->populate("teste");
    }

    public function testRenderMethodUnitario(){     
        $dados = array(
            'nome'=>'produto teste',
            'valor'=>'100.00',
            'descricao'=>'produto para vendas de teste',
            'tipo'=>'fracionado',
            'categorias' => [
                'class' => 'select',
                             'options' => [
                                 ['id'=> 1, 'value' => 'categoria1', 'content' => '1'], 
                                 ['id'=> 2, 'value' => 'categoria2', 'content' => '2']
                             ]
            ]
        );

        $validatorMock = $this->getValidatorMock();
        $validatorMock->method('validate')->willReturn(array());

        $form = new Form("/produto", "produto", $validatorMock);
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br></ul><br><fieldset><br><center>Nome:<br><input type="text" name="nome" value="produto teste"/><br>Valor:<br><input type="numeric" name="valor" value="100.00"/><br>Descrição:<br><textarea name="descricao" rows="10" cols="40">produto para vendas de teste</textarea><br><br><select><br><option value=\'categoria1\'>1</option><br><option value=\'categoria2\'>2</option><br></select></center><br></fieldset><br></form>');

        $form->render();
    }

    public function testValidateMissingNomeUnitario(){     
        $dados = array();
        
        $validatorMock = $this->getValidatorMock();
        $validatorMock->method('validate')->willReturn(array(array('class' => 'li', 'value' => 'nome não inicializado!', 'field' => 'nome'), array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor')));

        $form = new Form("/produto", "produto", $validatorMock);
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome não inicializado!</li><br><li>valor não inicializado!</li><br></ul><br></form>');

        $form->render();
    }

     public function testValidateNomeTooLongUnitario(){     
        $dados = array(
            'nome'=>'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );

        $validatorMock = $this->getValidatorMock();
        $validatorMock->method('validate')->willReturn(array(array('class' => 'li', 'value' => 'nome maior que 200 caracteres!', 'field' => 'nome')));

        $form = new Form("/produto", "produto", $validatorMock);
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome maior que 200 caracteres!</li><br></ul><br></form>');

        $form->render();
    }

     public function testValidateMissingValorUnitario(){     
        $dados = array(
            'nome'=>'nome',
        );

        $validatorMock = $this->getValidatorMock();
        $validatorMock->method('validate')->willReturn(array(array('class' => 'li', 'value' => 'valor não inicializado!', 'field' => 'valor')));

        $form = new Form("/produto", "produto", $validatorMock);
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não inicializado!</li><br></ul><br></form>');

        $form->render();
    }

    public function testValidateValorInvalidUnitario(){     
        $dados = array(
            'nome'=>'nome',
            'valor'=>'a',
        );

        $validatorMock = $this->getValidatorMock();
        $validatorMock->method('validate')->willReturn(array(array('class' => 'li', 'value' => 'valor não é numérico!', 'field' => 'valor')));

        $form = new Form("/produto", "produto", $validatorMock);
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não é numérico!</li><br></ul><br></form>');

        $form->render();
    }

    //====================================================================================================================================================================================

    //================================ testes funcionais =================================================================================================================================

    public function testClassTypeFuncional(){
        $this->assertInstanceOf("AGR\Interfaces\Element", $this->form);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddMethodInvalidArgumentExceptionFuncional(){
        $this->form->add("teste");
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testPopulateMethodInvalidArgumentExceptionFuncional(){
        $this->form->populate("teste");
    }

    public function testRenderMethodFuncinal() {     
        $dados = array(
            'nome'=>'produto teste',
            'valor'=>'100.00',
            'descricao'=>'produto para vendas de teste',
            'tipo'=>'fracionado',
            'categorias' => [
                'class' => 'select',
                             'options' => [
                                 ['id'=> 1, 'value' => 'categoria1', 'content' => '1'], 
                                 ['id'=> 2, 'value' => 'categoria2', 'content' => '2']
                             ]
            ]
        );

        $this->form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br></ul><br><fieldset><br><center>Nome:<br><input type="text" name="nome" value="produto teste"/><br>Valor:<br><input type="numeric" name="valor" value="100.00"/><br>Descrição:<br><textarea name="descricao" rows="10" cols="40">produto para vendas de teste</textarea><br><br><select><br><option value=\'categoria1\'>1</option><br><option value=\'categoria2\'>2</option><br></select></center><br></fieldset><br></form>');

        $this->form->render();
    }

    public function testValidateMissingNomeFuncional(){     
        $dados = array();
        
        $this->form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome não inicializado!</li><br><li>valor não inicializado!</li><br></ul><br></form>');

        $this->form->render();
    }

     public function testValidateNomeTooLongFuncional(){     
        $dados = array(
            'nome'=>'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );

        $this->form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome maior que 200 caracteres!</li><br></ul><br></form>');

        $this->form->render();
    }

     public function testValidateMissingValorFuncional(){     
        $dados = array(
            'nome'=>'nome',
        );

        $this->form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não inicializado!</li><br></ul><br></form>');

        $this->form->render();
    }

    public function testValidateValorInvalidFuncional(){     
        $dados = array(
            'nome'=>'nome',
            'valor'=>'a',
        );

        $this->form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não é numérico!</li><br></ul><br></form>');

        $this->form->render();
    }

    //====================================================================================================================================================================================
}


?>