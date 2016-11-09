<?php
namespace AGR\Elements;
use AGR\Interfaces\Element;
use AGR\Validator\Validator;

class Form implements Element {
    private $action;
    private $method;
    private $elements;
    private $validator;
    
    function __construct($action, $method, Validator $validator){
        $this->action = $action;
        $this->method = $method;
        $elements = array();
        $this->validator = $validator;
    }

    public function add($element){
        $this->elements[] = $element;
    }

    public function render(){
        echo "<form action=\"{$this->action}\" method=\"{$this->method}\">
                <fieldset>
                   <center>";
      
        foreach ($this->elements as $i) {
            $this->createField($i);            
        }
                
        echo "     </center> 
                </fieldset>  
                </form>";
    }

    private function createField($element){
        switch($element['class']){
            case 'textarea':
                echo "<textarea name=\"{$element['name']}\" rows=\"{$element['rows']}\" cols=\"{$element['cols']}\">{$element['content']}</textarea><br>\n";
                break;
            
            case 'input':
                echo "<input type=\"{$element['type']}\" name=\"{$element['name']}\" value=\"{$element['value']}\" /><br>\n";
                break;
            
            case 'text':
                echo "{$element['content']}<br>\n";
                break;
        }
    }
}

?>