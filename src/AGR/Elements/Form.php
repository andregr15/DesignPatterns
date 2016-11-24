<?php
namespace AGR\Elements;
use AGR\Interfaces\Element;
use AGR\Validator\Validator;


class Form implements Element {
    private $action;
    private $method;
    private $elements;
    private $validator;
    private $fieldFacade;
    
    function __construct($action, $method, Validator $validator){
        $this->action = $action;
        $this->method = $method;
        $elements = array();
        $this->validator = $validator;
        $this->fieldFacade = new FieldFacade();
    }

    public function add($element){
        $this->elements[] = $element;
    }

    public function render(){
        echo "<form action=\"{$this->action}\" method=\"{$this->method}\">";
      
        foreach ($this->elements as $i) {
            $this->createField($i);            
        }
                
        echo "</form>";
    }

    private function createField($element){
        return $this->fieldFacade->createField($element);
    }

     public function populate($dados){
        $this->elements = $this->fieldFacade->populate($dados, $this->validator);
    }
}

?>