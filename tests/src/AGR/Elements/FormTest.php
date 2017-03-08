<?php
namespace AGR\Elements;

class FormTest extends \PHPUnit_Framework_TestCase {

    public function testClassType(){
        $this->assertInstanceOf("AGR\Interfaces\Element", new \AGR\Elements\Form(null, null, new \AGR\Validator\Validator(new \AGR\Request\Request())));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddMethodInvalidArgumentException(){
        $form = new \AGR\Elements\Form(null, null, new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->add("teste");
    }

     /**
     * @expectedException InvalidArgumentException
     */
    public function testPopulateMethodInvalidArgumentException(){
        $form = new \AGR\Elements\Form(null, null, new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate("teste");
    }

    public function testRenderMethod(){     
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

        $form = new Form("/produto", "produto",new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br></ul><br><fieldset><br><center>Nome:<br><input type="text" name="nome" value="produto teste"/><br>Valor:<br><input type="numeric" name="valor" value="100.00"/><br>Descrição:<br><textarea name="descricao" rows="10" cols="40">produto para vendas de teste</textarea><br><br><select><br><option value=\'categoria1\'>1</option><br><option value=\'categoria2\'>2</option><br></select></center><br></fieldset><br></form>');

        $form->render();
    }

    public function testValidateMissingNomeMethod(){     
        $dados = array();

        $form = new Form("/produto", "produto",new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome não inicializado!</li><br><li>valor não inicializado!</li><br></ul><br></form>');

        $form->render();
    }

     public function testValidateNomeTooLongMethod(){     
        $dados = array(
            'nome'=>'produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste produto teste',
            'valor'=>'100.00',
        );

        $form = new Form("/produto", "produto",new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>nome maior que 200 caracteres!</li><br></ul><br></form>');

        $form->render();
    }

     public function testValidateMissingValorMethod(){     
        $dados = array(
            'nome'=>'nome',
        );

        $form = new Form("/produto", "produto",new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não inicializado!</li><br></ul><br></form>');

        $form->render();
    }

    public function testValidateValorInvalidMethod(){     
        $dados = array(
            'nome'=>'nome',
            'valor'=>'a',
        );

        $form = new Form("/produto", "produto",new \AGR\Validator\Validator(new \AGR\Request\Request()));
        $form->populate($dados);

        $this->expectOutputString('<form action="/produto" method="produto"><ul><br><li>valor não é numérico!</li><br></ul><br></form>');

        $form->render();
    }
}


?>