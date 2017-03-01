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
    }

}


?>