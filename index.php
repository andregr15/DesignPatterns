<?php
require_once __DIR__.'/vendor/autoload.php';

use AGR\Elements\Form;
use AGR\Elements\Input;
use AGR\Elements\Text;
use AGR\Elements\TextArea;
use AGR\Request\Request;
use AGR\Validator\Validator;
use Pimple\Container;
use AGR\Dao\SqliteDao;

$container = new Container();
$container['request'] = function (){
    return new Request();
};

$container['validator'] = function($container){
    return new Validator($container['request']);
};

$dados = array(
    'nome'=>'produto teste',
    'valor'=>'100.00',
    'descricao'=>'produto para vendas de teste',
    'tipo'=>'fracionado'
);

$sqlite = new SqliteDao();
$sqlite->fixture();
$dados['categorias'] = $sqlite->getCategorias();

$form = new Form("/produto", "produto", $container['validator']);
$form->populate($dados);
$form->render();

?>