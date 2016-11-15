<?php
require_once __DIR__.'/vendor/autoload.php';

use AGR\Elements\Form;
use AGR\Elements\Input;
use AGR\Elements\Text;
use AGR\Elements\TextArea;
use AGR\Request\Request;
use AGR\Validator\Validator;
use Pimple\Container;

$container = new Container();
$container['request'] = function (){
    return new Request();
};

$container['validator'] = function($container){
    return new Validator($container['request']);
};

$form = new Form("/teste", "post", $container['validator']);
$form->add(array('class' => 'text', 'content' => 'Para fazer login é necessário o usuário e a senha!'));
$form->add(array('class' => 'text', 'content' => 'Usuário:'));
$form->add(array('class' => 'input', 'type' => 'text', 'value' =>'usuario', 'name' => 'usuario'));
$form->add(array('class' => 'text', 'content' => 'Senha:'));
$form->add(array('class' => 'input', 'type' => 'password', 'value' =>'senha', 'name' => 'senha'));
$form->add(array('class' => 'textarea', 'rows' => '10', 'cols' =>'50', 'content' => '', 'name' => 'textarea'));
$form->add(array('class' => 'input', 'type' => 'submit', 'value' =>'Login', 'name' => ' '));
$form->render();


$form = new Form("/teste", "post", $container['validator']);
$form->add(array('class' => 'fieldset'));
$form->add(array('class' => 'text', 'content' => 'E-mail:'));
$form->add(array('class' => 'input', 'type' => 'text', 'value' =>'e-mail', 'name' => 'email'));
$form->add(array('class' => 'text', 'content' => 'Motivo:'));
$form->add(array('class' => 'input', 'type' => 'text', 'value' =>'motivo', 'name' => 'motivo'));
$form->add(array('class' => 'textarea', 'rows' => '10', 'cols' =>'50', 'content' => 'Reclamações', 'name' => 'textarea'));
$form->add(array('class' => 'input', 'type' => 'submit', 'value' =>'Enviar', 'name' => ' '));
$form->add(array('class' => 'endFieldset'));
$form->render();


$form = new Form("/teste", "post", $container['validator']);
$form->add(array('class' => 'text', 'content' => 'E-mail:'));
$form->add(array('class' => 'input', 'type' => 'text', 'value' =>'e-mail', 'name' => 'email'));
$form->add(array('class' => 'textarea', 'rows' => '10', 'cols' =>'50', 'content' => 'Sugestões', 'name' => 'textarea'));
$form->add(array('class' => 'input', 'type' => 'submit', 'value' =>'Enviar', 'name' => ' '));
$form->render();

$form = new Form("/teste", "post", $container['validator']);
$form->add(array('class' => 'fieldset'));
$form->add(array('class' => 'text', 'content' => 'Para realizar seu cadastro por favor preencha os dados abaixo!'));
$form->add(array('class' => 'text', 'content' => 'Usuário:'));
$form->add(array('class' => 'input', 'type' => 'text', 'value' =>'usuario', 'name' => 'usuario'));
$form->add(array('class' => 'text', 'content' => 'Senha:'));
$form->add(array('class' => 'input', 'type' => 'password', 'value' =>'senha', 'name' => 'senha'));
$form->add(array('class' => 'input', 'type' => 'submit', 'value' =>'Enviar', 'name' => ' '));
$form->add(array('class' => 'input', 'type' => 'submit', 'value' =>'Cancelar', 'name' => ' '));
$form->add(array('class' => 'endFieldset'));
$form->render();

?>
