<?php

namespace AGR\Elements;

class FieldFacadeTest extends \PHPUnit_Framework_TestCase {

    public function testClassType(){
        $this->assertInstanceOf("AGR\Elements\FieldFacade", new \AGR\Elements\FieldFacade());
    }

    public function testCreateFieldTextArea(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'textarea', 'name'=>'nome', 'rows'=>'10', 'cols'=>'10', 'content'=>'conteudo');

        $this->expectOutputString("<textarea name=\"{$element['name']}\" rows=\"{$element['rows']}\" cols=\"{$element['cols']}\">{$element['content']}</textarea><br><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldInput(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'input', 'type'=>'button', 'name'=>'nome', 'value'=>'valor', 'content'=>'conteudo');

        $this->expectOutputString("<input type=\"{$element['type']}\" name=\"{$element['name']}\" value=\"{$element['value']}\"/><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldText(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'text', 'content'=>'conteudo');

        $this->expectOutputString("{$element['content']}<br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldFieldSet(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'fieldset');

        $this->expectOutputString("<fieldset><br><center>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldEndFieldSet(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'endFieldset');

        $this->expectOutputString("</center><br></fieldset><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldUl(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'ul');

        $this->expectOutputString("<ul><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldLi(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'li', 'value'=>'valor');

        $this->expectOutputString("<li>{$element['value']}</li><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldEndUl(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'endul');

        $this->expectOutputString("</ul><br>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldSelect(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'select', 'options'=>array(array('value'=>'valor', 'content'=>'conteudo')));

        $this->expectOutputString("<select><br><option value='valor'>conteudo</option><br></select>");
        $fieldFacade->createField($element);
    }

    public function testCreateFieldTextDefault(){
        $fieldFacade = new \AGR\Elements\FieldFacade();

        $element = array('class'=>'');

        $this->expectOutputString('');
        $fieldFacade->createField($element);
    }
}


?>