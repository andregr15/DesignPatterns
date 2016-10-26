<?php

interface Element {
    function render();
};

class Input implements Element{
    private $type;
    private $name;
    private $value;
    
    function __construct($type, $name, $value){
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }   

    public function render() {
        echo "<input type=\"{$this->type}\" name=\"{$this->name}\" value=\"{$this->value}\" /><br>\n";
    }
}

class Text implements Element{
    private $content;

    function __construct($content){
        $this->content = $content;
    }   
    
    public function render() {
        echo "{$this->content}<br>\n";
    }
}

class TextArea implements Element{
    private $name;
    private $rows;
    private $cols;
    private $content;

    function __construct($name, $rows, $cols, $content){
        $this->name = $name;
        $this->rows = $rows;
        $this->cols = $cols;
        $this->content = $content;
    }   
    
    public function render() {
        echo "<textarea name=\"{$this->name}\" rows=\"{$this->rows}\" cols=\"{this->cols}\">{$this->content}</textarea><br>\n";
    }
}

class Form implements Element {
    private $action;
    private $method;
    private $elements;
    
    function __construct($action, $method){
        $this->action = $action;
        $this->method = $method;
        $elements = array();
    }

    public function add(Element $element){
        $this->elements[] = $element;
    }

    public function render(){
        echo "<form action=\"{$this->action}\" method=\"{$this->method}\">
                <fieldset>
                   <center>";
      
        foreach ($this->elements as $i) {
            $i->render();
        }
                
        echo "     </center> 
                </fieldset>  
                </form>";
    }
}

$form = new Form("/teste", "post");
$form->add(new Text("Para fazer login é necessário o usuário e a senha!"));
$form->add(new Text("Usuário:"));
$form->add(new Input("text", "usuario", "usuario"));
$form->add(new Text("Senha:"));
$form->add(new Input("password", "senha", "senha"));
$form->add(new TextArea("textarea", "10", "50", "textarea"));
$form->add(new Input("submit", "", "Login"));
$form->render();

?>